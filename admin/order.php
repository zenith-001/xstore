<?php
include "db.php";

if (isset($_GET["id"])) {
  $sql = "SELECT * FROM `orders_list` where `ID`='" . $_GET["id"] . "'";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    echo "<script>console.log('Loadedd Successfuly')</script>";
  }
  $row = mysqli_fetch_assoc($result);
  $id = $row["ID"];
  $name = $row["Name"];
  $email = $row["Email"];
  $phone = $row["Phone"];
  $date = $row["Date"];
  $status = $row["Status"];
  $cost = $row["Cost"];
  $order = $row["Products"];
  $order = json_decode(str_replace("'",'"',$order),true);
  if (isset($_POST["status_update"])) {
    $stat = $_POST["status_update"];
    $sql = "UPDATE `orders_list` SET `Status` = '".$stat."' WHERE `orders_list`.`ID` = ".$id.";";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      echo "<script>alert('Update Successful')</script>";
      header("location:order.php?id=$id");
    } else {
      echo "<script>alert('Error Occured')</script>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css" />
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css" />
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css" />
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css" />
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css" />
  <link rel="stylesheet" href="../CSS/order.css">
  <title>Order</title>
</head>

<body>
  <h2 class="back" onclick="location.href ='manage_orders.php'"><i class="fa fa-arrow-left"></i> Go Back</h2>

  <div class="details">
    <h1>Order Details</h1><br>
    <h2><i class="fa-duotone fa-address-card"></i>&nbsp;Order ID : <?php echo $id; ?></h2>
    <h2><i class="fa-duotone fa-user"></i>&nbsp;Client Name : <?php echo $name; ?></h2>
    <h2><i class="fa-duotone fa-at"></i>&nbsp;Client Email : <?php echo $email; ?></h2>
    <h2><i class="fa-duotone fa-phone"></i>&nbsp;Client Phone : <?php echo $phone; ?></h2>
    <h2><i class="fa-duotone fa-shopping-cart"></i>&nbsp;Ordered Items:
      <br>
      <?php
      foreach ($order as $value) {
        $val_name = urldecode(mysqli_fetch_assoc(mysqli_query($conn,"SELECT `Name` from `products_list` where `ID`='".$value["id"]."'"))["Name"]);
        $val_cost = (float)urldecode(mysqli_fetch_assoc(mysqli_query($conn,"SELECT `Cost` from `products_list` where `ID`='".$value["id"]."'"))["Cost"])*(float)$value["quantity"];
        echo "<h4 onclick='location.href=`../products.php?id=".$value["id"]."`;'>".$val_name. "&nbsp;&nbsp;(".$value["quantity"].")&nbsp;-&nbsp;Rs. ".$val_cost."</h4>";
      }
      ?>
    </h2>
    <h2><i class="fa-duotone fa-dollar"></i>&nbsp;Order Cost : Rs. <?php echo $cost; ?></h2>
    <h2><i class="fa-duotone fa-calendar"></i>&nbsp;Ordered Date : <?php echo $date; ?></h2>
    <h2><i class="fa-duotone fa-arrow-progress"></i>&nbsp;Status : <?php echo $status; ?></h2>
    <br>
    <h3>Update Status:</h3>
    <form method="post" action="order.php?id=<?php echo $id;?>">
    <select name="status_update" id="">
      <option value="pending">Pending</option>
      <option value="processing">Processing</option>
      <option value="success">Success</option>
    </select>
    <button type="submit" class="update">Update Status</button>
    </form>
  </div>
</body>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</html>