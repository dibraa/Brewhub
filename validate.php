<?php

session_start();

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'brewhub';

$conn = new mysqli($servername,$username,$password,$dbname);


if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])){

    $sql = "SELECT ID, email, name, password, username FROM users where email = ?";

    if($stmt = $conn->prepare($sql)){
        $stmt->bind_param("s", $param_email);

        $param_email = $_POST['email'];

        if($stmt->execute()){

            $stmt->store_result();

            if($stmt->num_rows == 1){

                $stmt->bind_result($ID,$email,$name,$username,$hashed_password);

                if($stmt->fetch()){
                    
                    if(password_verify($_POST['password'], $hashed_password)){

                        $_SESSION['loggedin'] = true;
                        $_SESSION['ID'] = $ID;
                        $_SESSION['email'] = $email;
                        $_SESSION['fullname'] = $name;
                        $_SESSION['username'] = $username;
                        

                        header("Location: Buyer/Buyer_Dashboard.php");
                        exit();

                    } else {
                        echo ('Invalid Email or Password');
                    }
                } 
            } else {
                echo ('Invalid email or password');
            }
        } else {
            echo ('something went wrong');
        }
          $stmt->close();
    } 
    }
    $conn->close();
}

// mag add pako condition for different user (buyer or seller).
