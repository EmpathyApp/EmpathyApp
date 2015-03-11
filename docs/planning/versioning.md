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


##### Important consideration

Please don't forget that the quality of the software is not just depending on how well the tests pass and what stage that we can say that we are in but also on the test strategy and the coverage of the test cases


### Using tags in git

We can add tags when a new version is released for distribution on the website. This does not necassarily have to be a production release, but can also be a beta release (but alpha would be unusual because this is very risky). In other words: If we have added a tag we know that this version will "go live" and be installed and used for real payments on the website

Three parts:
* Internal version
* External verison
* Date

Example: 1.0.0 BETA 2015-03-11

We can add a tag to a commit by using this ```tag``` command in git, for example:
```
git tag
```

***


### References
* http://en.wikipedia.org/wiki/Software_versioning#Incrementing_sequences
* https://tommcfarlin.com/wordpress-theme-updates/
