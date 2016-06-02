<?php
/**
 * Plugin Name: Add New Data Tables
 * Plugin URI: http://www.technologyofkevin.com
 * Description: add new data tables
 * Author: Kevin Wei
 * Version: 0.1
 * Author URI: http://www.technologyofkevin.com
 */

$plugin_path = plugin_dir_path( __FILE__ );

//include $plugin_path . 'functions/shortcode.php';

global $kevin_db_version;
$kevin_db_version = '1.0';

// create new ta
function user_table() {
	global $wpdb;
	global $kevin_db_version;

	$table_name = $wpdb->prefix . 'alumni';
	$charset_collate = $wpdb->get_charset_collate();
/*
 *
 * @package: Add New Data Tables
 * @author: Kevin Wei
 * @since 1.0
 *
 * user_id    個人ID *
 * user_name  個人帳號 *
 * user_pass  個人密碼 做 MD5 加密 *
 * Date_Created 帳號創建時間
 *
 */
	$sql = "CREATE TABLE $table_name (
		user_id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
		user_name CHAR(32) NOT NULL,
		user_pass CHAR(32) NOT NULL,
		Date_Created datetime DEFAULT '0000-00-00 00:00:00' NULL,
		UNIQUE KEY id (user_id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'kevin_db_version', $kevin_db_version );
}

  // create new ta
  function user_data_table() {
  	global $wpdb;
  	global $kevin_db_version;

  	$table_name = $wpdb->prefix . 'alumni_data';
  	$charset_collate = $wpdb->get_charset_collate();
  /*
   *
   * @package: Add New Data Tables
   * @author: Kevin Wei
   * @since 1.0
   *
   * // 作為兩table溝通變數
   * user_id     個人ID *
   * user_name   個人帳號 *
   * // 儲存使用者資料
   * user_ftname 性 *
   * user_ltname 名 *
   * user_email  個人信箱 *
   * user_gra    個人畢業 *
   * user_summary 個人簡歷 data type 最高255個英文字 default:''
   * user_url 這人網站 default:''
   *
   */
	 $sql = "CREATE TABLE $table_name (
		 user_id MEDIUMINT(9) NOT NULL,
		 user_name VARCHAR(30) NOT NULL,
		 user_ftname VARCHAR(30) NOT NULL,
		 user_ltname VARCHAR(30) NOT NULL,
		 user_email VARCHAR(50) NOT NULL,
		 user_gra INT(4) NOT NULL,
		 user_summary TINYTEXT DEFAULT '' NOT NULL,
		 user_url VARCHAR(55) NULL,
		 UNIQUE KEY id (user_id)
	 ) $charset_collate;";

	 require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	 dbDelta( $sql );

	 add_option( 'kevin_db_version', $kevin_db_version );
}

function defuser_user() {
	global $wpdb;

	$def_name = 'kevin';
	$def_pass = md5('000000');

	$user_table_name = $wpdb->prefix . 'alumni';
	$data_table_name = $wpdb->prefix . 'alumni_data';

	$wpdb->insert(
		$table_name, 	array(
			'user_name'   => $def_name,
			'user_pass'   => $def_pass,
			'Date_Created' => current_time( 'mysql' ),
		));

	$user_logindata = $wpdp->get_row("SELECT * FROM $user_table_name WHERE user_name= $def_name", ARRAY_A);
	$user_number = $user_logindata['user_id'];

	$def_fname   = 'Kevin';
	$def_lname   = 'Wei';
	$def_email   = 'gra230434@gmail.com';
	$user_gra    = '104';
	$def_summary = '';
	$def_url     = '';

  $wpdb->insert(
		$table_name, 	array(
    	'user_id'      => $user_number,
			'user_name'    => $def_name,
			'user_fname'   => $def_fname,
			'user_lname'   => $def_lname,
			'user_email'   => $def_email,
			'user_gra'     => $user_gra,
			'user_summary' => $def_summary,
			'user_url'     => $def_url,
		));
}

register_activation_hook( __FILE__, 'user_table' );
register_activation_hook( __FILE__, 'defuser_user' );
  //register_activation_hook( __FILE__, 'defuser_install_data' );
