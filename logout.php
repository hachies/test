<?php
session_start(); 

if (isset($_SESSION['is_ingelogd'])) {

    unset($_SESSION['is_ingelogd']);

    header("Location: roostermaker-login.php");
    exit();
} else {
    header("Location: roostermaker-login.php");
    exit();
}
?>
