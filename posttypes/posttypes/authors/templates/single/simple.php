<?php
/**
 * @package Carrot Theme
 * Template Name: Full width Layout (only basic info)
 */
?>

</div><!--.container-->
		
	<article id="post-<?php the_ID(); ?>" class="<?php carrot_posttype_class( ); ?>">
		<div class=" flex-row " >
			
			
			<div class="col-md-3 col-xs-12 ">
				<div class="article-featured">
					<?php echo get_post_thumbnail('full',false,false,false,false,true); ?>
				</div>
			</div>
			
			<div class="col-md-3 col-sm-6 flex-row middle-xs">
				<header class="entry-header clearfix anim from-center ">
					<h1 class="entry-title">
						<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
						</a >
						
					</h1>
					<?php carrot_author_birth(); ?>
					
					
							
					<?php carrot_author_contact_links(); ?>
							
						
				</header><!-- .entry-header -->
				
			</div>
			<div class=" middle-xs flex-row <?php if(gf("interview")){ ?>col-md-3 col-sm-6<?php }else{ ?>col-md-6 col-sm-6<?php } ?> ">
				<div class="entry-content clearfix anim from-center delay-1"><?php the_content(); ?></div><!-- .entry-content -->
			</div>
			<?php if(gf("interview")){ ?>
				<div class=" middle-xs flex-row col-md-3 col-sm-12 ">
					<div class="entry-interview anim from-center delay-2"><?php echo gf("interview"); ?></div><!-- .entry-content -->
				</div>
			<?php } ?>

		</div>	<!--.row-->	

			
		
	</article><!-- #post-<?php the_ID(); ?> -->					

	
<div  class="container">