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

$sorting = get_sorting();
$sort_order = get_sort_order($sorting);
$items = get_open_items($db, $sort_order[0], $sort_order[1]);
//$items = sort_items($items, $sort_order[0], $sort_order[1]);
set_session('SORTING', $sorting);

$rankings = get_rankings($db);

include_once VIEW_PATH . 'index_view.php';