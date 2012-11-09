<?php

// update_option('siteurl','http://localhost/hi-there-productions-website');
// update_option('home','http://localhost/hi-there-productions-website');

// Customize WordPress login screen
function custom_login() {
    echo '<link rel="stylesheet" type="text/css" href="' . get_stylesheet_directory_uri() .'/custom-login/custom-login.css" />';
}

add_action('login_head', 'custom_login');



?>