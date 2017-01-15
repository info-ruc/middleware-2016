
<?php
/**
 * Custom theme functions.
 *
 * This file contains hook functions attached to theme hooks.
 *
 * @package Magazine_Plus
 */

if ( ! function_exists( 'magazine_plus_skip_to_content' ) ) :

	/**
	 * Add Skip to content.
	 *
	 * @since 1.0.0
	 */
	function magazine_plus_skip_to_content() {
		?><a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'magazine-plus' ); ?></a><?php
	}
endif;

add_action( 'magazine_plus_action_before', 'magazine_plus_skip_to_content', 15 );

if ( ! function_exists( 'magazine_plus_site_branding' ) ) :

	/**
	 * Site branding.
	 *
	 * @since 1.0.0
	 */
	function magazine_plus_site_branding() {
		?>
	    <div class="site-branding">

			<?php magazine_plus_the_custom_logo(); ?>

			<?php $show_title = magazine_plus_get_option( 'show_title' ); ?>
			<?php $show_tagline = magazine_plus_get_option( 'show_tagline' ); ?>
			<?php if ( true === $show_title || true === $show_tagline ) : ?>
				<div id="site-identity">
					<?php if ( true === $show_title ) : ?>
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif; ?>
					<?php endif; ?>
					<?php if ( true === $show_tagline ) : ?>
						<p class="site-description"><?php bloginfo( 'description' ); ?></p>
					<?php endif; ?>
				</div><!-- #site-identity -->
			<?php endif; ?>
	    </div><!-- .site-branding -->
	    <div id="header-ads">
		    <?php if ( is_active_sidebar( 'header-right' ) ) : ?>
		    	<div id="header-right-widget-area">
			    	<?php dynamic_sidebar( 'header-right' ); ?>
		    	</div><!-- #header-right-widget-area -->
		    <?php endif; ?>

	    </div><!-- .right-header -->
	    <?php
	}

endif;

add_action( 'magazine_plus_action_header', 'magazine_plus_site_branding' );

if ( ! function_exists( 'magazine_plus_add_primary_navigation' ) ) :

	/**
	 * Primary navigation.
	 *
	 * @since 1.0.0
	 */
	function magazine_plus_add_primary_navigation() {
		?>
	    <div id="main-nav" class="clear-fix">
	    	<div class="container">
		        <nav id="site-navigation" class="main-navigation" role="navigation">
		            <div class="wrap-menu-content">
						<?php
						wp_nav_menu(
							array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'fallback_cb'    => 'magazine_plus_primary_navigation_fallback',
							)
						);
						?>
		            </div><!-- .menu-content -->
		        </nav><!-- #site-navigation -->
		        <div class="header-search-box">
		        	<a href="#" class="search-icon"><i class="fa fa-search"></i></a>
		        	<div class="search-box-wrap">
		        		<?php get_search_form(); ?>
		        	</div><!-- .search-box-wrap -->
		        </div><!-- .header-search-box -->

	        </div> <!-- .container -->
	    </div> <!-- #main-nav -->
		<?php
	}
endif;

add_action( 'magazine_plus_action_after_header', 'magazine_plus_add_primary_navigation', 20 );

if ( ! function_exists( 'magazine_plus_mobile_navigation' ) ) :

	/**
	 * Mobile navigation.
	 *
	 * @since 1.0.0
	 */
	function magazine_plus_mobile_navigation() {
		?>
		<div class="mobile-nav-wrap">
			<a id="mobile-trigger" href="#mob-menu"><i class="fa fa-bars"></i></a>
			<div id="mob-menu">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => '',
					'fallback_cb'    => 'magazine_plus_primary_navigation_fallback',
					) );
				?>
			</div><!-- #mob-menu -->

			<?php if ( has_nav_menu( 'top' ) ) : ?>
				<a id="mobile-trigger2" href="#mob-menu2"><i class="fa fa-bars"></i></a>
				<div id="mob-menu2">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'top',
						'container'      => '',
						) );
					?>
				</div><!-- #mob-menu -->
			<?php endif; ?>
		</div> <!-- mobile-nav-wrap -->
		<?php
	}

endif;

add_action( 'magazine_plus_action_before', 'magazine_plus_mobile_navigation', 20 );

