<?php
	/*show a single gallery video */
	$args=array(
		"controls"=>"2"
	);

	
?>
<div class="video-container">
	<a class="venobox biglink" data-vbtype="video" data-autoplay="true"  title="<?=$video["title"]?>"data-overlay="<?=$options["color"]?>" data-gall="<?=$options["galID"]?>" href="<?=$video["video_url"]?>">
		<?php $url= get_video_thumbnail_from_url($video["video_url"]); ?>

		<div  class="imgwrap">
			<img src="<?=$url?>" />
		</div>

		<div  class="view-icon"><?=_icon("icon_video_play")?></div>

	</a>

	<?php  // echo wp_oembed_get($video["video_url"],$args); ?>
</div>
<?php
	