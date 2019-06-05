<?php
/*
Widget Name: Book
Description: Displays some book information. Woocommerce must be enabled.
Author: Txo
*/

				
if(!function_exists('carrot_find_books'))
{
	function carrot_find_books($names_only = false)
	{
		$blocks=array();
		
		$args = array(
			'posts_per_page'   => -1,
			'post_type'        => 'product',
			'post_status'      => 'publish'
		); 
		
		$posts = get_posts( $args );
		
		if($posts){
			foreach($posts as $h){
				$blocks[$h->ID]=$h->post_title;
			}
		}
		return $blocks;
	}
}

class Carrot_Book_Widget extends Carrot_SiteOrigin_Widget {
	
	function custom_variables( $instance ){ }
	
	
		
	function __construct() {
		parent::__construct(
			'carrot-book', 
			'Carrot Book', 
			'Displays a book.' ,

			array(
				'bookmode'=> array(	
					'type' => 'select',
					'label' => __( 'Book to display', THEME_NAME),
					'default' => '',
					'options' => array(
						'random' => __("Random book",THEME_NAME),
						'last' => __("Last book published",THEME_NAME),
						'selected' => __("Selected book",THEME_NAME)
					),
					'state_emitter' => array(
						'callback' => 'select',
						'args' => array( 'bookmode' )
					),
				),
				'bookid'=> array(	
					'type' => 'select',
					'label' => __( 'Select a book', THEME_NAME),
					'default' => '',
					'options' => carrot_find_books(true),
					'state_handler' => array(
						'bookmode[random]' => array('hide'),
						'bookmode[last]' => array('hide'),
						'_else[bookmode]' => array( 'show' )
					),
					
				),
				'bookdisplay'=> array(	
					'type' => 'select',
					'label' => __( 'Info to display of the book', THEME_NAME),
					'default' => '',
					'options' => array(
						'cover' => __("Book cover",THEME_NAME),
						'author' => __("Book author",THEME_NAME),
						'passages' => __("Book passages",THEME_NAME),
						'reviews' => __("Book reviews",THEME_NAME)
					),
					'state_emitter' => array(
						'callback' => 'select',
						'args' => array( 'bookdisplay' )
					),
				),
				'items_number' => array(
					'type' => 'number',
					'label' => __( 'Enter a number (leave blank for unlimited)', THEME_NAME ),
					'default' => '1',
					'state_handler' => array(
						'bookdisplay[cover]' => array('hide'),
						'bookdisplay[author]' => array('hide'),
						'_else[bookdisplay]' => array( 'show' )
					),
				)


				
				
			)
		);
	}
	
	function initialize() {
        
		
    
        $this->register_frontend_styles(array(
            array( 'carrot-book',CARROT_SO_WIDGETS_URI . '/widgets/carrot-book/styles/carrot-book.css')
        ));
    }
}

siteorigin_widget_register('carrot-book-widget', __FILE__, 'Carrot_Book_Widget');