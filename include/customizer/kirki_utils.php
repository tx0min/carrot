<?php

		
	if ( ! function_exists( 'get_default_options_value' ) ) :
		function get_default_options_value($optionname,$options=false){
			global $carrotthemeoptions;
			if(!$options) $options=$carrotthemeoptions;

			//_dump($options);
			if(!$options) return false;
			foreach($options as $name=>$section){
				if(array_key_exists("fields", $section)){
					foreach($section["fields"] as $fieldname=>$field){
						if($fieldname==$optionname){
							if(array_key_exists("default",$field)) return $field["default"];
						}
					}
				}
				if(array_key_exists("children", $section)){
					$ret= get_default_options_value($optionname, $section["children"]);
					if($ret) return $ret;
				}
			}
			return false;
		}
	endif;

	
	if ( ! function_exists( 'set_default_option_value' ) ) :
		function set_default_option_value($optionname,$value,$options){
			
			foreach($options as $sectionname=>$section){
			
				if(array_key_exists("fields", $section)){
					foreach($section["fields"] as $fieldname=>$field){
						if($fieldname==$optionname){
							$options[$sectionname]["fields"][$fieldname]["default"] = $value;
						}
					}
				}
				if(array_key_exists("children", $section)){
					$options[$sectionname]["children"] = set_default_option_value($optionname, $value, $section["children"]);
				}
			}
			return $options;
		}
	endif;
	
	if ( ! function_exists( 'set_elements_value' ) ) :
		function set_elements_value($optionname,$outputs,$options){
			//_dump($optionname);
			//_dump($outputs);
			foreach($options as $sectionname=>$section){
			
				if(array_key_exists("fields", $section)){
					foreach($section["fields"] as $fieldname=>$field){
						if($fieldname==$optionname){
							//_dump($fieldname);
							foreach($outputs as $newoutput){
								//$tmp=array();
								//_dump($newoutput);
								

								if(isset($options[$sectionname]["fields"][$fieldname]["output"])){
									$propertyfound=false;
									foreach($options[$sectionname]["fields"][$fieldname]["output"] as $i=>$output){	
										/*if(isset($newoutput["property"]) && !isset($output["property"])){
											$output["property"]= $newoutput["property"];
											$options[$sectionname]["fields"][$fieldname]["output"][$i]=$output["property"];
										}*/
										//_dump($newoutput["property"]."||".$output["property"]);
										if((!isset($newoutput["property"]) && !isset($output["property"]) ) || ($output["property"]==$newoutput["property"])){
											$propertyfound=true;
											
											$current=$options[$sectionname]["fields"][$fieldname]["output"][$i]["element"];
											$options[$sectionname]["fields"][$fieldname]["output"][$i]["element"] = ($current?$current.",":"") .  $newoutput["element"];
											if(isset($newoutput["important"])){
												if($newoutput["important"]) $options[$sectionname]["fields"][$fieldname]["output"][$i]["suffix"] =" !important";
												unset($newoutput["important"]);
											}
										}
										//_dump($options[$sectionname]["fields"][$fieldname]["output"][$i]);

									}
									if(!$propertyfound){
										
										
										$tmp=$newoutput;
										if(isset($tmp["important"])){
											
											if($tmp["important"]) $tmp["suffix"] =" !important";
											unset($tmp["important"]);
										}
												
										$options[$sectionname]["fields"][$fieldname]["output"][]= $tmp;	

									}
									
								}else{
									$tmp=array("property"=>$newoutput["property"],"element"=>$newoutput["element"]);
									if(isset($newoutput["units"])) $tmp["units"]=$newoutput["units"];
									$options[$sectionname]["fields"][$fieldname]["output"][]=$tmp;
								}




								
								
							}
							
						}
					}
				}
				if(array_key_exists("children", $section)){
					$options[$sectionname]["children"] = set_elements_value($optionname, $outputs, $section["children"]);
				}
			}
			//_dump($options);
			return $options;
		}
	endif;
	
	
	

	if ( ! function_exists( '_o' ) ) :
		function _o($fieldname,$default=""){
			return _opt($fieldname,$default);
		}
	endif;
	
	if ( ! function_exists( '_opt' ) ) :
		function _opt($fieldname,$default=""){
			$def = get_default_options_value($fieldname);
			if(!$def) $def = $default;
			
			
			if(function_exists('get_theme_mod'))
				return get_theme_mod($fieldname,$def);
			else return $def;
			//$ret=get_option($fieldname,$def);
			
			return $ret;
		}
	endif;

	/*if ( ! function_exists( '_mod' ) ) :
		function _mod($fieldname,$default=""){

			$def = get_default_options_value($fieldname);
			if(!$def) $def = $default;

			if(function_exists('get_theme_mod'))
				return get_theme_mod($fieldname,$default);
			else return $default;
		}
	endif;*/
	
		
	if ( ! function_exists( '_img' ) ) :
		function _img($fieldname,$default=""){
			$img=_opt($fieldname,$default);
			
			if($img)
				return "<img src='".$img."'/>";
			else return $default;
			
		}
	endif;
	
	if ( ! function_exists( '_color' ) ) :
		function _color($fieldname,$default=""){
			return  _opt($fieldname,$default);
			
		}
	endif;



	if ( ! function_exists( '_icon' ) ) :
		function _icon($fieldname,$classes=false,$default=""){
			$def = get_default_options_value($fieldname);
			if(!$def) $def = $default;
			
			if($classes ){
				if(is_array($classes)) $classes=implode(" ",$classes);
				
			}
			
			if(function_exists('get_theme_mod'))
				return "<span class='carrot-icon ".$classes."'>".siteorigin_widget_get_icon( get_theme_mod($fieldname,$def))."</span>";
			else return $def;
			//$ret=get_option($fieldname,$def);
			
			return $ret;
		}
	endif;