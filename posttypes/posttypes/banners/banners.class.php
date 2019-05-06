<?php

	class Banners extends CustomPostType{
		
		public function __construct() {
			parent::__construct();
		
			$this->name = "AD";
			$this->slug = "banners";
			
			
			$this->labels = array(
				"name" => __( 'Banners', THEME_NAME ),
				"singular_name" => __( 'Banner', THEME_NAME ),
				"add_new" => __( 'New banner', THEME_NAME ),
				"add_new" => __( 'New banner', THEME_NAME ),
				"add_new_item" => __( 'Add new banner', THEME_NAME ),
				"edit_item" => __( 'Edit banner', THEME_NAME ),
			);
			
			/*cpt*/
			$this->menu_icon = "dashicons-megaphone";		
			$this->optional = true;
			$this->enabled = false;
			$this->shortcodes = true;		
			$this->thumbsizes = array(
				'banner-leaderboard'=> array(568 , 80 ),
				'banner-skyscraper'=> array(160  , 568 ),
				'banner-horizontal'=> array(268 , 164  ),
				'banner-square'=> array(350 , 350  ),
				'banner-vertical'=> array(164 , 268  )
			);
			
						
			/*acf options*/
			$this->fields =  array (
				array (
					'label' => __('Extern URL',THEME_NAME ),
					'name' => 'url',
					'type' => 'url',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
				),
				array (
					'label' => __('Intern Link',THEME_NAME),
					'name' => 'link_intern',
					'type' => 'page_link',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'post_type' => array (
						0 => 'page',
						1 => 'post',
					),
					'taxonomy' => array (
					),
					'allow_null' => 0,
					'multiple' => 0,
				),
				array (
					'label' => __('Open in new window',THEME_NAME ),
					'name' => 'obrir_en_finestra_nova',
					'type' => 'true_false',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'message' => '',
					'default_value' => 1,
				),
				array (
					'label' => __('Clicks',THEME_NAME ),
					'name' => 'banner_clicks',
					'type' => 'text',
					'readonly' => true,
					'instructions' => 'Number of times this banner has been clicked',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'message' => '',
					'default_value' => 0,
				),array (
					'label' => __('Imprints',THEME_NAME ),
					'name' => 'banner_imprints',
					'type' => 'text',
					'readonly' => true,
					'instructions' => 'Number of times this banner has been rendered',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'message' => '',
					'default_value' => 0,
				),
				
			);
			
			
			$this->columns= array(
				'clicks'  => array(
					"title"=>__('Clicks',THEME_NAME),
					"sortable" => true,
					"content" => function($column_name, $id){
						return intval(get_field("banner_clicks",$id));

					}
				),
				'imprints'  => array(
					"title"=>__('Imprints',THEME_NAME),
					"sortable" => true,
					"content" => function($column_name, $id){
						return intval(get_field("banner_imprints",$id));

					}
				)
			);
			
			
			$this->taxonomies = array(
				new ADType(),
				new ADTag(),
				
			);
			
			
			$this->otherfields =  array (
				"post" => array(
					"title" =>"ADs",
					'position' => 'side',
					"fields" => array(
						array (
							'key' => 'field_ad_posts_show_ads',
							'label' => __('Show ADs',THEME_NAME ),
							'name' => 'show_ads',
							'type' => 'true_false',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'message' => '',
							'default_value' => 0,
						),
						array (
							'key' => 'field_ad_posts_ad_type',
							'label' => __('AD Type',THEME_NAME ),
							'name' => 'ad_type',
							'type' => 'select',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => array (
								array (
									array (
										'field' => 'field_ad_posts_show_ads',
										'operator' => '==',
										'value' => '1',
									),
								),
							),
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'choices' => array (
								'random' => __('Random',THEME_NAME ),
								'last' => __('Last published',THEME_NAME ),
								'related' => __('Related (by current post or page tags)',THEME_NAME ),
								'chosen' => __('User selected',THEME_NAME ),
							),
							'default_value' => array (
								'related' => 'random',
							),
							'allow_null' => 0,
							'multiple' => 0,
							'ui' => 0,
							'ajax' => 0,
							'placeholder' => '',
							'disabled' => 0,
							'readonly' => 0,
						),
						array (
							'label' => __('AD Format',THEME_NAME),
							'name' => 'ad_format',
							'type' => 'taxonomy',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => array (
								array (
									array (
										'field' => 'field_ad_posts_show_ads',
										'operator' => '==',
										'value' => '1',
									),
									array (
										'field' => 'field_ad_posts_ad_type',
										'operator' => '!=',
										'value' => 'chosen',
									),
								),
							),
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'taxonomy' => 'banner-type',
							'field_type' => 'select',
							'allow_null' => 1,
							'add_term' => 0,
							'save_terms' => 0,
							'load_terms' => 0,
							'return_format' => 'object',
							'multiple' => 0,
						),
						array (
							'label' => __('AD Number',THEME_NAME ),
							'name' => 'ad_number',
							'type' => 'number',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => array (
								array (
									array (
										'field' => 'field_ad_posts_show_ads',
										'operator' => '==',
										'value' => '1',
									),
									array (
										'field' => 'field_ad_posts_ad_type',
										'operator' => '!=',
										'value' => 'chosen',
									),
								),
							),
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => 1,
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'min' => 1,
							'max' => 10,
							'step' => 1,
							'readonly' => 0,
							'disabled' => 0,
						),
						array (
							'label' => __('Selected ADs',THEME_NAME ),
							'name' => 'selected_ads',
							'type' => 'post_object',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => array (
								array (
									array (
										'field' => 'field_ad_posts_show_ads',
										'operator' => '==',
										'value' => '1',
									),
									array (
										'field' => 'field_ad_posts_ad_type',
										'operator' => '==',
										'value' => 'chosen',
									),
								),
							),
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'post_type' => array (
								0 => 'banners',
							),
							'taxonomy' => array (
							),
							'allow_null' => 0,
							'multiple' => 1,
							'return_format' => 'object',
							'ui' => 1,
						),
						
					)
				)
			);
			
			
		}
		



	}
	
	function carrot_ads_enabled(){
		return opt("enable_banners");
	}

	