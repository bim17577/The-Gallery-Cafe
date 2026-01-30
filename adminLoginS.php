<?php

include("dbConnection.php");

session_start();

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username)){
        header("Location: adminLogin.html");
        exit();
    }
    elseif(empty($password)){
        header("Location: adminLogin.html");
        exit();
    }
    else{
        //echo $username.$password;

        $sql = "Select * from cafe_admin where username='$username' and password='$password'";

        $result = mysqli_query($conn,$sql);

        if(mysqli_num_rows($result)){
            $row = mysqli_fetch_assoc($result);
            
            if($row['username'] == $username && $row['password'] == $password){
                echo "Logged in";

                $_SESSION['username'] = $row['username'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['name'] = $row['name'];

                header("Location:admin.php");
                exit();
            }
            else{
                echo "Wrong username or password. Please try again.";

                header("Location:adminLogin.html");
            }
        }
    }
}
else{
    echo "empty";
    header("Location: adminLogin.html");
    exit();
}