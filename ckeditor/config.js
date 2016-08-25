/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/
CKEDITOR.on( 'instanceReady', function( ev ){// Out self closing tags the HTML4 way, like//ev.editor.dataProcessor.writer.selfClosingEnd = '>';ev.editor.dataProcessor.writer.setRules( 'p',{indent : false,breakBeforeOpen : true,breakAfterOpen : false,breakBeforeClose : false,breakAfterClose : true});});
CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
};
