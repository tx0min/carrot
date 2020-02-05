<?php
/*
Widget Name: Multimedia Gallery
Description: Displays a media gallery.
Author: Txo
*/




class Carrot_Image_Gallery_Widget extends Carrot_SiteOrigin_Widget {
	
	
		
	function __construct() {
		parent::__construct(
			'carrot-image-gallery', 
			'Carrot Media Gallery', 
			'Displays a media gallery.' ,

			array(
				'gallery_section' => array(
					'type' => 'section',
					'label' => __( 'Gallery Media' , THEME_NAME ),
					'hide' => true,
					'fields' => array(
						'gallery_images' => array(
					        'type' => 'repeater',
					        'label' => __( 'Media items' , THEME_NAME ),
					        'item_name'  => __( 'Media item', THEME_NAME ),
					        'item_label' => array(
					            'selector'     => "[id*='image_title']",
					            'update_event' => 'change',
					            'value_method' => 'val'
					        ),
					        'fields' => array(
					        	'image' => array(
							        'type' => 'media',
							        'multiple' => true,
							        'label' => __( 'Choose an image', THEME_NAME ),
							        'choose' => __( 'Choose image', THEME_NAME ),
							        'update' => __( 'Set image', THEME_NAME ),
							        'library' => 'image',
							        'fallback' => true
							    ),
							     'video_url' => array(
						        	'type' => 'text',
						        	'label' => __('Video URL', THEME_NAME),
						        	'description' => __('Youtube or Vimeo video URL. If set, video will be shown over image', THEME_NAME)
						    	),
							     'image_title' => array(
							        'type' => 'text',
							        'label' => __('Title', THEME_NAME)
							    )
					        )
						),
						'image22' => array(
							'type' => 'media',
							'multiple' => true,
							'label' => __( 'Choose an image', THEME_NAME ),
							'choose' => __( 'Choose image', THEME_NAME ),
							'update' => __( 'Set image', THEME_NAME ),
							'library' => 'image',
							'fallback' => true
						)

					)
				),
				'gallery_options_section' => array(
					'type' => 'section',
					'label' => __( 'Gallery Options' , THEME_NAME ),
					'hide' => true,
					'fields' => array(
						
						'gallery_disposition' => array(
							'type' => 'select',
					        'label' => __( 'Layout', THEME_NAME ),
					        'default' => 'horizontal',
					        'options' => array (
								'vscroll' => __('Vertical',THEME_NAME),
								//'hscroll' => __('Horizontal', THEME_NAME),
								'grid' => __('Grid', THEME_NAME) ,
								//'mosaic' => 'Mosaic de miniatures de diferent mida',
								'slider' => __('Slider', THEME_NAME),
							),
							'state_emitter' => array(
								'callback' => 'select',
								'args' => array( 'gallery_disposition' )
							)
					    ),
					    'gallery_grid_section' => array(
							'type' => 'section',
							'label' => __( 'Grid Options' , THEME_NAME ),
							'hide' => true,
							'fields' => array(
							    'gallery_columns' => array(
									'type' => 'slider',
									'label' => __( 'Columns', THEME_NAME ),
									'default' => 3,
									'min' => 1,
									'max' => 10,
									'integer' => true
								),
							),
							'state_handler' => array(
								'gallery_disposition[grid]' => array('show'),
								'_else[gallery_disposition]' => array( 'hide' )
							),
						),
						'gallery_slider_section' => array(
							'type' => 'section',
							'label' => __( 'Slider Options' , THEME_NAME ),
							'hide' => true,
							'fields' => array(
								'gallery_autoplay' => array(
									'type' => 'checkbox',
									'default' => true,
									'label' => __( 'Auto play', THEME_NAME )
								),
								'gallery_slider_loop' => array(
									'type' => 'checkbox',
									'default' => true,
									'label' => __( 'Loop', THEME_NAME )
								),
								'gallery_pause_on_hover' => array(
									'type' => 'checkbox',
									'default' => true,
									'label' => __( 'Pause on hover', THEME_NAME )
								),
								'gallery_enable_drag' => array(
									'type' => 'checkbox',
									'default' => true,
									'label' => __( 'Enable dragging', THEME_NAME )
								),
								'gallery_show_navigation' => array(
									'type' => 'checkbox',
									'default' => true,
									'label' => __( 'Show navigation', THEME_NAME )
								),

								'gallery_show_pause' => array(
									'type' => 'checkbox',
									'default' => false,
									'label' => __( 'Show pause/play', THEME_NAME )
								),
								
								'gallery_show_pager' => array(
									'type' => 'checkbox',
									'default' => false,
									'label' => __( 'Show Pagination', THEME_NAME )
								),
								'gallery_articles_to_show' => array(
									'type' => 'slider',
									'default' => 1,
									'min' => 1,
									'max' => 10,
									'integer' => true,
									'label' => __( 'Articles per page', THEME_NAME )
								),
								'gallery_articles_to_show_responsive' => array(
									'type' => 'slider',
									'default' => 1,
									'min' => 1,
									'max' => 10,
									'integer' => true,
									'label' => __( 'Articles per page in small devices', THEME_NAME )
								),
								'gallery_page_slide' => array(
									'type' => 'checkbox',
									'default' => false,
									'label' => __( 'Cycle by page', THEME_NAME ),
									'description' => __( 'If there is more than one item per page and this option is checked, navigation will cycle the whole page. Otherwise it will cycle by article.', THEME_NAME ),

								),
								'gallery_slide_effect' => array(
									'type' => 'select',
									'default' => 'none',
									'label' => __( 'Effect', THEME_NAME ),
									'description' => __( 'Effect only works when there is 1 article per page', THEME_NAME ),
									'options' => array(
										'none' => __( 'No effect', THEME_NAME ),
										'fade' => __( 'Fade', THEME_NAME ),
										'slide-h' => __( 'Slide Horizontal', THEME_NAME ),
										'slide-v' => __( 'Slide Vertical', THEME_NAME ),
										'flip-h' => __( 'Flip Horizontal', THEME_NAME ),
										'flip-v' => __( 'Flip Vertical', THEME_NAME ),
										'zoom' => __( 'Zoom', THEME_NAME )
									)
								),
								'gallery_slide_timeout' => array(
									'type' => 'slider',
									'default' => 5000,
									'min' => 1,
									'max' => 10000,
									'integer' => true,
									'label' => __( 'Slider timeout', THEME_NAME ),
									'description' => __( 'Time between slides (in miliseconds)', THEME_NAME ),
									
								),
								'gallery_slide_speed' => array(
									'type' => 'slider',
									'default' => 600,
									'min' => 0,
									'max' => 2000,
									'integer' => true,
									'label' => __( 'Slide speed', THEME_NAME ),
									'description' => __( 'Slide transition speed (in miliseconds)', THEME_NAME ),
									
								),
								'gallery_valign' => array(
									'type' => 'select',
									'default' => 'top',
									'label' => __( 'Vertical Align', THEME_NAME ),
									'options' => array(
										'top' => __( 'Top align', THEME_NAME ),
										'center' => __( 'Center align', THEME_NAME ),
										'bottom' => __( 'Bottom align', THEME_NAME )
									)
									
								),
								'gallery_image_height' => array(
									'type' => 'text',
									'default' => '',
									'label' => __( 'Slides height', THEME_NAME ),
									'description' => __( 'Slides height (include units). Autoheight if not set.', THEME_NAME ),
									
								),
								'gallery_lazyload' => array(
									'type' => 'checkbox',
									'default' => false,
									'label' => __( 'Lazyload', THEME_NAME ),
									'description' => __( 'Activate with big sliders to reduce loading time.', THEME_NAME ),

								),
							),
							'state_handler' => array(
								'gallery_disposition[slider]' => array('show'),
								'_else[gallery_disposition]' => array( 'hide' )
							)
						),
						'gallery_gap' => array(
							'type' => 'select',
							'default' => 'small',
							'label' => __( 'Gallery Gap', THEME_NAME ),
							'options' => carrot_availableGaps()
						),
						'gallery_thumbnail_size' => array(
							'type' => 'select',
							'default' => 'thumbnail',
							'label' => __( 'Format', THEME_NAME ),
							'options' => carrot_get_thumbsizes_dropdown()
							
						),
						'gallery_lightbox' => array(
							'type' => 'checkbox',
							'default' => true,
							'label' => __( 'Use lightbox', THEME_NAME )
						),
						'gallery_bordered' => array(
							'type' => 'checkbox',
							'default' => false,
							'label' => __( 'Bordered images', THEME_NAME )
						),
						'gallery_random_order' => array(
							'type' => 'checkbox',
							'default' => false,
							'label' => __( 'Random start', THEME_NAME )
						)
						

					)
					
				)
				
			)
		);
	}
	
