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
    <title>AdoptiPet - My Applications</title>
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
                <span class="greeting">Hello, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</span>
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
                                <li><a href="mypets.php">My Pets</a></li>
                                <li><a href="my-applications.php">My Applications</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section> 
    </header>

    <!-- Main Content -->
    <main class="pets-container">
        <div class="pets-header">
            <h1>My Adoption Applications</h1>
            
            <div class="filter-container">
                <div class="filter-group">
                    <label for="filter-type">Pet Type:</label>
                    <select id="filter-type" name="type">
                        <option value="">All Types</option>
                        <option value="cat" <?php echo (isset($_GET['type']) && $_GET['type'] == 'cat') ? 'selected' : ''; ?>>Cats</option>
                        <option value="dog" <?php echo (isset($_GET['type']) && $_GET['type'] == 'dog') ? 'selected' : ''; ?>>Dogs</option>
                        <option value="other" <?php echo (isset($_GET['type']) && $_GET['type'] == 'other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="filter-status">Application Status:</label>
                    <select id="filter-status" name="status">
                        <option value="">All Statuses</option>
                        <option value="pending" <?php echo (isset($_GET['status']) && $_GET['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                        <option value="approved" <?php echo (isset($_GET['status']) && $_GET['status'] == 'approved') ? 'selected' : ''; ?>>Approved</option>
                        <option value="rejected" <?php echo (isset($_GET['status']) && $_GET['status'] == 'rejected') ? 'selected' : ''; ?>>Rejected</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="filter-date">Sort By:</label>
                    <select id="filter-date" name="sort">
                        <option value="newest" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'newest') ? 'selected' : ''; ?>>Newest First</option>
                        <option value="oldest" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'oldest') ? 'selected' : ''; ?>>Oldest First</option>
                    </select>
                </div>
                
                <button class="filter-button">Apply Filters</button>
            </div>
        </div>

        <div class="pets-grid">
            <?php
            
            
            
            // Check if user is logged in
            if(!isset($_SESSION['id'])) {
                echo "<div class='not-logged-in'>
                        <h2>You need to be logged in to view your applications</h2>
                        <a href='login.html' class='login-button'>Log In</a>
                      </div>";
                exit;
            }
            
            $user_id = $_SESSION['id'];
            
            // Include the database connection file
            include '../php/dbConnection.php';
            
            // Build query based on filters
            $sql = "SELECT a.*, p.name, p.type, p.breed, p.age, p.gender, p.image_path 
                    FROM adoption_applications a 
                    JOIN pets p ON a.pet_id = p.id 
                    WHERE a.user_id = $user_id";
            
            // Add type filter if specified
            if(isset($_GET['type']) && !empty($_GET['type'])) {
                $type = $conn->real_escape_string($_GET['type']);
                if($type != "other") {
                    $sql .= " AND p.type = '$type'";
                } else {
                    $sql .= " AND p.type != 'cat' AND p.type != 'dog'";
                }
            }
            
            // Add status filter if specified
            if(isset($_GET['status']) && !empty($_GET['status'])) {
                $status = $conn->real_escape_string($_GET['status']);
                $sql .= " AND a.status = '$status'";
            }
            
            // Add sorting
            if(isset($_GET['sort']) && $_GET['sort'] == 'oldest') {
                $sql .= " ORDER BY a.application_date ASC";
            } else {
                $sql .= " ORDER BY a.application_date DESC"; // Default newest first
            }
            
            // Execute query
            $result = $conn->query($sql);
            
            // Check if there are results
            if ($result && $result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    $pet_image = !empty($row['image_path']) ? $row['image_path'] : '../img/pet-placeholder.jpg';
                    $pet_name = htmlspecialchars($row['name']);
                    $pet_type = htmlspecialchars($row['type']);
                    $pet_breed = htmlspecialchars($row['breed']);
                    $pet_age = htmlspecialchars($row['age']);
                    $pet_gender = htmlspecialchars($row['gender']);
                    $pet_id = htmlspecialchars($row['pet_id']);
                    $application_id = htmlspecialchars($row['id']);
                    $application_date = date('M d, Y', strtotime($row['application_date']));
                    $status = htmlspecialchars($row['status']);
                    
                    // Age suffix
                    $age_suffix = $pet_age == 1 ? "year" : "years";
                    
                    // Status class
                    $status_class = 'status-' . $status;
                    
                    // Application card HTML
                    echo "
                    <div class='pet-card'>
                        <div class='pet-image-container'>
                            <img src='$pet_image' alt='$pet_name' class='pet-image'>
                            <div class='pet-quick-info'>
                                <span class='pet-gender'>" . ucfirst($pet_gender) . "</span>
                                <span class='pet-age'>$pet_age $age_suffix</span>
                            </div>
                        </div>
                        <div class='pet-info'>
                            <h3 class='pet-name'>$pet_name</h3>
                            <div class='pet-details'>
                                <div class='pet-detail'>
                                    <span class='detail-label'>Type:</span>
                                    <span class='detail-value'>" . ucfirst($pet_type) . "</span>
                                </div>
                                <div class='pet-detail'>
                                    <span class='detail-label'>Breed:</span>
                                    <span class='detail-value'>$pet_breed</span>
                                </div>
                                <div class='pet-detail'>
                                    <span class='detail-label'>Applied:</span>
                                    <span class='detail-value'>$application_date</span>
                                </div>
                                <div class='pet-detail'>
                                    <span class='detail-label'>Status:</span>
                                    <span class='detail-value status-badge $status_class'>" . ucfirst($status) . "</span>
                                </div>
                            </div>
                            <div class='application-actions'>
                                <a href='pet-details.php?id=$pet_id' class='pet-learn-more'>View Pet</a>
                                <a href='application-details.php?id=$application_id' class='application-details-btn'>Application Details</a>
                            </div>
                        </div>
                    </div>
                    ";
                }
            } else {
                echo "<div class='no-pets-message'>No applications found matching your criteria. Try adjusting your filters or <a href='pets.php'>adopt a pet</a>!</div>";
            }
            
            // Close the database connection
            $conn->close();
            ?>
        </div>
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
    <script src="../js/application.js"></script>
</body>
</html>