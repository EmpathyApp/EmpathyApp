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


/*******************************************************************************
 * 
 * Collection of functions for dealing with the Call Records table in the db.
 * 
 * Code for showing the Call Records in the admin interface is available in
 * /classes/Call_Records_Table.php
 * 
 ******************************************************************************/


/*
 * Creating the Call Records table.
 */
function ea_initiate_database(){
    
    global $wpdb;
    $tTableName = getCallRecordTableName();
    $tWpCollate = $wpdb->get_charset_collate();

    /*
     * Important: Please be careful when editing this, wp db is very picky with
     * whitespace, upper/lower case letters and other things
     */
    $tSqlCreateTableSg = "CREATE TABLE $tTableName ("
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
    dbDelta( $tSqlCreateTableSg );

    //TODO: ***Possible bug***: when experimenting with the db i found that
    // this part of the code is entered and executed every 5 seconds!
    // (i found this when i was using insert here for trying out the db)
    // Is this expected behavior?
    // Two possible causes that i can think of:
    // 1. nss and ajax?
    // 2. WP heartbeat https://wordpress.org/support/topic/admin-ajaxphp-being-called-from-admin-pages-causing-db-connection-issues
}
add_action('init', 'ea_initiate_database');



// TODO: Add db upgrade code



function getCallRecordTableName(){
    global $wpdb;
    $rTableNameSg = $wpdb->prefix . "callrecords";
    return $rTableNameSg;
}


// ========== Reading and writing in the Call Records table ==========

/*
 * Searching the Call Recreds for matching db tokens.
 * Only one expected match, but all matches are returned; there may be cases
 * where the token is not 100% unique (depending on how it is generated).
 */
function getItemsArrayForToken($iDbTokenSg){
    global $wpdb;

    $tTableNameSg = getCallRecordTableName();
    $tDbTokenColNameSg = DatabaseAttributes::database_token;
    $tActualDonationSg = DatabaseAttributes::actual_donation;
    $tQuerySg = "SELECT {$tActualDonationSg} FROM {$tTableNameSg} WHERE {$tDbTokenColNameSg}='{$iDbTokenSg}'";

    //exec query and get an array of matching rows
    $rItemsMix = $wpdb->get_results($tQuerySg, ARRAY_N);

    return $rItemsMix;
}

/*
 * Adding a new value to the Call Records table
 */
function db_insert($iAttributesAy){
    global $wpdb;
    $wpdb->insert(
        getCallRecordTableName(),
        $iAttributesAy
    );
}

/*
 * Updating one row in the Call Records table
 * http://codex.wordpress.org/Class_Reference/wpdb#UPDATE_rows
 * TODO: adding stripslashes
 */
function db_write_actual_donation($iDbTokenSg, $iActualDonationNr){
    global $wpdb;
    //TODO: If we do not have a token that is 100% unique we could verify that
    //the token is unique here or just update the latest of the rows that
    //we get after using the where clause
    $tResultBl = $wpdb->update(
        getCallRecordTableName(),
        array(DatabaseAttributes::actual_donation => (int)$iActualDonationNr),
        array(DatabaseAttributes::database_token => $iDbTokenSg),
        "%d",
        "%s"
    );
    if($tResultBl === false){
        echo "ERROR: update failed";
    }
}


// ========== Setting up the Call Records admin menu ==========

/*
 * Adding a menu page for the call records.
 * Important that we use the 'admin_menu' hook and not 'admin_init', using
 * admin_init will give permission error (even for admin), see
 * http://wordpress.stackexchange.com/questions/168589/admin-doesnt-have-sufficient-permissions-to-plugins-page
 */
function ea_callrecords_menu_init() { 
    add_menu_page('Call Records', 'Call Records', 'activate_plugins',
            'ea_callrecord_slug', 'ea_callrecords_menu_render',
            getSmallLogoUri(), 4);
}
add_action( 'admin_menu', 'ea_callrecords_menu_init' );

/*
 * Creating the admin menu display, using the Call_Records_Table class.
 * This function is not called directly from our code, instead it is referred
 * to from ea_callrecords_menu_init above.
 */
function ea_callrecords_menu_render() {
    $wp_list_table = new Call_Records_Table();
    $wp_list_table->prepare_items();
    $wp_list_table->display();
}


