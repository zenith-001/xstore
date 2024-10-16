<?php include("admin/db.php"); 
session_start(); // Function to fetch products list from the database 
$name_of_user=urldecode($_SESSION['name']);
echo "
<h1>Name: ".json_encode($_SESSION)."</h1>
<script>console.log(".$_SESSION['name'].")</script>
";
function fetchProductsList($conn)
{
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

// Function to search products based on name
function searchProducts($conn, $searchTerm)
{
  $arr = array();

  $sql = "SELECT * FROM `products_list` WHERE `Name` LIKE '%" . urlencode($searchTerm) . "%' OR `Description` LIKE '%" . urlencode($searchTerm) . "%' ";
  $result = mysqli_query($conn, $sql);
  echo "<script>
    console.log('" . urlencode($searchTerm). "')
  </script>";
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $arr[] = $row;
    }
  } else {
    echo "0 results";
  }


  return $arr;
  }
  
  
  // Fetch products list
  $arr = fetchProductsList($conn);
  
  // Search for products if search term is provided
  if (isset($_GET["search"])) {
  $searchTerm = $_GET['search'];
  $arr = searchProducts($conn, $searchTerm);
}

function inRange($min, $max, $val)
{
  if ($max == 0 && $min == 0) {
    return true;
  } else if ($max < $min && $max == 0) {
    if ($val > $min) {
      return true;
    } else {
      return false;
    }
  } else if ($min > $max && $max !== 0) {
    return false;
  } else {

    if ($val >= $min && $val <= $max) {
      return true;
    } else {
      return false;
    }
  }
}
$device = '';
$brand = '';
$color = '';
$min_price = '';
$min_ram = '';
$min_storage = '';
$max_price = '';
$max_ram = '';
$max_storage = '';

if (isset($_POST["filterer"])) {
  $device = strtolower($_POST["device"]);
  $brand = strtolower($_POST["brand"]);
  $color = strtolower($_POST["color"]);
  $min_price = (float)strtolower($_POST["min_price"]);
  $min_ram = (float)strtolower($_POST["min_ram"]);
  $min_storage = (float)strtolower($_POST["min_storage"]);
  $max_price = (float)strtolower($_POST["max_price"]);
  $max_ram = (float)strtolower($_POST["max_ram"]);
  $max_storage = (float)strtolower($_POST["max_storage"]);

  $unfiltered_arr = $arr;
  $arr = [];
  $filtered_arr = array();
  foreach ($unfiltered_arr as $row) {
    $ram = urldecode($row["Ram"]);
    $ram = explode("/",$ram);
    $ram = $ram[0];
    $storage = urldecode($row["Storage"]);
    $storage = (float)explode( "/",$storage)[0];
    $price  = urldecode($row["Cost"]);
    $price  = (float)$price;
    echo "<script>console.log('" .$ram. "')</script>";

    if (str_contains(strtolower(urldecode($row["Type"])), $device) && str_contains(strtolower(urldecode($row["Manufacturer"])), $brand) && str_contains(strtolower(urldecode($row["Color"])), $color)) {
      if (inRange($min_ram,$max_ram,$ram)) {
        if (inRange($min_storage,$max_storage,$storage)) {
          if (inRange($min_price,$max_price,$price)) {
            array_push($filtered_arr, $row);
          }
        }
      }
    }
    // echo "<script>console.log('" . str_contains(strtolower(urldecode($row["Type"])), $device) . "')</script>";
  }

  $arr = $filtered_arr;
}


mysqli_close($conn);
?>







<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="CSS/nav.css" />
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css" />
  <link rel="stylesheet" href="CSS/shop_responsive.css" />
  <link rel="stylesheet" href="CSS/shop_style.css" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>xStore | Shop</title>
  <link rel="shortcut icon" href="res/logo.png" type="image/x-icon" />
  <!-- <script src="JS/shop.js"></script> -->

</head>

