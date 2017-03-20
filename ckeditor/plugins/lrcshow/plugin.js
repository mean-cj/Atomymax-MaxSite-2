/*********************************************************************************************************/
/**
 * lrcshow plugin for CKEditor 3.x (Author: Lajox ; Email: lajox@19www.com)
 * Music Player with Lyrics Rolling
 */
/*********************************************************************************************************/

CKEDITOR.plugins.add('lrcshow',   
  {    
    requires: ['dialog'],
	lang : ['en'], 
    init:function(a) { 
	var b="lrcshow";
	var c=a.addCommand(b,new CKEDITOR.dialogCommand(b));
		c.modes={wysiwyg:1,source:0};
		c.canUndo=false;
	a.ui.addButton("lrcshow",{
					label:a.lang.lrc.title,
					command:b,
					icon:this.path+"images/lrcshow.gif"
	});
	CKEDITOR.dialog.add(b,this.path+"dialogs/LrcShow.js")}
});