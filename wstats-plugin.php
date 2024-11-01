<?php
/*
Plugin Name: WStats Plugin
Description: A very useful and beautifully written plugin providing User Rankings based on Posts and Comments.
Version: 1.0
Plugin URI: http://localhost:8080/
Author: Kreshnik Halili, Alois Hofer, Gwendolin Lehrer
Author URI: http://localhost:8080/
Network: False
*/

/*
The MIT License (MIT)

Copyright (c) 2014 MultiMediaTechnology

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

if (!defined('ABSPATH')) {
    die();
}

// includes
include 'src/WStats/Plugin.php';
include 'src/WStats/Admin/UI.php';
include 'src/WStats/Admin/Scripts/HelperFuncs.php';

/**
 * Run
 */
$root = new WStats\Plugin();
$root->run();

// user rating shortcode
function user_rating( $atts, $userID = null ) {
	extract( shortcode_atts( array(
      'return_by_echo' => 'return_by_echo'
      ), $atts ) );

	$user = get_userdata($userID);
	$templateFuncs = new WStats\TemplateFuncs();
	$rating = $templateFuncs->get_user_rating($user);

	if($return_by_echo)
	{
		echo("<span style='color:yellow; margin-right: 5px; margin-left: -15px;'>" . floor($rating) . "</span>" . "<img style='margin-right: 10px; background:transparent; border:0px; width:24px; height:24px;' src='".plugin_dir_url( __FILE__ ) . "img/star.png'");
	}
	else
	{
		return $rating;
	}
}
add_shortcode('user_rating', 'user_rating');

// hook for adding stars visualization to top-right admin-navigation
add_action( 'admin_bar_menu', 'wp_admin_bar_my_custom_account_menu', 11 );

function wp_admin_bar_my_custom_account_menu( $wp_admin_bar ) {
	$user_id = get_current_user_id();
	$current_user = wp_get_current_user();
	$profile_url = get_edit_profile_url( $user_id );

	if ( 0 != $user_id ) {
		$score = do_shortcode('[user_rating return_by_echo = 0]'.$current_user->ID.'[/user_rating]');

		/* Add the "My Account" menu */
		$avatar = get_avatar( $user_id, 28 );
		$howdy = sprintf( __('Welcome, %1$s'), $current_user->display_name );
		$class = empty( $avatar ) ? '' : 'with-avatar';

		$wp_admin_bar->add_menu( array(
			'id' => 'my-account',
			'parent' => 'top-secondary',
			'title' => $howdy . $avatar . " " . "<span style='color:yellow'>" . floor($score) . "</span>" . "<img style='background:transparent; border:0px' src='".plugin_dir_url( __FILE__ ) . "img/star.png'>",
			'href' => $profile_url,
			'meta' => array(
			'class' => $class,
			),
		) );
	}
}
?>