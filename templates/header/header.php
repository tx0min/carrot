<?php

	
	//echo $header_type;
	



?>


<?php if(carrot_header_is_visible()){ ?>


<div id="header" class="<?php header_class(); ?>" > 
	<div class="container" >
		<?php 
			carrot_header_content();
		?>
	</div>
</div><!--#header-->


<?php } ?>




