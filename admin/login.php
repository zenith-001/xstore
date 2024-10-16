<?php

session_start();
if (isset($_SESSION['active'])) {
    session_destroy();
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $login = false;
    include "db.php";
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "select * from admin_acc where Username='$username' and Password_Hash='" . hash("sha256", $password) . "'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    echo $num;
    if ($num == 1) {
        $login = true;
        session_start();
        $_SESSION['active'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['name'] = mysqli_fetch_assoc($result)['Name'];
        header("location: index.php");
    } else {
        $login = false;
        echo "Incorrect username and password combination";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-thin.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-solid.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-regular.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-light.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/admin_login.css">
    <title>Login page</title>
</head>

<body>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <form action="login.php" method="POST">
        <h2>Admin Login</h2>
        <br>
        <input required name="username" placeholder="username" type="text"><br><br>
        <input required id="pwd" name="password" placeholder="password" type="password"><br><br>
        <div class="eye">
            <i class="fa-duotone fa-eye"></i>
        </div>
        <input type="submit">
    </form><br><br>
    <div class="layer"></div>
    <!-- <a href="signup.php">dont have an account? signup  here</a> -->
</body>
<script>
    let eye = document.querySelector(".eye");
    eye.onclick = function () {
        if (eye.children[0].classList.contains("fa-eye-slash")) {
            eye.innerHTML = `<i class="fa-duotone fa-eye"></i>`
            document.querySelector("#pwd").type = "password";
        }
        else {
            eye.innerHTML = `<i class="fa-duotone fa-eye-slash"></i>`
            document.querySelector("#pwd").type = "text";
        }
    }
</script>

</html>