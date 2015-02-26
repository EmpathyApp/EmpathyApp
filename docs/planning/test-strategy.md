Reviewed by:
* Tord


This document covers:
* Manual testing

..but doesn't cover:
* Unit testing


# Testing areas


## Usability

Contact person: Peijman

Important to remember mobile devices

Includes testing of screen size limitations. For example: how far can we resize the width of a browser window before we see a horizontal scrollbar?

TODO


## Functionality

* auto-testing with selenium - not added yet
* manual - added, see the manual-testing/ directory


## Load

Contact person: Tord

* A simple solution is to just analyze the wp statistics
* Curl-loader
* Apache JMeter
* http://stackoverflow.com/questions/22903630/how-to-perform-load-testing-using-selenium-webdriver
* Loader.io


## Security

Contact person: Tord

We keep the information about security and security testing secret (as well as potential issues). If you are part of the secret "security team" you can access [this directory](https://drive.google.com/folderview?id=0B_YFLvEhbTAqfnpzYllveG9iMmJHNHJuVjVqQ0JfVDNsRGlTX1duVjZtVWdTZ1YyRUlIaUE&usp=sharing) on google drive where you can find more information


## Other


### Compatibility

Contact person: Tord

Condiderations when doing these tests (esp. manually):
* In the interest of time we don't test all combinations. So if we have three areas and three alternative for each area we run 3+3+3=9 tests (not 3*3*3 = 27 tests)
* We only care about the front-end, simply because this is what the browser is handling. So in practice we can be logged in as admin (which gives us access to all pages) and visit each page to see what it looks like (maybe also testing input fields)
* We are not as interested in testing different OS:es as browsers since we don't do API calls. This means that we expect the same result when running the same browser but on different OS:es
  * The main thing here would be to test the different versions of skype, so it is still important that we run the tests at least once for all major platforms
  * The latest version of skype for each platform is assumed
* Useful if we can have testers who run the functinoality tests on the major platforms, then we can get more detailed testing done "for free"

Here's a 15-point checklist that can be useful in the future:
http://www.softwaretestinghelp.com/best-cross-browser-testing-tools-to-ease-your-browser-compatibility-testing-efforts/


#### Browsers

[ref](http://caniuse.com/usage_table.php)

* Chrome (D)
* Firefox (D)
* IE (D)
* Safari (D)
* Android browser (M)
* Chrome for mobile (M)
* iOS Safari (M)
* UC Browser for Android (M)

TODO: How to deal with browser version?


#### OS:es

[ref1](http://www.w3schools.com/browsers/browsers_os.asp) [ref2](http://www.w3schools.com/browsers/browsers_mobile.asp)

* Win7 (D)
* Win8 (D)
* Mac (D)
* Ubuntu (D)
* Android (M)
* iOS (M)


#### References


##### Articles
* http://www.softwaretestinghelp.com/how-is-cross-browser-testing-performed/
* http://www.softwaretestinghelp.com/best-cross-browser-testing-tools-to-ease-your-browser-compatibility-testing-efforts/



***

## References

Books:
* Chapter in "Producing open-source software"
* Chapter in "PHP programming"

Articles:
* http://en.wikipedia.org/wiki/Web_testing
* http://thenextweb.com/apps/2013/11/28/guide-testing-web-app-steps-approach-testing-get-sessions/

Other:
* http://www.softwaretestinghelp.com/web-application-testing/
