DocVer: 0.1



../docs/dependencies/neat-skype-status.md

../docs/misc/empathizer-user-guide.md


### Preparation

* Three skype accounts and three platforms (computer or mobile etc) with skype installed (in this document called "empathizer_1", "empathizer_2" and "caller"
* Admin account for testing site


### Procedure

1. Login as admin and go to the edit screen for the main page

2. Use the following text for the integrated neat skype status v2/pro shortcode:
 [skype skypenames="echo123, empathizer_1, empathizer_2"]

3. Modify the availabilty of the empathizer accounts and use the caller account to call




### Expected result

3. The following table shows the results we expect from this part of the test:

emp1 \ emp2->  | Available | Away | Do not disturb | Offline
-------------- | --------- | ---- | -------------- | -------
Available      | 1         | 1    | 1              | 1
Away           | 2         | 1    | 1              | 1
Do not disturb | 2         | 2    | echo123        | echo123
Offline        | 2         | 2    | echo123        | echo123

Please note that echo123 is always offline



### Test notes

* Please note that this is not a load test, only a testing of the functionality

* It does not matter if a user is in a call or not. Only the availability and the order in the integrated nss shortcode matters


