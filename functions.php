<?php
// Main code file for the artist 22 theme
/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
    require_once get_template_directory() . '/includes/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

add_filter( 'nav_menu_link_attributes', 'prefix_bs5_dropdown_data_attribute', 20, 3 );
/**
 * Use namespaced data attribute for Bootstrap's dropdown toggles.
 *
 * @param array    $atts HTML attributes applied to the item's `<a>` element.
 * @param WP_Post  $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @return array
 */
function prefix_bs5_dropdown_data_attribute( $atts, $item, $args ) {
    if ( is_a( $args->walker, 'WP_Bootstrap_Navwalker' ) ) {
        if ( array_key_exists( 'data-toggle', $atts ) ) {
            unset( $atts['data-toggle'] );
            $atts['data-bs-toggle'] = 'dropdown';
        }
    }
    return $atts;
}

// remove emoji print styles
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// custom header
register_default_headers( array(
    'header' => array(
        'url'   => get_template_directory_uri() . '/images/logo-artist-22.png',
        'thumbnail_url' => get_template_directory_uri() . '/images/logo-artist-22.png',
        'description'   => _x( 'header', 'the logo', 'artist-22-logo' )),
));

$args = array(

    'default-image' => get_template_directory_uri() . '/images/logo-artist-22.png',
    'uploads'       => true,
);
add_theme_support( 'custom-header', $args );


// svg mime type support
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

add_post_type_support( 'page', 'excerpt' );

add_post_type_support( 'post', 'excerpt' );

// remove p tags from content
/*remove_filter('the_content','wpautop');

do_shortcode( get_post_meta( $post->ID, 'content', true ) );

//decide when you want to apply the auto paragraph

add_filter('the_content','my_custom_formatting');

function my_custom_formatting($content){
    if(get_post_type()=='home') //if it does not work, you may want to pass the current post object to get_post_type
        return $content;//no autop
    else
        return wpautop($content);
}*/

// Add default posts and comments RSS feed links to head.
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 825, 510, true );

/*============================================
Register navbar and sidebar
=============================================*/

register_nav_menus( array(
    'primary' => __( 'Main Menu', 'main-menu' ),
    'utility' => __( 'Utility Menu', 'utility-menu' ),
    'footer-1' => __( 'Footer Menu - Col 1', 'footer-menu-1'),
    'footer-2' => __( 'Footer Menu - Col 2', 'footer-menu-2'),
    'footer-3' => __( 'Footer Menu - Col 3', 'footer-menu-3'),
) );


add_action('wp_enqueue_scripts', 'header_enqueue_css');
add_action('wp_enqueue_scripts', 'footer_enqueue_js');


/*============================================
Enqueue js and css
=============================================*/


function header_enqueue_css() {
    //load css files
    wp_enqueue_style('bootstrap', get_template_directory_uri(). '/css/bootstrap-custom/custom.css', '');
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css', '');
    //wp_enqueue_style('fontawesome', get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css', '');
    //wp_enqueue_style('flickitycss', get_template_directory_uri() . '/js/vendor/flickity/flickity.css', '');
    wp_enqueue_style('aoscss', get_template_directory_uri() . '/js/vendor/aos/aos.css', '');
}

function footer_enqueue_js() {

    //load js files
    wp_enqueue_script('jquery', get_template_directory_uri() . '/js/vendor/jquery-1.9.min.js', 'jquery','1.9',TRUE);
    wp_enqueue_script('bootstrapjs', get_template_directory_uri() . '/js/vendor/bootstrap/bootstrap.bundle.js','bootstrap', '5.1.3', TRUE);
    wp_enqueue_script('main', get_template_directory_uri() . '/js/site.js', 'main','1.3',TRUE);

    // vendor scripts
    wp_enqueue_script('flickity', get_template_directory_uri() . '/js/vendor/flickity/flickity.pkgd.js','', '2.0', TRUE);
    wp_enqueue_script('aos', get_template_directory_uri() . '/js/vendor/aos/aos.js','', '2.0', TRUE);
    wp_enqueue_script('easing', get_template_directory_uri() . '/js/vendor/jquery-easing/jquery.easing.js','jquery', '2.0', TRUE);
    wp_enqueue_script('appear', get_template_directory_uri() . '/js/vendor/appear-js/appear.min.js','', '2.0', TRUE);
    wp_enqueue_script('parallax', get_template_directory_uri() . '/js/vendor/parallax-js/parallax.min.js','jquery', '1.3', TRUE);

}

/*--------------------------------------------------------*\
   Register Custom Post Types
\*--------------------------------------------------------*/

