<?php
/**
 * Theme widgets.
 *
 * @package Magazine_Plus
 */

// Load widget base.
require_once get_template_directory() . '/lib/widget-base/class-widget-base.php';

if ( ! function_exists( 'magazine_plus_load_widgets' ) ) :

	/**
	 * Load widgets.
	 *
	 * @since 1.0.0
	 */
	function magazine_plus_load_widgets() {

		// Social widget.
		register_widget( 'Magazine_Plus_Social_Widget' );

		// Image widget.
		register_widget( 'Magazine_Plus_Image_Widget' );

		// Featured Page widget.
		register_widget( 'Magazine_Plus_Featured_Page_Widget' );

		// Latest News widget.
		register_widget( 'Magazine_Plus_Latest_News_Widget' );

		// Recent Posts widget.
		register_widget( 'Magazine_Plus_Recent_Posts_Widget' );

		// News Slider widget.
		register_widget( 'Magazine_Plus_News_Slider_Widget' );

		// Tabbed widget.
		register_widget( 'Magazine_Plus_Tabbed_Widget' );

	}

endif;

add_action( 'widgets_init', 'magazine_plus_load_widgets' );

if ( ! class_exists( 'Magazine_Plus_Social_Widget' ) ) :

	/**
	 * Social widget Class.
	 *
	 * @since 1.0.0
	 */
	class Magazine_Plus_Social_Widget extends Magazine_Plus_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'magazine_plus_widget_social',
				'description'                 => __( 'Displays social icons.', 'magazine-plus' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'magazine-plus' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				);

			if ( false === has_nav_menu( 'social' ) ) {
				$fields['message'] = array(
					'label' => __( 'Social menu is not set. Please create menu and assign it to Social Menu.', 'magazine-plus' ),
					'type'  => 'message',
					'class' => 'widefat',
					);
			}

			parent::__construct( 'magazine-plus-social', __( 'MP: Social', 'magazine-plus' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . $params['title'] . $args['after_title'];
			}

			$nav_menu_locations = get_nav_menu_locations();
			$menu_id = 0;
			if ( isset( $nav_menu_locations['social'] ) && absint( $nav_menu_locations['social'] ) > 0 ) {
				$menu_id = absint( $nav_menu_locations['social'] );
			}
			if ( $menu_id > 0 ) {
				$menu_items = wp_get_nav_menu_items( $menu_id );
				if ( ! empty( $menu_items ) ) {
					echo '<ul class="size-medium">';
					foreach ( $menu_items as $m_key => $m ) {
						echo '<li>';
						echo '<a href="' . esc_url( $m->url ) . '" target="_blank">';
						echo '<span class="title screen-reader-text">' . esc_attr( $m->title ) . '</span>';
						echo '</a>';
						echo '</li>';
					}
					echo '</ul>';
				}
			}
			echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'Magazine_Plus_Image_Widget' ) ) :

	/**
	 * Image widget Class.
	 *
	 * @since 1.0.0
	 */
	class Magazine_Plus_Image_Widget extends Magazine_Plus_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'magazine_plus_widget_image',
				'description'                 => __( 'Displays an image with link.', 'magazine-plus' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'magazine-plus' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'image_url' => array(
					'label' => __( 'Image:', 'magazine-plus' ),
					'type'  => 'image',
					),
				'link_url' => array(
					'label' => __( 'URL:', 'magazine-plus' ),
					'type'  => 'url',
					'class' => 'widefat',
					),
				);

			parent::__construct( 'magazine-plus-image', __( 'MP: Image', 'magazine-plus' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . $params['title'] . $args['after_title'];
			}

			if ( ! empty( $params['image_url'] ) ) {
				$link_open  = '';
				$link_close = '';
				if ( ! empty( $params['link_url'] ) ) {
					$link_open  = '<a href="' . esc_url( $params['link_url'] ). '">';
					$link_close = '</a>';
				}
				echo $link_open;
				echo '<img src="' . esc_url( $params['image_url'] ). '" />';
				echo $link_close;
			}

			echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'Magazine_Plus_Featured_Page_Widget' ) ) :

	/**
	 * Featured page widget Class.
	 *
	 * @since 1.0.0
	 */
	class Magazine_Plus_Featured_Page_Widget extends Magazine_Plus_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'magazine_plus_widget_featured_page',
				'description'                 => __( 'Displays single featured Page or Post.', 'magazine-plus' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'magazine-plus' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'use_page_title' => array(
					'label'   => __( 'Use Page/Post Title as Widget Title', 'magazine-plus' ),
					'type'    => 'checkbox',
					'default' => true,
					),
				'featured_page' => array(
					'label'            => __( 'Select Page:', 'magazine-plus' ),
					'type'             => 'dropdown-pages',
					'show_option_none' => __( '&mdash; Select &mdash;', 'magazine-plus' ),
					),
				'id_message' => array(
					'label'            => '<strong>' . _x( 'OR', 'Featured Page Widget', 'magazine-plus' ) . '</strong>',
					'type'             => 'message',
					),
				'featured_post' => array(
					'label'             => __( 'Post ID:', 'magazine-plus' ),
					'placeholder'       => __( 'Eg: 1234', 'magazine-plus' ),
					'type'              => 'text',
					'sanitize_callback' => 'magazine_plus_widget_sanitize_post_id',
					),
				'content_type' => array(
					'label'   => __( 'Show Content:', 'magazine-plus' ),
					'type'    => 'select',
					'default' => 'full',
					'options' => array(
						'excerpt' => __( 'Excerpt', 'magazine-plus' ),
						'full'    => __( 'Full', 'magazine-plus' ),
						),
					),
				'excerpt_length' => array(
					'label'       => __( 'Excerpt Length:', 'magazine-plus' ),
					'description' => __( 'Applies when Excerpt is selected in Content option.', 'magazine-plus' ),
					'type'        => 'number',
					'css'         => 'max-width:60px;',
					'default'     => 40,
					'min'         => 1,
					'max'         => 400,
					),
				'featured_image' => array(
					'label'   => __( 'Featured Image:', 'magazine-plus' ),
					'type'    => 'select',
					'options' => magazine_plus_get_image_sizes_options(),
					),
				'featured_image_alignment' => array(
					'label'   => __( 'Image Alignment:', 'magazine-plus' ),
					'type'    => 'select',
					'default' => 'center',
					'options' => magazine_plus_get_image_alignment_options(),
					),
				);

			parent::__construct( 'magazine-plus-featured-page', __( 'MP: Featured Page', 'magazine-plus' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			// ID validation.
			$our_post_object = null;
			$our_id = '';
			if ( absint( $params['featured_post'] ) > 0 ) {
				$our_id = absint( $params['featured_post'] );
			}
			if ( absint( $params['featured_page'] ) > 0 ) {
				$our_id = absint( $params['featured_page'] );
			}
			if ( absint( $our_id ) > 0 ) {
				$raw_object = get_post( $our_id );
				if ( ! in_array( $raw_object->post_type, array( 'attachment', 'nav_menu_item', 'revision' ) ) ) {
					$our_post_object = $raw_object;
				}
			}
			if ( ! $our_post_object ) {
				// No valid object; bail now!
				return;
			}

			echo $args['before_widget'];

			global $post;
			// Setup global post.
			$post = $our_post_object;
			setup_postdata( $post );

			// Override title if checkbox is selected.
			if ( true === $params['use_page_title'] ) {
				$params['title'] = get_the_title( $post );
			}

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . $params['title'] . $args['after_title'];
			}
			?>
			<div class="featured-page-widget entry-content">
				<?php if ( 'disable' !== $params['featured_image'] && has_post_thumbnail() ) : ?>
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( esc_attr( $params['featured_image'] ), array( 'class' => 'align' . esc_attr( $params['featured_image_alignment'] ) ) ); ?></a>
				<?php endif; ?>
				<?php if ( 'excerpt' === $params['content_type'] ) : ?>
					<?php
						$excerpt = magazine_plus_the_excerpt( absint( $params['excerpt_length'] ) );
						echo wpautop( $excerpt );
						?>
				<?php else : ?>
					<?php the_content(); ?>
				<?php endif; ?>

			</div><!-- .featured-page-widget -->
			<?php
			// Reset.
			wp_reset_postdata();

			echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'Magazine_Plus_Latest_News_Widget' ) ) :

	/**
	 * Latest news widget Class.
	 *
	 * @since 1.0.0
	 */
	class Magazine_Plus_Latest_News_Widget extends Magazine_Plus_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$opts = array(
				'classname'                   => 'magazine_plus_widget_latest_news',
				'description'                 => __( 'Displays latest posts in grid.', 'magazine-plus' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'magazine-plus' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'post_category' => array(
					'label'           => __( 'Select Category:', 'magazine-plus' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => __( 'All Categories', 'magazine-plus' ),
					),
				'post_layout' => array(
					'label'    => __( 'Post Layout:', 'magazine-plus' ),
					'type'     => 'select',
					'default'  => 1,
					'adjacent' => true,
					'options'  => magazine_plus_get_numbers_dropdown_options( 1, 2, __( 'Layout', 'magazine-plus' ) . ' ' ),
					),
				'post_number' => array(
					'label'   => __( 'Number of Posts:', 'magazine-plus' ),
					'type'    => 'number',
					'default' => 4,
					'css'     => 'max-width:60px;',
					'min'     => 1,
					'max'     => 10,
					),
				'post_column' => array(
					'label'   => __( 'Number of Columns:', 'magazine-plus' ),
					'type'    => 'select',
					'default' => 2,
					'options' => magazine_plus_get_numbers_dropdown_options( 1, 4 ),
					),
				'featured_image' => array(
					'label'   => __( 'Featured Image:', 'magazine-plus' ),
					'type'    => 'select',
					'default' => 'magazine-plus-thumb',
					'options' => magazine_plus_get_image_sizes_options(),
					),
				'excerpt_length' => array(
					'label'       => __( 'Excerpt Length:', 'magazine-plus' ),
					'description' => __( 'in words', 'magazine-plus' ),
					'type'        => 'number',
					'css'         => 'max-width:60px;',
					'default'     => 20,
					'min'         => 0,
					'max'         => 200,
					),
				);

			parent::__construct( 'magazine-plus-latest-news', __( 'MP: Latest News', 'magazine-plus' ), $opts, array(), $fields );
		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . $params['title'] . $args['after_title'];
			}

			$qargs = array(
				'posts_per_page' => esc_attr( $params['post_number'] ),
				'no_found_rows'  => true,
				);
			if ( absint( $params['post_category'] ) > 0 ) {
				$qargs['category'] = absint( $params['post_category'] );
			}
			$all_posts = get_posts( $qargs );
			?>
			<?php if ( ! empty( $all_posts ) ) : ?>

				<?php global $post; ?>

				<div class="latest-news-widget latest-news-layout-<?php echo esc_attr( $params['post_layout'] ); ?> latest-news-col-<?php echo esc_attr( $params['post_column'] ); ?>">

					<div class="inner-wrapper">

						<?php foreach ( $all_posts as $key => $post ) : ?>
							<?php setup_postdata( $post ); ?>

							<div class="latest-news-item">

									<?php if ( 'disable' !== $params['featured_image'] && has_post_thumbnail() ) : ?>
										<div class="latest-news-thumb">
											<a href="<?php the_permalink(); ?>">
												<?php
												the_post_thumbnail( esc_attr( $params['featured_image'] ) );
												?>
											</a>
										</div><!-- .latest-news-thumb -->
									<?php endif; ?>
									<div class="latest-news-text-wrap">

										<div class="latest-news-text-content">
											<h3 class="latest-news-title">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h3><!-- .latest-news-title -->
										</div><!-- .latest-news-text-content -->

										<div class="latest-news-meta">
											<ul>
												<li class="news-date-meta"><span class="latest-news-date"><?php the_time( 'j M Y' ); ?></span></li>
											</ul>
										</div><!-- .latest-news-meta -->

										<?php if ( absint( $params['excerpt_length'] ) > 0 ) : ?>
											<div class="latest-news-excerpt">
												<?php
												$excerpt = magazine_plus_the_excerpt( absint( $params['excerpt_length'] ) );
												echo wpautop( $excerpt );
												?>
											</div><!-- .latest-news-excerpt -->
										<?php endif; ?>

									</div><!-- .latest-news-text-wrap -->

							</div><!-- .latest-news-item -->

						<?php endforeach; ?>

					</div><!-- .row -->

				</div><!-- .latest-news-widget -->

				<?php wp_reset_postdata(); ?>

			<?php endif; ?>

			<?php echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'Magazine_Plus_Recent_Posts_Widget' ) ) :

	/**
	 * Recent posts widget Class.
	 *
	 * @since 1.0.0
	 */
	class Magazine_Plus_Recent_Posts_Widget extends Magazine_Plus_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'magazine_plus_widget_recent_posts',
				'description'                 => __( 'Displays recent posts.', 'magazine-plus' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'magazine-plus' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'post_category' => array(
					'label'           => __( 'Select Category:', 'magazine-plus' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => __( 'All Categories', 'magazine-plus' ),
					),
				'post_number' => array(
					'label'   => __( 'Number of Posts:', 'magazine-plus' ),
					'type'    => 'number',
					'default' => 4,
					'css'     => 'max-width:60px;',
					'min'     => 1,
					'max'     => 100,
					),
				'featured_image' => array(
					'label'   => __( 'Featured Image:', 'magazine-plus' ),
					'type'    => 'select',
					'default' => 'thumbnail',
					'options' => magazine_plus_get_image_sizes_options( true, array( 'disable', 'thumbnail' ), false ),
					),
				'image_width' => array(
					'label'       => __( 'Image Width:', 'magazine-plus' ),
					'type'        => 'number',
					'description' => __( 'px', 'magazine-plus' ),
					'css'         => 'max-width:60px;',
					'adjacent'    => true,
					'default'     => 90,
					'min'         => 1,
					'max'         => 150,
					),
				'disable_date' => array(
					'label'   => __( 'Disable Date', 'magazine-plus' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				);

			parent::__construct( 'magazine-plus-recent-posts', __( 'MP: Recent Posts', 'magazine-plus' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . $params['title'] . $args['after_title'];
			}

			$qargs = array(
				'posts_per_page' => esc_attr( $params['post_number'] ),
				'no_found_rows'  => true,
				);
			if ( absint( $params['post_category'] ) > 0  ) {
				$qargs['category'] = $params['post_category'];
			}
			$all_posts = get_posts( $qargs );

			?>
			<?php if ( ! empty( $all_posts ) ) : ?>

				<?php global $post; ?>

				<div class="recent-posts-wrapper">

					<?php foreach ( $all_posts as $key => $post ) :  ?>
						<?php setup_postdata( $post ); ?>

						<div class="recent-posts-item">

							<?php if ( 'disable' !== $params['featured_image'] && has_post_thumbnail() ) :  ?>
								<div class="recent-posts-thumb">
									<a href="<?php the_permalink(); ?>">
										<?php
										$img_attributes = array(
											'class' => 'alignleft',
											'style' => 'max-width:' . esc_attr( $params['image_width'] ). 'px;',
											);
										the_post_thumbnail( esc_attr( $params['featured_image'] ), $img_attributes );
										?>
									</a>
								</div><!-- .recent-posts-thumb -->
							<?php endif ?>
							<div class="recent-posts-text-wrap">
								<h3 class="recent-posts-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3><!-- .recent-posts-title -->

								<?php if ( false === $params['disable_date'] ) : ?>
									<div class="recent-posts-meta">

										<?php if ( false === $params['disable_date'] ) : ?>
											<span class="recent-posts-date"><?php the_time( get_option( 'date_format' ) ); ?></span><!-- .recent-posts-date -->
										<?php endif; ?>

									</div><!-- .recent-posts-meta -->
								<?php endif; ?>

							</div><!-- .recent-posts-text-wrap -->

						</div><!-- .recent-posts-item -->

					<?php endforeach; ?>

				</div><!-- .recent-posts-wrapper -->

				<?php wp_reset_postdata(); ?>

			<?php endif; ?>

			<?php
			echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'Magazine_Plus_News_Slider_Widget' ) ) :

	/**
	 * News slider widget Class.
	 *
	 * @since 1.0.0
	 */
	class Magazine_Plus_News_Slider_Widget extends Magazine_Plus_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'   => 'magazine_plus_widget_news_slider',
				'description' => __( 'Displays news slider', 'magazine-plus' ),
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'magazine-plus' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'post_category' => array(
					'label'           => __( 'Select Category:', 'magazine-plus' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => __( 'All Categories', 'magazine-plus' ),
					),
				'post_number' => array(
					'label'   => __( 'Number of Posts:', 'magazine-plus' ),
					'type'    => 'number',
					'default' => 3,
					'css'     => 'max-width:60px;',
					'min'     => 1,
					'max'     => 10,
					),
				'featured_image' => array(
					'label'   => __( 'Featured Image:', 'magazine-plus' ),
					'type'    => 'select',
					'default' => 'medium',
					'options' => magazine_plus_get_image_sizes_options( false ),
					),
				);

			parent::__construct( 'magazine-plus-news-slider', __( 'MP: News Slider', 'magazine-plus' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . $params['title'] . $args['after_title'];
			}

			$posts = $this->get_slider_posts( $params );
			// nspre( $posts );
			if ( ! empty( $posts ) ) {
				$this->render_slider( $posts, $params );
			}

			echo $args['after_widget'];

		}

		/**
		 * Render slider.
		 *
		 * @since 1.0.0
		 *
		 * @param array $posts Slider posts.
		 * @param array $params Parameters.
		 * @return void
		 */
		function render_slider( $posts, $params ) {
			// Cycle data.
			$slide_data = array(
				'fx'             => 'fadeout',
				'speed'          => 1000,
				'pause-on-hover' => 'true',
				'loader'         => 'true',
				'log'            => 'false',
				'swipe'          => 'true',
				'auto-height'    => 'container',
			);

			$slide_data['caption-template'] = '<h3><a href="{{url}}">{{title}}</a></h3><p>{{excerpt}}</p>';

			$slide_data['pager-template'] = '<span class="pager-box"></span>';
			$slide_data['timeout'] = 3 * 1000;
			$slide_data['slides'] = 'article';

			$slide_attributes_text = '';
			foreach ( $slide_data as $key => $item ) {

				$slide_attributes_text .= ' ';
				$slide_attributes_text .= ' data-cycle-'.esc_attr( $key );
				$slide_attributes_text .= '="'.esc_attr( $item ).'"';

			}

			?>
			<div class="cycle-slideshow" <?php echo $slide_attributes_text; ?>>
				<!-- prev/next links -->
				<div class="cycle-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
				<div class="cycle-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
				<div class="cycle-caption"></div>

				<?php $cnt = 1; ?>
				<?php foreach ( $posts as $key => $post ) : ?>
					<?php $class_text = ( 1 === $cnt ) ? 'first' : ''; ?>

				    <article class="<?php echo esc_attr( $class_text ); ?>" data-cycle-title="<?php echo esc_attr( $post['title'] ); ?>" data-cycle-excerpt="<?php echo esc_attr( $post['excerpt'] ); ?>" data-cycle-url="<?php echo esc_url( $post['url'] ); ?>">
				    	<img src="<?php echo esc_url( $post['image'][0]); ?>" alt="" />
				    </article>

				    <?php $cnt++; ?>
				<?php endforeach; ?>

			    <div class="cycle-pager"></div>
			</div>
			<?php

		}

		/**
		 * Return slider posts detail.
		 *
		 * @since 1.0.0
		 *
		 * @param array $params Parameters.
		 * @return array Posts details.
		 */
		function get_slider_posts( $params ) {

			$output = array();

			$qargs = array(
				'posts_per_page' => esc_attr( $params['post_number'] ),
				'no_found_rows'  => true,
				'meta_key'       => '_thumbnail_id',
			);
			if ( absint( $params['post_category'] ) > 0  ) {
				$qargs['category'] = absint( $params['post_category'] );
			}

			$all_posts = get_posts( $qargs );
			if ( ! empty( $all_posts ) ) {
				$cnt = 0;
				global $post;
				foreach ( $all_posts as $key => $post ) {

					setup_postdata( $post );

					$item = array();
					$item['ID']      = $post->ID;
					$item['title']   = get_the_title( $post->ID );
					$item['url']     = get_permalink( $post->ID );
					$item['excerpt'] = magazine_plus_the_excerpt( 20, $post );
					$item['image']   = null;

					if ( has_post_thumbnail( $post->ID ) ) {
						$image_detail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), esc_attr( $params['featured_image'] ) );
						if ( ! empty( $image_detail ) ) {
							$item['image'] = $image_detail;
						}
					}

					$output[ $cnt ] = $item;
					$cnt++;

				}
				wp_reset_postdata();
			}

			return $output;

		}


	}
