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
	$styles=array('style.css');
	$scripts=array('scripts.js','init.js');



	
	$customizerelements= array(
		'primary_color' => array(
			array(
				'element' => '
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
				'element'  => '.single-nav.single-projects-nav li a:hover, .image-gallery.gallery-slider.gallery-fixedheight .imgwrap',
				'property' => 'background-color'
			)
		),
	);


