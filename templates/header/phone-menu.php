<?php 

	if(carrot_drawer_is_visible()){ 

		
?>
<div id="phone-menu" class="<?php phone_menu_class(); ?>">
	<div class="<?php phone_drawer_class(array("drawer-overlay")); ?>"></div>
	<div class="<?php phone_drawer_class(array("menu-drawer")); ?>" >
		<?php carrot_drawer_content(); ?>
		
		
	</div>
	<a href="#" class="menu-opener">
		<span class="icon-part"></span>
		<span class="icon-part"></span>
		<span class="icon-part"></span>
	</a>
	
</div>
<?php 
	}
?>
</div>