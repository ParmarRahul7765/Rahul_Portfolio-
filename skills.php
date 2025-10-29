<?php
// skills.php
require_once 'config.php';

$skills = $db->getSkills();
$page_title = "Skills | " . $db->getSetting('site_title');
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

    <!-- Skills Section -->
    <section class="skills" id="skills">
        <div class="container">
            <h2>My Skills</h2>
            
            <!-- Skills by Category -->
            <?php
            // Group skills by category
            $skills_by_category = [];
            foreach($skills as $skill) {
                $category = $skill['category'] ?? 'General';
                $skills_by_category[$category][] = $skill;
            }
            ?>
            
            <?php foreach($skills_by_category as $category => $category_skills): ?>
                <div class="skills-category">
                    <h3 style="text-align: left; margin: 40px 0 20px 0; color: var(--primary); border-bottom: 2px solid var(--primary); padding-bottom: 10px;">
                        <?php echo htmlspecialchars($category); ?>
                    </h3>
                    <div class="skills-container">
                        <?php foreach($category_skills as $skill): ?>
                            <?php 
                            // Safe array access with null coalescing operator
                            $skill_name = $skill['name'] ?? 'Unknown Skill';
                            $skill_description = $skill['description'] ?? 'No description available.';
                            $skill_icon = $skill['icon_class'] ?? 'fas fa-code';
                            //$skill_level = $skill['proficiency'] ?? 50;
                            ?>
                            <div class="skill-card">
                                <div class="skill-icon">
                                    <i class="<?php echo htmlspecialchars($skill_icon); ?>"></i>
                                </div>
                                <h3><?php echo htmlspecialchars($skill_name); ?></h3>
                                <p><?php echo htmlspecialchars($skill_description); ?></p>
                                <!-- <div class="skill-bar">
                                    <div class="skill-progress" data-width="<?php echo (int)$skill_level; ?>"></div>
                                </div> -->
                             <!-- <div class="skill-level"><?php echo (int)$skill_level; ?>%</div> -->
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <?php if(empty($skills)): ?>
                <div class="no-skills">
                    <i class="fas fa-exclamation-circle" style="font-size: 3rem; color: var(--primary); margin-bottom: 20px;"></i>
                    <h3>No Skills Found</h3>
                    <p>Skills data will be displayed here once added to the database.</p>
                </div>
            <?php endif; ?>
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

    <!-- Project Details Modal -->
    <div class="modal" id="projectModal">
        <div class="modal-content">
            <span class="close-modal" id="closeModal">&times;</span>
            <h2 id="modalTitle">Project Title</h2>
            <div id="modalContent">
                <!-- Project details will be loaded here -->
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>