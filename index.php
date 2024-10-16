<?php
include "admin/db.php";
if (isset($_POST["name"])) {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $message = $_POST["message"];
  $id = $_POST["identity"];
  $sql = "INSERT  INTO `contact_datas` (`ID`,`Name`,`Email`,`Message`) VALUES ('$id','$name','$email','$message')";
  $request = mysqli_query($conn, $sql);
  if ($request) {
    echo "<script>alert('Message Sent Successfully')</script>";
  } else {
    echo "<script>alert('Failed To Deliver The Message')</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="CSS/index.css" />
  <link rel="shortcut icon" href="res/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css" />
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-thin.css" />
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-solid.css" />
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-regular.css" />
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-light.css" />
  <title>xStore</title>
</head>

<body>
  <div class="hero seciton">
    <nav class="big">
      <div class="left item">
        <img src="res/logo.png" height="34px" alt="" class="logo" />xStore
      </div>
      <div onclick="location.href='shop.php'" class="right shop item">
        <i class="fa-duotone fa-shopping-cart"></i>&nbsp; Shop
      </div>
      <a href="#contact">
        <div class="right item">Contact</div>
      </a>
      <a href="#products">
        <div class="right item">Services</div>
      </a>
      <a href="#trending">
        <div class="right item">Trending</div>
      </a>
    </nav>
    <nav class="small">
      <div class="left item">
        <img src="res/logo.png" height="34px" alt="" class="logo" />xStore
      </div>
      <i class="fa fa-bars"></i>
    </nav>
    <div class="main-text">
      Buy the best tech <br />
      at the best price <br />
      <button onclick="location.href='shop.php'"><i class="fa-duotone fa-shopping-cart"></i> Shop Now !</button>
    </div>
    <img src="res/i1.png" alt="" class="img" />
  </div>

  <div class="section" id="products">
    <div class="section-title">Our Services</div>
    <ul class="carousel_">
      <li class="card_">
        <div class="img fa fa-laptop-medical">

        </div>

        <h2>Laptop Repair</h2>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi quis incidunt quasi iure natus dolorem dignissimos velit recusandae aliquid, exercitationem eum fuga, cum officiis, similique iusto totam praesentium. Mollitia, excepturi!
        </p>
      </li>
      <li class="card_">
        <div class="img fa-duotone fa-screwdriver-wrench">
        </div>

        <h2>Mobile Repair</h2>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi quis incidunt quasi iure natus dolorem dignissimos velit recusandae aliquid, exercitationem eum fuga, cum officiis, similique iusto totam praesentium. Mollitia, excepturi!
        </p>
      </li>
      <li class="card_">
        <div class="img fa-duotone fa-headphones-simple">
        </div>

        <h2>Sell Accessories</h2>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi quis incidunt quasi iure natus dolorem dignissimos velit recusandae aliquid, exercitationem eum fuga, cum officiis, similique iusto totam praesentium. Mollitia, excepturi!
        </p>
      </li>

    </ul>
  </div>

  <div class="section" id="trending">
    <div class="section-title">Trending</div>
    <div class="wrapper">
      <i class="fas fa-angle-left myi" id="left"></i>
      <ul class="carousel">

        <?php
        include "admin/db.php";
        $sql = "SELECT * FROM `products_list` where `Trending` ='true'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
          $files = [];
          $files = array_diff(scandir(urldecode($row["Image"])), array('.', '..'));
          echo "<li class='card'>";
          echo "<div class='img'>";
          echo "<img src='".$row["Image"]."/".$files[2]."' alt='' draggable='false' />";
          echo "</div>";
          echo "<h2>" . urldecode($row["Name"]) . "</h2>";
          echo "<p>" . urldecode($row["Manufacturer"]) . "</p>";
          echo "<p><i class='fas fa-money-bill-1-wave'></i> &nbsp;Rs. " . urldecode($row["Cost"]) . "/-</p>";
          echo "<p>";
          echo "<button onclick='addToCart(" . $row["ID"] . ",1)' class='add_cart'>";
          echo "<i class='fa fa-shopping-cart'></i>&nbsp;Add to Cart";
          echo "</button>";
          echo "</p>";
          echo "</li>";
        }
        ?>
      </ul>
      <i class="fas fa-angle-right myi" id="right"></i>
    </div>
  </div>

  <div class="section" id="contact">
    <div class="section-title">Contact</div>
    <div class="kard">
      <form method="POST" action="index.php">
        <input type="text" name="name" placeholder="Name" /><br />

        <input type="text" name="email" placeholder="Email" /><br />
        <input type="hidden" name="identity">

        <textarea name="message" id="" cols="30" rows="10" placeholder="Message"></textarea><br />
        <button class="submit" type="submit">
          <i class="fa-duotone fa-paper-plane"></i>&nbsp;Send
        </button>
      </form>
    </div>
    <div class="kard">
      <div class="kard-item">
        <i class="fa-duotone fa-envelope"></i>&nbsp;xstore@gmail.com
      </div>
      <div class="kard-item">
        <i class="fa-duotone fa-map-location-dot"></i>&nbsp;New Road,
        Kathmandu
      </div>
      <div class="kard-item">
        <i class="fa-brands fa-tiktok"></i>&nbsp;xStore1
      </div>
      <div class="kard-item">
        <i class="fa-brands fa-instagram"></i>&nbsp;xStore0
      </div>
      <div class="kard-item">
        <i class="fa-brands fa-facebook"></i>&nbsp;xStore
      </div>
      <div class="kard-item"><i class="fa fa-phone"></i>&nbsp;9869420</div>
    </div>
  </div>
  <div class="footer">&copy; Copyright xStore 2022-2024</div>
  <script src="JS/index.js"></script>
  <script>
    x = new Date()
    document.getElementsByName("identity")[0].value = Date.now();
  </script>
  <script src="JS/carter.js"></script>
</body>

</html>