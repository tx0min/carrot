<?php
/**
  * The header
 * @package Carrot Theme
 */
  
?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if (!IE)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->


<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	
	<title><?php carrot_the_title(); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<meta name="application-name" content="<?php bloginfo( 'name' ); ?>"/>
	
	<?php

		wp_head();
		
		//$bodyclass=array();
		
		
		//$bodyclass[]='site-loading';
		
	?>

</head>

<body <?php body_class(); ?> >
	
	<?php carrot_site_preloader(); ?>
	
	<div id="wrapper">
		
		<?php
			carrot_get_template_part("header/header");
			carrot_get_template_part("header/header-sticky");
			carrot_get_template_part("header/phone-menu");
			
		?>

		
		
		<div id="body">
			<div class="container">
