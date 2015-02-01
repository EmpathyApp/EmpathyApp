DocVer: 0.1


This document contains:
* help for developers who are not used to development of wordpress plugins
* descriptions of architecural decisions connected to Wordpress

Important book: Building web apps for Wordpress (bwafwp)

WP plugin development official documentation: http://codex.wordpress.org/Plugin_API/


#### Directory structure

The directory structure we are using is inspired by bwafwp (p60-65). One exception is the structure of the documentation which is not covered in the book, this is instead inspired by the [django github project docs directory](https://github.com/django/django/tree/master/docs)


##### pages/

This directory contains shortcodes for use on wp pages, *they are not pages themselves* but only shortcodes which can be included


#### Suffixes

.php is used instead of .inc for security reasons (recommendation from php book)


#### Including JS libs

This is not done in the ordinary way (by using src inside a script tag), instead this is done with the "wp_enqueue_scripts" Wordpress action hook. *It's very important to use "wp_enqueue_scripts",* otherwise we will get strange errors


#### Database

Wordpress has several systems for interacting with databases. Please see the code comments in [db_init.php]() for details


#### Actions and filters

Using actions and filters is how we interact with wordpress

Here are a couple of useful links:
* http://codex.wordpress.org/Function_Reference/add_action
* http://codex.wordpress.org/Plugin_API/Filter_Reference


