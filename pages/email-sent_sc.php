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


function ea_email_sent_shortcode() {
    ob_start(); //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    
    $t_caller_skype_name = $_POST["skype_name"];
    $t_length = $_POST["length"];
    $t_empathizer_id = get_current_user_id();
    $t_caller_id = getIdByUserName($t_caller_skype_name);
    $t_post_id = wp_insert_post(array(
        'post_type' => 'callrecord',
        'post_title' => 'inserted post 8',
        'post_content' => 'content for post 8',
        'post_status' => 'publish'
    ));
    
    wp_set_object_terms($t_post_id, $t_length, 'length');

    p2p_type('callrecord_and_empathizer') -> connect(
        $t_post_id,
        $t_empathizer_id,
        array('date' => current_time('mysql'))
    );

    p2p_type('callrecord_and_caller') -> connect(
        $t_post_id,
        $t_caller_id,
        array('date' => current_time('mysql'))
    );

    //Issue 37 - https://github.com/EmpathyApp/EmpathyApp/issues/37
    //$t_caller_first_name = getFirstNameByUserName($t_caller_skype_name);
    
    $t_caller_email = getEmailByUserName($t_caller_skype_name);
    $t_message = "
Hi from php!
Please check out this link "
    . getBaseUrl() . pages::donation_form . "?recamount=$t_length " .
"(your skype name is $t_caller_skype_name and the call length was $t_length)
Warm regards,
The Empathy App team
";
    ea_send_email($t_caller_email, "Subject", $t_message);


    $ob_content = ob_get_contents(); //+++++++++++++++++++++++++++++++++++++++++
    ob_end_clean();
    return $ob_content;
}
/*
 * Create shortcode for the caller donation page
 * First argument is the name of the shortcode so it will be used like this
 * [ea_donation] on a wp page
 * Second argument is the name of the php function above which will be used
 * to insert text into the web page
 */
add_shortcode('ea_email_sent', 'ea_email_sent_shortcode');
?>
