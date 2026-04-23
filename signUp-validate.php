<?php

session_start();
include 'config.php';


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // $sql = "SELECT * FROM users WHERE email = '$email' and Name = '$name'";
    // $result = $conn->query($sql);

    $stmt = $conn -> prepare ("SELECT * FROM users WHERE email = ?");

    if ($stmt === false ){
        die("Prepared Failed: " . $conn -> error);
    }
    $stmt -> bind_param("s", $email);
    $stmt -> execute();
    $stmt -> store_result();

    
    
    if($stmt -> num_rows > 0){
        echo ('Email already exist');
    } else {
        // $sql = "INSERT INTO users (fullname, email, Password, username) VALUES ('$name', '$email', '$hashed_password', '$username')";

        // if($conn->query($sql) === TRUE){
        //     echo('Data is added successfully ');
        // } else {
        //     echo('Data is not inserted');
        // }

        $stmt = $conn -> prepare("INSERT INTO users (name , email, password, username) 
        VALUES (?, ?, ?, ?)");

        $stmt -> bind_param("ssss", $name, $email, $hashed_password, $username);

        if ($stmt -> execute()){
            echo 'Data added seccessfully';
        } else {
            echo 'Data not inserted';
        }
    } 

} else {
        echo('There is something wrong');
    }