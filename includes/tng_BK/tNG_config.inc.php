<?php
// Array definitions
  $tNG_login_config = array();
  $tNG_login_config_session = array();
  $tNG_login_config_redirect_success  = array();
  $tNG_login_config_redirect_failed  = array();
  $tNG_login_config_redirect_success = array();
  $tNG_login_config_redirect_failed = array();

// Start Variable definitions
  $tNG_debug_mode = "DEVELOPMENT";
  $tNG_debug_log_type = "";
  $tNG_debug_email_to = "you@yoursite.com";
  $tNG_debug_email_subject = "[BUG] The site went down";
  $tNG_debug_email_from = "webserver@yoursite.com";
  $tNG_email_host = "";
  $tNG_email_user = "";
  $tNG_email_port = "25";
  $tNG_email_password = "";
  $tNG_email_defaultFrom = "nobody@nobody.com";
  $tNG_login_config["connection"] = "ukcd";
  $tNG_login_config["table"] = "a_ukcd_client_users";
  $tNG_login_config["pk_field"] = "user_id";
  $tNG_login_config["pk_type"] = "NUMERIC_TYPE";
  $tNG_login_config["email_field"] = "user_email";
  $tNG_login_config["user_field"] = "user_email";
  $tNG_login_config["password_field"] = "user_password";
  $tNG_login_config["level_field"] = "";
  $tNG_login_config["level_type"] = "STRING_TYPE";
  $tNG_login_config["randomkey_field"] = "user_key";
  $tNG_login_config["activation_field"] = "user_active";
  $tNG_login_config["password_encrypt"] = "true";
  $tNG_login_config["autologin_expires"] = "1";
  $tNG_login_config["redirect_failed"] = "login.php";
  $tNG_login_config["redirect_success"] = "bacl.php";
  $tNG_login_config["login_page"] = "login.php";
  $tNG_login_config["max_tries"] = "10";
  $tNG_login_config["max_tries_field"] = "user_attempts";
  $tNG_login_config["max_tries_disableinterval"] = "15";
  $tNG_login_config["max_tries_disabledate_field"] = "user_disable";
  $tNG_login_config["registration_date_field"] = "";
  $tNG_login_config["expiration_interval_field"] = "";
  $tNG_login_config["expiration_interval_default"] = "";
  $tNG_login_config["logger_pk"] = "login_stats_id";
  $tNG_login_config["logger_table"] = "a_login_stats_clients";
  $tNG_login_config["logger_user_id"] = "login_stats_user";
  $tNG_login_config["logger_ip"] = "login_stats_ip";
  $tNG_login_config["logger_datein"] = "login_stats_last_login";
  $tNG_login_config["logger_datelastactivity"] = "login_stats_last_activity";
  $tNG_login_config["logger_session"] = "login_stats_session";
  $tNG_login_config_session["kt_login_id"] = "user_id";
  $tNG_login_config_session["kt_login_user"] = "user_email";
  $tNG_login_config_session["kt_user_firstname"] = "user_firstname";
  $tNG_login_config_session["kt_user_surname"] = "user_surname";
// End Variable definitions
?>