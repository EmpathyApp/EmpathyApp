<?php

/*
 * Plugin Name: Empathy App
 * Plugin URI: https://github.com/EmpathyApp/EmpathyApp
 * Description: Empathy App WP plugin
 * Author: The Empathy App team
 * Version: 0.2.5
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

//Things that need to be customized for each installation#######################
/*
 * Displaying errors, please comment out at production
 * Please note that the .htaccess file does not have to be changed for debugging
 * be enabled, only the lines below
 */
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
*/
//##############################################################################

function ea_wp_enqueue_scripts() {
    //jQuery and jQuery UI
    wp_enqueue_script('jquery'); //, 'http://code.jquery.com/jquery-1.10.2.js'
    wp_enqueue_script('jquery-widget');
    wp_enqueue_script('jquery-mouse');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-slider');
    //raphael
    wp_enqueue_script('raphael', 'https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js');
}
add_action('wp_enqueue_scripts', 'ea_wp_enqueue_scripts');

require_once 'console_debug.php';
require_once 'includes/lib/firephp/FirePHP.class.php';

require_once 'classes/constants.php';
require_once 'db_init.php';
require_once 'pages/donation-form_sc.php';
require_once 'pages/donation-sent_sc.php';
require_once 'pages/email-form_sc.php';
require_once 'pages/email-sent_sc.php';
require_once 'adminpages/settings.php';
require_once 'includes/functions.php';
require_once 'includes/user-registration.php';
