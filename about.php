<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | Rahulkumar Parmar</title>
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

    <!-- About Section -->
    <section class="about" id="about">
        <div class="container">
            <h2>About Me</h2>
            <div class="about-content">
                <div class="about-text">
                    <p>Hello! I'm Rahulkumar Parmar, a passionate Full Stack Developer with expertise in both front-end and back-end technologies. I enjoy creating digital solutions that are both functional and visually appealing.</p>
                    <p>My journey in web development started several years ago, and I've since worked with various technologies to build responsive websites and web applications. I'm constantly learning and adapting to new technologies to stay current in this rapidly evolving field.</p>
                    <p>When I'm not coding, you can find me exploring new frameworks, contributing to open-source projects, or expanding my knowledge in database management and server architecture.</p>
                    <a href="contact.html" class="btn">Get In Touch</a>
                </div>
                <div class="about-image">
                    <div class="about-img">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                </div>
            </div>
            
            <!-- Dynamic Counters -->
            <div class="counters-container">
                <div class="counter-item">
                    <div class="counter" data-target="15">0</div>
                    <p>Projects Completed</p>
                </div>
                <div class="counter-item">
                    <div class="counter" data-target="3">0</div>
                    <p>Years Experience</p>
                </div>
                <div class="counter-item">
                    <div class="counter" data-target="10">0</div>
                    <p>Happy Clients</p>
                </div>
                <div class="counter-item">
                    <div class="counter" data-target="5">0</div>
                    <p>Technologies</p>
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