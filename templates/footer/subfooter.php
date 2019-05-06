<?php
	$opts=_o("subfooter_options");
	
	
	if(count($opts)>0){
?>

<div id="subfooter" class="<?php subfooter_class(); ?>">
	<div class="container" >
		<div class="row">
			<div class="col-sm-6 text-left text-sm-center">
				<?php
					if(in_array("social",$opts)){
						carrot_get_template_part("footer/social-links");
					}
				?>
				<?php
					if(in_array("contact",$opts)){
						carrot_get_template_part("footer/contact-info");
					}
				?>
			</div>
			<div class="col-sm-6 text-right text-sm-center">
				
				
				<?php
					if(in_array("menu",$opts)){
						carrot_get_nav_menu("footer-menu");
					}
				?>
				
				<?php
					if(in_array("copyright",$opts)){
						carrot_get_template_part("footer/copyright");
					}
				?>
				
			</div>
		</div>
	</div>
</div>
<?php
	}
?>