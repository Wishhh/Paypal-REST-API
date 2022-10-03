<?php 
    include_once 'db_connection.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Buy Now</title>
</head>
<body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
<body class="App">
  <div class="wrapper">
    <?php 
      $results = mysqli_query($db_conn,"SELECT * FROM products where status=1");
      while($row = mysqli_fetch_array($results)){
    ?>
      <div class="col-sm-3">
          <div class="card m-3 text-center " style="width: 18rem;">
              <div class="card-body">
                  <h5 class="card-title"><?php echo $row['name']; ?></h5>
                  <p class="card-text">Price: <span> $<?php echo $row['price']; ?> </span> </p>
                  <form class="paypal" action="paypal/request.php" method="post" id="paypal_form">
                      <input type="hidden" name="item_number" value="<?php echo $row['id']; ?>" >
                      <input type="hidden" name="item_name" value="<?php echo $row['name']; ?>" >
                      <input type="hidden" name="amount" value="<?php echo $row['price']; ?>" >
                      <input type="hidden" name="currency_code" value="USD" >
                      <input type="submit" name="submit" value="Buy Now" class="btn btn-primary bor">
                  </form>
              </div>
          </div>
      </div>
    <?php } ?>
  </div>
</body>
</html>