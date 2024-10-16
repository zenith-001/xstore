<?php
$z=[];
include "admin/db.php";
    if (isset($_POST["cart"])) {
$cart = json_decode(urldecode($_POST["cart"]),true);
// print_r($cart);
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
    else{
        header("location: shop.php");
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
        .signer input{
            padding:7px;
            font-size:19px;
            background: #383859;
            margin:5px;
            border:2px solid #131328;
            /* border-bottom:1px solid #ddd; */
            /* border-right:1px solid #ddd; */
            border-radius:6px;
            /* box-shadow:inset 3px 3px 4px #131328; */
            color:white;
        }
        .signer input::-webkit-input-placeholder{
            color:#cdcdcd;
        }
        .signer button{
            padding:7px;
            font-size:19px;
            background: #383859;
            margin:5px;
            border:2px solid #131328;
            /* border-bottom:1px solid #ddd; */
            /* border-right:1px solid #ddd; */
            border-radius:6px;
            /* box-shadow:inset 3px 3px 4px #131328; */
            color:white;
        }
        .signer button:hover{
            cursor:pointer;
            box-shadow:2px 2px 3px #121228;
            transform:translate(-3px,-3px);
        }
    </style>
</head>
<body>
        <h3 class="backer" onclick="history.go(-1)"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Go Back</h3>

    <h1 class="page-title"><i class="fa-duotone fa-shopping-bag"></i>&nbsp;&nbsp;Checkout (<div id="items"></div>)</h1>
    <div class='container'>
        <?php
            echo "<h2>Products: </h2>";
            $total=0;
                foreach ($cart as $x) {
                echo "<p>".urldecode(getProductFromId($x['pId'],$konn)["Name"])."[".$x["count"]."] - ".(int)$x["count"]*(int)urldecode(getProductFromId($x['pId'],$konn)["Cost"])."</p>";
                $total+=(int)$x["count"]*(int)urldecode(getProductFromId($x['pId'],$konn)["Cost"]);
            }
            $kart = $_POST['cart'];
            echo "<p>Total Price: <b>Rs ".$total."</b></p>";
            echo "<br><hr><br>";
            echo "<h2>Sign Up :</h2>";
            echo "
            <form action='signup.php' method='POST' class='signer'>
                <input type='hidden'name='uId'class='uId' required>
                <input type='hidden'name='cart'class='cart' value='$kart' required>
                <input placeholder='Full Name'name='name'required><br>
                <input placeholder='Email Address' type='email' name='email'required><br>
                <input type='number' placeholder='Phone Number'name='phone'required><br>
                <input placeholder='Password'class='password'name='password'required><br>
                <input placeholder='Confirm Password'class='cpassword'name='cpassword'required><br>
                <button type='button' class='subbtn' onclick='console.log(`Heloo`);if(document.querySelector(`.password`).value==document.querySelector(`.cpassword`).value){console.log(`heloo from inside you`);document.querySelector(`.uId`).value = Date.now();console.log(document.querySelector(`.uId`).value);document.querySelector(`.submitter`).click();}else{}'>Create Account and Proceed</button>
                <input type='submit' class='submitter' style='display:none;'>
            </form>
            ";
        ?>
    </div>
</body>
<script src="JS/carter.js"></script>
<script>
 
    document.body.onkeydown = function(e){
        if (e.key == "Enter") {
            document.querySelector(".subbtn").click();
        }
    }
</script>
</html>