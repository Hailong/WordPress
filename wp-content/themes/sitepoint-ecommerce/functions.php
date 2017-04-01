<?php
/**
 * SitePoint Ecommerce functions and definitions
 *
 * @package SitePoint Ecommerce
 * @since SitePoint Ecommerce 1.0
 */

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sitepoint_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sitepoint_content_width', 806 );
}
add_action( 'after_setup_theme', 'sitepoint_content_width', 0 );
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since SitePoint Ecommerce 1.0
 *
 * @return void
 */
if ( ! function_exists( 'SitePoint_Ecommerce_setup' ) ) {
	function SitePoint_Ecommerce_setup() {
		global $content_width;
		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on SitePoint Ecommerce, use a find and replace
		 * to change 'sitepoint-ecommerce' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'sitepoint-ecommerce', trailingslashit( get_template_directory() ) . 'languages' );
		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();
		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );
		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		// Create an extra image size for the Post featured image
		add_image_size( 'sitepoint_ecommerce_theme_post_feature_full_width', 806, 300, true );
		// This theme uses wp_nav_menu() in one location
		register_nav_menus( array(
				'menu-1' => esc_html__( 'Shop Menu', 'sitepoint-ecommerce' )
			) );
		// This theme uses wp_nav_menu() secondary menu
		register_nav_menus( array(
				'secondary-menu' => esc_html__( 'Site Menu', 'sitepoint-ecommerce' )
			) );

		register_nav_menus( array(
				'footer-menu' => esc_html__( 'Footer Menu', 'sitepoint-ecommerce' )
			) );
		// This theme supports a variety of post formats
		add_theme_support( 'post-formats', array(
			'aside',
			'audio',
			'chat',
			'gallery',
			'image',
			'link',
			'quote',
			'status',
			'video'
		) );
		// Add theme support for HTML5 markup for the search forms, comment forms, comment lists, gallery, and caption
		add_theme_support( 'html5', array(
			'comment-list',
			'comment-form',
			'search-form',
			'gallery',
			'caption'
		) );
		// Enable support for widget sidebars selective refresh in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );
		// Enable support for Custom Backgrounds
		add_theme_support( 'custom-background', array(
				// Background color default
				'default-color' => 'fff'
			) );

		// Enable support for Custom Headers (or in our case, a custom logo)
		add_theme_support( 'custom-header', array(
				// Header text display default
				'header-text' => true,
				// Header text color default
				'default-text-color' => 'fff',
				// Flexible width
				'flex-width' => true,
				// Header image width (in pixels)
				'width' => 1160,
				// Flexible height
				'flex-height' => true,
				// Header image height (in pixels)
				'height' => 280
			) );
		// Enable support for Theme Logos
		add_theme_support( 'custom-logo', array(
			'width'       => 300,
			'height'      => 80,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
			) );
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		// Enable support for WooCommerce
		add_theme_support( 'woocommerce' );
	}
}
add_action( 'after_setup_theme', 'SitePoint_Ecommerce_setup' );

/**
 * Returns the Google font stylesheet URL, if available.
 *
 * The use of Open Sans and Dosis by default is localized. For languages that use characters not supported by the fonts, the fonts can be disabled.
 *
 * @since SitePoint Ecommerce 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
 if ( ! function_exists( 'SitePoint_Ecommerce_fonts_url' ) ) {
 	function SitePoint_Ecommerce_fonts_url() {
 		return '';
 		$fonts_url = '';
 		$subsets = 'latin';
 		/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'.
 		 * Do not translate into your own language.
 		 */
 		$bodyFont = _x( 'on', 'Merriweather font: on or off', 'sitepoint-ecommerce' );
 		/* translators: To add an additional Merriweather character subset specific to your language, translate this to 'greek', 'cyrillic' or 'vietnamese'.
 		 * Do not translate into your own language.
 		 */
 		$subset = _x( 'no-subset', 'Merriweather font: add new subset (cyrillic)', 'sitepoint-ecommerce' );
 		if ( 'cyrillic' == $subset ) {
 			$subsets .= ',cyrillic';
 		}
 		/* translators: If there are characters in your language that are not supported by Dosis, translate this to 'off'.
 		 * Do not translate into your own language.
 		 */
 		$headerFont = _x( 'on', 'Dosis font: on or off', 'sitepoint-ecommerce' );
 		if ( 'off' !== $bodyFont || 'off' !== $headerFont ) {
 			$font_families = array();
 			if ( 'off' !== $bodyFont )
 				$font_families[] = 'Merriweather:400,400i,700,700i';
 			if ( 'off' !== $headerFont )
 				$font_families[] = 'Dosis:700';
 			$query_args = array(
 				'family' => implode( '|', $font_families ),
 				'subset' => $subsets,
 			);
 		  $fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
 		}
 		return $fonts_url;
 	}
 }

/**
 * Adds additional stylesheets to the TinyMCE editor if needed.
 *
 * @since SitePoint Ecommerce 1.0
 *
 * @param string $mce_css CSS path to load in TinyMCE.
 * @return string The filtered CSS paths list.
 */
