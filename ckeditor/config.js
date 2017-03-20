/*
Copyright (c) 2003-2009, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{

config.HtmlEncodeOutput = true;
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.language = 'th';
	config.defaultLanguage = 'en';
	// config.uiColor = '#AADC6E';
	config.skin = 'office2003';

config.toolbar = 
[
    ['Source','-','Save','NewPage','Preview','-','Templates'],
    ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
    ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],'/',
    ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton',  'HiddenField'],['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
    '/',
    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    ['Link','Unlink','Anchor'],
    '/',
    ['Styles','Format','Font','FontSize'],['TextColor','BGColor'],['Maximize','ShowBlocks','-','About'],'/',
	['syntaxhighlight','inserthtml','lrcshow','highslide','youtube']
];

config.toolbar_Full =
[
    ['Source','-','Save','NewPage','Preview','-','Templates'],
    ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
    ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],'/',
    ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton',  'HiddenField'],['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
    '/',
    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    ['Link','Unlink','Anchor'],
    '/',
    ['Styles','Format','Font','FontSize'],['TextColor','BGColor'],['Maximize','ShowBlocks','-','About'],'/',
	['syntaxhighlight','inserthtml','lrcshow','highslide','youtube']
];

config.toolbar_Basic =
[
	['Save'],['Undo','Redo'],
	['Bold','Italic','Underline','StrikeThrough','Blockquote','Subscript', 'Superscript'],
	['TextColor','BGColor'],['OrderedList','UnorderedList'],['Link','Unlink','Smiley'],['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull','FontSize', 'FontFormat','FontName'],['Image','Flash'],'/',
    ['Maximize','ShowBlocks','-','About'],['syntaxhighlight','inserthtml','lrcshow','highslide','youtube']
];

config.toolbar_Mini =
[
	['Bold','Italic','Underline','StrikeThrough','Blockquote','Subscript', 'Superscript'],
	['TextColor','BGColor'],['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull','FontSize', 'FontFormat','FontName'],['Maximize','ShowBlocks','-','About']
];

config.toolbar_AdminBasic =
[
	['Source','-','Save','NewPage','Preview','-','Templates'],
	['Undo','Redo'],
	['Bold','Italic','Underline','StrikeThrough','Blockquote','Subscript', 'Superscript'],
	['TextColor','BGColor'],
	['OrderedList','UnorderedList'],
	['Link','Unlink','Smiley'],
	['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull','FontSize', 'FontFormat','FontName'],'/',
    ['Maximize','ShowBlocks','-','About'],['syntaxhighlight','inserthtml','lrcshow','highslide','youtube']
];
//config.entities=false;
config.shiftEnterMode = CKEDITOR.ENTER_P;
config.enterMode = CKEDITOR.ENTER_BR;
config.autoParagraph = false;
config.fillEmptyBlocks = false; 
config.IgnoreEmptyParagraphValue = true; 

config.extraPlugins = 'syntaxhighlight,inserthtml,lrcshow,highslide,youtube';

config.filebrowserBrowseUrl = 'ckfinder/ckfinder.html';
config.filebrowserImageBrowseUrl = 'ckfinder/ckfinder.html?type=Images';
config.filebrowserFlashBrowseUrl = 'ckfinder/ckfinder.html?type=Flash';
config.filebrowserUploadUrl = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
config.filebrowserImageUploadUrl = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
config.filebrowserFlashUploadUrl = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';


} 
