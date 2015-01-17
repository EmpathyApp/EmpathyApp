<?php

/*
 * Plugin Name: Empathy App
 * Plugin URI: https://github.com/EmpathyApp/EmpathyApp
 * Description: Empathy App WP plugin
 * Author: The Empathy App team
 * Version: 0.1.1
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

require_once 'console_debug.php';
require_once 'includes/lib/firephp/FirePHP.class.php';

require_once 'classes/constants.php';
require_once 'db_init.php';
require_once 'pages/donation-form_sc.php';
require_once 'pages/donation-sent_sc.php';
require_once 'pages/email-form_sc.php';
require_once 'pages/email-sent_sc.php';


//##############################################################################

function getBaseUrl(){
    if( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ){
        $tProtocol = 'https://';
    }else{
        $tProtocol = 'http://';
    }
    return $tProtocol . $_SERVER['SERVER_NAME'] . '/';
}

function getEmailByUserName($iUserName) {
    global $wpdb; //-Getting access to the wordpress database
    $resArray = $wpdb->get_results(
        "SELECT * FROM wp_users WHERE user_login = '{$iUserName}'", OBJECT);
    //^Please note that we need to surround the variable with single quotes
    $userEmailString = $resArray[0]->user_email;
    return $userEmailString;
}

function getIdByUserName($iUserName) {
    global $wpdb; //-Getting access to the wordpress database
    $resArray = $wpdb->get_results(
        "SELECT * FROM wp_users WHERE user_login = '{$iUserName}'", OBJECT);
    $userId = $resArray[0]->ID;
    return $userId;
}

function ea_send_email($iEmail, $iTitle, $iMessage){
    $tNewLine = "\r\n";
    $tHeaders = "From: noreply@" . $_SERVER['SERVER_NAME'] . $tNewLine .
        "X-Mailer: PHP/" . PHP_VERSION;
    mail($iEmail, $iTitle, $iMessage, $tHeaders);
}

/*
 * WP filter that validates that the skype name exists, if it doesn't an
 * error is added to the list of registration errors
 */
function ea_validate_skype_name($modErrors, $iSkypeName, $iUserEmail){
    // Using curl to do a http post request to skype
    $tUrl = "https://login.skype.com/json/validator";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $tUrl);
    curl_setopt($ch, CURLOPT_POST , 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);
    curl_setopt($ch, CURLOPT_POSTFIELDS , "new_username=$iSkypeName");
    $tResponse = curl_exec($ch);
    $tResultInfo = curl_getinfo($ch);
    curl_close($ch);
    // Check if the skype name is avalilable for registration (meaning that no user has it)..
    if( substr_count($tResponse, "not available") == 0 ){
        // ..if so, add skype error to the list of registration errors
        $modErrors -> add('skype_error', __('<strong>ERROR:</strong> Skype name could not be verified, please recheck'), '-');
        //-domain?? doesn't seem to matter what we choose here
    }
    return $modErrors;
}
add_filter('registration_errors', 'ea_validate_skype_name', 10, 3);
