<?php
	
	$defaults=array(
		'body_bg_color' => '#ffffff',
		'text_font'=>array(
			'font-family'    => 'Lato',
			'variant'        => 'regular',
			'font-size'      => '16px',
			'subsets'        => array( 'latin-ext' )
		),
		'headings_font' => array(
			'font-family'    => 'Lato',
			'variant'        => '700',
			'subsets'        => array( 'latin-ext' )

		),
		'header_type' => 'header_center',
		'header_background_color' => 'primary-inverse',
		'footer_background_color' => 'alt-inverse',
		'single_post_show_breadcrumb' => false,
		'single_post_show_title' => false,
		'single_projects_show_breadcrumb' => false,
		'single_projects_show_title' => false,
		'show_pages_title' => false,
		'show_breadcrumb' => false,
		'show_preloader' => true
		
		
	);
	$styles=array('style.css','woocommerce.css');
	$scripts=array('scripts.js','init.js');



	
	$customizerelements= array(
		'primary_color' => array(
			array(
				'element' => ' .woocommerce-terms-and-conditions-wrapper a, 
								.project-meta h3,
								article.article-single  .taxonomies
								',
				'property' => 'color',
				
			),
			array(
				'element' => '  .a2a_kit a:hover .a2a_svg svg *
								',
				'property' => 'fill'
				
			),
			array(
				'element' => ' .button:hover, .button:active, .button:focus					',
				'property' => 'background-color'
				
			),
			array(
				'element' => ' .button:hover, .button:active, .button:focus ',
				'property' => 'border-color'
				
			)

		),
		'primary_text_color' => array(
			array(
				'element' => '.button:hover, .button:active, .button:focus, .woocommerce-message a',
				'property' => 'color',
				
			),
		),	
		'alt_color' => array(
			array(
				'element' => '.button, .woocommerce-active #footer-cart .cart-contents .count ',
				'property' => 'background-color',
			),
			array(
				'element' => '.button',
				'property' => 'border-color',
			)
		),
		
		'alt_text_color' => array(
			array(
				'element' => '.button, .woocommerce-active #footer-cart .cart-contents .count ',
				'property' => 'color',
			)
		),
		'body_text_color' => array(
			array(
				'element'  => '.a2a_kit .a2a_svg svg *',
				'property' => 'fill',
				'important'   => true

			),
			array(
				'element'  => '#footer-cart .cart-contents, .woocommerce-active #footer-cart .cart-contents .cart-icon

					',
				'property' => 'color',
				

			)
		),
		
		'body_bg_color' => array(
			array(
				'element'  => '.woocommerce-checkout .woocommerce-checkout-review-order .review-content.affix, .single-nav.single-projects-nav li a:hover, .image-gallery.gallery-slider.gallery-fixedheight .imgwrap, 
				#footer-cart .cart-contents',

				'property' => 'background-color'
			)
		),

		'borders_color' => array(
			array(
				'element' => '.wc_payment_methods li',
				'property' =>'border-color'
			)
		)
	);


