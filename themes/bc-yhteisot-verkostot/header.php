<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="bc-header">
    <a href="<?php echo esc_url(home_url('/')); ?>">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/bc-logo.png" alt="Business Collage Helsinki">
</a>
<nav class="bc-nav">
    <ul>
        <li><a href="<?php echo esc_url(home_url('/')); ?>">Etusivu</a></li>
        <li><a href="<?php echo esc_url(home_url('/verkostot/')); ?>">Verkostot</a></li>
    <li><a href="<?php echo esc_url(home_url('/tietoja-meista/')); ?>">Tietoja meistä</a></li>
</ul>
</header>
    
</body>
</html>