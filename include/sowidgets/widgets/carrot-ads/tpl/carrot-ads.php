<?php

	$this->carrot_widget_header($instance);
	
	$colsize=12;
	
	if($banner_columns>0) $colsize=12/$banner_columns;
	if($banner_columns_small>0) $colsizesmall=12/$banner_columns_small;
	
	$thumbsize="full";
	
	if($banner_show=="chosen" ){
		if($selected_banners){
			//_dump($selected_banners);
			$post_selector_pseudo_query = $selected_banners;
			
			$processed_query = siteorigin_widget_post_selector_process_query( $post_selector_pseudo_query );
			$query_result = new WP_Query( $processed_query );
		}
		
	}else{
		if(is_object($banner_format)) $banner_format=$banner_format->slug;
		
		if(!$banner_format) $thumbsize="banner-horizontal";
		else $thumbsize="banner-".$banner_format;
		
		
	
		$query_result=carrot_get_banners($banner_format,$banner_show,$banner_number);
	}


	
	if($query_result->have_posts()) : 
?>
<div class="ads advertising-area publi">
	<div class="row">
<?php	
	while($query_result->have_posts()) : $query_result->the_post(); ?>



<?php


		if($track_imprints)
			carrot_inc_banner_imprints(get_the_id());

		if($track_clicks) $bannerurl=get_permalink();
		else $bannerurl=gf("url")? gf("url"): (gf("link_intern")?gf("link_intern"):"#");
		$new=gf("obrir_en_finestra_nova");
		
		//_dump(carrot_get_post_meta_num(get_the_id(),CARROT_ADS_IMPRINT_KEY));

		

?>
	<div class="col-xs-<?=$colsizesmall?> col-sm-<?=$colsize?>">
	
		<a id="advert-<?=the_ID()?>" class="banner " href="<?=$bannerurl?>" <?=(($new)?"target='_blank'":"")?> title="<?php the_title();?> ">
			<?phpcarrot__post_thumbnail($thumbsize,false,false,false,"ad adv advert"); ?>
		</a>
	</div>



<?php 
	endwhile; wp_reset_postdata(); 
 ?>
	</div>
 </div>
<?php endif; 

	$this->carrot_widget_footer($instance);