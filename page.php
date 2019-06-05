<?php
/**
 * This template is used every page withouth a custom template
 * @package Carrot Theme
 */
    get_header(); 
	
	
	
	
	$sidebar=gf('sidebar_display');
	$sidebar_columns=gf('sidebar_columns');

	$sidebar_class=array("sidebar");
	//_dump($sidebar);
	$sidebar_class[]="sidebar-".$sidebar;
	$sidebar_class[]="sidebar-cols-".$sidebar_columns;
	
	if(carrot_page_title_is_visible() || carrot_page_breadcrumb_is_visible()){
		
	
?>
</div><!--.container-->
	
	<header class="single-page-header">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<?php if(carrot_page_title_is_visible()) the_title( '<h1 class="single-page-title">', '</h1>' ); ?>
				</div>
				<div class="col-sm-6 ">
					<?php if(carrot_page_breadcrumb_is_visible()) carrot_breadcrumb(); ?>
				</div>
			</div>
			
			
		</div>
	</header><!-- .entry-header -->


<div class="container">
<?php
	}
?>


	<div class="row">
		
		<?php if($sidebar=='left'){?>
			<div class="col-sm-3">
				<div class="<?=implode(" ",$sidebar_class)?>"><?php dynamic_sidebar( "page-sidebar" ); ?></div>
			</div>
			<div class="col-sm-9">
		<?php }else if($sidebar=='right'){ ?>
			<div class="col-sm-9">
		<?php }else{ ?>
			<!--div class="col-sm-12"-->
		<?php } ?>
	
	
			<?php 
				while ( have_posts() ) : the_post();
					carrot_get_template_part( 'page/content', 'page' );
				endwhile; // end of the loop. 
			?>		
			
			
		<?php if($sidebar=='left'){?>
			</div>
		<?php }else if($sidebar=='right'){ ?>
			</div>
			<div class="col-sm-3">
				<div class="<?=implode(" ",$sidebar_class)?>"><?php dynamic_sidebar( "page-sidebar" ); ?></div>
			</div>
		<?php }else if($sidebar=='bottom'){ ?>
			
				</div><!--close col-->
				</div><!--close row-->
				</div><!--close container -->
					
			
				<div class="<?=implode(" ",$sidebar_class)?>">
					<div class="container" >
						<div class="row">
							<?php dynamic_sidebar( "page-sidebar" ); ?>
						</div>
					</div>
				</div>
			
			<div><div><div class="container" >
			
		<?php }else{ ?>
			<!--/div-->
		<?php } ?>

	</div><!--.row-->					



<?php get_footer(); ?>