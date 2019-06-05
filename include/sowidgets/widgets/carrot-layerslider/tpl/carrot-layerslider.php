<?php

	$this->carrot_widget_header($instance);
	
	echo do_shortcode('[layerslider id="'.$layer_slider_id.'"]');

	
	$this->carrot_widget_footer($instance);
?>