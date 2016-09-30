/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'tools' },
		{ name: 'undo'},
		{ name: 'clipboard', groups: [ 'clipboard' ] },
		{ name: 'forms' },
		'/',
		{ name: 'basicstyles'},
		{ name: 'insert', groups: ['insert', 'others'] },
		{ name: 'links'},
		{ name: 'paragraph', groups: [ 'list', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	//config.removeButtons = 'Table,SpecialChar,HorizontalRule,Underline,Subscript,Superscript,Strike';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';
	//config.allowedContent =
	//	'h1 h2 h3 p[id,name] blockquote strong em;' +
	//	'a[!href];' +
	//	'img(left,right)[!src,alt,width,height];';
	//config.extraAllowedContent = 'p[name,id];h1[name,id];h2[name,id];h3[name,id];pre[name,id]';

	// Simplify the dialog windows.
	config.removeDialogTabs = '';

	CKEDITOR.config.simpleImageBrowserURL = '/' + window.admin.prefix + '/assets/images/all';
	CKEDITOR.config.language = window.admin.locale;
	config.filebrowserImageUploadUrl = '/' + window.admin.prefix + '/assets/images/upload';

	config.filebrowserBrowseUrl = '/packages/JASFinder/index.html';
	//config.filebrowserImageBrowseUrl ='/ckfinder/ckfinder.html?type=Images';
	//config.filebrowserUploadUrl = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	//config.filebrowserImageUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'

	//config.extraPlugins = 'link';

	$.extend(config, window.admin.ckeditor_cfg);
};
