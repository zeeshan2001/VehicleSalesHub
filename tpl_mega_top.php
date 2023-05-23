<?php
// begin Recordset
$query_year_plate = "SELECT * FROM a_ukcd_globals";
$year_plate = $ukcd->SelectLimit($query_year_plate) or die($ukcd->ErrorMsg());
$totalRows_year_plate = $year_plate->RecordCount();
// end Recordset

// begin Recordset
$query_news = "SELECT news_h1, news_slug, news_teaser_text, news_image_path, news_image FROM a_ukcd_news ORDER BY news_pub_date DESC";
$news = $ukcd->SelectLimit($query_news, 5, -1) or die($ukcd->ErrorMsg());
// end Recordset

// begin Recordset
$query_jargon = "SELECT jargon_h1, jargon_slug, jargon_image_path, jargon_image FROM a_ukcd_jargon ORDER BY jargon_pub_date DESC";
$jargon = $ukcd->SelectLimit($query_jargon, 5, -1) or die($ukcd->ErrorMsg());
// end Recordset

// begin Recordset
$query_car_manufacturers = "SELECT manufacturers.name, a_ukcd_manufacturers.make_seo FROM manufacturers LEFT JOIN a_ukcd_manufacturers ON manufacturers.id = a_ukcd_manufacturers.make_ids_id WHERE a_ukcd_manufacturers.make_enabled = 1 ORDER BY a_ukcd_manufacturers.make_order ASC";
$car_manufacturers = $ukcd->SelectLimit($query_car_manufacturers, 10, -1) or die($ukcd->ErrorMsg());
$car_manufacturers2 = $ukcd->SelectLimit($query_car_manufacturers, 10, 10) or die($ukcd->ErrorMsg());
// end Recordset

// begin Recordset
$query_van_manufacturers = "SELECT manufacturers.name, a_ukcd_manufacturers_vans.vanmake_seo, a_ukcd_manufacturers_vans.vanmake_order, a_ukcd_manufacturers_vans.vanmake_enabled FROM manufacturers LEFT JOIN a_ukcd_manufacturers_vans ON manufacturers.id = a_ukcd_manufacturers_vans.vanmake_ids_id WHERE a_ukcd_manufacturers_vans.vanmake_enabled = 1 ORDER BY a_ukcd_manufacturers_vans.vanmake_order ASC";
$van_manufacturers = $ukcd->SelectLimit($query_van_manufacturers, 10, -1) or die($ukcd->ErrorMsg());
$totalRows_van_manufacturers = $van_manufacturers->RecordCount();
// end Recordset

// begin Recordset
$query_pages = "SELECT page_slug, page_link_text, page_cat_top_about, page_cat_footer_about, page_cat_footer_terms FROM a_ukcd_pages ORDER BY page_link_text ASC";
$pages = $ukcd->Execute($query_pages) or die($ukcd->ErrorMsg());
// end Recordset

?>
