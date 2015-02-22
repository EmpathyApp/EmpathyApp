DocVer: 0.1



### Preparation

* latest version of the empathy app plugin
* One caller account
* One admin account
* **Stripe empathy app access** (dashboard etc)
* NOTE: assumes you are using private and public ("shared") test keys (can be seen in the empathy app settings area) *Do not enter your own credit card number in this test*, a test number will be given in the testing procedure that you can use
* **Three unused donation links**
  * Does not have to be from an email, but this is one way of getting the donation link and ensuring that the token is correct



### Procedure

1.  Find an unused donation link (for example in an email)

2. Log in as an admin and find the record corresponding to that specific link (maybe at the end of the list if the record has recently been created)

3. For donation link 1: Load (or click on) the link
4. Drag the donation slider to the bottom, to the top and then back some distance
5. Press the "donate" button
6. Fill in
  * Card nr: 4242 4242 4242 4242
  * Date and verification nr can be anything
7. Leave the "remember me" checkbox unchecked
8. Press "pay x" and note the time
9. Go to [the Empathy App stripe payments page](https://dashboard.stripe.com/test/payments/overview) to check that the *virtual* money has been transfered
10. Go to Call Records in the admin interface and find the new record

11. For donation link 2: Repeat the process in 3-10 above but activate the "remember me" checkbox and fill in any additional details required

12. For donation link 3: Repeat the process in 3-10 above

13. For donation link 1: Repeat the process in 3-10 above

14. Load the url without any arguments at the end (for example http://coetzee.ihavearrived.org/)

15. For donation link 2: Change one of the symbols in the dbToken value and repeat the process in 3-10 above


### Expected result

2. You see that all columns have been updated for this specific record *with the exception of the value for the actual donation* which is -1

3. You see
  * that the donation-form page is loaded
  * you can see the donation slider
  * You see the the amount and it matches the amount given in the url parameter

5. (Please be aware: It will take a while before the next screen is loaded (maybe 20 seconds) becase the stripe servers are contacted to see if the user is known from before)

8. You get to the "donation-sent" webpage

9. You can see that the amount has been transfered at the time noted previously

10. You can see that the value in the column "actual donation" has been updated

11. You can see that the amount has been transfered at the time noted previously

12. You can see that the amount has been transfered at the time noted previously. This time you will not have had to fill in any details at all

13. You get a message similar to this one: "You have already made a donation for this call!"

14. You get a message similar to this one: "Error: No token given. Please go back to the email and click on the link again"

15. You get a message similar to this one: "Error: Incorrect token! (Token does not exist in the database)"


### Meta-test notes




