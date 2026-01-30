<?php

include("dbConnection.php");

session_start();

if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email)){
        header("Location: login.html");
        exit();
    }
    elseif(empty($password)){
        header("Location: login.html");
        exit();
    }
    else{
        //echo $email.$password;

        $sql = "Select * from caffe_user where email='$email' and password='$password'";

        $result = mysqli_query($conn,$sql);

        if(mysqli_num_rows($result)){
            $row = mysqli_fetch_assoc($result);
            
            if($row['email'] == $email && $row['password'] == $password){
                echo "Logged in";

                $_SESSION['email'] = $row['email'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
              

                header("Location:index.html");
                exit();
            }
            else{
                echo "Wrong username or password. Please try again.";

                header("Location:login.html");
            }
        }
    }
}
else{
    echo "empty";
    header("Location: login.html");
    exit();
}