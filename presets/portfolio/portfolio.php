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
								.woocommerce-message a, .woocommerce-info a, .woocommerce-error a,
								.woocommerce-message a:hover, .woocommerce-info a:hover, .woocommerce-error a:hover,
								.woocommerce-message a:focus, .woocommerce-info a:focus, .woocommerce-error a:focus,
								.woocommerce-message .button, .woocommerce-info .button, .woocommerce-error .button,
								.woocommerce-message .button:hover, .woocommerce-info .button:hover, .woocommerce-error .button:hover,
								.woocommerce-message .button:focus, .woocommerce-info .button:focus, .woocommerce-error .button:focus,
								.project-meta h3,
								article.article-single  .taxonomies
								',
				'property' => 'color',
				
			),
			array(
				'element' => '  .a2a_kit a:hover .a2a_svg svg *
								',
				'property' => 'fill'
				
			)
		),
		'body_text_color' => array(
			array(
				'element'  => '.a2a_kit .a2a_svg svg *',
				'property' => 'fill',
				'important'   => true

			)
		),
		
		'body_bg_color' => array(
			array(
				'element'  => '.woocommerce-checkout .woocommerce-checkout-review-order .review-content.affix, .single-nav.single-projects-nav li a:hover, .image-gallery.gallery-slider.gallery-fixedheight .imgwrap',
				'property' => 'background-color'
			)
		),
	);


