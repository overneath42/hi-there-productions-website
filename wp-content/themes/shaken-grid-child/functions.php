<?php

// add Council name field to comment form

function council_field($fields) {
	$fields['council'] = '<p class="comment-form-council"><label for="council">GSUSA Council Name</label><input id="council" name="council" type="text" value size="30"></p>';

	unset($fields['url'] );
	return $fields;
}

add_filter('comment_form_default_fields', 'council_field');

// generate meta data for new field

add_action('comment_post', 'save_comment_meta_data');

function save_comment_meta_data($comment_id) {
	if(isset($_POST['council'])) {
		$council_name = wp_filter_nohtml_kses($_POST['council']);
		add_comment_meta($comment_id, 'council', $council_name, false);
	}
}

// modify comment output to include Council name

if ( ! function_exists( 'shaken_comment' ) ) :
function shaken_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <div id="comment-<?php comment_ID(); ?>">
        	<div class="author-avatar"><?php echo get_avatar( $comment, 35 ); ?></div>
            
            <div class="comment-meta">
                <span class="author-name"><?php printf( __( '%s', 'shaken' ), sprintf( '%s', get_comment_author_link() ) ); ?></span>
                <span class="council-name">
                	<?php echo get_comment_meta($comment->comment_ID, 'council', true); ?>
                </span>&nbsp;&nbsp;
                <span class="comment-date"><?php printf( __( '%1$s at %2$s', 'shaken' ), get_comment_date( get_option( 'date_format' ) ),  get_comment_time() ); ?><?php edit_comment_link( __( '(Edit)', 'shaken' ), ' ' );?></span>
            </div><!-- .comment-meta -->
        
			<?php if ( $comment->comment_approved == '0' ) : ?>
                <em><?php _e( 'Your comment is awaiting moderation.', 'shaken' ); ?></em>
                <br />
            <?php endif; ?>
			
			<?php comment_text(); ?>
            
            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div><!-- .reply -->
		</div><!-- #comment-ID -->
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'shaken' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'shaken'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
} endif; 

if (function_exists('register_sidebar')) {
   	register_sidebar(array(
   		'name' => 'Header Widgets',
   		'id'   => 'header-widgets',
   		'description'   => 'Custom widget to add search box to page header.',
   		'before_widget' => '<div class="header-search-inner %2$s">',
   		'after_widget'  => '</div>',
   		'before_title'  => '<h3>',
   		'after_title'   => '</h3>'
   	));

   	register_sidebar(array(
  		'name' => 'Email Subscription Form',
   		'id'   => 'header-subscribe',
   		'description'   => 'Custom widget to add email subscription form to page header.',
   		'before_widget' => '<div class="header-search-wrapper"><div class="header-search-inner clearfix">',
   		'after_widget'  => '</div></div>',
   		'before_title'  => '<h3>',
   		'after_title'   => '</h3>'
   	));
}

// Customize WordPress login screen
function custom_login() { 
    echo '<link rel="stylesheet" type="text/css" href="' . get_stylesheet_directory_uri() .'/custom-login/custom-login.css" />'; 
}

add_action('login_head', 'custom_login');

?>