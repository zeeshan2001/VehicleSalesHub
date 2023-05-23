<?php

//Connection statement
require_once('../../Connections/ukcd.php');
@session_start();
    if(isset($_POST['request_type']) && $_POST['request_type'] == 'update_records'){
        $table = 'a_ukcd_vehicles';
        foreach($_POST['data'] as $item){
            $id = $item['veh_ids_id'];
            $ukcd->autoExecute($table, $item, 'UPDATE', "veh_ids_id=$id");
        }
        echo 1;
    }

    if(isset($_POST['request_type']) && $_POST['request_type'] == 'update_bulk_records'){
        $table = 'a_ukcd_vehicles';
        $item = $_POST['data'];
        $reqData = [];
        if(isset($item['veh_buy_disc_fixed']) && $item['veh_buy_disc_fixed'] != "") $reqData['veh_buy_disc_fixed'] = $item['veh_buy_disc_fixed'];
        if(isset($item['veh_buy_disc_options_perc']) && $item['veh_buy_disc_options_perc'] != "") $reqData['veh_buy_disc_options_perc'] = $item['veh_buy_disc_options_perc'];
        if(isset($item['veh_buy_disc_perc']) && $item['veh_buy_disc_perc'] != "") $reqData['veh_buy_disc_perc'] = $item['veh_buy_disc_perc'];
        if(isset($item['veh_enabled']) && $item['veh_enabled'] != "") $reqData['veh_enabled'] = $item['veh_enabled'];
        if(isset($item['veh_profit']) && $item['veh_profit'] != "") $reqData['veh_profit'] = $item['veh_profit'];
        if(isset($item['veh_sell_disc_fixed']) && $item['veh_sell_disc_fixed'] != "") $reqData['veh_sell_disc_fixed'] = $item['veh_sell_disc_fixed'];
        if(isset($item['veh_sell_disc_options_perc']) && $item['veh_sell_disc_options_perc'] != "") $reqData['veh_sell_disc_options_perc'] = $item['veh_sell_disc_options_perc'];
        if(isset($item['veh_sell_disc_perc']) && $item['veh_sell_disc_perc'] != "") $reqData['veh_sell_disc_perc'] = $item['veh_sell_disc_perc'];
        if(isset($item['veh_show_on_deals_page']) && $item['veh_show_on_deals_page'] != "") $reqData['veh_show_on_deals_page'] = $item['veh_show_on_deals_page'];
        if(isset($item['veh_show_on_homepage']) && $item['veh_show_on_homepage'] != "") $reqData['veh_show_on_homepage'] = $item['veh_show_on_homepage'];
        if(isset($item['veh_show_on_stock_page']) && $item['veh_show_on_stock_page'] != "") $reqData['veh_show_on_stock_page'] = $item['veh_show_on_stock_page'];
        if(isset($item['veh_supplier']) && $item['veh_supplier'] != "") $reqData['veh_supplier'] = $item['veh_supplier'];
        if(isset($item['veh_teaser_text']) && $item['veh_teaser_text'] != "") $reqData['veh_teaser_text'] = $item['veh_teaser_text'];
        if(isset($item['veh_top_left_tag']) && $item['veh_top_left_tag'] != "") $reqData['veh_top_left_tag'] = $item['veh_top_left_tag'];
        if(isset($item['veh_top_right_tag']) && $item['veh_top_right_tag'] != "") $reqData['veh_top_right_tag'] = $item['veh_top_right_tag'];
        // foreach($_POST['data'] as $item){
            // $id = $item['veh_ids_id'];
            $ukcd->autoExecute($table, $reqData, 'UPDATE', '1=1');
        // }
        echo json_encode($reqData);
    }
?>