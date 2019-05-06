
<div class="<?php loop_class(); ?>" >

	<?php
		if(is_archive() || is_search()){
			$style=_o('archive_style');			
				
		}else{	
			$style=_o('blog_style');	
				
		}
		//_dump($style);
		while ( have_posts() ) : the_post(); 
	?>
		<div class="the-gap"><?php carrot_get_template_part( 'blog/blog-content', $style ); ?></div>
		
	<?php 

		endwhile; 
	?>
</div>

<?php
	carrot_posts_navigation();
			
	
	
	
	
	
