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


// ========== get ... By ... database functions ==========

function getIdByUserName($iUserNameSg) {
    global $wpdb; //-Getting access to the wordpress database
    $resArray = $wpdb->get_results(
        "SELECT * FROM wp_users WHERE user_login = '{$iUserNameSg}'", OBJECT);
    $userId = $resArray[0]->ID;
    return $userId;
}

function getDisplayNameById($iUserIdNr) {
    global $wpdb; //-Getting access to the wordpress database
    $resArray = $wpdb->get_results(
        "SELECT * FROM wp_users WHERE ID = '{$iUserIdNr}'", OBJECT);
    $rUserNameSg = $resArray[0]->display_name;
    return $rUserNameSg;
}

function getEmailById($iIdNr) {
    global $wpdb; //-Getting access to the wordpress database
    $resArray = $wpdb->get_results(
        "SELECT * FROM wp_users WHERE ID = '{$iIdNr}'", OBJECT);
    //^Please note that we need to surround the variable with single quotes
    $rUserEmailSg = $resArray[0]->user_email;
    return $rUserEmailSg;
}

function getUserNameById($iIdNr) {
    global $wpdb; //-Getting access to the wordpress database
    $resArray = $wpdb->get_results(
        "SELECT * FROM wp_users WHERE ID = '{$iIdNr}'", OBJECT);
    //^Please note that we need to surround the variable with single quotes
    $rUserNameSg = $resArray[0]->user_login;
    return $rUserNameSg;
}

// ========== Other functions ==========

/*
 * If changning this function, please be aware of these issues:
 * http://stackoverflow.com/questions/4834337/phps-mail-what-are-potential-issues-to-watch-out-for
 */
function ea_send_email($iEmailAddressSg, $iTitleSg, $iMessageSg){
    $tNewLineSg = "\r\n";
    $tHeadersSg = "From: connect@empathyapp.org" . $tNewLineSg .
        "X-Mailer: PHP/" . PHP_VERSION;
    mail($iEmailAddressSg, $iTitleSg, $iMessageSg, $tHeadersSg);
}


function getLogoUri(){
    /*
        $rUriSg = "";
    if(file_exists(Uris::logo256)){
        $rUriSg = Uris::logo256;
    }
    return $rUriSg;
    */
    return Uris::logo256;
}
function getSmallLogoUri(){
    return Uris::logo16;
}

function verifyUserNameExists($iCallerSkypeNameSg){
    global $wpdb;
    $resArray = $wpdb->get_results(
        "SELECT * FROM wp_users WHERE user_login = '{$iCallerSkypeNameSg}'");
    if(count($resArray) > 0){
        return true;
    }else{
        return false;
    }
}

/*
 * Function handling error messages, used as a central point so that it is easy
 * to switch between different ways to handle errors.
 * 
 * Idea: Have different leves of severity, for warning, notice, etc.
 * 
 * Idea: Use debug_backtrace to show the line number
 * http://us3.php.net/manual/en/function.debug-backtrace.php
 */
function handleError($iErrorMessageSg){
    //FirePHP::getInstance(true)->log("ea_initiate_database - init");
    die("ERROR: {$iErrorMessageSg}");
}

function hasCurrentUserRole($iRolesAr){
    // Checking the user access level..
    $tCurrrentUserIdNr = get_current_user_id();
    $tWPUserOt = new WP_User($tCurrrentUserIdNr);
    $rUserHasOneOfRolesBl = false;
    foreach($tWPUserOt->roles as $role){
        $role = get_role($role);
        for($i = 0; $i < count($iRolesAr); $i++){
            if($role->name === $iRolesAr[$i]){
                $rUserHasOneOfRolesBl = true;
            }
        }
    }
    return $rUserHasOneOfRolesBl;
}

/*
 * We do not filter $_SERVER['HTTPS'], but we do filter $_SERVER['SERVER_NAME'],
 * see this posting for information:
 * http://security.stackexchange.com/questions/32299/is-server-a-safe-source-of-data-in-php
 */
function getBaseUrl(){
    if( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ){
        $tProtocol = 'https://';
    }else{
        $tProtocol = 'http://';
    }
    return $tProtocol . (string) filter_var($_SERVER['SERVER_NAME']) . '/';
}

function getCurrentUrlWithoutParams(){
    $tUrlAr = explode("?", $_SERVER['REQUEST_URI']);
    return $tUrlAr[0];
}