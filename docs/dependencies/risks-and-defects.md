DocVer: 1.0


This list is used for risks external to our own application but that can effect our application. Please use strikethrough (double tildes on each side) for resolved issues

Risk/Defect | Area | Notes/Workaround
--- | --- | ---
**skype status not supported officially** | skype |
skype status differs between platforms | skype | only when the other side is logged in on multiple devices?
[*Server limitations*](https://support.arvixe.com/index.php?/Knowledgebase/Article/View/289/4/linux-hosting-resource-limits) | Hosting (arvixe) | For example the outbound emails are limited to 200-300 per hour (according to the support). Server limitations can probably be solved by upgrading to a more expensive plan
[*cpu 100%*](http://forum.arvixe.com/smf/clip-bucket-software/100-cpu-usage/) | Arvixe | This has been seen on SunyataZero's account, but only temporarily, a guess is that it has to do with backup compression, normally the load is 0% and the avg is around 0% as well
skype ms accounts cannot be verified? | skype | require callers to use a skype account instead of an ms account
"Metro" version of skype on win8 does not give status | skype | Use "desktop" Skype app version instead of "Metro" version for empathizers
**Scaling with number of active users** | Wordpress, hosting (arvixe) | See p251 in "Building Web Apps with Wordpress". ***That this is a big problem is supported by preliminary load testing, see issue #57***
**skype status dissapears** | Wordpress, nssp, jQuery | jQuery cannot be loaded in a traditional way, we need to use wp_enqueue_scripts + wp_enqueue_script
Problems when creating a custom php.ini from cPanel | Hosting (arvixe) | This may be necessary if we want to upload files larger than 2MB or if we want to disable "magic quotes"
File and dir permissions for enabling upload | WP / Hosting (arvixe) |
Automated emails not sent | Arvixe | Automated emails were caught in an *outbound* spam filter, this has now been fixed by arvixe but of course *could happen again* if we create a new hosting account
fetching data from website with regex | php | "What ever you do: Don't use regular expressions to parse HTML or bad things will happen. Use a parser instead." [*link*](http://stackoverflow.com/questions/2019892/extract-data-from-website-via-php)
problems with xdebug on arvixe/remote? | arvixe | One arvixe support person says that they [*"strongly recommend"*](http://forum.arvixe.com/smf/general/xdebug/) not to use their server for debugging
**php injection** | |
One extra db row for each form submit | Ninja forms | Because of this we are making our own forms (at the time of writing)
"undefined variable return_value on line 406" | Neat Skype Status pro/v2 | Minor bug known to the developer of nss, doesn't seem to affect functionality
**Neat skype status calls empathizer even if she is logged out** | Neat Skype Status pro/v2 | the empathizer will be in the queue and will be called last (2nd to last?)
Stripe error in firebug for users who are not registered | Strip | ```POST https://checkout.stripe.com/api/account/lookup Aborted``` This error is expected since a call will be made to the stripe servers to see if the user already has an account. There is nothing to do for us at Empathy App about this, i've verified this with one of the Stripe devs


