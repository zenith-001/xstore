<?php
    if (isset($_POST["loginRequest"])) {
        include "admin/db.php";
        // echo $_POST["email"]."<br>";
        // echo $_POST["password"]."<br>";
        if (strstr($_POST["email"],"@")) {
            $sql = "SELECT * FROM `user_accounts` WHERE `email` = '".urlencode($_POST["email"])."' AND `password` = '".hash("sha256",$_POST["password"])."'";
        }
        else{
            $sql = "SELECT * FROM `user_accounts` WHERE `username` = '".urlencode($_POST["email"])."' AND `password` = '".hash("sha256",$_POST["password"])."'";
        }
        $arr = [];
        $result = mysqli_query($conn,$sql);
        
function fetchUserList($conn) {
  $arr = array();
  $sql = "SELECT * FROM user_accounts";
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

$konn = fetchUserList($conn);

function getUserFromId($id, $arr) {
  foreach ($arr as $y) {
      if ($y["aId"] == $id) {
          return $y;
      }
  }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - xStore</title>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css" />
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-thin.css" />
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-solid.css" />
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-regular.css" />
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-light.css" />
  <link rel="stylesheet" href="CSS/login.css">
</head>
<body>
    <form method="POST"  autocomplete="off" action="login.php">
        <input required type="hidden" name="loginRequest" value="legit">
        <div class="title">
      <img src="res/logo.png" alt="" />
xStore
        </div>
        <input required autocomplete="false" type="text" name="email" placeholder="Email or Username"><br><br>
        <input required autocomplete="false" placeholder="Password" type="password" name="password"><br><br>
        <button type="submit"><i class="fa fa-right-to-bracket"></i>&nbsp;&nbsp;Login</button>
        <!-- <p class="status n">Error password does not match</p> -->
         <?php
    if (isset($_POST["loginRequest"])) {

                 if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      $arr[] = $row;
                      echo "<p class='status p'>Successfuly Logged In! Redirecting...</p>";
                      session_start();
                      $_SESSION["uId"]=$arr[0]["aId"];
                      $user_array = getUserFromId($_SESSION["uId"],$konn);
                      $_SESSION["loggedin"]="true";
                      $_SESSION["name"]=$user_array["Name"];
                      $_SESSION["email"]=$user_array["Email"];
                      $_SESSION["phone"]=$user_array["Phone"];
                      $_SESSION["username"]=$_POST["username"];
                      $_SESSION["cart"] =$_POST["cart"];
                      header("location: shop.php");
                    }
                  } else {
                    echo "<p class='status n'>Username and Password Combination Does Not Match</p>";
                  }
                }
         ?>
    </form>
</body>
</html>