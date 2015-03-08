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


function ea_skype_page_shortcode() {
    ob_start(); //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    
    $tSubscriberOrContributorOrAdminOrBl = hasCurrentUserRole(array(
        WPUserRoles::subscriber, WPUserRoles::contributor, WPUserRoles::administrator));
    if($tSubscriberOrContributorOrAdminOrBl == false){
        // ..exiting if not empathizer or admin
        echo "<strong>Oops! You need to log-in first to get access to this page</strong>";
        exit();
    }
    
    
    $ob_content = ob_get_contents(); //+++++++++++++++++++++++++++++++++++++++++
    ob_end_clean();
    return $ob_content;
}
add_shortcode('ea_skype_page', 'ea_skype_page_shortcode');
