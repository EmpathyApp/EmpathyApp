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
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
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
                    $("#amountDollars").val("$" + iUi.value); //-Issue #17
                    tScaleNr = iUi.value / getInitialDonationAmount();
                    tHeartSet.attr({"transform": "S" + tScaleNr + "," + tScaleNr + ",0,0"});
                    /*
                     * -the last two values (at the time of writing zeroes)
                     * determine the point relative to which the scaling will be done
                     */
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
            if (rVal === null) {
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

    <!-- Dynamically updated image connected to the donation slider -->
    <div id="container"></div>
    <script> // svg image made with inkscape and http://readysetraphael.com/
        var paper = Raphael('container', '300', '300'); //'121', '99'
        var path3053 = paper.path("");
        path3053.attr({id: 'path3053',fill: '#000000','stroke-width': '0','stroke-opacity': '1'}).data('id', 'path3053');
        var path3051 = paper.path("");
        path3051.attr({id: 'path3051',fill: '#000000','stroke-width': '0','stroke-opacity': '1'}).data('id', 'path3051');
        var path3049 = paper.path("");
        path3049.attr({id: 'path3049',fill: '#000000','stroke-width': '0','stroke-opacity': '1'}).data('id', 'path3049');
        var path4100 = paper.path("M 27.696928,76.261018 C 19.747206,68.626322 11.266398,60.587164 7.4748915,50.835542 3.6833851,41.083922 3.3734124,26.811381 9.7549518,17.653528 16.136491,8.4956721 22.187901,4.6870338 32.951844,3.819554 43.715784,2.9520766 54.370274,9.8559705 58.825976,15.322773 63.03182,9.0752373 73.149817,2.1597917 82.97532,2.535815 c 9.825503,0.3760235 17.58955,4.1161266 24.45634,14.16105 6.86678,10.04492 6.42359,25.935606 2.63918,34.821536 C 106.2864,60.40433 95.625874,73.161814 87.142497,79.412544 78.659121,85.663272 67.21867,93.59175 59.402765,95.98188 51.60661,93.099221 35.646649,83.895715 27.696928,76.261018 z");
        path4100.attr({id: 'path4100',fill: '#ff3e35',stroke: '#000000',"stroke-width": '5',"stroke-linecap": 'butt',"stroke-linejoin": 'miter',"stroke-opacity": '1',"stroke-miterlimit": '4',"stroke-dasharray": 'none',"fill-opacity": '1'}).data('id', 'path4100');
        var tHeartSet = paper.set(path3053, path3051, path3049, path4100);
        //tHeartSet.attr({"fill": "green"});
    </script>

    
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
