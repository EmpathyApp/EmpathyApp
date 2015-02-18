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


    $tCallerSkypeNameSg = $_POST["skype_name"];
    
    // Verifying that the skype name exists
    if(verifyUserNameExistsBl($tCallerSkypeNameSg) === false){
        echo "<h2><i>Incorrect skype name. Please go back and try again</i></h2>";
        //header(email-form);
        exit();
    }
    
    $tLengthNr = (int)$_POST["length"];
    $tEmpathizerIdNr = get_current_user_id();
    $tCallerIdNr = getIdByUserName($tCallerSkypeNameSg);
    $tUniqueIdentifierSg = uniqid("id-", true);
    //-http://php.net/manual/en/function.uniqid.php
    $tCallerDisplayNameStr = getDisplayNameByUserName($tCallerSkypeNameSg);
    $tDisplayNameForEmailStr = isset($tCallerDisplayNameStr) ? " ".$tCallerDisplayNameStr : "";
    $tCallerEmail = getEmailByUserName($tCallerSkypeNameSg);
    $tRecDonation = round(get_donation_multiplier() * $tLengthNr);
    $tMessage = "
Hi".$tDisplayNameForEmailStr.",
Please check out this link "
. getBaseUrl() . pages::donation_form . "?recamount=$tRecDonation&dbToken=$tUniqueIdentifierSg " .
"(your skype name is $tCallerSkypeNameSg and the call length was $tLengthNr)
Warm regards,
The Empathy App team
";

    ea_send_email($tCallerEmail, "Subject", $tMessage);

    db_insert(array(
        DatabaseAttributes::date_and_time => current_time('mysql'),
        DatabaseAttributes::recommended_donation => $tRecDonation,
        DatabaseAttributes::call_length => $tLengthNr,
        DatabaseAttributes::database_token => $tUniqueIdentifierSg,
        DatabaseAttributes::caller_id => $tCallerIdNr,
        DatabaseAttributes::empathizer_id => $tEmpathizerIdNr
    ));
    
    
    $ob_content = ob_get_contents(); //+++++++++++++++++++++++++++++++++++++++++
    ob_end_clean();
    return $ob_content;
}

// Create shortcode for the email sent page.
// The 1st argument is the name of the shortcode, meaning that it will be used as "[<NAME>]" on a WP page.
// The 2nd argument is the name of the PHP function above, which will be used to insert text into the webpage.
add_shortcode('ea_email_sent', 'ea_email_sent_shortcode');
