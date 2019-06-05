<?php 
	/*show a single gallery image */
	$fixedheight = isset($options["image_height"])?$options["image_height"]:false;
	//_dump($fixedheight);

	$imgclass="vertical";
	if($options["image-width"]>$options["image-height"]) $imgclass="horizontal";
?>
	<figure itemprop="associatedMedia">
		<?php if($options["lightbox"]){ ?>
			<a class="biglink venobox" href='<?=$image["url"]?>' rel="<?=$options["galID"]?>" data-overlay="<?=$options["color"]?>" data-gall="<?=$options["galID"]?>" data-image-index="<?=$image["index"]?>" title="<?=$image["title"]?>">
		<?php } ?>
				<div  class="imgwrap">
					<img src='<?=$options["image-url"]?>' class='<?=$imgclass?>' width="<?=$options["image-width"]?>" height="<?=$options["image-height"]?>" data-original-src-width="<?=$image["width"]?>" data-original-src-height="<?=$image["height"]?>" title="<?=$image["title"]?>" alt="<?=$image["alt"]?>"  />
				</div>
				
		<?php if($options["lightbox"]){ ?>
				<div  class="view-icon"><?=_icon("icon_zoom")?></div>
			</a>
		<?php } ?> 
	</figure>
