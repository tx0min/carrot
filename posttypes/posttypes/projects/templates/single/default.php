<?php

/**
 * @package Carrot Theme
 * Template Name: Default Layout (content top)
 */



?>


</div><!--.container-->


<article id="post-<?php the_ID(); ?>" class="<?php carrot_posttype_class(); ?>" >
	<?php carrot_custom_project_colors(); ?>
	
	<div class="container">
		<section id="project" class="project-info ">
			<div class="row">
				<div class="col-sm-8 ">
					<header class="entry-header">
						<h1 class="project-title anim from-left" ><?php the_title(); ?></h1>
						<?php 
							carrot_post_taxonomies("project_category",false,array("anim","from-left","delay-1"),"#");
						?>
					</header><!-- .entry-header -->
				</div>
			</div><!--.row-->
			
			<div class="row">
				<div class="col-sm-8 ">
					<div class="entry-content anim from-left delay-1 ">
						<?php 
							the_content();
							
						?>
					</div><!-- .entry-content -->
					
				</div><!--.col-->	
				<div class="col-sm-4 ">
					<div class="project-data-sheet anim from-bottom delay-2">
						<?php carrot_project_data_sheet(); ?>
					</div>
					<?php carrot_sharing_buttons(); ?>

				</div>
			</div><!--.row-->
			
		</section>
		<?php carrot_project_show_featured(); ?>
		<?php carrot_post_media_gallery("project_gallery"); ?>

	</div><!--.container-->

	
</article><!-- #post-<?php the_ID(); ?> -->					

<?php carrot_single_post_navigation("projects"); ?>


<?php carrot_show_related("projects"); ?>
<div class="container">
	