function gc_register_post_types() {
    $post__types = [
        'news' => ['menu_icon' => 'dashicons-megaphone']
    ];

    foreach ($post__types as $key => $options) {
        $labels = [
            'name' => _x(ucfirst($key), 'post type general name'),
            'singular_name' => _x(ucfirst($key), 'post type singular name'),
            'add_new' => _x('Add New', ucfirst($key)),
            'add_new_item' => 'Add New' . ucfirst($key),
            'edit_item' => 'Edit ' . ucfirst($key),
            'new_item' => 'New ' . ucfirst($key),
            'view_item' => 'View ' . ucfirst($key),
            'search_items' => 'Search ' . ucfirst($key),
            'not_found' => 'Nothing found',
            'not_found_in_trash' => 'Nothing found in Trash',
            'parent_item_colon' => ''
        ];

        $defaults = [
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => ['title', 'editor', 'thumbnail', 'revisions'],
            'show_in_nav_menus' => true,
        ];

        $args = array_merge($defaults, $options);
        register_post_type($key, $args);
    }
}

add_action('init', 'gc_register_post_types');


/*--------------------------------------------------------*\
   Register Widgets
\*--------------------------------------------------------*/

function sidebar_widget_init() {

    register_sidebar(array(
        'name' => 'Primary Sidebar Widgets',
        'id' => 'primary_sidebar',
        'description' => 'These are widgets for primary sidebar.',
        'before_widget' => '<div class="sidebar">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
}
add_action( 'widgets_init', 'sidebar_widget_init' );

function social_widget_init() {

    register_sidebar( array(
        'name' => 'Social Widget',
        'id' => 'social_widget',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="hide">',
        'after_title' => '</h2>',
    ) );
}
add_action( 'widgets_init', 'social_widget_init' );

function copyright_widget_init() {

    register_sidebar( array(
        'name' => 'Copyright Widget',
        'id' => 'copyright_widget',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => '',
    ) );
}
add_action( 'widgets_init', 'copyright_widget_init' );

function lightbox_widget_init() {

	register_sidebar( array(
		'name' => 'Lightbox Widget',
		'id' => 'lightbox_widget',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	) );
}
add_action( 'widgets_init', 'lightbox_widget_init' );

function footer_widget_init() {

	register_sidebar( array(
		'name' => 'Footer Widget',
		'id' => 'footer_widget',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	) );
}
add_action( 'widgets_init', 'footer_widget_init' );

function disclaimer_widget_init() {

	register_sidebar( array(
		'name' => 'Disclaimer Widget',
		'id' => 'disclaimer_widget',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	) );
}
add_action( 'widgets_init', 'disclaimer_widget_init' );

function externallink_widget_init() {

	register_sidebar( array(
		'name' => 'External Link Disclaimer Widget',
		'id' => 'externallink_widget',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	) );
}
add_action( 'widgets_init', 'externallink_widget_init' );

// Excerpt customizations

function get_excerpt($count){
    $excerpt = get_the_excerpt();
    $excerpt = strip_tags($excerpt);
    if(strlen($excerpt) > $count){
        $excerpt = substr($excerpt, 0, $count) . '&#8230;';
    }
    return $excerpt. '<br /><a class="moretag" href="'. get_permalink($post->ID) . '"> Read the full article...</a>' ;
}


// Reduce nav classes, leaving only 'current-menu-item'

function nav_class_filter( $var, $item) {
    $resultArray = is_array($var) ? array_intersect($var, array('current-menu-item', 'menu-item', 'current-page-parent')) : array();
    $resultArray[] = 'nav-'.cleanname($item->title);
    return $resultArray;
}
add_filter('nav_menu_css_class', 'nav_class_filter', 100, 2);

function cleanname($v) {
    $v = preg_replace('/[^a-zA-Z0-9s]/', '', $v);
    $v = str_replace(' ', '-', $v);
    $v = strtolower($v);
    return $v;
}

// Bootstrap pagination function

function gc_pagination( $pages = '', $range = 4 ) {

    $showitems = ( $range * 2 ) + 1;

    global $paged;

    if ( empty( $paged ) ) {
        $paged = 1;
    }

    if ( $pages == '' ) {

        global $wp_query;

        $pages = $wp_query->max_num_pages;

        if ( ! $pages ) {
            $pages = 1;
        }

    }


    if ( 1 != $pages ) {

        echo '<nav><ul class="pagination"><li class="disabled hidden-xs"><span><span aria-hidden="true">Page ' . $paged . ' of ' . $pages . '</span></span></li>';

        if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) {
            echo "<li><a href='" . get_pagenum_link( 1 ) . "' aria-label='First'>&laquo;<span class='hidden-xs'> First</span></a></li>";
        }

        if ( $paged > 1 && $showitems < $pages ) {
            echo "<li><a href='" . get_pagenum_link( $paged - 1 ) . "' aria-label='Previous'>&lsaquo;<span class='hidden-xs'> Previous</span></a></li>";
        }

        for ( $i = 1; $i <= $pages; $i ++ ) {

            if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {

                echo ( $paged == $i ) ? "<li class=\"active\"><span>" . $i . " <span class=\"sr-only\">(current)</span></span>

    </li>" : "<li><a href='" . get_pagenum_link( $i ) . "'>" . $i . "</a></li>";

            }
        }


        if ( $paged < $pages && $showitems < $pages ) {
            echo "<li><a href=\"" . get_pagenum_link( $paged + 1 ) . "\"  aria-label='Next'><span class='hidden-xs'>Next </span>&rsaquo;</a></li>";
        }

        if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages ) {
            echo "<li><a href='" . get_pagenum_link( $pages ) . "' aria-label='Last'><span class='hidden-xs'>Last </span>&raquo;</a></li>";
        }

        echo "</ul></nav>";
    }

}

