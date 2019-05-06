<?php

/*add featured image to posts*/

// ADD NEW COLUMN
function carrot_columns_head($defaults) {
    $defaults['featured_image'] = __('Featured Image');
  
   return $defaults;
}
 
// SHOW THE FEATURED IMAGE
function carrot_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
        $img=get_post_thumbnail_by_id($post_ID,"mini-icon",true,false,false);
		
        if ($img) {
            echo $img;
        }
    }
}

add_filter('manage_post_posts_columns', 'carrot_columns_head');
add_action('manage_post_posts_custom_column', 'carrot_columns_content', 10, 2);