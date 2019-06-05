<?php 
	$sidebar=_o('woo_sidebar'); 
	$isshop=is_shop();
?>



			</div><!--shop-container-->
	
	
	
	<?php if($isshop && $sidebar=='left'){?>
		</div>
	<?php }else if($isshop && $sidebar=='right'){ ?>
		</div>
		<div class="col-sm-3">
			<div class="<?php sidebar_class();?>"><?php dynamic_sidebar( "shop-sidebar" ); ?></div>
		</div>

	<?php }else{ ?>
		</div>
	<?php } ?>
	
	
	
</div><!--.row-->


<?php if(!_o("woo_fullwidth")){ ?>
</div><!--.container-->
<?php } ?>