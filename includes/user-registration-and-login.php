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


/*******************************************************************************
 * Code for customizing the login form, using wp filters and actions
 * WP doc: http://codex.wordpress.org/Customizing_the_Login_Form
 ******************************************************************************/


/*
 * Redirecting all types of users to the main page after they have logged in.
 * Wordpress documentation:
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/login_redirect
 * Please note: The urls returned are relative (not absolute)
 */
function ea_login_redirect($iRedirectTo, $iRequest, $user){
    global $user;
    if(isset($user->roles) && is_array($user->roles)){
        if(in_array("subscriber", $user->roles)){
            return pages::skype_page;
        }elseif(in_array("administrator", $user->roles)){
            return admin_url();
        }elseif(in_array("contributor", $user->roles)){
            return pages::email_form;
        }else{
            echo "Error: Unrecognized user";
        }
    }else{
        return "Error: No user types found"; //$iRedirectTo
    }
}
add_filter('login_redirect', 'ea_login_redirect', Constants::default_prio, 3);


/*
 * Link to a page containing terms and conditions that will be shown at caller
 * registration
 */
function ea_terms_and_conditions_link(){
    ?>

<!--
    Used to be a textarea, leaving this code here if we change back:
    <textarea rows="5" cols="30" readonly="true" draggable="false" style="resize: none">text...</textarea>
-->
    <a href="https://www.empathyapp.org/terms-and-conditions/">Terms and conditions</a>
    <!-- -TODO: Make this url dynamic -->
    <br>
    <input id="termsCheckbox" name="termsCheckbox" type="checkbox" value="1">
    <label for="termsCheckbox">I accept these terms and conditions</label>

    <?php
}
add_action('register_form', 'ea_terms_and_conditions_link');


/*
 * WP filter that validates that the skype name exists, if it doesn't an
 * error is added to the list of registration errors
 */
function ea_validate_skype_name($modErrors, $iSkypeNameSg, $iUserEmailSg){
    // Using curl to do a http post request to skype
    $tUrlSg = "https://login.skype.com/json/validator";
    $tCurlHandle = curl_init();
    curl_setopt($tCurlHandle, CURLOPT_URL, $tUrlSg);
    curl_setopt($tCurlHandle, CURLOPT_POST , 1);
    curl_setopt($tCurlHandle, CURLOPT_RETURNTRANSFER , true);
    curl_setopt($tCurlHandle, CURLOPT_POSTFIELDS , "new_username=$iSkypeNameSg");
    $tResponse = curl_exec($tCurlHandle);
    $tResultInfo = curl_getinfo($tCurlHandle);
    curl_close($tCurlHandle);
    // Check if the skype name is avalilable for registration (meaning that no user has it)..
    if( substr_count($tResponse, "not available") == 0 ){
        /*
         * -TODO: This check works in practice but i don't understand it,
         */
        // ..if so, add skype error to the list of registration errors
        $modErrors -> add('skype_error', __('<strong>ERROR:</strong> Skype name could not be verified, please recheck'), 'domain1');
        // -domain?? doesn't seem to matter what we choose here
    }
    return $modErrors;
}
add_filter('registration_errors', 'ea_validate_skype_name', Constants::default_prio, 3);


/*
 * Verifying that the terms have been accepted
 */
function ea_validate_terms_accepted($modErrors, $iSkypeName, $iUserEmail){
    if(!isset($_POST['termsCheckbox'])){ //-if checkbox false this value will not even be set
        $modErrors -> add('terms_error', __('<strong>ERROR:</strong> You must accept the terms and conditions to register'), 'domain1');
    }
    return $modErrors;
}
add_filter('registration_errors', 'ea_validate_terms_accepted', Constants::default_prio, 3);


/*
 * Adding instructions to login page and registration page
 */
function ea_login_and_registration_message(){
    ?>
    
    <p>
        <b>Your username is your valid skype name.</b> If you do not already have skype, please <a href="http://www.skype.com/en/download-skype/"> download skype here</a> and then use your skype name to register with us. Please note: <i>Do not use a Microsoft or Facebook account, use the <b>standard skype account</b> instead</i>
        <!-- Your username is your valid skype name. If you do not have a skype name,
        <a href="https://login.skype.com/account/signup-form" >please create an account with them first</a> -->
    </p>
    
    <?php
}
add_filter('login_message', 'ea_login_and_registration_message');
