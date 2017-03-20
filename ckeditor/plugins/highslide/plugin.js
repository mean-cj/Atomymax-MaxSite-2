/*********************************************************************************************************/
/**
 * highslide plugin for CKEditor 3.x (Author: Lajox ; Email: lajox@19www.com)
 * CKEditor 3.x Highslide JS plugin
 * version:	 1.0
 * Released: On 2009-12-11
 * Download: http://code.google.com/p/lajox
 */
/*********************************************************************************************************/

CKEDITOR.plugins.add('highslide',   
  {    
    requires: ['dialog'],
	lang : ['en'], 
    init:function(a) { 
	var b="highslide";
	var c=a.addCommand(b,new CKEDITOR.dialogCommand(b));
		c.modes={wysiwyg:1,source:0};
		c.canUndo=false;
	a.ui.addButton("highslide",{
					label:a.lang.highslide.title,
					command:b,
					icon:this.path+"hs.gif"
	});
	CKEDITOR.dialog.add(b,this.path+"dialogs/hs.js")}
});