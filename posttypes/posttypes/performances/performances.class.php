<?php

	class Performances extends CustomPostType{
		
		public function __construct() {
			parent::__construct();
		
			$this->name = "Performance";
			$this->slug = "performances";
			
			
			$this->labels = array(
				"name" => __( 'Performances', THEME_NAME ),
				"singular_name" => __( 'Performance', THEME_NAME ),
				"add_new" => __( 'New Performance', THEME_NAME ),
				"add_new_item" => __( 'Add new Performance', THEME_NAME ),
				"edit_item" => __( 'Edit Performance', THEME_NAME ),
			);
			
			/*cpt*/
			$this->menu_icon = "dashicons-format-audio";		
			$this->shortcodes = true;		
			$this->exclude_from_search = false;
						
			/*acf options*/
			$this->shows = array('the_content','excerpt');
			
			$this->fields =  array (
				
				array (
					'label' => __('Performance Information', THEME_NAME),
					'name' => 'tab_performance_info',
					'type' => 'tab',
				),

				array(
					'label' => __('Performance type',THEME_NAME),
					'key' => 'field_performance_type',
					'name' => 'performance_type',
					'type' => 'select',
					'choices' => array (
						'performance' => __('Actuació',THEME_NAME),
						'aniversary' => __('Acte 50è anivesari',THEME_NAME),
						'spectacle' => __('Espectacle', THEME_NAME)
					),
					'default_value' => array (
						0 => 'performance',
					)
				),
				array (
					'label' => __('Lloc',THEME_NAME),
					'name' => 'location',
					'type' => 'text',
					
				),
				array (
					'label' => __('Date',THEME_NAME),
					'name' => 'fecha',
					'type' => 'date_picker',
					'display_format' => 'd/m/Y',
					'return_format' => 'd/m/Y',
					'first_day' => 1,
				),
				array (
					'label' => __('Date',THEME_NAME),
					'name' => 'fecha2',
					'type' => 'date_picker',
					'display_format' => 'd/m/Y',
					'return_format' => 'l, j \d\e F \d\e Y',
					'first_day' => 1,
				),
				array (
					'label' => __('Hora',THEME_NAME),
					'name' => 'hora',
					'type' => 'text',
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_performance_type',
								'operator' => '==',
								'value' => 'aniversary',
							)
						),
					),
				),

				array (
					'label' => __('Preu',THEME_NAME),
					'name' => 'preu',
					'type' => 'text',
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_performance_type',
								'operator' => '==',
								'value' => 'aniversary',
							)
						),
						array (
							array (
								'field' => 'field_performance_type',
								'operator' => '==',
								'value' => 'spectacle',
							)
						),
					),
					
				),
				
				array (
					'label' => __('Repertori',THEME_NAME),
					'name' => 'repertori',
					'type' => 'text',
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_performance_type',
								'operator' => '==',
								'value' => 'performance',
							)
						),
					),
					
				),
				array (
					'label' => __('Condicions tècniques',THEME_NAME),
					'name' => 'condicions_tecniques',
					'type' => 'text',
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_performance_type',
								'operator' => '==',
								'value' => 'spectacle',
							)
						),
					),
					
				),array (
					'label' => __('Requeriment',THEME_NAME),
					'name' => 'requeriment',
					'type' => 'text',
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_performance_type',
								'operator' => '==',
								'value' => 'spectacle',
							)
						),
					),
					
				),
				array (
					'label' => __('Durada de l’espectacle',THEME_NAME),
					'name' => 'durada',
					'type' => 'text',
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_performance_type',
								'operator' => '==',
								'value' => 'spectacle',
							)
						),
					),
					
				),array (
					'label' => __('Document adjunt',THEME_NAME),
					'name' => 'document',
					'type' => 'file',
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_performance_type',
								'operator' => '==',
								'value' => 'spectacle',
							)
						),
					),
					
				),array (
					'label' => __('Ampliar informació',THEME_NAME),
					'name' => 'moreinfo',
					'type' => 'true_false',
					'default_value' => 0,
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_performance_type',
								'operator' => '==',
								'value' => 'aniversary',
							)
						),
					),
					
				),
				array (
					'label' => __('Image Gallery', THEME_NAME),
					'name' => 'tab_gallery',
					'type' => 'tab',
				),
				
				
				
				array (
					'label' => __('Gallery', THEME_NAME ),
					'name' => 'performance_gallery',
					'type' => 'clone',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array (
						
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
					'label' => __('Videos', THEME_NAME),
					'key' => 'field_videos_performance',
					'name' => 'videos',
					'type' => 'repeater',
					'conditional_logic' => array (
						
					),
					'layout' => 'table',
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
					'name' => 'performance_field',
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
				)
				
				
			);
			
			
			
			
			$this->taxonomies = array(new PerformanceCategory(), new PerformanceTag());		
			

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
			
			$this->styles=array("performances");
			$this->scripts=array("performances");
			
			
		}
		



	}



	
	function carrot_performances_enabled(){
		return opt("enable_performances");
	}

	function carrot_performance_data_sheet(){
		$fields=gf("performance_field");
		if($fields && is_array($fields) && count($fields)>0){
			echo "<ul class='performance-meta'>";
			foreach($fields as $field){
				echo "<li><h3>".$field["name"]."</h3><p>".$field["value"]."</p></li>";
			}
			echo "</ul>";
		}
		
	}
	

	
	function carrot_performance_show_featured($size="large"){
		if(has_post_thumbnail()){
			
			if(_o("single_performances_show_featured")){
				carrot_post_thumbnail($size,false,true,"image",false);
			}
		}
	
	}
	
	
	
	function carrot_get_performance_bottomtitle(){
		$ret="";
		switch(gf("performance_type")){
			case "performance": 
			default:
				$ret= gf("repertori");
				break;
			case "aniversary": 
				$img= wp_get_attachment_image_src(124,"full");
				//_dump($img);
				if($img){
					$ret.="<img src='".$img[0]."' alt='Logo 50 aniversari' class='logo-aniversary' />"; 
				}	
				break;
			case "spectacle": 
				$ret= __("Descripció i condicions");
				break;
			

		}
		return $ret;
	}

	function carrot_get_performance_bottomsubtitle(){
		$ret="";
		switch(gf("performance_type")){
			case "performance": 
			default:
				$ret= gf("fecha");
				break;
			case "aniversary": 
				$ret= gf("fecha2")."<br/>";
				$ret.= gf("hora")."<br/>".gf("preu");
				break;
			case "spectacle": 
				$ret= __("Nou espectacle");
				break;
			

		}
		return $ret;
	}



	function carrot_get_performance_subtitle(){
		$ret="";
		switch(gf("performance_type")){
			case "performance": 
			case "aniversary": 
			default:
				$ret= gf("location");
				break;
			case "spectacle": 
				$terms=array();
				if(has_field("condicions_tecniques")) $terms[]=gf("condicions_tecniques");
				if(has_field("preu")) $terms[]=gf("preu");
				$ret= implode(". ",$terms);
				break;
			

		}
		return $ret;
	}
	function carrot_performance_subcontent(){
		$ret="";
		switch(gf("performance_type")){
			case "performance": 
			case "aniversary": 
			default:
				break;
			case "spectacle": 
				if(has_field("condicions_tecniques")){
					$ret.="<div>";
					$ret.="<h4>".__("Condicions Tècniques", THEME_NAME)."</h4>";
					$ret.=gf("condicions_tecniques");
					$ret.="</div>";
				}

				if(has_field("requeriment")){
					$ret.="<div>";
					$ret.="<h4>".__("Requeriment", THEME_NAME)."</h4>";
					$ret.=gf("requeriment");
					$ret.="</div>";
				}

				if(has_field("durada")){
					$ret.="<div>";
					$ret.="<h4>".__("Durada de l'espectacle", THEME_NAME)."</h4>";
					$ret.=gf("durada");
					$ret.="</div>";
				}

				if(has_field("preu")){
					$ret.="<div>";
					$ret.="<h4>".__("Preu", THEME_NAME)."</h4>";
					$ret.=gf("preu");
					$ret.="</div>";
				}

				if(has_field("document")){
					$doc=gf("document");
					$ret.="<div>";
					$ret.="<h4>".__("Més informació", THEME_NAME)."</h4>";
					$ret.= "<a href='".$doc["url"]."'><span class='doc-icon text-alt'>"._icon("icon_pdf_file")."</span> ".$doc["title"]."</a>";
					$ret.="</div>";
				}
				
				break;
		
		}
		return $ret;
	}



	function carrot_performance_simple_tile_content(){
		
		switch(gf("performance_type")){
			case "performance": 
			case "spectacle":
			default: 
	?>
			<a href="<?php the_permalink();?>">	
				<?php if(has_field("fecha")){ ?>
					<div class="performance-date"><?=gf("fecha")?></div>
				<?php } ?>
				<h2 class="post-title"><?php the_title(); ?></h2>
				<?php if(has_field("location")){ ?>
					<div class="performance-location"><?=gf("location")?></div>
				<?php } ?>
				<?php if(has_field("repertori")){ ?>
					<div class="repertori"><?=gf("repertori")?></div>
				<?php } ?>
			</a>
	<?php
			break;
			case "aniversary": 

	?>
			<?php if(gf("moreinfo")){ ?>
				<a href="<?php the_permalink();?>">	
			<?php } ?>
				
				<?php if(has_field("fecha")){ ?>
					<div class="performance-date"><?=gf("fecha2")?></div>
				<?php } ?>
				<h2 class="post-title"><?php the_title(); ?></h2>
				<?php if(has_field("location")){ ?>
					<div class="performance-location"><?=gf("location")?></div>
				<?php } ?>
				<?php if(has_field("hora") || has_field("preu")){ ?>
					<div class="repertori"><?=gf("hora")?> <?=gf("preu")?></div>
				<?php } ?>

			<?php if(gf("moreinfo")){ ?>
				</a>	
			<?php } ?>
	<?php		
			break;
		}
		

		

	}