<div class="menu-top">
	<?php
		$opts=_o("drawer_show_options"); 
		
		
		if(in_array("social",$opts)){
			carrot_get_template_part("footer/social-links");
			
		}
		if(in_array("search",$opts)){
			carrot_get_template_part("search/search-box");
		}
		
		if(in_array("cart",$opts)){
			carrot_show_header_cart();
		}
		if(in_array("contact",$opts)){
			carrot_get_template_part("footer/contact-info");
		}
		
		
	?>
</div>
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
	if(in_array("menu",$opts)){
		carrot_get_phone_nav();
	}
?>