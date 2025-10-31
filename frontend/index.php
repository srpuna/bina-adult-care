<?php
// Add a PHP test variable
$pageTitle = "Bina Adult Care - Professional Caregiving Services";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="css/styles.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">Bina Adult Care</a>
            <div class="menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
            <ul class="nav-links">
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li class="admin-login"><a href="admin/login.html">Admin Login</a></li>
            </ul>
        </div>
    </nav>
<?php if(isset($_GET['page'])){

    echo "<div class='container'><h2> Hello World</h2></div>";
 }
else {?>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Owned, Operated, and Managed by Caregivers.</h1>
            <p>We look after your best interests, with a profound understanding of the challenges caregivers face firsthand.</p>
            <div class="hero-buttons">
                <a href="#join" class="btn primary">Join Our Team</a>
                <a href="#learn" class="btn secondary">Learn More</a>
            </div>
        </div>
    </section>

    <!-- Program Section -->
    <section class="program">
        <div class="container">
            <h2>Bina Adult Care: The Human Service and Home Health Workers Loan Repayment Program</h2>
            <p>Our employees are eligible through the Bina Adult care Program.</p>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits">
        <div class="container">
            <h2>Our Benefits</h2>
            <div class="benefits-grid">
                <div class="benefit-card">
                    <i class="fas fa-certificate"></i>
                    <h3>Certified Training and Education</h3>
                </div>
                <div class="benefit-card">
                    <i class="fas fa-dollar-sign"></i>
                    <h3>Industry-Leading Wages</h3>
                </div>
                <div class="benefit-card">
                    <i class="fas fa-piggy-bank"></i>
                    <h3>401(k) Plan</h3>
                </div>
                <div class="benefit-card">
                    <i class="fas fa-clock"></i>
                    <h3>Flexible Hours</h3>
                </div>
                <div class="benefit-card">
                    <i class="fas fa-award"></i>
                    <h3>Employee Recognition Programs</h3>
                </div>
                <div class="benefit-card">
                    <i class="fas fa-heart"></i>
                    <h3>Health Insurance</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Community Section -->
    <section class="community">
        <div class="container">
            <h2>Join Our Community</h2>
            <p>By choosing us, you're not just selecting a home care provider; you're joining a community of caregivers dedicated to making your life easier.</p>
            <a href="#apply" class="btn primary">Apply Now</a>
        </div>
    </section>
<?php } ?>
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Bina Adult Care</h3>
                    <p>Professional caregiving services with a personal touch.</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="services.html">Services</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contact Us</h3>
                    <p>Email: info@binaadultcare.com</p>
                    <p>Phone: (555) 123-4567</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Bina Adult Care. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>