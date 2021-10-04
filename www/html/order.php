<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'order.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

$token = get_post('token');
if (is_valid_csrf_token($token) !== TRUE) {
  set_error("不正な操作が行われました。");
  redirect_to(HISTORY_URL);
}

$order_id = get_post('order_id');
$orders = get_orders($db, $order_id);

include_once VIEW_PATH . 'order_view.php';