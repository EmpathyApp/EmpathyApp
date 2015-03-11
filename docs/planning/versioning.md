Reviewed by:
* Tord


### Internal versioning

We have chosen to version our software with three numbers separated by periods.

[api-changes].[feature-updates].[bug-fixes]


### External versioning

When communicating externally we may talk about a ALPHA or BETA release

##### ALPHA release

The software is not 100% tested yet, in other words:
* The testing has not yet been completed (but maybe started)
  * for example if we have an auto-test system that covers alot this we would still get alpha releases first

##### BETA release

The software is not 100% stable yet, in other words:
* The testing has been completed, but at least one of the following are true:
  * there are one or more bugs that has been found
  * *OR* there are external dependencies that are creating problems, and these limitations are not documented in the specifications for the system

##### PRODUCTION release

* There are no known bugs left in the software itself
* *AND* workarounds have been found for problems with external dependencies, or the specifications for the software has been changed to reflect limitation


### Using tags in git



***


### References
* http://en.wikipedia.org/wiki/Software_versioning#Incrementing_sequences
* https://tommcfarlin.com/wordpress-theme-updates/
