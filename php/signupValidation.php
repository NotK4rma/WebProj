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
    $first_name = $conn->real_escape_string($_POST['first-name']);
    $last_name = $conn->real_escape_string($_POST['last-name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password']; 
    $phone = $conn->real_escape_string($_POST['phone']);

    
    $errors = [];
    
    
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($check_email);
    if($result->num_rows > 0) {
        $errors[] = "Email already exists";
    }
    
    
    if(empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO users (first_name, last_name, email, password, phone) 
                VALUES ('$first_name', '$last_name', '$email', '$hashed_password', '$phone')";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: ../html/index.html");
            exit();
        } else {
            $errors[] = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

if (!empty($errors)) {
    $encodedErrors = urlencode(json_encode($errors));
    header("Location: ../html/signup.html?errors=" . $encodedErrors);
    exit;
}


// if(isset($errors) && !empty($errors)) {
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

$conn->close();
?>