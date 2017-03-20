/*********************************************************************************************************/
/**
 * highslide plugin for CKEditor 3.x (Author: Lajox ; Email: lajox@19www.com)
 * CKEditor 3.x Highslide JS plugin
 * version:	 1.0
 * Released: On 2009-12-11
 * Download: http://code.google.com/p/lajox
 */
/*********************************************************************************************************/

CKEDITOR.dialog.add("highslide",function(e){

	return {
		title:e.lang.highslide.title,
		resizable : CKEDITOR.DIALOG_RESIZE_BOTH,
		minWidth:300,
		minHeight:100,
		onShow:function(){ 
		},
		onLoad:function(){ 
				dialog = this; 
				this.setupContent();
		},
		onOk:function(){
		},
		contents:[
		{		id:"info",
				name:'info',
				label:e.lang.highslide.commonTab,
				elements:[
					{  
						type:'html',
						html:'<span>'+CKEDITOR.tools.htmlEncode(e.lang.highslide.SetHsJsInfo)+'</span>'
					},
					{  
						type:'button',
						id:'SetHsJsBtn',
						label:e.lang.highslide.SetHsJsInfoBtn,
						onClick: function(){makeHS();}
					},
					{  
						type:'html',
						html:'<span id=msgok style="display:none;">'+e.lang.highslide.SetHsJsOK+'</span>'
					}
				]
		}
		],
		buttons:[CKEDITOR.dialog.cancelButton]
	};

function makeHS(){

var highslideJS      = CKEDITOR.basePath +"plugins/highslide/js/highslide.js";
var highslideCSS     = CKEDITOR.basePath +"plugins/highslide/js/highslide.css";
var highslideMainJS  = CKEDITOR.basePath +"plugins/highslide/js/main.js";

var JSVar ="";
JSVar  = '<scr' + 'ipt type="text/javascript" src="'+ highslideJS +'"></scr' + 'ipt>\r\n';
JSVar += '<link rel="stylesheet" type="text/css" href="'+highslideCSS+'" />\r\n';
JSVar += '<scr' + 'ipt type="text/javascript" src="'+ highslideMainJS +'"></scr' + 'ipt>\r\n';
JSVar += '<div class="highslide-gallery">\r\n';

var str= "";

//var ckdata="";
//ckdata=CKEDITOR.instances['content'];
//ckdata = CKEDITOR.instances.content;
//str = ckdata.getData();

str = e.getData();

str = str.replace(/^|(<a\b[^>]*>)?\s*(<img\b[^/>]*(?:src=("[^"]*"|'[^']*'|\S+))[^>]*>)\s*(?:<\/a>)?/ig, function() {
    var $ = arguments;
    if ($[0].length) {
        return [
            '<a href=' + $[3] + ' class="highslide" onclick="return hs.expand(this)">'
            , '<img src=' + $[3] + ' alt="Highslide JS" title="Click to enlarge image"></a>'
            , '<div class="highslide-heading">&nbsp;</div>'
        ].join("\r\n");
    } else {return JSVar;}
});

e.setData(str);

CKEDITOR.document.getById('msgok').setStyle('display','block');
//CKEDITOR.document.getById('msgok').setHtml('');
//setTimeout(makeHS(),3000);

};


});

