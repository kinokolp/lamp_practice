<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  
  <title>商品一覧</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'index.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  

  <div class="container">
    <h1>商品一覧</h1>
    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <div>
      <h2>並べ替え</h2>
      <div style="display:flex">
        <div style="margin-left:auto">
          <form method="get">
            <select name="sorting">
              <?php foreach(ITEM_SORTING as $sort_key => $sort_value) {?>
                <option value="<?php print $sort_key; ?>" <?php if($sorting === $sort_key) { print "selected"; } ?>><?php print $sort_value; ?></option>
              <?php } ?>
            </select>
            <input type="submit" value="並べ替え">
          </form>
        </div>
      </div>
    </div>

    <div>
      <div>
        <span><?php print $item_count['COUNT(*)']; ?>件中 <?php print $item_count_view[0] . " - " . $item_count_view[1] . "件目の商品";?></span>
      </div>
      <?php if ($now_page > 1) { ?>
        <a href="<?php print HOME_URL . "?page_id=" . ($now_page-1); ?>">前へ</a>
      <?php } ?>
      <?php for($i = 1; $i <= $page_max; $i++) { ?>
        <?php if($i === $now_page) { ?>
          <span><?php print $i; ?></span>
        <?php } else { ?>
          <a href="<?php print HOME_URL . "?page_id=" . $i; ?>"><?php print $i; ?></a>
        <?php } ?>
      <?php } ?>
      <?php if ($now_page < $page_max) { ?>
        <a href="<?php print HOME_URL . "?page_id=" . ($now_page+1); ?>">次へ</a>
      <?php } ?>
    </div>

    <div class="card-deck">
      <div class="row">
      <?php foreach($items as $item){ ?>
        <div class="col-6 item">
          <div class="card h-100 text-center">
            <div class="card-header">
              <?php print(h($item['name'])); ?>
            </div>
            <figure class="card-body">
              <img class="card-img" src="<?php print(IMAGE_PATH . h($item['image'])); ?>">
              <figcaption>
                <?php print(number_format(h($item['price']))); ?>円
                <?php if($item['stock'] > 0){ ?>
                  <form action="index_add_cart.php" method="post">
                    <input type="submit" value="カートに追加" class="btn btn-primary btn-block">
                    <input type="hidden" name="item_id" value="<?php print(h($item['item_id'])); ?>">
                    <input type="hidden" name="token" value="<?php print $token; ?>">
                  </form>
                <?php } else { ?>
                  <p class="text-danger">現在売り切れです。</p>
                <?php } ?>
              </figcaption>
            </figure>
          </div>
        </div>
      <?php } ?>
      </div>
    </div>
    <br>
    <div>
      <h2>人気商品ランキング</h2>
      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th>順位</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>累積販売数</th>
          </tr>
        </thead>
        <tbody>
          <? $i = 1; ?>
        <?php foreach($rankings as $ranking) { ?>
          <tr>
            <td><?php print $i; ?>位</td>
            <td><img class="item-img" src="<?php print(IMAGE_PATH . h($ranking['image'])); ?>"></td>
            <td><?php print(h($ranking['name'])); ?></td>
            <td><?php print(number_format(h($ranking['price']))); ?>円</td>
            <td><?php print(h($ranking['sum(orders.amount)'])); ?>個</td>
          </tr>
          <?php $i++; ?>
        <?php } ?>
        </tbody>
    </div>
  </div>
  
</body>
</html>