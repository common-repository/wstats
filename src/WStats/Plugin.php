<?php

namespace WStats;

use WStats\Admin as Admin;

/**
 * Class Plugin
 */
class Plugin {

	// create a new plugin instance
	public function __construct() {
	}

    public function run() {
        // Create admin UI
        Admin\UI::init();
    }
}

class TemplateFuncs {
	// create a new plugin instance
	public function __construct() {
	}

	public function get_user_rating($user)
    {
    	$score = Admin\Scripts\HelperFuncs::get_user_score($user);
    	return $score;
    }
}
