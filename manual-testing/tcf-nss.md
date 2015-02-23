DocVer: 0.1


### Information

These documents can be useful to check out before running the test or if something is unclear:

* [Neat skype status v2/pro](../docs/dependencies/neat-skype-status.md)
* [Empathizer user guide](../docs/misc/empathizer-user-guide.md)


### Preparation

* Three skype accounts and three platforms (computer or mobile etc) with skype installed (in this document called "empathizer_1", "empathizer_2" and "caller"
* Admin account for testing site
* Caller account for testing site


### Procedure

1. Login as admin and go to the edit screen for the main page

2. Use the following text for the integrated neat skype status v2/pro shortcode:
 [skype skypenames="empathizer_1, empathizer_2"]

3. Modify the availabilty of the empathizer accounts and use the caller account to call


### Expected result

1. -
2. -
3. The following table shows who we expect to recieve a call:

emp1 \ emp2->  | Available | Away | Do not disturb | Offline
-------------- | --------- | ---- | -------------- | -------
Available      | 1         | 1    | 1              | 1
Away           | 2         | 1    | 1              | 1
Do not disturb | 2         | 2    | No one         | No one
Offline        | 2         | 2    | No one         | No one


### Test notes

* It does not matter if a user is in a call or not. Only the availability and the order in the integrated nss shortcode matters


