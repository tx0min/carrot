<div id="site-preloader">
	<div class="in">
	<?php 
		if(_o("site_preload_logo")){
			echo _img("theme-main-logo","<h1>".get_bloginfo('name')."</h1>");
		}
	?>
		<div>
			<?php 
				if(_o("preloader_custom_image")){
					echo _img("preloader_custom_image");
				}
			?>
		</div>
		<div>
			<?php if(_o("preloader_show_text")){?>
				<?php if(_o("preloader_custom_text")){?>
					<?=_o("preloader_custom_text")?>
				<?php }else{ ?>
					<span class="loading-icon"><?=_icon("icon_loading", "text-lg spin")?></span> <?=__("Loading ...",THEME_NAME)?>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
</div>