//for blogs with no featured image

function get_primary_image($id, $size){
    $featured = wp_get_attachment_image_src( get_post_thumbnail_id($id), $size, false);
    if($featured){
        $childURL = $featured['0'];
    }else{
        $children = get_children(array('post_parent' => $id, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'numberposts' => 1));
        reset($children);
        $childID = key($children);
        //$childURL = wp_get_attachment_url($childID);
        $childArray = wp_get_attachment_image_src($childID, $size, false);
        $childURL = $childArray['0'];
        if(empty($childURL)){
            $childURL = get_bloginfo('template_url')."/images/default.png";
        } else {
            update_post_meta($id, '_thumbnail_id', $childID);
        }
    }
    return($childURL);
}

// color palette for ACF

/**
 * Generate breadcrumbs
 * @author CodexWorld
 * @authorURL www.codexworld.com
 */
function get_breadcrumb() {
    echo '<a href="'.home_url().'" rel="nofollow">Home</a>';
    if (is_category() || is_single()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        echo '<a href="/blog" rel="nofollow">Blog</a>';
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        the_category(' &bull; ');
        if (is_single()) {
            echo " &nbsp;&nbsp;&#187;&nbsp;&nbsp; ";
            the_title();
        }
    } elseif (is_page()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        echo the_title();
    } elseif (is_search()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
}

function my_acf_color_palatte_script() {
    ?>
    <script type="text/javascript">
        (function($){

            acf.add_filter('color_picker_args', function( args, $field ){

                // do something to args
                args.palettes = ['#fcfcfc','#003767', '#70B9C4', '#E46D2D' , '#1a4b76'];

                //console.log(args);
                // return
                return args;
            });

        })(jQuery);
    </script>
    <?php
}

add_action('acf/input/admin_footer', 'my_acf_color_palatte_script');

//add_filter('acf/format_value/type=textarea', 'do_shortcode');

//add_filter('acf/format_value/type=wysiwyg', 'do_shortcode');

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.0
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

require_once dirname( __FILE__ ) . '/functions/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

function my_theme_register_required_plugins() {

    $plugins = array(

        array(
            'name'      => 'Classic Editor',
            'slug'      => 'classic-editor',
            'required'  => true,
        ),

        array(
            'name'      => 'Classic Widgets',
            'slug'      => 'classic-widgets',
            'required'  => true,
        ),

        array(
            'name'      => 'Simple 301 Redirects',
            'slug'      => 'simple-301-redirects',
            'required'  => true,
        ),

        array(
            'name'      => 'Page Links To',
            'slug'      => 'page-links-to',
            'required'  => true,
        ),

        array(
            'name'      => 'Simple Custom Post Order',
            'slug'      => 'simple-custom-post-order',
            'required'  => true,
        ),

        array(
            'name'      => 'Responsive Lightbox and Gallery',
            'slug'      => 'responsive-lightbox',
            'required'  => false,
        ),

        array(
            'name'      => 'MP3-jPlayer',
            'slug'      => 'mp3-jplayer',
            'required'  => false,
        ),

        array(
            'name'      => "IT's Tracking Code",
            'slug'      => 'its-tracking-code',
            'required'  => false,
        ),

        array(
            'name'      => 'The SEO Framework',
            'slug'      => 'autodescription',
            'required'  => false,
        ),

        array(
            'name'      => 'Autoptimize',
            'slug'      => 'autoptimize',
            'required'  => false,
        )

    );

    /*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

    );

    tgmpa( $plugins, $config );
}

