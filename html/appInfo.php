<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pets.css">
    <link rel="stylesheet" href="../css/application.css">
    <link rel="stylesheet" href="../css/AppInfo.css">
    <title>AdoptiPet - Application Details</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Delius&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <section>
        <div class="sign-in">
            <?php if (isset($_SESSION["id"])): ?>
                <a class="greeting" href="../php/logout.php">Hello, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</a>
            <?php else: ?>
            
                <span class="person material-symbols-outlined">person</span>
                <button class="sign-in-btn" id="lgin">SIGN IN</button>
            <?php endif; ?>
        </div>
            <div class="logo">
                <img class="logo-pic" src="../img/logo-nobg.png" >
                <h1 class="txt">AdoptiPet</h1>
            </div>
            <form >
            <div class="search">
                <span class="search-icon material-symbols-outlined">search</span>
                <input class="search-input" type="search" placeholder="Search">
            </div>
            </form>
            <div class="menu-wrap">
                <input type="checkbox" class="toggler">
                <div class="hamburger">
                    <div></div>
                </div>
                <div class="menu">
                    <div>
                        <div>
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="pets.php?type=cat">Cats</a></li>
                                <li><a href="pets.php?type=dog">Dogs</a></li>
                                <li><a href="applications.php">My Pets</a></li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section> 
    </header>

    
    <main class="application-details-container">
        <?php
        
        
        if(!isset($_SESSION['id'])) {
            echo "<div class='not-logged-in'>
                    <h2>You need to be logged in to view application details</h2>
                    <a href='login.php' class='login-button'>Log In</a>
                  </div>";
            exit;
        }
        
        $user_id = $_SESSION['id'];
        
        
        if(!isset($_GET['id']) || empty($_GET['id'])) {
            echo "<div class='error-message'>No application specified. <a href='my-applications.php'>Return to your applications</a></div>";
            exit;
        }
        
        $application_id = intval($_GET['id']);
        
        
        include '../php/dbConnection.php';
        
        
        $sql = "SELECT a.*, p.name as pet_name, p.type, p.breed, p.age, p.gender, p.description, p.image_path,
                       u.first_name, u.last_name, u.email, u.phone
                FROM adoption_applications a 
                JOIN pets p ON a.pet_id = p.id 
                JOIN users u ON a.user_id = u.id
                WHERE a.id = $application_id AND a.user_id = $user_id";
        
        $result = $conn->query($sql);
        
        
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            
            $pet_name = htmlspecialchars($row['pet_name']);
            $pet_type = htmlspecialchars($row['type']);
            $pet_breed = htmlspecialchars($row['breed']);
            $pet_age = htmlspecialchars($row['age']);
            $pet_gender = htmlspecialchars($row['gender']);
            $pet_description = htmlspecialchars($row['description']);
            $pet_image = !empty($row['image_path']) ? $row['image_path'] : '../img/pet-placeholder.jpg';
            $pet_id = htmlspecialchars($row['pet_id']);
            
            $application_date = date('F d, Y', strtotime($row['application_date']));
            $status = htmlspecialchars($row['status']);
            $notes = !empty($row['notes']) ? htmlspecialchars($row['notes']) : 'No additional notes provided.';
            
            $user_name = htmlspecialchars($row['first_name'] . ' ' . $row['last_name']);
            $user_email = htmlspecialchars($row['email']);
            $user_phone = !empty($row['phone']) ? htmlspecialchars($row['phone']) : 'No phone number provided';
            
            
            $age_suffix = $pet_age == 1 ? "year" : "years";
            
            
            $status_class = 'status-' . $status;
            
            
            echo "
            <div class='application-header'>
                <h1>Application Details</h1>
                <div class='application-status $status_class'>
                    <span class='status-label'>Status:</span>
                    <span class='status-value'>" . ucfirst($status) . "</span>
                </div>
            </div>
            
            <div class='application-content'>
                <div class='pet-details-card'>
                    <div class='pet-image-container'>
                        <img src='$pet_image' alt='$pet_name' class='pet-image'>
                    </div>
                    <div class='pet-info'>
                        <h2 class='pet-name'>$pet_name</h2>
                        <div class='pet-characteristics'>
                            <span class='pet-gender'>" . ucfirst($pet_gender) . "</span>
                            <span class='pet-age'>$pet_age $age_suffix</span>
                            <span class='pet-type'>" . ucfirst($pet_type) . "</span>
                            <span class='pet-breed'>$pet_breed</span>
                        </div>
                        <p class='pet-description'>$pet_description</p>
                        <a href='petInfo.php?id=$pet_id' class='view-pet-btn'>View Full Pet Details</a>
                    </div>
                </div>
                
                <div class='application-info-card'>
                    <h2>Application Information</h2>
                    <div class='info-group'>
                        <span class='info-label'>Application Date:</span>
                        <span class='info-value'>$application_date</span>
                    </div>
                    <div class='info-group'>
                        <span class='info-label'>Applicant:</span>
                        <span class='info-value'>$user_name</span>
                    </div>
                    <div class='info-group'>
                        <span class='info-label'>Contact Email:</span>
                        <span class='info-value'>$user_email</span>
                    </div>
                    <div class='info-group'>
                        <span class='info-label'>Phone:</span>
                        <span class='info-value'>$user_phone</span>
                    </div>
                    
                    <div class='application-notes'>
                        <h3>Notes</h3>
                        <div class='notes-content'>
                            $notes
                        </div>
                    </div>";
                    
                    
                    if($status == 'pending') {
                        echo "
                        <div class='status-message pending-message'>
                            <h3>Application Under Review</h3>
                            <p>Your application is currently being reviewed by our team. We typically respond within 3-5 business days. Thank you for your patience!</p>
                        </div>";
                    } else if($status == 'approved') {
                        echo "
                        <div class='status-message approved-message'>
                            <h3>Congratulations!</h3>
                            <p>Your application has been approved! Our team will contact you soon to arrange the next steps for adoption. Get ready to welcome your new furry friend!</p>
                        </div>";
                    } else if($status == 'rejected') {
                        echo "
                        <div class='status-message rejected-message'>
                            <h3>Application Not Approved</h3>
                            <p>We're sorry, but your application wasn't approved at this time. This doesn't mean you can't adopt another pet! Please check out our other wonderful animals looking for a home.</p>
                            <a href='pets.php' class='browse-pets-btn'>Browse Available Pets</a>
                        </div>";
                    }
                    
                echo "
                </div>
                
                <div class='action-buttons'>
                    <a href='my-applications.php' class='back-btn'>Back to My Applications</a>
                    <a href='contact.php' class='contact-btn'>Contact Support</a>
                </div>
            </div>";
            
        } else {
            echo "<div class='error-message'>Application not found or you don't have permission to view it. <a href='my-applications.php'>Return to your applications</a></div>";
        }
        
        
        $conn->close();
        ?>
    </main>

    <footer>
        <div class="tunisia">
            <img src="../img/tunisia.webp" alt="">
            <h4><span>AdpotiPet</span> founded in tunisia</h4>
        </div>
        <div class="fin">
            <div class="pp">
                <h3>RESOURCES</h3>
                <ul>
                    <li><a href="">FAQs</a></li>
                    <li><a href="">Moblie App soon</a></li>
                    <li><a href="">Partnerships</a></li>
                    <li><a href="">Contact us</a></li>
                </ul>
            </div>
            <div class="pp">
                <h3>ADOPT OR GET INVOLVE</h3>
                <ul>
                    <li><a href="">All adopt or Get involved</a></li>
                    <li><a href="">Adopting Pets</a></li>
                    <li><a href="">Animal Sehlters & Rescues</a></li>
                    <li><a href="">Other types of Pets</a></li>
                </ul>
            </div>
            <div class="pp">
                <h3>ABOUT DOGS & PUPPIES</h3>
                <ul>
                    <li><a href="">All About Dogs & Puppies</a></li>
                    <li><a href="">Dog Breeds</a></li>
                    <li><a href="">Feeding Your Dog</a></li>
                    <li><a href="">Dog Training</a></li>
                </ul>
            </div>
            <div class="pp">
                <h3>ABOUT CATS & KITTENS</h3>
                <ul>
                    <li><a href="">All About Cats & Kittens </a></li>
                    <li><a href="">Cat Breeds</a></li>
                    <li><a href="">Feeding Your Cat</a></li>
                    <li><a href="">Cat Training</a></li>
                </ul>
            </div>
        </div>
        <div class="last">
            <h5>©2025 AdoptiPet.com</h5>
            <h4>created by : Chaouachi Mohamed Jawher & Taha Yassine Lamouchi</h4>
        </div>
    </footer>

    <script src="../js/main.js"></script>
</body>
</html>