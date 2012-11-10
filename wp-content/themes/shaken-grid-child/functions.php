<?php

// update_option('siteurl','http://localhost/hi-there-productions-website');
// update_option('home','http://localhost/hi-there-productions-website');

// Customize WordPress login screen
function custom_login() {
    echo '<link rel="stylesheet" type="text/css" href="' . get_stylesheet_directory_uri() .'/custom-login/custom-login.css" />';
}

add_action('login_head', 'custom_login');

// create guide box for homepage
function website_guidance_widget_function() {
	echo "<p>I did it!</p>";
}

function website_guidance_add_dashboard_widget() {
	wp_add_dashboard_widget('web_guidance_dashboard_widget', 'How To Use Your Website', 'website_guidance_widget_function');
}

add_action('wp_dashboard_setup', 'website_guidance_add_dashboard_widget' );

// create Toon Creative ad

function toon_creative_widget_function() {
	echo "<p>Buy a website!</p>";
}

function toon_creative_add_dashboard_widget() {
	wp_add_dashboard_widget('toon_creative_dashboard_widget', 'Built By Toon Creative', 'toon_creative_widget_function');
}

add_action('wp_dashboard_setup', 'toon_creative_add_dashboard_widget' );

?>