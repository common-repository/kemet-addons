/**
 * Kemet Customizer settings
 */
(function ($) {
	/**
	 * Setup the flow.
	 */
	function init() {
		customizerKmtButtons();
	}

	/**
	 * Reset button
	 */
	function customizerKmtButtons() {
		var $buttonsContainer = $('<div class="kmt-customizer-reset-footer"></div>');

		var $exportButton = $(
			'<a href="' + kmtResetCustomizerObj.customizerUrl + '?action=customizer_export&nonce=' + kmtResetCustomizerObj.nonces.export + '" class="button customizer-export-import customizer-export-link"><span class="customizer-export-import-hint">' + kmtResetCustomizerObj.buttons.export.text + '</span></a>'
		);

		var $importButton = $(
			'<button href="" class="button customizer-export-import customizer-import-trigger"><span class="customizer-export-import-hint">' + kmtResetCustomizerObj.buttons.import.text + '</span></button>'
		);

		var $resetButton = $(
			'<button name="kmt-customizer-reset" class="button kmt-customizer-reset-button">' + kmtResetCustomizerObj.buttons.reset.text + '</button>'
		);

		$resetButton.on('click', resetCustomizer);
		$importButton.on('click', openImportForm);


		$buttonsContainer.append($exportButton);
		$buttonsContainer.append($importButton);
		$buttonsContainer.append($resetButton);

		$('#customize-footer-actions').prepend($buttonsContainer);

		$('.kmt-customizer-reset-footer').append(kmtResetCustomizerObj.importForm.templates);

		$('.customizer-import-form .close').on('click', closeImportForm);
		$('.customizer-import-form').on('submit', showImportWarning);
	}

	/**
	 * Reset customizer.
	 * 
	 * @param Event e Event object.
	 */
	function resetCustomizer(e) {
		e.preventDefault();

		if (!confirm(kmtResetCustomizerObj.message.resetWarning)) return;

		this.disabled = true;

		$.ajax({
			type: 'post',
			url: ajaxurl,
			data: {
				wp_customize: 'on',
				action: 'customizer_reset',
				nonce: kmtResetCustomizerObj.nonces.reset
			}
		}).done(function (r) {
			if (!r || !r.success) return;

			wp.customize.state('saved').set(true);
			location.reload();
		}).always(function () {
			this.disabled = false;
		});
	}

	function openImportForm(e) {
		e.preventDefault();
		$('.customizer-import-form').addClass('is-expanded');
	}

	function closeImportForm(e) {
		e.preventDefault();
		$('.customizer-import-form').removeClass('is-expanded');
	}

	function showImportWarning(e) {
		e.preventDefault();

		if (confirm(kmtResetCustomizerObj.message.importWarning)) this.submit();
	}

	// Start!
	init();

})(jQuery);