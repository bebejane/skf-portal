<!doctype html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php wp_title(''); ?></title>

		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/library/icons/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/library/icons/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/library/icons/favicon-16x16.png">
		<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/library/icons/site.webmanifest">
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/library/icons/favicon.ico">
		<meta name="msapplication-TileColor" content="#e35632">
		<meta name="msapplication-config" content="<?php echo get_template_directory_uri(); ?>/library/icons/browserconfig.xml">
		<meta name="theme-color" content="#ffffff">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php wp_head(); ?>

	</head>

	<body <?php
				$post_id = get_the_ID();
				$post_type = get_post_type( $post_id );
				$post_obj = get_post_type_object($post_type);
				body_class();
	?>>

	   <!--[if lt IE 7]>
          <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
      <![endif]-->

			<div class="margin-wrapper">
			<div class="outer-container">
			<div class="container">
			<nav class="logo">
				<a href="/">
					<h1 class="section-color icon">O</h1>
				</a>
			</nav>

			<nav class="top">
				<div class="top-wrapper menu-header">
					<h1 class="section-color">Konstföreningsportalen</h1>
					<p class="small">En tjänst från<br> Sveriges Konstföreningar<br>
					<a href="http:/www.sverigeskonstforeningar.nu">Läs mer om oss</a>
				</p>
				</div>
			</nav>

			<main>
