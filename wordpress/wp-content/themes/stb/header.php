<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Surface Transportation Board</title>
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
      <!-- Custom styles for this template -->
      <link href="<?php bloginfo('template_directory'); ?>/css/style.css" rel="stylesheet">
      <!-- Fonts for this template -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Vollkorn" rel="stylesheet">

      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

      <?php wp_head(); ?>
   </head>
   <body>
      <div class="usa">
        <div class="stb-wrapper">
          <img class="usa-flag_icon " alt="U.S. flag signifying that this is a United States Federal government website" src="<?php bloginfo('template_url'); ?>/images/us_flag_small.png" />
          An official website of the United States government
        </div>
      </div>
      <div class="stb-masthead">
        <div class="stb-wrapper">
          <a href="/"><img class="stb-logo" alt="STB Logo" src="<?php bloginfo('template_url'); ?>/images/logo-seal.png"></a>
          <!--<h1 class="stb-title footer-title" style="font-family: Arial, Helvetica, sans-serif; font-size: 1.75em; padding-right: 20px; top: 15px;"><a href="<?php //bloginfo( 'wpurl' );?>"><?php //echo strtoupper(get_bloginfo( 'name' )); ?></a></h1> -->
	        <a href="#" class="menu-trigger"><button class="hamburger">&#x2630;</button>
          <button class="cross" style="display:none;">&#x2715;</button></a>
          <nav class=" stb-nav unsetpaddingleft margin-left navbar-collapse" id="main-nav">
          <!-- <div class="collapse navbar-collapse" id="main-nav"> -->
          <?php wp_nav_menu( array(
             'sort_column' => 'STB',
             'theme_location' => 'STB',
             // 'container_class'   => 'navbar-content nav-collapse collapse',
             // 'menu_class'        => 'nav nav-tabs pull-right',
             // 'menu_id'           => 'main-menu'
          ) ); ?>

        </nav>
      </div>
      </div>
      <div class="index-background">
      <div class="container">
