Reviewed by:
* Tord


### Overview

We want to test all the browsers mentioned in [the test strategy](test-strategy.md)


### Preparation

* Admin account


#### Tools

You can run this test manually or you can use one of these testing tools:
* https://www.equafy.com/ - Cross-OS, requires Firefox
* http://netrenderer.com/ - Multi-platform
* http://browsershots.org/ - Multi-platform
* http://spoon.net/browsers/ - For Windows


### Procedure

1. Log in as admin
2. Go to the main page
3. Go to the email-form page
4. Go to the donation-form page
5. Drag the slider

**Repeat procedure for multiple browsers** (see report table below)


### Expected result

1. -
2. Skype button is rendered
3. Both the input forms are rendered
4. The (1) slider, (2) amount and (3) heart is rendered
5. The (1) amount changes and (2) the size of the heart changes

#### Reporting the result

The most important things to report:
* Were there failures for any of the browsers?
* Which browsers were tested?

You can create a new page in the wiki by linking to a non-existant page from the test record table and use this table for reporting the results:

Browser | Version | OS | Test tool | Result | Notes
------- | ------- | -- | --------- | ------ | -----
Chrome  | 
Firefox |
IE      |
Safari  |
Android browser (M)        | 
Chrome for mobile (M)      | 
iOS Safari (M)             | 
UC Browser for Android (M) | 

If you were unable to run the tests for one of the browsers, just write this for that browser (this is better than removing the line)


## Test case notes

* Screen size is covered in the usability testing


