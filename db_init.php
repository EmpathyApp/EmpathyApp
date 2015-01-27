<?php
/* 
 * Copyright (C) 2015 sunyata
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/*
 * This file contains code for the initialization of the database.
 * 
 * Db overview:
 * We use the Wordpress database, but we don't access it directly (in other
 * words, we don't use $wpdb ourselves). Instead we use the tools described
 * below.
 * 
 * Our central point is the "callrecord" custom post type (cpt)
 * http://codex.wordpress.org/Function_Reference/register_post_type
 * 
 * The callrecord has connections to other entities. These connections are
 * handled in two different ways:
 * 1. Using taxonomies:
 *    http://codex.wordpress.org/Function_Reference/register_taxonomy
 * 2. Using custom database tables through the P2P plugin:
 *    https://wordpress.org/plugins/posts-to-posts/
 * 
 * No new tables are created - instead tables that are built into WP and P2P are
 * used. For details, please see the function header comments below.
 * 
 * To see the actual tables, you can use the Database browser WP plugin
 * https://wordpress.org/plugins/database-browser/
 */

// Register the WP custom post type (cpt) "callrecord".
// Stored in the db table "wp_posts" (where column post_type = "callrecord").
function ea_register_post_type_callrecord() {
    register_post_type('callrecord', array(
        'labels' => array(
            'name'          => __('CallRecords'),
            'singular_name' => __('CallRecord')
            ),
        'description'         => "Customized WP post type for storing call record info",
        'publicly_queryable'  => false,
        'exclude_from_search' => true,
        'public'              => true,
        'has_archive'         => true,
        'show_ui'             => true,
        'menu_position'       => 4,
        'menu_icon'           => plugins_url("images/logo_bwa_16x16.png", __FILE__),
        'can_export'          => true,
        'show_in_nav_menus'   => false,
        'delete_with_user'    => false,
        'supports'            => array('title')
    ));
}
add_action('init', 'ea_register_post_type_callrecord');

// Register the WP taxonomy "length".
// 1) The taxonomy is stored in db table "wp_term_taxonomy".
// 2) Connections to each "callrecord" post are stored in "wp_term_relationships".
function ea_register_taxonomy_length() {
    register_taxonomy(
        'length',
        'callrecord',
        array(
            'label'             => __('Call length'),
            'show_admin_column' => true
        )
    );
    register_taxonomy_for_object_type('length', 'callrecord');

// "Better be safe than sorry when registering custom taxonomies for custom post
// types. Use register_taxonomy_for_object_type() right after the function to
// interconnect them. Else you could run into minetraps where the post type isn't
// attached inside filter callback that run during parse_request or pre_get_posts."
// http://codex.wordpress.org/Function_Reference/register_taxonomy
}
add_action('init', 'ea_register_taxonomy_length');

// Register the WP taxonomy "recommendeddonation", which is stored
// in the same way as the taxonomy "length" above.
function ea_register_taxonomy_recommendeddonation() {
    register_taxonomy(
        'recommendeddonation',
        'callrecord',
        array(
            'label'             => __('Recommended donation'),
            'show_admin_column' => true
        )
    );
    register_taxonomy_for_object_type('recommendeddonation', 'callrecord');
}
add_action('init', 'ea_register_taxonomy_recommendeddonation');

// Register the WP taxonomy "registereddonation", which is stored
// in the same way as the taxonomy "length" above.
function ea_register_taxonomy_registereddonation(){
    register_taxonomy(
        'registereddonation',
        'callrecord',
        array(
            'label'             => __('Registered donation'),
            'show_admin_column' => true
        )
    );
    register_taxonomy_for_object_type('registereddonation', 'callrecord');
}
add_action('init', 'ea_register_taxonomy_registereddonation');

// TODO: Q: Add app version as well?

// Register the P2P plugin connection type "callrecord_and_empathizer" and
// "callrecord_and_caller".
// Connections are stored in the table "wp_p2p".
function ea_connection_types() {
    p2p_register_connection_type(array(
        'name'          => 'callrecord_and_empathizer',
        'from'          => 'callrecord',
        'to'            => 'user',
        'cardinality'   => 'many-to-one',
        'admin_column'  => 'any',
        'from_labels'   => array('column_title' => 'Empathizer'),
        'to_labels'     => array('column_title' => 'Empathizer Call records'),
        'to_query_vars' => array('role' => 'contributor')
    ));
    p2p_register_connection_type(array(
        'name'          => 'callrecord_and_caller',
        'from'          => 'callrecord',
        'to'            => 'user',
        'cardinality'   => 'many-to-one',
        'admin_column'  => 'any',
        'from_labels'   => array('column_title' => 'Caller'),
        'to_labels'     => array('column_title' => 'Caller Call records'),
        'to_query_vars' => array('role' => 'subscriber' )
    ));
}
add_action('p2p_init', 'ea_connection_types');
