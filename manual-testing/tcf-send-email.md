Reviewed by:
* Tord


## Preparation

* One caller account
* One empathizer account
  * Important: Verify that the empathizer account is really a "contributor" in wordpress
* One admin account
* Default setting for the donation multiplier (at the time of writing 0.75)
  * If changed this can be reset in the admin interface in the Empathy App settings
* Write access to the database (using for example sidu or myphpadmin)
* Important: Please make sure there is one row or more for the caller you will be using in the Call Records table before starting the tests. If not then simply follow steps 7-10 and start from the first step again (The reason is that the first-time users get a rebate, this is tested later on in this test but not in the beginning)


## Procedure

----------------------------- new caller

#### 1. Go to the email-form page

#### 2. Enter a user name / skype name which *does not exist*

#### 3. Enter a negative length, and press send
Expected result: You get a message on the same page similar to "Please select a value no less than 1"

#### 4. Enter zero as the length, and press send
Expected result: You get a message on the same page similar to "Please enter a number"

#### 5. Enter a positive length more than 500, and press send
Expected result: You get a message on the same page similar to "Please select a value less than 200"

#### 6. Enter a positive length less than 100, but more than or equal to 1 (note the lenght entered) and press send
Expected result: You see an error message (on a new page) similar to this one: "Incorrect skype name.</b> Email not sent. Please go back and try again"

#### 7. Enter a user name / skype name which exist for a **caller** (called "subscriber" in wp)

#### 8. Note the time (with minute accuracy)

#### 9. Enter a positive length, and press send
Expected result: You get to a new page and get a message similar to this one "Email successfully sent to caller"

#### 10. Go to your email account and check for new email messages
Expected result: You see one (and only one) email that was sent at the time noted previously

#### 11. Go to your email client and open the new email
Expected result: You see a message with
* The display name (maybe the skype name for example) of the empathizer (the user that was logged in when sending the email)
* A url containing
  * A token
  * A donation amount matching the call length which was noted before. donation = multiplier x length, where the multiplier is 0.75 by default (assuming this is not a first-time caller)

#### 12. Go to the call records in the admin interface (logged in as an administrator)
Expected result: You see that there is a new row where all columns values have been filled in except for the "actual donation" column

  
#### 13. Remove all records for the caller account
(using for example sidu or phpmyadmin)

#### 14. Note the time (with minute accuracy)

#### 15. Enter **5 (five)** as the length, and press send
Expected result: You get to a new page and get a message saying that ***no email was sent***

#### 16. Go to your email client
Expected result: You see no message at the recorded time

#### 17. Go to the call records in the admin interface (logged in as an administrator)
Expected result: You see that there is a new row where all columns values have been filled in except for the "actual donation" column

PLEASE NOTE: This is filled in even though no email is sent

  
#### 18. Remove all records for the caller account
(using for example sidu or phpmyadmin)

#### 19. Note the time (with minute accuracy)

#### 20. Enter **10 (ten)** as the length, and press send
Expected result: You get to a new page and get a message similar to this one "Email successfully sent to caller"

#### 21. Go to your email client and open the new email
Expected result: You see a message with
* The display name (maybe the skype name for example) of the empathizer (the user that was logged in when sending the email)
* A url containing
  * A token
  * A donation amount matching the call length which was noted before. donation = multiplier x length **- 5** (becase this is a first-time caller), where the multiplier is 0.75 by default

#### 22. Go to the call records in the admin interface (logged in as an administrator)
Expected result: You see that there is a new row where all columns values have been filled in except for the "actual donation" column


## Test notes

