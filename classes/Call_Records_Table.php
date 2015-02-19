<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// Admin table==================================================================
// for call records, not needed for users (?)
// http://www.smashingmagazine.com/2011/11/03/native-admin-tables-wordpress/
// TODO: copy WP_List_Table into our source dependencies/ directory

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
            DatabaseAttributes::id => __('ID'),
            DatabaseAttributes::date_and_time => __('Time and date'),
            DatabaseAttributes::recommended_donation => __('Recommended donation'),
            DatabaseAttributes::actual_donation => __('Actual donation'),
            DatabaseAttributes::call_length => __('Call length'),
            DatabaseAttributes::database_token => __('Database token'),
            DatabaseAttributes::caller_id => __('Caller ID'),
            DatabaseAttributes::empathizer_id => __('Empathizer ID')
        );
        return $rColumns;
    }

    //Important: The names of these function must be matched agains the
    // db attributes (and prepended by "column_"), the same is true for the
    // content as well
    function column_id($iItem){
        return $iItem->id;
    }
    function column_date_and_time($iItem){
        $tDateTimeSg = new DateTime($iItem->date_and_time); //$iItem->date_and_time
        $rVal = $tDateTimeSg->format('Y-m-d H:m:i');
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
    function column_caller_id($iItem){
        $tWordpressUserCs = get_userdata($iItem->caller_id);
        $rUserNameSg = $tWordpressUserCs->user_login;
        return $rUserNameSg;
    }
    function column_empathizer_id($iItem){
        $tWordpressUserCs = get_userdata($iItem->empathizer_id);
        $rUserNameSg = $tWordpressUserCs->user_login;
        return $rUserNameSg;
    }
    
    function column_default($iItem, $iColumnName){
        return 'column_default-';
    }

    function prepare_items() {
        global $wpdb;

        $tTableName = getCallRecordTableName();
        $query = "SELECT * FROM $tTableName";

        $orderby = !empty($_GET["orderby"]) ? mysql_real_escape_string($_GET["orderby"]) : 'ASC';
        $order = !empty($_GET["order"]) ? mysql_real_escape_string($_GET["order"]) : '';
        if(!empty($orderby) & !empty($order)){
            $query .= ' ORDER BY ' . $orderby . ' ' . $order;
        }

        $tTotalNrOfItems = $wpdb->query($query);
        $tItemsPerPage = 10;
        $tCurrentPage = !empty($_GET["paged"]) ? ($_GET["paged"]) : '';
        /*
         * ^TODO: find a replacement for "mysql_real_escape_string" for filtering
         * the 2nd GET parameter (gives warnings and creates real problems as well)
         * as they do in this example:
         * http://www.smashingmagazine.com/2011/11/03/native-admin-tables-wordpress/
         */
        if(empty($tCurrentPage) || !is_numeric($tCurrentPage) || $tCurrentPage<=0){
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
