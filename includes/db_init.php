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
      . "UNIQUE KEY id (id)
    ) $tWpCollate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    
    
    
    
    //TODO: ***Possible bug***: when experimenting with the db i found that
    // this part of the code is entered and executed every 5 seconds!
    // Is this correct? Is it because of ajax?
    // Maybe has somethins to do with this:
    // https://wordpress.org/support/topic/admin-ajaxphp-being-called-from-admin-pages-causing-db-connection-issues
    // 
    // db_insert
    
    
    
    
    


     
}
add_action('init', 'ea_initiate_database');



function db_insert($iAttributesAy){
    global $wpdb;
    $wpdb->insert(
        getCallRecordTableName(),
        $iAttributesAy
        //array('recommendeddonation' => '21')
    );
}
//add_action('init', 'db_insert');


// Updating the db =============================================================
// http://codex.wordpress.org/Class_Reference/wpdb#UPDATE_rows
// [ ] stripslashes
// [ ] check the return with false === $result

function db_write_actual_donation($iDbToken, $iActualDonationNr){
    global $wpdb;
    echo "iDbToken = " . $iDbToken;
    echo "iActualDonationNr = " . $iActualDonationNr;
    $tResult = $wpdb->update(
        getCallRecordTableName(),
        array(DatabaseAttributes::actual_donation => (int)$iActualDonationNr),
        array(DatabaseAttributes::database_token => $iDbToken),
        "%d",
        "%s"
    );
    
    if($tResult === false){
        echo "ERROR: update failed";
    }else{
        echo "result was not false";
        echo "\ntResult = " . $tResult;
    }
}



// Admin table==================================================================
// for call records, not needed for users (?)
// http://www.smashingmagazine.com/2011/11/03/native-admin-tables-wordpress/
// [ ] copy WP_List_Table into our source dependencies/ directory


if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class Call_Records_Table extends WP_List_Table {
// overriding
    function __construct() {
        parent::__construct( array(
            'singular' => 'Call record',
            'plural' => 'Call records',
            'ajax' => false
        ) );
    }
// overriding
    function get_columns() {
        $rColumns = array(
            'id' => __('ID'),
            'time' => __('Time and date'),
            DatabaseAttributes::recommended_donation => __('Recommended donation'),
            DatabaseAttributes::actual_donation => __('Actual donation'),
            DatabaseAttributes::call_length => __('Call length'),
            DatabaseAttributes::database_token => __('Database token')
        );
        return $rColumns;
    }
/*    
        $sql = "CREATE TABLE $tTableName (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
      recommendeddonation integer DEFAULT '-1' NOT NULL,
      actualdonation integer DEFAULT '-1' NOT NULL,
      length integer DEFAULT '-1' NOT NULL,
      dbtoken varchar(255) DEFAULT '' NOT NULL,
      UNIQUE KEY id (id)
    ) $tWpCollate;";
*/      

    //Important: The names of these function must be matched agains the
    // db attributes (and prepended by "column_"), the same is true for the
    // content as well
    //PLEASE NOTE: $iItem[______] does not work!
    function column_id($iItem){
        return $iItem->id;
    }
    function column_date_and_time($iItem){
        $tDateTimeSg = new DateTime('2001-01-01'); //$iItem->date_and_time
        $rVal = $tDateTimeSg->format('Y-m-d');
        return $rVal;
    }
    function column_recommended_donation($iItem){
        return $iItem->recommended_donation;
    }
    function column_actual_donation($iItem){
        return $iItem->actual_donation;
    }
    function column_call_length($iItem){
        return $iItem->call_length;
    }
    function column_database_token($iItem){
        return $iItem->database_token;
    }
    function column_default($iItem, $iColumnName){
        return 'column_default-';
    }


    function prepare_items() {
        global $wpdb;
        global $_wp_column_headers;
        $screen = get_current_screen();

        
        
        $tTableName = getCallRecordTableName();
        $query = "SELECT * FROM $tTableName";

        $orderby = !empty($_GET["orderby"]) ? mysql_real_escape_string($_GET["orderby"]) : 'ASC';
        $order = !empty($_GET["order"]) ? mysql_real_escape_string($_GET["order"]) : '';
        if(!empty($orderby) & !empty($order)){
            $query .= ' ORDER BY ' . $orderby . ' ' . $order;
        }

        $tTotalNrOfItems = $wpdb->query($query);
        $tItemsPerPage = 10;
        $tCurrentPage = !empty($_GET["paged"]) ? mysql_real_escape_string($_GET["paged"]) : '';
        if(empty($tCurrentPage) || !is_numeric($tCurrentPage) || tCurrentPage<=0){
            $tCurrentPage = 1;
        }
        $tTotalNrOfPages = ceil($tTotalNrOfItems/$tItemsPerPage);
        if(!empty($tCurrentPage) && !empty($tItemsPerPage)){
            $tOffset = ($tCurrentPage - 1) * $tItemsPerPage;
            $query .= ' LIMIT ' . (int)$tOffset . ',' . (int)$tItemsPerPage;
        }

        $this->set_pagination_args( array(
            "total_items" => $tTotalNrOfItems,
            "total_pages" => $tTotalNrOfPages,
            "per_page" => $tItemsPerPage,
        ) );

        $columns = $this->get_columns();
        //$_wp_column_headers[$screen->id]=$columns;
        
        $this->_column_headers = array($columns, array(), array());

        $this->items = $wpdb->get_results($query);
    }
}


// Admin menu
function ea_callrecords_menu_init() { 
    //register_setting( 'pluginPage', 'ea_settings' );

    add_menu_page('Call Records', 'Call Records', 'activate_plugins',
            'ea_callrecord_slug', 'ea_callrecords_menu_render',
            plugins_url("../images/logo_bwa_16x16.png", __FILE__), 4);
    
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
