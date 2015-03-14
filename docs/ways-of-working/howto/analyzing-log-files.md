*draft*


## Information

hyrax is the name of the arvixe server that we are currently using for the production site


## Logs

### Error logs

[Error logs on hyrax](http://hyrax.arvixe.com:2082/cpsess4094268941/frontend/x3/stats/errlog.html)

"This function will display the last 300 errors for your site. This can be very useful for finding broken links or problems with missing files. Checking this log frequently can help keep your site running smoothly."

http and https


### (Apache) access logs

Filtering out the url's that we are expecting:
* /
* skype-page/
* email-form/
* email-sent/
* donation-form/
* donation-sent/
* contact form, EULA, etc

[Raw access logs on hyrax](http://hyrax.arvixe.com:2082/cpsess4094268941/frontend/x3/raw/index.html)

http and https


### cPanel AW stats

[](http://hyrax.arvixe.com:2082/cpsess4094268941/frontend/x3/stats/awstats_landing.html)


## Analysis tools

* AWStats
* gnome-system-log
* http://goaccess.io/
* splunk
* http://www.hping.org/visitors/

More: http://alternativeto.net/software/awstats/?license=opensource
