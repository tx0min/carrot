<?php
/**
 * @package Carrot Theme
 * Template Name: Coral Featured image heading
 */
	$classes=array();
	
?>

</div><!--.container-->


	
<article id="post-<?php the_ID(); ?>" <?php carrot_post_class( ); ?>>
	

	
	<div class="container " >
		
		<div class="row ">
			<div class="col-sm-6 "><hr/></div>
		</div>
		
		<div class="row anim from-left ">
			<div class="col-sm-12 ">
				<header class="entry-header clearfix ">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<h2 class="sub-title">
						
						<?=carrot_get_performance_subtitle()?>
							
					</h2>
					
				</header><!-- .entry-header -->
			</div>
		</div>
		<?php if(has_post_thumbnail()){?>
		<div class="row anim from-top delay-1" >
			<?php  carrot_post_thumbnail("heading-big",false,true,false,false,false);?>
		</div>
		<?php } ?>

		<div class="row">
			<hr/>
			<div class="col-sm-6 anim from-left">
				<div class="performance-data">
					<h3 class="bottom-title"><?=carrot_get_performance_bottomtitle()?></h3>
					<div class="bottom-subtitle">
						<?=carrot_get_performance_bottomsubtitle()?>
					</div>

					<div class="performance-data-sheet anim from-left delay-2">
						<?php carrot_performance_data_sheet(); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-6  anim from-right delay-1">
				<div class="entry-content clearfix" >
					<?php 
						the_content();
					?>

				</div><!-- .entry-content -->
				<div class="performance-subcontent clearfix" >
					<?=carrot_performance_subcontent()?>
				</div>
			</div>
		</div>	<!--.row-->	
		
		<?php 
			if(has_field("performance_gallery") || has_field("videos")){ 
				if(gf("performance_gallery")["images"]){
		 ?>
		<div class="row">
			<hr/>
			<div class="col-xs-12">
				<?php carrot_post_media_gallery("performance_gallery"); ?>
			</div>

		</div>	
		<?php 
				}
			} 
		?>

	</div><!--.container-->
	

</article><!-- #post-<?php the_ID(); ?> -->					

<?php //carrot_single_post_navigation(); ?>

<?php //carrot_show_related(); ?>
<?php //carrot_show_comments(); ?>

<div class="container">
	


