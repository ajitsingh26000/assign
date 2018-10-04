<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<?php 
    echo "<div class='navbar navbar-expand-lg navbar-light bg-light'>
    <ul class='navbar-nav'>
    <li class=nav-item active'><a class='nav-link' href='home.php'>Home</a></li>
    ";
    if(!isset($_SESSION['login']) || !$_SESSION['login']){
        echo " <li class=nav-item'><a class='nav-link' href='login.php'>Login</a></li>";
        echo " <li class=nav-item'><a class='nav-link' href='register.php'>Register</a></li>";
    }
    if(isset($_SESSION['login']) && $_SESSION['login']){
        echo "<li class=nav-item'><a class='nav-link' href='edit_account.php'>Edit Account</a></li>";
        echo "<li class=nav-item'><a class='nav-link' href='logout.php'>Logout<a/></li>";
    }
    echo "</div>";
?>