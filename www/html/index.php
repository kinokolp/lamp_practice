<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

$token = get_csrf_token();

$items = get_open_items($db);
if (is_request_get()) {
  $sort_order = get_sort_order(get_get('sorting'));
  //$items = sort_items($items, $sort_order[0], $sort_order[1]);
  $items = get_open_items($db, $sort_order[0], $sort_order[1]);
}

$rankings = get_rankings($db);

include_once VIEW_PATH . 'index_view.php';