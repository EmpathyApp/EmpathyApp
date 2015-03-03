<?php

/*
 * Plugin Name: Empathy App
 * Plugin URI: https://github.com/EmpathyApp/EmpathyApp
 * Description: Empathy App WP plugin
 * Author: The Empathy App team
 * Version: 0.4.0
 * Author URI: https://github.com/EmpathyApp
 * License: GPLv3
 */

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
 * Things that need to be customized for each installation: ####################
 *
 * Displaying errors, please comment out in production.
 * Please note that the .htaccess file does not have to be changed for debugging
 * to be enabled, just the lines below.
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);
//TODO: Add db error printouts

//##############################################################################

function ea_wp_enqueue_scripts() {
    // jQuery and jQuery UI.
    wp_enqueue_script('jquery'); //, 'http://code.jquery.com/jquery-1.10.2.js'
    wp_enqueue_script('jquery-widget');
    wp_enqueue_script('jquery-mouse');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-slider');
    // Raphael.
    wp_enqueue_script('raphael', 'https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js');

    //login_logo();
}
add_action('wp_enqueue_scripts', 'ea_wp_enqueue_scripts');

// Add custom plugin scripts here.
function plugin_scripts()
{
    wp_register_script( 'donation-lib', plugins_url( '/js/donation-lib.js', __FILE__ ) );
    wp_enqueue_script( 'donation-lib' );
}
add_action( 'wp_enqueue_scripts', 'plugin_scripts' );

/*
 * Function for hiding the admin bar for non-admin users.
 * Code used here is inspired by the following codex page:
 * http://codex.wordpress.org/Function_Reference/show_admin_bar
 * TODO: However it seems that this is not a 100% reliable so we may change it
 * in the future:
 * http://codex.wordpress.org/Function_Reference/current_user_can
 * http://docs.appthemes.com/tutorials/wordpress-check-user-role-function/
 */
function ea_function_admin_bar($iShowAdminBarBl){
    $rVal = false;
    if(current_user_can('administrator')){
        $rVal = $iShowAdminBarBl;
    }
    return $rVal;
}
add_filter('show_admin_bar', 'ea_function_admin_bar');

// Checking the user access level..
/*
$tCurrrentUserIdNr = get_current_user_id();
$tWPUserOt = new WP_User($tCurrrentUserIdNr);
foreach($tWPUserOt->roles as $role){
    $role = get_role($role);
    if($role->name === 'subscriber'){
        add_filter('show_admin_bar', '__return_false');
    }
}
*/

//add_filter('show_admin_bar', '__return_false');
/*
function login_logo(){
?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: 'http://dalailama.com/assets/banners/943.jpg';
            padding-bottom: 30px;
        }
    </style>
<?php
}
*/

require_once 'includes/console_debug.php';
require_once 'includes/lib/firephp/FirePHP.class.php';

require_once 'classes/Call_Records_Table.php';
require_once 'classes/constants.php';
require_once 'includes/database_functions.php';
require_once 'pages/skype-page_sc.php';
require_once 'pages/donation-form_sc.php';
require_once 'pages/donation-sent_sc.php';
require_once 'pages/email-form_sc.php';
require_once 'pages/email-sent_sc.php';
require_once 'adminpages/settings.php';
require_once 'includes/functions.php';
require_once 'includes/user-registration-and-login.php';
