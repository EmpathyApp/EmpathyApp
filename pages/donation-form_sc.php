<?php
/*
 * License: GPLv3
 * 
 * Script for handling the donation button and communication with Stripe.
 * After the user clicks on "donate" in the pop-up window, she will be redirected to another PHP page.
 * 
 * PLEASE NOTE: The amount is sent unencrypted, so SSL/HTTPS is strongly preferred.
 */

function ea_donation_form_shortcode() {
    //ob_start(); //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    ?>


    <p>
        <label for="amountDollars">Donation Amount:</label>
    </p>
    <input type="text" id="amountDollars" readonly style="border:0; color:#f6931f; font-weight:bold;">
    <div id="sliderDollars"></div>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script>
        jQuery(document).ready(function(){
            //-TODO: Investigate why we need to have a special order of the functions, in reverse of how they
            // are used. We expected to avoid this since we are using "jQuery(function" as per this link:
            // http://www.sitepoint.com/types-document-ready/
            try {
                
                var gConst = {
                    'tokenUrlParamName': 'dbToken',
                    'recDonationDollarsUrlParamName': 'recamount',
                    'noRedirectDonationDollars': 42,
                    'minDonationDollars': 1,
                    'donationStepSizeDollars': 1,
                    'animationMargin': 2
                };
                
                // Given the name of an URL parameter (normally coming from an email sent to the user),
                // return its associated value.
                function getUrlParamValue(iParamName) {
                    // Get the string after the question mark.
                    var tUrlVarsString = window.location.search.split('?')[1];
                    if (tUrlVarsString === undefined) {
                        return null;
                    }
                    // If there are several parameters, split into an array.
                    var tUrlVarsArray = tUrlVarsString.split('&');
                    for (var i = 0; i < tUrlVarsArray.length; i++) {
                        // Separate the name from the value.
                        var tParamNameAndValueArray = tUrlVarsArray[i].split('=');
                        if (tParamNameAndValueArray[0] === iParamName) {
                            return tParamNameAndValueArray[1];
                        }
                    }
                    return null;
                }
                
                var tScaleNr = 1;
                
                /*
                 * Updates the tScaleNr variable and changes the size of the heart
                 * using this variable
                 * @param iSliderValueInt
                 */
                function updateHeartSize(iSliderValueInt){
                    tScaleNr = (0.2 * iSliderValueInt.value + 10) / 20;
                    //-these values are based on some testing to see what looks good
                    tHeartSet.attr({"transform": "S" + tScaleNr + "," + tScaleNr + ",0,0"});
                }

                // Gives an initial donation amount either from the URL parameter or from a constant value.
                function getInitialDonationAmount() {
                    var rVal = getUrlParamValue(gConst.recDonationDollarsUrlParamName);
                    if (rVal === null) {
                        rVal = gConst.noRedirectDonationDollars;
                    }
                    return rVal;
                }
                
                updateHeartSize(getInitialDonationAmount() - gConst.minDonationDollars);

                // Event handling for when the user drags slider.
                function slideFunction(iEvent, iUi) {
                    jQuery("#amountDollars").val("$" + iUi.value);
                    updateHeartSize(iUi); //tInitialDonationAmount
                    // By default, Raphael will scale the vector image from its midpoint and outwards. By setting
                    // the last two attribute values to 0, the scaling will be made from the top-left point towards
                    // the bottom-right instead.
                    
                    /*
                    if (iUi.value >= gConst.maxDonationDollars - gConst.animationMargin) { // Adding to the margin.
                        startAnim();
                    }
                    */
                }

                /*
                function startAnim() {
                    var tAnim = Raphael.animation({'transform':"S" + tScaleNr * 1.1 + "," + tScaleNr * 1.1 + ",0,0"}, 400,
                        function () {
                            // Putting the lines below inside this callback makes sure that the system
                            // will execute them after the first animation is completed.
                            var tAnim = Raphael.animation({'transform':"S" + tScaleNr + "," + tScaleNr + ",0,0"}, 600);
                            tHeartSet.animate(tAnim);
                        }
                    );
                    tHeartSet.animate(tAnim);
                }
                */




            
                var tInitialDonationAmount = getInitialDonationAmount();
                
                jQuery("#sliderDollars").slider({
                    value: tInitialDonationAmount,
                    min: gConst.minDonationDollars,
                    max: <?php $tmp = get_max_donation(); echo "$tmp" ?>,
                    step: gConst.donationStepSizeDollars,
                    slide: slideFunction
                });
                // Display the initial value as text.
                jQuery("#amountDollars").val("$" + jQuery("#sliderDollars").slider("value"));
                
            }
            catch (e) {
                console.error("ERROR: ", e.message);
            }
        });
    </script>

    <form id="stripeForm" action=<?php echo getBaseUrl() . pages::donation_sent; ?> method="POST">
        <script src="http://checkout.stripe.com/checkout.js"></script>
        <button id="customButton">Donate</button>
        <script>
        // Checkout on button click.
        jQuery(document).ready(function () {
            try {
                jQuery('#customButton').on('click', function (e) {
                    // Needed to prefill the email field (if the user is logged in) in the Stripe checkout. 
                    // TODO: move somewhere else?
                    <?php
                       if (is_user_logged_in()) {
                             $prefill_email = get_userdata(get_current_user_id())->user_email;
                       } else {
                             $prefill_email = 'false';
                       }
                    ?>



                    ///////////////////////////// TODO: Refactor
                    var gConst = {
                        'tokenUrlParamName': 'dbToken',
                        'recDonationDollarsUrlParamName': 'recamount',
                        'noRedirectDonationDollars': 42,
                        'minDonationDollars': 1,
                        'donationStepSizeDollars': 1,
                        'animationMargin': 2
                    };

                    // Given the name of an URL parameter (normally coming from an email sent to the user),
                    // return its associated value.
                    function getUrlParamValue(iParamName) {
                        // Get the string after the question mark.
                        var tUrlVarsString = window.location.search.split('?')[1];
                        if (tUrlVarsString === undefined) {
                            return null;
                        }
                        // If there are several parameters, split into an array.
                        var tUrlVarsArray = tUrlVarsString.split('&');
                        for (var i = 0; i < tUrlVarsArray.length; i++) {
                            // Separate the name from the value.
                            var tParamNameAndValueArray = tUrlVarsArray[i].split('=');
                            if (tParamNameAndValueArray[0] === iParamName) {
                                return tParamNameAndValueArray[1];
                            }
                        }
                        return null;
                    }
                    /////////////////////////////



                    function getDatabaseToken() {
                        var rVal = getUrlParamValue(gConst.tokenUrlParamName);
                        if (rVal === "") {
                            //TODO
                        }
                        return rVal;
                    }

                    // Get the amount from the slider.
                    var tAmount = 100 * jQuery("#sliderDollars").slider("value");
                    // Open Stripe dialogue.
                    StripeCheckout.open({
                        key: '<?php echo get_private_stripe_key(); ?>',
                        image: '<?php echo getLogoUri(); ?>',
                        token: function (responseToken) {
                            // Submit the token that we get back from the Stripe server to _our_ server.
                            var tokenInput = jQuery('<input type=hidden name=stripeToken />').val(responseToken.id);
                            var tDatabaseTokenSg = jQuery('<input type=hidden name=dbToken />').val(getDatabaseToken());
                            // (The token is used on the server side to create the actual charge).
                            var tAmountStr = jQuery('<input type=hidden name=amountCents />').val(tAmount);
                            jQuery('#stripeForm').append(tokenInput).append(tAmountStr).append(tDatabaseTokenSg).submit();
                        },
                        name: 'Demo Site',
                        description: 'Empathy App Donation',
                        email: '<?php echo $prefill_email ;?>',
                        amount: tAmount
                    });
                    e.preventDefault();
                });
                // Close checkout on page navigation.
                jQuery(window).on('popstate', function () {
                    handler.close();
                });
            }
            catch (e) {
                console.error("ERROR: ", e.message);
            }
        });

        </script>
    </form>

    <!-- Dynamically updated vector image connected to the donation slider. -->
    <div id="container"></div>
    <script>
        // SVG image made with Inkscape and http://readysetraphael.com/.
        var paper = Raphael('container', '310', '310'); //'121', '99'
        var path3053 = paper.path("");
        path3053.attr({id: 'path3053',fill: '#000000','stroke-width': '0','stroke-opacity': '1'}).data('id', 'path3053');
        var path3051 = paper.path("");
        path3051.attr({id: 'path3051',fill: '#000000','stroke-width': '0','stroke-opacity': '1'}).data('id', 'path3051');
        var path3049 = paper.path("");
        path3049.attr({id: 'path3049',fill: '#000000','stroke-width': '0','stroke-opacity': '1'}).data('id', 'path3049');
        var path4100 = paper.path("M 27.696928,76.261018 C 19.747206,68.626322 11.266398,60.587164 7.4748915,50.835542 3.6833851,41.083922 3.3734124,26.811381 9.7549518,17.653528 16.136491,8.4956721 22.187901,4.6870338 32.951844,3.819554 43.715784,2.9520766 54.370274,9.8559705 58.825976,15.322773 63.03182,9.0752373 73.149817,2.1597917 82.97532,2.535815 c 9.825503,0.3760235 17.58955,4.1161266 24.45634,14.16105 6.86678,10.04492 6.42359,25.935606 2.63918,34.821536 C 106.2864,60.40433 95.625874,73.161814 87.142497,79.412544 78.659121,85.663272 67.21867,93.59175 59.402765,95.98188 51.60661,93.099221 35.646649,83.895715 27.696928,76.261018 z");
        path4100.attr({id: 'path4100',fill: '#ff3e35',stroke: '#000000',"stroke-width": '5',"stroke-linecap": 'butt',"stroke-linejoin": 'miter',"stroke-opacity": '1',"stroke-miterlimit": '4',"stroke-dasharray": 'none',"fill-opacity": '1'}).data('id', 'path4100');
        var tHeartSet = paper.set(path3053, path3051, path3049, path4100);
    </script>


    <?php
    //$ob_content = ob_get_contents(); //+++++++++++++++++++++++++++++++++++++++++
    //ob_end_clean();
    //return $ob_content;
}

// Create shortcode for the caller donation page.
// The 1st argument is the name of the shortcode, meaning that it will be used as "[<NAME>]" on a WP page.
// The 2nd argument is the name of the PHP function above, which will be used to insert text into the webpage.
add_shortcode('ea_donation_form', 'ea_donation_form_shortcode');
