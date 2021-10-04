<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>購入明細</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'admin.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  
  <div class="container">
    <h1>購入明細</h1>
    <?php include VIEW_PATH . 'templates/messages.php'; ?>
    <p>注文番号：<?php print h($orders[0]['order_id']);?></p>
    <p>注文日時：<?php print h($orders[0]['created']);?></p>
    <p>合計金額：<?php print number_format(h($orders[0]['sum']));?>円</p>
    <?php if(count($orders) > 0){ ?>
      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th>商品名</th>
            <th>価格</th>
            <th>購入数</th>
            <th>小計</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($orders as $order){ ?>
          <tr>
            <td><?php print(h($order['name'])); ?></td>
            <td><?php print(number_format(h($order['price']))); ?>円</td>
            <td><?php print(h($order['amount'])); ?>個</td>
            <td><?php print(number_format(h($order['price'] * $order['amount']))); ?>円</td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } else { ?>
      <p>該当の注文がありません。</p>
    <?php } ?> 
  </div>
</body>
</html>