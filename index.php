<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rahulkumar Parmar | Full Stack Developer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Progress Bar -->
    <div class="progress-bar" id="progressBar"></div>

    <!-- Theme Toggle -->
    <div class="theme-toggle" id="themeToggle">
        <i class="fas fa-moon"></i>
    </div>

    <!-- Header & Navigation -->
    <header>
        <div class="container">
            <nav>
                <a href="index.php" class="logo">Rahul<span>Kumar</span></a>
                <ul class="nav-links">
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="skills.php">Skills</a></li>
                    <li><a href="projects.php">Projects</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
                <div class="hamburger">
                    <i class="fas fa-bars"></i>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Rahulkumar Parmar</h1>
                    <h2><span class="typing-text" id="typingText"></span></h2>
                    <p>I create responsive, user-friendly websites and applications using modern technologies. Passionate about clean code and innovative solutions.</p>
                    <div class="hero-btns">
                        <a href="projects.html" class="btn">View My Work</a>
                        <a href="contact.html" class="btn btn-outline">Contact Me</a>
                    </div>
                </div>
                <div class="hero-image">
                    <div class="profile-img">
                         <img src="images/rahul.jpg" alt="Rahulkumar Parmar - Full Stack Developer">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <a href="index.html" class="logo" style="color: white;">Rahul<span style="color: #94a3b8;">Kumar</span></a>
                <p>Full Stack Developer</p>
                <div class="social-links">
                    <a href="https://www.linkedin.com/in/rahul-parmar-880ba2272" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a href="https://github.com/ParmarRahul7765" target="_blank"><i class="fab fa-github"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
                <div class="copyright">
                    <p>&copy; <span id="currentYear"></span> Rahulkumar Parmar. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>