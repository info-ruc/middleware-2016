<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
    
<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
   
    <?php wp_head(); ?> 
    
</head>

<body <?php body_class(); ?> >

    <div id="container">   

        <div id="header">            
            
            <div id="logotext">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a>
                <p><?php bloginfo('description');?></p>
            </div> 
        
        </div><!-- #header -->
        
        <!-- Menu navigation -->
        <div id="nav">        
            <?php $nav_menu = array( 'theme_location'  => 'top-navigation' );
            wp_nav_menu( $nav_menu ); ?>
        </div>
        
        <div id="center">
        
            <div id="content">