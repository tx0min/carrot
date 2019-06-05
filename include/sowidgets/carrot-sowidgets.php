<?php


if(class_exists('SiteOrigin_Widget')):
	
	define("CARROT_SO_WIDGETS_DIR",dirname(__FILE__));
	define("CARROT_SO_WIDGETS_URI",THEME_URI."/include/sowidgets");

	require_once CARROT_SO_WIDGETS_DIR. "/carrot-basewidget.class.php";
	require_once CARROT_SO_WIDGETS_DIR. "/carrot-postswidget.class.php";
	require_once CARROT_SO_WIDGETS_DIR. "/carrot-sowidgets-setup.php";

	

endif;

	
	
	
	