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
// TODO: Possibly we want to move this code as well as the getDatabaseToken function
// into the php (server) code instead
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
 * Updates the tScaleNr variable and changes the size of the heart
 * using this variable
 * @param iSliderValueInt
 */
function updateHeartSize(iSliderValueInt){
    tScaleNr = (0.2 * iSliderValueInt.value + 10) / 20;
    //-these values are based on some testing to see what looks good
    tHeartSet.attr({"transform": "S" + tScaleNr + "," + tScaleNr + ",0,0"});
}

function getDatabaseToken() {
    var rVal = getUrlParamValue(gConst.tokenUrlParamName);
    if (rVal === "") {
        //TODO
    }
    return rVal;
}
                    