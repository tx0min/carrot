<?php
/**
 * @package Carrot Theme
 * Template Name: Simple Tile (title and excerpt)
 */

//	_dump($show_options);
//	_dump($hovereffect);
	
	$classes=array("post-article","simple-tile");
	
	$gridsize=get_field("single_".get_post_type()."_grid_cols");

?>
<article id="post-<?php the_ID(); ?>"  <?php post_class($classes); ?>  title="<?php the_title(); ?>" data-grid-size="<?=$gridsize?>" >
	<div class="article-inner">
		<div class="row">
			<h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
			<div class="excerpt"><?php the_excerpt(); ?></div> 
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->