	function initialize() {
        
		
        
		/*wp_enqueue_script( 'carrot-posts-slider', CARROT_SO_WIDGETS_URI. '/widgets/carrot-posts-slider/js/carrot-posts-slider.js', array('jquery','owl-carousel') );
		wp_localize_script( 'carrot-posts-slider', 'carrot_slider_ajax',
			array(
				'texts' =>array(
					"next" =>__("Next",THEME_NAME),  
					"prev" =>__("Previous",THEME_NAME), 
					"loading" =>__("Loading",THEME_NAME)
				),
				'icons' => array(
					"right" => _icon("icon_angle_right"),
					"left" => _icon("icon_angle_left"),
					"loading" => _icon("icon_loading","spin"),
					"pagination" => _icon("icon_pagination_item")
				)
			)
			
		);
		*/
		
        $this->register_frontend_styles(array(
            array( 'carrot-image-gallery',CARROT_SO_WIDGETS_URI . '/widgets/carrot-image-gallery/styles/gallery.css')
        ));
    }
}



siteorigin_widget_register('carrot-image-gallery-widget', __FILE__, 'Carrot_Image_Gallery_Widget');


if(!function_exists("carrot_generate_images_array")){
	function carrot_generate_images_array($images, $random_start=false){
		
		
		if($random_start){
			$middle=rand(0,count($images)-1);
			if($middle>0){
				$part1 = array_slice($images, 0, $middle);
				$part2 = array_slice($images, $middle);
				$images= array_merge($part2, $part1 );
			}
			
		}

		$ret=array();
		//_dump($images);
		
		foreach($images as $image){
			if(isset($image["video_url"]) && $image["video_url"]){
				$video=array();
				$video["media_type"]="video";
				$video["video_url"]=$image["video_url"];
				
				if($image["image_title"]) $video["title"]=$image["image_title"];
				
				$ret[]=$video;
			}else if($image["image"]){
				$id=$image["image"];
				$img=wp_get_attachment_metadata($id);
				$img["media_type"]="image";
				$img["ID"]=$id;
				$img["id"]=$id;
				$img["url"]=wp_get_attachment_image_src($id,"full")[0];
				$img["filename"]=basename($img["file"]);
				if($image["image_title"]) $img["title"]=$image["image_title"];

				$sizes=$img["sizes"];
				$sizesok=array();
				foreach($sizes as $sizename=>$size){
					$sizesok[$sizename]= wp_get_attachment_image_src($id,$sizename)[0];
					$sizesok[$sizename."-width"]= $size["width"];
					$sizesok[$sizename."-height"]= $size["height"];
				}
				$img["sizes"]=$sizesok;
				unset($img["image_meta"]);
				$ret[]=$img;
				//_dump($img);
			}
		}


		return $ret;
	}
}
