// Make LoginForm available globally
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

	
	// Ajax Post
	$.ajax({
		type: 'post',
		url: '/login',
		data: formData,
		contentType: false,
		processData: false,
		cache: false,
		beforeSend: function() {
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

document.addEventListener('DOMContentLoaded', function() {
	'use strict';
	
	// Any DOM-ready initialization code can go here
	console.log('Login/Register JS loaded');
});

