Reviewed by:
* Tord


### Complete procedure for getting started with, running, and reporting tests

1. Go through the "preparation" and make sure you have everything, if not contact for example Tord (SunyataZero)
2. Install the latest version of the Empathy app plugin
3. Copy the manual test case into a new file (so that you can work with this as a guide)
4. Fill in these parts of the steps in the procedure
  * "Expected result: " - fill in with OK or NOK, if NOK then please give details
  * "Record: " - fill in with what is asked to record
5. Report the test result by putting it *at the top* of the [test record](https://github.com/EmpathyApp/EmpathyApp/wiki/Test-Overview#test-record)
  * Please don't forget to enter the OS and browser where applicable, even though we have special compat test cases these are not as detailed as when for example we are running tcf (functionality test cases)
6. If any bugs are found:
  * First look through [this list of open bugs](https://github.com/EmpathyApp/EmpathyApp/issues?q=is%3Aopen+is%3Aissue+label%3Abug)
  * If the bug is not present in that list: Create a new issue with the "bug" tag and choose the closest milestone


### Tools

Tool | Test area | Notes
---|---|---
[*User agent switcher*](https://addons.mozilla.org/en-US/firefox/addon/user-agent-switcher/) | Security | Not tried yet
[*Tamper data*](https://addons.mozilla.org/en-US/firefox/addon/tamper-data/) | Security | Not tried yet
[*Modify data*](https://addons.mozilla.org/en-US/firefox/addon/modify-headers/) | Security | Not tried yet
[*Loader*](http://loader.io/) | Load | Cost-free but limited to one site
[*List of Firefox security plugins*](https://addons.mozilla.org/en-US/firefox/collections/adammuntner/webappsec/)

See also the tools at the end of the [programmer document](programmer.md)
