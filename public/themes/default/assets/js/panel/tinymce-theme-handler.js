function liquidTinyMCEThemeHandler( editor ) {
	const body = document.body;
	const iframeBody = editor.contentDocument.body;

	if ( editor.targetElm?.closest('.lqd-tinymce-toolbar-fixed') ) {
		editor.contentDocument && (editor.contentDocument.documentElement.style.height = '100%');
		iframeBody.classList.add('lqd-generator-v2');
		iframeBody.style.height = '100%';
		iframeBody.style.margin = '0';
	}

	const bodyStyle = window.getComputedStyle( body );
	const cssFontProps = [
		'font-family',
		'font-size',
		'line-height',
		'font-weight',
		'font-style',
		'color'
	];
	const cssFontPropsVar = [
		'--headings-font-family',
		'--headings-font-size',
		'--headings-line-height',
		'--headings-font-weight',
		'--headings-font-style',
		'--headings-text-transform',
		'--headings-letter-spacing',
		'--headings-color',
	];

	for( let i = 1; i <= 6; i++ ) {
		cssFontPropsVar.push(`--h${i}-font-family`);
		cssFontPropsVar.push(`--h${i}-font-size`);
		cssFontPropsVar.push(`--h${i}-line-height`);
		cssFontPropsVar.push(`--h${i}-font-weight`);
		cssFontPropsVar.push(`--h${i}-font-style`);
		cssFontPropsVar.push(`--h${i}-text-transform`);
		cssFontPropsVar.push(`--h${i}-letter-spacing`);
		cssFontPropsVar.push(`--h${i}-color`);
	}

	cssFontProps.forEach( prop => {
		iframeBody.style[ prop ] = bodyStyle[ prop ];
	} );

	cssFontPropsVar.forEach( prop => {
		iframeBody.style.setProperty( prop, bodyStyle.getPropertyValue( prop ) );
	});
}

function liquidTinyMCEThemeHandlerInit( editor ) {
	editor.on('init', function() {
		liquidTinyMCEThemeHandler( editor );

		// Wait for Alpine.js to be ready before setting up watch
		if (window.Alpine && Alpine.store && Alpine.store('darkMode')) {
			Alpine.watch(
				() => Alpine.store('darkMode').on,
				() => {
					liquidTinyMCEThemeHandler( editor );
				}
			);
		} else {
			// Fallback: check for Alpine every 100ms until it's ready
			const checkAlpine = setInterval(() => {
				if (window.Alpine && Alpine.store && Alpine.store('darkMode')) {
					clearInterval(checkAlpine);
					Alpine.watch(
						() => Alpine.store('darkMode').on,
						() => {
							liquidTinyMCEThemeHandler( editor );
						}
					);
				}
			}, 100);
			// Stop checking after 5 seconds
			setTimeout(() => clearInterval(checkAlpine), 5000);
		}
	});
}