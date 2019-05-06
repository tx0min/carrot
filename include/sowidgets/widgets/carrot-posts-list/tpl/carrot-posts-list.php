<?php

	$this->carrot_widget_header($instance);
	
	
	$classes=$this->articlesClasses($instance);
	$classes=array_merge($classes, array("list", "gap-".$list_gap));
	
	$showoptions = $this->generatePostOptions($instance);
	$query_result = $this->getQueryResult($instance);
	
	
	
	
	
	// Loop through the posts and do something with them.
	if($query_result->have_posts()) : 
?>
	<div class="<?=implode(" ",$classes)?>" >
			
		<?php while($query_result->have_posts()) : $query_result->the_post(); ?>
		<div class="the-gap">
			<?php carrot_get_template_part("tile/".$post_template,"",false,$showoptions);?>
		</div>

		<?php endwhile; wp_reset_postdata(); ?>
	</div>
<?php endif; ?>


<?php
	$this->carrot_widget_footer($instance);
?>