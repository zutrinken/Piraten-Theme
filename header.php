<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

	<head profile="http://gmpg.org/xfn/11">
		<title><?php bloginfo('name'); ?> <?php wp_title(' - ', true, 'left'); ?></title>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta name="description" content="<?php bloginfo('description'); ?>" />
		<meta name="author" content="Peter Amende - www.peteramende.de" />
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

		<?php if( is_single( ) || is_page( ) || is_category( ) || is_home( )) { ?><meta name="robots" content="all, noodp" /><?php } ?>
		<?php if( is_archive( )) { ?><meta name="robots" content="noarchive, noodp" /><?php } ?>
		<?php if( is_search( ) || is_404( )) { ?><meta name="robots" content="noindex, noarchive" /><?php } ?>

		<link type="text/css" rel="stylesheet" href="<?php bloginfo('stylesheet_url');?>" media="screen" />
		<link rel="Shortcut Icon" type="image/x-icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<link rel='canonical' href='<?php bloginfo('url'); ?>' />
		<link rel='index' title='<?php bloginfo('description'); ?>' href='<?php bloginfo('url'); ?>' />
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/libs/modernizr-1.7.min.js"></script>

		<?php wp_head(); ?>

	</head>

	<body>
		<div id="wrapper">
			<header id="header">
				<span id="name"><a title="<?php bloginfo('name'); ?>" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></span>
				<span id="description"><?php bloginfo('description'); ?></span>
			</header>
			<div id="top">
				<nav id="main_navigation">
					<?php wp_nav_menu(array('theme_location'=>'header')); ?>
				</nav>
			</div>