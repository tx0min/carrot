<?php
/**
 * @package Carrot Theme
 * Template Name: Full width Layout
 */
?>

</div><!--.container-->
		
	<article id="post-<?php the_ID(); ?>" class="<?php carrot_posttype_class( array("author-full")); ?>">
		<div class=" flex-row " >
			
			<div class="col-md-3 col-xs-12 ">
				<div class="article-featured">
						<?php echo get_post_thumbnail('full',false,false,false,false,true); ?>
				</div>
			</div>
			<div class="col-md-6 col-sm-12 middle-xs">
				<header class="entry-header clearfix anim from-left ">
					
							
					<h1 class="entry-title">
						<?php the_title(); ?>
					</h1>
					
					
					<?php carrot_author_birth(); ?>
					
					
						
					<?php carrot_author_contact_links(); ?>
					
					

				</header><!-- .entry-header -->
				<div class="entry-content anim from-left delay-1"><?php the_content(); ?></div><!-- .entry-content -->


				


				<?php if(gf("publicaciones")){ ?>
				<div class="author-other-publications anim from-center delay-3">
					<?php
						carrot_author_other_publications();
					?>
				</div>
				<?php } ?>
				
			</div>
			
			<div class="col-md-3 col-xs-12 ">
				
				
				<div class=" author-products anim from-top delay-2">
					<?php
						carrot_author_products();
					?>
				</div>

				
			</div>
		
		</div>	<!--.row-->	

	

			
		
		<div class="flex-row b-t ">
			
			<?php 
			
				$totalmedia = count(gf("videos")) +  count(gf("audio"));
				//_dump($totalmedia);
				if($totalmedia>0){
					$colsize= 12 / $totalmedia;
					if($colsize<2) $colsize=2;
					if(gf("videos")){
						foreach(gf("videos") as $video){
							echo "<div class='col-sm-$colsize media-box video'><div class='inner'>";
							echo carrot_embed_code( $video["video_url"], array("width"=>300, "height"=>150));
							echo "</div></div>";
						}
					}
			
					if(gf("audio")){
							
						foreach(gf("audio") as $audio){
							echo "<div class='col-sm-$colsize media-box audio'><div class='inner'>";
							echo carrot_embed_code($audio["audio_url"], array("width"=>300, "height"=>150));
							echo "</div></div>";
						}
					}
				}
			?>
			
				
			
			
		</div>
		
		
	</article><!-- #post-<?php the_ID(); ?> -->					

	
<div  class="container">