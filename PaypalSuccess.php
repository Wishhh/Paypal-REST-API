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
    $paymentid = $_GET['payid'];
		$results = mysqli_query($db_conn,"SELECT * FROM payments where id='$paymentid' ");
		$row = mysqli_fetch_array($results);
  ?>
      <div class="alert alert-success m-2" role="alert">
          <h4 class="alert-heading">Payment Information</h4>
          <p class="mb-0">Transaction ID: <?php echo $row['transaction_id']; ?></p>
          <p class="mb-0">Paid Amount: <?php echo $row['payment_amount']; ?></p>
          <p class="mb-0">Payment Status: <?php echo $row['payment_status']; ?></p>
          <hr>
          <h4>Product Information</h4>
          <p class="mb-0">Product id: <?php echo $row['id']; ?></p>

      </div>
      <a class="page-link m-2" href="/PayPalApi" aria-label="Previous">
          <span aria-hidden="true" class="text-lg-center">&laquo;  Home</span>
          <span class="sr-only">Previous</span>
      </a>


  </div>
</body>
</html>