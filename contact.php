<?php
// contact.php
require_once 'config.php';

$page_title = "Contact | " . $db->getSetting('site_title');

// Handle form submission
$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    // Basic validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error_message = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Please enter a valid email address.";
    } else {
        // Save to database
        if ($db->saveContactMessage($name, $email, $subject, $message)) {
            $success_message = "Thank you for your message! I'll get back to you soon.";
            
            // Clear form fields
            $_POST = array();
        } else {
            $error_message = "Sorry, there was an error sending your message. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
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

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="container">
            <h2>Contact Me</h2>
            
            <?php if ($success_message): ?>
                <div class="message success" style="background: #d1fae5; color: #065f46; padding: 15px; border-radius: 8px; margin-bottom: 30px; border: 1px solid #a7f3d0;">
                    <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($success_message); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($error_message): ?>
                <div class="message error" style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 30px; border: 1px solid #fecaca;">
                    <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>
            
            <div class="contact-container">
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-text">
                            <h4>Email</h4>
                            <p>rp2358005@gmail.com</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-text">
                            <h4>Phone</h4>
                            <p>+91 9429976866</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fab fa-linkedin"></i>
                        </div>
                        <div class="contact-text">
                            <h4>LinkedIn</h4>
                            <p>linkedin.com/in/rahul-parmar-880ba2272</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fab fa-github"></i>
                        </div>
                        <div class="contact-text">
                            <h4>GitHub</h4>
                            <p>github.com/ParmarRahul7765</p>
                        </div>
                    </div>
                </div>
                <div class="contact-form">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <div class="form-group">
                            <label for="name">Your Name *</label>
                            <input type="text" id="name" name="name" class="form-control" 
                                   placeholder="Enter your name" required
                                   value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Your Email *</label>
                            <input type="email" id="email" name="email" class="form-control" 
                                   placeholder="Enter your email" required
                                   value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject *</label>
                            <input type="text" id="subject" name="subject" class="form-control" 
                                   placeholder="Enter subject" required
                                   value="<?php echo htmlspecialchars($_POST['subject'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="message">Your Message *</label>
                            <textarea id="message" name="message" class="form-control" 
                                      placeholder="Enter your message" required
                                      rows="5"><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                        </div>
                        <button type="submit" class="btn">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </button>
                    </form>
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