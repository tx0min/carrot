<?php


if ( ! function_exists( 'carrot_the_title')) :
	function carrot_the_title(){
		global $page, $paged;

		wp_title( '|', true, 'right' );

		// Add the blog name.
		bloginfo( 'name' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";

		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', THEME_NAME ), max( $paged, $page ) );
	}
endif;



if ( ! function_exists( 'get_blog_url' ) ) :
	function get_blog_url(){
		if( get_option( 'show_on_front' ) == 'page' ) echo get_permalink( get_option('page_for_posts' ) );
		else echo bloginfo('url');
	}
endif;



if ( ! function_exists( 'carrot_posts_navigation' ) ) :
	function carrot_posts_navigation(){
		$style=_o('blog_pagination_style','classic');
		if(is_archive() || is_search()) $style=_o('archive_pagination_style','classic');
	
		if($style!='none'){
			echo "<div class='posts-navigation'>";
			echo "<div class='row'>";
			if($style=='classic'){
				echo "<div class='col-xs-6 text-left'>";
				echo get_previous_posts_link(_icon("icon_angle_left")." ".__("Newer articles",THEME_NAME));
				echo "</div>";
				echo "<div class='col-xs-6 text-right'>";
				echo get_next_posts_link(__("Older articles",THEME_NAME)." "._icon("icon_angle_right"));
				echo "</div>";
			}else{
				echo "<div class='col-xs-12 text-center'>";
				$pagination = get_the_posts_pagination( array(
					'mid_size' => 2,
					'screen_reader_text' => false,
					'prev_text' => _icon("icon_angle_left"),
					'next_text' => _icon("icon_angle_right"),
				) );
				echo $pagination;
				echo "</div>";
			}
			echo "</div>";
			echo "</div>";
		}
	}
endif;


if ( ! function_exists( 'carrot_single_post_navigation' ) ) :
	function carrot_single_post_navigation($posttype="post"){

		if(_o("single_".$posttype."_show_navigation")){
			 echo "<div class='single-nav single-".$posttype."-nav'>";
			 echo "	<div class='container'>";
			 echo "	<ul>";
			 echo "<li class='nav-prev'>";
			 previous_post_link( '%link', '<span class="nav-arrow">' . _x( _icon("icon_angle_left"), 'Previous', THEME_NAME ) . '</span> <span class="nav-title">%title</span>' ); 
             echo "</li>";
             echo "<li class='nav-next'>";
			 next_post_link( '%link', '<span class="nav-title">%title</span> <span class="nav-arrow">' . _x( _icon("icon_angle_right"), 'Next', THEME_NAME ) . '</span>' ); 
			 echo "</li>";
             
			echo "</ul>";
			echo "</div>";
			echo "</div>";
		}
		
	}
endif;





if ( ! function_exists( 'carrot_get_nav_menu' ) ) :
	function carrot_get_nav_menu($location=false){
		if($location)
			wp_nav_menu( array( 'theme_location' => $location ) ); 		//wp_nav_menu( array( 'menu' => $id ) ); 
		else 
			wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); 
	}
endif;




if ( ! function_exists( 'carrot_home_url' ) ) :
	function carrot_home_url () {
		//if ( ! function_exists( 'qtrans_getLanguage' ) ) echo home_url( '/' );
		//else
        echo home_url( '/' );//.qtrans_getLanguage();
	}
endif;






if ( ! function_exists( 'carrot_posted_on' ) ) :
function carrot_posted_on() {
	global $q_config;
	if(function_exists('qtrans_getLanguage')){
		$format=$q_config['date_format'][qtrans_getLanguage()];
		the_date($format);
	}else{
		the_time(get_option('date_format'));
	}
}
endif;







if ( ! function_exists( 'carrot_view_count' ) ) :
	function carrot_view_count($text=true) {
		if(function_exists('carrot_get_post_views')) {
			if($text){
				$views=carrot_get_post_views(get_the_ID());
				echo sprintf( _n("Read %s time", "Read %s times", $views, THEME_NAME ), $views );
			}else {
				echo carrot_get_post_views(get_the_ID());
			}
		} 
	}
endif;



if ( ! function_exists( 'carrot_comments_count' ) ) :
	function carrot_comments_count() {
		if ( comments_open() ){
			//echo " ///// ";
			$num=get_comments_number();
			echo '<div class="article-comments">';
			$link=(is_single()?"":get_permalink())."#comments-container";
			//echo comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', THEME_NAME ) . '</span>', __( '<b>1</b> Reply', THEME_NAME), __( '<b>%</b> Replies', THEME_NAME ) ) ;
			echo "<a href='".$link."' title='".$num." ".__('comments', THEME_NAME )."'>".$num."</a>";
			echo '</div>';
		}
	}
endif;


if ( ! function_exists( 'carrot_likes_count' ) ) :
	function carrot_likes_count() {
		if ( comments_open() ){
			//echo " ///// ";
			$num=23;//get_comments_number();
			echo '<div class="article-likes">';
			//echo comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', THEME_NAME ) . '</span>', __( '<b>1</b> Reply', THEME_NAME), __( '<b>%</b> Replies', THEME_NAME ) ) ;
			echo "<a href='#' title='".$num." ".__('likes', THEME_NAME )."'>".$num."</a>";
			echo '</div>';
		}
	}
endif;





if ( ! function_exists( 'carrot_post_author' ) ) :
	function carrot_post_author($showfoto=true,$showbio=true,$prefix=false,$showname=true,$id=0) {
		global $q_config;
		$the_id=$id;
		if($id==0) $the_id = get_the_author_meta( 'ID' );
		$user=get_userdata($the_id);
		//print_r($user);
			
		$name=$user->display_name;


		echo "<a href=\"".get_author_posts_url( $the_id )."\">";
		if($showfoto){
			$author_badge = get_field('foto', 'user_'. $the_id ); // image field, return type = "Image Object"
			if($author_badge) {
				echo "<img class='avatar' src=\"". $author_badge['sizes']['thumbnail']. "\" alt=\"".$name."\" />";
			}else{
				echo get_avatar( $user->user_email, '48' );
			}
		}
		if($showname) {
			echo "<span class='author-name'>";
			if($prefix) echo "<span class='prefix'>".$prefix."</span>";
			echo $name;
			echo "</span>";
		}
		echo "</a>";
		if($showbio){
			$bio=get_user_meta($the_id,'description');
		//	print_r($bio);
			echo "<span class='carrec'>".$bio[0]."</span>";
		}
	}
