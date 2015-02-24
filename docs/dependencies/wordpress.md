
This document contains:
* help for developers who are not used to development of Wordpress plugins
* descriptions of architecural decisions connected to Wordpress

Important book: Building web apps for Wordpress (BWAFWP).

WP plugin development official documentation: http://codex.wordpress.org/Plugin_API/


#### Directory structure

The directory structure we use is inspired by BWAFWP (p60-65). One exception to this is the structure of the documentation which is not covered in the book. Instead, this is inspired by the [django github project docs directory](https://github.com/django/django/tree/master/docs).


##### pages/

This directory contains shortcodes for use on WP pages, *they are not pages themselves* but only shortcodes which can be included.


#### Suffixes

.php is used instead of .inc for security reasons (recommendation from PHP book).


#### Including JS libs

This is not done in the ordinary way (by using src inside a script tag). Instead, this is done with the "wp_enqueue_scripts" Wordpress action hook. *It's very important to use "wp_enqueue_scripts",* otherwise we will get strange errors.


#### Database

Wordpress has several systems for interacting with databases. Please see the code comments in [database_functions.php](../../includes/database_functions.php) for details.


#### Actions and filters

Using actions and filters is how we interact with Wordpress.

Here are a couple of useful links:
* http://codex.wordpress.org/Plugin_API/Action_Reference
* http://codex.wordpress.org/Plugin_API/Filter_Reference

***

#### References

* [10 things that are helpful for WP developers to know](http://www.smashingmagazine.com/2011/03/08/ten-things-every-wordpress-plugin-developer-should-know/)


