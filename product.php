<?php
include "admin/db.php";
if (isset($_GET["pid"])) {
    function fetchProductsList($conn) {
        $arr = array();
        $sql = "SELECT * FROM products_list";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $arr[] = $row;
            }
        } else {
            echo "0 results";
        }
        return $arr;
    }

    $konn = fetchProductsList($conn);

    function getProductFromId($id, $arr) {
        foreach ($arr as $y) {
            if ($y["ID"] == $id) {
                return $y;
            }
        }
    }

    $z = getProductFromId($_GET["pid"], $konn);
    if ($z!=="") {
        $ratingValues = explode(",", trim(urldecode($z["Rating"]), "{}"));
    $rating = ((int)$ratingValues[0] / (int)$ratingValues[1]);
    }
    else{
        $rating = 0;
    }
    $z["Rating"] = $rating;
} else {
    echo "<script>history.go(-1)</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/nav.css">
    <title>Product Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #18141c; /* Dark background */
            color: #ffffff; /* Light text color */
            margin: 0;
            padding: 0;
        }


        .container {
            width: 90%;
            margin: 20px auto;
            background-color: #201c2c; /* Slightly lighter container */
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Dark shadow */
        }

        .product-img {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            display: block;
        }

        .product-info {
            margin-top: 20px;
        }

        .product-title {
            font-size: 24px;
            font-weight: bold;
            color: #ffffff; /* White text */
        }

        .product-price {
            color: #ff9800; /* Orange price color */
            font-size: 28px;
            margin: 10px 0;
        }

        .original-price {
            text-decoration: line-through;
            color: grey;
            font-size: 18px;
        }

        .discount {
            color: #00c853; /* Green discount color */
            font-size: 18px;
            margin: 10px 0;
        }

        .buy-now {
            background-color: #261e4e; /* Green button */
            color: white;
            padding: 15px;
            text-align: center;
            border: none;
            cursor: pointer;
            width: 100%;
            font-family:poppins;
            font-size: 18px;
        }

        .buy-now:hover {
            background-color: #261e3f; /* Darker green on hover */
        }

        .add-to-cart {
            font-family:poppins;

            background-color: #222256; /* Orange button */
            color: white;
            padding: 15px;
            text-align: center;
            border: none;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
            margin-top: 10px;
        }

        .add-to-cart:hover {
            background-color: #3a3a56; /* Darker orange on hover */
        }

        .details {
            margin-top: 20px;
        }
        .slider-container {
            width: 40%;
            margin: 0 auto;
            overflow: hidden; /* Hide overflow */
            position: relative;
        }
        .slider {
            display: flex;
            transition: transform 0.5s ease; /* Smooth transition */
        }
        .slider img {
            width: 100%; /* Make images responsive */
            height: auto;
        }
        .prev, .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(255, 255, 255, 0.5);
            padding: 10px;
            border: none;
            cursor: pointer;
        }
        .prev {
            left: 0;
        }
        .next {
            right: 0;
        }
        .details *{
            font-family:poppins;
            margin:3px;
        }
        .product-quantity{
            display: flex;
            font-size:22px;
            margin-bottom:12px;
            font-family:poppins;
        }
        .quantity-slider{
            margin-left:32px;
            height:35px;
            width:120px;
            background: #232338;
            display: flex;
        }
        .quantity-slider input{
            width:40%;
            text-align:center;
            background: #393959;
            border:none;
            color:white;
            font-family:poppins;
        }
        .quantity-slider div{
            width:30%;
            text-align:center;
            user-select:none;
            cursor:pointer;
        }
        input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
    </style>
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css" />
  <link rel="stylesheet" href="CSS/shop_responsive.css" />
  <link rel="stylesheet" href="CSS/shop_style.css" />
