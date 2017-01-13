/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.toolbar = 'Full';
    config.uiColor = '#939393';
	config.language = 'zh-cn';
	config.width = "946px";
	config.height = "240px";
	config.skin = "Moono_blue";
	config.toolbarCanCollapse = true;
	config.toolbarStartupExpanded = true;
	config.baseHref = '';
	config.toolbar_Full = [
	                       ['Source','-','Save','NewPage','Preview','-','Templates'],
	                       ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print','SpellChecker', 'Scayt'],
	                       ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
	                       ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	                        '/',
	                       ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
	                       ['Styles','Format','Font','FontSize'],
	                       ['TextColor','BGColor']
	                     ];
	
	config.filebrowserImageUploadUrl = 'http://z.jd.com/ckeditor/upload.action?type=Image';
	config.filebrowserFlashUploadUrl = 'http://z.jd.com/ckeditor/upload.action?type=Flash';
	/**
	config.toolbar_Full = [
	                      ['Source','-','Save','NewPage','Preview','-','Templates'],
	                       ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print','SpellChecker', 'Scayt'],
	                       ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
	                       ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select','Button', 'ImageButton', 'HiddenField'],
	                        '/',
	                       ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
	                        ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
	                        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	                        ['Link','Unlink','Anchor'],
	                       ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
	                       '/',
	                         ['Styles','Format','Font','FontSize'],
	                        ['TextColor','BGColor']
	                     ];
   */
};
