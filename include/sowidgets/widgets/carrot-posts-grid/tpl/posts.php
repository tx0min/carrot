<?php 
	require_once("../../../../../../../../wp-load.php");

	$query=$_POST["query"];
	$postargs=$_POST["options"];
	$post_template=$_POST["template"];
	
	//_dump($postargs);
	
	$query_result = new WP_Query( $query );
	if($query_result->have_posts()){
	
		$ret=array();
		$ret["numpages"]=$query_result->max_num_pages;
		$ret["numposts"]=$query_result->found_posts;
		$ret["posts"]=array();
		
		while($query_result->have_posts()){
			
			$query_result->the_post();
			$ret["posts"][]=carrot_get_template_content("tile/".$post_template,$postargs);
			
		}
		wp_reset_postdata(); 
		
		echo json_encode($ret);
	}