</head>
<body>
<div class="topnav">
    <div onclick="location.href='index.php'" class="logo">
      <img src="res/logo.png" alt="" />
      <p>xStore</p>
    </div>

    <div class="right">
      <a href="shop.php" class="navItem"><i class="fa fa-shop"></i> &nbsp; Shop</a>
      <a href="cart.php" class="navItem"><i class="fa-solid fa-cart-shopping"></i> &nbsp; Cart  (<span id="items">0</span>)
      </a>
      
    </div>
  </div><br><br><br><br><br>
    <div class="container">
    <div class="slider-container">
        <div class="slider">
            <?php
            $directory = __DIR__ . '/' . urldecode($z["Image"]);
            if (is_dir($directory)) {
                $files = scandir($directory);
                foreach ($files as $file) {
                    if ($file != '.' && $file != '..') {
                        echo '<img src="' . urldecode($z["Image"]) . '/' . $file . '" alt="' . $file . '">';
                    }
                }
            } else {
                echo 'Directory does not exist.';
            }
            ?>
        </div>
        <button class="prev" onclick="prevSlide()">&#10094;</button>
        <button class="next" onclick="nextSlide()">&#10095;</button>
    </div>
        <div class="product-info">
            <div class="product-title"><?php echo urldecode($z["Name"]); ?></div>
            <div class="product-price">Rs. <?php echo urldecode($z["Cost"]); ?></div>
            <div class="product-quantity">Quantity: 
                <div class="quantity-slider">
                    <div class="minus">-</div>
                    <input type="number" value=1 min="1" max="6"  class="quantity-number">
                    <div class="plus">+</div>
                </div>
            </div>
            <button class="buy-now"><i class="fa fa-square-dollar"></i>&nbsp;&nbsp;Buy Now</button>
            <button class="add-to-cart"onclick="addToCart(<?php echo $_GET["pid"];?>,document.querySelector('.quantity-number').value);location.reload();"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Add to Cart</button>
        </div>
        <div class="details">
            <h2>Product Details</h2>
            <p><i class="fa-duotone fa-copyright"></i>&nbsp; Brand: <?php echo urldecode($z["Manufacturer"]); ?></p>
            <p><i class="fa-duotone fa-quote-right"></i>&nbsp;Type: <?php echo urldecode($z["Type"]); ?></p>
            <p><i class="fa-duotone fa-server"></i>&nbsp;Ram: <?php echo urldecode($z["Ram"]); ?></p>
            <p><i class="fa-duotone fa-hard-drive"></i>&nbsp;Storage: <?php echo urldecode($z["Storage"]); ?></p>
            <p><i class="fa-duotone fa-display"></i>&nbsp;Display: <?php echo urldecode($z["Display"]); ?></p>
            <p><i class="fa-duotone fa-microchip"></i>&nbsp;Processor: <?php echo urldecode($z["Processor"]); ?></p>
            <p><i class="fa-duotone fa-square-poll-vertical"></i>&nbsp;Graphics: <?php echo urldecode($z["Graphics"]); ?></p>
            <p><i class="fa-solid fa-circle"></i>&nbsp;Color: <?php echo urldecode($z["Color"]); ?></p>
            <p><i class="fa-duotone fa-shop"></i>&nbsp;Stock: <?php echo urldecode($z["Stock"]); ?></p>
            <p><i class="fa-duotone fa-handshake"></i>&nbsp;Hand: <?php echo urldecode($z["Hand"]); ?></p>
            <p><i class="fa-duotone fa-dollar"></i>&nbsp;Sold: <?php echo urldecode($z["Sold"]); ?></p>
            <p><i class="fa-duotone fa-star"></i>&nbsp;Rating: <?php echo urldecode($z["Rating"]); ?></p>
            <p><i class="fa-duotone fa-comment"></i>&nbsp;Reviews: <?php echo urldecode($z["Reviews"]); ?></p>
            <p><i class="fa-duotone fa-fire"></i>&nbsp;Trending: <?php echo urldecode($z["Trending"]); ?></p>
            <p><i class="fa-duotone fa-text"></i>&nbsp;Description: <?php echo urldecode($z["Description"]); ?></p>
        </div>
    </div>
    
</body>

<script>
    const slider = document.querySelector('.slider');
    let currentSlide = 0;

    function prevSlide() {
        if (currentSlide > 0) {
            currentSlide--;
            slider.style.transform = `translateX(-${currentSlide * 100}%)`;
        }
    }

    function nextSlide() {
        if (currentSlide < slider.children.length - 1) {
            currentSlide++;
            slider.style.transform = `translateX(-${currentSlide * 100}%)`;
        }
    }
    document.querySelector(".plus").onclick = function(){
        z = JSON.parse(document.querySelector(".quantity-number").value)
        if (z<6) {
            z=z+1
        }
        document.querySelector(".quantity-number").value = z
    }   
    document.querySelector(".minus").onclick = function(){
        z = JSON.parse(document.querySelector(".quantity-number").value)
        if (z>1) {
            z=z-1
        }
        document.querySelector(".quantity-number").value = z
    }
</script>
<script src="JS/carter.js"></script>
</html>
