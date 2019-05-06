<?php

	

		if ( ! function_exists( 'f' ) ) :
			function f($fieldname){
				_e(gf($fieldname));
			}
		endif;

		if ( ! function_exists( 'has_field' ) ) :
			function has_field($name){
				$custom_fields = get_post_custom();
				return array_key_exists($name,$custom_fields);
			}
		endif;
		if ( ! function_exists( 'gf' ) ) :
			function gf($fieldname,$global=false){
				if(!function_exists( 'get_field' )) return "";

				if ($global) return get_field($fieldname,'options');
				
				if(is_home() || is_archive() || is_search()){
					return get_field($fieldname, get_option('page_for_posts'));
				}else{
					return get_field($fieldname);
				}
			}
		endif;
		
		if ( ! function_exists( 'opt' ) ) :
			function opt($fieldname){
				if(!function_exists( 'get_field' )) return "";
				
				return get_field($fieldname,"options");
			}
		endif;
		
			
		if ( ! function_exists( 'get_img_url' ) ) :
			function get_img_url($name,$size="thumbnail",$id=0){

				if(!function_exists( 'get_field' )) return "";
				
				//echo $name.".".$id ;
				if(is_numeric($id)){
					//echo "NUMERIC";
					if($id==0){
						$fld=get_field($name);
					}else{
						$fld=get_field($name,$id);
					}
					
				}else{
					//echo "OPTIONS";
					$fld=get_field($name,$id);
				}
				if($fld){
					$ret="";
					$ret.=$fld["sizes"][$size];
					return $ret;
				}else return false;
				
			}
		endif;


		if ( ! function_exists( 'get_img' ) ) :
			function get_img($name,$size="thumbnail",$link=false,$id=0){
				if(!function_exists( 'get_field' )) return "";
				
				if(is_numeric($id)){
					//echo "NUMERIC";
					if($id==0){
						$fld=get_field($name);
					}else{
						$fld=get_field($name,$id);
					}
					
				}else{
					//echo "OPTIONS";
					$fld=get_field($name,$id);
				}
				if($fld){
					//echo $fld;
					/*echo "<pre>";
					print_r($fld);
					echo "</pre>";*/
					$ret="";
					if($link) $ret.="<a href=\"".$fld["sizes"]["large"]."\">";
					$ret.="<img src=\"".$fld["sizes"][$size]."\" alt=\"\" title=\"\" />";
					if($link) $ret.="</a>";
					
					return $ret;
				}else return false;
				
			}
		endif;

		if ( ! function_exists( 'the_img' ) ) :
			function the_img($name,$size="thumbnail",$link=false,$id=0){
				
				echo get_img($name,$size,$link,$id);
			}
		endif;





		if ( ! function_exists( 'get_color' ) ) :
			function get_color($name,$opt=''){
				
				if(!function_exists( 'get_field' )) return "";
				
				//echo $name;
				$ret="";
				if (function_exists( 'get_field' ) ){
					if($opt=='') $ret=get_field($name);
					else  $ret=get_field($name,'options');
				}
				//echo $ret;
				//remove the hashtag
				return str_replace('#','',$ret);
			}
		endif;

		if ( ! function_exists( 'the_color' ) ) :
			function the_color($name,$opt=''){
				echo get_color($name,$opt);
			}
		endif;

	
		
	
	
	
		if ( ! function_exists( '_field' ) ) :
			function _field($fieldname,$pre="",$post="",$id=false){
				if(!function_exists( 'get_field' )) return "";
				
				if($id){
					$value = get_field($fieldname,$id);
				}else{
					$value = get_field($fieldname);
				}
				if($value){
					return $pre.$value.$post;
				}
				
			}
		endif;
		
		if ( ! function_exists( '_option' ) ) :
			function _option($fieldname,$pre="",$post=""){
				if(!function_exists( 'get_field' )) return "";
				
				$value = get_field($fieldname,"options");
				if($value){
					return $pre.$value.$post;
				}
				
			}
		endif;

	