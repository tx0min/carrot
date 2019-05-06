<?php

	$this->carrot_widget_header($instance);
	
	$postargs = $this->generatePostOptions($instance);
	
	//_dump($article_border_width);
	$classes=$this->articlesClasses($instance);
	$classes=array_merge($classes, array("articles-slider","owl-carousel","owl-theme","loading" , "gap-".$slide_gap, "valign-".$slide_valign));
	
	$processed_query=$this->getProcessedQuery($instance);
	$query_result = $this->getQueryResult($instance);
	
	
	
	$speed=$slide_speed?$slide_speed:600;
	if($slide_effect=="none") $speed=0;
	
	$timeout=$slide_timeout?$slide_timeout:6000;
	
	
	
	if($query_result->have_posts()) : 
?>


<div class="<?=implode(" ",$classes)?> " 
	data-autoplay="<?=$auto_play?"true":"false"?>"   
	data-loop="<?=$slider_loop?"true":"false"?>"   
	data-autoplay-hover-pause="<?=$pause_on_hover?"true":"false"?>"
	data-autoplay-timeout="<?=$timeout?>"
	data-smart-speed="<?=$speed?>"
	
	data-nav="<?=$show_navigation?"true":"false"?>"
	data-dots="<?=$show_pager?"true":"false"?>"
	data-items="<?=$articles_to_show?>"
	data-items-responsive="<?=$articles_to_show_responsive?>"
	
	data-slide-by="<?=$page_slide?"page":"1"?>"
	data-touch-drag="<?=$articles_to_show?>"
	data-mouse-drag="<?=$enable_drag?>"
	data-fx="<?=$slide_effect?>"
    
	
	
>	


	<?php while($query_result->have_posts()) : $query_result->the_post(); ?>
		<div class="the-gap"><?php carrot_get_template_part("tile/".$post_template,"",false,$postargs);?></div>
	<?php endwhile; wp_reset_postdata(); ?>

</div>
<?php endif; ?>


<?php
	$this->carrot_widget_footer($instance);
?>