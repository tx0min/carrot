<?php
/*
Widget Name: Posts Grid
Description: Displays a grid of posts.
Author: Carrot
*/




class Carrot_Posts_Grid_Widget extends Carrot_SiteOrigin_Posts_Widget {
	
	function custom_variables( $instance ){ }
	
	
		
	function __construct() {
		parent::__construct(
			'carrot-posts-grid', 
			'Carrot Posts Grid', 
			'Displays a grid of posts.' ,

			array(
				'grid_section' => array(
					'type' => 'section',
					'label' => __( 'Grid Options' , THEME_NAME ),
					'hide' => true,
					'fields' => array(
						'grid_columns' => array(
							'type' => 'slider',
							'default' => 3,
							'min' => 1,
							'max' => 6,
							'integer' => true,
							'label' => __( 'Grid Columns', THEME_NAME )
						),
						'grid_gap' => array(
							'type' => 'select',
							'default' => 'small',
							'label' => __( 'Grid Gap', THEME_NAME ),
							'options' => carrot_availableGaps()
						),
						'grid_use_single_sizes' => array(
							'type' => 'checkbox',
							'label' => __( 'Use variable grid sizes', THEME_NAME ),
							'default' => 0,
							'description' => __( 'You can set each article grid size individually.', THEME_NAME),
											
						),
						'pagination_style' => array(
							'type' => 'select',
							'label' => __( 'Pagination Style', THEME_NAME ),
							'default' => 'arrows',
							'options' => array(
								'none' => __( 'No pagination', THEME_NAME ),
								'arrows' => __( 'Next and Previous arrows', THEME_NAME ),
								'numbers' => __( 'Numbered pagination', THEME_NAME ),
								'dots' => __( 'Dotted pagination', THEME_NAME ),
								'loadmore' => __( 'Load More Button', THEME_NAME ),
								'lazyload' => __( 'Lazy Load', THEME_NAME ),
							)
						),
						
						'filters' => array(
							'type' => 'repeater',
							'label' => __( 'Filters' , THEME_NAME ),
							'item_name'  => __( 'Filter', THEME_NAME ),
							'item_label' => array(
								'selector'     => "[id*='filter_title']",
								'update_event' => 'change',
								'value_method' => 'val'
							),
							'fields' => array(
								'filter_title' => array(
									'type' => 'text',
									'label' => __( 'Filter Title', THEME_NAME )
								),
								'hide_filter_title' => array(
									'type' => 'checkbox',
									'label' => __( 'Hide Title', THEME_NAME ),
									'default' => true,
								),
								'taxonomy_filter' => array(
									'type' => 'taxonomytypeselect',
									'label' => __( 'Filtering', THEME_NAME ),
									'multiple' => false ,
									'default' => false,
									'required' => true 
								),
								'filter_required' => array(
									'type' => 'checkbox',
									'label' => __( 'Required', THEME_NAME ),
									'default' => true,
								),
								'filter_multiplicity' => array(
									'type' => 'select',
									'label' => __( 'Terms to select', THEME_NAME ),
									'default' => 'single',
									'required' => true,
									'options' => array(
										'single' => __( 'Single', THEME_NAME ),
										'multiple' => __( 'Multiple', THEME_NAME )
									),
									'state_emitter' => array(
										'callback' => 'select',
										'args' => array( 'filter_multiplicity' )
									),						
								),
								'filter_condition' => array(
									'type' => 'select',
									'label' => __( 'Filter terms condition', THEME_NAME ),
									'default' => 'AND',
									'required' => true,
									'options' => array(
										'AND' => __( 'All the terms', THEME_NAME ),
										'OR' => __( 'Any term', THEME_NAME )
									),
									'state_handler' => array(
										'filter_multiplicity[single]' => array('hide'),
										'_else[filter_multiplicity]' => array( 'show' )
									),					
								),

								
								'filter_style' => array(
									'type' => 'select',
									'label' => __( 'Filter style', THEME_NAME ),
									'default' => 'list',
									'options' => array(
										'list' => __( 'List', THEME_NAME ),
										'dropdown' => __( 'Dropdown', THEME_NAME )
									)
								),
								'filter_align' => array(
									'type' => 'select',
									'label' => __( 'Align', THEME_NAME ),
									'default' => 'left',
									'options' => array(
										'left' => __( 'Left', THEME_NAME ),
										'center' => __( 'Center', THEME_NAME ),
										'right' => __( 'Right', THEME_NAME )
									)
								),
								
							)
						),
						'filters_condition' => array(
							'type' => 'select',
							'label' => __( 'Filters condition', THEME_NAME ),
							'default' => 'AND',
							'required' => true,
							'options' => array(
								'AND' => __( 'All the filters', THEME_NAME ),
								'OR' => __( 'Any filter', THEME_NAME )
							)							
						),
						
					)
				),

				
				
			)
		);
	}
	
