<?php
    session_start();
    include 'functions.php';
    $user = new User();
    $user->user_logout();
    header("location:home.php");
?>