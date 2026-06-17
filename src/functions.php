<?php
/**
 * Silver Liquid Dev theme functions.
 *
 * @package Silver_Liquid_Dev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'SILVER_LIQUID_DEV_VERSION' ) ) {
	define( 'SILVER_LIQUID_DEV_VERSION', '1.1.0' );
}

/**
 * Theme setup.
 */
function silver_liquid_dev_setup() {
	load_theme_textdomain( 'silver-liquid-dev', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 48,
		'width'       => 48,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'custom-background' );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'silver-liquid-dev' ),
		'footer'  => __( 'Footer Menu', 'silver-liquid-dev' ),
	) );

	add_image_size( 'silver-liquid-dev-card', 800, 480, true );
}
add_action( 'after_setup_theme', 'silver_liquid_dev_setup' );

/**
 * Content width.
 */
function silver_liquid_dev_content_width() {
	$GLOBALS['content_width'] = 760;
}
add_action( 'after_setup_theme', 'silver_liquid_dev_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function silver_liquid_dev_assets() {
	// Google Fonts: Space Grotesk (display), IBM Plex Sans (body), JetBrains Mono (code).
	wp_enqueue_style(
		'silver-liquid-dev-fonts',
		'https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,400;0,500;0,600;1,400&family=JetBrains+Mono:wght@400;500;700&family=Space+Grotesk:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style( 'silver-liquid-dev-style', get_stylesheet_uri(), array( 'silver-liquid-dev-fonts' ), SILVER_LIQUID_DEV_VERSION );

	wp_enqueue_script( 'silver-liquid-dev-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), SILVER_LIQUID_DEV_VERSION, true );
	wp_localize_script( 'silver-liquid-dev-theme', 'silverLiquidDev', array(
		'copy'   => __( 'Copy', 'silver-liquid-dev' ),
		'copied' => __( 'Copied', 'silver-liquid-dev' ),
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'silver_liquid_dev_assets' );

/**
 * Set the data-theme attribute early to prevent a flash of the wrong theme.
 */
function silver_liquid_dev_color_scheme_script() {
	?>
	<script>
	(function () {
		try {
			var stored = localStorage.getItem('silver-liquid-dev-theme');
			var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
			var theme = stored || (prefersDark ? 'dark' : 'light');
			document.documentElement.setAttribute('data-theme', theme);
		} catch (e) {}
	})();
	</script>
	<?php
}
add_action( 'wp_head', 'silver_liquid_dev_color_scheme_script', 1 );

/**
 * Register widget areas.
 */
function silver_liquid_dev_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'silver-liquid-dev' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Shown alongside the blog and archive listings.', 'silver-liquid-dev' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'silver_liquid_dev_widgets_init' );

/**
 * Estimated reading time in minutes.
 *
 * @param int|null $post_id Post ID.
 * @return int
 */
function silver_liquid_dev_reading_time( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$content = get_post_field( 'post_content', $post_id );
	$words   = str_word_count( wp_strip_all_tags( $content ) );
	return max( 1, (int) ceil( $words / 200 ) );
}

/**
 * Social profiles used in the hero and footer.
 * Edit the URLs here to point at your own accounts.
 *
 * @return array
 */
function silver_liquid_dev_social_links() {
	return apply_filters( 'silver_liquid_dev_social_links', array(
		'github' => array(
			'label' => 'GitHub',
			'url'   => 'https://github.com/pierrejochem',
		),
		'nuget'  => array(
			'label' => 'NuGet',
			'url'   => 'https://www.nuget.org/profiles/pierrejochem',
		),
		'rss'    => array(
			'label' => 'RSS',
			'url'   => get_feed_link(),
		),
	) );
}

/**
 * Inline SVG icon helper.
 *
 * @param string $name Icon key.
 * @return string
 */
function silver_liquid_dev_icon( $name ) {
	$icons = array(
		'github' => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 .5C5.7.5.5 5.7.5 12c0 5.1 3.3 9.4 7.9 10.9.6.1.8-.2.8-.6v-2c-3.2.7-3.9-1.4-3.9-1.4-.5-1.3-1.3-1.7-1.3-1.7-1.1-.7.1-.7.1-.7 1.2.1 1.8 1.2 1.8 1.2 1 1.8 2.8 1.3 3.5 1 .1-.8.4-1.3.7-1.6-2.6-.3-5.3-1.3-5.3-5.7 0-1.3.4-2.3 1.2-3.1-.1-.3-.5-1.5.1-3.1 0 0 1-.3 3.3 1.2a11.5 11.5 0 0 1 6 0C17.3 4.6 18.3 5 18.3 5c.6 1.6.2 2.8.1 3.1.8.8 1.2 1.8 1.2 3.1 0 4.4-2.7 5.4-5.3 5.7.4.4.8 1.1.8 2.2v3.3c0 .4.2.7.8.6 4.6-1.5 7.9-5.8 7.9-10.9C23.5 5.7 18.3.5 12 .5z"/></svg>',
		'nuget'  => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.4 9.6a2.6 2.6 0 1 0 0 5.2 2.6 2.6 0 0 0 0-5.2zM9 6.2a1.8 1.8 0 1 0 0 3.6 1.8 1.8 0 0 0 0-3.6zM12 1.2 4.2 5.7A4 4 0 0 0 2.2 9.2v5.6a4 4 0 0 0 2 3.5l7.8 4.5a4 4 0 0 0 4 0l7.8-4.5a4 4 0 0 0 2-3.5V9.2a4 4 0 0 0-2-3.5L16 1.2a4 4 0 0 0-4 0z" opacity=".18"/><circle cx="9" cy="8" r="2.4"/><circle cx="16.6" cy="12.4" r="3.4"/></svg>',
		'rss'    => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M4 11a9 9 0 0 1 9 9h2.8A11.8 11.8 0 0 0 4 8.2V11zm0 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6zm0-9a16 16 0 0 1 16 16h2.8A18.8 18.8 0 0 0 4 4.2V7z"/></svg>',
		'arrow'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>',
		'copy'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>',
		'sun'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="4.5"/><path d="M12 1.8v2.4M12 19.8v2.4M4.2 4.2l1.7 1.7M18.1 18.1l1.7 1.7M1.8 12h2.4M19.8 12h2.4M4.2 19.8l1.7-1.7M18.1 5.9l1.7-1.7"/></svg>',
		'moon'   => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/></svg>',
		'menu'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"/></svg>',
		'close'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M6 6l12 12M18 6 6 18"/></svg>',
	);

	return isset( $icons[ $name ] ) ? $icons[ $name ] : '';
}

/**
 * Render the post category as a pill (first category only, for cards).
 */
function silver_liquid_dev_primary_category() {
	$cats = get_the_category();
	if ( empty( $cats ) ) {
		return;
	}
	$cat = $cats[0];
	printf(
		'<a class="pill" href="%s">%s</a>',
		esc_url( get_category_link( $cat->term_id ) ),
		esc_html( $cat->name )
	);
}

/**
 * Trim the excerpt "read more" string.
 */
function silver_liquid_dev_excerpt_more() {
	return '…';
}
add_filter( 'excerpt_more', 'silver_liquid_dev_excerpt_more' );

/**
 * Slightly longer excerpts read better in cards.
 */
function silver_liquid_dev_excerpt_length() {
	return 28;
}
add_filter( 'excerpt_length', 'silver_liquid_dev_excerpt_length' );

/**
 * Add a class to <pre> blocks so the JS copy button can attach reliably.
 */
function silver_liquid_dev_body_classes( $classes ) {
	if ( is_singular() ) {
		$classes[] = 'singular';
	}
	return $classes;
}
add_filter( 'body_class', 'silver_liquid_dev_body_classes' );
