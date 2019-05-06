<?php
/**
  * The footer
 * @package Carrot Theme
  */
  
 ?>
 
		</div> <!--.container-->
	 </div> <!--#body-->
	 
 
 <?php
	if(carrot_footer_is_visible()){
	//_dump(gf("page_display_options"));
?>

	<div id="footer" class="<?php footer_class(); ?>">
		<div class="container" >
		
			
			<?php
				carrot_footer_content();
			?>		
			
			
		
		</div>
	</div>
<?php
	}
?>
			
		

<?php carrot_show_back_to_top(); ?>

		
</div><!--#wrapper-->
<?php 
	wp_footer();
	
?>

</body>
</html>