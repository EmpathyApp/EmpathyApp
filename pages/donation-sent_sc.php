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

/*
 * php code for making the actual charge of the credit card. Also displays the
 * page that the user comes to after making the donation
 */

chdir(dirname(__FILE__)); //-chdir(__DIR__) doesn't work
require_once('../includes/lib/stripe/Stripe.php');

// Shortcode for the thank you page
function ea_donation_sent_shortcode() {
    ob_start(); //++++++++++++++++++++++++++++++++++++++++

    // Set your secret key: remember to change this to your live secret key in production
    // See your keys here https://dashboard.stripe.com/account

    Stripe::setApiKey(get_shared_stripe_key());
    // Get the credit card details submitted by the form
    $token = $_POST['stripeToken'];
    $amountCents = $_POST['amountCents']; // TODO: Change to dynamic
    /*
     * Checking if we have gotten here by a (the) form action in donation-for_sc.php,
     * if so withdraw the amount sent from the previous page
     */
    if(isset($token) == true){
        /*
         * -please note that (1) the amound is given in cents and (2) the amount is
         * given two times, once on the client side and also here on the server side
         * and the amount is not transferred automatically (as long as we use the
         * "custom" https://stripe.com/docs/checkout#integration-custom checkout
         * button) which means that we can see a value in the stripe dialog which
         * gives one value and then another value will be charged from the user's
         * credit card
         */
        $descr = "test description"; // TODO: remove?
        // Create the charge on Stripe's servers - this will charge the user's card
        //$tSuccess = false;
        try {
            $charge = Stripe_Charge::create(array(
                "amount" => $amountCents, // amount in cents, again
                "currency" => "usd",
                "card" => $token,
                "description" => $descr)
            );
            $tSuccess = true;
        } 

        /*
         * TODO: More exceptions here (thank you to sebaste):
         * http://stackoverflow.com/questions/17750143/catching-stripe-errors-with-try-catch-php-method
         */

        catch (Stripe_CardError $e) {
            // The card has been declined
            echo "<h4>Card has been declined</h4>";
        }
        catch (Stripe_InvalidRequestError $e) { 
            // Invalid parameters were supplied to Stripe's API
            echo "<h4>Error: Invalid Request</h4>";
        }
        catch (Stripe_AuthenticationError $e) { 
            // Authentication with Stripe's API failed
            echo "<h4>Error: Internal Stripe API Error</h4>";
        }
        catch (Stripe_ApiConnectionError $e) { 
            // Network communication with Stripe failed
            echo "<h4>Error: Failed to communicate with Stripe</h4>";
        }
        catch (Stripe_Error $e) {
            // Generic stripe error
            echo "<h4>Error: Internal Stripe Error </h4>";
        } 
        catch (Exception $e) {
            echo "Error: " + $e->getMessage();
        }
        /*
         * From stripe support:
         * "Yes as long as you get a Charge object back from our API, it means the
         * payment was successful and you can update your database from that point.
         * You should definitely catch all types of exceptions that can be thrown
         * by our API to ensure you're catching all of our errors."
         */
        if($tSuccess === true){
            echo "<h3>Success! Charged {$amountCents} cents</h3>";
        }else{
            echo "<h4>Some failure occured</h4>"; //-TODO: details needed here or elsewhere
        }
    }


    $tmp_content = ob_get_contents(); //++++++++++++++++++++++++++++++++++++++++
    ob_end_clean();
    return $tmp_content;
}
/*
 * Create shortcode for the thank you page
 * First argument is the name of the shortcode so it will be used like this
 * [ea_donation] on a wp page
 * Second argument is the name of the php function above which will be used
 * to insert text into the web page
 */
add_shortcode('ea_donation_sent', 'ea_donation_sent_shortcode');
