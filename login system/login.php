<?php
session_start();
include "db_conn.php";
if(isset($_POST['uname']) && isset($_POST['pass']) )
{
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $uname = validate($_POST['uname']);
    $password = validate($_POST['pass']);
     
    if(empty($uname)){
        header("location: login.html?error =User name is requird");
        exit();
    }
    else if(empty($password)){
        header("location: login.html?error =password is requird");
        echo"not valid";
        exit();
    }
    else
    { 
        $sql = "select * from users where user_name ='$uname' and password='$password'";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) == 1) {
         $row = mysqli_fetch_assoc($result);
         if ($row['user_name'] == $uname && $row['password'] == $password) {
            $_SESSION['user_name'] == $row['user_name'];
            $_SESSION['name'] == $row['name'];
            $_SESSION['id'] == $row['id'];
            header("location: home.php");
            exit();
            }
            else{
            header("location: home.php");
            exit();
            }
        }
        
    }

}else
{
    header("location: login.html?error");
    exit();

}
?>