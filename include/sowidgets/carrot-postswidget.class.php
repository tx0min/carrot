<?php

if (!class_exists('Carrot_SiteOrigin_Posts_Widget')):
	
	class Carrot_SiteOrigin_Posts_Widget extends Carrot_SiteOrigin_Widget {
		
		function getProcessedQuery($instance){
			$instance=$this->get_template_variables($instance);
			$post_selector_pseudo_query = $instance["the_posts"];
			$processed_query = siteorigin_widget_post_selector_process_query( $post_selector_pseudo_query );
			return $processed_query;
		}
		
		function getQueryResult($instance){
			return new WP_Query( $this->getProcessedQuery($instance));
		}
		
		function articlesClasses($instance){
			$instance=$this->get_template_variables($instance);
			
			$classes=array("articles-container","post-template-".$instance["post_template"]);
			return $classes;
		}

		
		
		function generatePostOptions($instance){
			
			$instance=$this->get_template_variables($instance);
			
			$article_classes=array();
			
			$thumbcols=$instance["thumbnail_columns"];

			$thumbsize=$instance["thumbnail_format"];
			
			if(!is_array($instance["show_post_options"])) $show_post_options=array($instance["show_post_options"]);
			else $show_post_options=$instance["show_post_options"];
			
			if(!is_array($instance["author_display_options"])) $author_display_options=array($instance["author_display_options"]);
			else $author_display_options=$instance["author_display_options"];

			
			//_dump($show_post_options);
			
			$showthumb=in_array("thumbnail",$show_post_options);
			
			if(!$showthumb || $instance["thumbnail_position"]=='top' || $instance["thumbnail_position"]=='bottom'){
				$thumbcols=12;
			}
			
			
			$article_classes[]="thumb-".$instance["thumbnail_position"];
						
			$article_classes[]="text-".$instance["article_align"];
			
			if(!$instance["append_plus"]) $article_classes[]="no-plus";
			
			
			$author=false;
			
			
			if(in_array("author",$show_post_options) && $author_display_options){
				
				$author=array(
					"before"=>$instance["author_first"],
					"name"=>in_array("name",$author_display_options),
					"avatar"=>in_array("avatar",$author_display_options),
					"bio"=>in_array("bio",$author_display_options),
					"prefix"=>in_array("prefix",$author_display_options)?$instance["author_prefix"]:false, 
					"twitter"=>in_array("twitter",$author_display_options)
				);
			}
			

			$show_text=false;
			if($instance["thumbnail_text"]){
				$show_text_options=$instance["show_text_options"];
				
				$show_text=array(
					"title"=> in_array("title",$show_text_options),
					"author"=> in_array("author",$show_text_options),
					"date"=> in_array("date",$show_text_options),
					"excerpt"=> in_array("excerpt",$show_text_options)
				);

				if(in_array("taxonomy",$show_text_options)){
					$show_text["taxonomy"]=$instance["show_text_taxonomy"];
				}
			}
			
			$showoptions=array(
				"classes"=>$article_classes,
				"thumbcols"=>$thumbcols,
				"thumbsize"=>$thumbsize,
				"thumbborder"=>$instance["thumbnail_border"],
				"responsive"=>$instance["thumbnail_responsive"],
				"hovereffect"=>array(
					"effect" =>$instance["thumbnail_hover"],
					"bgcolor" =>$instance["thumbnail_hover_bg_color"],
					"fgcolor" =>$instance["thumbnail_hover_fg_color"],
					"view_more" =>$instance["thumbnail_show_view_more"],
					"view_more_icon" =>$instance["view_more_icon"],
					"show_text" =>$show_text,
					"view_more_pos_h" =>$instance["view_more_horizontal_position"],
					"view_more_pos_v" =>$instance["view_more_vertical_position"],
					"title_pos_h" =>$instance["title_horizontal_position"],
					"title_pos_v" =>$instance["title_vertical_position"],
				),
				"show_options"=>array(
					"thumbnail" =>in_array("thumbnail",$show_post_options),
					"title" =>in_array("title",$show_post_options),
					"date" =>in_array("date",$show_post_options),
					"categories" =>in_array("categories",$show_post_options),
					"tags" =>in_array("tags",$show_post_options),
					"author" =>$author,
					"excerpt" =>in_array("excerpt",$show_post_options),
					"content" =>in_array("content",$show_post_options),
					"commentscount" =>in_array("comments",$show_post_options),
				),
				"thumbnail_position"=>$instance["thumbnail_position"],
				"thumbnail_image_type"=> $instance["thumbnail_image_type"]
			);	
			return $showoptions;
		}
		
		function __construct($id,$name,$description,$fields) {
		
			$defaultfields=array(
				'the_posts' => array(
					'type' => 'posts',
					'hide' => true,
					'label' => __('Posts query', THEME_NAME),
				),
				'post_template' => array(
					'type' => 'select',
					'default' => 'default',
					'label' => __( 'Tile template', THEME_NAME ),
					'options' => carrot_get_post_templates(true),
					'state_emitter' => array(
						'callback' => 'select',
						'args' => array( 'post_template' )
					)
				),
				'style_general_section' => array(
					'type' => 'section',
					'label' => __( 'Estil' , THEME_NAME ),
					'hide' => true,
					'state_handler' => array(
						'post_template[default]' => array('show'),
						'_else[post_template]' => array( 'hide' )
					),
					'fields' => array(
						'show_post_options' => array(
							'type' => 'multicheckbox',
							'default' => array('thumbnail','title','author','excerpt','comments'),
							'orientation' => 'horizontal',
							'label' => __( 'Show post options', THEME_NAME ),
							'options' => array(
								'thumbnail' => __( 'Post Thumbnail', THEME_NAME ),
								'title' => __( 'Post Title', THEME_NAME ),
								'author' => __( 'Author', THEME_NAME ),
								'date' => __( 'Date', THEME_NAME ),
								'comments' => __( 'Comments', THEME_NAME ),
								'categories' => __( 'Categories', THEME_NAME ),
								'excerpt' => __( 'Excerpt', THEME_NAME ),
								'content' => __( 'Content', THEME_NAME ),
							)
							
						),
						'article_border_width' => array(
							'type' => 'slider',
							'label' => __( 'Border Width', THEME_NAME ),
							'default' => 0,
							'min' => 0,
							'max' => 20,
							'integer' => true,
							'css' => true,
							'units' => 'px'
						),
						'articles_style_section' => array(
							'type' => 'section',
							'label' => __( 'Tile Style' , THEME_NAME ),
							'hide' => true,
							'fields' => array(
								
								'article_align' => array(
									'type' => 'select',
									'default' => 'clean',
									'label' => __( 'Text alignment', THEME_NAME ),
									'options' => array(
										'left' => __( 'Left', THEME_NAME ),
										'center' => __( 'Center', THEME_NAME ),
										'right' => __( 'Right', THEME_NAME )
									)
								),
								
								/*'outline_articles' => array(
									'type' => 'checkbox',
									'default' => false,
									'label' => __( 'Outline articles on hover', THEME_NAME )
								),*/
								'append_plus' => array(
									'type' => 'checkbox',
									'default' => true,
									'label' => __( 'Append plus icon after excerpt', THEME_NAME )
								),
						
							)
						),
						'author_section' => array(
							'type' => 'section',
							'label' => __( 'Author Display' , THEME_NAME ),
							'hide' => true,
							'fields' => array(
								'author_display_options' => array(
									'type' => 'multicheckbox',
									'multiple' => 'true',
									'default' => array('name','prefix'),
									'orientation' => 'horizontal',
									'label' => __( 'Show author options', THEME_NAME ),
									'options' => array(
										'name' => __( 'Name', THEME_NAME ),
										'avatar' => __( 'Avatar', THEME_NAME ),
										'bio' => __( 'Bio', THEME_NAME ),
										'twitter' => __( 'Twitter', THEME_NAME ),
										'prefix' => __( 'Prefix', THEME_NAME )
									)
								),
								'author_first' => array(
									'type' => 'checkbox',
									'default' => false,
									'label' => __( 'Author before post title ', THEME_NAME )
								),
								'author_prefix'=>array(
									'type' => 'text',
									'label' => __('Prefix', THEME_NAME),
									'default' => __('Text: ',THEME_NAME)
								)
							)
						),
						'articles_thumbnail_section' => array(
							'type' => 'section',
							'label' => __( 'Thumbnail' , THEME_NAME ),
							'hide' => true,
							'fields' => array(
								'thumbnail_image_type' => array(
									'type' => 'select',
									'default' => 'featured',
									'label' => __( 'Image Type', THEME_NAME ),
									'options' => array(
										/*'none' => __( 'No thumbnail', THEME_NAME ),*/
										'featured' => __( 'Featured Image', THEME_NAME ),
										'author' => __( 'Author Image', THEME_NAME ),
										'type' => __( 'Post Type Image', THEME_NAME )
									)
								),
								'thumbnail_format' => array(
									'type' => 'select',
									'default' => 'top',
									'label' => __( 'Format', THEME_NAME ),
									'options' => carrot_get_thumbsizes_dropdown()
									/*array(
										
										'landscape' => __( 'Landscape', THEME_NAME ),
										'portrait' => __( 'Portrait', THEME_NAME ),
										'square' => __( 'Square', THEME_NAME )
									)*/
								),
								'thumbnail_position' => array(
									'type' => 'select',
									'default' => 'top',
									'label' => __( 'Position', THEME_NAME ),
									'options' => array(
										/*'none' => __( 'No thumbnail', THEME_NAME ),*/
										'left' => __( 'Left', THEME_NAME ),
										'right' => __( 'Right', THEME_NAME ),
										'top' => __( 'Top', THEME_NAME ),
										'bottom' => __( 'Bottom', THEME_NAME ),
									),
									'state_emitter' => array(
										'callback' => 'select',
										'args' => array( 'thumbnail_position' )
									),
								),
								'thumbnail_columns' => array(
									'type' => 'slider',
									'label' => __( 'Columns', THEME_NAME ),
									'default' => 4,
									'min' => 1,
									'max' => 11,
									'integer' => true,
									'state_handler' => array(
										'thumbnail_position[top]' => array('hide'),
										'thumbnail_position[bottom]' => array('hide'),
										'_else[thumbnail_position]' => array( 'show' )
									),
								),
								'thumbnail_responsive' => array(
									'type' => 'checkbox',
									'label' => __( 'Thumb is responsive', THEME_NAME ),
									'default' => false,
									'state_handler' => array(
										'thumbnail_position[top]' => array('hide'),
										'thumbnail_position[bottom]' => array('hide'),
										'_else[thumbnail_position]' => array( 'show' )
									),
								),
								/*'thumbnail_border' => array(
									'type' => 'checkbox',
									'label' => __( 'Thumbnail border', THEME_NAME ),
									'default' => false
								),*/
								'thumbnail_effect' => array(
									'type' => 'section',
									'label' => __( 'Hover Effect' , THEME_NAME ),
									'hide' => true,
									'fields' => array(
										'thumbnail_hover' => array(
											'type' => 'select',
											'label' => __( 'Effect on hover', THEME_NAME ),
											'default' => 'zoom',
											'options'=> array(
												'none' => __("No effect",THEME_NAME ),
												'opacity' => __("Opacity", THEME_NAME ),
												'zoom' => __("Zoom",THEME_NAME ),
											),
											'state_emitter' => array(
												'callback' => 'select',
												'args' => array( 'thumbnail_hover' )
											),
										),
										'thumbnail_hover_bg_color' => array(
											'type' => 'themecolor',
											'label' => __( 'BG color', THEME_NAME),
											'default' => 'primary',
											'css' => true,
										),
										'thumbnail_hover_fg_color' => array(
											'type' => 'themecolor',
											'label' => __( 'FG color', THEME_NAME),
											'description' => __( 'Only applicable when custom BG color is chosen', THEME_NAME),
											'default' => false,
											'css' => true,
										),
										'thumbnail_show_view_more_section' => array(
											'type' => 'section',
											'label' => __( 'View more icon' , THEME_NAME ),
											'hide' => true,
											'fields' => array(
												'thumbnail_show_view_more' => array(
													'type' => 'checkbox',
													'label' => __( 'Show view more icon', THEME_NAME ),
													'default' => true,
													'state_handler' => array(
														'thumbnail_hover[none]' => array('hide'),
														'_else[thumbnail_hover]' => array( 'show' )
													),
												),
												'view_more_icon' => array(
													'type' => 'icon',
													'label' => __('Icon', THEME_NAME),
													'state_handler' => array(
														'thumbnail_hover[none]' => array('hide'),
														'_else[thumbnail_hover]' => array( 'show' )
													),
												),
												'view_more_size' => array(
													'type' => 'slider',
													'label' => __( 'View more icon size', THEME_NAME ),
													'default' => 24,
													'min' => 1,
													'max' => 100,
													'integer' => true,
													'css' => true,
													'units' => 'px'
												),
												'view_more_border_width' => array(
													'type' => 'slider',
													'label' => __( 'View more icon Border Width', THEME_NAME ),
													'default' => 2,
													'min' => 0,
													'max' => 20,
													'integer' => true,
													'css' => true,
													'units' => 'px'
												),
												'view_more_border_radius' => array(
													'type' => 'slider',
													'label' => __( 'View more icon Border radius', THEME_NAME ),
													'default' => 50,
													'min' => 0,
													'max' => 100,
													'integer' => true,
													'css' => true,
													'units' => 'px'
												),
												'view_more_vertical_position' => array(
													'type' => 'select',
													'label' => __( 'View more icon vertical position', THEME_NAME ),
													'default' => 'middle',
													'options'=> array(
														'top' => __("Top",THEME_NAME ),
														'middle' => __("Middle", THEME_NAME ),
														'bottom' => __("Bottom",THEME_NAME ),
													),
													'state_handler' => array(
														'thumbnail_hover[none]' => array('hide'),
														'_else[thumbnail_hover]' => array( 'show' )
													),
												),
												'view_more_horizontal_position' => array(
													'type' => 'select',
													'label' => __( 'View more icon horizontal position', THEME_NAME ),
													'default' => 'center',
													'options'=> array(
														'left' => __("Left",THEME_NAME ),
														'center' => __("Center", THEME_NAME ),
														'right' => __("Right",THEME_NAME ),
													),
													'state_handler' => array(
														'thumbnail_hover[none]' => array('hide'),
														'_else[thumbnail_hover]' => array( 'show' )
													),
												),
											)
										),
										'thumbnail_text_section' => array(
											'type' => 'section',
											'label' => __( 'Text' , THEME_NAME ),
											'hide' => true,
											'fields' => array(
												'thumbnail_text' => array(
													'type' => 'checkbox',
													'label' => __( 'Show Text', THEME_NAME ),
													'default' => false,
													'state_handler' => array(
														'thumbnail_hover[none]' => array('hide'),
														'_else[thumbnail_hover]' => array( 'show' )
													),
													
												),
												
												'show_text_options' => array(
													'type' => 'multicheckbox',
													'default' => array('title'),
													'orientation' => 'horizontal',
													'label' => __( 'Show text options', THEME_NAME ),
													'options' => array(
														'title' => __( 'Post Title', THEME_NAME ),
														'author' => __( 'Author', THEME_NAME ),
														'date' => __( 'Date', THEME_NAME ),
														'taxonomy' => __( 'Taxonomy', THEME_NAME ),
														'excerpt' => __( 'Excerpt', THEME_NAME )
													),
													'state_emitter' => array(
														'callback' => 'select',
														'args' => array( 'show_text_options' )
													),
												),

												'show_text_taxonomy' => array(
													'type' => 'taxonomytypeselect',
													'default' => array('category'),
													'orientation' => 'horizontal',
													'label' => __( 'Show entry taxonomy', THEME_NAME )
													
												),

												'title_vertical_position' => array(
													'type' => 'select',
													'label' => __( 'Text vertical position', THEME_NAME ),
													'default' => 'bottom',
													'options'=> array(
														'top' => __("Top",THEME_NAME ),
														'middle' => __("Middle", THEME_NAME ),
														'bottom' => __("Bottom",THEME_NAME ),
													),
													'state_handler' => array(
														'thumbnail_hover[none]' => array('hide'),
														'_else[thumbnail_hover]' => array( 'show' )
													),
												),
												'title_horizontal_position' => array(
													'type' => 'select',
													'label' => __( 'Text horizontal position', THEME_NAME ),
													'default' => 'center',
													'options'=> array(
														'left' => __("Left",THEME_NAME ),
														'center' => __("Center", THEME_NAME ),
														'right' => __("Right",THEME_NAME ),
													),
													'state_handler' => array(
														'thumbnail_hover[none]' => array('hide'),
														'_else[thumbnail_hover]' => array( 'show' )
													),
												),
											)
										)
									)
								)
							)
						)
					)
				)
			);
			
			if(is_array($fields)) $defaultfields=array_merge($defaultfields,$fields);
			
			parent::__construct($id, $name,$description,$defaultfields);
			
		}
		
	
	}
	
endif;