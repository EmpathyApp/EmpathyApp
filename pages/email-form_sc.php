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

chdir(dirname(__FILE__));
require_once '../classes/constants.php';

function ea_email_form_shortcode() {
    ob_start(); //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    ?>


    <form
        id="empathizerForm"
        action=<?php echo getBaseUrl() . pages::email_sent; ?>
        type="hidden"
        method="POST"
    >
        <label for="skype_name">Skype Name</label><input name="skype_name" id="skype_name" type="text">
        <label for="skype_name">Call Duration</label> <br>
        <input name="length" id="length" type="number"> <br>
        <input type="submit" value="Send" id="submit">
    </form>


    <?php
    $ob_content = ob_get_contents(); //+++++++++++++++++++++++++++++++++++++++++
    ob_end_clean();
    return $ob_content;
}


// Create shortcode for this page.
// The 1st argument is the name of the shortcode, meaning that it will be used as "[<NAME>]" on a WP page.
// The 2nd argument is the name of the PHP function above, which will be used to insert text into the webpage.
add_shortcode('ea_email_form', 'ea_email_form_shortcode');
