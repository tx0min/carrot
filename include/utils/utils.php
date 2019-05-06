<?php


	function getbrowser() 
	{ 
		$u_agent = $_SERVER['HTTP_USER_AGENT']; 
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";

		//First get the platform?
		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'linux';
		}
		elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'mac';
		}
		elseif (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'windows';
		}
		
		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Internet Explorer'; 
			$ub = "MSIE"; 
		} 
		elseif(preg_match('/Firefox/i',$u_agent)) 
		{ 
			$bname = 'Mozilla Firefox'; 
			$ub = "Firefox"; 
		} 
		elseif(preg_match('/Chrome/i',$u_agent)) 
		{ 
			$bname = 'Google Chrome'; 
			$ub = "Chrome"; 
		} 
		elseif(preg_match('/Safari/i',$u_agent)) 
		{ 
			$bname = 'Apple Safari'; 
			$ub = "Safari"; 
		} 
		elseif(preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Opera'; 
			$ub = "Opera"; 
		} 
		elseif(preg_match('/Netscape/i',$u_agent)) 
		{ 
			$bname = 'Netscape'; 
			$ub = "Netscape"; 
		} 
		
		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
			// we have no matching number just continue
		}
		
		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			}
			else {
				$version= $matches['version'][1];
			}
		}
		else {
			$version= $matches['version'][0];
		}
		
		// check if we have a number
		if ($version==null || $version=="") {$version="?";}
		
		return array(
			'userAgent' => $u_agent,
			'name'      => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'    => $pattern
		);
	} 

	function compatible_browser(){
		$browser=getbrowser();
		if($browser["name"]=="Internet Explorer" && intval($browser["version"])<=9) return false;
		return true;
	}


	

	function starts_with_vowel($str){
		$first=substr($str, 0, 1);
		return in_array(strtoupper($first),array('A','E','I','O','U'));
	}

	function mes_amb_vocal(){
		$mes=strtoupper(get_the_date('F'));
		return starts_with_vowel($mes);
	}
					
	function startsWith($haystack, $needle) {
		// search backwards starting from haystack length characters from the end
		return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
	}

	function endsWith($haystack, $needle) {
		// search forward starting from end minus needle length characters
		return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
	}
		


	function trim_text($input, $width){
		if(empty($input)) return $input ;
		if (strlen($input) <= $width){
			return $input;
		}
		
		$output = substr($input,0,$width);
		
		//normals words are seldom more than 30 chars
		
		$pos = 0 ;
		$found = false;
		for($i = $width-1 ; $i >= 0 ; $i--) {
			if(ctype_space($output[$i])) {
				$found = true ;
				break;
			}
			$pos++ ;
		}
		if($found && ($pos > 0)) {
			$output = substr($output,0,($width-$pos));
			$output = rtrim($output) ;
		}
		
		$output .= '...' ;
		return $output;
	}


	function curPageURL() {
		$pageURL = 'http';
		 if (isset($_SERVER["HTTPS"]) &&  $_SERVER["HTTPS"] == "on") {
			$pageURL .= "s";
		}
		 $pageURL .= "://";
		 if ($_SERVER["SERVER_PORT"] != "80") {
			  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		 } 
		else {
			  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		 }
		return $pageURL;
	}

	
	if (!function_exists('write_log')) {
		function write_log ( $log )  {
			if ( true === WP_DEBUG ) {
				if ( is_array( $log ) || is_object( $log ) ) {
					error_log( print_r( $log, true ) );
				} else {
					error_log( $log );
				}
			}
		}
	}
	
	
	function isValidURL($url)
    {
		$pattern = "#^(?:https?|ftp)://#";
        $match= preg_match($pattern, $url);
		return $match > 0;
    }
	
	function _dump($o){
		echo "<pre>";
		var_dump($o);
		echo "</pre>";
	
	}
	
	
	function isTrue($value){
		return $value===true || $value==="true" || $value==="TRUE" || $value==="on" || $value==="1" || $value===1;
	}

	function isFalse($value){
		return $value===false || $value==="false" || $value==="FALSE" || $value==="0" || $value===0;
	}
	
	
	function includeToVar($file,$args=false){
		ob_start();
		include($file);
		return ob_get_clean();
	}
	
	
	function get_query_link($query){
		//	_dump($query);
		parse_str($query, $parts);
		//_dump($parts);
		if(array_key_exists("tax_query",$parts)){
			$taxonomy=explode(":",$parts["tax_query"]);
			//_dump($taxonomy);
			$url=get_term_link($taxonomy[1],$taxonomy[0]);
			//echo $url;
		}else{
			$url=get_permalink( get_option('page_for_posts' ) );	
		}
		return $url;
		/*$url=get_permalink( get_option('page_for_posts' ) );

		

		if($query["tax_query"]){

			$url=get_site_url();

			$url.="/".str_replace(":","/",$query["tax_query"]);

		}

		*/

	}
