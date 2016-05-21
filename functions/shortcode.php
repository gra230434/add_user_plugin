<?php
/**
 * For: Add Shortcode For Login
 * Description: add shortcode for login
 * Author: Kevin Wei
 * Version: 0.1
 */
// [kevinuser type=login]
// type = login, singup, register
  function recent_posts_function($atts){
    $kevin_user_value = shortcode_atts( array(
        'type' => 'login',
    ), $atts );

    if ($kevin_user_value['type']=='login') {
      # 登入頁面
      $return_string = '<p>登入</p>';
    }
    elseif ($kevin_user_value['type']=='singup') {
      # 申請登入
      $return_string = '<p>申請</p>';
    }
    elseif ($kevin_user_value['type']=='register') {
      # 帳號驗證
      $return_string = '<p>認證</p>';
    }
    else {
      # 無法辨識
      $return_string = '<p>請輸入我看得懂得語言</p>';
    }

    wp_reset_query();
    return $return_string;
  }
//建立一個短代碼
  function register_shortcodes(){
    add_shortcode('kevinuser', 'recent_posts_function');
  }
//新增至佈景主題中
  add_action('init', 'register_shortcodes');/*文章頁面*/

?>
