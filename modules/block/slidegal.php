<script src='js/jquery-1.2.6.min.js' type='text/javascript'></script>
<script src='js/jquery.jcarousel.pack.js' type='text/javascript'></script>
<script src='js/jquery-ui-personalized-1.5.2.packed.js' type='text/javascript'></script>
<script type="text/javascript">
jQuery(document).ready(function() {          
	jQuery('#mycarousel').jcarousel({         
	wrap:"both",          
	scroll:2,          
	animation:"slow"  
});

	function mycarousel_initCallback(carousel) {          
		jQuery('#featured-next-button').bind('click', function() {                  
			carousel.next();                  
			return false;          
	});          
	jQuery('#featured-prev-button').bind('click', function() {                  
		carousel.prev();                  
		return false;          
	});          
	jQuery('.button-nav span').bind('click', function() {                  
		carousel.scroll(jQuery.jcarousel.intval(jQuery(this).text()));                  
		return false;          
	});  
};          
jQuery('#feature-carousel').jcarousel({          
	wrap:"both",          
	scroll:1,         
	auto:10,          
	initCallback: mycarousel_initCallback,          
	buttonNextHTML: null,          
	buttonPrevHTML: null  
});
});
</script>
<style type="text/css">
.jcarousel-skin-tango .jcarousel-container {-moz-border-radius: 10px;}
.jcarousel-skin-tango .jcarousel-container-horizontal {width: 770px;margin: 0 auto;padding:0 2px;}
.jcarousel-skin-tango .jcarousel-clip-horizontal {width: 770px;height: 176px;}
.jcarousel-skin-tango .jcarousel-item {width: 146px;height: 176px;}
.jcarousel-skin-tango .jcarousel-item-horizontal {margin-right: 10px;}
.jcarousel-skin-tango .jcarousel-item-placeholder {background: #fff;color: #000;}
.jcarousel-skin-tango .jcarousel-next-horizontal {
	background:transparent url(images/image-slider-button.png) no-repeat scroll -32px 0;
	cursor:pointer;
	height:176px;
	right:2px;
	position:absolute;
	top:0;
	width:32px;
}

.jcarousel-skin-tango .jcarousel-prev-horizontal {
	background:transparent url(images/image-slider-button.png) no-repeat scroll 0 0;
	cursor:pointer;
	height:176px;
	left:2px;
	position:absolute;
	top:0;
	width:32px;
}

.jcarousel-container {position: relative;}
.jcarousel-clip {z-index: 1;padding: 0;margin: 0;overflow: hidden;position: relative;}
.jcarousel-list {z-index: 1;overflow: hidden;position: relative;top: 0;left: 0;margin: 0;padding: 0;}
.jcarousel-list li,.jcarousel-item {float: left;list-style: none;width: 75px;height: 75px;}
.jcarousel-next {z-index: 2;display: none;}
.jcarousel-prev {z-index: 2;display: none;}

#news-slider{background-color:#FFFFFF;padding:2px 0;}
#news-slider img{border:none;height:176px;width:146px;}
</style>
<center>
	<table cellpadding="0" cellspacing="0" class="iconframe" width="770">
		<tbody>
			<tr>
				<td class="imageframe" width="770">
					<?opentablemod();?>
					<table align="center" border="0" cellpadding="0" cellspacing="0" width="770">
						<tbody>
							<tr>
								<td>
									<div id='news-slider'>
									<ul class='jcarousel-skin-tango' id='mycarousel'>
											<? 
											$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
											$limit = 10; 
											$res['gallerys'] = $db->select_query("SELECT * FROM ".TB_GALLERY." ORDER BY id DESC LIMIT $limit"); while($arr['gallerys'] = $db->fetch($res['gallerys'])){ 
											$res['cat'] = $db->select_query("SELECT * FROM ".TB_GALLERY_CAT." WHERE id='".$arr['gallerys']['category']."' "); 
											$arr['cat'] = $db->fetch($res['cat']); 
											$CAT=$arr['cat']['post_date']; 
												?>
											<li>
												<a href="index.php?name=gallery&amp;file=readgal&amp;id=<?=$arr['gallerys']['id'];?>"><img border="0" src="images/gallery/gal_<? echo "".$CAT."/".$arr['gallerys']['pic'];?>" style="filter:alpha(opacity=50)" onMouseover="makevisible(this,0)" onMouseout="makevisible(this,1)"/>
												</a>
											</li>
											<?
											}
											?>
										</ul>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<?closetablemod();?>
					</td>
			</tr>
		</tbody>
	</table>
</center>