<body>
  <div class="topnav">
    <div onclick="location.href='index.php'" class="logo">
      <img src="res/logo.png" alt="" />
      <p>xStore</p>
    </div>

    <div class="right">
      <a href="index.php" class="navItem"><i class="fa-solid fa-home"></i> &nbsp; Home</a>
      <a href="cart.php" class="navItem"><i class="fa-solid fa-cart-shopping"></i> &nbsp; Cart (<span id="items">0</span>)
      </a>
      <form method="GET" class="search">
        <input value='<?php if (isset($searchTerm)) {
                        echo $searchTerm;
                      } ?>' type="text" name="search" id="" placeholder="Search in xStore" />
        <button type="submit">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </form>
      <a onclick="user_menu()" href="#" class="navItem"><u class="fa-duotone fa-user"></u>&nbsp;&nbsp;<?php
      // session_start();
      if (isset($_SESSION['loggedin'])) {
        echo $name_of_user;
      }
      else{
        echo "Login";
      }
      ?></a>
      <div class="user_menu">
        <div class="user_menu_item account" onclick="location.href='account.php'"><i class="fa-duotone fa-user"></i>&nbsp;&nbsp;<?php echo $_SESSION["name"];?></div>
        <div class="user_menu_item order" onclick="location.href='order.php'"><i class="fa-duotone fa-arrow-progress"></i>&nbsp;&nbsp;Track Orders</div>
        <div class="user_menu_item signup" onclick="location.href='signup.php'"><i class="fa-duotone fa-user-plus"></i>&nbsp;&nbsp;Sign Up</div>
        <div class="user_menu_item login" onclick="location.href='login.php'"><i class="fa-duotone fa-right-to-bracket"></i>&nbsp;&nbsp;Login</div>
        <div class="user_menu_item logout" onclick="location.href='logout.php'"><i class="fa-duotone fa-right-from-bracket"></i>&nbsp;&nbsp;Logout</div>
      </div>
    </div>
  </div>

  <div class="filterNav">
    <div class="filterTxt">
      <i class="fa-regular fa-bars-filter"></i>
      <span>Filters</span>
      <i class="fa fa-times filtercls"></i>
    </div>
    <!-- filters start  -->
    <div class="filters">
      <form method="POST" id="filtererer" action="shop.php">
        <input type="hidden" name="filterer" value="filterer">
        <p class="selectName">Choose a device</p>
        <div class="hr"></div>
        <select name="device" class="optSelect">
          <option value="">Choose a device</option>
          <option value="laptop">Laptop</option>
          <option value="mobile">Mobile</option>
          <option value="headphone">Headphone</option>
          <option value="keyboard">Keyboard</option>
          <option value="mouse">Mouse</option>
          <option value="microphone">Microphone</option>
        </select>


        <p class="selectName">Brands :</p>
        <div class="hr"></div>
        <select name="brand" class="optSelect">
          <option value="">Choose a brand</option>
          <option value="apple">Apple</option>
          <option value="banana">Banana</option>
          <option value="pubg">PUBG</option>
          <option value="idk">IDK</option>
        </select>



        <p class="selectName">Color</p>
        <div class="hr"></div>
        <select name="color" class="optSelect">
          <option value="">Chose a color</option>
          <option value="black">Black</option>
          <option value="white">White</option>
          <option value="silver">Silver</option>
          <option value="matt">Matt</option>
        </select>

        <p class="selectName">Price</p>
        <div class="hr"></div>
        <div class="priceDiv">
          <input type="number" name="min_price" id="" placeholder="Min" />
          <p class="dash">-</p>
          <input type="number" name="max_price" id="" placeholder="Max" />
          <!-- <button>Apply</button> -->
        </div>


        <p class="selectName">RAM</p>
        <div class="hr"></div>
        <div class="priceDiv">
          <input type="number" name="min_ram" id="" placeholder="Min" />
          <p class="dash">-</p>
          <input type="number" name="max_ram" id="" placeholder="Max" />
          <!-- <button>Apply</button> -->
        </div>

        <p class="selectName">Storage</p>
        <div class="hr"></div>
        <div class="priceDiv">
          <input type="number" name="min_storage" id="" placeholder="Min" />
          <p class="dash">-</p>
          <input type="number" name="max_storage" id="" placeholder="Max" />
        </div>
    </div>
    <div class="applier">
      <button class="reset" type="reset" onclick="location.reload()"><i class="fa-duotone fa-rotate-right"></i> Reset</button>
      <button class="apply" type="submit"><i class="fa fa-check"></i> Apply</button>
    </div>

    </form>
  </div>

  <div class="lower">
    <center>
      <ul class="userOpt">
        <li class="opt"> <i class="fa-solid fa-bars-filter"></i>
          Filters :</li>
        <?php
        if (isset($_POST['device'])) {
          if ($device !== "") {
            echo "<li class='opt'>$device&nbsp;&nbsp;&nbsp;&nbsp; <i onclick='removeFilter(`device`)' class='fa fa-times'></i></li>";
          }
          if ($brand !== "") {
            echo "<li class='opt'>$brand&nbsp;&nbsp;&nbsp;&nbsp; <i onclick='removeFilter(`brand`)' class='fa fa-times'></i></li>";
          }
          if ($color !== "") {
            echo "<li class='opt'>$color&nbsp;&nbsp;&nbsp;&nbsp; <i onclick='removeFilter(`color`)' class='fa fa-times'></i></li>";
          }
          if ($min_ram !== $max_ram) {
            echo "<li class='opt'>RAM $min_ram - $max_ram&nbsp;&nbsp;&nbsp;&nbsp; <i onclick='removeFilter(`ram`)' class='fa fa-times'></i></li>";
          }
          if ($min_storage !== $max_storage) {
            echo "<li class='opt'>Storage $min_storage - $max_storage&nbsp;&nbsp;&nbsp;&nbsp; <i onclick='removeFilter(`storage`)' class='fa fa-times'></i></li>";
          }
          if ($min_price !== $max_price) {
            echo "<li class='opt'>Price $min_price - $max_price&nbsp;&nbsp;&nbsp;&nbsp; <i onclick='removeFilter(`price`)' class='fa fa-times'></i></li>";
          }
        }
        ?>
      </ul>
    </center>

    <div class="cardholder">
      <?php

      foreach ($arr as $x) {
        $files = array_diff(scandir(urldecode($x["Image"])), array('.', '..'));
        echo "<div class='card' onclick='location.href=`product.php?pid=".$x["ID"]."`'>";
        echo "<div class='imgholder'>";
        echo "<img src='" . $x["Image"] . "/" . $files[2] . "'/>";
        echo "</div>";
        if ($x["Rating"] !== "") {
          $number = explode(",", substr(urldecode($x["Rating"]), 1, -1))[0] / explode(",", substr(urldecode($x["Rating"]), 1, -1))[1];
          echo "<div class='rate-star fa fa-star'><span>" . ceil($number * 10) / 10 . "</span></div>";
        }
        echo "<div class='info'>";
        echo "<p class='name'>" . urldecode($x["Name"]) . "</p>";
        echo "<p class='price'>Rs. " . urldecode($x["Cost"]) . "</p>";
        echo "</div>";
        echo "<center>";
        echo "<button class='cartbtn'>";
        echo "<i class='fa-regular fa-cart-plus'></i> &nbsp; Add to cart";
        echo "</button>";
        echo "</center>";
        echo "</div>";
      }
      ?>


      <!-- insert cards here -->
    </div>
  </div>
  <!-- lower end -->
  <br /><br /><br />
  <br /><br /><br />
  <div class="bottomnav">
    <div class="alignment">
      <div class="icon">
        <p class="text">
          <i class="fa-solid fa-bars-filter"></i>&nbsp; Filters
        </p>
      </div>
      <div class="icon home">
        <img src="res/logo.png" class="logoImg" />
      </div>
      <div class="icon">
        <p class="text">
          <i class="fa-solid fa-cart-shopping"></i> (<span>0</span>)
        </p>
      </div>
    </div>
  </div>
  <div class="filterbtn">
    <i class="fa-solid fa-bars-filter"></i>
    <p class="txt">
      Filters
    </p>
  </div>

  <footer>
    Copyright ©2024 xStore Newroad, Kathmandu | All rights reserved.
  </footer>
