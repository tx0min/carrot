<?php
	

	$color=$options["color"];
	$images=$options["images"];
	$view=$options["view"];
	$cols=$options["cols"];
	$gutter=$options["gutter"];
	$lightbox=$options["lightbox"];
	$bordered=$options["bordered"];
	$thumbsize=$options["thumbsize"];
	
	$shownav=$options["shownav"];
	$showpagination=$options["showpagination"];
	$showpause=$options["showpause"];
	$autoplay=$options["autoplay"];
	$loop=$options["loop"];
	$pause_on_hover=$options["pause_on_hover"];
	$lazyload=isset($options["lazyload"])?$options["lazyload"]:false;
	
	
	$timeout=$options["timeout"];
	$speed=$options["speed"];

	$items=$options["items"];
	$itemsresponsive=$options["itemsresponsive"];
	$page_slide=$options["page_slide"];

	$drag=$options["drag"];
	$slide_effect=$options["slide_effect"];
	$valign=$options["valign"];

	$options["galID"]= "image-gallery-".get_the_ID()."-".uniqid();

	//_dump($options);

	$fixedheight = isset($options["image_height"])?$options["image_height"]:false;
	
	if($images && count($images)>0){
?>


	<div id="<?=$options["galID"]?>" class="image-gallery loading gallery-<?=$view?>  <?=$bordered?"bordered":""?>  <?=$view=="grid"?"grid":""?> gap-<?=$gutter?> cols-<?=$cols?> clearfix <?=$fixedheight?'gallery-fixedheight':''?>"  
		data-color="<?=$color?>" 
		data-cols="<?=$cols?>" 
		data-gap="<?=$gutter?>"

		data-show-nav="<?=$shownav?"true":"false"?>"
		data-show-pagination="<?=$showpagination?"true":"false"?>"
		data-show-pause="<?=$showpause?"true":"false"?>"
		
		
		data-autoplay='<?=$autoplay?"true":"false"?>'   
		data-loop="<?=$loop?"true":"false"?>"   
		data-autoplay-hover-pause="<?=$pause_on_hover?"true":"false"?>"
		data-autoplay-timeout="<?=$timeout?>"
		data-smart-speed="<?=$speed?>"
		
		data-nav="<?=$shownav?"true":"false"?>"
		data-dots="<?=$showpagination?"true":"false"?>"
		data-items="<?=$items?>"
		data-items-responsive="<?=$itemsresponsive?>"
		
		data-slide-by="<?=$page_slide?"page":"1"?>"
		data-touch-drag="<?=$items?>"
		data-mouse-drag="<?=$drag?>"
		data-fx="<?=$slide_effect?>"
		data-valign="<?=$valign?>"
		data-auto-height="<?=$fixedheight?'false':'true'?>" 
		data-lazy-load="<?=$lazyload?>"
		<?php if($lazyload){?>
			data-lazy-load-eager="3"
		<?php } ?>
		
		<?=$fixedheight?"data-fixed-height='".$fixedheight."'":''?> 
		 >
		<div class="gallery-loader"><?=_icon("icon_loading","fa-spin")?></div>
			
			<?php
				if($view=="grid" ){
			?>
			<div class='grid-sizer'></div>
			<div class='gutter-sizer'></div>
				
			<?php
				}else if($view=="hscroll" || $view=="slider"){
			?>
				<div class='images-wrapper'>
				
			<?php	
				}
			?>
<?php

		$index=0;

		foreach($images as $i=>$image){
			$class=" ";
			
			
			$options["image-url"]=$image["sizes"][$thumbsize];

			switch($view){
				case "vscroll":
				default:
					$options["image-width"]=$image["width"];
					$options["image-height"]=$image["height"];
					$class="image ";
					break;
				case "grid":
					$class="tile ";
					$class.=" cols-".$cols;
					
					$options["image-width"]=$image["sizes"][$thumbsize."-width"];
					$options["image-height"]=$image["sizes"][$thumbsize."-height"];
					break;
					
				case "slider":
					$class=" slide  ";

					$options["image-width"]=$image["width"];
					$options["image-height"]=$image["height"];
					break;
				case "hscroll":
					$class=" image  ";
					$options["image-width"]=$image["width"];
					$options["image-height"]=$image["height"];
					break;
			}
			
			if($thumbsize=="full"){
				$options["image-url"]=$image["url"];
				$options["image-width"]=$image["width"];
				$options["image-height"]=$image["height"];
			}
			


			if($image["media_type"]=="video"){ 
				$imgcols=$image['grid_cols'];
			}else{
				$imgcols=get_field('grid_cols',  $image['ID']);
			}
			if($imgcols) $class.=" size-".$imgcols;
			$class.=" type_".$image["media_type"]." ";

			if($image["alt"]) $image["alt"] = get_bloginfo("name")." | " . $image["alt"];
			else $image["alt"]=get_bloginfo("name");

			

?>
	<div class='<?=$class?>' >
		<div class="the-gap">
			<?php 	//_dump($imgcols);//_dump($image); ?>
			<?php 
				if($image["media_type"]=="video"){ 
					carrot_get_template_part( 'gallery', 'video', false, array( "video"=>$image, "options" => $options) );
				}else{ 
					$image["index"]=$index;
					$index++;
					carrot_get_template_part( 'gallery', 'image', false, array( "image"=>$image, "options" => $options) );
				}
			?>
			
		
		</div>
	</div>

<?php
		}
		
		if($view=="hscroll" || $view=="slider"){
		?>
			</div><!--.images-wrapper-->
			
		<?php	
		}
		
?>
	</div>


<?php

	}

?>


