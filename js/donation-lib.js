var gConst = {
    'tokenUrlParamName': 'dbToken',
    'recDonationDollarsUrlParamName': 'recamount',
    'noRedirectDonationDollars': 42,
    'minDonationDollars': 1,
    'donationStepSizeDollars': 1,
    'animationMargin': 2,
    'initialDonationAmount': 0
};

var gHeartImg = {
    'dim': '310',
    'tHeartSet': null
};

// Given the name of an URL parameter (normally coming from an email sent to the user),
// return its associated value.
// TODO: Possibly we want to move this code, as well as the getDatabaseToken function,
// into the PHP (server) code instead.
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

/*
 * Calculate the scaling value and scale the Raphael heart image
 * using this value.
 * @param iSliderValueInt
 */
function updateHeartSize(iSliderValueInt) {
    if (gHeartImg.tHeartSet == null) {
        console.error("updateHeartSize() called when gHeartImg.tHeartSet == null");
        return;
    }
    // These values are the result of experimentation.
    tScaleNr = (0.2 * iSliderValueInt + 10) / 20;
    gHeartImg.tHeartSet.attr({"transform": "S" + tScaleNr + "," + tScaleNr + ",0,0"});
}

function getDatabaseToken() {
    var rVal = getUrlParamValue(gConst.tokenUrlParamName);
    if (rVal === "") {
        // TODO
    }
    return rVal;
}