</body>

<script>

  document.querySelector(".filterbtn").onclick = function() {
    document.querySelector(".filterNav").style.left = "0px";
  };

  document.querySelector(".filtercls").onclick = function() {
    document.querySelector(".filterNav").style.left = "-500px";
  };

  document.getElementsByName("device")[0].value = `<?php echo $device ?>`;
  document.getElementsByName("brand")[0].value = `<?php echo $brand ?>`;
  document.getElementsByName("color")[0].value = `<?php echo $color ?>`;
  document.getElementsByName("min_ram")[0].value = `<?php echo $min_ram ?>`;
  document.getElementsByName(
    "min_storage"
  )[0].value = `<?php echo $min_storage ?>`;
  document.getElementsByName("min_price")[0].value = `<?php echo $min_price ?>`;
  document.getElementsByName("max_ram")[0].value = `<?php echo $max_ram ?>`;
  document.getElementsByName(
    "max_storage"
  )[0].value = `<?php echo $max_storage ?>`;
  document.getElementsByName("max_price")[0].value = `<?php echo $max_price ?>`;

  function removeFilter(txt) {
    console.log("clicked")
    form = document.getElementById("filtererer");
    document.getElementsByName("device")[0].value = `<?php echo $device ?>`;
    document.getElementsByName("brand")[0].value = `<?php echo $brand ?>`;
    document.getElementsByName("color")[0].value = `<?php echo $color ?>`;
    document.getElementsByName("min_ram")[0].value = `<?php echo $min_ram ?>`;
    document.getElementsByName("min_storage")[0].value = `<?php echo $min_storage ?>`;
    document.getElementsByName("min_price")[0].value = `<?php echo $min_price ?>`;
    document.getElementsByName("max_ram")[0].value = `<?php echo $max_ram ?>`;
    document.getElementsByName("max_storage")[0].value = `<?php echo $max_storage ?>`;
    document.getElementsByName("max_price")[0].value = `<?php echo $max_price ?>`;
    document.getElementsByName("filterer")[0].value = `filterer`;

    if ((txt == "device")) {
      document.getElementsByName("device")[0].value = ``;
    }
    if ((txt == "brand")) {
      document.getElementsByName("brand")[0].value = ``;
    }
    if ((txt == "color")) {
      document.getElementsByName("color")[0].value = ``;
    }
    if ((txt == "ram")) {
      document.getElementsByName("min_ram")[0].value = ``;
      document.getElementsByName("max_ram")[0].value = ``;
    }
    if ((txt == "storage")) {
      document.getElementsByName("min_storage")[0].value = ``;
      document.getElementsByName("max_storage")[0].value = ``;
    }
    if ((txt == "price")) {
      document.getElementsByName("min_price")[0].value = ``;
      document.getElementsByName("max_price")[0].value = ``;
    }

    form.submit();
    // location.reload();
  }

let loggedIn = "<?php echo isset($_SESSION["loggedin"]);?>";
if (loggedIn == "1") {
  loggedIn = true;
}
else{
  loggedIn = false;
}
logout = document.querySelector(".logout");
account = document.querySelector(".account");
signup = document.querySelector(".signup");
login = document.querySelector(".login");
order = document.querySelector(".order");
console.log(loggedIn);
if (loggedIn) {
  login.style.display="none";
  signup.style.display="none";
}
else{
  account.style.display="none";
  logout.style.display="none";
  order.style.display = "none";
}

function user_menu(){
  if (document.querySelector(".user_menu").classList.contains("active")) {
    document.querySelector(".user_menu").style.animation = "fadeOut .25s linear";
setTimeout(() => {
  document.querySelector(".user_menu").classList.remove("active");
}, 250);

  }
  else{
    document.querySelector(".user_menu").style.animation = "fadeIn .25s linear";
setTimeout(() => {
  document.querySelector(".user_menu").classList.add("active");
}, 250);

  }
}
</script>
<script src="JS/carter.js"></script>
</html>