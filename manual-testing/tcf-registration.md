Reviewed by:
* Tord


## Preparation

* A skype name which has not been registered before (on the test site)
  * Needs to be an old-fashoned skype name, you can register [here](https://login.skype.com/account/signup-form) (has been problems for some browsers though, probably IE is safest)
* An email which has not been registered before


## Procedure

#### 1. Go to the registration page
Expected result: You can see that
* There is a text describing that the username must be a skype name
* There are terms and conditions

#### 2. Enter a skype name which has not been registered before with skype, but which is real
#### 3. Enter an email which has not been registered before
#### 4. Leave the checkbox as it is (unchecked)
#### 5. Click on the "Register" button
Expected result: You see an error message similar to this one:
  "ERROR: You must accept the terms and conditions to register"

#### 6. Enter a skype name *that does not exist*
#### 7. Enter an email address
#### 8. Click the checkbox so that it is checked
#### 9. Click on the "Register" button
Expected result: You see an error message telling you that you need to provide a real skype name

#### 10. Enter a skype name which has not been registered before, but which is real
#### 11. Enter an email address
#### 12. Click the checkbox so that it is checked
#### 13. Note the time (minute accuracy)
#### 14. Click on the "Register" button
Expected result: You see a confirmation message telling you that you have registered

#### 15. Go to the email account for the web address you provided in the second field
Expected result: You see that
* the message was recieved at the time noted previously
* no messages have been recieved from the previous tries to register

#### 16. Go to the admin account and click on "users"
Expected result: You see that one (and only one) new user has been created with the expected name and email

### Test case notes

* Repeat this process for microsoft account?
* Add another test for when an account already exists? No: This is not a worry since wp takes care of it

