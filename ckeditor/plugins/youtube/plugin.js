CKEDITOR.plugins.add('youtube',{
    requires: ['iframedialog'],
    init:function(editor){

           var me = this;
           CKEDITOR.dialog.add( 'MediaEmbedDialog', function ()
           {
              return {
                 title : 'Embed YouTube Video Dialog',
                 minWidth : 550,
                 minHeight : 200,
                 contents :
                       [
                          {
                             id : 'iframe',
                             label : 'Embed Media',
                             expand : true,
                             elements :
                                   [
                                      {
						               type : 'html',
						               id : 'pageMediaEmbed',
						               label : 'Embed YouTube Video',
						               style : 'width : 100%;',
						               html : '<iframe src="'+me.path+'/dialogs/youtube.html" frameborder="0" name="iframeMediaEmbed" id="iframeMediaEmbed" allowtransparency="1" style="width:100%;margin:0;padding:0;"></iframe>'
						              }
                                   ]
                          }
                       ],
                 onOk : function()
                 {
					for (var i=0; i<window.frames.length; i++) {
try {
					   if(window.frames[i].name == 'iframeMediaEmbed') {
					             var url = window.frames[i].document.getElementById("url").value;
					             url = url.replace(/.*?v=(.*)$/, 'http://www.youtube.com/v/$1&hl=en_US&fs=1&');
  					           var width = window.frames[i].document.getElementById("width").value;
  					           var height = window.frames[i].document.getElementById("height").value;
					      break;
					   }
} catch (e) {}					   
					}
  					       this._.editor.insertHtml('<object width="' + width + '" height="' + height + '"><param name="movie" value="' + url + '"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="' + url + '" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="' + width + '" height="' + height + '"></embed></object>');
                 }
              };
           } );

            editor.addCommand( 'youtube', new CKEDITOR.dialogCommand( 'MediaEmbedDialog' ) );

            editor.ui.addButton( 'youtube',
            {
                label: 'Embed YouTube Video',
                command: 'youtube',
                icon: this.path + 'images/icon.gif'
            } ); 

    }
})