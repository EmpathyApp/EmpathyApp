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
 * Class for displaying data from the Call Records table to the (admin) user
 * in the administrator interface.
 * 
 * Inspired mainly by code from here:
 * https://wordpress.org/plugins/custom-list-table-example/
 * Another (less reliable) source of info is this:
 * http://www.smashingmagazine.com/2011/11/03/native-admin-tables-wordpress/
 * 
 ******************************************************************************/






/*
 * Wordpress official documentation for WP_List_Table:
 * http://codex.wordpress.org/Class_Reference/WP_List_Table
 */
class Call_Records_Table extends WP_List_Table {
    
    function __construct() {
        parent::__construct( array(
            'singular' => 'Call record',
            'plural' => 'Call records',
            'ajax' => false
        ) );
    }
    
    
    function get_columns() {
        $rColumnsAr = array(
            DatabaseAttributes::id                   => __('ID'),
            DatabaseAttributes::date_and_time        => __('Time and date (GMT)'),
            DatabaseAttributes::recommended_donation => __('Recommended donation'),
            DatabaseAttributes::actual_donation      => __('Actual donation'),
            DatabaseAttributes::call_length          => __('Call length'),
            DatabaseAttributes::database_token       => __('Database token'),
            DatabaseAttributes::caller_id            => __('Caller ID'),
            DatabaseAttributes::empathizer_id        => __('Empathizer ID')
        );
        return $rColumnsAr;
    }

    
    /*
     * Preparing data before printing out
     */
    function prepare_items() { //
        global $wpdb;

        $tTableNameSg = getCallRecordTableName();
        $tQuerySg = "SELECT * FROM $tTableNameSg";

        // Setup of ordering.
        // (At present we don't use the GET params for this, but maybe in the future)
        $tOrderBySg = !empty($_GET["orderby"]) ? esc_sql($_GET["orderby"]) : 'DESC';
        $tOrderSg = !empty($_GET["order"]) ? esc_sql($_GET["order"]) : DatabaseAttributes::id;
        if(!empty($tOrderBySg) && !empty($tOrderSg)){
            $tQuerySg .= ' ORDER BY ' . $tOrderSg . ' ' . $tOrderBySg;
        }

        $tTotalNrOfItemsNr = $wpdb->query($tQuerySg);
        $tNumberOfItemsPerPageNr = Constants::record_rows_display_max;
        $tPagedSg = '';
        if(isset($_GET["paged"])){
            $tPagedSg = $_GET["paged"];
        }
        if(empty($tPagedSg) === false){
            if(is_numeric($tPagedSg) === false){
                handleError("Page number contained non-numeric characters, possible SQL injection attempt");
            }
        }

        // Limiting the range of results returned.
        // (We don't want to display all the rows one a single page)
        // Documenation for MySQL "LIMIT":
        // http://www.w3schools.com/php/php_mysql_select_limit.asp
        if(empty($tPagedSg) || !is_numeric($tPagedSg) || $tPagedSg <= 0){
            $tPagedSg = 1;
        }
        $tTotalNrOfPagesNr = ceil($tTotalNrOfItemsNr/$tNumberOfItemsPerPageNr);
        if(!empty($tPagedSg) && !empty($tNumberOfItemsPerPageNr)){
            $tNumberOfItemsOffsetNr = ($tPagedSg - 1) * $tNumberOfItemsPerPageNr;
            $tQuerySg .= ' LIMIT ' . (int)$tNumberOfItemsPerPageNr . ' OFFSET ' . (int)$tNumberOfItemsOffsetNr;
        }
        $this->set_pagination_args( array(
            "total_items" => $tTotalNrOfItemsNr,
            "total_pages" => $tTotalNrOfPagesNr,
            "per_page" => $tNumberOfItemsPerPageNr,
        ) );

        // Updating the data available for this class; this data will later be
        // rendered for the user
        $tColumnsAr = $this->get_columns();
        $this->_column_headers = array($tColumnsAr, array(), array());
        $this->items = $wpdb->get_results($tQuerySg);
    }
    
    
    /*
     * Functions used for rendering the data.
     * Please note: The names of the "column_" functions must be matched against
     * the db attributes (and prepended by "column_"), the same is true for the
     * content as well (ex: "$iItem->call_length").
     */
    function column_id($iItemOt){
        return $iItemOt->id;
    }
    function column_date_and_time($iItemOt){
        $tDateTimeSg = new DateTime($iItemOt->date_and_time);
        $rFormattedDateAndTimeSg = $tDateTimeSg->format('Y-m-d H:i:s');
        return $rFormattedDateAndTimeSg;
    }
    function column_recommended_donation($iItemOt){
        return $iItemOt->recommended_donation;
    }
    function column_actual_donation($iItemOt){
        return $iItemOt->actual_donation;
    }
    function column_call_length($iItemOt){
        return $iItemOt->call_length;
    }
    function column_database_token($iItemOt){
        return $iItemOt->database_token;
    }
    function column_caller_id($iItemOt){
        $tWordpressUserCs = get_userdata($iItemOt->caller_id);
        $rUserNameSg = $tWordpressUserCs->user_login;
        return $rUserNameSg;
    }
    function column_empathizer_id($iItemOt){
        $tWordpressUserCs = get_userdata($iItemOt->empathizer_id);
        $rUserNameSg = $tWordpressUserCs->user_login;
        return $rUserNameSg;
    }
    function column_default($iItemOt, $iColumnNameSg){
        return 'ERROR: Column not covered';
    }

}
