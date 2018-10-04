<?php 
    session_start();
    require 'functions.php';
    include 'header.php';
    $user = new User();
    if(isset($_POST['email']) && isset($_POST['fullname'])&&
        $user->check_email($_POST['email']) && $user->check_name($_POST['fullname'])
    ){
        if($_POST['email'] && $_POST['fullname']){
            $register = $user->edit_account($_POST['fullname'],$_POST['email']);
            echo ("<div class='container' style='color:gray'>Account is updated with the required field</div>");
        } else echo "<div class='container' style='color:red'>Please fill all required fields</div>";
    }
?>
<div class='container'>
    <form method="POST" action="edit_account.php" name='reg' >
        <div class="form-group">
            <label>Full Name</label>
            <input class="form-control" type="text" name="fullname"  pattern="[a-zA-Z\s]+" required value="<?php echo ($_SESSION['fullname'])?>">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="email" name="email" required value="<?php echo ($_SESSION['email'])?>"/>
        </div>
        <input class="btn btn-primary" type="submit" value="Save"/>
    </form> 
</div>
<div class='container'>
    <form method="POST" action="edit_account.php" name='reg' id="myForm"  onsubmit="return myFunction()" >
        <div class="form-group">
            <label>Previous Password</label>
            <input class="form-control" type="password" name="prevpassword" required/>
        </div>
        <div class="form-group">
            <label>New Password</label>
            <input class="form-control" type="password" pattern="(?=.*\d)(?=.*[a-zA-Z]).{8,}" minlength=8 name="newpassword" required/>
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input class="form-control" type="password" name="conpassword" required/>
        </div>
        <input class="btn btn-primary" type="submit" value="Save"/>
    </form>
</div>
<script>
    function myFunction(){
        var x = document.getElementById("myForm").elements.namedItem("newpassword").value;
        var y = document.getElementById("myForm").elements.namedItem("conpassword").value;
        console.log(x);
        console.log(y);
        if(x!=y){
            alert("Password do not match");
            return false;
        }
    }
</script>
<?php
    include 'connection.php';
    $user = new User();
    
    if (!$user->get_session()){
        header("location:home.php");
        $_SESSION['error'] = "<div class='container' style='color:red'>Please login to continue</div><br>";
    }
    // $temp=;
    $data=array($_SESSION['PersonId']);
    $userid = $connection->prepare("Select pass from Users WHERE PersonID =?");
    $userid->setFetchMode(PDO::FETCH_NUM);
    $userid->execute($data);
    $row = $userid->fetch();

    if(isset($_POST['prevpassword']) && isset($_POST['newpassword'])&& $user->check_password($_POST['newpassword'])){
        if($row[0]==$_POST['prevpassword']){
            if($_POST['newpassword']){
                $user->change_password($_POST['newpassword']);
                echo "<div class='container' style='color:red'>Password Changed</div>";
            }
        } else {
            echo "<div class='container' style='color:red'>Previous password you entered was incorrect. Please try again</div>";
        }
    }
?>
