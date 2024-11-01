<?php

namespace WStats\Admin;

class UI {

    public static function init() {
        add_action( 'admin_menu' , array('WStats\Admin\UI', 'optionsMenu'));
    }

    public static function optionsMenu() {
        $page_title = "WStats";
        $menu_title = "WStats";
        $capability = 'level_0';
        $menu_slug = 'wstats';
        $function = array('WStats\Admin\UI', 'pluginOptions');

        add_menu_page( $page_title, 
            $menu_title, 
            $capability, 
            $menu_slug, 
            $function );
    }

    public static function pluginOptions() {
        if ( !current_user_can( 'edit_published_posts' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }

        include 'Scripts/form.phtml';
    }
} 