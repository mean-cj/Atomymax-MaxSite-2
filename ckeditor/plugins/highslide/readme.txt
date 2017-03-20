/*********************************************************************************************************/
/**
 * highslide plugin for CKEditor 3.x (Author: Lajox ; Email: lajox@19www.com)
 * CKEditor 3.x Highslide JS plugin
 * version:	 1.0
 * Released: On 2009-12-11
 * Download: http://code.google.com/p/lajox
 */
/*********************************************************************************************************/

/**************************************************************************************************************
highslide plugin for CKEditor 3.x

 --CKEditor 3.x Highslide JS plugin ( No border and a floating caption )

Plugin Description： CKEditor 3.x Highslide JS plugin 1.0 ( No border and a floating caption )

related: 
Highslide 4.1.8  ( http://highslide.com ) 
CKEditor 3.x

***************************************************************************************************************/

/**************Help Begin***************/

1. Upload highslide folder to  ckeditor/plugins/

2. Configured in the ckeditor/config.js :
    Add to config.toolbar a value 'highslide'
e.g. 

config.toolbar = 
[
    [ 'Source', '-', 'Bold', 'Italic', 'highslide' ]
];


3. Again Configured in the ckeditor/config.js ,
   Expand the extra plugin 'highslide' such as:

config.extraPlugins='myplugin1,myplugin2,highslide';


4. Modify highslide/js/main.js Content:
   Just the line: 
	hs.graphicsDir = '/editor/custom/ckeditor/plugins/highslide/js/graphics/';


5. Modify the default language in highslide/plugin.js
	Just the line:
		lang : ['en'],

/**************Help End***************/


