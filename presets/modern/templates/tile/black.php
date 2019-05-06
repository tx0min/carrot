<?php
/**
 * @package Carrot Theme
 * Template Name: Coral Black BG Time
 */

//	_dump($show_options);
//	_dump($hovereffect);
	
	$classes=array("post-article","coral-bg-tile");
	
	$gridsize=get_field("single_".get_post_type()."_grid_cols");

?>
<article id="post-<?php the_ID(); ?>"  <?php post_class($classes); ?>  title="<?php the_title(); ?>" data-grid-size="<?=$gridsize?>" >
	<div class="article-inner">
		<a href="<?php the_permalink();?>">
			
			<?php carrot_post_thumbnail($thumbsize,false,true,false,false,true);?>
			<div class="article-content">
				<div class="coral-year"><?=gf("year")?></div>
				<h2 class="post-title"><?php the_title(); ?></h2>
				<div class="excerpt"><?php the_excerpt(); ?></div> 
			</div>
		</a>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->