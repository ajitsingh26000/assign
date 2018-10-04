<?php include 'header.php';?>
<div class='container'>
    <form method="POST" action="register.php" name='reg' id ="myForm" onsubmit="return myFunction()">
        <div class="form-group">
            <label>Full Name</label>
            <input class="form-control" type="text" pattern="[a-zA-Z\s]+" name="fullname" required/>
        </div>
        <div class="form-group">
            <label>Username</label>
            <input class="form-control" type="text" minlength=3 name="username" required/>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="email" name="email" required/>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="password" pattern="(?=.*\d)(?=.*[a-zA-Z]).{8,}" minlength=8 name="password" required/>
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input class="form-control" type="password" name="conpassword" required/>
        </div>
        <input class="btn btn-primary" type="submit" value="Register"/>
    </form> 
</div>
<script>
    function myFunction(){
        var x = document.getElementById("myForm").elements.namedItem("password").value;
        var y = document.getElementById("myForm").elements.namedItem("conpassword").value;
        if(x!=y){
            alert("Password do not match");
            return false;
        }
    }
</script>
<?php
    require 'functions.php';
    session_start();

    $user = new User();

    if ($user->get_session()){
        header("location:home.php");
        $_SESSION['error'] = "<div class='container' style='color:red'>Already logged in</div><br>";
    }

    if (isset($_POST['fullname']) 
        && isset($_POST['username']) 
        && isset($_POST['password']) 
        && isset($_POST['email'])
        && $user->check_password($_POST['password'])
        && $user->check_email($_POST['email']) 
        && $user->check_username($_POST['username']) 
        && $user->check_name($_POST['fullname'])
    ){
        if($_POST['fullname'] && $_POST['username'] && $_POST['password'] && $_POST['email']){
            $register = $user->register_user($_POST['fullname'], $_POST['username'], $_POST['password'], $_POST['email']);
            echo ($register);
        } else echo "<div class='container' style='color:red'>Please fill all required fields</div>";
    }
?>