<ul class="social-links">
	<?php
		$social=array();
		
		
		if(_o("social_facebook")){
			$social[]=array(
				"social_name"=>"Facebook",
				"social_url"=>_o("social_facebook"),
				"social_icon"=>"ti-facebook"
			);
		}
		
		if(_o("social_twitter")){
			$social[]=array(
				"social_name"=>"Twitter",
				"social_url"=>"https://twitter.com/"._o("social_twitter"),
				"social_icon"=>"ti-twitter-alt"
			);
		}
		if(_o("social_linkedin")){
			$social[]=array(
				"social_name"=>"LinkedIn",
				"social_url"=>_o("social_linkedin"),
				"social_icon"=>"ti-linkedin"
			);
		}
		if(_o("social_google_plus")){
			$social[]=array(
				"social_name"=>"Google+",
				"social_url"=>_o("social_google_plus"),
				"social_icon"=>"ti-google"
			);
		}

		if(_o("social_youtube")){
			$social[]=array(
				"social_name"=>"Youtube",
				"social_url"=>_o("social_youtube"),
				"social_icon"=>"ti-youtube"
			);
		}
		if(_o("social_flickr")){
			$social[]=array(
				"social_name"=>"Flickr",
				"social_url"=>_o("social_flickr"),
				"social_icon"=>"ti-flickr"
			);
		}
		if(_o("social_pinterest")){
			$social[]=array(
				"social_name"=>"Pinterest",
				"social_url"=>_o("social_pinterest"),
				"social_icon"=>"ti-pinterest"
			);
		}
		
		if(_o("social_instagram")){
			$social[]=array(
				"social_name"=>"Instagram",
				"social_url"=>"http://instagram.com/"._o("social_instagram"),
				"social_icon"=>"ti-instagram"
			);
		}
		if(_o("social_rss")){
			$social[]=array(
				"social_name"=>"RSS Feed",
				"social_url"=>get_bloginfo('rss2_url'),
				"social_icon"=>"ti-rss-alt"
			);
			
		}
		if(_o("social_other") && is_array(_o("social_other"))){
			$social=array_merge($social,_o("social_other"));
			
		}
		//var_dump($social);
		if($social){
			foreach($social as $s){
		?>
			<li class="icon-<?=$s["social_icon"]?>">
				<a href="<?=$s["social_url"]?>" target="_blank" title="<?=$s["social_name"]?>"><i class="ti <?=$s["social_icon"]?>"></i></a>
			</li>
		<?php
			}
		}
		
		/*var_dump(_o("social_twitter"));
		var_dump(_o("social_other"));*/
	?>
</ul>