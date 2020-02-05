<?php

global $carrotthemeoptions;


$header_show_options =array(
	'logo' => esc_attr__( 'Logo', THEME_NAME ),
	'title' => esc_attr__( 'Site title', THEME_NAME ),
	'description' => esc_attr__( 'Site description', THEME_NAME ),
	'contact' => esc_attr__( 'Contact info', THEME_NAME ),
	'social' => esc_attr__( 'Social icons', THEME_NAME ),
	'menu' => esc_attr__( 'Menu', THEME_NAME ),
	'search' => esc_attr__( 'Search', THEME_NAME ),
);


if(carrot_is_woocommerce_activated()){
	$header_show_options['cart'] = esc_attr__( 'Shopping Cart', THEME_NAME );
}

$thumbsizes=carrot_get_thumbsizes_dropdown();

//define panels, sections and fields
$carrotthemeoptions=array(
	//headline CORE SECTION
	'title_tagline'=>array(
		'fields'=>array(
			'theme-main-logo'=>array(
				'type'        => 'image',
				'label'       => __( 'Logo', THEME_NAME ),
			)
		)
	),
	'panel_style'=>array(
		//STYLE PANEL
		'title' => __( 'Carrot Settings', THEME_NAME ),
		'description' => __( 'Customize site settings, colors, icons and text fonts.', THEME_NAME ),
		'children'=>array(
			
			'section_settings' =>array(
				'title' => __( 'Settings', THEME_NAME ),
				'fields' => array(
					
					'site_fullwidth' => array(
						'label'=> __( 'Full width', THEME_NAME ),
						'type' => 'toggle',
						'default'=>'0'
					),
					'site_width' => array(
						'label'=> __( 'Container max width', THEME_NAME ),
						'type'        => 'slider',
						'default'     => 1170,
						'choices'     => array(
							'min'  => '100',
							'max'  => '1920',
							'step' => '1',
						),
						'active_callback'    => array(
							array(
								'setting'  => 'site_fullwidth',
								'operator' => '==',
								'value'    => '0',
							)
						),
						'output' => array(
							array(
								'element'  => '.container, #header:not(.header-fullwidth) .container',
								'property' => 'width',
								'units' =>'px'
							)
						)
					),
					'show_pages_title' => array(
						'label'=> __( 'Show pages title', THEME_NAME ),
						'type' => 'toggle',
						'default'=>'1'
					),
					'show_breadcrumb' => array(
						'label'=> __( 'Show breadcrumb', THEME_NAME ),
						'type' => 'toggle',
						'default'=>'0'
					),
					'use_autosearch' => array(
						'label'=> __( 'Use AJAX search', THEME_NAME ),
						'type' => 'toggle',
						'default'=>'1'
					),
					
					
					
				)
			),
			'section_icons' =>array(
				'title' => __('Icons',THEME_NAME),
				'fields' => array(
					/*'to_top_icon' => array(
						'type'     => 'dashicons',
						'label'    => __( 'Dashicons Control', THEME_NAME ),
						'default'  => 'menu',
					),*/
									
					'icons_size' => array(
						'label'=> __( 'Icons size', THEME_NAME ),
						'type'        => 'slider',
						'default'     => 1,
						'choices'     => array(
							'min'  => '0.3',
							'max'  => '4',
							'step' => '0.1',
						),
						'output' => array(
							array(
								'element'  => '.carrot-icon > span',
								'property' => 'font-size',
								'units' =>'em'
							)
						)
					),
					
					
					/*'test_field' => array(
						'type'     => 'test-control',
						'label'    => __( 'Test', THEME_NAME ),
						'default' => ''
					),*/
					'icon_arrow_right' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Arrow right', THEME_NAME ),
						'default' => 'themify-ti-arrow-right'
					),
					'icon_arrow_left' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Arrow left', THEME_NAME ),
						'default' => 'themify-ti-arrow-left'
					),
					'icon_arrow_up' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Arrow up', THEME_NAME ),
						'default' => 'themify-ti-arrow-up'
					),
					'icon_arrow_down' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Arrow down', THEME_NAME ),
						'default' => 'themify-ti-arrow-down'
					),
					'icon_angle_left' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Angle left', THEME_NAME ),
						'default' => 'themify-ti-angle-left'
					),
					'icon_angle_right' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Angle right', THEME_NAME ),
						'default' => 'themify-ti-angle-right'
					),
					'icon_angle_up' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Angle up', THEME_NAME ),
						'default' => 'themify-ti-angle-up'
					),
					'icon_angle_down' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Angle down', THEME_NAME ),
						'default' => 'themify-ti-angle-down'
					),
					'icon_search' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Search', THEME_NAME ),
						'default' => 'themify-ti-search'
					),
					'icon_plus' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Plus', THEME_NAME ),
						'default' => 'themify-ti-plus'
					),
					'icon_minus' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Minus', THEME_NAME ),
						'default' => 'themify-ti-minus'
					),
					'icon_close' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Close', THEME_NAME ),
						'default' => 'themify-ti-close'
					),
					'icon_category' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Category', THEME_NAME ),
						'default' => 'themify-ti-bookmark'
					),
					'icon_tag' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Tag', THEME_NAME ),
						'default' => 'themify-ti-tag'
					),
					'icon_calendar' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Date', THEME_NAME ),
						'default' => 'themify-ti-calendar'
					),
					'icon_clock' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Time', THEME_NAME ),
						'default' => 'themify-ti-timer'
					),
					'icon_angle_left' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Angle left', THEME_NAME ),
						'default' => 'themify-ti-angle-left'
					),
					'icon_angle_right' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Angle right', THEME_NAME ),
						'default' => 'themify-ti-angle-right'
					),
					'icon_email' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Email', THEME_NAME ),
						'default' => 'themify-ti-email'
					),
					'icon_web' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Web', THEME_NAME ),
						'default' => 'themify-ti-world'
					),
					'icon_phone' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Phone', THEME_NAME ),
						'default' => 'themify-ti-mobile'
					),
					'icon_twitter' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Twitter', THEME_NAME ),
						'default' => 'themify-ti-twitter-alt'
					),
					'icon_facebook' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Facebook', THEME_NAME ),
						'default' => 'themify-ti-facebook'
					),
					'icon_instagram' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Instagram', THEME_NAME ),
						'default' => 'themify-ti-instagram'
					),
					'icon_linkedin' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Linkedin', THEME_NAME ),
						'default' => 'themify-ti-linkedin'
					),
					'icon_youtube' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Youtube', THEME_NAME ),
						'default' => 'themify-ti-youtube'
					),
					'icon_google' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Google+', THEME_NAME ),
						'default' => 'themify-ti-google'
					),
					'icon_flickr' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Flickr', THEME_NAME ),
						'default' => 'themify-ti-flickr'
					),
					'icon_pinterest' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Pinterest', THEME_NAME ),
						'default' => 'themify-ti-pinterest'
					),
					'icon_wikipedia' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Wikipedia', THEME_NAME ),
						'default' => 'fontawesome-wikipedia-w'
					),
					'icon_download' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Download', THEME_NAME ),
						'default' => 'themify-ti-download'
					),
					'icon_loading' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Loading', THEME_NAME ),
						'default' => 'themify-ti-reload'
					),
					'icon_zoom' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Zoom', THEME_NAME ),
						'default' => 'themify-ti-zoom-in'
					),
					'icon_hand_point' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Hand pointing', THEME_NAME ),
						'default' => 'themify-ti-hand-point-up'
					),
					'icon_comment' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Comment ', THEME_NAME ),
						'default' => 'themify-ti-comment'
					),
					'icon_comment_alt' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Comment (not empty)', THEME_NAME ),
						'default' => 'themify-ti-comment-alt'
					),
					'icon_pagination_item' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Pagination Item', THEME_NAME ),
						'default' => 'themify-ti-control-record'
					),
					'icon_cart_empty' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Shopping Cart (empty)', THEME_NAME ),
						'default' => 'themify-ti-shopping-cart'
					),
					'icon_cart_full' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Shopping Cart (full)', THEME_NAME ),
						'default' => 'themify-ti-shopping-cart-full'
					),
					'icon_double_quote_left' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Double quote left', THEME_NAME ),
						'default' => 'themify-ti-quote-left'
					),
					'icon_double_quote_right' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Double quote right', THEME_NAME ),
						'default' => 'themify-ti-quote-right'
					),
					'icon_award' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Award', THEME_NAME ),
						'default' => 'themify-ti-cup'
					),
					'icon_map_marker' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Map marker', THEME_NAME ),
						'default' => 'fontawesome-map-marker'
					),
					'icon_video_pause' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Video pause', THEME_NAME ),
						'default' => 'themify-ti-control-pause'
					),
					'icon_video_play' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Video play', THEME_NAME ),
						'default' => 'themify-ti-control-play'
					),
					'icon_music' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Music', THEME_NAME ),
						'default' => 'themify-ti-music'
					),
					'icon_gallery' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'Image Gallery', THEME_NAME ),
						'default' => 'themify-ti-gallery'
					),
					'icon_file' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'File', THEME_NAME ),
						'default' => 'fontawesome-file'
					),
					'icon_pdf_file' => array(
						'type'     => 'kirki-icons',
						'label'    => __( 'PDF File', THEME_NAME ),
						'default' => 'fontawesome-file-pdf-o'
					)
				)
			),
			'section_colors' =>array(
				'title' => __( 'Colors', THEME_NAME ),
				'fields' => array(
					'body_bg_color'=>array(
						'type'        => 'color',
						'label'       => __( 'Body BG Color', THEME_NAME ),
						'default'     => '#ffffff',
						'output' => array(
							array(
								'element'  => '
												.select2-container--default .select2-selection--multiple, 
												.select2-container--default .select2-selection--single, 
												.search-box  .searchform-popup , body, 
												.sow-text-field, .sow-form-field textarea,
												.sub-menu,
												#site-preloader,
												.widget_shopping_cart .widget_shopping_cart_content,
												.woocommerce-checkout .woocommerce-checkout-review-order,
												.fancybox-overlay,
												.searchform-popup .search-results ,
												.single-post article.article-single .post-contents
												',
								'property' => 'background-color'
							),
							array(
								'element'  => '.article-featured.bg-none .opener-icon .icon,  .article-featured.bg-none .hover-title, .demo_store',
								'property' => 'color'
							)
						)
					),
					'body_text_color'=>array(
						'type'        => 'color',
						'label'       => __( 'Body Text Color', THEME_NAME ),
						'default'     => '#333333',
						'output' => array(
							array(
								'element'  => '	
												body, a,
												.article-featured.bg-none:hover .opener-icon .icon,  
												.article-featured.bg-none:hover .hover-title, 
												.select2-container .select2-selection--multiple .select2-selection__rendered ,
												.select2-container .select2-selection--single .select2-selection__rendered ,
												.search-box  .searchform-popup ,  
												.sow-text-field, .sow-form-field textarea, 
												.entry-title a
												 ',
								'property' => 'color'
							),
							array(
								'element'  => ' body.theme-preset-magazine .menu > li.current-menu-item > a, 
												body.theme-preset-magazine .menu > ul > li.current_page_item > a,
												body.theme-preset-magazine .menu > li > a:hover, 
												body.theme-preset-magazine .menu > ul > li > a:hover
												
												
												',
								'property' => 'border-color'
							),
							array(
								'element'  => '.demo_store',
								'property' => 'background-color'
							)
						)
					),
					'body_strong_color'=>array(
						'type'        => 'color',
						'label'       => __( 'Body Strong Color', THEME_NAME ),
						'default'     => '#000000',
						'output' => array(
							array(
								'element'  => 'strong, b, h1,h3,h4,h5,a:hover, a:active, a:focus, .loading-icon',
								'property' => 'color'
							)
						)
					),
					'borders_color'=>array(
						'type'        => 'color',
						'label'       => __( 'Borders & Separators Color', THEME_NAME ),
						'default'     => '#cccccc',
						'alpha'		  => true,
						'output' => array(
							array(
								'element'  => '#footer, hr,.so-widget-ink-divider[class*="so-widget-ink-divider-divider-"] .iw-so-divider',
								'property' => 'border-top-color'
							),array(
								'element'  => '
												fieldset,mark,
												.sub-menu,
												#header, 
												.single.page article .entry-header, article .article-featured img, 
												article .article-featured, article .article-featured.bg-custom.fg-borders .opener-icon .icon, 
												.select2-container, .select2-container--default .select2-selection--multiple, .select2-container--default .select2-selection--single, 
												.paginator li a, .banner img, 
												.search-box .box-arrow, .search-box  .searchform-popup input, #recentcomments li, 
												.searchform-popup  .search-results li a, .searchform-popup  .search-results,
												.PSR_month_scores li,.PSR_moment_scores li,.comment-list li ul.children,
												.comment-list li,.comments,.single article .article-footer,  
												#sticky-header,  
												.sidebar .widget .widget-title, .so-panel.widget .widget-title, 
												.single article .article-author,.single article .entry-title,
												.page article .entry-title,.wp-caption-text, blockquote, .single article .entry-content ul, 
												.single article .entry-content ol, .entradeta, .article-inner,.border-borders,
												.borders-color, article,  article .entry-header, .sow-text-field, 
												.sidebar, .phone-menu .menu-drawer, .archive-header, textarea, 
												input[type="text"], input[type="email"], input[type="tel"], 
												input[type="password"], .tile article.clean, .blog.classic article,.archive.classic article,
												article.page-article .entry-header,
												.project-meta > li,
												.projects-related,
												button, 
												input[type=button],
												input[type=submit],
												input[type=reset],
												.button, 
												.b-a, .b-t ,.b-r,.b-b,.b-l,.b-x,.b-y,.b-a-md, .b-t-md ,.b-r-md,.b-b-md,.b-l-md,.b-x-md,.b-y-md,.b-a-lg, .b-t-lg ,.b-r-lg,.b-b-lg,.b-l-lg,.b-x-lg,.b-y-lg,
												.woocommerce-MyAccount-navigation, .woocommerce-MyAccount-navigation ul li a, .woocommerce-order, .shop_table,
												.woocommerce-checkout .woocommerce-checkout-review-order .review-content,
												.woocommerce-cart .cart-collaterals,
												.select2-dropdown,
												#phone-menu .menu-drawer,
												.related,
												.image-gallery.bordered .imgwrap,
												.single-nav,
												.border-borders
												',
								'property' => 'border-color'
							),array(
								'element'  => '.bg-borders',
								'property' => 'background-color'
							),array(
								'element'  => 'article',
								'property' => 'outline-color'
							),array(
								'element'  => 'article .article-featured.bg-custom.fg-borders .opener-icon .icon, article .article-featured.bg-custom.fg-borders .hover-title, .text-borders',
								'property' => 'color'
							),array(
								'element'  => '.border-top-borders',
								'property' => 'border-top-color'
							),array(
								'element'  => '.border-bottom-borders',
								'property' => 'border-bottom-color'
							),array(
								'element'  => '.border-right-borders',
								'property' => 'border-right-color'
							),array(
								'element'  => '.border-left-borders',
								'property' => 'border-left-color'
							)
						)
					),
					'primary_color'=>array(
						'type'        => 'color',
						'label'       => __( 'Primary Color', THEME_NAME ),
						'default'     => '#666666',
						'output' => array(
							array(
								'element'  => ' .bg-primary .sub-menu, .bg-primary-inverse .bg-primary .sub-menu, 
												article .article-featured.bg-primary, 
												.select2-container--default .select2-selection--multiple .select2-selection__choice , 
												.comment-list  li .reply a, 
												.post-tags li a, .bg-primary, #to_top_link:hover, 
												.posts-navigation span.page-dot,
												.owl-dots .owl-dot.active,.owl-dots .owl-dot:hover,
												 .site-header-cart  .widget_shopping_cart_content .buttons  .button:hover,
												 .site-header-cart  .widget_shopping_cart_content .buttons  .button:focus,
												 .select2-container .select2-results__option--highlighted[aria-selected],
												 .carrot-btn.style-flat.color-primary,
												 .carrot-btn.style-pill.color-primary,
												 #phone-menu.bg-primary .menu-opener .icon-part,
												 #phone-menu.bg-primary-inverse .menu-opener .icon-part,
												 #phone-menu.bg-primary-inverse.opened .menu-opener .icon-part,
												 .image-gallery .imgwrap,
												 .searchform-popup  .search-results li a:hover
												',
								'property' => 'background-color'
							),array(
								'element'  => '
												.bg-primary-inverse, 
												.bg-primary-inverse a, 
												.bg-primary-inverse h1, .bg-primary-inverse h2, .bg-primary-inverse h3, 
												article .article-featured.fg-primary .opener-icon .icon, 
												article .article-featured.fg-primary .hover-title, 
												article .article-featured.fg-primary .hover-title h2, 
												.article-featured.bg-black .opener-icon,
												.select2-container--default .select2-selection--multiple .select2-selection__placeholder, 
												.select2-container--default .select2-selection--single .select2-selection__placeholder, 
												.grid-filter ul li.selected a, .paginator li a, .load-more-btn, a.newer, a.older, 
												.sidebar a, .the-social-bar a, .comment-edit-link,.posts-navigation a, 
												.widget.widget_calendar a, .widget.widget_calendar #today, 
												.archive-header.archive-user .archive-author .author-count,
												.archive-header.archive-user .archive-author .author-count strong,
												.comment-list  li .comment-author a,#recentcomments li a, 
												.bg-alt a:hover,  
												.tp_recent_tweets a, .article-author a:hover, 
												.entry-title a:hover, .article-categories a:hover, 
												.entradeta,.entradeta strong, article.page-builder-enabled .so-widget-sow-editor a, article.article-single .entry-content a, article.article-single.dropcaps .entry-content > p:first-of-type:first-letter,
												article.article-single.dropcaps .entry-content > .column:first-of-type > p:first-of-type:first-letter, 
												blockquote, blockquote a, .wp-caption-text,.single article .article-date, a.twitter_link, 
												a.author_email, .header-nav a, .carrot-widget-pager span,.article-comments  a,
												a.moretag,.text-primary, #header .phone-menu .menu-drawer a,
												#header.bg-change.notontop .phone-menu .menu-drawer a , 
												.sow-text-field:focus, .sow-form-field textarea:focus,
												textarea:focus, input[type="text"]:focus,input[type="email"]:focus,input[type="tel"]:focus,input[type="password"]:focus,
												#to_top_link,
												.owl-nav [class*=owl-],
												.price ins,
												button:hover, 
												input[type=button]:hover,
												input[type=submit]:hover,
												input[type=reset]:hover,
												.button:hover,
												
												.woocommerce-MyAccount-navigation ul li.is-active a, .woocommerce-MyAccount-content a:not(.button),
												.product .summary .entry-content a, article.article-single .entry-content a, article.page-builder-enabled  .so-widget-sow-editor  .entry-content a,
												.shop_table a:not(.button):not(.remove),
												 .demo_store .woocommerce-store-notice__dismiss-link,
												 .carrot-btn.style-wire.color-primary
												 
												',
												
								'property' => 'color'
							),array(
								'element'  => '
												body.theme-preset-magazine .bg-primary-inverse .menu > li.current-menu-item > a, 
												body.theme-preset-magazine .bg-primary-inverse .menu > ul > li.current_page_item > a,
												body.theme-preset-magazine .bg-primary-inverse .menu > li > a:hover, 
												body.theme-preset-magazine .bg-primary-inverse .menu > ul > li > a:hover,
												article .article-featured.fg-primary .opener-icon .icon, 
												.select2-container--default.select2-container--focus .select2-selection--multiple, 
												.select2-container--default.select2-container--focus .select2-selection--single, 
												.grid-filter.list ul li.selected a, .paginator li a:hover, 
												.load-more-btn, .newer, .older,  .banner:hover img, 
												.border-primary, .sow-text-field:focus, .sow-form-field textarea:focus, 
												textarea:focus, input[type="text"]:focus,
												input[type="email"]:focus,input[type="tel"]:focus,input[type="password"]:focus,
												.posts-navigation a,
												.posts-navigation .page-dot,
												.owl-nav [class*=owl-],
												.owl-dots .owl-dot,
												button:hover, 
												input[type=button]:hover,
												input[type=submit]:hover,
												input[type=reset]:hover,
												.button:hover,
												.select2-container--default .select2-search--dropdown .select2-search__field:focus, 
												.search-box .searchform-popup input:focus + .box-arrow, 
												.carrot-btn.style-flat.color-primary,
												.carrot-btn.style-pill.color-primary,
												.carrot-btn.style-wire.color-primary,
												.border-primary
												 
												',
								'property' => 'border-color'
							),array(
								'element'  => '.border-bottom-primary',
								'property' => 'border-bottom-color'
							),array(
								'element'  => '.border-top-primary',
								'property' => 'border-top-color'
							),array(
								'element'  => '.border-right-primary',
								'property' => 'border-right-color'
							),array(
								'element'  => '.border-left-primary',
								'property' => 'border-left-color'
							),array(
								'element'  => '.logo-image svg, .logo-image svg *,.bg-primary-inverse .logo-image svg, .bg-primary-inverse .logo-image svg *',
								'property' => 'fill'
							)
						)
					),
					'primary_text_color'=>array(
						'type'        => 'color',
						'label'       => __( 'Text color Over Primary', THEME_NAME ),
						'default'     => '#ffffff',
						'output' => array(
							array(
								'element'  => ' 
												.article-featured.bg-borders .opener-icon .icon,  
												.article-featured.bg-borders .hover-title, .article-featured.bg-primary .opener-icon, 
												.article-featured.bg-primary .hover-title, 
												.select2-container--default .select2-selection--multiple .select2-selection__choice__remove ,
												.select2-container--default .select2-selection--multiple .select2-selection__choice , 
												#header.bg-custom .bg-primary .menu > li > a, 
												.bg-primary .menu > li > a, .comment-list  li .reply a, 
												.post-tags li a, .bg-primary , .bg-primary a, 
												.bg-primary strong, .bg-primary h1, .bg-primary h2, 
												.bg-primary h3,.bg-primary h4,.bg-primary h5, 
												.ow-button-base a,  
												#to_top_link:hover,
												.site-header-cart .widget_shopping_cart_content .buttons .button:hover,
												.site-header-cart .widget_shopping_cart_content .buttons .button:focus,
												.select2-container .select2-results__option--highlighted[aria-selected],
												.carrot-btn.style-flat.color-primary,
												 .carrot-btn.style-pill.color-primary,
												 .searchform-popup  .search-results li a:hover
												',
								'property' => 'color'
							),array(
								'element'  => ' .article-featured.bg-primary .opener-icon .icon, .article-featured.bg-borders .opener-icon .icon,
												body.theme-preset-magazine .bg-primary .menu > li.current-menu-item > a, 
												body.theme-preset-magazine .bg-primary .menu > ul > li.current_page_item > a,
												body.theme-preset-magazine .bg-primary .menu > li > a:hover, 
												body.theme-preset-magazine .bg-primary .menu > ul > li > a:hover
								',
								'property' => 'border-color'
							),array(
								'element'  => ' .bg-primary-inverse .sub-menu, .bg-primary-inverse, #to_top_link,
												#phone-menu.bg-primary.opened .menu-opener .icon-part
												',
								'property' => 'background-color'
							),array(
								'element'  => '',
								'property' => 'border-bottom-color'
							),array(
								'element'  => '',
								'property' => 'color'
							),array(
								'element'  => '.bg-primary .logo-image svg, .bg-primary .logo-image svg *',
								'property' => 'fill'
							)
						)
					),
					'alt_color'=>array(
						'type'        => 'color',
						'label'       => __( 'Alternate Color', THEME_NAME ),
						'default'     => '#888888',
						'output' => array(
							array(
								'element'  => ' 
												
												.bg-alt .sub-menu, 
												article .article-featured.bg-alt, 
												.post-tags li a:hover, .bg-alt,
												.comment-list  li .reply a:hover,
												.carrot-btn.style-flat.color-alt,
												.carrot-btn.style-pill.color-alt,
												 #phone-menu.bg-alt .menu-opener .icon-part,
												 #phone-menu.bg-alt-inverse .menu-opener .icon-part,
												 #phone-menu.bg-alt-inverse.opened .menu-opener .icon-part
												',
								'property' => 'background-color'
							),array(
								'element'  => ' 
												.bg-alt-inverse, .bg-alt-inverse a, .bg-alt-inverse h1, .bg-alt-inverse h2, .bg-alt-inverse h3,  a.newer:hover, a.older:hover, 
												article .article-featured.fg-alt .opener-icon .icon, 
												article .article-featured.fg-alt .hover-title,  
												article .article-featured.fg-alt .hover-title h2,  
												.sidebar a:hover, .comment-edit-link:hover, .posts-navigation a:hover, .widget.widget_calendar a:hover,  #recentcomments li a:hover,.bg-primary  a:hover, .tp_recent_tweets a:hover, .article-categories a, .text-alt, a.twitter_link:hover, a.author_email:hover, .header-nav a:hover, .article-comments a:hover, a.moretag:hover,
												.load-more-btn:hover, .newer:hover, .older:hover,
												.owl-nav [class*=owl-]:hover,
												button:active, button:focus, 
												input[type=button]:active,input[type=button]:focus,
												input[type=submit]:active,input[type=submit]:focus,
												input[type=reset]:active,input[type=reset]:focus,
												.button:active,.button:focus,
												.carrot-btn.style-wire.color-alt
												
												 ',
								'property' => 'color'
							),array(
								'element'  => '
												body.theme-preset-magazine .bg-alt-inverse .menu > li.current-menu-item > a, 
												body.theme-preset-magazine .bg-alt-inverse .menu > ul > li.current_page_item > a,
												body.theme-preset-magazine .bg-alt-inverse .menu > li > a:hover, 
												body.theme-preset-magazine .bg-alt-inverse .menu > ul > li > a:hover,
												article .article-featured.fg-alt .opener-icon .icon, 
												.border-alt,  
												.load-more-btn:hover, .newer:hover, .older:hover,
												.owl-nav [class*=owl-]:hover,
												button:active, button:focus, 
												input[type=button]:active,input[type=button]:focus,
												input[type=submit]:active,input[type=submit]:focus,
												input[type=reset]:active,input[type=reset]:focus,
												.button:active,.button:focus,
												.carrot-btn.style-flat.color-alt,
												.carrot-btn.style-pill.color-alt,
												.carrot-btn.style-wire.color-alt,
												.border-primary',
								'property' => 'border-color'
							),array(
								'element'  => '',
								'property' => 'border-bottom-color'
							),array(
								'element'  => '',
								'property' => 'color'
							),array(
								'element'  => '.border-top-alt',
								'property' => 'border-top-color'
							),array(
								'element'  => '.border-right-alt',
								'property' => 'border-right-color'
							),array(
								'element'  => '.border-left-alt',
								'property' => 'border-left-color'
							),array(
								'element'  => '.bg-alt-inverse .logo-image svg, .bg-alt-inverse .logo-image svg *',
								'property' => 'fill'
							)
						)
					),
					'alt_text_color'=>array(
						'type'        => 'color',
						'label'       => __( 'Text color Over Alternate', THEME_NAME ),
						'default'     => '#ffffff',
						'output' => array(
							array(
								'element'  => '
												.article-featured.bg-alt .opener-icon .icon,  .article-featured.bg-alt .hover-title, 
												#header.bg-custom .bg-alt .menu > li > a, .bg-alt .menu > li > a, 
												.post-tags li a:hover, .bg-alt, .bg-alt a, .bg-alt strong, .bg-alt h1, .bg-alt h2, .bg-alt h3,.bg-alt h4,.bg-alt h5,
												.comment-list  li .reply a:hover,
												.carrot-btn.style-flat.color-alt,
												.carrot-btn.style-pill.color-alt',
								'property' => 'color'
							),array(
								'element'  => '',
								'property' => 'border-bottom-color'
							),array(
								'element'  => 'body.theme-preset-magazine .bg-alt .menu > li.current-menu-item > a, 
												body.theme-preset-magazine .bg-alt .menu > ul > li.current_page_item > a,
												body.theme-preset-magazine .bg-alt .menu > li > a:hover, 
												body.theme-preset-magazine .bg-alt .menu > ul > li > a:hover
												',
								'property' => 'border-color'
							),array(
								'element'  => '',
								'property' => 'color'
							),array(
								'element'  => '
											.bg-alt-inverse .sub-menu, .bg-alt-inverse,
											#phone-menu.bg-alt.opened .menu-opener .icon-part
											',
								'property' => 'background-color'
							),array(
								'element'  => '.bg-alt .logo-image svg, .bg-alt .logo-image svg *',
								'property' => 'fill'
							)
						)
					),
				)
			),
			'section_fonts_general' =>array(
				'title' => __( 'Typography ', THEME_NAME ),
				'fields' => array(
					'text_font'=>array(
						'type'        => 'typography',
						'label'       => __( 'Text typography', THEME_NAME ),
						'default'     => array(
							'font-family'    => 'Roboto',
							'variant'        => 'regular',
							'font-size'      => '14px',
							'subsets'        => array( 'latin-ext' ),
							/*'line-height'    => '1.5',
							'letter-spacing' => '0',
							'subsets'        => array( 'latin-ext' ),*/
							/*'color'          => '#333333',*/
							/*'text-transform' => 'none',
							'text-align'     => 'left'*/
						),
						'output'      => array(
							array(
								'element' => 'body',
							),
						),
					),
					'headings_font'=>array(
						'type'        => 'typography',
						'label'       => __( 'Headings typography', THEME_NAME ),
						'default'     => array(
							'font-family'    => 'Roboto',
							'variant'        => '700',
							/*'font-size'      => '26px',*/
							'subsets'        => array( 'latin-ext' ),
							/*'color'          => '#333333',
							'letter-spacing' => '0',
							'line-height'    => '1.5',
							'subsets'        => array( 'latin-ext' ),
							'text-transform' => 'none',
							'text-align'     => 'left'*/
						),
						'output'      => array(
							array(
								'element' => '
												h1,h2,h3,h4,h5,h6,.tooltip, .price,
												article.page-builder-enabled.dropcaps  .so-widget-sow-editor  > p:first-of-type:first-letter,
												article.page-builder-enabled.dropcaps .so-widget-sow-editor  > .column:first-of-type > p:first-of-type:first-letter,
												article.article-single.dropcaps .entry-content > p:first-of-type:first-letter,
												article.article-single.dropcaps .entry-content > .column:first-of-type > p:first-of-type:first-letter
												',
							),
						),
					)
				)
			),
			'section_preloader' =>array(
				'title' => __( 'Preloader ', THEME_NAME ),
				'fields' => array(
					'show_preloader' => array(
						'label'=> __( 'Show preloader', THEME_NAME ),
						'type' => 'toggle',
						'default'=>'0'
					),
					'site_preload_logo' => array(
						'label'=> __( 'Show main logo in preloader', THEME_NAME ),
						'type' => 'toggle',
						'default'=>'0',
						'active_callback'    => array(
							array(
								'setting'  => 'show_preloader',
								'operator' => '==',
								'value'    => '1',
							)
						),
						
					),
					'preloader_show_text' => array(
						'label'=> __( 'Show loading text', THEME_NAME ),
						'type' => 'toggle',
						'default'=>'1',
						'active_callback'    => array(
							array(
								'setting'  => 'show_preloader',
								'operator' => '==',
								'value'    => '1',
							)
						),
						
					),
					'preloader_custom_text'=>array(
						'type'        => 'text',
						'label'       => __( 'Custom preloader text', THEME_NAME ),
						'active_callback'    => array(
							array(
								'setting'  => 'show_preloader',
								'operator' => '==',
								'value'    => '1',
							),
							array(
								'setting'  => 'preloader_show_text',
								'operator' => '==',
								'value'    => '1',
							)
						),
					),
					'preloader_custom_image'=>array(
						'type'        => 'image',
						'label'       => __( 'Custom preloader image', THEME_NAME ),
						'active_callback'    => array(
							array(
								'setting'  => 'show_preloader',
								'operator' => '==',
								'value'    => '1',
							)
						),
					)
				)
			),
			//Related section
			'related_section' =>array(
				'title' => __( 'Related', THEME_NAME ),
				'description' => __( 'Customize all related articles sections', THEME_NAME ),
				'fields' => array(
					'related_count' => array(
						'label'=> __( 'Articles count', THEME_NAME ),
						'type' => 'number',
						'default'     => 4,
						'choices'     => array(
							'min'  => 1,
							'max'  => 100,
							'step' => 1,
						),
					),
					'related_show_title' => array(
						'label'=> __( 'Show title under thumbnail', THEME_NAME ),
						'type' => 'toggle',
						'default'=>'1'
					),
					'related_show_title_hover' => array(
						'label'=> __( 'Show title on hover thumbnail', THEME_NAME ),
						'type' => 'toggle',
						'default'=>'0'
					),
					'related_show_excerpt' => array(
						'label'=> __( 'Show excerpt under thumbnail', THEME_NAME ),
						'type' => 'toggle',
						'default'=>'0'
					),
					
					'related_columns' => array(
						'label'=> __( 'Columns', THEME_NAME ),
						'type' => 'number',
						'default'     => 4,
						'choices'     => array(
							'min'  => 1,
							'max'  => 6,
							'step' => 1,
						),
					),
					'related_responsive_columns' => array(
						'label'=> __( 'Mobile columns', THEME_NAME ),
						'type' => 'number',
						'default'     => 1,
						'choices'     => array(
							'min'  => 1,
							'max'  => 2,
							'step' => 1,
						),
					),
					'related_thumbsize' => array(
						'label'=> __( 'Thumbnail size', THEME_NAME ),
						'type'        => 'select',
						'default'        => 'medium',
						'choices'     => $thumbsizes
						
					),
					'related_gap' => array(
						'label'=> __( 'Separation', THEME_NAME ),
						'type'        => 'select',
						'default'        => 'small',
						'choices'     => carrot_availableGaps()
						
					),
				)
			),
			
			
			
			
			//HEADER section
			'header_section' =>array(
				'title' => __( 'Header', THEME_NAME ),
				'description' => __( 'Customize header display options ', THEME_NAME ),
				'fields' => array(
					'show_header' => array(
						'type'        => 'toggle',
						'label'       => __( 'Show Header', THEME_NAME ),
						'default'     => '1'

					),
					'header_layout' => array(
						
						'type'        => 'radio-buttonset',
						'label'       => esc_html__( 'Header layout', THEME_NAME ),
						'default'     => 'normal',
						'choices'     => array(
							'normal'   => __("Theme default",THEME_NAME),
							'page' => __("Customized",THEME_NAME)
						),
						'active_callback'    => array(
							array(
								'setting'  => 'show_header',
								'operator' => '==',
								'value'    => '1',
							)
						),
					
					),
					'header_page' => array(
						'type'        => 'select',
						'label'       => __( 'Selected header', THEME_NAME ),
						'description'       => __( 'You can create your custom Blocks in the "blocks" section of the Wordpress Dashboard.', THEME_NAME ),
						
						'choices'     => carrot_get_all_blocks(),
						'active_callback'    => array(
							array(
								'setting'  => 'show_header',
								'operator' => '==',
								'value'    => '1',
							),
							array(
								'setting'  => 'header_layout',
								'operator' => '==',
								'value'    => 'page',
							)
						),
					),
					'header_type' => array(
						
						'type'        => 'radio-buttonset',
						'label'       => esc_html__( 'Header align', THEME_NAME ),
						'default'     => 'header_left',
						'choices'     => array(
							'header_left'   => __("Left",THEME_NAME),
							'header_center' => __("Center",THEME_NAME),
							'header_right' => __("Right",THEME_NAME)
						),
						'active_callback'    => array(
							array(
								'setting'  => 'show_header',
								'operator' => '==',
								'value'    => '1',
							),
							array(
								'setting'  => 'header_layout',
								'operator' => '==',
								'value'    => 'normal',
							)
						),
					
					),
					
					'fullwidth_header' => array(
						'label'=> __( 'Full width header?', THEME_NAME ),
						'type' => 'toggle',
						'default'=>'0',
						'active_callback'    => array(
							array(
								'setting'  => 'show_header',
								'operator' => '==',
								'value'    => '1',
							),
							array(
								'setting'  => 'header_layout',
								'operator' => '==',
								'value'    => 'normal',
							)
						),
						
					),
					'header_show_options'=>array(
						'type'        => 'multicheck',
						'label'       => esc_attr__( 'Show Options', THEME_NAME ),
						'default'     => array('title', 'search','menu'),
						'choices'     =>  $header_show_options,
						'active_callback'    => array(
							array(
								'setting'  => 'show_header',
								'operator' => '==',
								'value'    => '1',
							),
							array(
								'setting'  => 'header_layout',
								'operator' => '==',
								'value'    => 'normal',
							)
						),
					),
					'header_background_color'=>array(
						'type'        => 'select',
						'label'       => __( 'Header color', THEME_NAME ),
						'default'     => 'primary',
						'multiple'    => false,
						'choices'     => array(
							'primary' => esc_attr__( 'Primary color', THEME_NAME ),
							'primary-inverse' => esc_attr__( 'Primary color inverse', THEME_NAME ),
							'alt' => esc_attr__( 'Alternate color', THEME_NAME ),
							'alt-inverse' => esc_attr__( 'Alternate color inverse', THEME_NAME ),
							'white' => esc_attr__( 'White', THEME_NAME ),
							'black' => esc_attr__( 'Black', THEME_NAME ),
							'custom' => esc_attr__( 'Custom color', THEME_NAME )
							
						),
						'active_callback'    => array(
							array(
								'setting'  => 'show_header',
								'operator' => '==',
								'value'    => '1',
							),
							array(
								'setting'  => 'header_layout',
								'operator' => '==',
								'value'    => 'normal',
							)
						),
					),
					'header_custom_background_color'=>array(
						'type'        => 'color',
						'label'       => __( 'Header custom BG color', THEME_NAME ),
						'default'     => '#cccccc',
						'alpha' 	  => true,
						'active_callback'    => array(
							array(
								'setting'  => 'show_header',
								'operator' => '==',
								'value'    => '1',
							),
							array(
								'setting'  => 'header_background_color',
								'operator' => '==',
								'value'    => 'custom',
							)
						),
						'output' => array(
							array(
								'element'  => '
												#header.bg-custom .sub-menu, #header.bg-custom , #sticky-header.bg-custom,
												#sticky-header.bg-custom .sub-menu, #sticky-header.bg-custom , #sticky-sticky-header.bg-custom', 

								'property' => 'background-color'
							),array(
								'element'  => '',
								'property' => 'color'
							)
						)
					),
					'header_custom_text_color'=>array(
						'type'        => 'color',
						'label'       => __( 'Header custom text color', THEME_NAME ),
						'default'     => '#333333',
						'alpha' 	  => true,
						'active_callback'    => array(
							array(
								'setting'  => 'show_header',
								'operator' => '==',
								'value'    => '1',
							),
							array(
								'setting'  => 'header_background_color',
								'operator' => '==',
								'value'    => 'custom',
							)
						),
						'output' => array(
							array(
								'element'  => '
												#header.bg-custom, #header.bg-custom a, #header.bg-custom h1, #header.bg-custom h2, #header.bg-custom h3
												#sticky-header.bg-custom, #sticky-header.bg-custom a, #sticky-header.bg-custom h1, #sticky-header.bg-custom h2, #sticky-header.bg-custom h3
												
												',
								'property' => 'color'
							),array(
								'element'  => '
												body.theme-preset-magazine .bg-custom .menu > li.current-menu-item > a, 
												body.theme-preset-magazine .bg-custom .menu > ul > li.current_page_item > a,
												body.theme-preset-magazine .bg-custom .menu > li > a:hover, 
												body.theme-preset-magazine .bg-custom .menu > ul > li > a:hover
														',
								'property' => 'border-color'
							),array(
								'element'  => '',
								'property' => 'border-left-color'
							),array(
								'element'  => '',
								'property' => 'background-color'
							),array(
								'element'  => '#header.bg-custom .logo-image svg, #header.bg-custom .logo-image svg *',
								'property' => 'fill'
							)
						)
					)
					
				)
				
			),
			
			//DRAWER section
			'drawer_section' =>array(
				'title' => __( 'Mobile drawer', THEME_NAME ),
				'fields' => array(
					'show_drawer' => array(
						'type'        => 'toggle',
						'label'       => __( 'Show Mobile drawer ', THEME_NAME ),
						'default'     => '1'

					),

					'always_show_drawer' => array(
						'type'        => 'toggle',
						'label'       => __( 'Show always ', THEME_NAME ),
						'default'     => '0'

					),
					'drawer_layout' => array(
						
						'type'        => 'radio-buttonset',
						'label'       => esc_html__( 'Drawer layout', THEME_NAME ),
						'default'     => 'normal',
						'choices'     => array(
							'normal'   => __("Theme default",THEME_NAME),
							'page' => __("Customized",THEME_NAME)
						),
						'active_callback'    => array(
							array(
								'setting'  => 'show_drawer',
								'operator' => '==',
								'value'    => '1',
							)
						),
					
					),
					'drawer_page' => array(
						'type'        => 'select',
						'label'       => __( 'Selected drawer', THEME_NAME ),
						'description'       => __( 'You can create your custom Blocks in the "blocks" section of the Wordpress Dashboard.', THEME_NAME ),
						
						'choices'     => carrot_get_all_blocks(),
						'active_callback'    => array(
							array(
								'setting'  => 'show_drawer',
								'operator' => '==',
								'value'    => '1',
							),
							array(
								'setting'  => 'drawer_layout',
								'operator' => '==',
								'value'    => 'page',
							)
						),
					),
					'drawer_position' => array(
						
						'type'        => 'radio-buttonset',
						'label'       => esc_html__( 'Phone Menu position', THEME_NAME ),
						'default'     => 'right',
						'choices'     => array(
							'left'   => __("Left",THEME_NAME),
							'right' => __("Right",THEME_NAME)
						),
						'active_callback'    => array(
							array(
								'setting'  => 'show_drawer',
								'operator' => '==',
								'value'    => '1',
							)
						),
					
					),
					'drawer_style' => array(
						
						'type'        => 'radio-buttonset',
						'label'       => esc_html__( 'Phone Menu opener style', THEME_NAME ),
						'default'     => 'hamburguer',
						'choices'     => array(
							'hamburguer'   => __("Hamburguer",THEME_NAME),
							'plus' => __("Plus",THEME_NAME)
						),
						'active_callback'    => array(
							array(
								'setting'  => 'show_drawer',
								'operator' => '==',
								'value'    => '1',
							)
						),
					
					),
					'drawer_opener_size' => array(
						'label'=> __( 'Opener size', THEME_NAME ),
						'type'        => 'slider',
						'default'     => 36,
						'choices'     => array(
							'min'  => '10',
							'max'  => '120',
							'step' => '1',
						),
						'output' => array(
							array(
								'element'  => '#phone-menu.style-plus .menu-opener, #phone-menu.style-hamburguer .menu-opener',
								'property' => 'width',
								'units' =>'px'
							),
							array(
								'element'  => '#phone-menu.style-plus .menu-opener, #phone-menu.style-hamburguer .menu-opener',
								'property' => 'height',
								'units' =>'px'
							)
						),
						'active_callback'    => array(
							array(
								'setting'  => 'show_drawer',
								'operator' => '==',
								'value'    => '1',
							)
						)
					),
					'drawer_width' => array(
						'label'=> __( 'Width', THEME_NAME ),
						'type'        => 'slider',
						'default'     => 80,
						'choices'     => array(
							'min'  => '0',
							'max'  => '100',
							'step' => '1',
						),
						'output' => array(
							array(
								'element'  => '#phone-menu .menu-drawer',
								'property' => 'width',
								'units' =>'%'
							)
						),
						'active_callback'    => array(
							array(
								'setting'  => 'show_drawer',
								'operator' => '==',
								'value'    => '1',
							)
						)
					),
					'drawer_show_overlay'=> array(
						'type'        => 'toggle',
						'label'       => __( 'Show background overlay', THEME_NAME ),
						'default'     => '1',
						'active_callback'    => array(
							array(
								'setting'  => 'show_drawer',
								'operator' => '==',
								'value'    => '1',
							)
						)
					),
					'drawer_overlay_opacity' => array(
						'label'=> __( 'Overlay opacity', THEME_NAME ),
						'type'        => 'slider',
						'default'     => 0.7,
						'choices'     => array(
							'min'  => '0',
							'max'  => '1',
							'step' => '0.1',
						),
						'output' => array(
							array(
								'element'  => '#phone-menu.with-overlay.opened .drawer-overlay',
								'property' => 'opacity',
								'units' =>''
							)
						),
						'active_callback'    => array(
							array(
								'setting'  => 'show_drawer',
								'operator' => '==',
								'value'    => '1',
							),
							array(
								'setting'  => 'drawer_show_overlay',
								'operator' => '==',
								'value'    => '1',
							)
						)
					),
					'drawer_show_options'=>array(
						'type'        => 'multicheck',
						'label'       => esc_attr__( 'Show Options', THEME_NAME ),
						'default'     => array('social','search','menu'),
						'choices'     =>  $header_show_options,
						'active_callback'    => array(
							array(
								'setting'  => 'show_drawer',
								'operator' => '==',
								'value'    => '1',
							),
							array(
								'setting'  => 'drawer_layout',
								'operator' => '==',
								'value'    => 'normal',
							)
						),
					),
					'drawer_background_color'=>array(
						'type'        => 'select',
						'label'       => __( 'Phone menu color', THEME_NAME ),
						'default'     => 'primary',
						'multiple'    => false,
						'choices'     => array(
							'primary' => esc_attr__( 'Primary color', THEME_NAME ),
							'primary-inverse' => esc_attr__( 'Primary color inverse', THEME_NAME ),
							'alt' => esc_attr__( 'Alternate color', THEME_NAME ),
							'alt-inverse' => esc_attr__( 'Alternate color inverse', THEME_NAME ),
							'white' => esc_attr__( 'White', THEME_NAME ),
							'black' => esc_attr__( 'Black', THEME_NAME ),
							'custom' => esc_attr__( 'Custom color', THEME_NAME )
							
						),
						'active_callback'    => array(
							array(
								'setting'  => 'show_drawer',
								'operator' => '==',
								'value'    => '1',
							)
						),
					),
					'drawer_custom_background_color'=>array(
						'type'        => 'color',
						'label'       => __( 'Phone Menu custom BG color', THEME_NAME ),
						'default'     => '#cccccc',
						'alpha' 	  => true,
						'active_callback'    => array(
							array(
								'setting'  => 'show_drawer',
								'operator' => '==',
								'value'    => '1',
							),
							array(
								'setting'  => 'drawer_background_color',
								'operator' => '==',
								'value'    => 'custom',
							)
						),
						'output' => array(
							array(
								'element'  => '
												#phone-menu.bg-custom .menu-drawer,
												#phone-menu.bg-custom .menu-opener .icon-part
												', 

								'property' => 'background-color'
							),array(
								'element'  => '',
								'property' => 'color'
							)
						)
					),
					'drawer_custom_text_color'=>array(
						'type'        => 'color',
						'label'       => __( 'Phone Menu custom text color', THEME_NAME ),
						'default'     => '#333333',
						'alpha' 	  => true,
						'active_callback'    => array(
							array(
								'setting'  => 'show_drawer',
								'operator' => '==',
								'value'    => '1',
							),
							array(
								'setting'  => 'drawer_background_color',
								'operator' => '==',
								'value'    => 'custom',
							)
						),
						'output' => array(
							array(
								'element'  => '
												#phone-menu.bg-custom .menu-drawer,
												#phone-menu.bg-custom .menu-drawer a,
												#phone-menu.bg-custom .menu-drawer a:hover,
												#phone-menu.bg-custom .menu-drawer a:active,
												#phone-menu.bg-custom .menu-drawer a:visited,
												#phone-menu.bg-custom .menu-drawer a:focus
												
												',
								'property' => 'color'
							),array(
								'element'  => '#phone-menu.bg-custom .menu-drawer',
								'property' => 'border-color'
							),array(
								'element'  => '#phone-menu.bg-custom.opened .menu-opener .icon-part',
								'property' => 'background-color'
							)
						)
					)
				)
			),
			//STICKY HEADER section
			'sticky_header_section' =>array(
				'title' => __( 'Sticky Header', THEME_NAME ),
				'fields' => array(
					'show_sticky_header' => array(
						'type'        => 'toggle',
						'label'       => __( 'Show Sticky Header', THEME_NAME ),
						'default'     => '1'

					),
					'sticky_header_layout' => array(
						
						'type'        => 'radio-buttonset',
						'label'       => esc_html__( 'Sticky header layout', THEME_NAME ),
						'default'     => 'normal',
						'choices'     => array(
							'normal'   => __("Default header",THEME_NAME),
							'page' => __("Customized",THEME_NAME)
						),
						'active_callback'    => array(
							array(
								'setting'  => 'show_sticky_header',
								'operator' => '==',
								'value'    => '1',
							)
						),
					
					),
					'sticky_header_page' => array(
						'type'        => 'select',
						'label'       => __( 'Selected sticky header', THEME_NAME ),
						'description'       => __( 'You can create your custom Sticky Headers in the "blocks" section of the Wordpress Dashboard.', THEME_NAME ),
						'choices'     => carrot_get_all_blocks(),
						'active_callback'    => array(
							array(
								'setting'  => 'show_sticky_header',
								'operator' => '==',
								'value'    => '1',
							),
							array(
								'setting'  => 'sticky_header_layout',
								'operator' => '==',
								'value'    => 'page',
							)
						),
					)
				)
			),
			//FOOTER section
			'footer_section' =>array(
				'title' => __( 'Footer', THEME_NAME ),
				'fields' => array(
					'show_footer' => array(
						'label'=> __( 'Show footer?', THEME_NAME ),
						'type' => 'toggle',
						'default'=>'1'
					),
					'footer_layout' => array(
						
						'type'        => 'radio-buttonset',
						'label'       => esc_html__( 'Footer layout', THEME_NAME ),
						'default'     => 'normal',
						'choices'     => array(
							'normal'   => __("Theme default",THEME_NAME),
							'page' => __("Customized",THEME_NAME)
						),
						'active_callback'    => array(
							array(
								'setting'  => 'show_footer',
								'operator' => '==',
								'value'    => '1',
							)
						),
					
					),
					'footer_page' => array(
						'type'        => 'select',
						'label'       => __( 'Selected footer', THEME_NAME ),
						'description'       => __( 'You can create your custom Footers in the "blocks" section of the Wordpress Dashboard.', THEME_NAME ),
						'choices'     => carrot_get_all_blocks(),
						'active_callback'    => array(
							array(
								'setting'  => 'show_footer',
								'operator' => '==',
								'value'    => '1',
							),
							array(
								'setting'  => 'footer_layout',
								'operator' => '==',
								'value'    => 'page',
							)
						),
					),
					'show_back_to_top' => array(
						'label'=> __( 'Show back to top button?', THEME_NAME ),
						'type' => 'toggle',
						'default'=>'1'
					),
					'footer_columns'=>array(
						'type'        => 'radio-buttonset',
						'label'       => __( 'Columns', THEME_NAME ),
						'default'=> '3',
						'choices'     => array(
							'1'   => esc_attr__( 'One', THEME_NAME ),
							'2' => esc_attr__( 'Two', THEME_NAME ),
							'3'  => esc_attr__( 'Three', THEME_NAME ),
							'4'  => esc_attr__( 'Four', THEME_NAME ),
						),
						'active_callback'    => array(
							array(
								'setting'  => 'show_footer',
								'operator' => '==',
								'value'    => '1',
							),
							array(
								'setting'  => 'footer_layout',
								'operator' => '==',
								'value'    => 'normal',
							)
						),

					),
					
					'fullwidth_footer' => array(
						'label'=> __( 'Full width footer?', THEME_NAME ),
						'type' => 'toggle',
						'default'=>'0',
						'active_callback'    => array(
							array(
								'setting'  => 'show_footer',
								'operator' => '==',
								'value'    => '1',
							),
							array(
								'setting'  => 'footer_layout',
								'operator' => '==',
								'value'    => 'normal',
							)
						),
						
					),
					'footer_background_color'=>array(
						'type'        => 'select',
						'label'       => __( 'Footer color', THEME_NAME ),
						'default'     => 'alt-inverse',
						'multiple'    => false,
						'choices'     => array(
							'primary' => esc_attr__( 'Primary color', THEME_NAME ),
							'primary-inverse' => esc_attr__( 'Primary color inverse', THEME_NAME ),
							'alt' => esc_attr__( 'Alternate color', THEME_NAME ),
							'alt-inverse' => esc_attr__( 'Alternate color inverse', THEME_NAME ),
							'white' => esc_attr__( 'White', THEME_NAME ),
							'black' => esc_attr__( 'Black', THEME_NAME ),
							'custom' => esc_attr__( 'Custom color', THEME_NAME )
							
						),
						'active_callback'    => array(
							array(
								'setting'  => 'footer_layout',
								'operator' => '==',
								'value'    => 'normal',
							),
							array(
								'setting'  => 'show_footer',
								'operator' => '==',
								'value'    => '1',
							),
						),
					),
					'footer_custom_background_color'=>array(
						'type'        => 'color',
						'label'       => __( 'Footer custom BG color', THEME_NAME ),
						'default'     => '#cccccc',
						'alpha' => true,
						'active_callback'    => array(
							array(
								'setting'  => 'footer_layout',
								'operator' => '==',
								'value'    => 'normal',
							),
							array(
								'setting'  => 'show_footer',
								'operator' => '==',
								'value'    => '1',
							),
							array(
								'setting'  => 'footer_background_color',
								'operator' => '==',
								'value'    => 'custom',
							),
							
						),
						'output' => array(
							array(
								'element'  => '#footer.bg-custom',
								'property' => 'background-color'
							)
						)
					),
					'footer_custom_text_color'=>array(
						'type'        => 'color',
						'label'       => __( 'Footer custom text color', THEME_NAME ),
						'default'     => '#333333',
						'alpha' => true,
						'active_callback'    => array(
							array(
								'setting'  => 'footer_layout',
								'operator' => '==',
								'value'    => 'normal',
							),
							array(
								'setting'  => 'show_footer',
								'operator' => '==',
								'value'    => '1',
							),
							array(
								'setting'  => 'footer_background_color',
								'operator' => '==',
								'value'    => 'custom',
							),
						),
						'output' => array(
							array(
								'element'  => '#footer.bg-custom, #footer.bg-custom > .container a, #footer.bg-custom >.container a:hover',
								'property' => 'color'
							),
							array(
								'element'  => '#footer.bg-custom',
								'property' => 'border-top-color'
							)
						)
					),
					'show_sub_footer' => array(
						'type'        => 'toggle',
						'label'       => __( 'Show Subfooter', THEME_NAME ),
						'default'     => '0',
						'active_callback'    => array(
							array(
								'setting'  => 'show_footer',
								'operator' => '==',
								'value'    => '1',
							),array(
								'setting'  => 'footer_layout',
								'operator' => '==',
								'value'    => 'normal',
							)
						)
					),
					'subfooter_options'=>array(
						'type'        => 'multicheck',
						'label'       => esc_attr__( 'Show Options', THEME_NAME ),
						'default'     => array('contact','copyright','social'),
						'choices'     => array(
							'copyright' => esc_attr__( 'Copyright', THEME_NAME ),
							'contact' => esc_attr__( 'Contact info', THEME_NAME ),
							'social' => esc_attr__( 'Social icons', THEME_NAME ),
							'menu' => esc_attr__( 'Menu', THEME_NAME ),
						),
						'active_callback'    => array(
							array(
								'setting'  => 'footer_layout',
								'operator' => '==',
								'value'    => 'normal',
							),
							array(
								'setting'  => 'show_footer',
								'operator' => '==',
								'value'    => '1',
							),
							array(
								'setting'  => 'show_sub_footer',
								'operator' => '==',
								'value'    => '1',
							),
						),
					),
					
					'subfooter_background_color'=>array(
						'type'        => 'select',
						'label'       => __( 'Subfooter color', THEME_NAME ),
						'default'     => 'black',
						'multiple'    => false,
						'choices'     => array(
							'primary' => esc_attr__( 'Primary color', THEME_NAME ),
							'primary-inverse' => esc_attr__( 'Primary color inverse', THEME_NAME ),
							'alt' => esc_attr__( 'Alternate color', THEME_NAME ),
							'alt-inverse' => esc_attr__( 'Alternate color inverse', THEME_NAME ),
							'white' => esc_attr__( 'White', THEME_NAME ),
							'black' => esc_attr__( 'Black', THEME_NAME ),
							'custom' => esc_attr__( 'Custom color', THEME_NAME )
							
						),
						'active_callback'    => array(
							array(
								'setting'  => 'show_footer',
								'operator' => '==',
								'value'    => '1',
							),
							array(
								'setting'  => 'show_sub_footer',
								'operator' => '==',
								'value'    => '1',
							),
						),
						
					),
					'subfooter_custom_background_color'=>array(
						'type'        => 'color',
						'label'       => __( 'Subfooter custom BG color', THEME_NAME ),
						'default'     => '#cccccc',
						'alpha'       => true,
						'active_callback'    => array(
							array(
								'setting'  => 'show_footer',
								'operator' => '==',
								'value'    => '1',
							),
							array(
								'setting'  => 'subfooter_background_color',
								'operator' => '==',
								'value'    => 'custom',
							),
						),
						'output' => array(
							array(
								'element'  => '#subfooter.bg-custom',
								'property' => 'background-color'
							)
						)
					),
					'subfooter_custom_text_color'=>array(
						'type'        => 'color',
						'label'       => __( 'Subfooter custom text color', THEME_NAME ),
						'default'     => '#333333',
						'alpha'       => true,
						'active_callback'    => array(
							array(
								'setting'  => 'show_footer',
								'operator' => '==',
								'value'    => '1',
							),
							array(
								'setting'  => 'subfooter_background_color',
								'operator' => '==',
								'value'    => 'custom',
							),
						),
						'output' => array(
							array(
								'element'  => '#subfooter.bg-custom *, #subfooter.bg-custom a, #subfooter.bg-custom a:hover',
								'property' => 'color'
							)
						)
					),
					'copyright'=>array(
						'type'        => 'code',
						'label'       => __( 'Copyright text', THEME_NAME ),
						'choices'     => array(
							'language' => 'html',
							'theme'    => 'mdn-light',
							'height'   => 150,
						),
						'active_callback'    => array(
							array(
								'setting'  => 'show_footer',
								'operator' => '==',
								'value'    => '1',
							),
							array(
								'setting'  => 'show_sub_footer',
								'operator' => '==',
								'value'    => '1',
							),
						)
					),
				)
			),	
			//CONTACT section
			'contact_section' =>array(
				'title' => __( 'Contact', THEME_NAME ),
				'fields' => array(
					'show_contact_icons'=>array(
						'type'        => 'toggle',
						'default'        => '1',
						'label'       => __( 'Show Icons', THEME_NAME )

					),
					'contact_layout' => array(
						
						'type'        => 'radio-buttonset',
						'label'       => esc_html__( 'Contact layout', THEME_NAME ),
						'default'     => 'inline',
						'choices'     => array(
							'inline'   => __("Inline",THEME_NAME),
							'block' => __("Block",THEME_NAME)
						)
					
					),
					'contact_phone'=>array(
						'type'        => 'text',
						'label'       => __( 'Contact Phone', THEME_NAME )

					),
					'contact_email'=>array(
						'type'        => 'text',
						'label'       => __( 'Contact Email', THEME_NAME )

					),
					'contact_address'=>array(
						'type'        => 'textarea',
						'label'       => __( 'Contact Address', THEME_NAME )

					),
					'social_facebook'=>array(
						'type'        => 'text',
						'tooltip'        => 'Full Facebook profile (or page) URL',
						'label'       => __( 'Facebook URL', THEME_NAME )

					),
					'social_twitter'=>array(
						'type'        => 'text',
						'tooltip'        => 'Only the twitter username (withouth the @)',
						'label'       => __( 'Twitter Username', THEME_NAME )

					),
					'social_linkedin'=>array(
						'type'        => 'text',
						'tooltip'        => 'Full LinkedIn profile URL',
						'label'       => __( 'LinkedIn URL', THEME_NAME )

					),
					'social_google_plus'=>array(
						'type'        => 'text',
						'tooltip'        => 'Google + URL',
						'label'       => __( 'Google + URL', THEME_NAME )

					),
					'social_youtube'=>array(
						'type'        => 'text',
						'tooltip'        => 'Full Youtube page URL',
						'label'       => __( 'Youtube URL', THEME_NAME )

					),
					'social_flickr'=>array(
						'type'        => 'text',
						'tooltip'        => 'Full Flickr URL',
						'label'       => __( 'Flickr URL', THEME_NAME )

					),
					'social_pinterest'=>array(
						'type'        => 'text',
						'tooltip'        => 'Full Pinterest URL',
						'label'       => __( 'Pinterest URL', THEME_NAME )

					),
					'social_instagram'=>array(
						'type'        => 'text',
						'tooltip'        => 'Only the Instagram username (withouth the @)',
						'label'       => __( 'Instagram User', THEME_NAME )

					),
					'social_rss'=>array(
						'type'        => 'toggle',
						'default'        => '1',
						'label'       => __( 'RSS Feed', THEME_NAME )

					),
					
				)
			),
			
			//BLOG section
			'blog_section' =>array(
				'title' => __( 'Blog', THEME_NAME ),
				'active_callback' => function () { 
					return is_home()  ;
				},
				'fields' => array(
					'blog_style'=>array(
						'type'        => 'select',
						'label'       => __( 'Blog Style', THEME_NAME ),
						'default'     => 'classic',
						'multiple'    => false,
						'choices'     => array(
							'classic' => esc_attr__( 'Classic', THEME_NAME ),
							'list' => esc_attr__( 'List', THEME_NAME ),
							'grid' => esc_attr__( 'Grid', THEME_NAME )
							
						)

					),
					'blog_sidebar'=>array(
						'type'        => 'select',
						'label'       => __( 'Sidebar', THEME_NAME ),
						'default'     => 'no',
						'multiple'    => false,
						'choices'     => array(
							'no' => esc_attr__( 'No sidebar', THEME_NAME ),
							'left' => esc_attr__( 'Left sidebar', THEME_NAME ),
							'right' => esc_attr__( 'Right sidebar', THEME_NAME ),
							'bottom' => esc_attr__( 'Bottom bar', THEME_NAME )
						)

					),
					'blog_pagination_style'=>array(
						'type'        => 'select',
						'label'       => __( 'Pagination', THEME_NAME ),
						'default'     => 'classic',
						'multiple'    => false,
						'choices'     => array(
							'none' => esc_attr__( 'No pagination', THEME_NAME ),
							'classic' => esc_attr__( 'Classic (next/prev)', THEME_NAME ),
							'pagenumbers' => esc_attr__( 'Page numbers', THEME_NAME )
						)

					),
					'sidebar_columns' => array(
						'type'        => 'number',
						'label'       => __( 'Sidebar Columns', THEME_NAME ),
						'default'     => 3,
						'choices'     => array(
							'min'  => 1,
							'max'  => 6,
							'step' => 1,
						),
						'active_callback'    => array(
							array(
								'setting'  => 'blog_sidebar',
								'operator' => '==',
								'value'    => 'bottom',
							),
						)

					),
					'blog_columns' => array(
						'type'        => 'number',
						'label'       => __( 'Grid Columns', THEME_NAME ),
						'default'     => 3,
						'choices'     => array(
							'min'  => 1,
							'max'  => 6,
							'step' => 1,
						),
						'active_callback'    => array(
							array(
								'setting'  => 'blog_style',
								'operator' => '==',
								'value'    => 'grid',
							),
						)

					),
					'blog_tile_gap'=>array(
						'type'        => 'select',
						'label'       => __( 'Articles gap', THEME_NAME ),
						'default'     => 'medium',
						'multiple'    => false,
						'choices'     => carrot_availableGaps(),
						'active_callback'    => array(
							array(
								'setting'  => 'blog_style',
								'operator' => '!=',
								'value'    => 'classic',
							)
						)

					),
					'blog_post_template'=>array(
						'type'        => 'select',
						'label'       => __( 'Tile Template', THEME_NAME ),
						'default'     => 'default',
						'multiple'    => false,
						'choices'     => carrot_get_post_templates(true)

					),
						
					'blog_article_border' => array(
						'label'=> __( 'Articles border', THEME_NAME ),
						'type'        => 'slider',
						'default'     => 0,
						'choices'     => array(
							'min'  => '0',
							'max'  => '10',
							'step' => '1',
						),
						'output' => array(
							array(
								'element'  => 'body.blog .articles-container article > .article-inner',
								'property' => 'border-width',
								'units' =>'px'
							)
						),
						'active_callback'    => array(
							array(
								'setting'  => 'blog_post_template',
								'operator' => '==',
								'value'    => 'default',
							)
						)
					),
					
					'show_featured' => array(
						'type'        => 'toggle',
						'label'       => __( 'Show Thumbnail', THEME_NAME ),
						'default'     => '1',
						'active_callback'    => array(
							array(
								'setting'  => 'blog_post_template',
								'operator' => '==',
								'value'    => 'default',
							),
							array(
								'setting'  => 'blog_style',
								'operator' => '!=',
								'value'    => 'classic',
							),
						)
					),
					'show_title' => array(
						'type'        => 'toggle',
						'label'       => __( 'Show Title', THEME_NAME ),
						'default'     => '1',
						'active_callback'    => array(
							array(
								'setting'  => 'blog_post_template',
								'operator' => '==',
								'value'    => 'default',
							),
							array(
								'setting'  => 'blog_style',
								'operator' => '!=',
								'value'    => 'classic',
							),
						)
					),
					'show_date' => array(
						'type'        => 'toggle',
						'label'       => __( 'Show Date', THEME_NAME ),
						'default'     => '1',
						'active_callback'    => array(
							array(
								'setting'  => 'blog_post_template',
								'operator' => '==',
								'value'    => 'default',
							),
							array(
								'setting'  => 'blog_style',
								'operator' => '!=',
								'value'    => 'classic',
							),
						)
					),

					'show_excerpt' => array(
						'type'        => 'toggle',
						'label'       => __( 'Show Excerpt', THEME_NAME ),
						'default'     => '1',
						'active_callback'    => array(
							array(
								'setting'  => 'blog_post_template',
								'operator' => '==',
								'value'    => 'default',
							),
							array(
								'setting'  => 'blog_style',
								'operator' => '!=',
								'value'    => 'classic',
							),
						)
					),
					'show_author' => array(
						'type'        => 'toggle',
						'label'       => __( 'Show Author', THEME_NAME ),
						'default'     => '1',
						'active_callback'    => array(
							array(
								'setting'  => 'blog_post_template',
								'operator' => '==',
								'value'    => 'default',
							),
							array(
								'setting'  => 'blog_style',
								'operator' => '!=',
								'value'    => 'classic',
							),
						)
					),
					'show_content' => array(
						'type'        => 'toggle',
						'label'       => __( 'Show Content', THEME_NAME ),
						'default'     => '0',
						'active_callback'    => array(
							array(
								'setting'  => 'blog_post_template',
								'operator' => '==',
								'value'    => 'default',
							),
							array(
								'setting'  => 'blog_style',
								'operator' => '!=',
								'value'    => 'classic',
							),
						)
					),
					'show_categories' => array(
						'type'        => 'toggle',
						'label'       => __( 'Show Categories', THEME_NAME ),
						'default'     => '0',
						'active_callback'    => array(
							array(
								'setting'  => 'blog_post_template',
								'operator' => '==',
								'value'    => 'default',
							),
							array(
								'setting'  => 'blog_style',
								'operator' => '!=',
								'value'    => 'classic',
							),
						)
					),
					'show_comments' => array(
						'type'        => 'toggle',
						'label'       => __( 'Show Comments', THEME_NAME ),
						'default'     => '0',
						'active_callback'    => array(
							array(
								'setting'  => 'blog_post_template',
								'operator' => '==',
								'value'    => 'default',
							),
							array(
								'setting'  => 'blog_style',
								'operator' => '!=',
								'value'    => 'classic',
							),
						)
					),
					
					'blog_thumb_position'=>array(
						'type'        => 'select',
						'label'       => __( 'Thumbnail position', THEME_NAME ),
						'default'     => 'left',
						'multiple'    => false,
						'choices'     => array(
							'left' => esc_attr__( 'Left', THEME_NAME ),
							'right' => esc_attr__( 'Right', THEME_NAME ),
							'top' => esc_attr__( 'Top', THEME_NAME ),
							'bottom' => esc_attr__( 'Bottom', THEME_NAME )
						),
						'active_callback'    => array(
							array(
								'setting'  => 'blog_post_template',
								'operator' => '==',
								'value'    => 'default',
							),
							array(
								'setting'  => 'blog_style',
								'operator' => '!=',
								'value'    => 'classic',
							),array(
								'setting'  => 'show_featured',
								'operator' => '==',
								'value'    => '1',
							),
						)

					),	
					'blog_thumbsize' => array(
						'label'=> __( 'Thumbnail size', THEME_NAME ),
						'type'        => 'select',
						'default'        => 'medium',
						'choices'     => $thumbsizes,
						'active_callback'    => array(
							array(
								'setting'  => 'blog_post_template',
								'operator' => '==',
								'value'    => 'default',
							),
							array(
								'setting'  => 'blog_style',
								'operator' => '!=',
								'value'    => 'classic',
							),array(
								'setting'  => 'show_featured',
								'operator' => '==',
								'value'    => '1',
							),array(
								'setting'  => 'blog_thumb_position',
								'operator' => '!=',
								'value'    => 'left',
							),array(
								'setting'  => 'blog_thumb_position',
								'operator' => '!=',
								'value'    => 'right',
							),
						)
						
					),
					
					'blog_thumb_columns'=>array(
						'type'        => 'select',
						'label'       => __( 'Thumbnail Columns', THEME_NAME ),
						'type'        => 'slider',
						'default'     => 3,
						'choices'     => array(
							'min'  => '1',
							'max'  => '11',
							'step' => '1',
						),
						'active_callback'    => array(
							array(
								'setting'  => 'blog_post_template',
								'operator' => '==',
								'value'    => 'default',
							),
							array(
								'setting'  => 'blog_thumb_position',
								'operator' => '!=',
								'value'    => 'top',
							),
							array(
								'setting'  => 'blog_thumb_position',
								'operator' => '!=',
								'value'    => 'bottom',
							),
							array(
								'setting'  => 'blog_style',
								'operator' => '!=',
								'value'    => 'classic',
							),array(
								'setting'  => 'show_featured',
								'operator' => '==',
								'value'    => '1',
							),
						)

					),		
										
					'blog_featured_border_radius' => array(
						'label'=> __( 'Thumbnail border radius', THEME_NAME ),
						'type'        => 'slider',
						'default'     => 0,
						'choices'     => array(
							'min'  => '0',
							'max'  => '200',
							'step' => '1',
						),
						'active_callback'    => array(
							array(
								'setting'  => 'blog_post_template',
								'operator' => '==',
								'value'    => 'default',
							),
							array(
								'setting'  => 'blog_style',
								'operator' => '!=',
								'value'    => 'classic',
							),array(
								'setting'  => 'show_featured',
								'operator' => '==',
								'value'    => '1',
							),
						),
						'output' => array(
							array(
								'element'  => '.blog article .article-featured',
								'property' => 'border-radius',
								'units' =>'px'
							)
						)
					),
					
				)
			),

			//BLOG POST section
			'blog_post_section' =>array(
				'title' => __( 'Single Posts', THEME_NAME ),
				'active_callback' => function () { 
					return is_singular('post');
				},
				'fields' => array(
					'single_post_template'=>array(
						'type'        => 'select',
						'label'       => __( 'Post Template', THEME_NAME ),
						'default'     => 'default',
						'multiple'    => false,
						'choices'     => carrot_get_post_templates()

					),
					'single_post_show_title' => array(
						'type'        => 'toggle',
						'label'       => __( 'Show Title', THEME_NAME ),
						'default'     => '1'

					),
					'single_post_show_breadcrumb' => array(
						'type'        => 'toggle',
						'label'       => __( 'Show Breadcrumb', THEME_NAME ),
						'default'     => '1'

					),
					'single_post_show_navigation'=>array(
						'type'        => 'toggle',
						'label'       => __( 'Show navigation (next and previous)', THEME_NAME ),
						'description'       => __( 'Only if supported by the selected layout', THEME_NAME ),
						'default'     => '0'

					),
					'single_post_show_related'=>array(
						'type'        => 'toggle',
						'label'       => __( 'Show related', THEME_NAME ),
						'description'       => __( 'Only if supported by the selected layout', THEME_NAME ),
						'default'     => '0'

					),
					'single_post_show_featured'=>array(
						'type'        => 'toggle',
						'label'       => __( 'Show featured image', THEME_NAME ),
						'description'       => __( 'Only if supported by the selected layout', THEME_NAME ),
						'default'     => '0'

					)

				)
			),
			//ARCHIVE section
			'archive_section' =>array(
				'title' => __( 'Archive', THEME_NAME ),
				'active_callback' => function () { 
					if(carrot_is_woocommerce_activated() && (is_shop())) return false;
					
					return is_archive() || is_search() ;
				},
				'fields' => array(
					'archive_style'=>array(
						'type'        => 'select',
						'label'       => __( 'Archive Style', THEME_NAME ),
						'default'     => 'list',
						'multiple'    => false,
						'choices'     => array(
							'list' => esc_attr__( 'List', THEME_NAME ),
							'grid' => esc_attr__( 'Grid', THEME_NAME )
							
						)

					),
					'archive_show_header' => array(
						'type'        => 'toggle',
						'label'       => __( 'Show Archive Header', THEME_NAME ),
						'default'     => '1'

					),
					'archive_sidebar'=>array(
						'type'        => 'select',
						'label'       => __( 'Sidebar', THEME_NAME ),
						'default'     => 'no',
						'multiple'    => false,
						'choices'     => array(
							'no' => esc_attr__( 'No sidebar', THEME_NAME ),
							'left' => esc_attr__( 'Left sidebar', THEME_NAME ),
							'right' => esc_attr__( 'Right sidebar', THEME_NAME ),
							'bottom' => esc_attr__( 'Bottom bar', THEME_NAME )
						)

					),
					'archive_pagination_style'=>array(
						'type'        => 'select',
						'label'       => __( 'Pagination', THEME_NAME ),
						'default'     => 'classic',
						'multiple'    => false,
						'choices'     => array(
							'none' => esc_attr__( 'No pagination', THEME_NAME ),
							'classic' => esc_attr__( 'Classic (next/prev)', THEME_NAME ),
							'pagenumbers' => esc_attr__( 'Page numbers', THEME_NAME )
						)

					),
					'archive_sidebar_columns' => array(
						'type'        => 'number',
						'label'       => __( 'Sidebar Columns', THEME_NAME ),
						'default'     => 3,
						'choices'     => array(
							'min'  => 1,
							'max'  => 6,
							'step' => 1,
						),
						'active_callback'    => array(
							array(
								'setting'  => 'archive_sidebar',
								'operator' => '==',
								'value'    => 'bottom',
							),
						)

					),
					'archive_columns' => array(
						'type'        => 'number',
						'label'       => __( 'Grid Columns', THEME_NAME ),
						'default'     => 3,
						'choices'     => array(
							'min'  => 1,
							'max'  => 6,
							'step' => 1,
						),
						'active_callback'    => array(
							array(
								'setting'  => 'archive_style',
								'operator' => '==',
								'value'    => 'grid',
							),
						)

					),
					'archive_tile_gap'=>array(
						'type'        => 'select',
						'label'       => __( 'Articles gap', THEME_NAME ),
						'default'     => 'medium',
						'multiple'    => false,
						'choices'     => carrot_availableGaps(),
						'active_callback'    => array(
							array(
								'setting'  => 'archive_style',
								'operator' => '!=',
								'value'    => 'classic',
							)
						)

					),	
					'archive_post_template'=>array(
						'type'        => 'select',
						'label'       => __( 'Tile Template', THEME_NAME ),
						'default'     => 'default',
						'multiple'    => false,
						'choices'     => carrot_get_post_templates(true)

					),
					'archive_article_border' => array(
						'label'=> __( 'Articles border', THEME_NAME ),
						'type'        => 'slider',
						'default'     => 0,
						'choices'     => array(
							'min'  => '0',
							'max'  => '10',
							'step' => '1',
						),
						'output' => array(
							array(
								'element'  => 'body.archive .articles-container article > .article-inner, body.search .articles-container article > .article-inner',
								'property' => 'border-width',
								'units' =>'px'
							)
						),
						'active_callback'    => array(
							array(
								'setting'  => 'archive_post_template',
								'operator' => '==',
								'value'    => 'default',
							)
						)
					),
					
					'archive_featured' => array(
						'type'        => 'toggle',
						'label'       => __( 'Show Thumbnail', THEME_NAME ),
						'default'     => '1',
						'active_callback'    => array(
							array(
								'setting'  => 'archive_post_template',
								'operator' => '==',
								'value'    => 'default',
							)
						)

					),
					'archive_title' => array(
						'type'        => 'toggle',
						'label'       => __( 'Show Title', THEME_NAME ),
						'default'     => '1',
						'active_callback'    => array(
							array(
								'setting'  => 'archive_post_template',
								'operator' => '==',
								'value'    => 'default',
							),
							array(
								'setting'  => 'archive_style',
								'operator' => '!=',
								'value'    => 'classic',
							),
						)
					),
					'archive_date' => array(
						'type'        => 'toggle',
						'label'       => __( 'Show Date', THEME_NAME ),
						'default'     => '1',
						'active_callback'    => array(
							array(
								'setting'  => 'archive_post_template',
								'operator' => '==',
								'value'    => 'default',
							),
							array(
								'setting'  => 'archive_style',
								'operator' => '!=',
								'value'    => 'classic',
							),
						)
					),
					'archive_excerpt' => array(
						'type'        => 'toggle',
						'label'       => __( 'Show Excerpt', THEME_NAME ),
						'default'     => '1',
						'active_callback'    => array(
							array(
								'setting'  => 'archive_post_template',
								'operator' => '==',
								'value'    => 'default',
							),
							array(
								'setting'  => 'archive_style',
								'operator' => '!=',
								'value'    => 'classic',
							),
						)
					),
					
					'archive_author' => array(
						'type'        => 'toggle',
						'label'       => __( 'Show Author', THEME_NAME ),
						'default'     => '1',
						'active_callback'    => array(
							array(
								'setting'  => 'archive_post_template',
								'operator' => '==',
								'value'    => 'default',
							),
							array(
								'setting'  => 'archive_style',
								'operator' => '!=',
								'value'    => 'classic',
							),
						)
					),
					
					'archive_content' => array(
						'type'        => 'toggle',
						'label'       => __( 'Show Content', THEME_NAME ),
						'default'     => '0',
						'active_callback'    => array(
							array(
								'setting'  => 'archive_post_template',
								'operator' => '==',
								'value'    => 'default',
							),
							array(
								'setting'  => 'archive_style',
								'operator' => '!=',
								'value'    => 'classic',
							),
						)
					),
					'archive_categories' => array(
						'type'        => 'toggle',
						'label'       => __( 'Show Categories', THEME_NAME ),
						'default'     => '0',
						'active_callback'    => array(
							array(
								'setting'  => 'archive_post_template',
								'operator' => '==',
								'value'    => 'default',
							),
							array(
								'setting'  => 'archive_style',
								'operator' => '!=',
								'value'    => 'classic',
							),
						)
					),
					'archive_comments' => array(
						'type'        => 'toggle',
						'label'       => __( 'Show Comments', THEME_NAME ),
						'default'     => '0',
						'active_callback'    => array(
							array(
								'setting'  => 'archive_post_template',
								'operator' => '==',
								'value'    => 'default',
							),
							array(
								'setting'  => 'archive_style',
								'operator' => '!=',
								'value'    => 'classic',
							),
						)
					),
					'archive_thumb_position'=>array(
						'type'        => 'select',
						'label'       => __( 'Thumbnail position', THEME_NAME ),
						'default'     => 'left',
						'multiple'    => false,
						'choices'     => array(
							'left' => esc_attr__( 'Left', THEME_NAME ),
							'right' => esc_attr__( 'Right', THEME_NAME ),
							'top' => esc_attr__( 'Top', THEME_NAME ),
							'bottom' => esc_attr__( 'Bottom', THEME_NAME )
						),
						'active_callback'    => array(
							array(
								'setting'  => 'archive_post_template',
								'operator' => '==',
								'value'    => 'default',
							),
							array(
								'setting'  => 'archive_style',
								'operator' => '!=',
								'value'    => 'classic',
							),array(
								'setting'  => 'archive_featured',
								'operator' => '==',
								'value'    => '1',
							),
						)

					),	

					'archive_thumbsize' => array(
						'label'=> __( 'Thumbnail size', THEME_NAME ),
						'type'        => 'select',
						'default'        => 'medium',
						'choices'     => $thumbsizes,
						'active_callback'    => array(
							array(
								'setting'  => 'archive_post_template',
								'operator' => '==',
								'value'    => 'default',
							),
							array(
								'setting'  => 'archive_style',
								'operator' => '!=',
								'value'    => 'classic',
							),array(
								'setting'  => 'archive_featured',
								'operator' => '==',
								'value'    => '1',
							),array(
								'setting'  => 'archive_thumb_position',
								'operator' => '!=',
								'value'    => 'left',
							),array(
								'setting'  => 'archive_thumb_position',
								'operator' => '!=',
								'value'    => 'right',
							),
						)
						
					),	
					'archive_thumb_columns'=>array(
						'type'        => 'select',
						'label'       => __( 'Thumbnail Columns', THEME_NAME ),
						'type'        => 'slider',
						'default'     => 3,
						'choices'     => array(
							'min'  => '1',
							'max'  => '11',
							'step' => '1',
						),
						'active_callback'    => array(
							array(
								'setting'  => 'archive_post_template',
								'operator' => '==',
								'value'    => 'default',
							),
							array(
								'setting'  => 'archive_thumb_position',
								'operator' => '!=',
								'value'    => 'top',
							),
							array(
								'setting'  => 'archive_thumb_position',
								'operator' => '!=',
								'value'    => 'bottom',
							),
							array(
								'setting'  => 'archive_style',
								'operator' => '!=',
								'value'    => 'classic',
							),array(
								'setting'  => 'archive_featured',
								'operator' => '==',
								'value'    => '1',
							),
						)

					),	
					
					'archive_featured_border_radius' => array(
						'label'=> __( 'Thumbnail border radius', THEME_NAME ),
						'type'        => 'slider',
						'default'     => 0,
						'choices'     => array(
							'min'  => '0',
							'max'  => '200',
							'step' => '1',
						),
						'active_callback'    => array(
							array(
								'setting'  => 'archive_post_template',
								'operator' => '==',
								'value'    => 'default',
							),
							array(
								'setting'  => 'archive_featured',
								'operator' => '==',
								'value'    => '1',
							),
						),
						'output' => array(
							array(
								'element'  => '.archive  article .article-featured',
								'property' => 'border-radius',
								'units' =>'px'
							)
						)
					),
					
				)
			),
			'woocommerce_section' => array(
				'title' => __( 'Woocommerce', THEME_NAME ),
				'description' => __( 'Customize woocommerce options.', THEME_NAME ),
				'active_callback' => function () { 
					return carrot_is_woocommerce_activated() && is_shop()  ;
				},
				'fields' => array(
					'woo_style'=>array(
						'type'        => 'select',
						'label'       => __( 'Shop Style', THEME_NAME ),
						'default'     => 'classic',
						'multiple'    => false,
						'choices'     => array(
							'list' => esc_attr__( 'List', THEME_NAME ),
							'grid' => esc_attr__( 'Grid', THEME_NAME )
							
						)

					),
					'woo_fullwidth' => array(
						'label'=> __( 'Shop full width', THEME_NAME ),
						'type' => 'toggle',
						'default'=>'0'
					),
					'show_woo_title' => array(
						'label'=> __( 'Show title', THEME_NAME ),
						'type' => 'toggle',
						'default'=>'0'
					),
					'show_woo_breadcrumb' => array(
						'label'=> __( 'Show breadcrumb', THEME_NAME ),
						'type' => 'toggle',
						'default'=>'0'
					),
					'woo_columns' => array(
						'type'        => 'number',
						'label'       => __( 'Grid Columns', THEME_NAME ),
						'default'     => 3,
						'choices'     => array(
							'min'  => 1,
							'max'  => 6,
							'step' => 1,
						),
						'active_callback'    => array(
							array(
								'setting'  => 'woo_style',
								'operator' => '==',
								'value'    => 'grid',
							),
						)

					),
					'woo_sidebar'=>array(
						'type'        => 'select',
						'label'       => __( 'Sidebar', THEME_NAME ),
						'default'     => 'no',
						'multiple'    => false,
						'choices'     => array(
							'no' => esc_attr__( 'No sidebar', THEME_NAME ),
							'left' => esc_attr__( 'Left sidebar', THEME_NAME ),
							'right' => esc_attr__( 'Right sidebar', THEME_NAME )
						)

					),
					
					'woo_tile_gap'=>array(
						'type'        => 'select',
						'label'       => __( 'Articles gap', THEME_NAME ),
						'default'     => 'medium',
						'multiple'    => false,
						'choices'     => carrot_availableGaps()

					),	
					
					'woo_article_border' => array(
						'label'=> __( 'Products border', THEME_NAME ),
						'type'        => 'slider',
						'default'     => 0,
						'choices'     => array(
							'min'  => '0',
							'max'  => '10',
							'step' => '1',
						),
						'output' => array(
							array(
								'element'  => 'body.woocommerce .articles-container article  > .article-inner',
								'property' => 'border-width',
								'units' =>'px'
							)
						)
					),
				),
			),
			//woocommerce single section
			'woocommerce_single_section' => array(
				'title' => __( 'Woocommerce Product', THEME_NAME ),
				'active_callback' => function () { 
					//_dump(is_product()?"PRODUCTXXX":"NOTXXXX");
					return carrot_is_woocommerce_activated() &&  is_product() ;
				},
				'fields' => array(
					'woo_single_fullwidth' => array(
						'label'=> __( 'Full width', THEME_NAME ),
						'type' => 'toggle',
						'default'=>'0'
					),
					'show_woo_single_title' => array(
						'label'=> __( 'Show title', THEME_NAME ),
						'type' => 'toggle',
						'default'=>'1'
					),
					'show_woo_single_breadcrumb' => array(
						'label'=> __( 'Show breadcrumb', THEME_NAME ),
						'type' => 'toggle',
						'default'=>'1'
					),
					'show_woo_single_related' => array(
						'label'=> __( 'Show related', THEME_NAME ),
						'type' => 'toggle',
						'default'=>'1'
					),
				
				)
			)
		)
	),
	
	
	


);
