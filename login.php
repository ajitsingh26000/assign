<?php include 'header.php';?>

<div class="container">
    <form method="POST" action="login.php?password=" name='reg' >
        <div class="form-group">
            <label>Email address/Username</label>
            <input type="text" class="form-control" name="username" required/><br>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password" required/><br>
        </div>
        <input type="submit" class="btn btn-primary" value="Login"/>
    </form> 
    <a href="login.php?password=forgot">Forgot Password</a>
</div>

<?php
    require 'functions.php';

    session_start();
    $user = new User();

    if ($user->get_session()){
        header("location:home.php");
        $_SESSION['error'] = "<div class='container' style='color:red'>Already logged in</div><br>";
    }

    if(isset($_GET['password']) && $_GET['password']=='forgot'){
        include 'forget_password.php';
    }

    if(isset($_POST['username']) && isset($_POST['password'])){
        if($_POST['username'] && $_POST['password']){
            $register = $user->login_user($_POST['username'], $_POST['password']);
            echo ($register);
        } else {
            echo "<div class='container' style='color:red'>Please fill all required fields</div>";
        }
    }
?>