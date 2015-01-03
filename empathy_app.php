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

function filterEmailAddress($iSetting, $iSettingName, $iId){
  if($iSettingName == 'to'){
    global $ninja_forms_processing;
    $userName = $ninja_forms_processing -> get_field_value(SKYPE_NAME);
    $iSetting[0] = getEmailByUserName($userName);
  }
  return $iSetting;
}
add_filter('nf_email_notification_process_setting', 'filterEmailAddress', 10, 3);

/*
Returns the email for the user with a matching user name (skype-id)
*/
function getEmailByUserName($iUserName){
 global $wpdb; //Getting access to the wordpress database

 $resArray = $wpdb->get_results("SELECT * FROM wp_users WHERE user_login = '{$iUserName}'", OBJECT);
 //^Please note that we need to surround the variable with single quotes
 
 //var_dump($resArray);
 $userEmailString = $resArray[0]->user_email;
 return $userEmailString;
}

?>
