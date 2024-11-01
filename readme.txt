=== Plugin Name ===
Contributors: Kreshi
Donate link: http://kreshi.wordpress.com
Tags: comments, rank, rankings, post, user
Requires at least: 3.0.1
Tested up to: 3.8.1
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A very useful and beautifully written plugin providing User Rankings based on Posts and Comments.

== Description ==

A very useful and beautifully written plugin providing user-rankings based on posts and comments. User have the ability to view statistical ratings of their posts. The posts are rated through the comments-count. A user will be given an overall rating which is based on the sum of the individual post-ratings. The overall user rating will be shown in the admin-navigation-menu. Optionally the user rating can be shown everywhere for every user at your website / blog through a shortcode-feature. In addition a user-ranking leaderboard is also provided for all users.

== Installation ==

1. Upload the folder 'wstats-plugin' to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Optional: Place the following code-snippet in your content.php file:

<?php $score = do_shortcode('[user_rating return_by_echo = 1]'.get_the_author_meta( 'ID' ).'[/user_rating]'); ?>
<?php echo $score ?>

We recommend to insert it like that to your content.php file:

<div class="entry-meta">
	<?php twentythirteen_entry_meta();?>
	<?php $score = do_shortcode('[user_rating return_by_echo = 1]'.get_the_author_meta( 'ID' ).'[/user_rating]'); ?>
	<?php echo $score ?>
	<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
</div><!-- .entry-meta -->

if you set "return_by_echo = 0", then only the current rating will be returned and echoed (you can design the output yourself). "return_by_echo = 1" will echo the rating with our pre-made style.

== Frequently Asked Questions ==

== Screenshots ==

== Changelog ==

= 0.0.2 =
* Plugin added

== Upgrade Notice ==

== Arbitrary section ==

== A brief Markdown Example ==
