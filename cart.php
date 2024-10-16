<?php
$z=[];
include "admin/db.php";
    if (!isset($_POST["cart"])) {

        echo "
        <form method='POST' id='former'>
        <input id='submitter' name='cart'>
        </form>
        <script>
            document.querySelector('#submitter').value = encodeURI(JSON.stringify(localStorage.getItem('cart')));
            document.querySelector('#former').submit();
        </script>
        ";
    }
    else{
        $z=json_decode(json_decode(urldecode($_POST["cart"])),true);
        // print_r($z);
        if (count($z)>0) {
            
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
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - xStore</title>
    <link rel="stylesheet" href="CSS/shop_responsive.css" />
    <link rel="stylesheet" href="CSS/shop_style.css" />
    <style>
         body {
            font-family: poppins;
            background-color: #18141c; /* Dark background */
            color: #ffffff; /* Light text color */
            margin: 0;
            padding: 0;
        }
        .remove{
            background:#dd5555;
            cursor:pointer;
            color:white;
            padding:5px;
            font-size:15px;
            border:1px solid #fff;
            border-radius:5px;
            text-align:center;
            position:absolute;
            bottom:10%;
            right:10%;
            }
        .remove:hover{
            background: #cc3333;
        }
        .container{
            background: #232338;
            height:fit-content;
            width: 90vw;
            position:absolute;
            padding:12px;
            border-radius:18px;
            top:14%;
            left:50%;
            /* display:flex; */
            transform:translate(-50%,0%);
        }
        .page-title{
            margin-left:3%;
            margin-top:7px;
        }
        #items{
            display:inline-block;
        }
        .backer{
            margin-left:30px;
            cursor:pointer;
        }
        .card{
            height:100px;
            overflow:hidden;
            width: 20%;
            background: #505067;
            display:inline-block;
            /* border:2px solid white; */
            margin:5px;
            border-radius:9px;
            padding:40px;
            position:relative;
        }
        .card .card-title{
            font-weight:bolder;
            margin:-20px;
            cursor:pointer;
            font-size:21px;
        }
        .card .card-price{
            font-weight:normal;
            font-size:19px;
            margin:20px;
            margin-left:-20px;
        }.card .card-quantity{
            font-weight:normal;
            font-size:19px;
            margin:-20px;
        }
        .checkout{
            float:right;
            cursor:pointer;
            font-size:17px;
            border-radius:8px;
            border:none;
            background: #66aa66;
            color:black;
            padding:10px;
            transform:translate(0,-30px);
            border-right:1px solid green;
            border-bottom:1px solid green;
            box-shadow:6px 6px 4px #233823; 
        }
        .checkout:hover{
            box-shadow:8px 8px 2px #233823;
            transform:translate(-2px,-32px);
            scale:1.01;
        }
    </style>
</head>
<body>
        <h3 class="backer" onclick="history.go(-1)"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Go Back</h3>

    <h1 class="page-title"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Cart (<div id="items"></div>)</h1>
    <div class='container'>
<?php
include"admin/db.php";

if (count($z)>0) {
    $total = 0;
    $zz = json_encode($z);
    $zz = urlencode($zz);
    foreach ($z as $x) {
        echo "<div class='card'>";
        $c = getProductFromId((int)$x["pId"],$konn);
        echo "<p class='card-title' onclick='location.href=`product.php?pid=".$x["pId"]."`'>".urldecode($c["Name"])."</p>";
        echo "<p class='card-price'>Cost: ".((int)urldecode($c["Cost"]))*((int)urldecode($x["count"]))."</p>";
        echo "<p class='card-quantity'>Quantity: ".urldecode($x["count"])."</p>";
        echo "<button class='remove' title='Remove From Cart' onclick='removeFromCart(".urldecode($c["ID"]).");location.reload()'><i class='fa fa-trash-can'></i></button><br><br>";
        $total = $total+(((int)urldecode($c["Cost"]))*((int)urldecode($x["count"])));
        echo "</div>";
    }
    echo "<h3>Total Cost: Rs ".$total."</h3> 
    <form method='POST' action='checkout.php'>
        <input name='cart' type='hidden' value='$zz'>
        <button  type='submit' class='checkout'><i class='fa-duotone fa-shopping-bag'></i>&nbsp;&nbsp;Checkout</button>
    </form>
    ";
}
else{
    echo "Cart is empty go to shop and buy something.";
}
?>
    </div>
</body>
<script src="JS/carter.js"></script>
<script>if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
        </script>
</html>