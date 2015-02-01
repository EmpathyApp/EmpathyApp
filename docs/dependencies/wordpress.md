DocVer: 0.0.1


Important book: Building web apps for Wordpress (bwafwp)

WP plugin development: http://codex.wordpress.org/Plugin_API/


#### Directory structure

The directory structure we are using is inspired by bwafwp. One exception is the structure of the documentation which is not covered in the book, this is instead inspired by the django github project

##### pages/

This directory contains shortcodes for use on wp pages, *they are not pages themselves* but only shortcodes


#### Suffixes

.php is used instead of .inc for security reasons (recommendation from php book)


#### Database

Wordpress has several systems for interacting with databases. Please see the code comments in db_init.php for details


#### Actions and filters

This is how we often interact with wordpress
* http://codex.wordpress.org/Function_Reference/add_action
* http://codex.wordpress.org/Plugin_API/Filter_Reference

