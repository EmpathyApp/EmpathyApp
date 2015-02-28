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

    
    $tCallerSkypeNameSg = esc_sql($_POST["skype_name"]);
    
    // Verifying that the skype name exists
    if(verifyUserNameExists($tCallerSkypeNameSg) === false){
        echo "<h3><i><b>Incorrect skype name.</b> Email not sent. Please go back and try again</i></h3>";
        exit();
    }
    
    $tLengthNr = $_POST["length"];
    if(is_numeric($tLengthNr) === false){
        handleError("Length variable was not numeric, possible SQL injection attempt");
    }
    
    $tCallerIdNr = getIdByUserName($tCallerSkypeNameSg);
    $tUniqueIdentifierSg = uniqid("id-", true);
    //-http://php.net/manual/en/function.uniqid.php
    $tCallerDisplayNameSg = getDisplayNameByUserName($tCallerSkypeNameSg);
    $tDisplayNameForEmailSg = isset($tCallerDisplayNameSg) ? " " . $tCallerDisplayNameSg : "";
    $tCallerEmailSg = getEmailByUserName($tCallerSkypeNameSg);
    $tRecDonationNr = (int)round(get_donation_multiplier() * $tLengthNr);
    $tMessageSg = "
Hi" . $tDisplayNameForEmailSg . ",
Please check out this link "
. getBaseUrl() . pages::donation_form . "?recamount=$tRecDonationNr&dbToken=$tUniqueIdentifierSg " .
"(your skype name is {$tCallerSkypeNameSg} and the call length was $tLengthNr)
Warm regards,
The Empathy App team
";

    ea_send_email($tCallerEmailSg, "Subject", $tMessageSg);

    db_insert(array(
        DatabaseAttributes::date_and_time => current_time('mysql', 1),
        DatabaseAttributes::recommended_donation => $tRecDonationNr,
        DatabaseAttributes::call_length => $tLengthNr,
        DatabaseAttributes::database_token => $tUniqueIdentifierSg,
        DatabaseAttributes::caller_id => $tCallerIdNr,
        DatabaseAttributes::empathizer_id => get_current_user_id()
    ));
    
    echo "<h3>Email successfully sent to caller</h3>";
    
    
    $ob_content = ob_get_contents(); //+++++++++++++++++++++++++++++++++++++++++
    ob_end_clean();
    return $ob_content;
}

// Create shortcode for the email sent page.
// The 1st argument is the name of the shortcode, meaning that it will be used as "[<NAME>]" on a WP page.
// The 2nd argument is the name of the PHP function above, which will be used to insert text into the webpage.
add_shortcode('ea_email_sent', 'ea_email_sent_shortcode');
