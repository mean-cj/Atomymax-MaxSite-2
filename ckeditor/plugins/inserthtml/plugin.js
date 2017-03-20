/*********************************************************************************************************/
/**
 * inserthtml plugin for CKEditor 3.x (Author: Lajox ; Email: lajox@19www.com)
 * Insert Html Code
 */
/*********************************************************************************************************/

CKEDITOR.plugins.add('inserthtml',   
  {    
    requires: ['dialog'],
	lang : ['en'], 
    init:function(a) { 
	var b="inserthtml";
	var c=a.addCommand(b,new CKEDITOR.dialogCommand(b));
		c.modes={wysiwyg:1,source:0};
		c.canUndo=false;
	a.ui.addButton("inserthtml",{
					label:a.lang.inserthtml.title,
					command:b,
					icon:this.path+"inserthtml.gif"
	});
	CKEDITOR.dialog.add(b,this.path+"dialogs/inserthtml.js")}
});