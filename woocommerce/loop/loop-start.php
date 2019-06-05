<?php 
	$sidebar=_o('woo_sidebar'); 
	$isshop=is_shop();
?>


<?php if(!_o("woo_fullwidth")){ ?>
<div class="container">
<?php } ?>

<div class="row">
	<?php if($isshop && $sidebar=='left'){?>
		<div class="col-sm-3">
			<div class="<?php sidebar_class();?>"><?php dynamic_sidebar( "shop-sidebar" ); ?></div>
		</div>
		<div class="col-sm-9">
	<?php }else if($isshop && $sidebar=='right'){ ?>
		<div class="col-sm-9">
	<?php }else{ ?>
		<div class="col-sm-12">
	<?php } ?>


	
			<div class="<?=carrot_woocommerce_class()?>">
				<div class="grid-sizer"></div>
				 <div class="gutter-sizer"></div>	
					