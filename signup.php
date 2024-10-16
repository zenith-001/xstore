<?php
include "admin/db.php";
if (isset($_POST["uId"])) {
    $_POST["username"] = explode("@",$_POST["email"])[0];
    echo "uId: ".$_POST["uId"];
    echo "<br> name: ".$_POST["name"];
    echo "<br> email: ".$_POST["email"];
    echo "<br> phone: ".$_POST["phone"];
    echo "<br> password: ".$_POST["password"];
    echo "<br> username: ".$_POST["username"];
    $sql = "INSERT INTO `user_accounts` (`aId`, `username`, `Name`, `Password`, `Email`, `Phone`) VALUES ('".urlencode($_POST['uId'])."', '".urlencode($_POST['username'])."', '".urlencode($_POST["name"])."', '".hash('sha256',$_POST["password"])."', '".urlencode($_POST['email'])."', '".urlencode($_POST["phone"])."');";
    $procress = mysqli_query($conn,$sql);
    if ($procress) {
        echo "<br>Successfully Created Your Account";
        session_start();
        $_SESSION["loggedin"]="true";
        $_SESSION["uId"]=$_POST["uId"];
        $_SESSION["name"]=$_POST["name"];
        $_SESSION["email"]=$_POST["email"];
        $_SESSION["phone"]=$_POST["phone"];
        $_SESSION["password"]=$_POST["password"];
        $_SESSION["username"]=$_POST["username"];
        $_SESSION["cart"] =$_POST["cart"];
        }
    header('location: shop.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp - xStore</title>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css" />
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-thin.css" />
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-solid.css" />
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-regular.css" />
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-light.css" />
  <link rel="stylesheet" href="CSS/login.css">
</head>
<body>
    <form action='signup.php' method='POST' class='signer'>
      <input required type="hidden" name="loginRequest" value="legit">
      <div class="title">
    <img src="res/logo.png" alt="" />
    xStore
    </div>
                <input type='hidden'name='uId'class='uId' required>
                <input type='hidden'name='cart'class='cart' value='$kart' required>
                <input placeholder='Full Name'name='name'required><br><br>
                <input placeholder='Email Address' type='email' name='email'required><br><br>
                <input type='number' placeholder='Phone Number'name='phone'required><br><br>
                <input placeholder='Password'class='password'name='password'required><br><br>
                <input placeholder='Confirm Password'class='cpassword'name='cpassword'required><br><br><br>
                <button type='button' class='subbtn' onclick='console.log(`Heloo`);if(document.querySelector(`.password`).value==document.querySelector(`.cpassword`).value){console.log(`heloo from inside you`);document.querySelector(`.uId`).value = Date.now();console.log(document.querySelector(`.uId`).value);document.querySelector(`.submitter`).click();}else{}'>Create Account and Proceed</button>
                <button type='submit' class='submitter' style='display:none;'>
            </form>
</body><script>
 
 document.body.onkeydown = function(e){
     if (e.key == "Enter") {
         document.querySelector(".subbtn").click();
     }
 }
</script>
</html>