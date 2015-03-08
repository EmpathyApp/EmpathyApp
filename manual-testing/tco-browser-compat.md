*draft*


## Overview

We would like to test all the browsers mentioned in [the test strategy](test-strategy.md)


## Preparation

* Admin account


#### Tools

You can run this test manually or you can use one of these testing tools:

Tool | Platform | Notes
---- | -------- | -----
https://www.equafy.com/ | Cross-OS, requires Firefox | For Chrome and FF it renders only the first 2000 pixels veritcally. Don't use FF 35 since there's a selenium issue with it (use 34 instead until equafy adds 36)
http://netrenderer.com/ | Multi-platform
http://browsershots.org/ | Multi-platform | Not very reliable, sometimes we get black screens for example
http://spoon.net/browsers/ | For Windows | Highly recommended on the http://softwaretestinghelp.com/ website


## Procedure

#### 1. Log in as admin

#### 2. Go to the main page
Expected result: Skype button is rendered

#### 3. Go to the email-form page
Expected result: Both the input forms are rendered

#### 4. Go to the donation-form page
Expected result: (1) The slider, (2) amount and (3) heart is rendered

#### 5. Drag the slider
Expected result: (1) The amount changes and (2) the size of the heart changes

**Repeat procedure for multiple browsers** (see report table below)


## Reporting the result

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
UC Browser for Android (M) | 
iOS Safari (M)             | 

If you were unable to run the tests for one of the browsers, just write this for that browser (this is better than removing the line)


## Test case notes

* Screen size is covered in the usability testing


