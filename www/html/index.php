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

$item_count = get_items_count($db);
$page_max = ceil($item_count['COUNT(*)'] / PAGE_LIMIT);
$now_page = get_now_page();
if ($now_page > $page_max || $now_page <= 0) {
  set_error('表示範囲外のページにアクセスしました。トップページへ戻ります。');
  redirect_to(HOME_URL);
}
$item_count_view = item_count_view($now_page, $item_count['COUNT(*)']);

$sorting = get_sorting();
$sort_order = get_sort_order($sorting);
$items = get_open_items($db, $sort_order[0], $sort_order[1], $now_page, PAGE_LIMIT);
//$items = sort_items($items, $sort_order[0], $sort_order[1]);
set_session('SORTING', $sorting);

$rankings = get_rankings($db);

include_once VIEW_PATH . 'index_view.php';