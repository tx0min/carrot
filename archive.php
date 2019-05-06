<?php
/**
* The archive page!
 * @package Carrot Theme
*/
	get_header(); 
	
	$archive_show_header=_o("archive_show_header");
	

	if($archive_show_header){
?>
</div><!--.close main container-->

<?php carrot_get_template_part("archive/archive-header"); ?>
			
<div class="container" >
<?php 
	} 

	get_template_part('loop');

	
	
?>


	

<?php get_footer(); ?>