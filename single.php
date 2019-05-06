<?php
	/**
	 * @package Carrot Theme
	 */
 	
 	get_header();
	
	$type=get_post_type();
	if(carrot_posttype_title_is_visible($type) || carrot_posttype_breadcrumb_is_visible($type)){
?>
</div><!--.container-->
		<header class="single-page-header">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<?php if(carrot_posttype_title_is_visible($type)) the_title( '<h1 class="single-page-title">', '</h1>' ); ?>
				</div>
				<div class="col-sm-6 ">
					<?php if(carrot_posttype_breadcrumb_is_visible($type)) carrot_breadcrumb(); ?>
				</div>
			</div>
		</div>
	</header><!-- .entry-header -->
<div class="container">

<?php
	}
	
	
	if ( have_posts() ) : the_post();
	
		$type=get_post_type();
		$layout= carrot_get_single_post_template($type);
		//_dump($layout);
		if($type=="post"){
			carrot_get_template_part("post/".$layout);
		}else{
			get_posttype_template_part($type, "single/".$layout);
		}

	endif; // end of the loop. 		

 	get_footer(); 

