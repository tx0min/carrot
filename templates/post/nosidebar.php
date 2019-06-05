<?php
/**
 * @package Carrot Theme
 * Template Name: No sidebar
 */
?>
</div><!--.container-->
	
<article id="post-<?php the_ID(); ?>" <?php carrot_post_class( ); ?>>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">

				<header class="entry-header clearfix">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header><!-- .entry-header -->
			</div>

		</div>	<!--.row-->		
		<div class="row">		
			<div class="col-sm-12">
				<?php if(gf("entradeta")){ ?>
					<div class="entradeta">
						<?=gf("entradeta")?>
					</div>
				<?php } ?>
				<div class="article-date">
					<?=_icon("icon_clock","small")?> <?=__("Published on",THEME_NAME)?> <?php carrot_posted_on(); ?> 
				</div>
				
				
				<div id="carrot-widget-carrot-categories" class="widget carrot-widget-carrot-categories ">
					<h3 class="widget-title"><?=__("Categories",THEME_NAME)?></h3>
					<div class="widget-body">
						<?php carrot_post_categories()?>
					</div>
				</div>
				
				
				<div id="carrot-widget-carrot-tags" class="widget  carrot-widget-carrot-tags ">
					<h3 class="widget-title"><?=__("Tags",THEME_NAME)?></h3>
					<div class="widget-body">
						<?php carrot_post_tags()?>
					</div>
				</div>
					

				<div class="entry-content clearfix" data-cols="<?=gf("columns")?>" data-lang="<?=get_locale()?>">
					<?php 
					
						//_dump(get_locale());

						the_content();
						
						
					?>
					
				</div><!-- .entry-content -->
				<?php carrot_sharing_buttons(); ?>

			</div><!--.col-->	

					
		</div><!--.row-->	
	</div><!--.container-->
	

</article><!-- #post-<?php the_ID(); ?> -->					

<?php carrot_single_post_navigation(); ?>

<?php carrot_show_related(); ?>
<?php carrot_show_comments(); ?>
	
	

<div class="container">