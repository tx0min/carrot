<?php
	if(is_archive() || is_search()){
		$style=_o('archive_style');			
			
	}else{	
		$style=_o('blog_style');	
			
	}
?>
<div class="<?php loop_class(); ?>">
	<div class="grid-sizer"></div>
    <div class="gutter-sizer"></div>
	
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="tile">
			<div class="the-gap">
				<?php carrot_get_template_part( 'blog/blog-content', $style ); ?>
			</div>
		</div>
	<?php endwhile; ?>
			
</div>

<?php 
	carrot_posts_navigation();
?>
		