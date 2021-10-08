<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function get_histories($db, $user_id, $type) {
    $sql = "
    SELECT
        order_id,
        user_id,
        sum,
        created
    FROM
        histories
    ";

    if ($type === USER_TYPE_ADMIN) {
        $sql .= "ORDER BY created DESC";
        return fetch_all_query($db, $sql, []);
    } else {
        $sql .= "WHERE user_id = ?
                 ORDER BY created DESC";
        return fetch_all_query($db, $sql, [$user_id]);
    }
}
?>