function SitePoint_Ecommerce_mce_css( $mce_css ) {
	$fonts_url = SitePoint_Ecommerce_fonts_url();
	if ( empty( $fonts_url ) ) {
		return $mce_css;
	}
	if ( !empty( $mce_css ) ) {
		$mce_css .= ',';
	}
	$mce_css .= esc_url_raw( str_replace( ',', '%2C', $fonts_url ) );
	return $mce_css;
}
add_filter( 'mce_css', 'SitePoint_Ecommerce_mce_css' );

/**
 * Register widgetized areas
 *
 * @since SitePoint Ecommerce 1.0
 *
 * @return void
 */
if ( ! function_exists( 'SitePoint_Ecommerce_widgets_init' ) ) {
	function SitePoint_Ecommerce_widgets_init() {
		register_sidebar( array(
				'name' => esc_html__( 'Sidebar', 'sitepoint-ecommerce' ),
				'id' => 'sidebar-1',
				'description' => esc_html__( 'Appears in the Sidebar', 'sitepoint-ecommerce' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>'
			) );
	}
}
add_action( 'widgets_init', 'SitePoint_Ecommerce_widgets_init' );

// ajax return
add_action( 'wp_ajax_ajax_action', 'ajax_action' );
add_action( 'wp_ajax_nopriv_ajax_action', 'ajax_action' );
function ajax_action() {
	session_start();
	$windowWidth = intval( $_POST['windowWidth'] );
	$_SESSION['width'] = $windowWidth;
	echo $windowWidth;
	wp_die(); // this is required to terminate immediately and return a proper response
}

/**
 * Enqueue scripts and styles
 *
 * @since SitePoint Ecommerce 1.0
 *
 * @return void
 */
if ( ! function_exists( 'SitePoint_Ecommerce_scripts_styles' ) ) {
	function SitePoint_Ecommerce_scripts_styles() {
		/**
		 * Register and enqueue our stylesheets
		 */
		// Start off with a clean base by using normalise.
		wp_enqueue_style( 'normalize', trailingslashit( get_template_directory_uri() ) . 'css/normalize.css' , array(), '4.1.1', 'all' );
		// Register and enqueue our icon font
		// We're using the awesome Font Awesome icon font. http://fortawesome.github.io/Font-Awesome
		wp_enqueue_style( 'fontawesome', trailingslashit( get_template_directory_uri() ) . 'css/font-awesome.min.css' , array( 'normalize' ), '4.6.3', 'all' );

		// Our styles for setting up the grid. We're using Unsemantic. http://unsemantic.com
		wp_enqueue_style( 'unsemanticgrid', trailingslashit( get_template_directory_uri() ) . 'css/unsemantic.css' , array( 'fontawesome' ), '1.0.0', 'all' );
		/*
		 * Load our Google Fonts.
		 *
		 * To disable in a child theme, use wp_dequeue_style()
		 * function mytheme_dequeue_fonts() {
		 *     wp_dequeue_style( 'sitepoint-fonts' );
		 * }
		 * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
		 */
		$fonts_url = SitePoint_Ecommerce_fonts_url();
		if ( !empty( $fonts_url ) ) {
			wp_enqueue_style( 'sitepoint-fonts', esc_url_raw( $fonts_url ), array(), null );
		}
		// If using a child theme, auto-load the parent theme style.
		// Props to Justin Tadlock for this recommendation - http://justintadlock.com/archives/2014/11/03/loading-parent-styles-for-child-themes
		if ( is_child_theme() ) {
			wp_enqueue_style( 'sitepoint-ecommerce-parent-style', trailingslashit( get_template_directory_uri() ) . 'style.css' );
		}
		// wp_enqueue_style( 'raleway-font', 'https://fonts.googleapis.com/css?family=Raleway' );

		// Enqueue the default WordPress stylesheet
		wp_enqueue_style( 'sitepoint-ecommerce-style', get_stylesheet_uri() );
		/**
		 * Register and enqueue our scripts
		 */
		// Load Modernizr at the top of the document, which enables HTML5 elements and feature detects
		wp_enqueue_script( 'modernizr', trailingslashit( get_template_directory_uri() ) . 'js/modernizr-min.js', array(), '3.3.1', false );

		// Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use)
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		// Load our a dependency script for responsive menu.
		wp_enqueue_script( 'sitepoint-ecommerce-apollo', trailingslashit( get_template_directory_uri() ) . 'js/apollo.min.js', array(), '1.0.0', false );
		//vanilla javascript to create the responsive menu.
		wp_enqueue_script( 'sitepoint-ecommerce-responsive-menu', trailingslashit( get_template_directory_uri() ) . 'js/responsive-menu.min.js', array(), '1.0.0', false );
		wp_enqueue_script( 'jquery-library', trailingslashit( get_template_directory_uri() ) . 'js/jquery.min.js', array(), '1.0.0', false );
		if(is_single()){
			wp_enqueue_style( 'owl-carousel-css', trailingslashit( get_template_directory_uri() ) . 'css/owl.carousel.css', array(), '1.0.0', false );
			wp_enqueue_style( 'owl-carousel-theme', trailingslashit( get_template_directory_uri() ) . 'css/owl.theme.css', array(), '1.0.0', false );
			wp_enqueue_style( 'owl-carousel-transition', trailingslashit( get_template_directory_uri() ) . 'css/owl.transition.css', array(), '1.0.0', false );
			wp_enqueue_script( 'owl-carousel-js', trailingslashit( get_template_directory_uri() ) . 'js/owl.carousel.min.js', array(), '1.0.0', false );
		}
		wp_enqueue_style( 'mamasaid-custom-style', trailingslashit( get_template_directory_uri() ) . 'css/style.css' );
		wp_enqueue_script( 'custom-js', trailingslashit( get_template_directory_uri() ) . 'js/custom.js', array('jquery') , '1.0.0', false );
	}
}
add_action( 'wp_enqueue_scripts', 'SitePoint_Ecommerce_scripts_styles' );

require get_template_directory() . '/inc/extras.php';

//function to load the responsive menu necessary to load in the footer
function scipts_function() {
   echo '<script type="text/javascript">
    responsivemenu.init({
        wrapper: document.querySelector(".navigation_container"),
				onAfterInit: function() {
				}
    });
</script>';
}
add_action( 'wp_footer', 'scipts_function' );
/**
 * Displays the optional custom logo. If no logo is available, it displays the Site Title
 *
 * @since SitePoint Ecommerce 1.0
 *
 * @return void
 */
if ( ! function_exists( 'SitePoint_Ecommerce_the_custom_logo' ) ) {
	function SitePoint_Ecommerce_the_custom_logo() {
		$siteTitleStr = "";
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			the_custom_logo();
		}
		else {
			$siteTitleStr .= '<h1><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">';
			$siteTitleStr .= get_bloginfo( 'name' );
			$siteTitleStr .= '</a></h1>';
			echo $siteTitleStr;
		}
	}
}

