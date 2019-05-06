<?php

	$this->carrot_widget_header($instance);
	
	
	
	wp_nav_menu( array( 
		'menu' => $menuid ,
		'menu_class' => 'menu menu-'.$menulayout ." align-".$menualign
	) );
	//carrot_get_nav_menu($menuid);



	$this->carrot_widget_footer($instance);
