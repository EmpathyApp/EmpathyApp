<?php

/* 
 * License: GPLv3
 * 
 * php code for making the actual charge of the credit card. Also displays the
 * page that the user comes to after making the donation
 */


// preheader
function ea_preheader(){
    if( !is_admin() ){
        global $post, $current_user;
        if( !empty( $post->post_content ) && strpos( $post->post_content, "[ea_thankyou]" ) !== false ){
            
            // Loading the stripe lib
            chdir(dirname(__FILE__));
            require_once('../includes/lib/Stripe.php');
            
            
        }
    }
}
add_action('wp', 'ea_preheader', 1);


// Shortcode for the thank you! page
function ea_thankyou_shortcode(){
    ob_start();

    
    // php code inserted with shortcode ++++++++++++++++++++++++++++++++++++++++
    
    
    // Set your secret key: remember to change this to your live secret key in production
    // See your keys here https://dashboard.stripe.com/account
    Stripe::setApiKey("sk_test_uEGJelp5bfMDnLp0LSfb9E7N");
    // Get the credit card details submitted by the form
    $token = $_POST['stripeToken'];
    $amount = 1100; // TODO: Change to dynamic
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
    try {
        $charge = Stripe_Charge::create(array(
          "amount" => $amount, // amount in cents, again
          "currency" => "usd",
          "card" => $token,
          "description" => $descr)
        );
    } catch(Stripe_CardError $e) {
        // The card has been declined
        echo "<h4>Card has been declined</h3>";
    }
    echo "<h3>Success! Charged $$amount cents</h3>";


    // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    

    $tmp_content = ob_get_contents();
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
add_shortcode('ea_thankyou', 'ea_thankyou_shortcode');
?>
