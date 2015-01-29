<?php

/*
 * Copyright (C) 2015 sunyata
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

class pages {
    const email_sent    = 'email-sent/';
    const donation_sent = 'donation-sent/';
    const donation_form = 'donation-form/';
}

class stripe_donation {
    const default_amount   = '0.75';
    const private_test_key = 'pk_test_ZtBvgdrmlEPZGXUcCzDqVLOo';
    const shared_test_key  = 'sk_test_uEGJelp5bfMDnLp0LSfb9E7N';
}

class Constants {
    const empty_string = "";
}

//TODO: Re-factor to create methods for each Uri that returns a concatenated string of root + [desired URI]
class Uris {
	const root = '/wp-content/plugins/empathy_app/';
	const images = '/wp-content/plugins/empathy_app/images/';
	const logo16 = '/wp-content/plugins/empathy_app/images/logo_bwa_16x16.png';	
}