/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own SitePoint_Ecommerce_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 * (Note the lack of a trailing </li>. WordPress will add it itself once it's done listing any children and whatnot)
 *
 * @since SitePoint Ecommerce 1.0
 *
 * @param array Comment
 * @param array Arguments
 * @param integer Comment depth
 * @return void
 */
if ( ! function_exists( 'SitePoint_Ecommerce_comment' ) ) {
	function SitePoint_Ecommerce_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) {
		case 'pingback' :
		case 'trackback' :
			// Display trackbacks differently than normal comments ?>
			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="pingback">
					<p><?php esc_html_e( 'Pingback:', 'sitepoint-ecommerce' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'sitepoint-ecommerce' ), '<span class="edit-link">', '</span>' ); ?></p>
				</article> <!-- #comment-##.pingback -->
			<?php
			break;
		default :
			// Proceed with normal comments.
			global $post; ?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="comment">
					<header class="comment-meta comment-author vcard">
						<?php
						echo get_avatar( $comment, 44 );
						printf( '<cite class="fn">%1$s %2$s</cite>',
							get_comment_author_link(),
							// If current post author is also comment author, make it known visually.
							( $comment->user_id === $post->post_author ) ? '<span> ' . esc_html__( 'Post author', 'sitepoint-ecommerce' ) . '</span>' : '' );
						printf( '<a href="%1$s"><time itemprop="datePublished" datetime="%2$s">%3$s</time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							/* Translators: 1: date, 2: time */
							sprintf( esc_html__( '%1$s at %2$s', 'sitepoint-ecommerce' ), get_comment_date(), get_comment_time() )
						);
						?>
					</header> <!-- .comment-meta -->
					<?php if ( '0' == $comment->comment_approved ) { ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'sitepoint-ecommerce' ); ?></p>
					<?php } ?>
					<section class="comment-content comment">
						<?php comment_text(); ?>
						<?php edit_comment_link( esc_html__( 'Edit', 'sitepoint-ecommerce' ), '<p class="edit-link">', '</p>' ); ?>
					</section> <!-- .comment-content -->
					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => wp_kses( __( 'Reply <span>&darr;</span>', 'sitepoint-ecommerce' ), array( 'span' => array() ) ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div> <!-- .reply -->
				</article> <!-- #comment-## -->
			<?php
			break;
		} // end comment_type check
	}
}

/**
 * Update the Comments form so that the 'required' span is contained within the form label.
 *
 * @since SitePoint Ecommerce 1.0
 *
 * @param string Comment form fields html
 * @return string The updated comment form fields html
 */
if ( ! function_exists( 'SitePoint_Ecommerce_comment_form_default_fields' ) ) {
	function SitePoint_Ecommerce_comment_form_default_fields( $fields ) {

		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? ' aria-required="true"' : "" );
		$fields[ 'author' ] = '<p class="comment-form-author">' . '<label for="author">' . esc_html__( 'Name', 'sitepoint-ecommerce' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
		$fields[ 'email' ] =  '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'sitepoint-ecommerce' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
		$fields[ 'url' ] =  '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'sitepoint-ecommerce' ) . '</label>' . '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';
		return $fields;
	}
}
add_action( 'comment_form_default_fields', 'SitePoint_Ecommerce_comment_form_default_fields' );

/**
 * Update the Comments form to add a 'required' span to the Comment textarea within the form label, because it's pointless
 * submitting a comment that doesn't actually have any text in the comment field!
 *
 * @since SitePoint Ecommerce 1.0
 *
 * @param string Comment form textarea html
 * @return string The updated comment form textarea html
 */
