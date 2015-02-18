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


function getBaseUrl(){
    /*if( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ){
            $tProtocol = 'https://';
        }else{
            $tProtocol = 'http://';
        }*/
    //using filtering access
    if( filter_input(INPUT_SERVER, 'HTTPS') && (string)filter_input(INPUT_SERVER, 'HTTPS') != 'off' ){
        $tProtocol = 'https://';
    }else{
        $tProtocol = 'http://';
    }
    return $tProtocol . (string) filter_var($_SERVER['SERVER_NAME']) . '/';
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

function getDisplayNameByUserName($iUserName) {
    global $wpdb; //-Getting access to the wordpress database
    $resArray = $wpdb->get_results(
        "SELECT * FROM wp_users WHERE user_login = '{$iUserName}'", OBJECT);
    $userDisplayNameString = $resArray[0]->display_name;
    return $userDisplayNameString;
}

function getLogoUri()
{
    return Uris::logo256;
}

function verifyUserNameExistsBl($iCallerSkypeNameSg){
    global $wpdb;
    
    $resArray = $wpdb->get_results(
        "SELECT * FROM wp_users WHERE user_login = '{$iCallerSkypeNameSg}'");
    
    if(count($resArray) > 0){
        return true;
    }else{
        return false;
    }
}
