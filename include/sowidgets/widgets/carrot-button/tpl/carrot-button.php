<?php

	$this->carrot_widget_header($instance);
	
	$url="#";
	if($button_url) $url=sow_esc_url($button_url);
	
	
	carrot_button(array(
		"url" => $url,
		"text" => $button_text,
		"align" => $button_align,
		"size" => $button_size,
		"style" => $button_style,
		"color" => $button_color,
		"display" => $button_display,
		"icon" => $button_icon,
		"image" => $button_icon_image,
		"position" => $icon_position
	
	));

	
	$this->carrot_widget_footer($instance);
