<?php
include("dbConnection.php"); 

// Check if connection is established
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_POST['email'];
$password = $_POST['password'];
$username = $_POST['username'];


echo $username . $email . $password;


$stmt = $conn->prepare("INSERT INTO caffe_user (email, password, username) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $password, $username);

if ($stmt->execute()) {
    echo "New record created successfully!";
    header("Location: login.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
