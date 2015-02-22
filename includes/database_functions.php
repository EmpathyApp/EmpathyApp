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


// Creating the db =============================================================

function ea_initiate_database(){

    
    global $wpdb;
    $tTableName = getCallRecordTableName();
    $tWpCollate = $wpdb->get_charset_collate();

    //Important: Please be careful when editing this, wp db is picky
    $sql = "CREATE TABLE $tTableName ("
      . DatabaseAttributes::id . " mediumint(9) NOT NULL AUTO_INCREMENT,"
      . DatabaseAttributes::date_and_time . " datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,"
      . DatabaseAttributes::recommended_donation . " integer DEFAULT '-1' NOT NULL,"
      . DatabaseAttributes::actual_donation . " integer DEFAULT '-1' NOT NULL,"
      . DatabaseAttributes::call_length . " integer DEFAULT '-1' NOT NULL,"
      . DatabaseAttributes::database_token . " varchar(31) DEFAULT '' NOT NULL,"
      . DatabaseAttributes::caller_id . " integer DEFAULT '-1' NOT NULL,"
      . DatabaseAttributes::empathizer_id . " integer DEFAULT '-1' NOT NULL,"
      . "UNIQUE KEY id (id)
    ) $tWpCollate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    
    //TODO: ***Possible bug***: when experimenting with the db i found that
    // this part of the code is entered and executed every 5 seconds!
    // Is this correct? Is it because of ajax? I used db_insert
    // Maybe has somethins to do with this:
    // https://wordpress.org/support/topic/admin-ajaxphp-being-called-from-admin-pages-causing-db-connection-issues
}
add_action('init', 'ea_initiate_database');

function db_insert($iAttributesAy){
    global $wpdb;
    $wpdb->insert(
        getCallRecordTableName(),
        $iAttributesAy
    );
}

// Updating the db =============================================================
// http://codex.wordpress.org/Class_Reference/wpdb#UPDATE_rows
// TODO: adding stripslashes
// TODO: check the return with false === $result
function db_write_actual_donation($iDbToken, $iActualDonationNr){
    global $wpdb;
    //TODO: If we do not have a token that is 100% unique we could verify that
    //the token is unique here or just update the latest of the rows that
    //we get after using the where clause
    $tResult = $wpdb->update(
        getCallRecordTableName(),
        array(DatabaseAttributes::actual_donation => (int)$iActualDonationNr),
        array(DatabaseAttributes::database_token => $iDbToken),
        "%d",
        "%s"
    );
    if($tResult === false){
        echo "ERROR: update failed";
    }
}

// Admin menu
function ea_callrecords_menu_init() { 
    add_menu_page('Call Records', 'Call Records', 'activate_plugins',
            'ea_callrecord_slug', 'ea_callrecords_menu_render',
            getSmallLogoUri(), 4);
    // plugins_url("../images/logo_bwa_16x16.png", __FILE__)
    
}
add_action( 'admin_menu', 'ea_callrecords_menu_init' );
// using admin_init will give permission error (even for admin), see
// http://wordpress.stackexchange.com/questions/168589/admin-doesnt-have-sufficient-permissions-to-plugins-page

function ea_callrecords_menu_render() {
    $wp_list_table = new Call_Records_Table(); //<---------------
    $wp_list_table->prepare_items();

    $wp_list_table->display();
}

function getCallRecordTableName(){
    global $wpdb;
    $rTableName = $wpdb->prefix . "callrecords";
    return $rTableName;
}

function getItemsArrayForToken($iDbToken){
    //Searching the entire db for a matching db token

    global $wpdb;

    $tTableName = getCallRecordTableName();
    $tDbTokenColNameSg = DatabaseAttributes::database_token;
    $tActualDonationSg = DatabaseAttributes::actual_donation;
    $tQuerySg = "SELECT {$tActualDonationSg} FROM {$tTableName} WHERE {$tDbTokenColNameSg}='{$iDbToken}'";

    //exec query and get the number of matches
    $rItemsMix = $wpdb->get_results($tQuerySg, ARRAY_N);

    return $rItemsMix;
}
