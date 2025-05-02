<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Pet Adoption FAQs - AdoptiPet</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Delius&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <style>
        .faq-container {
            padding: 3rem;
            background-color: rgba(230, 227, 233, 0.818);
        }
        
        .faq-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .faq-header h1 {
            color: rgba(62, 16, 107, 0.818);
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .faq-item {
            background-color: white;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .faq-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .faq-question {
            font-weight: bold;
            font-size: 1.3rem;
            color: rgba(62, 16, 107, 0.818);
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }
        
        .faq-question span {
            color: #face18;
            font-weight: bold;
            font-size: 1.5rem;
        }
        
        .faq-answer {
            line-height: 1.6;
            color: #333;
        }
        
        .back-to-top {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }
        
        .back-to-top a {
            background-color: #face18;
            color: rgba(62, 16, 107, 0.818);
            font-weight: bold;
            padding: 0.8rem 1.5rem;
            border-radius: 30px;
            text-decoration: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .back-to-top a:hover {
            transform: scale(1.1);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .faq-categories {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        
        .category-btn {
            background-color: #face18;
            color: rgba(62, 16, 107, 0.818);
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 30px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .category-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .category-btn.active {
            background-color: rgba(62, 16, 107, 0.818);
            color: white;
        }
        
        .hidden {
            display: none;
        }
    </style>
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
                <img class="logo-pic" src="../img/logo-nobg.png">
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

    <section>
        <div class="text">
            <h1>Frequently Asked Questions</h1>
            <div class="pic"></div>
        </div>
    </section>

    <section class="faq-container">
        <div class="faq-header">
            <h1>Pet Adoption FAQs</h1>
            <p>Find answers to your most common questions about adopting a pet.</p>
        </div>

        <div class="faq-categories">
            <button class="category-btn active" data-category="all">All Questions</button>
            <button class="category-btn" data-category="process">Adoption Process</button>
            <button class="category-btn" data-category="fees">Fees & Costs</button>
            <button class="category-btn" data-category="home">Home Preparation</button>
            <button class="category-btn" data-category="after">After Adoption</button>
        </div>

        
        <div class="faq-item" data-category="process">
            <div class="faq-question">
                How do I adopt a pet from AdoptiPet? <span>+</span>
            </div>
            <div class="faq-answer">
                <p>To adopt a pet from AdoptiPet, follow these steps:</p>
                <ol>
                    <li>Browse available pets on our website</li>
                    <li>Create an account or sign in</li>
                    <li>Submit an adoption application for your chosen pet</li>
                    <li>Schedule a meet-and-greet with the pet</li>
                    <li>Complete the adoption process by signing the agreement and paying the adoption fee</li>
                    <li>Take your new furry friend home!</li>
                </ol>
                <p>Our team will guide you through each step of the process to ensure a smooth adoption experience.</p>
            </div>
        </div>

        <div class="faq-item" data-category="process">
            <div class="faq-question">
                What are the requirements to adopt a pet? <span>+</span>
            </div>
            <div class="faq-answer">
                <p>The basic requirements for adopting a pet include:</p>
                <ul>
                    <li>Being at least 18 years old</li>
                    <li>Valid identification</li>
                    <li>Proof of residence (if you rent, you may need landlord approval)</li>
                    <li>Completing our adoption application</li>
                    <li>Household meet-and-greet (for some animals)</li>
                </ul>
                <p>Additional requirements may apply depending on the specific pet and your living situation. Our goal is to ensure each pet goes to a loving, suitable home.</p>
            </div>
        </div>

        <div class="faq-item" data-category="process">
            <div class="faq-question">
                How long does the adoption process take? <span>+</span>
            </div>
            <div class="faq-answer">
                <p>The adoption process typically takes 1-7 days, depending on several factors:</p>
                <ul>
                    <li>How quickly you complete the application</li>
                    <li>The time needed for application review</li>
                    <li>Scheduling of meet-and-greets</li>
                    <li>Any additional requirements specific to the pet</li>
                </ul>
                <p>We strive to make the process as efficient as possible while ensuring each pet finds the right home.</p>
            </div>
        </div>

        
        <div class="faq-item" data-category="fees">
            <div class="faq-question">
                What are the adoption fees? <span>+</span>
            </div>
            <div class="faq-answer">
                <p>Our adoption fees vary by animal type and age:</p>
                <ul>
                    <li>Cats: 100-250 TND</li>
                    <li>Dogs: 150-350 TND</li>
                    <li>Other small animals: 50-150 TND</li>
                </ul>
                <p>These fees help cover veterinary care, vaccinations, spay/neuter procedures, microchipping, and other costs associated with caring for the animals before adoption.</p>
            </div>
        </div>

        <div class="faq-item" data-category="fees">
            <div class="faq-question">
                What is included in the adoption fee? <span>+</span>
            </div>
            <div class="faq-answer">
                <p>Your adoption fee typically includes:</p>
                <ul>
                    <li>Spay/neuter surgery</li>
                    <li>Up-to-date vaccinations</li>
                    <li>Deworming treatment</li>
                    <li>Flea/tick prevention</li>
                    <li>Microchipping</li>
                    <li>Initial health check</li>
                    <li>30 days of pet health insurance (where available)</li>
                </ul>
                <p>This represents significant value compared to obtaining these services separately after adoption.</p>
            </div>
        </div>

        <div class="faq-item" data-category="fees">
            <div class="faq-question">
                What ongoing costs should I expect with a new pet? <span>+</span>
            </div>
            <div class="faq-answer">
                <p>When budgeting for a new pet, consider these ongoing expenses:</p>
                <ul>
                    <li>Food (monthly)</li>
                    <li>Regular veterinary check-ups (annually)</li>
                    <li>Vaccinations (annually or as recommended)</li>
                    <li>Parasite prevention (monthly)</li>
                    <li>Grooming (varies by pet type)</li>
                    <li>Toys and enrichment items</li>
                    <li>Pet insurance (optional but recommended)</li>
                    <li>Emergency medical fund</li>
                </ul>
                <p>Monthly costs typically range from 50-300 TND depending on the size and type of pet, with additional annual veterinary costs of 100-500 TND.</p>
            </div>
        </div>

        
        <div class="faq-item" data-category="home">
            <div class="faq-question">
                How should I prepare my home for a new pet? <span>+</span>
            </div>
            <div class="faq-answer">
                <p>To prepare your home for a new pet:</p>
                <ol>
                    <li><strong>Pet-proof your space:</strong> Remove hazards like toxic plants, chemicals, small objects that could be swallowed, and secure loose wires</li>
                    <li><strong>Gather essential supplies:</strong> Food/water bowls, appropriate food, bed, crate/carrier, collar, leash, toys, and grooming tools</li>
                    <li><strong>Designate pet areas:</strong> Set up feeding stations, bed/crate locations, and litter boxes (for cats) in quiet, low-traffic areas</li>
                    <li><strong>Consider barriers:</strong> Baby gates can help restrict access to certain areas initially</li>
                    <li><strong>Purchase cleaning supplies:</strong> Enzymatic cleaners work best for pet accidents</li>
                </ol>
                <p>Remember that your new pet will need time to adjust, so create a calm, safe environment for their arrival.</p>
            </div>
        </div>

        <div class="faq-item" data-category="home">
            <div class="faq-question">
                Is it better to adopt a puppy/kitten or an adult pet? <span>+</span>
            </div>
            <div class="faq-answer">
                <p>Both young and adult pets have their advantages:</p>
                
                <p><strong>Puppies/Kittens:</strong></p>
                <ul>
                    <li>You can shape their training from the beginning</li>
                    <li>Grow up with your family and adapt to your lifestyle</li>
                    <li>Longer time together as part of your family</li>
                </ul>
                <p><strong>However:</strong> They require more time, training, socialization, and patience. They may have more energy and need closer supervision.</p>
                
                <p><strong>Adult Pets:</strong></p>
                <ul>
                    <li>Personality and size are already established</li>
                    <li>Often already trained and socialized</li>
                    <li>Generally calmer and require less intensive supervision</li>
                    <li>May be more settled and adjust quickly to home routines</li>
                </ul>
                
                <p>The best choice depends on your lifestyle, time availability, experience with pets, and what energy level matches your household.</p>
            </div>
        </div>

        <div class="faq-item" data-category="home">
            <div class="faq-question">
                Can I adopt if I rent my home? <span>+</span>
            </div>
            <div class="faq-answer">
                <p>Yes, renters can adopt pets, but you'll need to:</p>
                <ul>
                    <li>Provide proof of landlord approval for pet ownership</li>
                    <li>Show your lease agreement section that allows pets or get written permission</li>
                    <li>Be aware of any pet deposits, monthly pet rent, or restrictions on size/breed</li>
                </ul>
                <p>We require this documentation to ensure that both you and your new pet won't face housing issues after adoption. Many landlords are pet-friendly but may have specific requirements, so it's important to clarify these details before beginning the adoption process.</p>
            </div>
        </div>

        
        <div class="faq-item" data-category="after">
            <div class="faq-question">
                How long will it take my new pet to adjust to their new home? <span>+</span>
            </div>
            <div class="faq-answer">
                <p>The adjustment period varies for each pet but typically follows this timeline:</p>
                <ul>
                    <li><strong>First 3 days:</strong> Your pet may be overwhelmed and scared, possibly hiding or showing little personality</li>
                    <li><strong>First 3 weeks:</strong> Your pet begins to relax, showing more personality and establishing a routine</li>
                    <li><strong>First 3 months:</strong> Your pet becomes fully comfortable, learning house rules and forming strong bonds</li>
                </ul>
                <p>This is known as the "3-3-3 rule" in pet adoption. Some pets adjust faster, while others (especially those with trauma histories) may take longer. Patience, consistency, and positive reinforcement are key during this transition period.</p>
            </div>
        </div>

        <div class="faq-item" data-category="after">
            <div class="faq-question">
                What if the adoption doesn't work out? <span>+</span>
            </div>
            <div class="faq-answer">
                <p>If you're experiencing challenges with your newly adopted pet:</p>
                <ol>
                    <li><strong>Contact us first:</strong> Our team can provide resources, training tips, or behavior support</li>
                    <li><strong>Consider professional help:</strong> Many issues can be resolved with proper training or veterinary care</li>
                    <li><strong>Give adjustment time:</strong> Many challenges resolve as pets settle into their new homes</li>
                </ol>
                <p>If despite all efforts, the adoption truly isn't working out, we accept returns of our adopted animals. We ask that you contact us directly rather than rehoming the pet yourself or surrendering to another shelter. Our goal is always to find the right permanent match for each pet.</p>
            </div>
        </div>

        <div class="faq-item" data-category="after">
            <div class="faq-question">
                How do I introduce a new pet to existing pets? <span>+</span>
            </div>
            <div class="faq-answer">
                <p>Introducing pets properly is crucial for harmonious relationships:</p>
                
                <p><strong>For Dogs Meeting Dogs:</strong></p>
                <ol>
                    <li>Start with a neutral location outside the home</li>
                    <li>Keep both dogs leashed initially</li>
                    <li>Allow brief sniffing, then separate before any tension</li>
                    <li>Gradually increase time together with positive reinforcement</li>
                    <li>Supervise all interactions for the first few weeks</li>
                </ol>
                
                <p><strong>For Cats Meeting Cats:</strong></p>
                <ol>
                    <li>Set up a separate room for the new cat with all necessities</li>
                    <li>Allow pets to smell each other under the door for several days</li>
                    <li>Swap bedding to exchange scents</li>
                    <li>Use a baby gate for visual introduction without physical contact</li>
                    <li>Gradually allow supervised time together, increasing duration slowly</li>
                </ol>
                
                <p><strong>For Dogs Meeting Cats:</strong></p>
                <ol>
                    <li>Keep the dog leashed and the cat free to approach or retreat</li>
                    <li>Ensure the cat has escape routes and high places</li>
                    <li>Reward calm behavior from both animals</li>
                    <li>Never force interactions</li>
                </ol>
                
                <p>Remember that proper introductions may take days or weeks, not hours. Patience leads to better long-term relationships between pets.</p>
            </div>
        </div>

        <div class="back-to-top">
            <a href="#" id="backToTop">Back to Top</a>
        </div>
    </section>

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
    <script>
        
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', () => {
                const answer = question.nextElementSibling;
                const isOpen = answer.style.display === 'block';
                
                
                answer.style.display = isOpen ? 'none' : 'block';
                question.querySelector('span').textContent = isOpen ? '+' : '-';
            });
        });

        
        document.querySelectorAll('.faq-answer').forEach(answer => {
            answer.style.display = 'none';
        });

        
        document.querySelectorAll('.category-btn').forEach(button => {
            button.addEventListener('click', () => {
                
                document.querySelectorAll('.category-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                
                
                button.classList.add('active');
                
                const category = button.getAttribute('data-category');
                
                
                document.querySelectorAll('.faq-item').forEach(item => {
                    if (category === 'all' || item.getAttribute('data-category') === category) {
                        item.classList.remove('hidden');
                    } else {
                        item.classList.add('hidden');
                    }
                });
            });
        });

        
        document.getElementById('backToTop').addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</body>
</html>