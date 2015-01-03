<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Shortcode for the caller donation page
function ea_donation_shortcode(){
    ob_start();
    ?>




<!--
The last part of the url of this page has been changed to reduce the risk of the message being filtered as spam when sending automated email messages which point to this page (the filtering can take place either on our side (!) or on the reciever's side)
-->
<!--
Html for the custom stripe button needs to be placed before the script (why?)
-->
<p>
<label for="amount">Donation amount:</label>
</p>
<input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
<div id="slider"></div>


<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
$(function() {
 $( "#slider" ).slider({
  value: getInitialDonationAmount(),
  min: gConstants.minDonationAmount,
  max: gConstants.maxDonationAmount,
  step: gConstants.donationStepSize,
  slide: function( event, ui ) {
   $( "#amount" ).val( "$" + ui.value );
  }
 });
 $( "#amount" ).val( "$" + $( "#slider" ).slider( "value" ) );
});
var gConstants = {
 'recommendedDonationAmountUrlParamName' : 'recamount',
 'noredirectDonationAmount' : '42',
 'minDonationAmount' : '0',
 'maxDonationAmount' : '100',
 'donationStepSize' : '1'
};
/*
Gives an inital donation amount which can come from the url parameter or otherwise from a constant value
*/
function getInitialDonationAmount(){
 var rVal = getUrlParamValue(gConstants.recommendedDonationAmountUrlParamName);
 if(rVal == null){
  rVal = gConstants.noredirectDonationAmount;
 }
 return rVal;
}
/*
When given the name of an url parameter this function gives its value
*/
function getUrlParamValue(iParamName){
 var tUrlVarsString = window.location.search.split('?')[1]; //Grabbing the string after the question mark
 if(tUrlVarsString === undefined){
  return null;
 }
 var tUrlVarsArray = tUrlVarsString.split('&');
 for(var i = 0; i < tUrlVarsArray.length; i++){
  var tParamNameAndValueArray = tUrlVarsArray[i].split('=');
  if(tParamNameAndValueArray[0] == iParamName){
   return tParamNameAndValueArray[1];
  }
 }
 return null;
}
</script>


<form id="stripeForm" action="http://empathy.ihavearrived.org/wp/home/thank-you/" method="POST">
<script src="http://checkout.stripe.com/checkout.js"></script>

<button id="customButton">☙Donate❧</button>
<script>
  $('#customButton').on('click', function(e) {
    // Open Checkout with further options
    var tAmount = 100 * $( "#slider" ).slider( "value" );
    alert("tAmount = " + tAmount);
    StripeCheckout.open({
     key: 'pk_test_ZtBvgdrmlEPZGXUcCzDqVLOo',
     image: '/square-image.png',
     token: function(responseToken) {
      // Use the token to create the charge with a server-side script.
      // You can access the token ID with `token.id`
      var tokenInput = $('<input type=hidden name=stripeToken />').val(responseToken.id);
      $('#stripeForm').append(tokenInput).submit();
     },
     name: 'Demo Site',
     description: 'Empathy App Donation',
     amount: tAmount
    });
    e.preventDefault();
  });
  // Close Checkout on page navigation
  $(window).on('popstate', function() {
    handler.close();
  });
</script>
</form>


<!-- Heart symbols found here: http://unicode-table.com/en/sets/hearts-symbols/ -->
<!--
Script for handling of donation button and communication with Stripe. After user clicks donate in the pop-up window she will be
redirected to another php page
-->




    <?php
    $tmp_content = ob_get_contents();
    ob_end_clean();
    return $tmp_content;
}
add_shortcode('ea_donation', 'ea_donation_shortcode');
?>
