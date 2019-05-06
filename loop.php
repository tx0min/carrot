<?php
/**
* The loop!
 * @package Carrot Theme
*/
	
	
	if(is_archive() || is_search()){
		$sidebar=_o('archive_sidebar');
		$sidebar_columns=_o('archive_sidebar_columns');
		$style=_o('archive_style');			
			
	}else{	
		$sidebar=_o('blog_sidebar');
		$sidebar_columns=_o('sidebar_columns');
		$style=_o('blog_style');	
			
	}
	
	
?>

<div class="row">
	<?php if($sidebar=='left'){?>
		<div class="col-sm-3">
			<div class="<?php sidebar_class();?>"><?php dynamic_sidebar( "blog-sidebar" ); ?></div>
		</div>
		<div class="col-sm-9">
	<?php }else if($sidebar=='right'){ ?>
		<div class="col-sm-9">
	<?php }else{ ?>
		<div class="col-sm-12">
	<?php } ?>
	
	
			<?php if ( have_posts() ) : ?>	
				<?php carrot_get_template_part( 'blog/blog', $style ); ?>
			<?php else : ?>
				<?php carrot_get_template_part( 'search/no-results', 'index' ); ?>
			<?php endif; ?>
	
	
	
	
	
	<?php if($sidebar=='left'){?>
		</div>
	<?php }else if($sidebar=='right'){ ?>
		</div>
		<div class="col-sm-3">
			<div class="<?php sidebar_class();?>"><?php dynamic_sidebar( "blog-sidebar" ); ?></div>
		</div>
	<?php }else if($sidebar=='bottom'){ ?>
		
			</div><!--close col-->
			</div><!--close blog-->
			</div><!--close row-->
			</div><!--close container -->
				
		
			<div class="<?php sidebar_class();?>">
				<div class="container" >
					<div class="row">
						<?php dynamic_sidebar( "blog-sidebar" ); ?>
					</div>
				</div>
			</div>
		
		<div><div><div class="container" >
		
	<?php }else{ ?>
		</div>
	<?php } ?>
</div><!--.row-->
