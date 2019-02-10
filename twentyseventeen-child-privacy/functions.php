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
// This requires the fonts you use to be stored on your server. WARNING: Changing the default fonts means you have to manually add
// them to ../fonts. I have added the default one for this theme there already, so you do not need to
// do anything if you did not mess with the fonts.
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

// Remove the email field from the comments form. This requires that you change a WP settings:
// To do this: Settings > Discussion > Other Comment Settings. Then uncheck "Comment author must fill out name and email".
// reference: http://wpcomments.com/customize-comment-form/remove-email-field-with-code/
function privacy_remove_email_field_from_comment_form($fields) {
    if(isset($fields['email'])) unset($fields['email']);
    return $fields;
}
add_filter('comment_form_default_fields', 'privacy_remove_email_field_from_comment_form');


add_action('wp_head', 'add_privacy_headers');
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles' );
add_action('wp_enqueue_scripts', 'dequeue_unwanted_parent_theme_stuff', 100);
add_action('wp_enqueue_scripts', 'dequeue_unwanted_wordpress_stuff', 101);
?>
