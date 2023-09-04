<?php
class farallonBase
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_filter('excerpt_length', array($this, 'excerpt_length'));
        add_filter('excerpt_more', array($this, 'excerpt_more'));
        add_filter("the_excerpt", array($this, 'custom_excerpt_length'), 999);
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ));
        add_theme_support('title-tag');
        register_nav_menu('farallon', 'farallon');
        register_nav_menu('farallon_footer', 'farallon_footer');
        add_theme_support('post-formats', array('status'));
        add_filter('pre_option_link_manager_enabled', '__return_true');
        add_action('widgets_init', array($this, 'widgets_init'));
    }

    function widgets_init()
    {

        register_sidebar(array(
            'name'          => '首页顶部',
            'id'            => 'topbar',
            'description'   => '首页',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="heading-title">',
            'after_title'   => '</h3>',
        ));
    }

    function custom_excerpt_length($excerpt)
    {
        if (has_excerpt()) {
            $excerpt = wp_trim_words(get_the_excerpt(), apply_filters("excerpt_length", 80));
        }
        return $excerpt;
    }

    function excerpt_more($more)
    {
        return '...';
    }

    function excerpt_length($length)
    {
        return 80;
    }

    function enqueue_styles()
    {
        wp_dequeue_style('global-styles');
        wp_enqueue_style('farallon-style', get_template_directory_uri() . '/build/css/app.min.css', array(), FARALLON_VERSION, 'all');
    }

    function enqueue_scripts()
    {
        wp_enqueue_script('farallon-script', get_template_directory_uri() . '/build/js/app.min.js', [], FARALLON_VERSION, true);
        wp_localize_script(
            'farallon-script',
            'obvInit',
            [
                'is_single' => is_singular(),
                'post_id' => get_the_ID(),
                'restfulBase' => esc_url_raw(rest_url()),
                'nonce' => wp_create_nonce('wp_rest'),
            ]
        );
        if (is_singular()) wp_enqueue_script("comment-reply");
    }
}

new farallonBase();
