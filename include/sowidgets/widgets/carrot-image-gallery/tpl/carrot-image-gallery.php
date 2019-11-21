<?php



	$this->carrot_widget_header($instance);
		
	
	$images = carrot_generate_images_array($gallery_images, ["random_start"=>$gallery_random_start, "random_order"=>$gallery_random_order]);
	

	$options["thumbsize"]=$gallery_thumbnail_size;
	$options["color"]=false;
	$options["view"]=$gallery_disposition;
	$options["cols"]=$gallery_columns;
	$options["gutter"]=$gallery_gap;
	$options["lightbox"]=$gallery_lightbox;
	$options["bordered"]=$gallery_bordered;
	
	$options["images"]=$images;


	$options["shownav"]=$gallery_show_navigation?true:false;
	$options["showpause"]=$gallery_show_pause?true:false;
	$options["showpagination"]=$gallery_show_pager?true:false;
	$options["autoplay"]=$gallery_autoplay?true:false;
	$options["loop"]=$gallery_slider_loop?true:false;
	$options["pause_on_hover"]=$gallery_pause_on_hover?true:false;
	
	
	$options["timeout"]=$gallery_slide_timeout;
	$options["speed"]=$gallery_slide_speed;

	$options["items"]=$gallery_articles_to_show;
	$options["itemsresponsive"]=$gallery_articles_to_show_responsive;
	$options["page_slide"]=$gallery_page_slide?true:false;

	$options["drag"]=$gallery_enable_drag?true:false;
	$options["slide_effect"]=$gallery_slide_effect;
	$options["valign"]=$gallery_valign;
	$options["image_height"]=$gallery_image_height;

	//_dump($options);
	
	//carrot_image_gallery
	carrot_media_gallery($options);


	$this->carrot_widget_footer($instance);
?>