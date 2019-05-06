<?php
/**
 * @package Carrot Theme
 * Template Name: Featured image heading
 */
	$classes=array();
	
?>

</div><!--.container-->


	
<article id="post-<?php the_ID(); ?>" <?php carrot_post_class( ); ?>>

	<?php if(carrot_has_post_featured()){?>
	<div class="featured-heading" style="background-image:url(<?=get_post_thumbnail_url()?>)"></div>
	<?php } ?>
	
	<div class="container " >
		<div class="row">
			<div class="col-sm-8 col-sm-push-2 ">
				<div class="post-contents">
				
					<div class="post-meta ">
						<div class="row">
							<div class="col-sm-3 text-xs-center">
								<div class="article-date">
									<?=_icon("icon_clock","small")?> <?php carrot_posted_on(); ?> 
								</div>
								
							</div>
							
							<div class="col-sm-9 text-right text-xs-center">
								<div class="article-taxonomies">
									<?php if(wp_get_post_categories($post->ID)){ ?>
										<div class="article-categories"><?=_icon("icon_category")?> <?php carrot_post_categories()?></div>
											
									<?php } ?>
									<?php if(get_the_tags()){ ?>
										<div class="article-tags"><?=_icon("icon_tag")?> <?php carrot_post_tags()?></div>
									<?php } ?>
								</div>
								
								
							</div>
						
						</div>
						<div class="col-sm-12 text-right text-xs-center">
							<?php carrot_sharing_buttons(); ?>
								
						</div>
					</div>
					<header class="entry-header clearfix">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->
					
				
					<?php if(gf("entradeta")){ ?>
						<div class="entradeta">
							<?=gf("entradeta")?>
						</div>
					<?php } ?>
					
					
				
				
				
				
				
				
				

					<div class="entry-content clearfix" data-cols="<?=gf("columns")?>" data-lang="<?=get_locale()?>">
						<?php 
							//_dump(get_locale());

							the_content();
							
							
						?>
					</div><!-- .entry-content -->
					
				</div><!--.post-contents-->
			</div>
		</div>	<!--.row-->		

	</div><!--.container-->
	

</article><!-- #post-<?php the_ID(); ?> -->					

<?php carrot_single_post_navigation(); ?>

<?php carrot_show_related(); ?>
<?php carrot_show_comments(); ?>

<div class="container">
	


