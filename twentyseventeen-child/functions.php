<?php
function my_theme_enqueue_styles() {

    $parent_style = 'twentyseventeen-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
// Do not use Google fonts remotely, enabling usage of the local version in fonts/.
// This improves the privacy of website visitors, as requests to the Google fonts may allow tracking.
function dequeue_unwanted_parent_theme_stuff() {
    wp_dequeue_style('twentyseventeen-fonts');
    wp_deregister_style('twentyseventeen-fonts');
}

// Prevent leaking of HTTP referer [sic] for browser's which support this.
function add_privacy_headers(){
    ?>
    <meta name="referrer" content="no-referrer">
    <?php
}

// Do not store IP of users who leave a comment.
// Reference: https://codex.wordpress.org/Plugin_API/Filter_Reference/pre_comment_user_ip
function wpb_remove_commentsip( $comment_author_ip ) {
  return '';
}
add_filter( 'pre_comment_user_ip', 'wpb_remove_commentsip' );

// Remove emoticon scripts, they also contact third party websites
function dequeue_unwanted_wordpress_stuff() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
}


add_action('wp_head', 'add_privacy_headers');
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles' );
add_action('wp_enqueue_scripts', 'dequeue_unwanted_parent_theme_stuff', 100);
add_action('wp_enqueue_scripts', 'dequeue_unwanted_wordpress_stuff', 101);
?>
