DocVer: 0.1


For a graphical overview, please see the images at the end of this text


### Prerequisites

* Access to remote test or dev server
* Administrator user account
* Two more email accounts (excluding the one for the admin account)


### Testing area

If you don't have a remote development site, you can use [this site](http://kuanyin.ihavearrived.org/) instead


### Definitions

* Caller: Wordpress "subscriber" user
* Empathizer: Wordpress "contributor" user


### Procedure

1. Register a caller on empathy app site by pressing "register" in the sidebar "meta" area
  1. Enter a valid skype name
  2. Enter an email address that you have access to

2. Create a skype account with name "empathizer_{your-first-name}"

  Log out before proceeding

3. Register an empathizer (called "contributor" in wp) on empathy app site by going to the admin area and then choosing "Users" -> "Add new"
  1. Use the same name as in step 2 above: empathizer_{your-first-name}
  2. Use another email address than in step 1 above

  Before proceeding: Make sure you are logged in as an empathizer

4. Go to front page of empathy app website and see the skype button/icon showing status

5. Verify that when hovering over the icon there is a link shown (in firefox in the bottom left corner) with a skype uri (for example "skype:tord_dellsen?call" or "skype:echo123?call")

6. Go to the "Email form" page of the empathy app website
  1. Fill in the caller name
  2. Fill in a number (number of minutes)
  3. Click send

7. Go to your email account that was used when registering the caller
  1. Within one minute an email should appear there (if not check the spam folder)
  2. Open the email and verify that the info is correct (number of minutes, 

8. Click on the link in the email
  1. Verify that the number of minutes is used on the newly loaded page

9. Drag the slider

10. Click the donate button to open the stripe dialog

11. Fill in the test credit card details:
  1. One of your email addresses
  2. Test card number: 4242 4242 4242 4242
  3. The other numbers can be almost anything
  4. Press the pay button

12. Verify that the text says you have paid the expected amount


### Graphical overview

![before_call](_img/before_call.png)

![after_call](_img/after_call.png)

