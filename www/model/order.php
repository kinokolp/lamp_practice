<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function get_orders($db, $order_id, $user_id = null) {
    $params = [$order_id];

    $sql = "
    SELECT
        orders.order_id,
        orders.item_id,
        orders.amount,
        orders.price,
        histories.user_id,
        histories.sum,
        histories.created,
        items.name
    FROM
        orders
    LEFT OUTER JOIN
        histories
    ON
        orders.order_id = histories.order_id
        LEFT OUTER JOIN
            items
        ON
            orders.item_id = items.item_id
    WHERE
        orders.order_id = ?
    ";

    if ($user_id !== null) {
        $sql .= "AND user_id = ?";
        $params[] = $user_id;
    }

    return fetch_all_query($db, $sql, $params);
}
?>