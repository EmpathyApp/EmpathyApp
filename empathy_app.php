<?php

/*
 * Plugin Name: Empathy App
 * Plugin URI: https://github.com/EmpathyApp/EmpathyApp
 * Description: Empathy App WP plugin
 * Author: The Empathy App team
 * Version: 0.0.1
 * Author URI: https://github.com/EmpathyApp
 * License: GPLv3
 */

require_once 'pages/donation.php';
require_once 'pages/thank_you.php';

define("SKYPE_NAME", "40"); // <--- note: 40 is the form id for ninja forms

function filterEmailAddress($iSetting, $iSettingName, $iId) {
    if ($iSettingName == 'to') {
        global $ninja_forms_processing;
        $userName = $ninja_forms_processing->get_field_value(SKYPE_NAME);
        $iSetting[0] = getEmailByUserName($userName);
    }
    return $iSetting;
}

add_filter('nf_email_notification_process_setting', 'filterEmailAddress', 10, 3);

/*
  Returns the email for the user with a matching user name (skype-id)
 */

function getEmailByUserName($iUserName) {
    global $wpdb; //Getting access to the wordpress database

    $resArray = $wpdb->get_results("SELECT * FROM wp_users WHERE user_login = '{$iUserName}'", OBJECT);
    //^Please note that we need to surround the variable with single quotes
    //var_dump($resArray);
    $userEmailString = $resArray[0]->user_email;
    return $userEmailString;
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
    $tResultInfo = curl_getinfo($ch); //-unused at present
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

?>
