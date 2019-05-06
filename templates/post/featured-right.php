<?php
/**
 * @package Carrot Theme
 * Template Name: Content left + Featured image right
 */
?>

</div><!--.container-->

	
<article id="post-<?php the_ID(); ?>" <?php carrot_post_class( ); ?>>
	<div class="container">
		<div class="row">
			<div class="col-sm-6">

				<header class="entry-header clearfix">
					<div class="article-date">
						<?=_icon("icon_clock","small")?> <?=__("Published on",THEME_NAME)?> <?php carrot_posted_on(); ?> 
					</div>
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header><!-- .entry-header -->
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6">		
				<?php if(gf("entradeta")){ ?>
					<div class="entradeta">
						<?=gf("entradeta")?>
					</div>
				<?php } ?>
				
				
				<div class="entry-content clearfix" data-cols="<?=gf("columns")?>" data-lang="<?=get_locale()?>">
					<?php 
						the_content();
					?>
				</div><!-- .entry-content -->
				<?php carrot_sharing_buttons(); ?>
			</div>
			
			<div class="col-sm-6 hidden-xs p-l-md">
				<?php carrot_show_post_featured(); ?>
					
			</div>
			
		</div>	<!--.row-->		
		
		
		
				
		
					
	</div><!--.container-->
	

</article><!-- #post-<?php the_ID(); ?> -->					
<?php carrot_single_post_navigation(); ?>


<?php carrot_show_related(); ?>
<?php carrot_show_comments(); ?>
	
	

<div class="container">
