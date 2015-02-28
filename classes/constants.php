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
    const skype_page    = 'skype-page/';
    const email_form    = 'email-form/';
    const email_sent    = 'email-sent/';
    const donation_form = 'donation-form/';
    const donation_sent = 'donation-sent/';
}

class stripe_donation {
    const default_amount   = '0.75';
    const default_max_amount = '150';
    const private_test_key = 'pk_test_ZtBvgdrmlEPZGXUcCzDqVLOo';
    const shared_test_key  = 'sk_test_uEGJelp5bfMDnLp0LSfb9E7N';
}

class Constants {
    const empty_string = "";
    const default_prio = 10;
    const not_set = -1;
}

//TODO: Re-factor to create methods for each Uri that returns a concatenated string of root + [desired URI]
class Uris {
    const root = '/wp-content/plugins/empathy_app/';
    // const images = '/wp-content/plugins/empathy_app/images/';
    // const logo16 = '/wp-content/plugins/empathy_app/images/logo_bwa_16x16.png';
    // const logo256 = '/wp-content/plugins/empathy_app/images/logo_256x256.jpg';	
    const logo16 = '/logo_bwa_16x16.png';
    const logo256 = '/logo_256x256.jpg';	
}

//Important that these are in lower case (wordpress db is picky)
class DatabaseAttributes {
    const id = 'id';
    const date_and_time = 'date_and_time';
    const recommended_donation = 'recommended_donation';
    const actual_donation = 'actual_donation';
    const call_length = 'call_length';
    const database_token = 'database_token';
    const caller_id = 'caller_id';
    const empathizer_id = 'empathizer_id';
}
