<?php

// programmatically create some basic pages, and then set Home and Blog


// create the blog page
if (isset($_GET['activated']) && is_admin()){

	$startercontent = array(
		array(
			"post_type" => "page",
			"page_for_posts" => false,
			"page_on_front" => true,
			"slug" => "home",
			"title" => __( 'Home', THEME_NAME ),
			"content" => __( 'This is home page placeholder. Welcome!', THEME_NAME )

		),array(
			"post_type" => "page",
			"page_for_posts" => true,
			"page_on_front" => false,
			"slug" => "blog",
			"title" => __( 'Blog', THEME_NAME ),
			"content" => __( 'This is blog page placeholder. Anything you enter here will not appear in the front end, except for search results pages.', THEME_NAME )

		),array(
			"post_type" => "block",
			"slug" => "header-sample",
			"title" => __( 'Header Sample', THEME_NAME ),
			"content" => __( 'This is a header sample', THEME_NAME )

		),array(
			"post_type" => "block",
			"slug" => "footer-sample",
			"title" => __( 'Footer Sample', THEME_NAME ),
			"content" => __( 'This is a footer sample', THEME_NAME )

		),
	);




	foreach($startercontent  as $page){
		//$page_check = get_page_by_title($page["title"]);
	    $args = array(
		    'post_type' => $page["post_type"],
		    'post_title' => $page["title"],
		    'post_content' => $page["content"],
		    'post_status' => 'publish',
		    'post_author' => 1,
		    'post_slug' => $page["slug"]
	    );

	    if(!carrot_the_slug_exists( $page["slug"] )) {
	        $id = wp_insert_post($args);

	        if($page["post_type"] == "page"){
				if(isset($page["page_for_posts"]) && $page["page_for_posts"]){ 
		       		update_option( 'page_for_posts', $id );
		       	}
		        if(isset($page["page_on_front"]) &&  $page["page_on_front"]){ 
		       		update_option( 'page_on_front', $id );
		       		update_option( 'show_on_front', 'page' );

		       	}
		    }
			
	    }
	}

    
}





