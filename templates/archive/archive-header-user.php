
<!--.archive-header-->
<div class="<?php archive_class(); ?>" >
		
	<div class="container" >
			
		<div class="archive-author clearfix">
		
			<?php 
				//echo $author->display_name;
				$term =	$wp_query->queried_object;
	
				$options=array(
					"name"=>true,
					"avatar"=>true,
					"bio"=>true,
					"prefix"=>false,
					"twitter"=>true,
					"email"=>true,
				);
				carrot_author_args($options, $term->ID );
			?>	
			<span class="author-count"><strong><?php carrot_found_posts();?></strong> <?=__("Published articles",THEME_NAME)?></span>
		</div>
		
	</div>

</div>