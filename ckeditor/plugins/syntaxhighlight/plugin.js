/*********************************************************************************************************/
/**
 * Syntax Highlighter plugin for CKEditor 3.x (Author: Lajox ; Email: lajox@19www.com)
 * Insert/Edit Syntax Highlighter code snippet
 */
/*********************************************************************************************************/

CKEDITOR.plugins.add('syntaxhighlight',   
  {    
    requires: ['dialog'],
	lang : ['en'], 
    init:function(a) { 
	var b="syntaxhighlight";
	var c=a.addCommand(b,new CKEDITOR.dialogCommand(b));
		c.modes={wysiwyg:1,source:0};
		c.canUndo=false;
	a.ui.addButton("syntaxhighlight",{
					label:a.lang.syntaxhighlight.title,
					command:b,
					icon:this.path+"images/syntaxhighlight.gif"
	});
	CKEDITOR.dialog.add(b,this.path+"dialogs/syntaxhighlight.js")}
});
