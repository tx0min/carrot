

		<div class="row" >
		
			<?php	
					if(_opt("footer_columns")){
						$cols=_opt("footer_columns");
						
						for($i=0;$i<$cols;$i++){
							$name="footer-widgets-".($i+1);
							$colsize=12/$cols;
							
			?>	
				<div class="col-sm-<?=$colsize?>">
					<?php dynamic_sidebar( $name ); ?>
				</div>							
				
			<?php
						}
						
						
					}	
			?>
		</div>

<?php 
	
	if(_o("show_sub_footer")){ 
		carrot_get_template_part("footer/subfooter");
	}
	
	
?>