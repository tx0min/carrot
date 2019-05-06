<?php

	$this->carrot_widget_header($instance);
		
	$postargs = $this->generatePostOptions($instance);
	
	$columns=$grid_columns?$grid_columns:3;
	
	// Loop through the posts and do something with them.
	
	
	$gridclasses=$this->articlesClasses($instance);

	$gridclasses=array_merge($gridclasses, array("grid","cols-".$columns, "gap-".$grid_gap, "pagination-".$pagination_style));
	
	
	if($filters){
		$gridclasses[]="filterable";
		$gridclasses[]=$filters_condition;
		
	}

	$processed_query=$this->getProcessedQuery($instance);
	$query_result = $this->getQueryResult($instance);
	
	$variable_grid=isset($grid_use_single_sizes) && $grid_use_single_sizes;
	if($query_result->have_posts()) : 
?>

<div class="grid-container">

	<?php
		carrot_show_taxonomy_filters($filters,$processed_query);
	?>
	<div class="<?=implode(" ",$gridclasses)?>" 
		data-numpages='<?=$query_result->max_num_pages?>' 
		data-numposts='<?=$query_result->found_posts?>'
		data-query='<?=json_encode($processed_query)?>' 
		data-show-options='<?=json_encode($postargs)?>' 
		data-post-template='<?=$post_template?>' 
		
		
		>
		<div class="grid-sizer"></div>
	    <div class="gutter-sizer"></div>	
		
		<?php 
			while($query_result->have_posts()) : $query_result->the_post(); 
				$size=get_field("single_".get_post_type()."_grid_cols");

				
		?>
			<div class="tile <?=(($variable_grid&&$size)?("size-".$size):"")?>">
				<div class="the-gap">
					<?php carrot_get_template_part("tile/".$post_template,'',false,$postargs);?>
				</div>
			</div>
		<?php 
			endwhile; wp_reset_postdata(); 
		?>

	</div><!--.articles-container-->
</div><!--.grid-container-->

<?php endif; ?>


<?php
	$this->carrot_widget_footer($instance);
?>