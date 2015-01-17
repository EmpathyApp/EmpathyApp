<?php
/*
 * License: GPLv3
 * 
 * Script for handling of donation button and communication with Stripe.
 * After user clicks donate in the pop-up window she will be redirected to
 * another php page
 * 
 * PLEASE NOTE: The amount is sent unencrypted, so ssl/https is strongly
 * prefered
 * 
 * TODO Ceate constants for these:
 * http://empathy.ihavearrived.org/wp/home/thank-you/
 * stripe public key
 * 
 * TODO Use built-in wp jquery (jQuery UI as well?)
 */

function ea_donation_form_shortcode() {
    ob_start(); //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    ?>


    <p>
        <label for="amountDollars">Donation amount:</label>
    </p>
    <input type="text" id="amountDollars" readonly style="border:0; color:#f6931f; font-weight:bold;">
    <div id="sliderDollars"></div>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script>
        var gConst = {
            'recDonationDollarsUrlParamName': 'recamount',
            'noRedirectDonationDollars': '42',
            'minDonationDollars': '0',
            'maxDonationDollars': '100',
            'donationStepSizeDollars': '1'
        };

        $(function () {
            // Setup for jQuery UI slider
            $("#sliderDollars").slider({
                value: getInitialDonationAmount(),
                min: gConst.minDonationDollars,
                max: gConst.maxDonationDollars,
                step: gConst.donationStepSizeDollars,
                slide: function (iEvent, iUi) {
                    //..event handling for when user drags slider
                    $("#amountDollars").val("$" + iUi.value);
                    //-Issue #17
                }
            });
            // Showing the initial value as text
            $("#amountDollars").val("$" + $("#sliderDollars").slider("value"));
        });

        /*
         * Gives an inital donation amount which can come from the url parameter
         * or otherwise from a constant value
         */
        function getInitialDonationAmount() {
            var rVal = getUrlParamValue(gConst.recDonationDollarsUrlParamName);
            if (rVal == null) {
                rVal = gConst.noRedirectDonationDollars;
            }
            return rVal;
        }

        /*
         * Takes the name of an url parameter (normally coming from an email
         * sent to the user) this function gives the associated value
         */
        function getUrlParamValue(iParamName) {
            // Grab the string after the question mark
            var tUrlVarsString = window.location.search.split('?')[1];
            if (tUrlVarsString === undefined) {
                return null;
            }
            // If there are several parameters, split into array
            var tUrlVarsArray = tUrlVarsString.split('&');
            for (var i = 0; i < tUrlVarsArray.length; i++) {
                // Separate name from value
                var tParamNameAndValueArray = tUrlVarsArray[i].split('=');
                if (tParamNameAndValueArray[0] === iParamName) {
                    // Return value
                    return tParamNameAndValueArray[1];
                }
            }
            return null;
        }
    </script>


    <form id="stripeForm" action=<?php echo getBaseUrl() . pages::donation_sent; ?> method="POST">
        <script src="http://checkout.stripe.com/checkout.js"></script>
        <button id="customButton">☙Donate❧</button>
        <!-- -html for the custom stripe button needs to be placed before the script (why?) -->
        <script>
        // Checkout on button click..
        $(function () {
            $('#customButton').on('click', function (e) {
                //..get the amount from the slider
                var tAmount = 100 * $("#sliderDollars").slider("value");
                // ..open stripe dialog
                StripeCheckout.open({
                    key: 'pk_test_ZtBvgdrmlEPZGXUcCzDqVLOo',
                    image: '/square-image.png',
                    token: function (responseToken) {
                        // ..submit the token that we get back from the stripe server to _our_ server
                        var tokenInput = $('<input type=hidden name=stripeToken />').val(responseToken.id);
                        //-(the token is used on the server side to create the actual charge)
                        //$('#stripeForm').append(tokenInput).submit();
                        var tAmountStr = $('<input type=hidden name=amountCents />').val( tAmount );
                        $('#stripeForm').append(tokenInput).append(tAmountStr).submit();

                    },
                    name: 'Demo Site',
                    description: 'Empathy App Donation',
                    amount: tAmount
                });
                e.preventDefault();
            });
            // Close Checkout on page navigation
            $(window).on('popstate', function () {
                handler.close();
            });
        });
        </script>
    </form>


    <?php
    $ob_content = ob_get_contents(); //+++++++++++++++++++++++++++++++++++++++++
    ob_end_clean();
    return $ob_content;
}
/*
 * Create shortcode for the caller donation page
 * First argument is the name of the shortcode so it will be used like this
 * [ea_donation] on a wp page
 * Second argument is the name of the php function above which will be used
 * to insert text into the web page
 */
add_shortcode('ea_donation_form', 'ea_donation_form_shortcode');
?>
