<?php
	
	if(is_archive() || is_search()){
		$template=_o("archive_post_template");
		
			
	}else{	
		$template=_o("blog_post_template");

	}
	
	carrot_get_template_part("tile/".$template,"",false, post_display_options());
?>
	