<?php

session_start();
if (isset($_SESSION['active'])) {
    session_destroy();
    header("location:login.php");
}