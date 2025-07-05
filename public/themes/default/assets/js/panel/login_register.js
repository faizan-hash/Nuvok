//LOGIN
function LoginForm() {
	'use strict';

	console.log('LoginForm() called');
	console.log('Current URL:', window.location.href);
	console.log('magicai_localize available:', typeof magicai_localize !== 'undefined');
	console.log('Alpine available:', typeof Alpine !== 'undefined');
	console.log('jQuery available:', typeof $ !== 'undefined');

	// Safety checks for required variables
	if (typeof magicai_localize === 'undefined') {
		console.error('magicai_localize is not defined!');
		alert('JavaScript dependencies not loaded. Please refresh the page.');
		return false;
	}

	if (typeof Alpine === 'undefined') {
		console.error('Alpine is not defined!');
		alert('Alpine.js not loaded. Please refresh the page.');
		return false;
	}

	// Check if Alpine store exists
	let hasLoadingIndicator = false;
	try {
		if (Alpine.store && Alpine.store('appLoadingIndicator')) {
			hasLoadingIndicator = true;
		}
	} catch (e) {
		console.warn('Alpine appLoadingIndicator store not available:', e);
	}

	document.getElementById('LoginFormButton').disabled = true;
	document.getElementById('LoginFormButton').innerHTML = magicai_localize.please_wait;
	
	if (hasLoadingIndicator) {
		Alpine.store('appLoadingIndicator').show();
	} else {
		console.log('Alpine loading indicator not available, skipping');
	}

	var email = $('#email').val();
	if (email == '') {
		toastr.error(magicai_localize.missing_email);
		document.getElementById('LoginFormButton').disabled = false;
		document.getElementById('LoginFormButton').innerHTML = magicai_localize.sign_in;
		if (hasLoadingIndicator) {
			Alpine.store('appLoadingIndicator').hide();
		}
		return false;
	}
	var password = $('#password').val();
	if (password == '') {
		toastr.error(magicai_localize.missing_password);
		document.getElementById('LoginFormButton').disabled = false;
		document.getElementById('LoginFormButton').innerHTML = magicai_localize.sign_in;
		if (hasLoadingIndicator) {
			Alpine.store('appLoadingIndicator').hide();
		}
		return false;
	}

	var formData = new FormData();
	formData.append('email', $('#email').val());
	formData.append('password', $('#password').val());
	formData.append('remember', $('#remember').is(':checked'));

	console.log('Form data prepared:', {
		email: $('#email').val(),
		password: '[hidden]',
		remember: $('#remember').is(':checked')
	});

	let recaptcha = $('#recaptcha').val();
	if (recaptcha == 1 && typeof grecaptcha !== 'undefined') {
		let recaptchaResponse = grecaptcha.getResponse();
		formData.append('g-recaptcha-response', recaptchaResponse);
	}

	console.log('About to send AJAX request to /login');
	
	// Ajax Post
	$.ajax({
		type: 'post',
		url: '/login',
		data: formData,
		contentType: false,
		processData: false,
		cache: false,
		beforeSend: function() {
			console.log('AJAX request started');
		},
		success: function (data) {
			console.log('Login success response:', data);
			console.log('Redirecting to:', data.link);
			console.log('Current URL before redirect:', window.location.href);
			
			toastr.success(magicai_localize.login_redirect);

			window.location.href = data.link;

			// Don't hide loading indicator since we're redirecting
		},
		error: function (data) {
			console.log('Login error response:', data);
			console.log('Error status:', data.status);
			console.log('Error response text:', data.responseText);
			
			if (data.responseJSON && data.responseJSON.errors) {
				var err = data.responseJSON.errors;
				$.each(err, function (index, value) {
					toastr.error(value);
				});
			} else if (data.responseJSON && data.responseJSON.message) {
				toastr.error(data.responseJSON.message);
			} else {
				toastr.error('An error occurred during login');
			}
			document.getElementById('LoginFormButton').disabled = false;
			document.getElementById('LoginFormButton').innerHTML = magicai_localize.sign_in;
			if (hasLoadingIndicator) {
				Alpine.store('appLoadingIndicator').hide();
			}
		}
	});
	return false;
}

