<?php
// for sing_up

if (isset($_POST['submiited'])){
  $user_id   = $_POST['name'];
  $user_pass = $_POST['address'];
  $user_fname = $_POST['firstname'];
  $user_lname = $_POST['lasttname'];
  $user_email = $_POST['email'];
  $user_summary = $_POST['summary'];
  $user_url = $_POST['url'];
}

/*
 *
 * user_id    個人ID *
 * user_name  個人帳號 *
 * user_pass  個人密碼 做 MD5 加密 *
 * user_ftname 性 *
 * user_ltname 名 *
 * user_email 個人信箱 *
 * user_summary 個人簡歷 data type 最高255個英文字 default:''
 * user_url 這人網站 default:''
 * user_Date_Created 帳號創立時間 default:''
 *
 */

$userargs = array(
  'user_id'           => $user_id,
  'user_pass'         => $user_pass,
  'user_fname'        => $user_fname,
  'user_ltname'       => $user_ltname,
  'user_email'        => $user_email,
  'user_summary'      => $user_summary,
  'user_url'          => $user_url,
  'user_Date_Created' => $user_Date_Created,);

global $wpdb;
$wpdb->insert('hotel',$userargs);


 ?>
