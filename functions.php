<?php
/* REFRESH functions and definitions */
function refreshweb_setup() {
	load_theme_textdomain( 'refreshweb', get_template_directory() . '/languages' );
	add_editor_style();
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status', 'gallery', 'video', 'audio', 'chat' ) );
	register_nav_menu( 'primary', __( 'Primary Menu', 'refreshweb' ) );
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'refreshweb_setup' );

/* Create Functions Directory for cleanliness and ease of maintenance in the future */
define( 'REFRESH_BASE_DIR', TEMPLATEPATH . '/' );
define( 'REFRESH_BASE_URL', get_template_directory_uri() . '/' );

/* Enqueues scripts and styles for front-end */
function refreshweb_scripts_styles() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
				
	/* Loads our main stylesheet. */
	wp_enqueue_style( 'refreshweb-style', get_stylesheet_uri() );
		
	// Load jQuery and Theme Scripts - ADDITIONAL SCRIPTS ADDED HERE
	if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
	function my_jquery_enqueue() {
	   wp_deregister_script('jquery');
	   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", false, null);
	   wp_enqueue_script('jquery');
	}
	wp_enqueue_script( 'refreshweb-theme', 	REFRESH_BASE_URL . 'js/theme.js', 				array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'refreshweb_scripts_styles' );

/* Creates a nicely formatted and more specific title element text or output in head of document, based on current view. */
function refreshweb_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() )
		return $title;
	// Add the site name.
	$title .= get_bloginfo( 'name' );
	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'refreshweb' ), max( $paged, $page ) );
	return $title;
}
add_filter( 'wp_title', 'refreshweb_wp_title', 10, 2 );

/* Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link. */
function refreshweb_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'refreshweb_page_menu_args' );

/* Displays navigation to next/previous pages when applicable. */
if ( ! function_exists( 'refreshweb_content_nav' ) ) :
function refreshweb_content_nav( $nav_id ) {
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'refreshweb' ); ?></h3>
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'refreshweb' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'refreshweb' ) ); ?></div>
		</nav><!-- #<?php echo $nav_id; ?> .navigation -->
	<?php endif;
}
endif;
if ( ! function_exists( 'refreshweb_comment' ) ) :

/* Template for comments and pingbacks. */ 
function refreshweb_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'refreshweb' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'refreshweb' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'refreshweb' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'refreshweb' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->
			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'refreshweb' ); ?></p>
			<?php endif; ?>
			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'refreshweb' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'refreshweb' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;
 
/* Extends the default WordPress body class */
function refreshweb_body_class( $classes ) {
	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
		$classes[] = 'full-width';
	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
			$classes[] = 'two-sidebars';
	}
	if ( wp_style_is( 'refreshweb-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';
	if ( ! is_multi_author() )
		$classes[] = 'single-author';
	return $classes;
}
add_filter( 'body_class', 'refreshweb_body_class' );
/* Adds a pretty "Continue Reading" link to custom post excerpts */
function REFRESH_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= REFRESH_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'REFRESH_custom_excerpt_more' );


/* ---------------------------------------------------------------------- */
/*	Load Custom Functions in Functions Folder
/* ---------------------------------------------------------------------- */

/* REFRESH Branded Admin */
include( REFRESH_BASE_DIR . 'functions/admin.php' );

/* Admin CSS */
include( REFRESH_BASE_DIR . 'functions/css/admin-styles.php' );
 
/* Admin Additional General Settings */
include( REFRESH_BASE_DIR . 'functions/admin-general-settings.php' );

/* Admin Social Media Settings */
include( REFRESH_BASE_DIR . 'functions/admin-social-settings.php' );

/* Post Types */
include( REFRESH_BASE_DIR . '/functions/custom-post-types.php' );

/* Shortcodes */
include( REFRESH_BASE_DIR . 'functions/shortcode.php' );

// Register Custom Navigation Twitter Boostrap Walker
require_once( REFRESH_BASE_DIR . 'functions/twitter_bootstrap_nav_walker.php' ); 

/* Metabox */
function cmb_initialize_cmb_meta_boxes() {
	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once ( REFRESH_BASE_DIR . 'functions/custom-metabox-class.php');
}
add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );

include( REFRESH_BASE_DIR . 'functions/custom-metabox.php' );

/* User Profile Fields */
include( REFRESH_BASE_DIR . 'functions/profile.php' );   

/* Browser Detect */
include( REFRESH_BASE_DIR . 'functions/browser-detect.php' );
?>