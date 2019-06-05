<?php if(carrot_has_sticky_header()){ ?>


<div id="sticky-header" class="<?php sticky_header_class(); ?>" > 
	<div class="container" >
		<?php 
			

			carrot_sticky_header_content();			
			
		?>


	</div>
	
	
	
</div>
<?php
	}
?>