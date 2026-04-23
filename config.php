<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "brewhub";

// try {
//     $pdo = new PDO(
//         "mysqli:host$servername;dbname=$dbname",
//         $username,
//         $password
//     );

//     $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// } catch (PDOException $e){
//     die("COnnection failed: " . $e -> getMessage());
// }
    
$conn = new mysqli($servername, $username, $password, $dbname);

if($conn -> connect_error){
    die("Connection failed: " . $conn -> connect_error);
}