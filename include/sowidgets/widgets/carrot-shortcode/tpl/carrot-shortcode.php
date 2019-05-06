<?php

	$this->carrot_widget_header($instance);
	
	
	$shortcode=$shortcode_select;
	if(!$shortcode_select) $shortcode=$shortcode_tag;
	
	if($shortcode){
		
		if($shortcode_attrs){
			$attrs=array();
			foreach($shortcode_attrs as $attr){
				$attrs[]= $attr["attr_name"]."=\"".htmlspecialchars($attr["attr_value"]) ."\"";
			}
			$shortcode.=" ".implode(" ",$attrs);
		}
		$shortcode="[".$shortcode."]";
		echo do_shortcode($shortcode);
	}
	
	$this->carrot_widget_footer($instance);
