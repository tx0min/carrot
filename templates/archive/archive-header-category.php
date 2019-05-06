
<!--.archive-header-->
<div class="<?php archive_class(); ?>" >
		
	<div class="container" >
			
		<h1 class="page-title">
		<?php 
			if(is_search()){
				printf( esc_html__( 'Search Results for: %s', THEME_NAME ), '<span>' . get_search_query() . '</span>' ); 
			}else{
				the_archive_title();
			}
			
		?>	
		</h1>
		<h3 ><span class="archive-count"><strong><?php carrot_found_posts();?></strong> <?=__("Articles",THEME_NAME)?></span></h3>
	</div>
	

</div>