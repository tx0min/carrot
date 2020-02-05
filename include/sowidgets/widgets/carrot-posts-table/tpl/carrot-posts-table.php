<?php

	$this->carrot_widget_header($instance);
	
	
	$classes=[];
	$this->articlesClasses($instance);
	$classes=array_merge($classes, array("table","posts-table"));
	
	$showoptions = $this->generatePostOptions($instance);
	$query_result = $this->getQueryResult($instance);
	
	
	
	
	
	// Loop through the posts and do something with them.
	if($query_result->have_posts()) : 
?>
	<?php if($table_columns){?>
		<div class="table-responsive">
			<table class="<?=implode(" ",$classes)?>" >
			
				<thead>
					<tr>
						<?php foreach($table_columns as $column){ ?>
							<th><?=$column["column_name"]?></th>
						<?php } ?>
					</tr>
					
				</thead>
				<tbody>
					<?php while($query_result->have_posts()) : $query_result->the_post(); ?>

					<tr>
						<?php foreach($table_columns as $column){ ?>
							<td>
								
								<?=carrot_renderPostField($column["column_custom_field"]?$column["column_custom_field"]:$column["column_field"],$column["column_link"])?>

								
							</td>
						<?php } ?>
					</tr>

					<?php endwhile; wp_reset_postdata(); ?>
				</tbody>
			</table>
		</div>
	<?php } ?>

<?php endif; ?>


<?php
	$this->carrot_widget_footer($instance);
?>