endif;

if ( ! class_exists( 'Magazine_Plus_Tabbed_Widget' ) ) :

	/**
	 * Tabbed widget Class.
	 *
	 * @since 1.0.0
	 */
	class Magazine_Plus_Tabbed_Widget extends Magazine_Plus_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'   => 'magazine_plus_widget_tabbed',
				'description' => __( 'Tabbed widget.', 'magazine-plus' ),
				);
			$fields = array(
				'popular_heading' => array(
					'label' => __( 'Popular', 'magazine-plus' ),
					'type'  => 'heading',
					),
				'popular_number' => array(
					'label'       => __( 'No. of Posts:', 'magazine-plus' ),
					'type'        => 'number',
					'css'         => 'max-width:60px;',
					'default'     => 5,
					'min'         => 1,
					'max'         => 10,
					),
				'recent_heading' => array(
					'label' => __( 'Recent', 'magazine-plus' ),
					'type'  => 'heading',
					),
				'recent_number' => array(
					'label'       => __( 'No. of Posts:', 'magazine-plus' ),
					'type'        => 'number',
					'css'         => 'max-width:60px;',
					'default'     => 5,
					'min'         => 1,
					'max'         => 10,
					),
				'comments_heading' => array(
					'label' => __( 'Comments', 'magazine-plus' ),
					'type'  => 'heading',
					),
				'comments_number' => array(
					'label'       => __( 'No. of Comments:', 'magazine-plus' ),
					'type'        => 'number',
					'css'         => 'max-width:60px;',
					'default'     => 5,
					'min'         => 1,
					'max'         => 10,
					),
				);

			parent::__construct( 'magazine-plus-tabbed', __( 'MP: Tabbed', 'magazine-plus' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );
			$tab_id = 'tabbed-' . $this->number;

			echo $args['before_widget'];
			?>
			<div class="tabbed-container">
				<ul class="etabs">
					<li class="tab tab-popular"><a href="#<?php echo esc_attr( $tab_id ); ?>-popular"><?php esc_html_e( 'Popular', 'magazine-plus' ); ?></a></li>
					<li class="tab tab-recent"><a href="#<?php echo esc_attr( $tab_id ); ?>-recent"><?php esc_html_e( 'Recent', 'magazine-plus' ); ?></a></li>
					<li class="tab tab-comments"><a href="#<?php echo esc_attr( $tab_id ); ?>-comments"><?php esc_html_e( 'Comments', 'magazine-plus' ); ?></a></li>
				</ul>
				<div id="<?php echo esc_attr( $tab_id ); ?>-popular" class="tab-content">
					<?php $this->render_news( 'popular', $params ); ?>
				</div>
				<div id="<?php echo esc_attr( $tab_id ); ?>-recent" class="tab-content">
					<?php $this->render_news( 'recent', $params ); ?>
				</div>
				<div id="<?php echo esc_attr( $tab_id ); ?>-comments" class="tab-content">
					<?php $this->render_comments( $params ); ?>
				</div>
			</div>
			<?php

			echo $args['after_widget'];

		}

		/**
		 * Render news.
		 *
		 * @since 1.0.0
		 *
		 * @param array $type Type.
		 * @param array $params Parameters.
		 * @return void
		 */
		function render_news( $type, $params ) {

			if ( ! in_array( $type, array( 'popular', 'recent' ) ) ) {
				return;
			}

			switch ( $type ) {
				case 'popular':
					$qargs = array(
						'posts_per_page' => $params['popular_number'],
						'no_found_rows'  => true,
						'orderby'        => 'comment_count',
					);
					break;

				case 'recent':
					$qargs = array(
						'posts_per_page' => $params['recent_number'],
						'no_found_rows'  => true,
					);
					break;

				default:
					break;
			}

			$all_posts = get_posts( $qargs );
			?>
			<?php if ( ! empty( $all_posts ) ) : ?>
				<?php global $post; ?>

				<ul class="news-list">
				<?php foreach ( $all_posts as $key => $post ) : ?>
					<?php setup_postdata( $post ); ?>
					<li class="news-item">
						<div class="news-thumb">
							<a href="<?php the_permalink(); ?>" class="news-item-thumb">
							<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
								<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) ); ?>
								<?php if ( ! empty( $image ) ) : ?>
									<img src="<?php echo esc_url( $image[0] ); ?>" alt="" />
								<?php endif; ?>
							<?php else : ?>
								<img src="<?php echo get_template_directory_uri() . '/images/no-image-65.png'; ?>" alt="" />
							<?php endif; ?>
							</a>
						</div><!-- .news-thumb -->
						<div class="news-content">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><span class="date"><?php the_time( get_option( 'date_format' ) ); ?></span>
						</div><!-- .news-content -->
					</li>
				<?php endforeach; ?>
				</ul><!-- .news-list -->

				<?php wp_reset_postdata(); ?>

			<?php endif; ?>

			<?php

		}

		/**
		 * Render comments.
		 *
		 * @since 1.0.0
		 *
		 * @param array $params Parameters.
		 * @return void
		 */
		function render_comments( $params ) {

			$comment_args = array(
				'number'      => $params['comments_number'],
				'status'      => 'approve',
				'post_status' => 'publish',
			);

			$comments = get_comments( $comment_args );
			?>
			<?php if ( ! empty( $comments ) ) : ?>
				<ul class="comments-list">
					<?php foreach ( $comments as $key => $comment ) : ?>
						<li>
						<div class="comments-thumb">
							<?php $comment_author_url = get_comment_author_url( $comment ); ?>
							<?php if ( ! empty( $comment_author_url) ) : ?>
								<a href="<?php echo esc_url( $comment_author_url ); ?>"><?php echo get_avatar( $comment, 65 ); ?></a>
							<?php else : ?>
								<?php echo get_avatar( $comment, 65 ); ?>
							<?php endif; ?>
						</div><!-- .comments-thumb -->
						<div class="comments-content">
							<?php echo get_comment_author_link( $comment ); ?>&nbsp;<?php echo esc_html_x( 'on', 'Tabbed Widget', 'magazine-plus' ); ?>&nbsp;<a href="<?php echo esc_url( get_comment_link( $comment ) );?>"><?php echo get_the_title( $comment->comment_post_ID ); ?></a>
						</div><!-- .comments-content -->
						</li>
					<?php endforeach; ?>
				</ul><!-- .comments-list -->
			<?php endif; ?>
			<?php
		}

	}
endif;
