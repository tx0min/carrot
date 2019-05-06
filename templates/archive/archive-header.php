<?php
	$term =	$wp_query->queried_object;
	//_dump($term);
	
	
	if($term){
		if($term instanceof WP_User)
			carrot_get_template_part("archive/archive-header","user");
		else if ($term instanceof WP_Term)
			carrot_get_template_part("archive/archive-header","basic");
		else if ($term instanceof WP_Post_Type)
			carrot_get_template_part("archive/archive-header","posttype");
		else 
			carrot_get_template_part("archive/archive-header","basic");
	}else{
		carrot_get_template_part("archive/archive-header","basic");
	}
		
?>