if ( ! function_exists( 'SitePoint_Ecommerce_comment_form_field_comment' ) ) {
	function SitePoint_Ecommerce_comment_form_field_comment( $field ) {
		if ( !SitePoint_Ecommerce_is_woocommerce_active() || ( SitePoint_Ecommerce_is_woocommerce_active() && !is_product() ) ) {
			$field = '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'sitepoint-ecommerce' ) . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';
		}
		return $field;
	}
}
add_action( 'comment_form_field_comment', 'SitePoint_Ecommerce_comment_form_field_comment' );

/**
 * Prints HTML with meta information for current post: author and date
 *
 * @since SitePoint Ecommerce 1.0
 *
 * @return void
 */
if ( ! function_exists( 'SitePoint_Ecommerce_posted_on' ) ) {
	function SitePoint_Ecommerce_posted_on() {
		$post_icon = '';
		switch ( get_post_format() ) {
			case 'aside':
				$post_icon = 'fa-file-o';
				break;
			case 'audio':
				$post_icon = 'fa-volume-up';
				break;
			case 'chat':
				$post_icon = 'fa-comment';
				break;
			case 'gallery':
				$post_icon = 'fa-camera';
				break;
			case 'image':
				$post_icon = 'fa-picture-o';
				break;
			case 'link':
				$post_icon = 'fa-link';
				break;
			case 'quote':
				$post_icon = 'fa-quote-left';
				break;
			case 'status':
				$post_icon = 'fa-user';
				break;
			case 'video':
				$post_icon = 'fa-video-camera';
				break;
			default:
				$post_icon = 'fa-calendar';
				break;
		}

		// Translators: 1: Icon 2: Permalink 3: Post date and time 4: Publish date in ISO format 5: Post date
		$date = sprintf( '<span class="publish-date"><i class="fa %1$s" aria-hidden="true"></i> <a href="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" itemprop="datePublished">%4$s</time></a></span>',
			$post_icon,
			esc_url( get_permalink() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);
		// Translators: 1: Date link 2: Author link 3: Categories 4: No. of Comments
		$author = sprintf( '<span class="publish-author"><i class="fa fa-pencil" aria-hidden="true"></i> <address class="author vcard"><a class="url fn n" href="%1$s" rel="author">%2$s</a></address></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			get_the_author()
		);
		// Return the Categories as a list
		$categories_list = get_the_category_list( esc_html__( ' ', 'sitepoint-ecommerce' ) );
		// Translators: 1: Permalink 2: Title 3: No. of Comments
		$comments = sprintf( '<span class="comments-link"><i class="fa fa-comment" aria-hidden="true"></i> <a href="%1$s">%2$s</a></span>',
			esc_url( get_comments_link() ),
			( get_comments_number() > 0 ? sprintf( _n( '%1$s Comment', '%1$s Comments', get_comments_number(), 'sitepoint-ecommerce' ), get_comments_number() ) : esc_html__( 'No Comments', 'sitepoint-ecommerce' ) )
		);

	}
}

/**
 * Prints HTML with meta information for current post: categories, tags, permalink
 *
 * @since SitePoint Ecommerce 1.0
 *
 * @return void
 */
if ( ! function_exists( 'SitePoint_Ecommerce_entry_meta' ) ) {
	function SitePoint_Ecommerce_entry_meta() {
		// Return the Tags as a list
		$tag_list = "";
		if ( get_the_tag_list() ) {
			$tag_list = get_the_tag_list( '<span class="post-tags">', esc_html__( ' ', 'sitepoint-ecommerce' ), '</span>' );
		}
		// Translators: 1 is tag
		if ( $tag_list ) {
			printf( wp_kses( __( '<i class="fa fa-tag" aria-hidden="true"></i> %1$s', 'sitepoint-ecommerce' ), array( 'i' => array( 'class' => array() ) ) ), $tag_list );
		}
	}
}

/**
 * Adjusts content_width value for full-width templates and attachments
 *
 * @since SitePoint Ecommerce 1.0
 *
 * @return void
 */
if ( ! function_exists( 'SitePoint_Ecommerce_content_width' ) ) {
	function SitePoint_Ecommerce_content_width() {
		if ( is_page_template( 'full-width.php' ) || is_attachment() ) {
			global $content_width;
			$content_width = 1160;
		}
	}
}
add_action( 'template_redirect', 'SitePoint_Ecommerce_content_width' );

/**
 * Change the "read more..." link so it links to the top of the page rather than part way down
 *
 * @since SitePoint Ecommerce 1.0
 *
 * @param string The 'Read more' link
 * @return string The link to the post url without the more tag appended on the end
 */
function SitePoint_Ecommerce_remove_more_jump_link( $link ) {
	$offset = strpos( $link, '#more-' );
	if ( $offset ) {
		$end = strpos( $link, '"', $offset );
	}
	if ( $end ) {
		$link = substr_replace( $link, '', $offset, $end-$offset );
	}
	return $link;
}
add_filter( 'the_content_more_link', 'SitePoint_Ecommerce_remove_more_jump_link' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since SitePoint Ecommerce 1.0
 *
 * @return string The 'Continue reading' link
 */
if ( ! function_exists( 'SitePoint_Ecommerce_continue_reading_link' ) ) {
	function SitePoint_Ecommerce_continue_reading_link() {
		return '&hellip;<p><a class="more-link" href="'. esc_url( get_permalink() ) . '">' . wp_kses( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sitepoint-ecommerce' ), array( 'span' => array(
				'class' => array() ) ) ) . '</a></p>';
	}
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with the SitePoint_Ecommerce_continue_reading_link().
 *
 * @since SitePoint Ecommerce 1.0
 *
 * @param string Auto generated excerpt
 * @return string The filtered excerpt
 */
if ( ! function_exists( 'SitePoint_Ecommerce_auto_excerpt_more' ) ) {
	function SitePoint_Ecommerce_auto_excerpt_more( $more ) {
		return SitePoint_Ecommerce_continue_reading_link();
	}
}
add_filter( 'excerpt_more', 'SitePoint_Ecommerce_auto_excerpt_more' );

/**
 * Unhook the WooCommerce Wrappers
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

/**
 * Outputs the opening container div for WooCommerce
 *
 * @since SitePoint Ecommerce 1.0
 *
 * @return void
 */
if ( ! function_exists( 'SitePoint_Ecommerce_before_woocommerce_wrapper' ) ) {
	function SitePoint_Ecommerce_before_woocommerce_wrapper() {
		echo '<div id="maincontentcontainer">';
		echo '<div id="primary" class="grid-container site-content" role="main">';
	}
}

/**
 * Outputs the closing container div for WooCommerce
 *
 * @since SitePoint Ecommerce 1.0
 *
 * @return void
 */
if ( ! function_exists( 'SitePoint_Ecommerce_after_woocommerce_wrapper' ) ) {
	function SitePoint_Ecommerce_after_woocommerce_wrapper() {
		echo '</div> <!-- /#primary.grid-container.site-content -->';
		echo '</div> <!-- /#maincontentcontainer -->';
	}
}

/**
 * Check if WooCommerce is active
 *
 * @since SitePoint Ecommerce 1.0
 *
 * @return void
 */
function SitePoint_Ecommerce_is_woocommerce_active() {
	return in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
}

/**
 * Check if WooCommerce is active and a WooCommerce template is in use and output the containing div
 *
 * @since SitePoint Ecommerce 1.0
 *
 * @return void
 */
if ( ! function_exists( 'SitePoint_Ecommerce_setup_woocommerce_wrappers' ) ) {
	function SitePoint_Ecommerce_setup_woocommerce_wrappers() {
		if ( SitePoint_Ecommerce_is_woocommerce_active() && is_woocommerce() ) {
				add_action( 'SitePoint_Ecommerce_before_woocommerce', 'SitePoint_Ecommerce_before_woocommerce_wrapper', 10, 0 );
				add_action( 'SitePoint_Ecommerce_after_woocommerce', 'SitePoint_Ecommerce_after_woocommerce_wrapper', 10, 0 );
		}
	}
}
add_action( 'template_redirect', 'SitePoint_Ecommerce_setup_woocommerce_wrappers', 9 );

/**
 * Outputs the opening wrapper for the WooCommerce content
 *
 * @since SitePoint Ecommerce 1.0
 *
 * @return void
 */
if ( ! function_exists( 'SitePoint_Ecommerce_woocommerce_before_main_content' ) ) {
	function SitePoint_Ecommerce_woocommerce_before_main_content() {
		if ( is_product() ) {
			echo '<div class="grid-100">';
		}
		else {
			echo '<div class="grid-70">';
		}
	}
}
add_action( 'woocommerce_before_main_content', 'SitePoint_Ecommerce_woocommerce_before_main_content', 10 );

/**
 * Outputs the closing wrapper for the WooCommerce content
 *
 * @since SitePoint Ecommerce 1.0
 *
 * @return void
 */
if ( ! function_exists( 'SitePoint_Ecommerce_woocommerce_after_main_content' ) ) {
	function SitePoint_Ecommerce_woocommerce_after_main_content() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_main_content', 'SitePoint_Ecommerce_woocommerce_after_main_content', 10 );

/**
 * Remove the sidebar from the WooCommerce product page
 *
 * @since SitePoint Ecommerce 1.0
 *
 * @return void
 */
if ( ! function_exists( 'SitePoint_Ecommerce_remove_woocommerce_sidebar' ) ) {
	function SitePoint_Ecommerce_remove_woocommerce_sidebar() {
		if ( is_product() ) {
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		}
	}
}
add_action( 'woocommerce_before_main_content', 'SitePoint_Ecommerce_remove_woocommerce_sidebar' );

/**
 * Set the number of products to display on the WooCommerce shop page
 *
 * @since SitePoint Ecommerce 1.0
 *
 * @return void
 */
if ( ! function_exists( 'SitePoint_Ecommerce_shop_product_count' ) ) {
	function SitePoint_Ecommerce_shop_product_count( $numprods ) {
		return 12;
	}
}
add_filter( 'loop_shop_per_page', 'SitePoint_Ecommerce_shop_product_count', 20 );

/**
 * Filter the WooCommerce pagination so that it matches the theme pagination
 *
 * @since SitePoint Ecommerce 1.0
 *
 * @return array Pagination arguments
 */
if ( ! function_exists( 'SitePoint_Ecommerce_woocommerce_pagination_args' ) ) {
	function SitePoint_Ecommerce_woocommerce_pagination_args( $paginationargs ) {
		$paginationargs[ 'prev_text'] = wp_kses( __( '<i class="fa fa-angle-left"></i> Previous', 'sitepoint-ecommerce' ), array( 'i' => array(
			'class' => array() ) ) );
		$paginationargs[ 'next_text'] = wp_kses( __( 'Next <i class="fa fa-angle-right"></i>', 'sitepoint-ecommerce' ), array( 'i' => array(
			'class' => array() ) ) );
		return $paginationargs;
	}
}
add_filter( 'woocommerce_pagination_args', 'SitePoint_Ecommerce_woocommerce_pagination_args', 10 );

require get_template_directory() . '/custom-woo-function/custom-woo-function.php';
class MySettingsPage{
    /*** Holds the values to be used in the fields callbacks*/
    private $options;
    /*** Start up*/
    public function __construct(){
        add_action( 'admin_menu', array( $this, 'add_theme_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }
    /*** Add options page*/
    public function add_theme_page(){
        // This page will be under "Settings"
        add_theme_page(
            'Settings Admin',
            'Mailchimp Integration',
            'manage_options',
            'my-setting-admin',
            array( $this, 'create_admin_page' )
        );
    }
    /*** Options page callback */
    public function create_admin_page(){
        // Set class property
        $this->options = get_option( 'mailchimp_option' );
        ?>
        <div class="wrap">
            <h1>Mailchimp Integration</h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'mailchimp_group' );
                do_settings_sections( 'my-setting-admin' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }
    /*** Register and add settings */
    public function page_init(){
        register_setting(
            'mailchimp_group', // Option group
            'mailchimp_option', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );
        add_settings_section(
            'setting_section_id', // ID
            'My Custom Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'my-setting-admin' // Page
        );
        add_settings_field(
            'shortcode',
            'shortcode',
            array( $this, 'shortcode_callback' ),
            'my-setting-admin',
            'setting_section_id'
        );
    }
    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input ){
        $new_input = array();
        if( isset( $input['shortcode'] ) )
            $new_input['shortcode'] = sanitize_text_field( $input['shortcode'] );
        return $new_input;
    }
    /*** Print the Section text*/
    public function print_section_info(){
        print 'Use <a href="https://wordpress.org/plugins/mailchimp-for-wp/">Mailchimp for WP</a> plugin and get your shortcode. ';
    }

    /*** Get the settings option array and print one of its values*/
    public function shortcode_callback(){
        printf(
            '<input type="text" placeholder="e.g [mc4wp_form id="1"]" id="shortcode" name="mailchimp_option[shortcode]" value="%s" />',
            isset( $this->options['shortcode'] ) ? esc_attr( $this->options['shortcode']) : ''
        );
    }
}

if( is_admin() )
    $my_settings_page = new MySettingsPage();
		// set front-page.php as the default homepage/front-page template
		function themeslug_filter_front_page_template( $template ) {
		    return is_home() ? '' : $template;
		}
		add_filter( 'frontpage_template', 'themeslug_filter_front_page_template' );

function SitePoint_Ecommerce_register_theme_customizer( $wp_customize ) {
 	// Added Sections (footer settings and social media)
	$wp_customize->add_section( 'SitePoint_Ecommerce_new_section_header' , array(
				'title'      => 'Header Image Caption',
				'description'=> '',
				'priority'   => 60,
	) );


	$wp_customize->add_section( 'SitePoint_Ecommerce_new_section_footer' , array(
    		'title'      => 'Footer Elements',
    		'description'=> '',
    		'priority'   => 98,
 	) );

	$wp_customize->add_section( 'SitePoint_Ecommerce_new_background_section' , array(
				'title'      => 'Background Section Settings',
				'description'=> '',
				'priority'   => 93,
	) );


 	$wp_customize->add_section( 'SitePoint_Ecommerce_new_section_social' , array(
    		'title'      => 'Social Media Settings',
    		'description'=> 'Enter your social media usernames. Icons will not show if left blank.',
    		'priority'   => 97,
 	) );


// section values
 		// Social Media
 		$wp_customize->add_setting(
 	        'SitePoint_Ecommerce_facebook',
 	        array(
            'default'     => 'www.facebook.com/yourpage'
 	        )
 	    );
 		$wp_customize->add_setting(
 	        'SitePoint_Ecommerce_instagram',
 	        array(
 	            'default'     => 'www.instagram.com/yourpage'
 	        )
 	    );
 		$wp_customize->add_setting(
 	        'SitePoint_Ecommerce_pinterest',
 	        array(
 	            'default'     => 'www.pinterest.com/yourpage'
 	        )
 	    );
		$wp_customize->add_setting(
						'SitePoint_Ecommerce_instagram_section',
						array(
								'default'     => 'your-ig-username'
						)
				);

		// footer Elements
		$wp_customize->add_setting(
 	        'SitePoint_Ecommerce_footer_address',
 	        array(
            'default'     => '2650 Plum St, Chicester UK SW201'
 	        )
 	    );

		$wp_customize->add_setting(
					'SitePoint_Ecommerce_footer_contact_email',
					array(
						'default'     => ''
					)
			);

			$wp_customize->add_setting(
						'SitePoint_Ecommerce_footer_contact_tel',
						array(
							'default'     => ''
						)
				);

 		// Footer
 		$wp_customize->add_setting(
 	        'SitePoint_Ecommerce_footer_copyright_center',
 	        array(
 	            'default'     => 'Made with love. All rights reserved. Copyright 2016'
 	        )
 	    );


			$wp_customize->add_setting(
						'instagram_bg',
						array(
							'default'     => '#CCCCCC'
						)
				);

				$wp_customize->add_setting(
							'newsletter_bg',
							array(
								'default'     => '#E3E4E5'
							)
					);

		// Colors general
				$wp_customize->add_control(
					new WP_Customize_Color_Control(
						$wp_customize,
						'instagram_bg',
						array(
							'label'      => 'Instagram Section Background',
							'section'    => 'SitePoint_Ecommerce_new_background_section',
							'settings'   => 'instagram_bg',
							'priority'	 => 1
						)
					)
				);
				// Colors general
				$wp_customize->add_control(
					new WP_Customize_Color_Control(
						$wp_customize,
						'newsletter_bg',
						array(
							'label'      => 'News Letter Background',
							'section'    => 'SitePoint_Ecommerce_new_background_section',
							'settings'   => 'newsletter_bg',
							'priority'	 => 2
						)
					)
				);



 		// Footer
 		$wp_customize->add_control(
 			new WP_Customize_Control(
 				$wp_customize,
 				'footer_copyright_left',
 				array(
 					'label'      => 'Footer Copyright',
 					'section'    => 'SitePoint_Ecommerce_new_section_footer',
					'settings'   => 'SitePoint_Ecommerce_footer_copyright_center',
 					'type'		 => 'text',
 					'priority'	 => 1
 				)
 			)
 		);




 		// Social Media
 		$wp_customize->add_control(
 			new WP_Customize_Control(
 				$wp_customize,
 				'facebook',
 				array(
 					'label'      => 'Facebook',
 					'section'    => 'SitePoint_Ecommerce_new_section_footer',
 					'settings'   => 'SitePoint_Ecommerce_facebook',
 					'type'		 => 'text',
 					'priority'	 => 2
 				)
 			)
 		);

 		$wp_customize->add_control(
 			new WP_Customize_Control(
 				$wp_customize,
 				'instagram',
 				array(
 					'label'      => 'Instagram',
 					'section'    => 'SitePoint_Ecommerce_new_section_footer',
 					'settings'   => 'SitePoint_Ecommerce_instagram',
 					'type'		 => 'text',
 					'priority'	 => 3
 				)
 			)
 		);
 		$wp_customize->add_control(
 			new WP_Customize_Control(
 				$wp_customize,
 				'pinterest',
 				array(
 					'label'      => 'Pinterest',
 					'section'    => 'SitePoint_Ecommerce_new_section_footer',
 					'settings'   => 'SitePoint_Ecommerce_pinterest',
 					'type'		 => 'text',
 					'priority'	 => 4
 				)
 			)
 		);




		$wp_customize->add_control(
 			new WP_Customize_Control(
 				$wp_customize,
 				'Address',
 				array(
 					'label'      => 'Address',
 					'section'    => 'SitePoint_Ecommerce_new_section_footer',
 					'settings'   => 'SitePoint_Ecommerce_footer_address',
 					'type'		 => 'textarea',
 					'priority'	 => 6
 				)
 			)
 		);

		$wp_customize->add_control(
 			new WP_Customize_Control(
 				$wp_customize,
 				'Email',
 				array(
 					'label'      => 'Email',
 					'section'    => 'SitePoint_Ecommerce_new_section_footer',
 					'settings'   => 'SitePoint_Ecommerce_footer_contact_email',
 					'type'		 => 'text',
 					'priority'	 => 7
 				)
 			)
 		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'Phone',
				array(
					'label'      => 'Phone',
					'section'    => 'SitePoint_Ecommerce_new_section_footer',
					'settings'   => 'SitePoint_Ecommerce_footer_contact_tel',
					'type'		 => 'text',
					'priority'	 => 8
				)
			)
		);


		$wp_customize->remove_section( 'nav');
		$wp_customize->remove_section( 'background_image');
		$wp_customize->remove_section( 'colors');
	  $wp_customize->remove_section( 'header_image');

}
add_action( 'customize_register', 'SitePoint_Ecommerce_register_theme_customizer' );

require get_template_directory() . '/inc/customizer-style.php';
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own sitepoint_portfolio_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 * (Note the lack of a trailing </li>. WordPress will add it itself once it's done listing any children and whatnot)
 *
 * @since Sitepoint Portfolio 1.0
 *
 * @param array Comment
 * @param array Arguments
 * @param integer Comment depth
 * @return void
 */
if ( ! function_exists( 'sitepoint_portfolio_comment' ) ) {
	function sitepoint_portfolio_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) {
		case 'pingback' :
		case 'trackback' :
			// Display trackbacks differently than normal comments ?>
			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="pingback">
					<p><?php esc_html_e( 'Pingback:', 'sitepoint-portfolio' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'sitepoint-portfolio' ), '<span class="edit-link">', '</span>' ); ?></p>
				</article> <!-- #comment-##.pingback -->
			<?php
			break;
		default :
			// Proceed with normal comments.
			global $post; ?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="comment">
					<header class="comment-meta comment-author vcard">
						<?php
						echo get_avatar( $comment, 44 );
						printf( '<cite class="fn commenter">%1$s %2$s</cite>',get_comment_author_link(), ( $comment->user_id === $post->post_author ) ? '<span> ' . esc_html__( '', 'sitepoint-portfolio' ) . '</span>' : '' );
						printf( '<div class="date-comment-posted"><a href="%1$s"><time itemprop="datePublished" datetime="%2$s">%3$s</time></a></div>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							/* Translators: 1: date, 2: time */
							sprintf( esc_html__( '%1$s', 'sitepoint-portfolio' ), get_comment_date() )
						);
						?>
					</header> <!-- .comment-meta -->

					<?php if ( '0' == $comment->comment_approved ) { ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'sitepoint-portfolio' ); ?></p>
					<?php } ?>

					<div class="comment-content comment">
						<?php comment_text(); ?>
						<?php edit_comment_link( esc_html__( 'Edit', 'sitepoint-portfolio' ), '<p class="edit-link">', '</p>' ); ?>
					</div> <!-- .comment-content -->

					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => wp_kses( __( 'Reply', 'sitepoint-portfolio' ), array( 'span' => array() ) ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div> <!-- .reply -->
				</article> <!-- #comment-## -->
			<?php
			break;
		} // end comment_type check
	}
}
/**
 * Update the Comments form so that the 'required' span is contained within the form label.
 *
 * @since Sitepoint Portfolio 1.0
 *
 * @param string Comment form fields html
 * @return string The updated comment form fields html
 */
if ( ! function_exists( 'sitepoint_eccommerce_comment_form_default_fields' ) ) {
	function sitepoint_portfolio_comment_form_default_fields( $fields ) {
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? ' aria-required="true"' : "" );
		$fields[ 'author' ] = '<div class="row-comment-form"><div class="grid-33"><p class="comment-form-author here">' .  ( $req ? '' : '' ) .'<input id="author" placeholder="Name" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p></div>';
		$fields[ 'email' ] =  '<div class="grid-33"><p class="comment-form-email here">' . ( $req ? '' : '' ) . '<input class="form-control" id="email" name="email" placeholder="Email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p></div>';
		$fields[ 'url' ] =  '<div class="grid-33"><p class="comment-form-url here"><input id="url" name="url" class="form-control" placeholder="Website" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p></div></div>';
		$fields[ 'comment_field' ] = '<div class="row-comment-form"><div class="grid-100"><textarea id="comment" name="comment" placeholder="Comment" class="form-control" aria-required="true"></textarea></div></div>';
		return $fields;
	}
}
add_action( 'comment_form_default_fields', 'sitepoint_eccommerce_comment_form_default_fields' );

