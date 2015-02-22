DocVer: 0.1



Very large test case, any way to split up?





### Preparation

* latest version of the empathy app plugin
* One caller account
* One empathizer account
  * Important: Verify that the empathizer account is really a "contributor" in wordpress


### Procedure

1. Go to the email-form page

2. Enter a user name / skype name which *does not exist*
3. Enter a negative length, and press send
4. Enter zero as the length, and press send
5. Enter a positive length, and press send

6. Enter a user name / skype name which exist for a **caller** (called "subscriber" in wp)
7. Note the time (with minute accuracy)
8. Enter a positive length, and press send

9. Go to your email account and check for new email messages
10. Open the new email

### Expected result

3. You get a message on the same page similar to "Please select a value no less than 1"
4. You get a message on the same page similar to "Please enter a number"
5. You see an error message (on a new page) similar to this one: "Incorrect skype name.</b> Email not sent. Please go back and try again"

8. You get to a new page and get a message similar to this one "Email successfully sent to caller"

9. You see one (and only one) email that was sent at the time noted previously
10. You see 


### Meta-test notes

* Repeat this process for microsoft account?










admin interface



