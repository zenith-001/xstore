<?php
// session_start();
// if (!isset($_SESSION['active']) || $_SESSION['active'] != true) {
//   header("location:login.php");
//   exit;
// } else {
//   // echo "Username:<h1>" . $_SESSION['username'] . "</h1>";
//   // echo "Name:<h1>" . $_SESSION['name'] . "</h1>";
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css" />

  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-thin.css" />

  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-solid.css" />

  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-regular.css" />

  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-light.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../CSS/dashboard.css" />
  <title>xStore - Dashboard</title>
</head>

<body>
  <div class="left-portion">
    <div class="logo">
      <img src="../res/logo.png" alt="" height="60px" />
    </div>
    <div class="nav_">
      <div class="pointer"></div>
      <div onclick="klick(this)" class="item_ active">
        <i class="fa-duotone fa-home"></i>&nbsp;&nbsp;Home
      </div>
      <div onclick="klick(this)" class="item_">
        <i class="fa-duotone fa-bags-shopping"></i>&nbsp;&nbsp;Manage Orders
      </div>
      <div onclick="klick(this)" class="item_">
        <i class="fa-duotone fa-envelope"></i>&nbsp;&nbsp;Contact Form
      </div>
      <div onclick="klick(this)" class="item_">
        <i class="fa-duotone fa-layer-plus"></i>&nbsp;&nbsp;Add Product
      </div>
      <div onclick="klick(this)" class="item_">
        <i class="fa-duotone fa-bars-progress"></i>&nbsp;&nbsp;Manage Products
      </div>
      <div onclick="klick(this)" class="item_">
        <i class="fa-duotone fa-fire"></i>&nbsp;&nbsp;Manage Trending
      </div>
      <div onclick="klick(this)" class="item_">
        <i class="fa-duotone fa-plus"></i>&nbsp;&nbsp;Add Trending
      </div>
      <div onclick="klick(this)" class="item_">
        <i class="fa-duotone fa-left-from-bracket"></i>&nbsp;&nbsp;Logout
      </div>
    </div>
  </div>
  <div class="right-portion">
    <div class="nav">
      <div class="lab">Home</div>
      <div class="righter">
        <div class="item">
          <i title="Info" class="fa-duotone fa-circle-info"></i>
        </div>
        <div class="item item--">
          <img src="../res/logo.png" height="30px" alt="" />
          <div class="label">
            <div class="m">xStore</div>
            <div class="s">Administrator</div>
          </div>
        </div>
      </div>
    </div>
    <iframe class="iframe_" src="home.php" frameborder="0"></iframe>
  </div>
</body>

<script>
  x = 41;
  for (let i = 0; i < 10; i++) {
    x += 37;
  }

  function klick(x) {
    c = 0;
    document.querySelectorAll(".item_").forEach((z) => {
      z.classList.remove("active");
      if (z == x) {
        v = c;
      }
      c++;
    });

    if (v !== 10) {
      document.querySelector(".pointer").style.opacity = 1;
      document.querySelector(".pointer").style.top = 41 + v * 37 + "px";
      x.classList.add("active");
      document.querySelector(".lab").innerText = x.innerText;
      fram = document.querySelector(".iframe_");
      if (v == 0) {
        fram.src = "home.php";
      } else if (v == 1) {
        fram.src = "manage_orders.php";
      } else if (v == 2) {
        fram.src = "contact_datas.php";
      } else if (v == 3) {
        fram.src = "add_product.php";
      } else if (v == 4) {
        fram.src = "manage_products.php";
      } else if (v == 5) {
        fram.src = "manage_trending.php";
      } else if (v == 6) {
        fram.src = "add_trending.php";
      } else if (v == 7) {
        fram.src = "manage_members.php";
      } else if (v == 8) {
        fram.src = "upload_album.php";
      } else if (v == 9) {
        fram.src = "manage_album.php";
      } else {}
    } else {
      document.querySelector(".pointer").style.opacity = 0;
      location.href = "logout.php";
    }
  }
</script>

</html>