endif;




if ( ! function_exists( 'carrot_author_args' ) ) :
	function carrot_author_args($show_options=true,$id=0) {
		global $q_config;
		//_dump($show_options);
		$authorprefix="";

		if(is_array($show_options)){
			$showauthorname=array_key_exists("name",$show_options) && isTrue($show_options["name"]);	
			$showauthorphoto=array_key_exists("avatar",$show_options) && isTrue($show_options["avatar"]);	
			$showauthorbio=array_key_exists("bio",$show_options) && isTrue($show_options["bio"]);	
			$showauthorprefix=array_key_exists("prefix",$show_options) && !isFalse($show_options["prefix"]);	
			if($showauthorprefix) $authorprefix=$show_options["prefix"];
			$showauthortwitter=array_key_exists("twitter",$show_options) && isTrue($show_options["twitter"]);	
			$showauthoremail=array_key_exists("email",$show_options) && isTrue($show_options["email"]);	
		}else{
			$showauthorname=true;	
			$showauthorphoto=false;	
			$showauthorbio=false;	
			$showauthorprefix=true;
			$showauthortwitter=false;
			$showauthoremail=false;
			$authorprefix=__("Text: ",THEME_NAME);
		
		}

		$the_id=$id;
		if($id==0) $the_id = get_the_author_meta( 'ID' );
		
		$user=get_userdata($the_id);
		$name=$user->display_name;

		echo "<a href=\"".get_author_posts_url( $the_id )."\">";
		if($showauthorphoto){
			$author_badge = get_field('foto', 'user_'. $the_id ); // image field, return type = "Image Object"
			if($author_badge) {
				echo "<img  class='avatar'  src=\"". $author_badge['sizes']['thumbnail']. "\" alt=\"".$name."\" />";
			}else{
				echo get_avatar( $user->user_email, '96' );
			}
		}

		if($showauthorname) {
			echo "<span class='author-name'>";
			if($showauthorprefix) echo "<span class='prefix'>".$authorprefix."</span>";
			echo $name;
			echo "</span>";
		}
		echo "</a>";


		if($showauthortwitter){
			$twitter=get_field('twitter', 'user_'. $the_id );
			if($twitter)
				echo "<a class='twitter_link' href='https://twitter.com/".$twitter."' target='_blank'>"._icon("icon_twitter")."  @".$twitter."</a>";
		}
		if($showauthoremail){
			echo "<a class='author_email' href='mailto:".$user->user_email."'>"._icon("icon_email")." ".$user->user_email."</a>";
		}
		
		if($showauthorbio){
			$bio=get_user_meta($the_id,'description');
			echo "<span class='carrec'>".$bio[0]."</span>";
		}

	}
endif;






if ( ! function_exists( 'carrot_get_attachment_url' ) ) :
	function carrot_get_attachment_url($id,$size='large'){
		$imgdata = wp_get_attachment_image_src($id, $size);

		$ext = strrchr($imgdata[0], "."); 
		
		if(strtolower($ext)==".gif"){
			$imgdata = wp_get_attachment_image_src($id, "full");
		}
		return $imgdata[0];
	}
endif;





if ( ! function_exists( 'carrot_get_post_thumbnail_url' ) ) :
	function carrot_get_post_thumbnail_url($size='large'){
        if(has_post_thumbnail()) {
            return carrot_get_attachment_url(get_post_thumbnail_id(),$size);
        }
        return false;
    }
endif;







