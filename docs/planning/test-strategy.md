*draft*


Testing types:
* Manual integration testing
* Auto unit testing
  * phpunit.de
    * [how to write unit tests for procedural code](http://stackoverflow.com/questions/899390/how-do-i-write-unit-tests-in-php-with-a-procedural-codebase)
* Auto GUI testing
  * Selenium IDE/webdriver


### Testing areas


#### (Usability and accessability testing)

TODO


#### Security

As soon as we have a payment/donate button we will be attacked more

Reasons for securing the site:
* Protecting against man-in-the-middle attacks for stripe credit card information
* Protecting against manipulation of empathizer donation data
* Protecting against privacy invasion for callers
* Simply avoiding to having to take the site down

* checklist: ---> https://www.owasp.org/index.php/Web_Application_Security_Testing_Cheat_Sheet
* Tools: https://addons.mozilla.org/en-US/firefox/collections/adammuntner/webappsec/


#### Load testing
* A simple solution is to just analyze the wp statistics
* Curl-loader
* Apache JMeter
* http://stackoverflow.com/questions/22903630/how-to-perform-load-testing-using-selenium-webdriver


#### Basic functionality
* auto: selenium
* auto: watir
* manual: people!


#### Other considerations
* browser compat
* os compat
* skype client version compat

***

#### References

Books:
* **Chapter in "Building Web Apps for Wordpress**
* Chapter in "Producing open source software"
* Chapter in "PHP programming"

OWASP:
* https://www.owasp.org/
* https://www.owasp.org/index.php/Appendix_A:_Testing_Tools
* https://www.owasp.org/index.php/Web_Application_Security_Testing_Cheat_Sheet

Articles:
* http://en.wikipedia.org/wiki/Web_testing
* http://thenextweb.com/apps/2013/11/28/guide-testing-web-app-steps-approach-testing-get-sessions/

