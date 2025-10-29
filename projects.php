<?php
// projects.php
require_once 'config.php';

$projects = $db->getProjects();
$page_title = "Projects | " . $db->getSetting('site_title');
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

    <!-- Projects Section -->
    <section class="projects" id="projects">
        <div class="container">
            <h2>My Projects</h2>
            
            <?php if(!empty($projects)): ?>
                <div class="projects-container">
                    <?php foreach($projects as $project): ?>
                        <?php 
                        // Safe array access with null coalescing operator
                        $title = $project['title'] ?? 'Untitled Project';
                        $description = $project['description'] ?? 'No description available.';
                        $technologies = $project['technologies'] ?? 'Not specified';
                        $live_link = $project['live_link'] ?? '#';
                        $code_link = $project['code_link'] ?? '#';
                        $color_gradient = $project['color_gradient'] ?? 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
                        $icon_class = $project['icon_class'] ?? 'fas fa-code';
                        $featured = $project['featured'] ?? 0;
                        ?>
                        
                        <div class="project-card">
                            <?php if($featured): ?>
                                <div class="featured-badge">⭐ Featured</div>
                            <?php endif; ?>
                            
                            <div class="project-img" style="background: <?php echo $color_gradient; ?>;">
                                <i class="<?php echo htmlspecialchars($icon_class); ?>"></i>
                            </div>
                            <div class="project-content">
                                <h3><?php echo htmlspecialchars($title); ?></h3>
                                <p><?php echo htmlspecialchars($description); ?></p>
                                <div class="project-tech">
                                    <?php 
                                    $tech_array = explode(',', $technologies);
                                    foreach($tech_array as $tech): 
                                    ?>
                                        <span class="tech-tag"><?php echo htmlspecialchars(trim($tech)); ?></span>
                                    <?php endforeach; ?>
                                </div>
                                <div class="project-links">
                                    <?php if($live_link && $live_link != '#'): ?>
                                        <a href="<?php echo htmlspecialchars($live_link); ?>" target="_blank" class="btn">
                                            <i class="fas fa-external-link-alt"></i> Live Demo
                                        </a>
                                    <?php endif; ?>
                                    
                                    <?php if($code_link && $code_link != '#'): ?>
                                        <a href="<?php echo htmlspecialchars($code_link); ?>" class="btn btn-outline">
                                            <i class="fab fa-github"></i> Code
                                        </a>
                                    <?php endif; ?>
                                    
                                    <button class="btn btn-outline view-details" 
                                            data-id="<?php echo $project['id']; ?>"
                                            data-title="<?php echo htmlspecialchars($title); ?>"
                                            data-description="<?php echo htmlspecialchars($description); ?>"
                                            data-detailed="<?php echo htmlspecialchars($project['detailed_description'] ?? 'No detailed description available.'); ?>"
                                            data-technologies="<?php echo htmlspecialchars($technologies); ?>"
                                            data-live-link="<?php echo htmlspecialchars($live_link); ?>"
                                            data-code-link="<?php echo htmlspecialchars($code_link); ?>">
                                        <i class="fas fa-info-circle"></i> Details
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-projects">
                    <i class="fas fa-folder-open" style="font-size: 4rem; color: var(--primary); margin-bottom: 20px;"></i>
                    <h3>No Projects Found</h3>
                    <p>Projects will be displayed here once they are added to the database.</p>
                    <p style="margin-top: 10px; font-size: 0.9rem; color: var(--secondary);">
                        <a href="admin_projects.php" style="color: var(--primary);">Add projects through the admin panel</a>
                    </p>
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
    
    <script>
        // Project details modal functionality
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('projectModal');
            const closeModal = document.getElementById('closeModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalContent = document.getElementById('modalContent');
            
            // View details buttons
            document.querySelectorAll('.view-details').forEach(button => {
                button.addEventListener('click', function() {
                    const title = this.getAttribute('data-title');
                    const description = this.getAttribute('data-description');
                    const detailed = this.getAttribute('data-detailed');
                    const technologies = this.getAttribute('data-technologies');
                    const liveLink = this.getAttribute('data-live-link');
                    const codeLink = this.getAttribute('data-code-link');
                    
                    modalTitle.textContent = title;
                    
                    let techBadges = '';
                    if (technologies && technologies !== 'Not specified') {
                        const techArray = technologies.split(',');
                        techBadges = techArray.map(tech => 
                            `<span class="tech-tag">${tech.trim()}</span>`
                        ).join('');
                    }
                    
                    modalContent.innerHTML = `
                        <div style="margin-bottom: 20px;">
                            <h4 style="color: var(--primary); margin-bottom: 10px;">Description</h4>
                            <p>${description}</p>
                        </div>
                        
                        <div style="margin-bottom: 20px;">
                            <h4 style="color: var(--primary); margin-bottom: 10px;">Detailed Overview</h4>
                            <p>${detailed}</p>
                        </div>
                        
                        ${techBadges ? `
                        <div style="margin-bottom: 20px;">
                            <h4 style="color: var(--primary); margin-bottom: 10px;">Technologies Used</h4>
                            <div class="project-tech">${techBadges}</div>
                        </div>
                        ` : ''}
                        
                        <div class="project-links" style="margin-top: 25px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
                            ${liveLink && liveLink !== '#' ? `
                                <a href="${liveLink}" target="_blank" class="btn">
                                    <i class="fas fa-external-link-alt"></i> View Live Demo
                                </a>
                            ` : ''}
                            
                            ${codeLink && codeLink !== '#' ? `
                                <a href="${codeLink}" target="_blank" class="btn btn-outline">
                                    <i class="fab fa-github"></i> View Source Code
                                </a>
                            ` : ''}
                        </div>
                    `;
                    
                    modal.style.display = 'flex';
                });
            });
            
            // Close modal
            closeModal.addEventListener('click', function() {
                modal.style.display = 'none';
            });
            
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>