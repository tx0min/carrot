<?php
/**
 * @package Carrot Theme
 * Template Name: Coral Simple Time
 */

//	_dump($show_options);
//	_dump($hovereffect);
	
	$classes=array("post-article","coral-tile");
	
	$gridsize=get_field("single_".get_post_type()."_grid_cols");

?>
<article id="post-<?php the_ID(); ?>"  <?php post_class($classes); ?>  title="<?php the_title(); ?>" data-grid-size="<?=$gridsize?>" >
	<div class="article-inner">
		
		
		<?php carrot_performance_simple_tile_content(); ?>
		
		
	</div>
</article><!-- #post-<?php the_ID(); ?> -->