if ( ! function_exists( 'magazine_plus_footer_copyright' ) ) :

	/**
	 * Footer copyright.
	 *
	 * @since 1.0.0
	 */
	function magazine_plus_footer_copyright() {

		// Check if footer is disabled.
		$footer_status = apply_filters( 'magazine_plus_filter_footer_status', true );
		if ( true !== $footer_status ) {
			return;
		}

		// Footer menu.
		$footer_menu_content = wp_nav_menu( array(
			'theme_location' => 'footer',
			'container'      => 'div',
			'container_id'   => 'footer-navigation',
			'depth'          => 1,
			'fallback_cb'    => false,
			'echo'           => false,
		) );

		// Copyright content.
		$copyright_text = magazine_plus_get_option( 'copyright_text' );
		$copyright_text = apply_filters( 'magazine_plus_filter_copyright_text', $copyright_text );
		if ( ! empty( $copyright_text ) ) {
			$copyright_text = wp_kses_data( $copyright_text );
		}

		// Powered by content.
		$powered_by_text = sprintf( __( 'Magazine Plus by %s', 'magazine-plus' ), '<a target="_blank" rel="designer" href="http://wenthemes.com/">' . __( 'WEN Themes', 'magazine-plus' ) . '</a>' );

		$column_count = 0;

		if ( $footer_menu_content ) {
			$column_count++;
		}
		if ( $copyright_text ) {
			$column_count++;
		}
		if ( $powered_by_text ) {
			$column_count++;
		}
		?>

		<div class="colophon-inner colophon-grid-<?php echo esc_attr( $column_count ); ?>">

		    <?php if ( ! empty( $copyright_text ) ) : ?>
			    <div class="colophon-column">
			    	<div class="copyright">
			    		<?php echo $copyright_text; ?>
			    	</div><!-- .copyright -->
			    </div><!-- .colophon-column -->
		    <?php endif; ?>

		    <?php if ( ! empty( $footer_menu_content ) ) : ?>
		    	<div class="colophon-column">
					<?php echo $footer_menu_content; ?>
		    	</div><!-- .colophon-column -->
		    <?php endif; ?>

		    <?php if ( ! empty( $powered_by_text ) ) : ?>
			    <div class="colophon-column">
			    	<div class="site-info">
			    		<?php echo $powered_by_text; ?>
			    	</div><!-- .site-info -->
			    </div><!-- .colophon-column -->
		    <?php endif; ?>

		</div><!-- .colophon-inner -->

	    <?php
	}

endif;

add_action( 'magazine_plus_action_footer', 'magazine_plus_footer_copyright', 10 );


if ( ! function_exists( 'magazine_plus_add_sidebar' ) ) :

	/**
	 * Add sidebar.
	 *
	 * @since 1.0.0
	 */
	function magazine_plus_add_sidebar() {

		global $post;

		$global_layout = magazine_plus_get_option( 'global_layout' );
		$global_layout = apply_filters( 'magazine_plus_filter_theme_global_layout', $global_layout );

		// Include primary sidebar.
		if ( 'no-sidebar' !== $global_layout ) {
			get_sidebar();
		}
		// Include Secondary sidebar.
		switch ( $global_layout ) {
		  case 'three-columns':
		    get_sidebar( 'secondary' );
		    break;

		  default:
		    break;
		}

	}

endif;

add_action( 'magazine_plus_action_sidebar', 'magazine_plus_add_sidebar' );


if ( ! function_exists( 'magazine_plus_custom_posts_navigation' ) ) :

	/**
	 * Posts pagination.
	 *
	 * @since 1.0.0
	 */
	function magazine_plus_custom_posts_navigation() {

		the_posts_pagination();

	}
endif;

add_action( 'magazine_plus_action_posts_navigation', 'magazine_plus_custom_posts_navigation' );


if ( ! function_exists( 'magazine_plus_add_image_in_single_display' ) ) :

	/**
	 * Add image in single.
	 *
	 * @since 1.0.0
	 */
	function magazine_plus_add_image_in_single_display() {

		if ( has_post_thumbnail() ) {
			$args = array(
				'class' => 'aligncenter',
			);
			the_post_thumbnail( 'large', $args );
		}

	}

endif;

add_action( 'magazine_plus_single_image', 'magazine_plus_add_image_in_single_display' );

