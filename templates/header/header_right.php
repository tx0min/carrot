<?php 

	$opts=_opt("header_show_options"); 
	
?>
<div class="row">
	<div class="col-xs-7 text-left hidden-xs hidden-sm">
		
		<?php
			if(in_array("social",$opts)){
				carrot_get_template_part("footer/social-links");
			}
		?>
		
		<?php
			if(in_array("search",$opts)){
				carrot_get_template_part("search/search-box");
			}
		?>
		<?php
			if(in_array("contact",$opts)){
				carrot_get_template_part("footer/contact-info");
			}
		?>

		<?php
			if(in_array("cart",$opts)){
				carrot_show_header_cart();
			}
		?>
		


	</div>

				
	<div class="col-sm-5 col-xs-6 col-xs-offset-3 col-sm-offset-0 text-right text-sm-center">
		<a id="logo" href="<?php carrot_home_url(); ?>">
			

			<?php
				if(in_array("title",$opts)){
			?>
				<h1 id="logo-text">
					<?php bloginfo( 'name' );?>
				</h1>
			<?php
				}
			?>
			
			
			<?php
				if(in_array("logo",$opts)){
			?>
				<div id="logo-image" class="logo-image">
					<?php 
						echo _img("theme-main-logo","<h1>".get_bloginfo('name')."</h1>");
					?>
				</div>
				
			<?php
				}
			?>

			<?php
				if(in_array("description",$opts)){
			?>
				<div class="brand-description">
					<?php bloginfo( 'description', 'display' ); ?>
				</div>
			<?php
				}
			?>
			
			
			
		</a>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 ">
		<div class="header-menu text-left hidden-xs hidden-sm">
			<?php
				if(in_array("menu",$opts)){
					carrot_get_nav_menu("header-menu");
				}
			?>
		</div>
		
	</div>
</div>