//REGISTER
function RegisterForm() {
	'use strict';

	document.getElementById('RegisterFormButton').disabled = true;
	document.getElementById('RegisterFormButton').innerHTML = magicai_localize.please_wait;
	Alpine.store('appLoadingIndicator').show();

	var formData = new FormData();
	formData.append('name', $('#name_register').val());
	formData.append('surname', $('#surname_register').val());
	formData.append('password', $('#password_register').val());
	formData.append('password_confirmation', $('#password_confirmation_register').val());
	formData.append('email', $('#email_register').val());
	if ($('#affiliate_code').val() != 'undefined') {
		formData.append('affiliate_code', $('#affiliate_code').val());
	} else {
		formData.append('affiliate_code', null);
	}

	let recaptcha = $('#recaptcha').val();

	if (recaptcha == 1 && typeof grecaptcha !== 'undefined') {
		let recaptchaResponse = grecaptcha.getResponse();
		formData.append('g-recaptcha-response', recaptchaResponse);
	}

	$.ajax({
		type: 'post',
		url: '/register',
		data: formData,
		contentType: false,
		processData: false,
		success: function (data) {
			toastr.success(magicai_localize.register_redirect);
			setTimeout(function () {
				window.location.href = '/dashboard';
				// location.reload();
				Alpine.store('appLoadingIndicator').hide();
			}, 1500);
		},
		error: function (data) {
			var err = data.responseJSON.errors;
			var type = data.responseJSON.type;
			$.each(err, function (index, value) {
				toastr.error(value);
			});

			if (type === 'confirmation') {
				setTimeout(function () {
					location.href = '/login';
					Alpine.store('appLoadingIndicator').hide();
				}, 2500);
			} else {
				document.getElementById('RegisterFormButton').disabled = false;
				document.getElementById('RegisterFormButton').innerHTML = magicai_localize.signup;
				Alpine.store('appLoadingIndicator').hide();
			}
		}
	});
	return false;
}


//PASSWORD RESET
function PasswordResetMailForm() {
	'use strict';

	document.getElementById('PasswordResetFormButton').disabled = true;
	document.getElementById('PasswordResetFormButton').innerHTML = magicai_localize.please_wait;
	Alpine.store('appLoadingIndicator').show();
	var email = $('#password_reset_email').val();
	if (email == '') {
		toastr.error(magicai_localize.missing_email);
		document.getElementById('PasswordResetFormButton').disabled = false;
		document.getElementById('PasswordResetFormButton').innerHTML = 'Send Instructions';
		Alpine.store('appLoadingIndicator').hide();
		return false;
	}

	var formData = new FormData();
	formData.append('email',email);

	$.ajax({
		type: 'post',
		url: '/forgot-password',
		data: formData,
		contentType: false,
		processData: false,
		success: function (data) {
			toastr.success(magicai_localize.password_reset_link);
			Alpine.store('appLoadingIndicator').hide();
		},
		error: function (data) {
			var err = data.responseJSON.errors;
			$.each(err, function (index, value) {
				toastr.error(value);
			});
			document.getElementById('PasswordResetFormButton').disabled = false;
			document.getElementById('PasswordResetFormButton').innerHTML = 'Send Instructions';
			Alpine.store('appLoadingIndicator').hide();
		}
	});
	return false;
}

function PasswordReset(password_reset_code) {
	'use strict';

	document.getElementById('PasswordResetFormButton').disabled = true;
	document.getElementById('PasswordResetFormButton').innerHTML = magicai_localize.please_wait;
	Alpine.store('appLoadingIndicator').show();

	var formData = new FormData();
	formData.append('password', $('#password_register').val());
	formData.append('password_confirmation', $('#password_confirmation_register').val());
	formData.append('password_reset_code', password_reset_code);

	$.ajax({
		type: 'post',
		url: '/forgot-password/save',
		data: formData,
		contentType: false,
		processData: false,
		success: function (data) {
			toastr.success(magicai_localize.password_reset_done);
			setTimeout(function () {
				location.href = '/dashboard';
				Alpine.store('appLoadingIndicator').hide();
			}, 1250);
		},
		error: function (data) {
			var err = data.responseJSON.errors;
			$.each(err, function (index, value) {
				toastr.error(value);
			});
			document.getElementById('PasswordResetFormButton').disabled = false;
			document.getElementById('PasswordResetFormButton').innerHTML = magicai_localize.password_reset;
			Alpine.store('appLoadingIndicator').hide();
		}
	});
	return false;
}

