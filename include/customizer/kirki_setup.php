<?php

	global $carrotthemeoptions;
			
	$carrotthemeoptions=array();
	
	
	



	function kirki_add_sections($name,$sectionargs,$parent=false){
		if(!class_exists("Kirki")) return;
		
		$coresections=array('title_tagline','colors','nav_menus','widgets','static_front_page');
		global $priority;
		//global $coresections;
		
		$sectionargs["priority"]=($priority+=10);
			
		if(array_key_exists("children",$sectionargs)){
			/*is a panel*/
			//$wp_customize->add_panel( $name, $sectionargs );
			if(!in_array($name,$coresections)){
				Kirki::add_panel( $name, $sectionargs );
			
				foreach($sectionargs["children"] as $namechild=>$section){
					kirki_add_sections($namechild,$section,$name);
				}
			}
		}else{
			/*is a section*/
			if($parent){
				$sectionargs["panel"]=$parent;
			}
			if(!in_array($name,$coresections)){
				Kirki::add_section( $name, $sectionargs );
			}
			if(array_key_exists ("fields",$sectionargs)){
				foreach($sectionargs["fields"] as $namefield=>$field){
					
					$field["settings"]=$namefield;
					$field["section"]=$name;

					if(array_key_exists('output',$field) && is_array($field["output"])){
						$field["transport"]="postMessage";
						$field["js_vars"]=array();
						foreach($field["output"] as $jsvar){
							$jsvar["function"]="style";
							
							$field["js_vars"][]=$jsvar;
						}
						//if($field["settings"]=="body_text_color") _dump($field);
					}
					
					if(array_key_exists('option_type',$field) && $field["option_type"]=='option')
						Kirki::add_field( THEME_NAME.'_opts', $field);
					else 
						Kirki::add_field( THEME_NAME.'_mods', $field);
				}
			}
		}
		
		
	}
			



	/*customizer customizer styling*/
	function kirki_configuration_styling( $config ) {
		return wp_parse_args( array(
			'logo_image'   => THEME_URI.'/assets/images/carrot-logo.svg',
			'description'  => esc_attr__( 'Carrot Theme.', THEME_NAME ),
			'color_accent' => '#ff9933',
			'color_back'   => '#ffffff',
		), $config );
	}


	$kirki_custom_controls=array();


	function kirki_register_custom_controls( $wp_customize ) {
		global $kirki_custom_controls;

		
		$path=dirname(__FILE__) ."/controls/";
		//_dump($path);
		if(!is_dir($path)) return;

			
		$files=scandir($path);
		//_dump($files);

		if($files){
			foreach ($files as $file) {
				if (!is_dir($path.$file)){
					$extension = pathinfo($file, PATHINFO_EXTENSION);
					$name = pathinfo($file, PATHINFO_FILENAME);
					if($extension=="php"){
						include_once($path.$file);
						$classname=str_replace(" ","",ucwords(str_replace("-", " ", $name)))."_Control";
						if(class_exists($classname)){
							$kirki_custom_controls[$name]=$classname;
							//$wp_customize->register_control_type($classname);
						}
					}
					
				}
			}
		}



		if($kirki_custom_controls){
			// Register our custom control with Kirki
			add_filter( 'kirki/control_types', function( $controls ) {
				global $kirki_custom_controls;
				foreach($kirki_custom_controls as $controlname => $classname){
					$controls[$controlname] = $classname;
				}
				return $controls;
			} );
			foreach($kirki_custom_controls as $controlname => $classname){
				$wp_customize->register_control_type($classname);
			}
		
		}

	}		


	function kirki_set_theme_mods() {
		//set_theme_mod( 'kirki_styles', "true" );
		
	}

	function carrot_customizer_init(){
		if(class_exists('Kirki')){
			global $carrotthemeoptions;
			

			$selected_preset=carrot_get_current_preset(true);//carrot_get_current_preset();
			//_dump($selected_preset);
			//update preset defaults
			if($selected_preset->defaults && is_array($selected_preset->defaults)){
				foreach($selected_preset->defaults as $optionslug=>$optionvalue){
					$carrotthemeoptions=set_default_option_value($optionslug,$optionvalue,$carrotthemeoptions);
				}
			}

			//_dump($selected_preset->customizerelements);
			//update preset customizer elements
			if($selected_preset->customizerelements && is_array($selected_preset->customizerelements)){
				foreach($selected_preset->customizerelements as $optionname=>$outputs){
					$carrotthemeoptions=set_elements_value($optionname,$outputs,$carrotthemeoptions);

				}
			}

			//_dump($carrotthemeoptions);
			
			add_filter( 'kirki/config', 'kirki_configuration_styling' );
			add_action( 'customize_register', 'kirki_register_custom_controls');
			add_action( 'customize_save_after', 'kirki_set_theme_mods'  );

			
			Kirki::add_config( THEME_NAME.'_mods', array(
				'capability'    => 'edit_theme_options',
				'option_type'   => 'theme_mod'
			) );
			
			Kirki::add_config( THEME_NAME.'_opts', array(
				'capability'    => 'edit_theme_options',
				'option_type'   => 'option'
			) );
			
			$priority=130;
			
			foreach($carrotthemeoptions as $name=>$section){
				kirki_add_sections($name,$section);
			}
			
		}
	}
