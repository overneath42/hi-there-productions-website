<?php


// Customize WordPress login screen
function custom_login() {
    echo '<link rel="stylesheet" type="text/css" href="' . get_stylesheet_directory_uri() .'/custom-login/custom-login.css" />';
}

add_action('login_head', 'custom_login');

?>