	function initialize() {

      /*  $this->register_frontend_scripts(
            array(
                array(
                    'carrot-posts-grid',
                    CARROT_SO_WIDGETS_URI . '/widgets/carrot-posts-grid/js/carrot-posts-grid.js',
                    array('jquery')
                    
                ),
            )
        );*/
		
		wp_enqueue_script( 'carrot-posts-grid', CARROT_SO_WIDGETS_URI. '/widgets/carrot-posts-grid/js/carrot-posts-grid.js', array('jquery') );
		wp_localize_script( 'carrot-posts-grid', 'carrot_grid_ajax',
			array(
				'url'   => CARROT_SO_WIDGETS_URI. '/widgets/carrot-posts-grid/tpl/posts.php',
				'texts' =>array(
					"load_more" =>__("Load more",THEME_NAME),  
					"loading" =>__("Loading...",THEME_NAME), 
					"no_more_results" =>__("No more items",THEME_NAME),
					"no_results" =>__("No results",THEME_NAME),
					"older" =>__("Older posts",THEME_NAME),
					"newer" =>__("Newer posts",THEME_NAME),
					"choose_filter" =>__("Choose filter",THEME_NAME)
				),
				'icons' => array(
					"right" => _icon("icon_angle_right"),
					"left" => _icon("icon_angle_left"),
					"loading" => _icon("icon_loading","spin"),
					"pagination" => _icon("icon_pagination_item")
				)
			)
			
		);
		
        $this->register_frontend_styles(array(
            array(
                'carrot-posts-grid',
                CARROT_SO_WIDGETS_URI . '/widgets/carrot-posts-grid/styles/grid.css'
            )
        ));
		
		
		
		
		
    }
	
}

siteorigin_widget_register('carrot-posts-grid-widget', __FILE__, 'Carrot_Posts_Grid_Widget');


function carrot_posts_grid_add_taxonomy_filter($taxonomy,$filters){

}

function carrot_posts_grid_filter_exists($taxonomy,$filters){
	//_dump($taxonomy);
	//_dump($filters);
	if(!$filters) return false;
	
	foreach($filters as $filter){
		if($filter["taxonomy_filter"]==$taxonomy) return true;
	}
}

function carrot_posts_grid_add_selected_to_filter($filters,$taxonomy,$terms,$field="slug"){
	if($filters){
		foreach($filters as $key=>$filter){
			
			if($filter["taxonomy_filter"]==$taxonomy){
				//_dump($filters[$key]);
				//_dump($taxonomy);
				if(!array_key_exists("selected_slugs",$filters[$key])) $filters[$key]["selected_slugs"]=array();
				if(!array_key_exists("selected_ids",$filters[$key])) $filters[$key]["selected_ids"]=array();
				if($field=="slug") $filters[$key]["selected_slugs"]=array_merge($filters[$key]["selected_slugs"],explode(",",$terms));
				if($field=="id") $filters[$key]["selected_ids"]=array_merge($filters[$key]["selected_ids"],explode(",",$terms));
				
				//_dump($filters[$key]);
			}
		}
	}
	return $filters;
}



function carrot_show_taxonomy_filters($filters,$processed_query){

	if($filters){
		//_dump($filters);
		//_dump($processed_query);
		$querytaxes=array();
		
		//si ja té una query previa 
		if(array_key_exists("tax_query",$processed_query)){
			foreach($processed_query["tax_query"] as $tax_query){
				
				if(is_array($tax_query) && carrot_posts_grid_filter_exists($tax_query["taxonomy"],$filters)){
					$filters=carrot_posts_grid_add_selected_to_filter($filters, $tax_query["taxonomy"], $tax_query["terms"],$tax_query["field"]);
				}
			}
			
		}
		//_dump($filters);
		
		
		foreach($filters as $filter){
			$tax=$filter["taxonomy_filter"];
			$title=$filter["filter_title"];
			$hide=$filter["hide_filter_title"];
			$multiple=$filter["filter_multiplicity"]=="multiple";
			$style=$filter["filter_style"];
			$required=$filter["filter_required"];
			$align="text-".$filter["filter_align"];
		
			
			
?>
		<div class="grid-filter <?=$align?> <?=$style?> <?=$filter["filter_multiplicity"]?>" data-taxonomy="<?=$tax?>" data-condition="<?=$filter["filter_condition"]?>">
			<?php if(!$hide){ ?>
				<h3><?=$title?></h3>
			<?php } ?>
			<?php if($style=="list"){ ?>
				<ul>
					<?php if(!$required){ ?><li><a href="#"><?=__("Reset",THEME_NAME)?></a></li> <?php } ?>
			<?php }else{ ?>
				<select <?=$multiple?"multiple":""?> class="select2" data-taxonomy="<?=$tax?>" data-required="<?=$required?"true":"false"?>">
					<?php if(!$required){ ?><option></option><?php } ?>
			<?php } ?>
			
				<?php 
					$terms=carrot_get_taxonomies($tax,true,"name","ASC"); 
					if($terms){
						foreach($terms as $term){
							$preselected=in_array($term->slug,$filter["selected_slugs"]);
							
							//_dump($term);
				?>
					<?php if($style=="list"){ ?>
						<li <?=$preselected?"class='selected required'":""?> ><a href="#<?=$tax?>_<?=$term->term_id?>" data-taxonomy="<?=$tax?>" data-tax-id="<?=$term->term_id?>" ><?=$term->name?></a></li>
					<?php }else{ ?>
						<option <?=$preselected?"selected='true'":""?>  value="<?=$term->term_id?>"  ><?=$term->name?></option>
					<?php } ?>
				<?php
						}
					}
				?>
			<?php if($style=="list"){ ?></ul><?php }else{ ?></select><?php } ?>
			
		</div>
<?php
		}
	}

}


	