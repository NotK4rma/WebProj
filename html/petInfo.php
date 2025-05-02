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
    <link rel="stylesheet" href="../css/petInfo.css">
    <title>AdoptiPet - Pet Details</title>
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
            <form>
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

    <?php
    
    include '../php/dbConnection.php';
    
    
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        echo "<div class='error-message'>No pet specified. <a href='pets.php'>Browse available pets</a></div>";
        exit;
    }
    
    $pet_id = intval($_GET['id']);
    
    
    if (isset($_POST['submit_application']) && isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];
        $notes = isset($_POST['application_notes']) ? $_POST['application_notes'] : '';
        
        
        $notes = htmlspecialchars($notes);
        
        
        $sql = "INSERT INTO adoption_applications (user_id, pet_id, notes) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $user_id, $pet_id, $notes);
        
        if ($stmt->execute()) {
            $application_id = $conn->insert_id;
            echo "<div class='success-message'>
                    <h3>Application Submitted!</h3>
                    <p>Your application has been successfully submitted. You can track its status in <a href='my-applications.php'>My Applications</a>.</p>
                  </div>";
        } else {
            echo "<div class='error-message'>Error submitting application. Please try again.</div>";
        }
        
        $stmt->close();
    }
    
    
    $sql = "SELECT * FROM pets WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pet_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $pet = $result->fetch_assoc();
        
        
        $is_adopted = $pet['is_adopted'];
        
        
        $has_applied = false;
        if (isset($_SESSION['id'])) {
            $user_id = $_SESSION['id'];
            $check_sql = "SELECT id FROM adoption_applications WHERE user_id = ? AND pet_id = ?";
            $check_stmt = $conn->prepare($check_sql);
            $check_stmt->bind_param("ii", $user_id, $pet_id);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();
            $has_applied = ($check_result->num_rows > 0);
            $check_stmt->close();
        }
        
        
        $name = htmlspecialchars($pet['name']);
        $type = htmlspecialchars($pet['type']);
        $breed = htmlspecialchars($pet['breed']);
        $age = htmlspecialchars($pet['age']);
        $gender = htmlspecialchars($pet['gender']);
        $description = htmlspecialchars($pet['description']);
        $image_path = !empty($pet['image_path']) ? $pet['image_path'] : '../img/pet-placeholder.jpg';
        
        
        $age_suffix = $age == 1 ? "year" : "years";
        
        
        ?>
        
        <main class="pet-details-container">
            <div class="pet-details-header">
                <h1>Meet <?php echo $name; ?></h1>
                <div class="pet-status <?php echo $is_adopted ? 'status-adopted' : 'status-available'; ?>">
                    <?php echo $is_adopted ? 'Adopted' : 'Available for Adoption'; ?>
                </div>
            </div>
            
            <div class="pet-profile">
                <div class="pet-image-gallery">
                    <img src="<?php echo $image_path; ?>" alt="<?php echo $name; ?>" class="main-image">
                </div>
                
                <div class="pet-info-card">
                    <div class="pet-basic-info">
                        <h2><?php echo $name; ?></h2>
                        <div class="pet-tags">
                            <span class="pet-tag pet-type"><?php echo ucfirst($type); ?></span>
                            <span class="pet-tag pet-breed"><?php echo $breed; ?></span>
                            <span class="pet-tag pet-gender"><?php echo ucfirst($gender); ?></span>
                            <span class="pet-tag pet-age"><?php echo "$age $age_suffix"; ?></span>
                        </div>
                    </div>
                    
                    <div class="pet-description">
                        <h3>About <?php echo $name; ?></h3>
                        <p><?php echo $description; ?></p>
                    </div>
                    
                    <div class="adoption-section">
                        <?php if ($is_adopted): ?>
                            <div class="adopted-message">
                                <span class="material-symbols-outlined">favorite</span>
                                <p><?php echo $name; ?> has already found a forever home!</p>
                            </div>
                        <?php elseif ($has_applied): ?>
                            <div class="already-applied-message">
                                <span class="material-symbols-outlined">check_circle</span>
                                <p>You've already applied to adopt <?php echo $name; ?>!</p>
                                <a href="applications.php" class="view-application-btn">View Your Applications</a>
                            </div>
                        <?php elseif (isset($_SESSION['id'])): ?>
                            <button id="openApplicationFormBtn" class="apply-btn">Apply to Adopt <?php echo $name; ?></button>
                            
                            <div id="applicationFormModal" class="modal">
                                <div class="modal-content">
                                    <span class="close-modal">&times;</span>
                                    <h2>Adoption Application for <?php echo $name; ?></h2>
                                    
                                    <form action="" method="post" class="adoption-form">
                                        <div class="form-group">
                                            <label for="application_notes">Tell us why you'd like to adopt <?php echo $name; ?> and any relevant information about your home environment:</label>
                                            <textarea id="application_notes" name="application_notes" rows="5" required></textarea>
                                        </div>
                                        
                                        <p class="form-note">By submitting this application, you're expressing interest in adopting <?php echo $name; ?>. Our team will review your application and contact you soon.</p>
                                        
                                        <div class="form-actions">
                                            <button type="button" class="cancel-btn" id="cancelApplicationBtn">Cancel</button>
                                            <button type="submit" name="submit_application" class="submit-btn">Submit Application</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="login-required">
                                <button class="apply-btn disabled">Apply to Adopt <?php echo $name; ?></button>
                                <p class="login-message">Please <a href="login.html">sign in</a> to apply for adoption</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <div class="pet-additional-info">
                <h3>What You Need to Know About <?php echo ucfirst($type); ?>s</h3>
                
                <?php if (strtolower($type) == 'dog'): ?>
                <div class="info-section">
                    <div class="info-item">
                        <span class="material-symbols-outlined">pets</span>
                        <h4>Exercise Needs</h4>
                        <p>Dogs need regular exercise to stay healthy and happy. This includes daily walks and playtime.</p>
                    </div>
                    <div class="info-item">
                        <span class="material-symbols-outlined">restaurant</span>
                        <h4>Diet</h4>
                        <p>A balanced diet specifically formulated for dogs is essential for their health and longevity.</p>
                    </div>
                    <div class="info-item">
                        <span class="material-symbols-outlined">home</span>
                        <h4>Space Requirements</h4>
                        <p>Dogs need space to move around. The amount varies by breed and size.</p>
                    </div>
                    <div class="info-item">
                        <span class="material-symbols-outlined">psychology</span>
                        <h4>Training</h4>
                        <p>Regular training sessions help dogs understand commands and behave appropriately.</p>
                    </div>
                </div>
                <?php elseif (strtolower($type) == 'cat'): ?>
                <div class="info-section">
                    <div class="info-item">
                        <span class="material-symbols-outlined">pets</span>
                        <h4>Independence</h4>
                        <p>Cats are generally more independent than dogs but still need attention and play time.</p>
                    </div>
                    <div class="info-item">
                        <span class="material-symbols-outlined">restaurant</span>
                        <h4>Diet</h4>
                        <p>Cats are obligate carnivores and need a diet high in animal protein.</p>
                    </div>
                    <div class="info-item">
                        <span class="material-symbols-outlined">home</span>
                        <h4>Litter Box</h4>
                        <p>Cats need a clean litter box that should be scooped daily and changed regularly.</p>
                    </div>
                    <div class="info-item">
                        <span class="material-symbols-outlined">psychology</span>
                        <h4>Enrichment</h4>
                        <p>Provide scratching posts, toys, and perches for mental and physical stimulation.</p>
                    </div>
                </div>
                <?php else: ?>
                <div class="info-section">
                    <div class="info-item">
                        <span class="material-symbols-outlined">pets</span>
                        <h4>General Care</h4>
                        <p>All pets require love, attention, and proper care specific to their species.</p>
                    </div>
                    <div class="info-item">
                        <span class="material-symbols-outlined">restaurant</span>
                        <h4>Diet</h4>
                        <p>Research the dietary needs specific to your pet's species and breed.</p>
                    </div>
                    <div class="info-item">
                        <span class="material-symbols-outlined">home</span>
                        <h4>Living Space</h4>
                        <p>Ensure your living space is appropriate and safe for your pet.</p>
                    </div>
                    <div class="info-item">
                        <span class="material-symbols-outlined">favorite</span>
                        <h4>Veterinary Care</h4>
                        <p>Regular veterinary check-ups are essential for your pet's health.</p>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="back-to-pets">
                <a href="pets.php?type=<?php echo strtolower($type); ?>" class="back-btn">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Back to <?php echo ucfirst($type); ?>s
                </a>
            </div>
        </main>

        <?php
    } else {
        echo "<div class='error-message'>Pet not found. <a href='pets.php'>Browse available pets</a></div>";
    }
    
    
    $stmt->close();
    $conn->close();
    ?>

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

    <script>
        
        const modal = document.getElementById('applicationFormModal');
        const openBtn = document.getElementById('openApplicationFormBtn');
        const closeBtn = document.querySelector('.close-modal');
        const cancelBtn = document.getElementById('cancelApplicationBtn');

        if (openBtn) {
            openBtn.addEventListener('click', () => {
                modal.style.display = 'block';
            });
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                modal.style.display = 'none';
            });
        }

        if (cancelBtn) {
            cancelBtn.addEventListener('click', () => {
                modal.style.display = 'none';
            });
        }

        
        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>

    <script src="../js/main.js"></script>
    <script src="../js/petinfo.js"></script>
</body>
</html>