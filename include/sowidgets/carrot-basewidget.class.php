<?php

if (!class_exists('Carrot_SiteOrigin_Widget')):
	
	class Carrot_SiteOrigin_Widget extends SiteOrigin_Widget {
		
		public $widget_type;

		function color_options(){
			return array(
				'' => '--',
				'primary' => __('Primary', THEME_NAME),
				'alt' => __('Alternate', THEME_NAME),
				'borders' => __('Borders', THEME_NAME),
				'white' => __('White', THEME_NAME),
				'black' => __('Black', THEME_NAME),
			);
		}
		
		function custom_variables($instance){}

		function get_style_name($instance) {
		   return $this->widget_type;

		}
		
		function get_template_name($instance) {
			return $this->widget_type;
		}
		

		function get_template_variables( $instance ,$args=false,$options=false){
			$ret=array();
			
			if(!$options) $options=$this->form_options;
			
			if(is_array($options)){
				foreach($options as $key=>$value){
					if($value["type"]=="section"){
						$ret=array_merge($ret,$this->get_template_variables($instance[$key],$args,$value["fields"]));
					}else{
						$ret[$key]=! empty($instance[$key]) ? $instance[$key] : '';
						if(array_key_exists('units',$value)){
							$ret[$key.'_'.$value['units']]= $ret[$key].$value['units'];
						}
						if($value["type"]=="media"){
							$ret[$key.'_url']= "url(".carrot_get_attachment_url($ret[$key],"full").")";
						}
					}
				}
			}
			
			
			$custom=$this->custom_variables($ret);
			if(is_array($custom)){
				$ret=array_merge($ret,$custom);
			}
			//_dump($ret);
			
			return $ret;
		}
		
		function get_less_variables( $instance ,$options=false) {
			
			$ret=array();
			
			if(!$options) $options=$this->form_options;
			
			if(is_array($options)){
				foreach($options as $key=>$value){
					
					if($value["type"]=="section"){
						if(array_key_exists($key,$instance)) $ret=array_merge($ret,$this->get_less_variables($instance[$key],$value["fields"]));
					}else if(array_key_exists('css',$value) && $value['css']){
						if($value["type"]=="font"){
							$selected_font = siteorigin_widget_get_font($instance[$key]);
							$ret[$key]=$selected_font['family'];
							if( ! empty( $selected_font['weight'] )){
								$ret[$key.'_weight'] = $selected_font['weight'];
							}
						}else{
							//_dump($key.":".$instance[$key]);
							
							if(isset($instance[$key]) && $instance[$key]!==false){
								$ret[$key]= $instance[$key];//!='' ? $instance[$key] : '';
								//_dump($ret[$key]);
								if(array_key_exists('units',$value)){
									$ret[$key.'_'.$value['units']]= $ret[$key].$value['units'];
								}
								if($value["type"]=="media"){
									$ret[$key.'_url']= "url(".carrot_get_attachment_url($ret[$key],"full").")";
								}
							}
						}
					}
				}
			}
			
			
			return $ret;
			
		
		}
		
		
		function carrot_widget_header($instance){
			$this->widget_id=$this->widget_type."_".$instance["_sow_form_id"];
		
			$vars=$this->get_template_variables( $instance );
			
			$widget_classes=array('carrot-widget',$this->widget_type);
			$header_classes=array('widget-header');
			
			if($vars['header_border_bottom_width']>0){
				$widget_classes[]="header-border-bottom";
			}
			if(!preg_match('|^#|', $vars['header_background_color'])) $header_classes[]="bg-".$vars['header_background_color'];
			else $header_classes[]="bg-custom";
			
			if(!preg_match('|^#|', $vars['header_text_color'])) $header_classes[]="text-".$vars['header_text_color'];
			else $header_classes[]="text-custom";
			
			if(!preg_match('|^#|', $vars['box_background_color'])) $widget_classes[]="bg-".$vars['box_background_color'];
			else $widget_classes[]="bg-custom";
			
			
			if(!preg_match('|^#|', $vars['box_text_color'])) $widget_classes[]="text-".$vars['box_text_color'];
			else $widget_classes[]="text-custom";
			
			if($vars['box_borders_even']) $widget_classes[]="border-even";
			else $widget_classes[]="border-not-even";
			
			if(!preg_match('|^#|', $vars['box_border_color'])) $widget_classes[]="border-".$vars['box_border_color'];
			else $widget_classes[]="border-custom";
			
			if(!preg_match('|^#|', $vars['box_border_top_color'])) $widget_classes[]="border-top-".$vars['box_border_top_color'];
			else $widget_classes[]="border-top-custom";
			
			if(!preg_match('|^#|', $vars['box_border_bottom_color'])) $widget_classes[]="border-bottom-".$vars['box_border_bottom_color'];
			else $widget_classes[]="border-bottom-custom";
			
			if(!preg_match('|^#|', $vars['box_border_left_color'])) $widget_classes[]="border-left-".$vars['box_border_left_color'];
			else $widget_classes[]="border-left-custom";
			
			if(!preg_match('|^#|', $vars['box_border_right_color'])) $widget_classes[]="border-right-".$vars['box_border_right_color'];
			else $widget_classes[]="border-right-custom";
			
			
			if(!preg_match('|^#|', $vars['header_border_top_color'])) $header_classes[]="border-top-".$vars['header_border_top_color'];
			else $header_classes[]="border-top-custom";
			
			if(!preg_match('|^#|', $vars['header_border_bottom_color'])) $header_classes[]="border-bottom-".$vars['header_border_bottom_color'];
			else $header_classes[]="border-bottom-custom";
			
			
			//$this->widget_id=uniqid($id.'_');
			
			
		?>

			<div id="carrot-widget-<?=$this->widget_id?>" class=" <?=implode(" ",$widget_classes)?> ">
				<?php if($vars['show_header']){?>
				<div class="<?=implode(" ",$header_classes)?>">
					<h3>
						<?php 
							//_dump($vars);
							if($vars["title_icon_image"]){
								echo "<img class='header_thumb' src='".carrot_get_attachment_url($vars["title_icon_image"],"thumbnail")."'/>";
							}else{
								if($vars["title_icon"]) echo siteorigin_widget_get_icon( $vars['title_icon']);
							}
						?>
						<?php echo $vars['title']; ?>
						
					</h3>
					<div class="header-nav">
						
						
						<?php
							if(array_key_exists("the_posts",$vars)){
								$url=get_query_link($vars['the_posts']);
						?>
						<?php if($vars["show_navigation"]){?><a id="carrot-widget-prev-<?=$this->widget_id?>" class="carrot-widget-nav carrot-widget-prev"><?=_icon("icon_angle_left")?></a><?php } ?>
						<?php if($vars["show_pager"]){?><div id="carrot-widget-pager-<?=$this->widget_id?>" class="carrot-widget-nav carrot-widget-pager"></div><?php } ?>
						<?php if($vars["show_navigation"]){?><a id="carrot-widget-next-<?=$this->widget_id?>" class="carrot-widget-nav carrot-widget-next"><?=_icon("icon_angle_right")?></a><?php } ?>
						<?php if($vars["show_more"]){?>	<a class="carrot-widget-nav" href="<?=$url?>"><?=_icon("icon_plus")?></a><?php } ?>
						<?php
							}
						?>
						
						
						
					</div>
				</div>
				<?php } ?>
	
		
		
				<div class="widget-body">	
		<?php		
		}


		function carrot_widget_footer(){
		?>
				</div>
			</div>		
		<?php
		}
		
		function less_import_base_styles( $instance, $args ) {
			
			$fonts=$this->less_import_google_fonts($instance, $args);
			
			$ret="";
			if(is_array($fonts)){
				$ret=implode("\n",$fonts);
			}
			$ret.="\n";
			
		
			$ret.= file_get_contents( CARROT_SO_WIDGETS_DIR. "/assets/style/style.less" )."\n\n";
			//_dump($ret);
			//die();
			return $ret;
			
		}
		
		
		function less_import_google_fonts( $instance, $args ) {
			//_dump($instance);
			$vars=$this->get_less_variables($instance);
			//_dump($vars);
			$fonts=array();
			foreach($vars as $key=>$value){
				if(startsWith($key,"font_")){
					$selected_font = siteorigin_widget_get_font( $value );
					if(is_array($selected_font) && array_key_exists('css_import',$selected_font))
					$fonts[]=$selected_font['css_import'];
			
				}
			}
			
			return $fonts;
		}
		
		
		
		function __construct($id,$name,$description,$fields) {
		
			
			$this->widget_type=$id;
			
			
			
			$this->fields=array(
				'title' => array(
					'type' => 'text',
					'label' => __('Title', THEME_NAME),
					'default' => 'Widget Title'
				),
				'style_section' => array(
					'type' => 'section',
					'label' => __( 'Widget Style' , THEME_NAME ),
					'hide' => true,
					'fields' => array(
						'font_general' => array(
							'type' => 'font',
							'label' => __('Font Family', THEME_NAME),
							'css' => true,
						),
						'box_background_color'=> array(
							'type' => 'themecolor',
							'label' => __( 'Background color', THEME_NAME),
							'default' => false,
							'css' => true,
						),
						'box_text_color'=> array(
							'type' => 'themecolor',
							'label' => __( 'Text color', THEME_NAME),
							'default' => false,
							'css' => true,
						),
						'box_dimensions_section' => array(
							'type' => 'section',
							'label' => __( 'Box Margins' , THEME_NAME ),
							'hide' => true,
							'fields'=>array(
								'box_margin'=> array(
									'type' => 'dimensions',
									'label' => __( 'Margin', THEME_NAME),
									'default' => false,
									'css' => true,
								),
								'box_padding'=> array(
									'type' => 'dimensions',
									'label' => __( 'Padding', THEME_NAME),
									'default' => false,
									'css' => true,
								)
							)
						),
						'style_border_section' => array(
							'type' => 'section',
							'label' => __( 'Box Border' , THEME_NAME ),
							'hide' => true,
							'fields' => array(
								'box_borders_even' => array(
									'type' => 'checkbox',
									'label' => __( 'Apply the same value to all?', THEME_NAME ),
									'default' => 1,
									/*'state_emitter' => array(
										'callback' => 'conditional',
										'args' => array(
											'box_borders_even[active]: true',
											'box_borders_even[inactive]: false',
										)
									),*/
								),
								'style_box_border_all_section' => array(
									'type' => 'section',
									'label' => __( 'Border All' , THEME_NAME ),
									'hide' =>true,
									/*'state_handler' => array(
										'box_borders_even[top]' => array('hide'),
										'thumbnail_position[bottom]' => array('hide'),
										'_else[thumbnail_position]' => array( 'show' )
									),*/
									'fields' => array(
										'box_border_width' => array(
											'type' => 'slider',
											'label' => __( 'Border Width', THEME_NAME ),
											'default' => 0,
											'min' => 0,
											'max' => 20,
											'integer' => true,
											'css' => true,
											'units' => 'px'
										),
										'box_border_color' => array(
											'type' => 'themecolor',
											'label' => __( 'Border color', THEME_NAME),
											'default' => false,
											'css' => true,
										),
										'box_border_style' => array(
											'type' => 'select',
											'label' => __( 'Border style', THEME_NAME),
											'default' => 'solid',
											'css' => true,
											'options' => array(
												'none' => __( 'No border', THEME_NAME ),
												'solid' => __( 'Solid', THEME_NAME ),
												'dotted' => __( 'Dotted', THEME_NAME ),
												'dashed' => __( 'Dashed', THEME_NAME ),
												'double' => __( 'Double', THEME_NAME ),
											)
										),
										'box_border_radius' => array(
											'type' => 'slider',
											'label' => __( 'Border radius', THEME_NAME ),
											'default' => 0,
											'min' => 0,
											'max' => 100,
											'integer' => true,
											'css' => true,
											'units' => 'px'
										),
									)
								),
								'style_box_border_top_section' => array(
									'type' => 'section',
									'label' => __( 'Border Top' , THEME_NAME ),
									'hide' =>true,
									'fields' => array(
										'box_border_top_width' => array(
											'type' => 'slider',
											'label' => __( 'Border Width', THEME_NAME ),
											'default' => 0,
											'min' => 0,
											'max' => 20,
											'integer' => true,
											'css' => true,
											'units' => 'px'
										),
										'box_border_top_color' => array(
											'type' => 'themecolor',
											'label' => __( 'Border color', THEME_NAME),
											'default' => false,
											'css' => true,
										),
										'box_border_top_style' => array(
											'type' => 'select',
											'label' => __( 'Border style', THEME_NAME),
											'default' => 'solid',
											'css' => true,
											'options' => array(
												'none' => __( 'No border', THEME_NAME ),
												'solid' => __( 'Solid', THEME_NAME ),
												'dotted' => __( 'Dotted', THEME_NAME ),
												'dashed' => __( 'Dashed', THEME_NAME ),
												'double' => __( 'Double', THEME_NAME ),
											)
										),
										'box_border_top_radius' => array(
											'type' => 'slider',
											'label' => __( 'Border radius', THEME_NAME ),
											'default' => 0,
											'min' => 0,
											'max' => 100,
											'integer' => true,
											'css' => true,
											'units' => 'px'
										),
									)
								),
								'style_box_border_right_section' => array(
									'type' => 'section',
									'label' => __( 'Border Right' , THEME_NAME ),
									'hide' =>true,
									'fields' => array(
										'box_border_right_width' => array(
											'type' => 'slider',
											'label' => __( 'Border Width', THEME_NAME ),
											'default' => 0,
											'min' => 0,
											'max' => 20,
											'integer' => true,
											'css' => true,
											'units' => 'px'
										),
										'box_border_right_color' => array(
											'type' => 'themecolor',
											'label' => __( 'Border color', THEME_NAME),
											'default' => false,
											'css' => true,
										),
										'box_border_right_style' => array(
											'type' => 'select',
											'label' => __( 'Border style', THEME_NAME),
											'default' => 'solid',
											'css' => true,
											'options' => array(
												'none' => __( 'No border', THEME_NAME ),
												'solid' => __( 'Solid', THEME_NAME ),
												'dotted' => __( 'Dotted', THEME_NAME ),
												'dashed' => __( 'Dashed', THEME_NAME ),
												'double' => __( 'Double', THEME_NAME ),
											)
										),
										'box_border_right_radius' => array(
											'type' => 'slider',
											'label' => __( 'Border radius', THEME_NAME ),
											'default' => 0,
											'min' => 0,
											'max' => 100,
											'integer' => true,
											'css' => true,
											'units' => 'px'
										),
									)
								),
								'style_box_border_bottom_section' => array(
									'type' => 'section',
									'label' => __( 'Border Bottom' , THEME_NAME ),
									'hide' =>true,
									'fields' => array(
										'box_border_bottom_width' => array(
											'type' => 'slider',
											'label' => __( 'Border Width', THEME_NAME ),
											'default' => 0,
											'min' => 0,
											'max' => 20,
											'integer' => true,
											'css' => true,
											'units' => 'px'
										),
										'box_border_bottom_color' => array(
											'type' => 'themecolor',
											'label' => __( 'Border color', THEME_NAME),
											'default' => false,
											'css' => true,
										),
										'box_border_bottom_style' => array(
											'type' => 'select',
											'label' => __( 'Border style', THEME_NAME),
											'default' => 'solid',
											'css' => true,
											'options' => array(
												'none' => __( 'No border', THEME_NAME ),
												'solid' => __( 'Solid', THEME_NAME ),
												'dotted' => __( 'Dotted', THEME_NAME ),
												'dashed' => __( 'Dashed', THEME_NAME ),
												'double' => __( 'Double', THEME_NAME ),
											)
										),
										'box_border_bottom_radius' => array(
											'type' => 'slider',
											'label' => __( 'Border radius', THEME_NAME ),
											'default' => 0,
											'min' => 0,
											'max' => 100,
											'integer' => true,
											'css' => true,
											'units' => 'px'
										),
									)
								),
								'style_box_border_left_section' => array(
									'type' => 'section',
									'label' => __( 'Border Left' , THEME_NAME ),
									'hide' =>true,
									'fields' => array(
										'box_border_left_width' => array(
											'type' => 'slider',
											'label' => __( 'Border Width', THEME_NAME ),
											'default' => 0,
											'min' => 0,
											'max' => 20,
											'integer' => true,
											'css' => true,
											'units' => 'px'
										),
										'box_border_left_color' => array(
											'type' => 'themecolor',
											'label' => __( 'Border color', THEME_NAME),
											'default' => false,
											'css' => true,
										),
										'box_border_left_style' => array(
											'type' => 'select',
											'label' => __( 'Border style', THEME_NAME),
											'default' => 'solid',
											'css' => true,
											'options' => array(
												'none' => __( 'No border', THEME_NAME ),
												'solid' => __( 'Solid', THEME_NAME ),
												'dotted' => __( 'Dotted', THEME_NAME ),
												'dashed' => __( 'Dashed', THEME_NAME ),
												'double' => __( 'Double', THEME_NAME ),
											)
										),
										'box_border_left_radius' => array(
											'type' => 'slider',
											'label' => __( 'Border radius', THEME_NAME ),
											'default' => 0,
											'min' => 0,
											'max' => 100,
											'integer' => true,
											'css' => true,
											'units' => 'px'
										),
									)
								),
								
							)
						),
						'header_section' => array(
							'type' => 'section',
							'label' => __( 'Header' , THEME_NAME ),
							'hide' => true,
							'fields' => array(
								'show_header' => array(
									'type' => 'checkbox',
									'default' => false,
									'label' => __( 'Show header', THEME_NAME )
								),
								'font_header' => array(
									'type' => 'font',
									'label' => __('Font Family', THEME_NAME),
									'css' => true,
								),
								'title_icon' => array(
									'type' => 'icon',
									'label' => __('Icon', THEME_NAME),
								),
								'title_icon_image' => array(
									'type' => 'media',
									'label' => __('Icon Image', THEME_NAME),
									'choose' => __( 'Choose image', THEME_NAME ),
									'update' => __( 'Set image', THEME_NAME ),
									'library' => 'image',
									'fallback' => true
								),
								'header_background_color' => array(
									'type' => 'themecolor',
									'label' => __('Header Background color', THEME_NAME),
									'default' => false,
									'css' => true,
								),
								'header_text_color' => array(
									'type' => 'themecolor',
									'label' => __('Header Text color', THEME_NAME),
									'default' => false,
									'css' => true,
								),
								'show_more' => array(
									'type' => 'checkbox',
									'default' => true,
									'label' => __( 'Show More Button if possible', THEME_NAME )
								),
								'style_header_border_top_section' => array(
									'type' => 'section',
									'label' => __( 'Border Top' , THEME_NAME ),
									'hide' => true,
									'fields' => array(
										'header_border_top_width' => array(
											'type' => 'slider',
											'label' => __( 'Border Width', THEME_NAME ),
											'default' => 0,
											'min' => 0,
											'max' => 20,
											'integer' => true,
											'css' => true,
											'units' => 'px'
										),
										'header_border_top_color' => array(
											'type' => 'themecolor',
											'label' => __( 'Border color', THEME_NAME),
											'default' => false,
											'css' => true,
										),
										'header_border_top_style' => array(
											'type' => 'select',
											'label' => __( 'Border style', THEME_NAME),
											'default' => 'solid',
											'css' => true,
											'options' => array(
												'none' => __( 'No border', THEME_NAME ),
												'solid' => __( 'Solid', THEME_NAME ),
												'dotted' => __( 'Dotted', THEME_NAME ),
												'dashed' => __( 'Dashed', THEME_NAME ),
												'double' => __( 'Double', THEME_NAME ),
											)
										)
									)
								),
								'style_header_border_bottom_section' => array(
									'type' => 'section',
									'label' => __( 'Border Bottom' , THEME_NAME ),
									'hide' => true,
									'fields' => array(
										'header_border_bottom_width' => array(
											'type' => 'slider',
											'label' => __( 'Border Width', THEME_NAME ),
											'default' => 1,
											'min' => 0,
											'max' => 20,
											'integer' => true,
											'css' => true,
											'units' => 'px'
										),
										'header_border_bottom_color' => array(
											'type' => 'themecolor',
											'label' => __( 'Border color', THEME_NAME),
											'default' => 'borders',
											'css' => true,
										),
										'header_border_bottom_style' => array(
											'type' => 'select',
											'label' => __( 'Border style', THEME_NAME),
											'default' => 'solid',
											'css' => true,
											'options' => array(
												'none' => __( 'No border', THEME_NAME ),
												'solid' => __( 'Solid', THEME_NAME ),
												'dotted' => __( 'Dotted', THEME_NAME ),
												'dashed' => __( 'Dashed', THEME_NAME ),
												'double' => __( 'Double', THEME_NAME ),
											)
										)
									)
								)
								
							)
						),
					)
				)
				
			);
			
			if(is_array($fields)) $this->fields=array_merge($this->fields,$fields);
			
			
			parent::__construct(
				$this->widget_type.'-widget',
				__($name, THEME_NAME),

				// The $widget_options array, which is passed through to WP_Widget.
				// It has a couple of extras like the optional help URL, which should link to your sites help or support page.
				array(
					'description' => __($description, THEME_NAME),
					'panels_icon' => 'dashicons dashicons-carrot carrot-so-icons',
				),

				//The $control_options array, which is passed through to WP_Widget
				array(
					
				),

				//The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
				$this->fields,

				//The $base_folder path string.
				plugin_dir_path(__FILE__)."/widgets/".$this->widget_type
			);
			
		}
		
	
	}
	
endif;