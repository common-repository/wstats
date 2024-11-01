<?php

namespace WStats\Admin\Scripts;

class HelperFuncs {

	//public static $commentsNeededForMaxScore = 10;
	public static $table_name = 'wp_scoreScale19';
	public static $col_name = "commentsNeededForMaxScore";
	public static $default_cnfms = 10;

	// create a new plugin instance
	public static function init() {
		global $wpdb;
		self::$table_name = $wpdb->prefix . "scoreScale19";
	}

    public static function get_user_score($user) {
    	self::init();
		// get all the posts of the current user
		$posts = get_posts('author='.$user->ID);

		// count the score for each post of the current user and save it in an array
		$scores = array();
		$index = 0;

		// get up-to-date value for commentsNeededForMaxScore
		$commentsNeededForMaxScore = self::$default_cnfms;
		global $wpdb;
		$tn = self::$table_name;
		if($wpdb->get_var("SHOW TABLES LIKE '$tn'") == self::$table_name) 
		{
			$results = $wpdb->get_results( "SELECT " . self::$col_name . " FROM " . self::$table_name );
			foreach ( $results as $cnfms ) 
			{
				$commentsNeededForMaxScore = $cnfms->commentsNeededForMaxScore;
			}
		}

		// fix asynchrone updating problems
		if(isset($_GET['quantity']))
		{
			$commentsNeededForMaxScore = $_GET['quantity'];
		}

		// scores / post
		foreach ($posts as $key => $value) {
			$comments = get_comment_count($post_id = $value->ID);

			$score = min($comments['total_comments']/$commentsNeededForMaxScore,1);
			$score = $score * 5;

			$scores[$index] = $score;
			$index += 1;
		}

		// count the total score for the current user
		$myScore = 0;
		foreach ($scores as $key => $value) {
			$myScore += $value;
		}

		return $myScore;
	}
} 