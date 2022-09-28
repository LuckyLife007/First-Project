<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="home.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="lljquery.js"></script>
    <title>Product List | LuckyLife Test</title>
    <?php
    require '../DBFiles/db_display.php';
    ?>
  </head>

  <body>
    
    <div class="navbar">
      <h1>Product List</h1>
      <form id="deleteform" action="/DBFiles/db_delete.php" method="post"></form>
      <button type="button" name="add" class="addbtn">ADD</button>
      <button type="submit" form="deleteform" id="delete-product-btn" name="massdelete">MASS DELETE</button>
    </div>

    <hr>

    <div class="productlist">
    <?php
      $x=1; 
      foreach ($products as $product):
    ?>
      <div class="product">
        <!-- <div class="product-properties"> -->
          <input type="checkbox" class="delete-checkbox" form="deleteform" name="<?php echo "product$x"; $x++; ?>" value="<?php echo $product->sku; ?>">
          <div class="sku">SKU: <?php echo $product->sku; ?></div><br>
          <div class="name">Name: <?php echo $product->name; ?></div><br>
          <div class="price">Price: <?php echo $product->price; ?> USD</div><br>
          <div class="attribute"><?php echo $product->description; ?></div>
        <!-- </div> -->
      </div>
    <?php endforeach ?>
    </div>

  <hr>

<footer>
<div>Scandiweb Test Website for Junior Web Developer by Lucky Uche</div>
</footer>

  </body>
</html>
