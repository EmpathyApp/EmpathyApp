<?php

/* 
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


    $tCallerSkypeName = $_POST["skype_name"];
    $tLength = $_POST["length"];
    $t_empathizer_id = get_current_user_id();
    $t_caller_id = getIdByUserName($tCallerSkypeName);

    
    
    
    
    
    

    
    
    
    
    
    
    
    $tCallerDisplayName = getDisplayNameByUserName($tCallerSkypeName);
    $displayNameForEmail = isset($tCallerDisplayName) ? " ".$tCallerDisplayName : "";
    
    $tCallerEmail = getEmailByUserName($tCallerSkypeName);
    $tRecDonation = round(get_donation_multiplier() * $tLength);
    $tMessage = "
Hi".$displayNameForEmail.",
Please check out this link "
    . getBaseUrl() . pages::donation_form . "?recamount=$tRecDonation " .
"(your skype name is $tCallerSkypeName and the call length was $tLength)
Warm regards,
The Empathy App team
";
    ea_send_email($tCallerEmail, "Subject", $tMessage);


    
    
    
    
    $ob_content = ob_get_contents(); //+++++++++++++++++++++++++++++++++++++++++
    ob_end_clean();
    return $ob_content;
}

// Create shortcode for the email sent page.
// The 1st argument is the name of the shortcode, meaning that it will be used as "[<NAME>]" on a WP page.
// The 2nd argument is the name of the PHP function above, which will be used to insert text into the webpage.
add_shortcode('ea_email_sent', 'ea_email_sent_shortcode');

