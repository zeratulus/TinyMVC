let tinymceOptions = {
	selector: '[id^="input-description"]',
	height: 500,
	plugins: [
		'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
		'save table directionality emoticons template paste codemirror'
	],
	toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | code',
	extended_valid_elements : "script[charset|async|defer|language|src|type]",
	forced_root_block: false,
	codemirror: {
		indentOnInit: true, // Whether or not to indent code on init.
		fullscreen: true,   // Default setting is false
		path: 'codemirror-4.8', // Path to CodeMirror distribution
		config: {           // CodeMirror config object
			mode: 'text/html',
			lineNumbers: true
		},
		width: 1000,         // Default value is 800
		height: 600,        // Default value is 550
		saveCursorPosition: false,    // Insert caret marker
		jsFiles: [          // Additional JS files to load
			'mode/javascript/javascript.js',
			'mode/php/php.js',
			'mode/htmlmixed/htmlmixed.js'
		]
	}
};

$(document).ready(function () {
	$('.selectpicker').selectpicker({
		liveSearch: true
	});

	$('.select').selectpicker();

	$(window).on('resize', function () {
		$('.selectpicker').selectpicker('refresh');
	});

	//material design routine
	$('.col-sm-10').removeClass('col-sm-10').addClass('col-sm-12');
	$('.form-group').addClass('bmd-form-group');
	$('.btn-link').addClass('btn-primary').removeClass('btn-link');
	$('.table').addClass('table-striped');
	$('.table tbody td:last-child .btn').wrap('<div class="d-flex justify-content-center flex-wrap"></div>');

	//Init material design for input type="radio"
	$('input[type="radio"]').after('<span class="bmd-radio"></span>');

	//Add checkbox wrapper to table checkboxes
	$('.table input[type="checkbox"]').wrap('<div class="checkbox"><label></label></div>');

	//Init material design for input type="checkbox"
	$('input[type="checkbox"]').after('<span class="checkbox-decorator"><span class="check"></span></span>');

	//Init Ripple Click Effect for next elements
	$('.bootstrap-select, input[type=submit], input[type=reset], input[type=button], button, a').rippleEffect();

	//Select all checkboxes in lists
	$('#chk-select-all').on('click', function (e) {
		$('input[name*=\'selected\']').prop('checked', this.checked);
	});

	$('.breadcrumb .breadcrumb-item').last().addClass('active');

	$(window).on('scroll', function () {
		if (screen.width >= 768) {
			let tools = $('.tool-panel');
			if (typeof tools != 'undefined') {
				if (window.pageYOffset > tools.position().top) {
					if (tools.hasClass('fixed') == false) {
						tools.addClass('fixed');
					}
				} else {
					tools.removeClass('fixed');
				}
			}
		}
	});
});