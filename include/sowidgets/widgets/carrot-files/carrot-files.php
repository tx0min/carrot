<?php
/*
Widget Name: Files
Description: Displays a collection of files.
Author: Txo
*/

function carrot_file_icon($vars,$file){
	if($file["file_image"]){
		echo "<span class='file-image-icon'><img src='".carrot_get_attachment_url($file["file_image"],"thumbnail")."'/></span>";
	}else if($file["file_icon"]){
		echo siteorigin_widget_get_icon($file["file_icon"]);
	}else if($vars["default_file_image"]){
		echo "<span class='file-image-icon'><img src='".carrot_get_attachment_url($vars["default_file_image"],"thumbnail")."'/></span>";
	}else if($vars["default_file_icon"]){
		echo siteorigin_widget_get_icon($vars["default_file_icon"]);
	
	}
	
}	
function carrot_get_file_url($file){
	//_dump($file);
	
	$url=wp_get_attachment_url($file["file_media"]);
	if($file["file_media"]){
		return wp_get_attachment_url($file["file_media"]);
	}else {
		return $file["file_media_fallback"];
	}
	
}				

function carrot_file_size($file){
	//_dump($file);
	
	if($file["file_media"]){
		$attachment_meta = wp_prepare_attachment_for_js($file["file_media"]);
		echo $attachment_meta['filesizeHumanReadable'];
	}
	
}				

class Carrot_Files_Widget extends Carrot_SiteOrigin_Widget {
	
	function custom_variables( $instance ){ }
	
	
		
	function __construct() {
		parent::__construct(
			'carrot-files', 
			'Carrot Files', 
			'Displays a collection of files.' ,

			array(
				
				'files' => array(
					'type' => 'repeater',
					'label' => __( 'Files' , THEME_NAME ),
					'item_name'  => __( 'File', THEME_NAME ),
					'item_label' => array(
						'selector'     => "[id*='file_name']",
						'update_event' => 'change',
						'value_method' => 'val'
					),
					'fields' => array(
						'file_name' => array(
							'type' => 'text',
							'label' => __( 'File name', THEME_NAME )
						),
						'file_description' => array(
							'type' => 'textarea',
							'label' => __( 'File description', THEME_NAME ),
							'rows' => 3
						),
						'file_media' => array(
							'type' => 'media',
							'label' => __( 'File', THEME_NAME ),
							'choose' => __( 'Choose file', THEME_NAME ),
							'update' => __( 'Set file', THEME_NAME ),
							'library' => 'all',
							'fallback' => true
						),
						'file_icon' => array(
							'type' => 'icon',
							'label' => __('Custom icon', THEME_NAME),
						),
						'file_image' => array(
							'type' => 'media',
							'label' => __( 'Thumbnail', THEME_NAME ),
							'choose' => __( 'Custom icon image', THEME_NAME ),
							'update' => __( 'Set image', THEME_NAME ),
							'library' => 'image',
							'description' => __('If set, it will be displayed over the icon.', THEME_NAME),
							'fallback' => true
						),
						'file_alt_url' => array(
							'type' => 'link',
							'label' => __( 'File referer URL', THEME_NAME )
						),
						
					)
				),
				'heading_text' => array(
					'type' => 'tinymce',
					'label' => __( 'Files description', THEME_NAME ),
					'default' => '',
					'rows' => 5,
					'default_editor' => 'html',
				),
				'show_filesize' => array(
					'type' => 'checkbox',
					'label' => __( 'Show filesize', THEME_NAME ),
					'default' => true
				),
				'default_file_icon' => array(
					'type' => 'icon',
					'label' => __('Default icon', THEME_NAME),
					'default' => 'themify-ti-download',
					
				),
				'default_file_image' => array(
					'type' => 'media',
					'label' => __( 'Thumbnail', THEME_NAME ),
					'choose' => __( 'Default image icon', THEME_NAME ),
					'update' => __( 'Set image', THEME_NAME ),
					'library' => 'image',
					'description' => __('If set, it will be displayed over the icon.', THEME_NAME),
					'fallback' => true
				)


				
				
			)
		);
	}
	
	function initialize() {

  		
        $this->register_frontend_styles(array(
            array(
                'carrot-files',
                CARROT_SO_WIDGETS_URI . '/widgets/carrot-files/styles/carrot-files.css'
            )
        ));
    }
}

siteorigin_widget_register('carrot-files-widget', __FILE__, 'Carrot_Files_Widget');