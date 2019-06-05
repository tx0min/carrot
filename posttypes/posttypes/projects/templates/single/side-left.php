<?php

/**
 * @package Carrot Theme
 * Template Name: Side by side (content right)
 */

	


?>

</div><!--.container-->

<article id="post-<?php the_ID(); ?>" class="<?php carrot_posttype_class(); ?>" >
	<?php carrot_custom_project_colors(); ?>
	<div class="container">
	
		<section id="project" class="project-info ">
			<div class="row">
				<div class="col-sm-4 col-sm-push-8">
					<div class="carrotaffix" data-parenttrigger="article">
						<header class="entry-header ">
							<h1 class="project-title anim from-right" ><?php the_title(); ?></h1>
							<?php
								carrot_post_taxonomies("project_category",false,array("anim","from-right","delay-1"),"#");
							?>
						</header><!-- .entry-header -->

						<div class="entry-content anim from-right delay-2">
							<?php 
								the_content();
								
							?>
						</div><!-- .entry-content -->
						<div class="project-data-sheet anim from-right delay-3">
							<?php carrot_project_data_sheet(); ?>
						</div>
						<?php carrot_sharing_buttons(); ?>
					</div>
				</div>
				
				<div class="col-sm-8 col-sm-pull-4">
					<?php carrot_project_show_featured(); ?>

					<?php carrot_post_media_gallery("project_gallery"); ?>

			
				</div><!--.col-->
				
				
			</div><!--.row-->
		</section>

	</div><!--.container-->
	

</article><!-- #post-<?php the_ID(); ?> -->					


<?php carrot_single_post_navigation("projects"); ?>
<?php carrot_show_related("projects"); ?>


<div class="container">

	

