<?php
// Array definitions
	$tNG_login_config = array();
	$tNG_login_config_session = array();
	$tNG_login_config_redirect_success  = array();
	$tNG_login_config_redirect_failed  = array();
	$tNG_login_config_redirect_success = array();
	$tNG_login_config_redirect_failed = array();

// Start Variable definitions
	//$tNG_debug_mode = "DEVELOPMENT";
	$tNG_debug_mode = "PRODUCTION";
	$tNG_debug_log_type = "";
	$tNG_debug_email_to = "admin@ukcardiscount.uk";
	$tNG_debug_email_subject = "[BUG] The site went down";
	$tNG_debug_email_from = "dev@ukcardiscount.uk";
	$tNG_email_host = "";
	$tNG_email_user = "";
	$tNG_email_port = "25";
	$tNG_email_password = "";
	$tNG_email_defaultFrom = "admin@ukcardiscount.uk";
	$tNG_login_config["connection"] = "ukcd";
	$tNG_login_config["table"] = "a_ukcd_admin_users";
	$tNG_login_config["pk_field"] = "user_id";
	$tNG_login_config["pk_type"] = "NUMERIC_TYPE";
	$tNG_login_config["email_field"] = "user_email";
	$tNG_login_config["user_field"] = "user_email";
	$tNG_login_config["password_field"] = "user_password";
	$tNG_login_config["level_field"] = "user_level";
	$tNG_login_config["level_type"] = "NUMERIC_TYPE";
	$tNG_login_config["randomkey_field"] = "user_key";
	$tNG_login_config["activation_field"] = "user_active";
	$tNG_login_config["password_encrypt"] = "true";
	$tNG_login_config["autologin_expires"] = "1";
	$tNG_login_config["redirect_failed"] = "fail.php";
	$tNG_login_config["redirect_success"] = "welcome.php";
	$tNG_login_config["login_page"] = "index.php";
	$tNG_login_config["max_tries"] = "10";
	$tNG_login_config["max_tries_field"] = "user_attempts";
	$tNG_login_config["max_tries_disableinterval"] = "10";
	$tNG_login_config["max_tries_disabledate_field"] = "user_disable";
	$tNG_login_config["registration_date_field"] = "";
	$tNG_login_config["expiration_interval_field"] = "";
	$tNG_login_config["expiration_interval_default"] = "";
	$tNG_login_config["logger_pk"] = "login_stats_id";
	$tNG_login_config["logger_table"] = "a_login_stats";
	$tNG_login_config["logger_user_id"] = "login_stats_user";
	$tNG_login_config["logger_ip"] = "login_stats_ip";
	$tNG_login_config["logger_datein"] = "login_stats_last_login";
	$tNG_login_config["logger_datelastactivity"] = "login_stats_last_activity";
	$tNG_login_config["logger_session"] = "login_stats_session";
	$tNG_login_config_session["kt_login_id"] = "user_id";
	$tNG_login_config_session["kt_login_user"] = "user_email";
	$tNG_login_config_session["kt_login_level"] = "Username/Password/Level";
	$tNG_login_config_redirect_success["0"] = "welcome.php";
	$tNG_login_config_redirect_failed["0"] = "fail.php";
	$tNG_login_config_redirect_success["1"] = "welcome.php";
	$tNG_login_config_redirect_failed["1"] = "fail.php";
	$tNG_login_config_session["kt_user_company_id"] = "user_company_id";
	$tNG_login_config_session["kt_user_firstname"] = "user_firstname";
	$tNG_login_config_session["kt_user_surname"] = "user_surname";
	$tNG_login_config_session["kt_user_phone"] = "user_phone";
	$tNG_login_config_session["kt_user_permissions_dashboards"] = "user_permissions_dashboards";
	$tNG_login_config_session["kt_user_permissions_crm"] = "user_permissions_crm";
	$tNG_login_config_session["kt_user_permissions_cms"] = "user_permissions_cms";
	$tNG_login_config_session["kt_user_permissions_vehicles"] = "user_permissions_vehicles";
	$tNG_login_config_session["kt_user_permissions_users"] = "user_permissions_users";
	$tNG_login_config_session["kt_user_permissions_settings"] = "user_permissions_settings";
	$tNG_login_config_session["kt_user_permissions_logs"] = "user_permissions_logs";
	$tNG_login_config_session["kt_user_permissions_profile"] = "user_permissions_profile";
	$tNG_login_config_session["lcUser"] = "user_firstname";
// End Variable definitions
?>
