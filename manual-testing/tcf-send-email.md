DocVer: 0.1



### Preparation

* latest version of the empathy app plugin
* One caller account
* One empathizer account
  * Important: Verify that the empathizer account is really a "contributor" in wordpress
* One admin account
  * default setting for the donation multiplier (at the time of writing 0.75)


### Procedure

1. Go to the email-form page

2. Enter a user name / skype name which *does not exist*
3. Enter a negative length, and press send
4. Enter zero as the length, and press send
5. Enter a positive length more than 500, and press send
6. Enter a positive length less than 100, but more than or equal to 1 (note the lenght entered) and press send

7. Enter a user name / skype name which exist for a **caller** (called "subscriber" in wp)
8. Note the time (with minute accuracy)
9. Enter a positive length, and press send

10. Go to your email account and check for new email messages
11. Open the new email

12. Go to the admin interface, logged in as an administrator
13. Go to the call records


### Expected result

3. You get a message on the same page similar to "Please select a value no less than 1"
4. You get a message on the same page similar to "Please enter a number"
5. You get a message on the same page similar to "Please select a value less than 200"
6. You see an error message (on a new page) similar to this one: "Incorrect skype name.</b> Email not sent. Please go back and try again"

9. You get to a new page and get a message similar to this one "Email successfully sent to caller"

10. You see one (and only one) email that was sent at the time noted previously
11. You see a message with
  * The name of the empathizer <--- TODO
  * A url containing
    * A token
    * A donation amount matching the call length which was noted before. donation = multiplier * length (rounded down), where the multiplier is 0.75 by default

13. You see that all columns have been filled in except for the "actual donation" column


### Meta-test notes

* Repeat this process for microsoft account?


