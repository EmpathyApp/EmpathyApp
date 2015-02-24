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
 * PHP code for making the actual charge of the credit card. Also displays the
 * page that the user comes to after making the donation.
 */

chdir(dirname(__FILE__));
require_once('../includes/lib/stripe/Stripe.php');

// Shortcode for the thank you page.
function ea_donation_sent_shortcode() {
    ob_start(); //++++++++++++++++++++++++++++++++++++++++


    // Set your secret key: remember to change this to your live secret key in production.
    // See your keys here https://dashboard.stripe.com/account

    Stripe::setApiKey(get_shared_stripe_key());
    // Get the credit card details submitted by the form
    $tStripeTokenSg = $_POST['stripeToken'];
    // TODO: change to dynamic.
    $tAmountCentsNr = (int)$_POST['amountCents'];
    
    $tDbTokenSg = $_POST['dbToken'];

    // Check that we have gotten here through the form action in donation-for_sc.php.
    // If so, withdraw the amount sent in the previous page.
    if (isset($tStripeTokenSg) == true) {

        // Note that:
        // 1) The amount is given in cents.
        // 2) The amount is given two times: once on the client side and also once here on
        //    the server side.
        // 3) FIXME:
        //    The amount is not transferred automatically (as long as we use the "custom"
        //    https://stripe.com/docs/checkout#integration-custom checkout button), which
        //    means that the value stated in the Stripe dialogue != the value actually
        //    charged from the user's credit card.

        // TODO: remove this?
        $descr = "test description";

        // Create the charge on Stripe's servers - this will charge the user's card.
        // TODO: should this be set to false here? - Otherwise: remove.
        //$tSuccess = false;
        try {
            $charge = Stripe_Charge::create(array(
                "amount"      => $tAmountCentsNr,
                "currency"    => "usd",
                "card"        => $tStripeTokenSg,
                "description" => $descr
            ));
            $tSuccess = true;
        }

        // From the Stripe support:
        // "Yes as long as you get a Charge object back from our API, it means the
        // payment was successful and you can update your database from that point.
        // You should definitely catch all types of exceptions that can be thrown
        // by our API to ensure you're catching all of our errors."
        //
        // Interesting article about Stripe errors:
        // http://www.larryullman.com/2013/01/30/handling-stripe-errors/
        //
        catch (Stripe_CardError $e) {
            // The card has been declined.
            echo "<h4>Card has been declined</h4>";
        }
        catch (Stripe_InvalidRequestError $e) { 
            // Invalid parameters were supplied to Stripe's API (very critical if this appears).
            echo "<h4>Error: Invalid Request</h4>";
        }
        catch (Stripe_AuthenticationError $e) { 
            // Authentication with Stripe's API failed.
            echo "<h4>Error: Internal Stripe API Error</h4>";
        }
        catch (Stripe_ApiConnectionError $e) { 
            // Network communication with Stripe failed.
            echo "<h4>Error: Failed to communicate with Stripe</h4>";
        }
        catch (Stripe_Error $e) {
            // Generic stripe error.
            echo "<h4>Error: Internal Stripe Error </h4>";
        } 
        catch (Exception $e) {
            echo "Error: " + $e->getMessage();
        }

        if ($tSuccess === true) {
            echo "<h3>Success! Charged {$tAmountCentsNr} cents</h3>";
            
            db_write_actual_donation($tDbTokenSg, floor($tAmountCentsNr/100));
            
        } else {
            // TODO: details needed here or elsewhere.
            echo "<h4>Some failure occured</h4>";
        }
    }


    $tmp_content = ob_get_contents(); //++++++++++++++++++++++++++++++++++++++++
    ob_end_clean();
    return $tmp_content;
}

// Create shortcode for the thank you page.
// The 1st argument is the name of the shortcode, meaning that it will be used as "[<NAME>]" on a WP page.
// The 2nd argument is the name of the PHP function above, which will be used to insert text into the webpage.
add_shortcode('ea_donation_sent', 'ea_donation_sent_shortcode');
