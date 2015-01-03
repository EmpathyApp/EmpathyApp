<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//preheader - used for loading the stripe lib
function ea_preheader(){
    if( !is_admin() ){
        global $post, $current_user;
        if( !empty( $post->post_content ) && strpos( $post->post_content, "[ea_thankyou]" ) !== false ){
            
            
            chdir(dirname(__FILE__));
            require_once('../includes/lib/Stripe.php');
            
            
        }
    }
}
add_action('wp', 'ea_preheader', 1);




//Shortcode for the thank you! page
function ea_thankyou_shortcode(){
    ob_start();


echo "debug1";
var_dump($_POST);

/*
The Stripe functions use the Stripe php library which is included in public_html/empathy/wp/composer.json
*/

// Set your secret key: remember to change this to your live secret key in production
// See your keys here https://dashboard.stripe.com/account
Stripe::setApiKey("sk_test_uEGJelp5bfMDnLp0LSfb9E7N");

echo "debug2";

// Get the credit card details submitted by the form
$token = $_POST['stripeToken'];
$amount = 1100;
$descr = "test description";

echo "debug3";



// Create the charge on Stripe's servers - this will charge the user's card
try {
    echo "debug4";
    //$amount32 = 32;
    //var_dump($amount32);
    var_dump($_POST);
    //print_r($amount);
    //echo "Experimenting";
    $charge = Stripe_Charge::create(array(
      "amount" => $amount, // amount in cents, again
      "currency" => "usd",
      "card" => $token,
      "description" => $descr)
    );
} catch(Stripe_CardError $e) {
    // The card has been declined
    echo "<h4>Card has been declined</h3>";
    echo "debug5";
}

echo "<h3>Success! Charged $$amount cents</h3>";



    $tmp_content = ob_get_contents();
    ob_end_clean();
    return $tmp_content;
}
add_shortcode('ea_thankyou', 'ea_thankyou_shortcode');
?>