if ( ! function_exists( 'magazine_plus_add_breadcrumb' ) ) :

	/**
	 * Add breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function magazine_plus_add_breadcrumb() {

		// Bail if Home Page.
		if ( is_front_page() || is_home() ) {
			return;
		}

		echo '<div id="breadcrumb"><div class="container">';
		magazine_plus_simple_breadcrumb();
		echo '</div><!-- .container --></div><!-- #breadcrumb -->';

	}

endif;

add_action( 'magazine_plus_action_before_content', 'magazine_plus_add_breadcrumb', 7 );

if ( ! function_exists( 'magazine_plus_footer_goto_top' ) ) :

	/**
	 * Go to top.
	 *
	 * @since 1.0.0
	 */
	function magazine_plus_footer_goto_top() {
		echo '<a href="#page" class="scrollup" id="btn-scrollup"><i class="fa fa-angle-up"></i></a>';
	}

endif;

add_action( 'magazine_plus_action_after', 'magazine_plus_footer_goto_top', 20 );

if ( ! function_exists( 'magazine_plus_check_home_page_content' ) ) :

	/**
	 * Check home page content status.
	 *
	 * @since 1.0.0
	 *
	 * @param bool $status Home page content status.
	 * @return bool Modified home page content status.
	 */
	function magazine_plus_check_home_page_content( $status ) {

		if ( is_front_page() ) {
			$home_content_status = magazine_plus_get_option( 'home_content_status' );
			if ( false === $home_content_status ) {
				$status = false;
			}
		}
		return $status;

	}

endif;

add_filter( 'magazine_plus_filter_home_page_content', 'magazine_plus_check_home_page_content' );

if ( ! function_exists( 'magazine_plus_header_top_content' ) ) :

	/**
	 * Render top head.
	 *
	 * @since 1.0.0
	 */
	function magazine_plus_header_top_content() {
		$show_ticker = magazine_plus_get_option( 'show_ticker' );
		$show_date   = magazine_plus_get_option( 'show_date' );

		if (
			false === $show_date &&
			false === $show_ticker &&
			false === has_nav_menu( 'top' ) &&
			! ( true === magazine_plus_get_option( 'show_social_in_header' ) && has_nav_menu( 'social' ) )
			) {
			return;
		}
		?>
		<div id="tophead">
			<div class="container">
				<?php if ( true === $show_date ) : ?>
					<div class="head-date">
						<?php echo date_i18n( _x( 'd M, Y', 'Date Format', 'magazine-plus' ) ); ?>
					</div><!-- .head-date -->
				<?php endif; ?>
				<?php if ( true === $show_ticker ) : ?>
					<div class="top-news">
						<span class="top-news-title">
						<?php $ticker_title = magazine_plus_get_option( 'ticker_title' );  ?>
						<?php echo ( ! empty( $ticker_title ) ) ? esc_html( $ticker_title ) : '&nbsp;'; ?>
						</span>
						<?php echo magazine_plus_get_news_ticker_content(); ?>
					</div> <!-- #top-news -->
				<?php endif; ?>

				<?php if ( true === magazine_plus_get_option( 'show_social_in_header' ) && has_nav_menu( 'social' ) ) : ?>
			    	<div class="header-social">
				    	<?php the_widget( 'Magazine_Plus_Social_Widget' ); ?>
			    	</div><!-- .header-social -->
				<?php endif; ?>
				<?php if ( has_nav_menu( 'top' ) ) : ?>
					<div id="top-nav">
						<?php
							wp_nav_menu(
								array(
									'theme_location'  => 'top',
									'container'       => 'nav',
									'container_class' => 'top-navigation',
									'depth'           => 2,
									'fallback_cb'     => false,
								)
							);
						 ?>
					</div> <!-- #top-nav -->
				<?php endif; ?>



			</div><!-- .container -->
		</div><!-- #tophead -->
		<?php
	}

endif;

add_action( 'magazine_plus_action_before_header', 'magazine_plus_header_top_content', 5 );

if ( ! function_exists( 'magazine_plus_add_default_message_front_widgets' ) ) :

	/**
	 * Add default message in front widget area.
	 *
	 * @since 1.0.0
	 */
	function magazine_plus_add_default_message_front_widgets() {

		if ( ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}

		// Default message.
		$args = array(
			'title' => esc_html__( 'Welcome to Magazine Plus', 'magazine-plus' ),
			'text'  => esc_html__( 'You are seeing this because there is no any widget in Front Page Widget Area. To add widgets, go to Appearance->Widgets in admin panel. This message will disappear when you add widgets.', 'magazine-plus' ),
		);
		$widget_args = array(
			'before_title' => '<h2 class="widget-title">',
			'after_title'  => '</h2>',
		);
		the_widget( 'WP_Widget_Text', $args, $widget_args );

	}

endif;

add_action( 'magazine_plus_action_default_front_page_widget_area', 'magazine_plus_add_default_message_front_widgets' );
