<?php

session_start();

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'brewhub';

$conn = new mysqli($servername,$username,$password,$dbname);


if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])){

    $sql = "SELECT ID, email, name, password, username, role FROM users where email = ?";

    if($stmt = $conn->prepare($sql)){
        $stmt->bind_param("s", $param_email);

        $param_email = $_POST['email'];

        if($stmt->execute()){

            $stmt->store_result();

            if($stmt->num_rows == 1){

                $stmt->bind_result($ID, $email, $name, $hashed_password, $username, $role);

                if($stmt->fetch()){
                    
                    if(password_verify($_POST['password'], $hashed_password)){

                        $_SESSION['loggedin'] = true;
                        $_SESSION['ID'] = $ID;
                        $_SESSION['email'] = $email;
                        $_SESSION['fullname'] = $name;
                        $_SESSION['username'] = $username;
                        $_SESSION['role'] = $role;

                        if(empty($role)) $role = 'buyer';

                        if($role == 'admin'){
                            echo json_encode(['status' => 'success', 'redirect' => 'admin/admin.php']);
                        } else if ($role == 'seller'){
                            echo json_encode(['status' => 'success', 'redirect' => 'Seller/SellerDashboard.php']);
                        } else {
                            echo json_encode(['status' => 'success', 'redirect' => 'Buyer/Buyer_DashBoard.php']);
                        }
                        exit();
                
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Invalid email or password']);
                    }
                } 
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid email or password']);
            }
        } else {
           echo json_encode(['status' => 'error', 'message' => 'Something went wrong!']);
        }
          $stmt->close();
    } 
    }
    $conn->close();
}