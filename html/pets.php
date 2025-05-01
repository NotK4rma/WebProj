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
    <title>AdoptiPet - Available Pets</title>
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
            <h1>
                <?php 
                $page_title = "All Available Pets";
                if(isset($_GET['type'])) {
                    $type = htmlspecialchars($_GET['type']);
                    $page_title = ucfirst($type) . "s Available for Adoption";
                }
                echo $page_title;
                ?>
            </h1>
            
            <div class="filter-container">
                <div class="filter-group">
                    <label for="filter-type">Type:</label>
                    <select id="filter-type" name="type">
                        <option value="">All Types</option>
                        <option value="cat" <?php echo (isset($_GET['type']) && $_GET['type'] == 'cat') ? 'selected' : ''; ?>>Cats</option>
                        <option value="dog" <?php echo (isset($_GET['type']) && $_GET['type'] == 'dog') ? 'selected' : ''; ?>>Dogs</option>
                        <option value="other" <?php echo (isset($_GET['type']) && $_GET['type'] == 'other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="filter-age">Age:</label>
                    <select id="filter-age" name="age">
                        <option value="">All Ages</option>
                        <option value="baby">Baby</option>
                        <option value="young">Young</option>
                        <option value="adult">Adult</option>
                        <option value="senior">Senior</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="filter-gender">Gender:</label>
                    <select id="filter-gender" name="gender">
                        <option value="">All Genders</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                
                <button class="filter-button">Apply Filters</button>
            </div>
        </div>

        <div class="pets-grid">
            <?php
            // Include the database connection file
            include '../php/dbConnection.php';
            
            // Build query based on filters
            $sql = "SELECT * FROM pets WHERE 1=1";
            
            // Add type filter if specified
            if(isset($_GET['type']) && !empty($_GET['type'])) {
                $type = $conn->real_escape_string($_GET['type']);
                if($type!="other"){
                    $sql .= " AND type = '$type'";
                }
                else{
                    $sql .= " AND type != 'cat' AND type !='dog'";
                }
                
            }
            
            // Add age filter if specified
            if(isset($_GET['age']) && !empty($_GET['age'])) {
                $age = $conn->real_escape_string($_GET['age']);
                
                switch($age) {
                    case 'baby':
                        $sql .= " AND age <= 1";
                        break;
                    case 'young':
                        $sql .= " AND age > 1 AND age <= 3";
                        break;
                    case 'adult':
                        $sql .= " AND age > 3 AND age <= 8";
                        break;
                    case 'senior':
                        $sql .= " AND age > 8";
                        break;
                }
            }
            
            // Add gender filter if specified
            if(isset($_GET['gender']) && !empty($_GET['gender'])) {
                $gender = $conn->real_escape_string($_GET['gender']);
                $sql .= " AND gender = '$gender'";
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
                    $pet_id = htmlspecialchars($row['id']);
                    
                    // Age suffix
                    $age_suffix = $pet_age == 1 ? "year" : "years";
                    
                    // Pet card HTML
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
                            </div>
                            <a href='pet-details.php?id=$pet_id' class='pet-learn-more'>Learn More</a>
                        </div>
                    </div>
                    ";
                }
            } else {
                echo "<div class='no-pets-message'>No pets found matching your criteria. Try adjusting your filters.</div>";
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
    <script src="../js/pets.js"></script>
</body>
</html>