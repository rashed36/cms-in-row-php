<?php ob_start(); ?>
<?php session_start(); ?>
<?php

    $_SESSION['users_name'] = null;
    $_SESSION['user_firstname'] = null;
    $_SESSION['user_firstname'] = null;
    $_SESSION['user_role'] = null;

    header("Location: ../index.php");

?>