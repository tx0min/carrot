<?php
/*
Widget Name: Flip Card
Description: Displays a card with info on both sides that flips on hover.
Author: Txo
*/


	
class Carrot_Flip_Card_Widget extends Carrot_SiteOrigin_Widget {
	

	function __construct() {
		parent::__construct(
			'carrot-flip-card', 
			'Carrot Flip Card', 
			'Displays a card with info on both sides that flips on hover' ,

			array(
				'front_section' => array(
					'type' => 'section',
					'label' => __( 'Front Side' , THEME_NAME ),
					'hide' => true,
					'fields' => array(
						'front_content' => array(
							'type' => 'tinymce',
							'label' => __('Content', THEME_NAME),
						),
						'front_bgcolor'=> array(
							'type' => 'themecolor',
							'label' => __( 'Background Color', THEME_NAME),
							'default' => false,
							'css' => true,
						),
						'front_bgimage'=> array(
							'type' => 'media',
							'label' => __('Background Image', THEME_NAME),
							'choose' => __( 'Choose image', THEME_NAME ),
							'update' => __( 'Set image', THEME_NAME ),
							'library' => 'image',
							'css' => true
						),
						'front_bgopacity' => array(
							'type' => 'slider',
							'label' => __( 'Background image opacity', THEME_NAME ),
							'default' => 100,
							'min' => 0,
							'max' => 100,
							'integer' => true,
							'css' => true,
							'units' => '%'
						),
						'front_bgsize'=> array(	
							'type' => 'select',
							'label' => __( 'Background size', THEME_NAME),
							'default' => 'cover',
							'css' => true,
							'options' => array(
								'auto' => __( 'Default size', THEME_NAME ),
								'cover' => __( 'Cover', THEME_NAME ),
								'contain' => __( 'Contain', THEME_NAME ),
								'100% 100%' => __( 'Stretch', THEME_NAME )
							)
						),
						'front_bghposition'=> array(	
							'type' => 'select',
							'label' => __( 'Background horizontal position', THEME_NAME),
							'default' => 'center',
							'css' => true,
							'options' => array(
								'left' => __( 'Left', THEME_NAME ),
								'center' => __( 'Center', THEME_NAME ),
								'right' => __( 'Right', THEME_NAME )
							)
						),
						'front_bgvposition'=> array(	
							'type' => 'select',
							'label' => __( 'Background vertical position', THEME_NAME),
							'default' => 'center',
							'css' => true,
							'options' => array(
								'top' => __( 'Top', THEME_NAME ),
								'center' => __( 'Center', THEME_NAME ),
								'bottom' => __( 'Bottom', THEME_NAME )
							)
						),
						'front_bgrepeat'=> array(	
							'type' => 'select',
							'label' => __( 'Background repeat', THEME_NAME),
							'default' => 'no-repeat',
							'css' => true,
							'options' => array(
								'no-repeat' => __( 'No repeat', THEME_NAME ),
								'repeat' => __( 'Repeat Both', THEME_NAME ),
								'repeat-x' => __( 'Repeat X', THEME_NAME ),
								'repeat-y' => __( 'Repeat V', THEME_NAME )
							)
						),
						'front_padding'=> array(
							'type' => 'dimensions',
							'label' => __( 'Padding', THEME_NAME),
							'default' => false,
							'css' => true,
						)
					)
				),
				'back_section' => array(
					'type' => 'section',
					'label' => __( 'Back Side' , THEME_NAME ),
					'hide' => true,
					'fields' => array(
						'back_content' => array(
							'type' => 'tinymce',
							'label' => __('Content', THEME_NAME),
						),
						'back_bgcolor'=> array(
							'type' => 'themecolor',
							'label' => __( 'Background color', THEME_NAME),
							'default' => false,
							'css' => true,
						),
						'back_bgimage'=> array(
							'type' => 'media',
							'label' => __('Background Image', THEME_NAME),
							'choose' => __( 'Choose image', THEME_NAME ),
							'update' => __( 'Set image', THEME_NAME ),
							'library' => 'image',
							'css' => true
						),
						'back_bgopacity' => array(
							'type' => 'slider',
							'label' => __( 'Background image opacity', THEME_NAME ),
							'default' => 100,
							'min' => 0,
							'max' => 100,
							'integer' => true,
							'css' => true,
							'units' => '%'
						),
						'back_bgsize'=> array(	
							'type' => 'select',
							'label' => __( 'Background size', THEME_NAME),
							'default' => 'cover',
							'css' => true,
							'options' => array(
								'auto' => __( 'Default size', THEME_NAME ),
								'cover' => __( 'Cover', THEME_NAME ),
								'contain' => __( 'Contain', THEME_NAME ),
								'100% 100%' => __( 'Stretch', THEME_NAME )
							)
						),
						'back_bghposition'=> array(	
							'type' => 'select',
							'label' => __( 'Background horizontal position', THEME_NAME),
							'default' => 'center',
							'css' => true,
							'options' => array(
								'left' => __( 'Left', THEME_NAME ),
								'center' => __( 'Center', THEME_NAME ),
								'right' => __( 'Right', THEME_NAME )
							)
						),
						'back_bgvposition'=> array(	
							'type' => 'select',
							'label' => __( 'Background vertical position', THEME_NAME),
							'default' => 'center',
							'css' => true,
							'options' => array(
								'top' => __( 'Top', THEME_NAME ),
								'center' => __( 'Center', THEME_NAME ),
								'bottom' => __( 'Bottom', THEME_NAME )
							)
						),
						'back_bgrepeat'=> array(	
							'type' => 'select',
							'label' => __( 'Background repeat', THEME_NAME),
							'default' => 'no-repeat',
							'css' => true,
							'options' => array(
								'no-repeat' => __( 'No repeat', THEME_NAME ),
								'repeat' => __( 'Repeat Both', THEME_NAME ),
								'repeat-x' => __( 'Repeat X', THEME_NAME ),
								'repeat-y' => __( 'Repeat V', THEME_NAME )
							)
						),
						'back_padding'=> array(
							'type' => 'dimensions',
							'label' => __( 'Padding', THEME_NAME),
							'default' => false,
							'css' => true,
						)
						
					)
				),
				
				'flip_effect'=> array(	
					'type' => 'select',
					'label' => __( 'Flip Effect', THEME_NAME),
					'default' => 'flip-h',
					'options' => array(
						'flip-h' => __( 'Flip horizontal', THEME_NAME ),
						'flip-v' => __( 'Flip vertical', THEME_NAME ),
						'slide-h' => __( 'Slide horizontal', THEME_NAME ),
						'slide-v' => __( 'Slide vertical', THEME_NAME ),
						'crossfade' => __( 'Cross-fade', THEME_NAME ),
					)
				),
				'enable_swipe' => array(
					'type' => 'checkbox',
					'label' => __( 'Enable horiozontal swipe on touch devices?', THEME_NAME ),
					'default' => 1
				),
			)
		);
	}
	
	function initialize() {

        $this->register_frontend_scripts(
            array(
                array(
                    'carrot-flip-card',
                    CARROT_SO_WIDGETS_URI . '/widgets/carrot-flip-card/js/carrot-flip-card.js',
                    array('jquery')
                    
                ),
            )
        );
		
        $this->register_frontend_styles(array(
            array(
                'carrot-flip-card',
                CARROT_SO_WIDGETS_URI . '/widgets/carrot-flip-card/styles/flip-card.css'
            )
        ));
    }
	
}

siteorigin_widget_register('carrot-flip-card-widget', __FILE__, 'Carrot_Flip_Card_Widget');