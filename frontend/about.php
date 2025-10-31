<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Bina Adult Care</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Additional styles for About page */
        .about-hero {
            background: linear-gradient(rgba(74, 144, 226, 0.1), rgba(74, 144, 226, 0.1)),
                        url('../images/about-bg.jpg') center/cover;
            height: 50vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-top: 60px;
        }

        .about-content {
            padding: 4rem 0;
        }

        .about-section {
            margin-bottom: 3rem;
        }

        .about-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .value-card {
            background: var(--light-bg);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.html" class="logo">Bina Adult Care</a>
            <div class="menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
            <ul class="nav-links">
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html" class="active">About Us</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li class="admin-login"><a href="admin/login.html">Admin Login</a></li>
            </ul>
        </div>
    </nav>

    <!-- About Hero Section -->
    <section class="about-hero">
        <div class="hero-content">
            <h1>We Understand Caregiving — Because We've Lived It.</h1>
        </div>
    </section>

    <!-- About Content -->
    <div class="about-content">
        <div class="container">
            <div class="about-section">
                <h2>Our Story</h2>
                <p>As an organization founded and operated by individuals who have walked in your shoes, we intimately comprehend the intricate demands and emotional toll that caregiving can encompass. Our mission is to support, empower, and uplift caregivers with meaningful opportunities and compassionate understanding.</p>
            </div>

            <div class="about-section">
                <h2>Our Mission</h2>
                <p>To provide exceptional care services while creating meaningful career opportunities for passionate caregivers, fostering a community where both care recipients and caregivers thrive.</p>
            </div>

            <div class="about-section">
                <h2>Our Values</h2>
                <div class="about-grid">
                    <div class="value-card">
                        <h3>Compassion</h3>
                        <p>We approach every interaction with genuine care and understanding.</p>
                    </div>
                    <div class="value-card">
                        <h3>Excellence</h3>
                        <p>We strive for the highest standards in care and service delivery.</p>
                    </div>
                    <div class="value-card">
                        <h3>Integrity</h3>
                        <p>We conduct ourselves with honesty and transparency in all we do.</p>
                    </div>
                    <div class="value-card">
                        <h3>Empowerment</h3>
                        <p>We believe in enabling both our caregivers and clients to achieve their best.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

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