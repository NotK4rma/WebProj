<?php

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
    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];
        $r_email= $row["email"];
        if(password_verify($password,$hashed_password)){
            header("Location: ../html/index.html");
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

// if(isset($errors) && !empty($errors)) {
//     header("Location: ../html/login.html");
//     echo '<div id="error-popup" class="error-popup">';
//     echo '<div class="error-popup-content">';
//     echo '<div class="error-header">';
//     echo '<h3><i class="fas fa-exclamation-circle"></i> Oops! There was a problem</h3>';
//     echo '<span class="close-btn">&times;</span>';
//     echo '</div>';
//     echo '<div class="error-body">';
    

//     echo '<ul class="error-list">';
//     foreach($errors as $error) {
//         echo '<li>' . htmlspecialchars($error) . '</li>';
//     }
//     echo '</ul>';
    
//     echo '</div>';
//     echo '</div>';
//     echo '</div>';
    
    
//     echo '<script>
//         document.addEventListener("DOMContentLoaded", function() {
//             var errorPopup = document.getElementById("error-popup");
            
//             // Show the popup
//             errorPopup.classList.add("show");
            
//             // Close button functionality
//             var closeBtn = document.querySelector(".close-btn");
//             closeBtn.addEventListener("click", function() {
//                 errorPopup.classList.remove("show");
//                 setTimeout(function() {
//                     errorPopup.style.display = "none";
//                 }, 300);
//             });
            
//             // Auto-dismiss after 8 seconds
//             setTimeout(function() {
//                 errorPopup.classList.remove("show");
//                 setTimeout(function() {
//                     errorPopup.style.display = "none";
//                 }, 300);
//             }, 8000);
//         });
//     </script>';
// }
// echo '<link rel="stylesheet" href="../css/error.css">';
$conn->close();
?>