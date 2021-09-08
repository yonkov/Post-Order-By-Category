<?php
/*
 * Plugin Name: Post Order By Category
 * Plugin URI: https://github.com/yonkov/Post-Order-By-Category
 * Description: A lightweight plugin that adds the option to reverse the post order for a specific category to be date ascending. When creating or editing a category from the Admin Dashboard, the user can choose to sort the posts for that category by oldest or newest (default WordPress sort). Useful for journals, books or achives, who need to have a chronological sort order for certain category archive's pages.
 * Version: 1.05
 * Author: Atanas Yonkov
 * Author URI: https://yonkov.github.io/
 * Tags: post order, chronological, reverse post order
 * License: GPL
 * Text Domain: post-order-by-category

=====================================================================================
Copyright (C) 2019 Atanas Yonkov

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with WordPress; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
=====================================================================================
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Woof Woof Woof!' );
}

function poc_changePostOrder() {
	// get the category id from the admin url
	$cat_id     = sanitize_text_field( $_GET['tag_ID'] );
	$post_order = get_term_meta( $cat_id, 'post-order', true );

	?>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label for="post-order"><?php esc_html_e( 'Post Order', 'post-order-by-category' ); ?></label></th>
		<td>
			
		<select name="post-order" id="post-order">
			<option 
			<?php
			if ( $post_order == 'newest' ) {
				?>
				selected="true" <?php }; ?>value="newest"><?php esc_html_e( 'Newest', 'post-order-by-category' ); ?></option>
			<option 
			<?php
			if ( $post_order == 'oldest' ) {
				?>
				selected="true" <?php }; ?>value="oldest"><?php esc_html_e( 'Oldest', 'post-order-by-category' ); ?></option>
		</select>
		</td>
	</tr>
	
	<?php

}
add_action( 'category_edit_form_fields', 'poc_changePostOrder' );

function poc_saveCategoryFields( $query ) {
	// get the category id from the admin url
	$cat_id = sanitize_text_field( $_POST['tag_ID'] );
	// check if the user is an admin or an editor
	if ( current_user_can( 'manage_categories' ) && isset( $_POST['post-order'] ) ) {
		if ( $_POST['post-order'] == 'oldest' || $_POST['post-order'] == 'newest' ) {
			// add meta value in wp_termmeta table
			// update field
			$order = sanitize_title( $_POST['post-order'] );
			update_term_meta( $cat_id, 'post-order', $order );
		}
	}
}
add_action( 'edited_category', 'poc_saveCategoryFields' );

function poc_category_order( $query ) {
	// get the category id when the archive page is being displayed
	if ( ! is_admin() && is_category() ) {
		$category = get_queried_object();
		if ( ! empty( $category ) ) {
			$cat_id = $category->term_id;
			// get the meta value
			$post_order = get_term_meta( $cat_id, 'post-order', true );
			if ( $post_order == 'oldest' && $query->is_category( $cat_id ) && $query->is_main_query() ) {
				$query->set( 'order', 'ASC' );
			}
		}
	}
}
add_action( 'pre_get_posts', 'poc_category_order' );
