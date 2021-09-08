=== Post Order By Category ===
Contributors: nravota12
Plugin Name: Post Order By Category
Plugin URI: https://github.com/yonkov/Post-Order-By-Category
Tags: post order, chronological, reverse post order
Author URI: https://yonkov.github.io/
Author: Atanas Yonkov
Requires at least: 4.4
Requires PHP: 5.2.4
Tested up to: 5.8
Stable tag: 1.05
Description: A lightweight plugin that adds the option to reverse the post order for a specified category to be date ascending. When creating or editing a category from the Admin Dashboard, the user can choose to sort the posts for that category by oldest or newest (default WordPress sort). Useful for journals, books or achives, who need to have a chronological sort order for certain category archive's pages.
License: GPLv2

== Description ==
Reverse the post order for a specific category to be date ascending. This is a lightweight plugin that adds the option to reorder the posts from a specific category by published date (ascending or descending). When creating or editing a category from the Admin Dashboard, the user can choose to sort the posts for that category by oldest (old posts on top of the page) or newest (new posts first). Useful for journals, books or achives, who need to have a chronological sort order for certain category archives.

== Installation ==
1. Take the easy route and install through the WordPress plugin installer or download the .zip file and upload the unzipped folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==
= Where are the options? =
When editing or updating a category from the WordPress dashboard (click on posts => categories => edit), a dropdown to select options will appear after the category description. The options are "Oldest" (show posts by date ascending or the so called chronological order) or "Newest" (show posts by date ascending or the WordPress way). The default value is "Newest", which is the same as the WordPress default post sort.
When you choose "Oldest", the plugin will automatically display the posts from that category archive page in chronological order.

= Are there more options to sort the posts?
The plugin currently does not have any more options. However, it can be forked to sort posts by other criteria, including post title. It can also be adjusted to sort posts by more than one criteria. For more information on how to do it, feel free to check this [article](https://yonkov.github.io/post/change-post-order-for-a-specific-category-in-wordpress/) or contact me directly! The plugin does exactly what it states it does. If you like it, please give it a 5-star rating.

= Is there support for custom post types?
Yes, since version 1.03, you can reverse post order for category archive pages that belong to custom post types, e.g. projects or portfolio, as long as the custom post type supports post categories. This plugin works with [Custom Post Type UI](https://wordpress.org/plugins/custom-post-type-ui/) plugin. However, WordPress does not support category archives by default. To display category archive page for category "awesome-projects" for custom post type "project", you need to add the following code in your child theme's functions.php:

	function my_custom_query_post_type($query) {
		if ( is_category() && ( ! isset( $query->query_vars['suppress_filters'] ) || false == $query->query_vars['suppress_filters'] ) ) {
			//replace project and movie with your custom post type name
			$query->set( 'post_type', array( 'post', 'project', 'movie' ) );
			return $query;
		}
	}
	
If you are using the CPT UI plugin to create custom post types, you would also need to go to Edit post types>Taxonomies and put a tick on "Categories". Check this [article](https://www.wpbeginner.com/wp-tutorials/how-to-add-categories-to-a-custom-post-type-in-wordpress/) if you need more information how to set up categories on custom post types.

== Changelog ==
= 1.0 =
* First publicly available version of the plugin.

== Upgrade Notice ==
= 1.0 =
Initial release.
= 1.01 =
Sanitized input and output.
= 1.02 =
First release in WordPress repo.
= 1.03 =
Fix php notices on 404 pages. Add support to custom post types.
= 1.04 =
Fix deprecation notice in wp-admin. Add support to Custom Post Type UI plugin and update docs.
= 1.0.5 =
Improve localization support

== Screenshots ==

1. Sort posts from a certain category