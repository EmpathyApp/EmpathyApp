EmpathyApp
==========

Empathy App connects trained empathizers via smartphone to people in need of empathy giving instant support to people


Works as a Wordpress plugin using wp shortcodes and wp filters
Relies on NinjaForms wp plugin and Neat skype status wp plugin


Our remote test site:
http://empathy.ihavearrived.org/wp
(shortcodes already added and dependency plugins installed)

You may want to create an account so that you can test the "empathizer email" page and send yourself emails


Structure:
The webpage using EmpathyApp needs to have four pages:

One for the skype status and call button
http://empathy.ihavearrived.org/wp

One for the empathizer to fill in call info after the call
http://empathy.ihavearrived.org/wp/home/empathizer-email-form/
Shortcode: Does not have a shortcode, instead Ninja Forms is used with some extra wp filtering code added by us (in the main file empathy_app.php)

One for the caller to send a donation
http://empathy.ihavearrived.org/wp/home/id10/
Shortcode: [ea_donation]

And one for displaying a thank you to the caller (this page actually takes the donation but the user does not see this)
http://empathy.ihavearrived.org/wp/home/thank-you/
Shortcode: [ea_thankyou]


