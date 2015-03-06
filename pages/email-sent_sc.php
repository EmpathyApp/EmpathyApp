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
    
    //Check for negative number
    
    
    //Checking if this is a first-time call
    
    
    
    
    
    //Check for 
    
    
    
    
    if(is_numeric($tLengthNr) === false){
        handleError("Length variable was not numeric, possible SQL injection attempt");
    }
    

    
    
    
    $tCallerIdNr = getIdByUserName($tCallerSkypeNameSg);
    

    
    $tUniqueIdentifierSg = uniqid("id-", true);
    //-http://php.net/manual/en/function.uniqid.php
    $tCallerDisplayNameSg = getDisplayNameByUserName($tCallerSkypeNameSg);
    //$tCallerDisplayNameForEmailSg = isset($tCallerDisplayNameSg) ? " " . $tCallerDisplayNameSg : $tCallerSkypeNameSg;
    $tCallerEmailSg = getEmailByUserName($tCallerSkypeNameSg);
    $tEmpathizerDisplayNameSg = getDisplayNameById(get_current_user_id());
    
    //TODO: Add this to a functionality test case
    $tAdjustedLength = $tLengthNr;
    if(isFirstCall($tCallerIdNr) == true){
        $tAdjustedLength = $tAdjustedLength - 5;
    }
    $tRecDonationNr = (int)round(get_donation_multiplier() * $tAdjustedLength);
    
    $tMessageSg = "
Hi " . $tCallerDisplayNameSg . ",

Thank you so much for your recent empathy call! Congratulations on contributing to a more empathic world. :)

You talked with: {$tEmpathizerDisplayNameSg}
Your skype session was: {$tLengthNr} minutes long
Your recommendation contribution is: \${$tRecDonationNr}

Please follow this link to complete payment within 24 hours: " . getBaseUrl() . pages::donation_form . "?recamount={$tRecDonationNr}&dbToken={$tUniqueIdentifierSg}

See you next time!

The Empathy Team

PS
If you have any feedback please feel free to reply to this email and tell us your ideas or just your experience!
";



    //We only send an email if the donation is greater than 0
    if($tRecDonationNr > 0){
        ea_send_email($tCallerEmailSg, "Empathy App Payment", $tMessageSg);
        echo "<h3>Email successfully sent to caller</h3>";
    }else{
        echo "<h4>No email sent: First time caller and call length was five minutes or less</h4>";
    }

    db_insert(array(
        DatabaseAttributes::date_and_time => current_time('mysql', 1),
        DatabaseAttributes::recommended_donation => $tRecDonationNr,
        DatabaseAttributes::call_length => $tLengthNr,
        DatabaseAttributes::database_token => $tUniqueIdentifierSg,
        DatabaseAttributes::caller_id => $tCallerIdNr,
        DatabaseAttributes::empathizer_id => get_current_user_id()
    ));
    
    
    
    
    $ob_content = ob_get_contents(); //+++++++++++++++++++++++++++++++++++++++++
    ob_end_clean();
    return $ob_content;
}

// Create shortcode for the email sent page.
// The 1st argument is the name of the shortcode, meaning that it will be used as "[<NAME>]" on a WP page.
// The 2nd argument is the name of the PHP function above, which will be used to insert text into the webpage.
add_shortcode('ea_email_sent', 'ea_email_sent_shortcode');
