<?php
/**
 * @package Carrot Theme
 */

	$classes = array(
		'clearfix'
	);
	
?>


<article id="post-<?php the_ID(); ?>" <?php post_class($classes ); ?>>

	<header class="entry-header clearfix">
		<h1 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h1>
		<div class="article-date"><?php carrot_posted_on(); ?></div>
	</header><!-- .entry-header -->
	
	<div class="entry-content clearfix">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	
	<footer class="entry-footer"></footer>
	
</article><!-- #post-<?php the_ID(); ?> -->