// set max products to display woocommerce

$default_posts_per_page = get_option( 'posts_per_page' );

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$default_posts_per_page.';' ), 20 );



function sitepoint_ecommerce_svg_blur(){ ?>
	<svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewbox="0 0 0 0">
	      <defs>
	        <filter id="filter" width="110%" height="120%">
	          <feColorMatrix type="matrix" values=".85   0   0   0   0  0   .8    0   0   0  0    0   .9   0   0 0    0    0   1   0 "/>
	          <feGaussianBlur color-interpolation-filters="sRGB" id="blur_1" stdDeviation="4" result="blur"/>
	          <feImage id="feimage" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAAAgCAYAAABXTzdxAAAA7klEQVR4Xu3VsRHDMAwEQZH992w3YDm49Fc5Aix4o3Pv/Tw+AgR+ChyBeBkE3gUE4nUQ+CMgEM+DgEC8AQJNwB+kuZkaERDIyKGt2QQE0txMjQgIZOTQ1mwCAmlupkYEBDJyaGs2AYE0N1MjAgIZObQ1m4BAmpupEQGBjBzamk1AIM3N1IiAQEYObc0mIJDmZmpEQCAjh7ZmExBIczM1IiCQkUNbswkIpLmZGhEQyMihrdkEBNLcTI0ICGTk0NZsAgJpbqZGBAQycmhrNgGBNDdTIwICGTm0NZuAQJqbqREBgYwc2ppNQCDNzdSIwBcOlSDBVU1uzAAAAABJRU5ErkJggg=="
	        x="0%" y="-3%"   result="mask" />
	            <feComposite in2="mask" in="blur" operator="in" result="comp" />
	          <feMerge  result="merge">
	            <feMergeNode in="SourceGraphic" />
	             <feMergeNode in="comp" />
	          </feMerge>
	        </filter>
	      </defs>
	</svg>
<?php }
add_action( 'wp_head', 'sitepoint_ecommerce_svg_blur' );
