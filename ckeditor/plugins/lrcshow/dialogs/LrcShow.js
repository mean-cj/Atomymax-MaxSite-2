/*********************************************************************************************************/
/**
 * lrcshow plugin for CKEditor 3.x (Author: Lajox ; Email: lajox@19www.com)
 * Music Player with Lyrics Rolling
 */
/*********************************************************************************************************/

CKEDITOR.dialog.add("lrcshow",function(e){
   var escape = function( value ) {   
        return value   
            .replace(/&/g, '&amp;')   
            .replace(/ /g, '%20') 
    ;   
    };   
	
	return{
		title:e.lang.lrc.title,
		resizable : CKEDITOR.DIALOG_RESIZE_BOTH,
		minWidth:350,
		minHeight:200,
		onShow:function(){ 
		},
		onLoad:function(){ 
				dialog = this; 
				this.setupContent();
		},
		onOk:function(){
			var MusicUrl=this.getValueOf('info','MusicUrl');   
			var PlayerType=this.getValueOf('info','PlayerType');
			var LrcUrl=this.getValueOf('info','LrcUrl');
			var AutoStart=this.getValueOf('info','AutoStart');
			var RepeatPlay=this.getValueOf('info','RepeatPlay');

			//MusicUrl = escape(MusicUrl);
			//MusicUrl = encodeURIComponent(sMusicUrl);
			MusicUrl = encodeURI(MusicUrl);

			var Player="wmp";
			if(PlayerType=="Media Player") Player="wmp";
			if(PlayerType=="Real Player") Player="rmp";

			var Auto="no";
			var Loop="no";
			if(AutoStart) Auto="yes";
			if(RepeatPlay) Loop="yes";

			var LrcPath=CKEDITOR.basePath + "/plugins/lrcshow/lrc.php"; //播放器文件地址

			var sInsert="";
			sInsert+="<iframe ";
			sInsert+="src=\""+LrcPath+"?url="+MusicUrl+"&player="+Player+"&lrc="+LrcUrl+"&auto="+Auto+"&loop="+Loop+"\" ";
			sInsert+="width=\"400\" height=\"295\" scrollbar=\"no\" scrolling=\"no\"  border=\"0\" frameborder=\"0\">";
			sInsert+="<font color=red>error! your browser does not support iframe</font>";
			sInsert+="</iframe>";

			e.insertHtml(sInsert); 
		},
		contents:[
			{	id:"info",
				name:'info',
				label:e.lang.lrc.commonTab,
				accessKey:"S",
				elements:[

				{
				type:'vbox',
				padding:0,
				children:[
				 {type:'html',
				  html:'<span>'+CKEDITOR.tools.htmlEncode(e.lang.lrc.MusicUrlInfo)+'</span>'
				 },
				 {type:'hbox',
				  widths:['250px','110px'],
				  align:'right',
				  children:[
				    {
				     type:'text',
				     id:'MusicUrl',
					 label:'',
					 onChange:function(){
										var q=this.getDialog(),
										r=this.getValue();
										if(r.length>0){
										}
										else {}
				     },
					 setup:function(q,r){},
					 commit:function(q,r){},
					 validate:CKEDITOR.dialog.validate.notEmpty(e.lang.lrc.MusicUrlMissing)
					},
					{
					 type:'button',
					 id:'browse',
					 align:'center',
					 label:e.lang.common.browseServer,
					 hidden:true,
					 filebrowser:'info:MusicUrl'
					 }
					]
				 }
				 ]
				},				

				{   
					type : 'select',   
					label : e.lang.lrc.PlayerType,   
					id : 'PlayerType',   
					items :   
					[   
					[ 'Media Player' ],   
					[ 'Real Player' ]
					],
					'default' : 'Media Player'					
				},

				{
				type:'vbox',
				padding:0,
				children:[
				 {type:'html',
				  html:'<span>'+e.lang.lrc.LyricsUrlInfo+'</span>'
				 },
				 {type:'hbox',
				  widths:['250px','110px'],
				  align:'right',
				  children:[
				   {type:'text',
				    id:'LrcUrl',
					label:'',
					onChange:function(){},
					setup:function(q,r){},
					commit:function(q,r){}
					},
					{type:'button',
					 id:'browse',
					 align:'center',
					 label:e.lang.common.browseServer,
					 hidden:true,
					 filebrowser:'info:LrcUrl'
					 }
					]
				 }
				 ]
				},				

				{
				type:'vbox',
				padding:0,
				style:"width:250px;",
				children:[
				 {type:'html',
				  html:'<span>'+e.lang.lrc.OtherInfo+'</span>'
				 },
				 {type:'hbox',
				  widths:['110px','110px'],
				  align:'right',
				  children:[
					{  
					type : 'checkbox', 
					label : e.lang.lrc.AutoStart, 
					id : 'AutoStart', 
					style : '',    					
					'default' : ''
					},
					{  
					type : 'checkbox', 
					label : e.lang.lrc.RepeatPlay, 
					id : 'RepeatPlay', 
					style : '',    					
					'default' : ''
					}
					]
				 }
				 ]
				}

				]
			}
			/*
			,{	id:"advanced",
				name:'adv',
				label:e.lang.lrc.advancedTab,
				accessKey:"A",
				elements:[]
			}
			*/
		]
	}
});