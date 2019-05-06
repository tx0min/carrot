<?php

	class Projects extends CustomPostType{
		
		public function __construct() {
			parent::__construct();
		
			$this->name = "Project";
			$this->slug = "projects";
			
			
			$this->labels = array(
				"name" => __( 'Projects', THEME_NAME ),
				"singular_name" => __( 'Project', THEME_NAME ),
				"add_new" => __( 'New project', THEME_NAME ),
				"add_new_item" => __( 'Add new project', THEME_NAME ),
				"edit_item" => __( 'Edit project', THEME_NAME ),
			);
			
			/*cpt*/
			$this->menu_icon = "dashicons-images-alt";		
			$this->shortcodes = true;		
			$this->exclude_from_search = false;
						
			/*acf options*/
			$this->shows = array('the_content','excerpt','format');
			$this->fields =  array (
				
				array (
					'label' => __('Image Gallery', THEME_NAME),
					'name' => 'tab_gallery',
					'type' => 'tab',
				),
				
				array (
					'label' => __("Show featured image",THEME_NAME),
					'key' => 'field_show_featured_image',
					'name' => 'show_featured_image',
					'type' => 'radio',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array (
						'theme' => sprintf( __( 'Defined by theme (%s)', THEME_NAME ), (_o("single_projects_show_featured")?__('Show',THEME_NAME):__('Hide',THEME_NAME)) ),
						'show' => __('Show',THEME_NAME),
						'hide' => __('Hide',THEME_NAME),
					),
					'allow_null' => 0,
					'other_choice' => 0,
					'save_other_choice' => 0,
					'default_value' => 'theme',
					'layout' => 'vertical',
					'return_format' => 'value',
					'instructions' => __('Shows the featured image, only if supported by the selected template. This option overrides the global configuration', THEME_NAME),
					
				),
				array (
					'label' => __("Show image gallery",THEME_NAME),
					'key' => 'field_show_project_gallery',
					'name' => 'show_gallery',
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
					'label' => __('Project Gallery', THEME_NAME ),
					'name' => 'project_gallery',
					'type' => 'clone',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_show_project_gallery',
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
					'clone' => array (
						0 => 'group_image_gallery',
					),
					'display' => 'group',
					'layout' => 'block',
					'prefix_label' => 0,
					'prefix_name' => 1,
				),
				
				
				array (
					'label' => __('Videos', THEME_NAME),
					'name' => 'tab_videos',
					'type' => 'tab',
				),
				array (
					'label' => __("Show videos",THEME_NAME),
					'key' => 'field_show_videos',
					'name' => 'show_videos',
					'type' => 'true_false',
					'default_value' => 0,
				),
				array (
					'label' => __("Videos before images",THEME_NAME),
					'key' => 'field_videos_first',
					'name' => 'videos_first',
					'type' => 'true_false',
					'default_value' => 0,
				),

				array (
					'label' => __('Videos', THEME_NAME),
					'key' => 'field_videos',
					'name' => 'videos',
					'type' => 'repeater',
					'min' => 0,
					'max' => 0,
					'layout' => 'block',
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_show_videos',
								'operator' => '==',
								'value' => '1',
							),
						),
					),
					'collapsed' => 'video_url',
					'button_label' => __('Add Video', THEME_NAME),
					'sub_fields' => array (
						array (
							'label' => __('Video Title', THEME_NAME),
							'name' => 'video_title',
							'type' => 'text'
						),
						array (
							'label' => __('Video URL', THEME_NAME),
							'name' => 'video_url',
							'type' => 'url',
							'instructions' => __('Youtube or Vimeo video URL', THEME_NAME),
						),
						array (
							'label' => __('Grid columns',THEME_NAME),
							'name' => 'grid_cols',
							'instructions' => __('For videos displayed in grids',THEME_NAME),
							'type' => 'number',
							'default_value' => 1,
							'min' => 1,
							'max' => 6,
							'step' => 1
						),
					),
				),

				
				
				array (
					'label' => __('Data sheet', THEME_NAME),
					'name' => 'tab_data_sheet',
					'type' => 'tab',
					
				),
				array (
					'label' => __('Fields',THEME_NAME),
					'name' => 'project_field',
					'type' => 'repeater',
					'min' => 0,
					'max' => 0,
					'layout' => 'table',
					'button_label' => __('Add field', THEME_NAME),
					'sub_fields' => array (
						array (
							'label' => __('Name', THEME_NAME),
							'name' => 'name',
							'type' => 'text',
							'default_value' => '',
							
						),
						array (
							'label' => __('Value', THEME_NAME),
							'name' => 'value',
							'type' => 'text',
							
						),
					),
					'collapsed' => '',
				),
				array (
					'label' => __('Project settings',THEME_NAME),
					'name' => 'project_info',
					'type' => 'tab',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'placement' => 'top',
					'endpoint' => 0,
				),
				/*array (
					'label' => __('Description',THEME_NAME),
					'name' => 'description',
					'type' => 'wysiwyg',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'full',
					'media_upload' => 0,
				),*/
				
				array(
					'label' => __('Project BG color',THEME_NAME),
					'key' => 'field_bgcolor',
					'name' => 'bgcolor',
					'type' => 'select',
					'required' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array (
						'none' => __('None',THEME_NAME),
						'primary' => __('Primary',THEME_NAME),
						'alt' => __('Alternate', THEME_NAME),
						'custom' => __('Custom', THEME_NAME)
					),
					'default_value' => array (
						0 => 'none',
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
					'label' => __('Custom BG color',THEME_NAME ),
					'name' => 'custombgcolor',
					'type' => 'color_picker',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_bgcolor',
								'operator' => '==',
								'value' => 'custom',
							),
						),
					),
					
				),
				array (
					'label' => __('Custom Text color',THEME_NAME ),
					'name' => 'customtextcolor',
					'type' => 'color_picker',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_bgcolor',
								'operator' => '==',
								'value' => 'custom',
							),
						),
					),
					
				),
				array (
					'label' => __('Custom alternate color',THEME_NAME ),
					'name' => 'customaltcolor',
					'type' => 'color_picker',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_bgcolor',
								'operator' => '==',
								'value' => 'custom',
							),
						),
					),
					
				),
				array (
					'label' => __('Use custom BG color in lightbox',THEME_NAME ),
					'name' => 'colorlightbox',
					'type' => 'true_false',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_bgcolor',
								'operator' => '==',
								'value' => 'custom',
							),
						),
					),
					'default_value' => 0,
				),
				array (
					'key' => 'field_bg_image',
					'label' => __('Project BG image',THEME_NAME ),
					'name' => 'bgimg',
					'type' => 'image',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'array',
					'preview_size' => 'landscape',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
				),array (
					'key' => 'field_bg_repeat',
					'label' => __('Project BG image repeat',THEME_NAME ),
					'name' => 'bgimg_repeat',
					'type' => 'select',
					'required' => 0,
					
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array (
						'no-repeat' => __('No repeat',THEME_NAME),
						'repeat-x' => __('Repeat X', THEME_NAME),
						'repeat-y' => __('Repeat X', THEME_NAME),
						'repeat' => __('Repeat Both', THEME_NAME)
					),
					'default_value' => array (
						0 => 'no-repeat',
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
					'key' => 'field_bg_position_x',
					'label' => __('Project BG image horizontal position',THEME_NAME ),
					'name' => 'bgimg_position_x',
					'type' => 'select',
					'required' => 0,
					
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array (
						'left' => __('Left',THEME_NAME),
						'center' => __('Center', THEME_NAME),
						'right' => __('Right', THEME_NAME)
					),
					'default_value' => array (
						0 => 'center',
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
					'key' => 'field_bg_position_y',
					'label' => __('Project BG image vertical position',THEME_NAME ),
					'name' => 'bgimg_position_y',
					'type' => 'select',
					'required' => 0,
					
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array (
						'top' => __('Top',THEME_NAME),
						'center' => __('Center', THEME_NAME),
						'bottom' => __('Bottom', THEME_NAME)
					),
					'default_value' => array (
						0 => 'center',
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
					'key' => 'field_bg_size',
					'label' => __('Project BG image size',THEME_NAME ),
					'name' => 'bgimg_size',
					'type' => 'select',
					'required' => 0,
					
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array (
						'auto' => __('Auto',THEME_NAME),
						'cover' => __('Cover', THEME_NAME),
						'contain' => __('Contain', THEME_NAME)
					),
					'default_value' => array (
						0 => 'auto',
					),
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'ajax' => 0,
					'placeholder' => '',
					'disabled' => 0,
					'readonly' => 0,
					
				)
				
			);
			
			
			if(carrot_authors_enabled() && opt("author_project")){
				$this->fields=array_merge($this->fields,array(
					array (
						'label' => __('Author', THEME_NAME),
						'name' => 'tab_author',
						'type' => 'tab',
					),
					array (
						'label' => __('Project Author',THEME_NAME),
						'name' => 'related-project-author',
						'type' => 'relationship',
						'post_type' => array (
							0 => 'authors',
						),
						'taxonomy' => array (
						),
						'filters' => array (
							0 => 'search',
						),
						'elements' => array (
							0 => 'featured_image',
						),
						'min' => '0',
						'max' => '1',
						'return_format' => 'object',
					),
				));
			}
			
			
			
			$this->taxonomies = array(new ProjectCategory(), new ProjectTag());		
			

			$this->customizer = array(
				
				'single_'.$this->slug.'_show_navigation'=>array(
					'type'        => 'toggle',
					'label'       => __( 'Show navigation (next and previous)', THEME_NAME ),
					'description'       => __( 'Only if supported by the selected layout', THEME_NAME ),
					'default'     => '0'

				),
				'single_'.$this->slug.'_show_related'=>array(
					'type'        => 'toggle',
					'label'       => __( 'Show related', THEME_NAME ),
					'description'       => __( 'Only if supported by the selected layout', THEME_NAME ),
					'default'     => '0'

				),
				'single_'.$this->slug.'_show_featured'=>array(
					'type'        => 'toggle',
					'label'       => __( 'Show featured image', THEME_NAME ),
					'description'       => __( 'Only if supported by the selected layout', THEME_NAME ),
					'default'     => '0'

				)

						
			);
			
			$this->styles=array("projects");
			$this->scripts=array("projects");
			
		}
		



	}
	
	function carrot_projects_enabled(){
		return opt("enable_projects");
	}

	function carrot_project_data_sheet(){
		$fields=gf("project_field");
		if($fields && is_array($fields) && count($fields)>0){
			echo "<ul class='project-meta'>";
			foreach($fields as $field){
				echo "<li><h3>".$field["name"]."</h3><p>".$field["value"]."</p></li>";
			}
			echo "</ul>";
		}
		
	}
	

	
	function carrot_project_show_featured($size="large"){
		if(has_post_thumbnail()){
			
			if((gf("show_featured_image")=="show") || (gf("show_featured_image")=="theme" && _o("single_projects_show_featured"))){
				carrot_post_thumbnail($size,false,true,"image",false);
			}
		}
		
	}
	
	function carrot_custom_project_colors(){
		$bgcolor=get_field("bgcolor");
		$bgimg=get_field("bgimg");
		if($bgcolor=="custom" || $bgimg){
			
	?>
		<style>
			#post-<?php the_ID(); ?>{
				<?php if($bgcolor=="custom"){?>
				background-color:<?=get_field("custombgcolor")?>;
				color:<?=get_field("customtextcolor")?>;
				<?php } ?>
				<?php if($bgimg){?>
					background-image:url(<?=$bgimg["url"]?>);
					background-repeat:<?=get_field("bgimg_repeat")?>;
					background-position:<?=get_field("bgimg_position_x")?> <?=get_field("bgimg_position_y")?>;
					background-size:<?=get_field("bgimg_size")?>;
				<?php } ?>
				
			}
			<?php if($bgcolor=="custom"){?>
				
			#post-<?php the_ID(); ?> .entry-header  *,
			#post-<?php the_ID(); ?> .entry-content  ,
			#post-<?php the_ID(); ?> .entry-content *  ,
			#post-<?php the_ID(); ?> .project-data-sheet *  
			{
				color:<?=get_field("customtextcolor")?>;
				border-color:<?=get_field("customtextcolor")?>;
			}
			#post-<?php the_ID(); ?> .entry-content a  ,
			#post-<?php the_ID(); ?> .project-data-sheet a ,
			#post-<?php the_ID(); ?> .taxonomies   *,
			#post-<?php the_ID(); ?> .project-data-sheet h3{
				color:<?=get_field("customaltcolor")?>;
				
			}

			#post-<?php the_ID(); ?> .single-nav a{
				color:<?=get_field("customtextcolor")?>;
				
			}
			#post-<?php the_ID(); ?> .single-nav a:hover{
				color:<?=get_field("customtextcolor")?>;
				background-color:<?=get_field("custombgcolor")?>;
				
			}

			#post-<?php the_ID(); ?> .owl-dots .owl-dot{
				border-color:<?=get_field("customtextcolor")?>;
			}
			#post-<?php the_ID(); ?> .owl-dots .owl-dot:hover{
				background-color:<?=get_field("customaltcolor")?>;
			}
			#post-<?php the_ID(); ?> .owl-dots .owl-dot.active{
				background-color:<?=get_field("customtextcolor")?>;
			}

			#post-<?php the_ID(); ?> .image-gallery .imgwrap{
				background-color:<?=get_field("customaltcolor")?>;
			}
			#post-<?php the_ID(); ?> .image-gallery  a.biglink .view-icon{
				color:<?=get_field("customtextcolor")?>;
			}

			#post-<?php the_ID(); ?> .image-gallery.bordered .imgwrap{
				border-color:<?=get_field("customtextcolor")?>;	
			}
			
			.a2a_kit .a2a_svg svg path{
				fill:<?=get_field("customtextcolor")?> !important;
			}
			
			<?php if(gf("colorlightbox")){ ?>
			.pswp__bg{
				background-color:<?=get_field("custombgcolor")?>;
			}
			<?php } ?>
			
			<?php } ?>
				
		</style>
		
	<?php
		}
	}
	
	
	