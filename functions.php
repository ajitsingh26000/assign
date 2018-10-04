<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class User{
    public function login_user($username, $password){
        include 'connection.php';
        $data = array($username, $username,$password);
        $userid = $connection->prepare("Select * from Users where (username = ? or email = ?) AND pass=?");
        // print_r($userid);
        $userid->setFetchMode(PDO::FETCH_NUM);
        $userid->execute($data);
        // print_r($data);
        $row = $userid->fetchall();
        // print_r($row);

        if($row) {
            // if(isset($_SESSION['login'])){echo "loggedin";};
            $_SESSION['login']=True;
            $_SESSION['PersonId']=$row[0][0];
            $_SESSION['fullname']=$row[0][1];
            $_SESSION['username']=$row[0][2];
            $_SESSION['email']=$row[0][4];
            header("location:home.php");
        } 
        else{
            return "<div class='container' style='color:red'>Incorrect Username or Password</div>";
        }
    }

    public function register_user($fullname,$username,$password, $email){
        include 'connection.php';
        $data = array($username, $email);

        $userid = $connection->prepare("Select * from Users where username = ? or email = ?");
        $userid->setFetchMode(PDO::FETCH_NUM);
        $userid->execute($data);
        // echo "<br>";
        // $userid->setFetchMode(PDO::FETCH_ASSOC);
        $row = $userid->fetchall($data);
        if($row) {
            return "<div class='container' style='color:red'>Username or Email Already Exits<div>";
        } 
        else{
            $data = array($username,$username,$password,$email);
            $insertQuery = "INSERT INTO Users (fullname, username, pass, email) value (?, ?, ?, ?)";
            $STH = $connection->prepare($insertQuery);
            $STH->execute($data);
            $this->login_user($username,$password);
        }
    }

    public function get_session(){
        // print_r($_SESSION['login']);
        if (isset($_SESSION['login'])){
            return $_SESSION['login'];
        } else return;
    }

    public function user_logout(){
        $_SESSION['login'] = FALSE;
        session_destroy();
    } 

    public function edit_account($fullname,$email){
        include 'connection.php';
        $data = array($fullname,$email,$_SESSION['PersonId']);
        $updateUser = $connection->prepare("UPDATE Users SET fullname = ?,email=? WHERE PersonID = ?");
        $updateUser->execute($data);
        $_SESSION['fullname']=$fullname;
        $_SESSION['email']=$email;
    }

    public function change_password($password){
        include 'connection.php';
        $data = array($password,$_SESSION['PersonId']);
        $updateUser = $connection->prepare("UPDATE Users SET pass =? WHERE PersonID = ?");
        // print_r($updateUser);
        $updateUser->execute($data);
    }

    public function check_password($password){
        $number= preg_match('@[0-9]@', $password);
        $lowercase=preg_match('@[A-Za-z]@', $password);
        if(!$lowercase||!$number || strlen($password) < 8) {
            // echo 'false pasa';
            return False;
        }
        // echo 'true pass';
        return True;
    }

    public function check_email($email){
        // var_dump(filter_var('bob@example.com', FILTER_VALIDATE_EMAIL));
        if(!preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', $email)){
            // echo 'false';
            return False;
        }
        // echo 'true';
        return True;
    }

    public function check_username($username){
        // $number= preg_match('@[0-9]@', $password);
        if(strlen($username) < 3) {
            // echo 'false pasa';
            return False;
        }
        // echo 'true pass';
        return True;
    }

    public function check_name($name){
        // $number= preg_match('@[0-9]@', $password);
        $case=preg_match('/^[a-zA-Z\s]+$/', $name);
        if(!$case) {
            // echo 'false name';
            return False;
        }
        // echo 'true name';
        return True;
    }

    
}
?>