if ( ! function_exists( 'get_postID_by_url' ) ) :
	function get_postID_by_url($url) {
		global $wpdb;
		
		$id = url_to_postid($url);
		//al("-".$id);
		if($id==0) {
			$dir=wp_upload_dir();
			$fileupload_url = $dir['baseurl'].'/';
			//al($fileupload_url);
			if (strpos($url,$fileupload_url)!== false) {
				$url = str_replace($fileupload_url,'',$url);
				if(strstr($url,"?")!==false){
					$tmp = explode('?',$url);
					$url=$tmp[0];
				}
				//al($url);
				$id = $wpdb->get_var($wpdb->prepare("SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $url));
				if(!$id){
					//al("NO");
					$match = array();
					$url=preg_replace('/-\d{1,4}x\d{1,4}./', '.',$url);
					$id = $wpdb->get_var($wpdb->prepare("SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $url));
				}
			}
		}
		return $id;
	}
endif;





if ( ! function_exists( 'get_post_thumbnail_by_id' ) ) :
	function get_post_thumbnail_by_id($id,$size='large',$printsize=false,$container=false,$link=false,$classes=false,$background=false){
		global $post;
		$post=get_post($id);
		//_dump($post);
		
		setup_postdata($post);
		$ret= get_post_thumbnail($size,$printsize,$container,$link,$classes,$background);
		wp_reset_postdata(); 
		return $ret;
	}
endif;



if ( ! function_exists( 'get_post_thumbnail_data' ) ) :
	function get_post_thumbnail_data($size='large',$data=false){
		$hasimage=false;
		$return="";
		if(has_post_thumbnail()){
			$imgdata = wp_get_attachment_image_src(get_post_thumbnail_id(), $size );
			if($imgdata){
				$hasimage=true;
				$imgurl = $imgdata[0]; // the url of the thumbnail picture
			}
		}
		
		if(!$hasimage){
			$imgurl=catch_first_image(get_the_content(),$size);
			
		}
		
		$return.=  "<img class='wp-post-image' src='".$imgurl."' ";
		if($data && is_array($data)){
			foreach($data as $name=>$value){
				$return.=" data-".$name."='".htmlentities($value)."' ";
			}
		}
		$return.=  " />";
		return $return;
		
	}
endif;


//global $post;
if ( ! function_exists( 'get_post_thumbnail' ) ) :
	function get_post_thumbnail($size='large',$printsize=false,$container=false,$link=false,$classes=false,$background=false){
		//global $post;

		$return="";
		if($container)	$return.= "<div class='article-featured'>";
		$hasimage=false;
		if($link){
			//_dump($link);
		
			if($link==="image"){
				//_dump($link);
				if(has_post_thumbnail()){
					$imgdata = wp_get_attachment_image_src(get_post_thumbnail_id(), "full"); 
					if($imgdata){
						$hasimage=true;
						$return.=  "<a href='".$imgdata[0]."' >";
					}
				}
			}else{
				$return.=  "<a href='".get_permalink()."' >";
			}
		}

		if(!$classes) $classes="";

		$classes.=" thumbsize-".$size." ";
		$thumbsize=carrot_get_thumbsize($size);
		//_dump($thumbsize);
		if($classes) $classes="class='".$classes."'";
	
		if(has_post_thumbnail()){
			
			$attachment_id=get_post_thumbnail_id();
			
			$mime=get_post_mime_type($attachment_id);
			
			if($mime=="image/gif") $size="full";
				
			$imgdata = wp_get_attachment_image_src($attachment_id, $size); 
				
			
			if($imgdata){
				
				if($background){
					$return.= "<div class='featured-bg' style='background-image:url(" .$imgdata[0].")'></div>";
				}else{
					//_dump($attachment_id);
					$imgalt = get_bloginfo('name');
					$alttxt= get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ); //alt text
					if($alttxt) $imgalt.=" | ". $alttxt;

					
					$imgtitle = get_the_title($attachment_id); //image title

					$imgurl = $imgdata[0]; // the url of the thumbnail picture
					$imgwidth = $imgdata[1]; // thumbnail's width
					$imgheight = $imgdata[2]; // thumbnail's height
					$return.=  "<img ".$classes." src='".$imgurl."' alt='".$imgalt."' title='".$imgtitle."' ";
					if($printsize) $return.=  "width='".$imgwidth."' height='".$imgheight."'";
					$return.=  " />";
				}
			}else{
				$img=catch_first_image(get_the_content(),$size);
				if($background){
					$return.= "<div class='featured-bg' style='background-image:url(" .$img.")'></div>";
				}else{
					$return.=  "<img ".$classes." src='".$img."' ";
					if($thumbsize){
						$return.=  "width='".$thumbsize[0]."' height='".$thumbsize[1]."'";
					}
					$return.="/>";
				}
			}
		}else{
			$img=catch_first_image(get_the_content(),$size);
			if($background){
				$return.= "<div class='featured-bg' style='background-image:url(" .$img.")'></div>";
			}else{
				$return.=  "<img ".$classes." src='".$img."' ";
				if($thumbsize){
					$return.=  "width='".$thumbsize[0]."' height='".$thumbsize[1]."'";
				}
				$return.="/>";
			}
		}
		
		if($link){
			if($link==="image" && $hasimage){
				//_dump($link);
				$return.=  "</a>";
			}else{
				$return.=  "</a>";
			}
			
		}
		if($container)  $return.=  "</div>";
		return $return;
	}

endif;



if ( ! function_exists( 'carrot_post_thumbnail' ) ) :
	function carrot_post_thumbnail($size='large',$printsize=false,$container=false,$link=false,$classes=false,$background=false){
		echo get_post_thumbnail($size,$printsize,$container,$link,$classes,$background);
	}
endif;



if ( ! function_exists( 'carrot_post_thumbnail_by_id' ) ) :
	function carrot_post_thumbnail_by_id($id,$size='large',$printsize=false,$container=false,$link=false,$classes=false,$background=false){
		echo get_post_thumbnail_by_id($id,$size,$printsize,$container,$link,$classes,$background);
	}
endif;






if ( ! function_exists( 'catch_first_image' ) ) :
	function catch_first_image($content,$size='large') {
	  $first_img = ''; 
	  ob_start();
	  ob_end_clean();
	  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
	  //_dump($matches);
	  $first_img=false;
	  if(is_array($matches[1]) && count($matches[1])>0){
		  $first_img = $matches[1][0];
		  $imgid=get_postID_by_url($first_img);
		  if($imgid!=0){
				$imgdata = wp_get_attachment_image_src( $imgid, $size );
				$first_img = $imgdata[0]; // the url of the thumbnail picture
		  }
	  }
	  if(empty($first_img)) {
		$first_img = get_template_directory_uri()."/assets/images/no_thumb.png";
	  }
	  //echo "IMG:".$first_img;
	  return $first_img;
	}
endif;





if ( ! function_exists( 'get_post_thumbnail_url' ) ) :
	function get_post_thumbnail_url($size='large'){
        if(has_post_thumbnail()){
            $imgdata = wp_get_attachment_image_src( get_post_thumbnail_id(), $size );
            $imgurl = $imgdata[0]; // the url of the thumbnail picture
            return $imgurl;
        }
	}
endif;





if ( ! function_exists( 'carrot_post_tags' ) ) :
	function carrot_post_tags() {
		if(get_the_tags()){
			echo "<ul class='post-tags clearfix'>";
			foreach (get_the_tags() as $tag)
			{
				echo "<li ><a href='".get_tag_link($tag->term_id)."'>";
				echo $tag->name;
				echo "</a></li>\n";
			}
			
			echo " </ul> ";
		}
	}
endif;




if ( ! function_exists( 'carrot_get_post_taxonomies' ) ) :
	function carrot_get_post_taxonomies($post_id,$taxonomy) {
		$args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
		$terms = wp_get_post_terms( $post_id, $taxonomy, $args );
		return $terms;
	}
endif;



if ( ! function_exists( 'carrot_post_taxonomies' ) ) :
	function carrot_post_taxonomies($taxonomy,$link=false,$classes=false,$prefix=false) {
		
		$taxes=carrot_get_post_taxonomies(get_the_ID(),$taxonomy);
		$class=array("taxonomies",$taxonomy."_taxonomies");
		if($classes) $class = array_merge($class,$classes);

		if($taxes){
			echo "<ul class='".implode(" ",$class)."'>";
			foreach ($taxes as $tax)
			{
				echo "<li >";
				if($link) echo"<a href='".get_term_link($tax->term_id,$taxonomy)."'>";
				if($prefix) echo $prefix;
				echo $tax->name;
				if($link) echo "</a>";
				echo "</li>\n";
			}
			
			echo " </ul> ";
		}
	}
endif;






if ( ! function_exists( 'carrot_get_post_taxonomy_classes' ) ) :
	function carrot_get_post_taxonomy_classes($post_id,$taxonomy) {
		$args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
		$terms = wp_get_post_terms( $post_id, $taxonomy, $args );
		$classes=array();
		if($terms){
			foreach($terms as $term){
				$classes[]=$taxonomy."_".$term->term_id;
			}
		}
		return implode(" ",$classes);
}
endif;




if ( ! function_exists( 'carrot_get_taxonomies' ) ) :
	function carrot_get_taxonomies($taxonomy,$hide=false,$orderby='count',$order='DESC') {
		$args = array(
			'orderby'           => $orderby,
			'order'             => $order,
			'hide_empty'        => $hide,
			'fields'            => 'all'
		);

		$terms = get_terms($taxonomy, $args);
		return $terms;
	}

endif;


if ( ! function_exists( 'carrot_get_all_taxonomies' ) ) :
	function carrot_get_all_taxonomies() {
		$args = array(
		); 

		$terms = get_taxonomies($args);
		$ret=array();
		return $terms;
	}

endif;



if ( ! function_exists( 'carrot_header_is_visible' ) ) :
	function carrot_header_is_visible(){
		$customdisplay=gf('page_display_options');
		//$customsidebar=gf('sidebar_display');

		if($customdisplay=='custom'){
			//use page options
			$pageoptions=gf('page_custom_display_options');
			if(is_array($pageoptions)){
				return in_array("show_header",$pageoptions);
			}else return false;	
		}else{
			//use site options
			return _o('show_header');
		}
	}
endif;





if ( ! function_exists( 'carrot_footer_is_visible' ) ) :
	function carrot_footer_is_visible(){
		$customdisplay=gf('page_display_options');
		//$customsidebar=gf('sidebar_display');
		if($customdisplay=='custom'){
			//use page options
			$pageoptions=gf('page_custom_display_options');

			if(is_array($pageoptions)){
				return in_array("show_footer",$pageoptions);
			}else return false;	
		}else{
			//use site options
			return _o('show_footer');
		}
	}
endif;




if ( ! function_exists( 'carrot_page_title_is_visible' ) ) :
	function carrot_page_title_is_visible(){
		$customdisplay=gf('page_display_options');
		//$customsidebar=gf('sidebar_display');
		if($customdisplay=='custom'){
			//use page options
			$pageoptions=gf('page_custom_display_options');

			if(is_array($pageoptions)){
				return in_array("show_title",$pageoptions);
			}else return false;	
		}else{
			//use site options
			return _o('show_pages_title');
		}
	}
endif;





if ( ! function_exists( 'carrot_page_breadcrumb_is_visible' ) ) :
	function carrot_page_breadcrumb_is_visible(){
		$customdisplay=gf('page_display_options');
		//$customsidebar=gf('sidebar_display');
		if($customdisplay=='custom'){
			//use page options
			$pageoptions=gf('page_custom_display_options');

			if(is_array($pageoptions)){
				return in_array("show_breadcrumb",$pageoptions);
			}else return false;	
		}else{
			//use site options
			return _o('show_breadcrumb');
		}
	}
endif;


if ( ! function_exists( 'carrot_singlepost_title_is_visible' ) ) :
	function carrot_singlepost_title_is_visible(){
		return _o('single_post_show_title');
		
	}
endif;

if ( ! function_exists( 'carrot_singlepost_breadcrumb_is_visible' ) ) :
	function carrot_singlepost_breadcrumb_is_visible(){
		return _o('single_post_show_breadcrumb');
	}
endif;

if ( ! function_exists( 'carrot_drawer_is_visible' ) ) :
	function carrot_drawer_is_visible(){
		return _o('show_drawer');
	}
endif;






if ( ! function_exists( 'carrot_has_sticky_header' ) ) :
	function carrot_has_sticky_header(){
		$customdisplay=gf('page_display_options');
		
		if($customdisplay=='custom'){
			//use page options
			$pageoptions=gf('page_custom_display_options');

			//_dump($pageoptions);
			if(is_array($pageoptions)){
				return in_array("sticky_header",$pageoptions);
			}else return false;
		}else{
			//use site options
			return _o('show_sticky_header');
		}
	}
endif;




if ( ! function_exists( 'carrot_default_header' ) ) :

	function carrot_default_header(){
		$header_type=_opt("header_type");
		if(_opt("header_layout")=="normal"){
			carrot_get_template_part("header/".$header_type);
		}else{
			$pageid=_o("header_page");
			carrot_include_block($pageid);
		}
	}
endif;


if ( ! function_exists( 'carrot_header_content' ) ) :
	function carrot_header_content(){
		
		if(gf("page_display_options")=="custom"){
			if(gf("header_layout")=="normal" || !has_field("header_layout")){
				carrot_default_header();
			}else{
				$pageid=gf("page_header");
				carrot_include_block($pageid);
			}
		}else{
			carrot_default_header();

		}
	}
endif;


if ( ! function_exists( 'carrot_drawer_content' ) ) :
	function carrot_drawer_content(){
		
		
		if(_opt("drawer_layout")=="normal"){
			carrot_get_template_part("header/drawer-default");
		}else{
			$pageid=_o("drawer_page");
			carrot_include_block($pageid);
		}
	}
endif;



if ( ! function_exists( 'carrot_is_normal_drawer' ) ) :
	function carrot_is_normal_drawer(){
		return _opt("drawer_background_color")!="custom";
	}
endif;

if ( ! function_exists( 'carrot_is_normal_header' ) ) :
	function carrot_is_normal_header(){

		return (
			(gf("page_display_options")!="custom" && _opt("header_layout")=="normal")
			||
			(gf("page_display_options")=="custom" && gf("header_layout")=="normal" && _opt("header_layout")=="normal")
			
		);
	}
endif;

if ( ! function_exists( 'carrot_is_normal_footer' ) ) :
	function carrot_is_normal_footer(){
		return (
			(gf("page_display_options")!="custom" && _opt("footer_layout")=="normal")
			||
			(gf("page_display_options")=="custom" && gf("footer_layout")=="normal" && _opt("footer_layout")=="normal") 
			
		);
	}
endif;

if ( ! function_exists( 'carrot_is_normal_sticky_header' ) ) :
	function carrot_is_normal_sticky_header(){
	

		return (
			(gf("page_display_options")!="custom" && _opt("sticky_header_layout")=="normal")
			||
			(gf("page_display_options")=="custom" && gf("sticky_header_layout")=="normal" && _opt("sticky_header_layout")=="normal")
			
		);
	}
endif;







if ( ! function_exists( 'carrot_footer_content' ) ) :
	function carrot_footer_content(){
		
		function default_footer(){
			//_dump(_opt("footer_layout","normal"));
			if(_opt("footer_layout")=="normal"){
				carrot_get_template_part("footer/footer");
			}else{
				$pageid=_o("footer_page");
				carrot_include_block($pageid);
			}
		}

		//_dump(gf("page_display_options"));
		if(gf("page_display_options")=="custom"){
			if(gf("footer_layout")=="normal" || !has_field("footer_layout")){
				default_footer();
			}else{
				$pageid=gf("page_footer");
				carrot_include_block($pageid);
			}
		}else{
			default_footer();
		}
	}
endif;



if ( ! function_exists( 'carrot_sticky_header_content' ) ) :
	function carrot_sticky_header_content(){
		
		function default_sticky_header(){
			if(_opt("sticky_header_layout")=="normal"){
				carrot_default_header();
			}else{
				$pageid=_o("sticky_header_page");
				carrot_include_block($pageid);
			}
		}

		
		if(gf("page_display_options")=="custom"){
			if( gf("sticky_header_layout") == "normal" || !has_field("sticky_header_layout") ){
				default_sticky_header();
			}else{
				$pageid= gf("page_sticky_header");
				carrot_include_block($pageid);
			}
		}else{
			default_sticky_header();
		}
	}
endif;








if ( ! function_exists( 'carrot_post_categories' ) ) :
	function carrot_post_categories() {
		global $post;
		$cats=wp_get_post_categories($post->ID);
		$class="";
		
		$ret=array();
		foreach($cats as $cid){
			$cat = get_category( $cid );
			 //_dump('category_'.$cid);
			 $color=get_field('color', 'category_'.$cid);
			 $ret[]= "<span class='category-link cat_".$cid."'><a href='".get_category_link($cid)."'><span class='category-name'>".$cat->name."</span> <span class='category-color' style='background-color:".$color."'></span></a></span>";
		}
		
		echo implode(", ",$ret);
	}
endif;


/**





if ( ! function_exists( 'carrot_langlist' ) ) :

	function carrot_langlist () {

	   echo "<div class='lang-selector'>";

	   carrot_get_nav_menu('lang'); 

	   echo "</div>";

	}

endif;





if ( ! function_exists( 'carrot_current_language' ) ) :

	function carrot_current_language () {

		if(!function_exists('qtrans_getLanguage')) return;

    	return qtrans_getLanguage();

	}

endif;

*/



if ( ! function_exists( 'carrot_show_related' ) ) :

	function carrot_show_related($posttype="post"){
		if(_o("single_".$posttype."_show_related")){
			$posts=carrot_get_related_posts(($posttype=="post")?false:$posttype);
			if($posts){
				echo "<div class='related ".$posttype."'>";
				echo "	<div class='container'>";
				echo $posts;
				echo "	</div>";
				echo "</div>";
			}
		}
		
	}
endif;

if ( ! function_exists( 'carrot_show_comments' ) ) :

	function carrot_show_comments(){
		
		if(comments_open()){ 
?>
		
		<div class="comments clearfix" id="comments-container">
			<div  class="container">				
				<div  class="row">			
					<div class="col-sm-12">		
						<div>
							<?php	comments_template( '', true ); ?>
						</div>
					</div>
				</div>				
			</div>				
		</div>				
<?php 
		} 
	}
endif;



if ( ! function_exists( 'carrot_get_related_posts' ) ) :
	function carrot_get_related_posts($posttype=false){
		ob_start();
		carrot_related_posts($posttype);
		$output = ob_get_clean();
		return $output;
	}
endif;


if ( ! function_exists( 'carrot_related_posts' ) ) :
	function carrot_related_posts($posttype=false){
		global $post;
		$orig_post = $post;
		$tags = wp_get_post_tags($post->ID);
		//print_r($tags);
		
		$args=array ( 
			'orderby' => 'rand', 
			'posts_per_page' => _o("related_count",4),
			'post__not_in' => array($post->ID)
		);
		
		remove_all_filters('posts_orderby');
			
		if ($tags) {
			$tag_ids = array();
			foreach($tags as $individual_tag)
				$tag_ids[] = $individual_tag->term_id;

			$args['tag__in']= $tag_ids;
				
		}
		
		if($posttype){
			$args["post_type"]=$posttype;
		}
		
		$my_query = new wp_query( $args );

		$viewicon=true;
		$showtext=false;
		if(_o("related_show_title_hover")){
			$viewicon=false;	
			$showtext=array("title"=>true);
		}
		
		$gridclasses= array("articles-container","grid","cols-"._o("related_columns",4), "gap-"._o("related_gap","small"), "responsive-cols-"._o("related_responsive_columns",4));
		$gridargs=array(
				"classes"=>array("thumb-top","text-center"),
				"thumbcols"=>12,
				"thumbsize"=>_o("related_thumbsize","medium"),
				"thumbborder"=>0,
				"responsive"=>true,
				"hovereffect"=>array(
					"effect" =>"zoom",
					"bgcolor" =>"primary",
					"fgcolor" =>false,
					"view_more" =>$viewicon,
					"view_more_icon" =>false,
					"show_text" => $showtext,
					"view_more_pos_h" =>"center",
					"view_more_pos_v" =>"middle",
					"title_pos_h" =>"center",
					"title_pos_v" =>"middle",
				),
				"show_options"=>array(
					"thumbnail" =>true,
					"title" =>_o("related_show_title"),
					"date" =>false,
					"categories" =>false,
					"tags" =>false,
					"author" =>false,
					"excerpt" =>_o("related_show_excerpt"),
					"content" =>false,
					"commentscount" =>false,
				),
				"thumbnail_position"=>"top",
				"thumbnail_image_type"=> "featured"
			);	
		if($my_query->have_posts() ){

	?>
		
			<div class="row">
				<div class="col-xs-12">
					<h2 class="related-title"><?=__("Related posts", THEME_NAME)?></h2>
				</div>
			</div>
			<div class="row">
				<div class="grid-container">
					<div class="<?=implode(" ",$gridclasses)?>" 
						data-numposts='<?=$my_query->found_posts?>'
						>
						<div class="grid-sizer"></div>
						<div class="gutter-sizer"></div>	
	
			
						<?php		
									while( $my_query->have_posts() ) {
						
										$my_query->the_post();
						?>
											<div class="tile">
												<div class="the-gap">
													<?php carrot_get_template_part("post",'',false,$gridargs);?>
												</div>
											</div>
						<?php
									}
						?>	
				</div>
			</div><!--.grid-container-->
		</div><!--.row-->
	<?php
		}

		
		$post = $orig_post;
		wp_reset_query();

	}
endif;





if ( ! function_exists( 'ads_enabled' ) ) :
	function ads_enabled(){
		return gf('enable_ads','options');
	}
endif;





if ( ! function_exists( 'projects_enabled' ) ) :
	function projects_enabled(){
		return gf('enable_projects','options');
	}
endif;





if ( ! function_exists( 'specials_enabled' ) ) :
	function specials_enabled(){
		return gf('enable_specials','options');
	}
endif;






if ( ! function_exists( 'acf_enabled' ) ) :
	function acf_enabled(){
		return gf('enable_acf','options');
	}
endif;



if ( ! function_exists( 'carrot_get_banners' ) ) :
	function carrot_get_banners($bannertype=false, $orderby='random', $count=1) {
		global $post, $posts;
		$order=$orderby;
		

		if($orderby=="random" || $orderby=="related") $order="rand";
		if($orderby=="last" ) $order="post_date";
	

		$args = array( 
			'post_type' => 'banners',
			'orderby'   => $order,
			'order' => 'DESC',
			'post_status' => 'publish',
			'posts_per_page' => $count,
			'ignore_sticky_posts' => true  
		);


		$tax=array();


		if($orderby=="related"){
			$posttags=get_the_tags();
			//_dump($posttags);
			$ptags=array();
			if($posttags) 
			foreach($posttags as $t){
				$ptags[]=$t->slug;
			}
			$tax[]=array( 
				'taxonomy' => 'post_tag',
				'field' => 'slug',
				'terms'    => $ptags,
				'operator' => 'IN',
			);
		}
		
		if($bannertype){
			if(count($tax)>0) $tax['relation'] = 'AND';
		
			$tax[]=array( 
				'taxonomy' => 'banner-type',
				'field' => 'slug',
				'terms' => $bannertype
			);
		}
		
		
		if(count($tax)>0) $args['tax_query']=$tax;
		
		//_dump($args);
		//_dump($args);
		$myposts = new WP_Query( $args );
		//_dump($myposts);
		//si no hay resultados devuelve un banner random
		if(!$myposts->have_posts()){
			$args["orderby"]="rand";
			unset($args['tax_query']);
			
			$tax=array();
			$tax[]=array( 
				'taxonomy' => 'banner-type',
				'field' => 'slug',
				'terms' => $bannertype
			);
			$args['tax_query']=$tax;
			//_dump($args);
		
			$myposts = new WP_Query( $args );
		}
		//$myposts = get_posts( $args );
		return $myposts;
	}
endif;

if ( ! function_exists( 'carrot_has_banners' ) ) :
	function carrot_has_banners($bannerpos="") {
		return count(carrot_get_banners($bannerpos))>0;
	}
endif;



if ( ! function_exists( 'carrot_sharing_buttons' ) ) :
	function carrot_sharing_buttons() {
		if(carrot_is_sharing_active() && !gf("sharing_disabled")) echo do_shortcode('[addtoany]'); 
	}
endif;


if ( ! function_exists( 'carrot_include_block' ) ) :
	function carrot_include_block($id){
		
		$args = array(
			'posts_per_page'   => 1,
			'post__in'          => array($id),
			'post_type'        => 'block',
			'post_status'      => 'publish'
		); 
		
		$the_query = new WP_Query( $args );
		
		if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post();
				$content = get_the_content();
//				if(!is_preview() )
				$content=apply_filters('the_content',$content);
				echo $content;
			endwhile;
		endif;

		wp_reset_postdata();	
	}
	
endif;


if ( ! function_exists( 'carrot_get_article_icon' ) ) :
	function carrot_get_article_icon($default=false){
		$icons=array(
			"video" => "icon_video_play",
			"gallery" => "icon_gallery",
			"audio" => "icon_music"
		);
		
		
		$article_format=get_post_format();
		if($article_format && array_key_exists($article_format,$icons)){
			$ret=_icon($icons[$article_format]);
		
		}else{
			
			if($default && function_exists("siteorigin_widget_get_icon")){
				$ret=siteorigin_widget_get_icon($default);
			}else{
				$ret=_icon("icon_plus");
			}
		
		}
		

		return $ret;
		
		
		
	}
endif;



/*cookie functions */
if ( ! function_exists( 'carrot_set_post_cookie' ) ) :

	function carrot_set_post_cookie($name, $content=false,$expiration=false){
	
		$url = explode('?', 'http://'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
		$postid = url_to_postid($url[0]);			
		if($postid){
			$usr_ip = $_SERVER['REMOTE_ADDR'];
			$ctime = time();
			
			if(!$expiration) $expire=time()+60*60*24;//day cookie
			else $expire=$expiration;

			if($content){
				$cdata=$content;
			}else{
				$c_data = array(
					'post_id'=>$postid,
					'ip'=>$usr_ip,
					'time'=>$ctime
				);
				
				$cdata = json_encode($c_data,true);
			}

			$cookie_name=$name.'['.$postid.']';
			
			if (!isset($_COOKIE[$cookie_name])) {
				setcookie( $cookie_name, $cdata, $expire, '/' ); 
			}
		}	
	}
endif;

if ( ! function_exists( 'carrot_add_post_cookie_value' ) ) :
	function carrot_add_post_cookie_value($name,$value,$expiration=false){
		$url = explode('?', 'http://'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
		$postid = url_to_postid($url[0]);			
		if($postid){

			if(!$expiration) $expire=time()+60*60*24;//day cookie
			else $expire=$expiration;

			if (!isset($_COOKIE[$name])) {
				$cdata=json_encode(array($postid),true);
				setcookie( $name, $cdata, $expire, '/' ); 
			}else{
				$cookie=$_COOKIE[$name];
				$ids=json_decode($cookie);
				if(!in_array($value,$ids)){
					$ids[]=$value;
				}
				setcookie( $name, json_encode($ids,true), $expire, '/' );
				//die();

			}
		}

	}
endif;


if ( ! function_exists( 'carrot_has_post_cookie' ) ) :
	function carrot_has_post_cookie($name,$postID){
		if(isset($_COOKIE[$name]) && is_array($_COOKIE[$name])){
			return (array_key_exists($postID,$_COOKIE[$name]));
		}
		return false;
	}
endif;




if ( ! function_exists( 'carrot_inc_post_meta_num' ) ) :
	function carrot_inc_post_meta_num($postID,$key){
	    $count = get_post_meta($postID, $key, true);
		if($count==''){
	        $count = 1;
	        delete_post_meta($postID, $key);
	        add_post_meta($postID, $key, '1');
	    }else{
	        $count++;
	        update_post_meta($postID, $key, $count);
	    }
	}
endif;



if ( ! function_exists( 'carrot_get_post_meta_num' ) ) :
	function carrot_get_post_meta_num($postID,$key){
	    $count = get_post_meta($postID, $key, true);
	    if($count==''){
	        delete_post_meta($postID, $key);
	        add_post_meta($postID, $key, '0');
	        return "0";
	    }
	    return $count;
	}
endif;




if ( ! function_exists( 'carrot_show_back_to_top' ) ) :
	function carrot_show_back_to_top(){
	    if(_o("show_back_to_top")){
?>
	<div id="footer_sticky">
		<div class="container">
			<a id="to_top_link" href="#wrapper"><?=_icon("icon_arrow_up","text-lg")?></a>
		</div>
	</div>
<?php	    	
	    }
	}
endif;




if ( ! function_exists( 'carrot_found_posts' ) ) :
	function carrot_found_posts(){
		global $wp_query;
		echo  $wp_query->found_posts;
	}
endif;




if ( ! function_exists( 'carrot_site_preloader' ) ) :
	function carrot_site_preloader(){
		if(_o("show_preloader")){
			carrot_get_template_part( 'preloader');	
		}
	}
endif;


if ( ! function_exists( 'carrot_get_phone_nav' ) ) :
	function carrot_get_phone_nav(){
		$align=_o("drawer_position")=="left"?"right":"left";
		
		wp_nav_menu( 
			array( 
				'theme_location' => 'phone-menu' ,
				'menu_class' => 'menu menu-vertical align-'.$align
			)
		); 
	}
endif;





if ( ! function_exists( 'carrot_do_shortcode' ) ) :
	function carrot_do_shortcode( $tag, array $atts = array(), $content = null ) {
		global $shortcode_tags;

		if ( ! isset( $shortcode_tags[ $tag ] ) ) {
			return false;
		}

		return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
	}
endif;



if(!function_exists('carrot_button')):
	function carrot_button($args=false){
		
		$btnargs=array(
			"url" => "#",
			"text" => "button",
			"align" => "left",
			"size" => "md",
			"style" => "wire",
			"color" => "primary",
			"display" => "inline-block",
			"icon" => false,
			"image" => false,
			"position" => "left",

		);
		
		$btnargs=array_replace($btnargs,$args);
		
		
		$classes=array("","carrot-btn");
		$classes[] = "size-".$btnargs["size"];
		$classes[] = "style-".$btnargs["style"];
		$classes[] = "color-".$btnargs["color"];
		$classes[] = "display-".$btnargs["display"];

		$image="";
		if($btnargs["image"]){
			$image = "<img class='btn-image' src='".carrot_get_attachment_url($btnargs["image"],"thumbnail")."'/>";
		}else{
			if($btnargs["icon"]) $image = siteorigin_widget_get_icon( $btnargs["icon"]);
		}
		
?>
<div class="carrot-button-container text-<?=$btnargs["align"]?> "> 
	<a class="<?=implode(" ",$classes)?>" href="<?=$btnargs["url"]?>">
		<?php if($btnargs["position"]=="left"){ echo $image; } ?>
		<?php if($btnargs["position"]=="top"){ echo "<div>".$image."</div>"; } ?>
		<?=$btnargs["text"]?>
		<?php if($btnargs["position"]=="right"){ echo $image; } ?>
		<?php if($btnargs["position"]=="bottom"){ echo "<div>".$image."</div>"; } ?>
		
	</a>
</div>

<?php		
	}
endif;







if ( ! function_exists( 'carrot_get_book' ) ) :
	function carrot_get_book($id) {
		$args = array( 
			'post_type' => 'product',
			'p'   => $id
		);
		$myposts = new WP_Query( $args );

		return $myposts;
	}
endif;



if ( ! function_exists( 'carrot_get_books' ) ) :
	function carrot_get_books($orderby='random', $count=1) {
		global $post, $posts;
		$order=$orderby;
		

		if($orderby=="random") $order="rand";
		if($orderby=="last" ) $order="post_date";
	

		$args = array( 
			'post_type' => 'product',
			'orderby'   => $order,
			'order' => 'DESC',
			'post_status' => 'publish',
			'posts_per_page' => $count,
			'ignore_sticky_posts' => true  
		);



		$myposts = new WP_Query( $args );

		//si no hay resultados devuelve un banner random
		if(!$myposts->have_posts()){
			$args["orderby"]="rand";
			$myposts = new WP_Query( $args );
		}
		//$myposts = get_posts( $args );
		return $myposts;
	}
endif;




if(!function_exists('carrot_show_header_cart')):
	function carrot_show_header_cart(){
		if(function_exists('carrot_get_header_cart')) echo carrot_get_header_cart();
	}
endif;


if(!function_exists('carrot_get_woo_account_url')):
	function carrot_get_woo_account_url(){
		if(carrot_is_woocommerce_activated()){
			return get_permalink( get_option('woocommerce_myaccount_page_id') );
		}else{
			return wp_registration_url();
		}
	}
endif;


/*
if(!function_exists('carrot_image_gallery')):
	function carrot_image_gallery($options=array()){
		carrot_get_template_part( 'gallery', 'image', false, array( "options" => $options) );
	}
endif;


if(!function_exists('carrot_video_gallery')):
	function carrot_video_gallery($videos){
		carrot_get_template_part( 'gallery', 'video', false , array( "videos" => $videos));
	}
endif;
*/

if(!function_exists('carrot_media_gallery')):
	function carrot_media_gallery($options){
		carrot_get_template_part( 'gallery', '', false, array( "options" => $options) );

		//carrot_image_gallery( $options);
	}
endif;

if(!function_exists('carrot_post_media_gallery')):
	function carrot_post_media_gallery($galleryname="gallery"){
		$options=array();
		$options["thumbsize"]="large";
		if(gf($galleryname."_thumbsize")) $options["thumbsize"]=gf($galleryname."_thumbsize");

		$options["color"]=get_post_bgcolor();
		$options["view"]=gf($galleryname."_disposition");							
		$options["cols"]=gf($galleryname."_columns");
		$options["gutter"]=gf($galleryname."_gutter");
		$options["lightbox"]=gf($galleryname."_lightbox");
		$options["bordered"]=gf($galleryname."_bordered");
		
		$options["images"]=gf($galleryname."_images");
		foreach($options["images"] as $i=>$image) $options["images"][$i]["media_type"]="image";

		//TODO {
		$options["shownav"]=gf($galleryname."_show_navigation");
		$options["showpagination"]=gf($galleryname."_show_pager");
		$options["autoplay"]=gf($galleryname."_autoplay");
		$options["loop"]=gf($galleryname."_loop");
		$options["pause_on_hover"]=gf($galleryname."_pause_on_hover");
		
		
		$options["timeout"]=gf($galleryname."_slide_timeout");
		$options["speed"]=gf($galleryname."_slide_speed");

		$options["items"]=gf($galleryname."_articles_to_show");
		$options["itemsresponsive"]=gf($galleryname."_articles_to_show_responsive");
		$options["page_slide"]=gf($galleryname."_page_slide");

		$options["drag"]=gf($galleryname."_drag");
		$options["slide_effect"]=gf($galleryname."_slide_effect");
		$options["valign"]=gf($galleryname."_valign");

		$videos=gf("videos");
		
		
		foreach($videos as $i=>$video){
			$videos[$i]["media_type"]="video";
			
		}


		if(gf("show_videos")){
			if(!$options["images"]) $options["images"]=array();
			if(gf("videos_first")) $options["images"]=array_merge($videos,$options["images"]);
			else $options["images"]=array_merge($options["images"],$videos);
		}
		 
		
		carrot_media_gallery($options);

		/*if(gf("videos_first")){
			if(gf("show_videos")) carrot_video_gallery($videos);
			if(gf("show_gallery")) carrot_image_gallery( $options);
		}else{
			if(gf("show_gallery")) carrot_image_gallery( $options);
			if(gf("show_videos")) carrot_video_gallery($videos);
		}*/
	}
endif;




if(!function_exists('carrot_has_post_featured')):
	function carrot_has_post_featured(){
		return (has_post_thumbnail() && (( gf("show_featured_image")=="show") || !has_field("carrot_has_post_featured") || (gf("show_featured_image")=="theme" && _o("single_post_show_featured"))));
	}
endif;

if(!function_exists('carrot_show_post_featured')):
	function carrot_show_post_featured($size="large"){
		if(carrot_has_post_featured()){
			carrot_post_thumbnail($size,false,true,"image",false);
		}
	}
endif;
