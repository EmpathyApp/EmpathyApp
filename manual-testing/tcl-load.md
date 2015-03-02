Reviewed by:
* Tord


### Preparation

* A loader.io account
  * [artile 1](http://support.loader.io/article/15-creating-a-test), [article 2](http://support.loader.io/article/16-test-types), [article 3](http://support.loader.io/article/19-test-results)

http://cpanel.hyrax.arvixe.com/


Please note:
* Don't test the skype page since this will make ajax requests, instead we emulate this ourselves by making multiple requests
* Tests are run on www.empathyapp.org - if site is running live please choose a time when there is little or no traffic (maybe at US nighttime, or you can check the server stats)


### Procedure

1. Log in on loader.io
2. Change test type to Clients per second
3. Set the number of clients to 1 (this will make 1 requests per second simulating ajax calls for 1 * x users where x is the number of seconds between AJAX updates for NSS)
4. Change the number of clients to 2 and run again
5. Change the number of clients to 3 and run again
6. Continue increasing the number of clients until you get this message "This test was aborted because it reached the error threshold."
7. Change the number of clients to 2 and start the tests, and go back to the site and go to different pages


### Record

1. -
2. -
3. Average response time and error rate
4. -"-
5. -"-
6. -"- and also noting that this is as high as you can get
7. Subjective user experience


### Test notes

