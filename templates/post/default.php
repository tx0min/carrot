<?php
/**
 * @package Carrot Theme
 * Template Name: Content + sidebar right
 */
?>

</div><!--.container-->


	
<article id="post-<?php the_ID(); ?>" <?php carrot_post_class( ); ?>>
	<div class="container">
		<div class="row">
			<div class="col-sm-8">

				<header class="entry-header clearfix">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header><!-- .entry-header -->
				
				
				<?php if(gf("entradeta")){ ?>
					<div class="entradeta">
						<?=gf("entradeta")?>
					</div>
				<?php } ?>
				
				
				
				
				
				
				
				
				

				<div class="entry-content clearfix" data-cols="<?=gf("columns")?>" data-lang="<?=get_locale()?>">
					<?php carrot_show_post_featured(); ?>
					<?php 
						//_dump(get_locale());

						the_content();
						
						
					?>
				</div><!-- .entry-content -->
				
			</div>

			<div class="col-sm-4">
				<div class="sidebar sidebar-right">
					<div class="carrotaffix">
						<div class="article-date">
							<?=_icon("icon_clock","small")?> <?=__("Published on",THEME_NAME)?> <?php carrot_posted_on(); ?> 
						</div>

						<?php if(wp_get_post_categories($post->ID)){ ?>
							<div id="carrot-widget-carrot-categories" class="widget carrot-widget-carrot-categories ">
								<h2 class="widget-title"><?=__("Categories",THEME_NAME)?></h2>
								<div class="widget-body">
									<?php carrot_post_categories()?>
								</div>
							</div>
						<?php } ?>
						
						
						<?php if(get_the_tags()){ ?>
							<div id="carrot-widget-carrot-tags" class="widget  carrot-widget-carrot-tags ">
								<h2 class="widget-title"><?=__("Tags",THEME_NAME)?></h2>
								<div class="widget-body">
									<?php carrot_post_tags()?>
								</div>
							</div>
						<?php } ?>
						
						
						<?php carrot_sharing_buttons(); ?>
						<?php dynamic_sidebar('post-sidebar'); ?>
					</div>	
				</div>
			</div>
			
		</div>	<!--.row-->		

	</div><!--.container-->
	

</article><!-- #post-<?php the_ID(); ?> -->					

<?php carrot_single_post_navigation(); ?>

<?php carrot_show_related(); ?>
<?php carrot_show_comments(); ?>

<div class="container">
	


