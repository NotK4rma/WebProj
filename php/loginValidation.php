<?php
session_start();


$servername = "localhost"; 
$username = "root";        
$password = "manager";            
$dbname = "pet_adoption";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password']; 


    
    $errors = [];
    
    
    $check_data = "SELECT * FROM users WHERE email = '$email'";

    $result = $conn->query($check_data);
    $row = $result->fetch_assoc();
    if($result->num_rows == 1) {
        
        $hashed_password = $row["password"];
        $r_email= $row["email"];
        if(password_verify($password,$hashed_password)){
            $id = $row["id"];
            $_SESSION["id"] = $id;
            $_SESSION["username"] = $row["first_name"];
            header("Location: ../html/index.php");
            exit;
        }
        else{
            $errors[]="Password is incorrect";
            
        }
        
    }
    else{
        $errors[]="Email doesnt exist! Create a new account.";
        
    }
    
 
   
}

if (!empty($errors)) {
    $encodedErrors = urlencode(json_encode($errors));
    header("Location: ../html/login.html?errors=" . $encodedErrors);
    
    exit;
}


$conn->close();
?>