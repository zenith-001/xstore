<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-thin.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-solid.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-regular.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="../CSS/home.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-light.css" />
    <title>Document</title>
</head>
<?php
include "db.php";
$order_requests = mysqli_query($conn, "SELECT * FROM `orders_list` where `Status` = 'pending'");
$order_requests = mysqli_num_rows($order_requests);
$processing_orders = mysqli_query($conn, "SELECT * FROM `orders_list` where `Status` = 'processing'");
$processing_orders = mysqli_num_rows($processing_orders);
$products_list = mysqli_query($conn, "SELECT * FROM `products_list`");
$products_list = mysqli_num_rows($products_list);
$contact_datas = mysqli_query($conn, "SELECT * FROM `contact_datas`");
$contact_datas = mysqli_num_rows($contact_datas);
$manage_trending = mysqli_query($conn, "SELECT * FROM `products_list` where `Trending` = 'true'");
$manage_trending = mysqli_num_rows($manage_trending);
?>

<body>
    <div class="top">
        <h1>Overview :</h1>
        <div class="right"><i class="fa fa-bell"></i></div>
    </div>
    <div class="main">
        <div onclick="location.href='manage_orders.php';" class="card">
            <h2><i class="fa-duotone fa-bag-shopping"></i>Pending Orders :</h2>
            <h3><?php echo $order_requests; ?></h3>
        </div>
        <div class="card" onclick="location.href='manage_orders.php'">
            <h2><i class="fa-duotone fa-dollar"></i> Processing Orders :</h2>
            <h3><?php echo $processing_orders; ?></h3>
        </div>
        <div onclick="location.href='manage_products.php';" class="card">
            <h2><i class="fa fa-screwdriver-wrench"></i> Total Products :</h2>
            <h3><?php echo $products_list; ?></h3>
        </div>
        <div onclick="location.href='contact_datas.php';" class="card">
            <h2><i class="fa-duotone fa-messages"></i> Form Messages :</h2>
            <h3><?php echo $contact_datas; ?></h3>
        </div>
        <div onclick="location.href='manage_trending.php';" class="card">
            <h2><i class="fa-duotone fa-fire"></i> Trending Products:</h2>
            <h3><?php echo $manage_trending; ?></h3>
        </div>
        <br><br>
    </div>
</body>

</html>