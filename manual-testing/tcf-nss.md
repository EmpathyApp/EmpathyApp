Reviewed by:
* Tord


## Information

These documents can be useful to check out before running the test or if something is unclear:

* [Neat skype status v2/pro](../docs/dependencies/neat-skype-status.md)
* [Empathizer user guide](../docs/misc/empathizer-user-guide.md)


## Preparation

* Three skype accounts and three platforms (computer or mobile etc) with skype installed (in this document called "empathizer_1", "empathizer_2" and "caller"
* Admin account for testing site
  * We use the admin account for making calls, the reason is that it doesn't matter technically and it makes this test alot faster to complete since we don't need to log out and back in many times

## Procedure

#### 1. Login as admin and go to the edit screen for the skype page (Pages -> All Pages)

#### 2. Use the following text for the integrated neat skype status v2/pro shortcode:
  [skype skypenames="empathizer_1, empathizer_2"]

#### 3. Modify the availabilty of the empathizer accounts and make calls
Expected result: The following table shows who we expect to recieve the call:

emp1 \ emp2 ->    | Available | Away | Do not disturb | Offline/Invisible
----------------- | --------- | ---- | -------------- | -----------------
Available         | 1         | 1    | 1              | 1
Away              | 2         | 1    | 1              | 1
Do not disturb    | 2         | 2    | 1              | 1
Offline/Invisible | 2         | 2    | 2              | No one


## Test notes

* It does not matter if a user is in a call or not. Only the availability and the order in the integrated nss shortcode matters
* You can copy and paste the table and insert the results for the different combinations there (maybe you can even skip a few in the interest of time)

