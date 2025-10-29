<?php
// config.php
class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'portfolio_admin';
    public $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Database Connection failed: " . $e->getMessage());
        }
    }


    
    // ==================== SKILLS METHODS ====================
    
    // Fetch all skills with new column names
    public function getSkills() {
        try {
            $sql = "SELECT * FROM skills WHERE is_active = 1 ORDER BY display_order ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $skills = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Validate skill data structure
            foreach ($skills as &$skill) {
                $skill = $this->validateSkillData($skill);
            }
            
            return $skills;
        } catch(PDOException $e) {
            error_log("Error fetching skills: " . $e->getMessage());
            return $this->getDefaultSkills();
        }
    }

    // Validate and ensure all required skill fields exist
    private function validateSkillData($skill) {
        $defaults = [
            'name' => 'Unknown Skill',
            'category' => 'General',
            'description' => 'No description available.',
            'icon_class' => 'fas fa-code',
            'proficiency' => 50,
            'display_order' => 1,
            'is_active' => 1
        ];
        
        foreach ($defaults as $key => $value) {
            if (!isset($skill[$key]) || empty($skill[$key])) {
                $skill[$key] = $value;
            }
        }
        
        return $skill;
    }

    // ==================== PROJECTS METHODS ====================
    
    // Fetch all active projects
    public function getProjects() {
        try {
            $sql = "SELECT * FROM projects WHERE is_active = 1 ORDER BY featured DESC, display_order ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Validate project data structure
            foreach ($projects as &$project) {
                $project = $this->validateProjectData($project);
            }
            
            return $projects;
        } catch(PDOException $e) {
            error_log("Error fetching projects: " . $e->getMessage());
            return $this->getDefaultProjects();
        }
    }

    // Fetch featured projects
    public function getFeaturedProjects() {
        try {
            $sql = "SELECT * FROM projects WHERE is_active = 1 AND featured = 1 ORDER BY display_order ASC LIMIT 3";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Error fetching featured projects: " . $e->getMessage());
            return [];
        }
    }

    // Validate project data
    private function validateProjectData($project) {
        $defaults = [
            'title' => 'Untitled Project',
            'description' => 'No description available.',
            'detailed_description' => 'Detailed description not available.',
            'technologies' => 'Not specified',
            'live_link' => '#',
            'code_link' => '#',
            'color_gradient' => 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
            'icon_class' => 'fas fa-code',
            'display_order' => 1,
            'featured' => 0
        ];
        
        foreach ($defaults as $key => $value) {
            if (!isset($project[$key]) || empty($project[$key])) {
                $project[$key] = $value;
            }
        }
        
        return $project;
    }

    // Default projects fallback
    private function getDefaultProjects() {
        return [
            [
                'title' => 'Sample Project',
                'description' => 'This is a sample project description.',
                'detailed_description' => 'Detailed description of the sample project.',
                'technologies' => 'HTML,CSS,JavaScript',
                'live_link' => '#',
                'code_link' => '#',
                'color_gradient' => 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                'icon_class' => 'fas fa-code'
            ]
        ];
    }

    // ==================== CONTACT MESSAGES METHODS ====================
    
    // Save contact message to database
     public function saveContactMessage($name, $email, $subject, $message) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO contact_messages (name, email, subject, message, created_at) VALUES (?, ?, ?, ?, NOW())");
            return $stmt->execute([$name, $email, $subject, $message]);
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }
    
    public function getAllContactMessages() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM contact_messages ORDER BY created_at DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return [];
        }
    }
    
    public function getUnreadMessageCount() {
        try {
            $stmt = $this->conn->prepare("SELECT COUNT(*) as count FROM contact_messages WHERE is_read = 0");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return 0;
        }
    }
    
    public function markMessageAsRead($id) {
        try {
            $stmt = $this->conn->prepare("UPDATE contact_messages SET is_read = 1 WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }

    // ==================== GENERAL METHODS ====================
    
    // Fetch navigation menu
    public function getNavigationMenu() {
        try {
            $sql = "SELECT * FROM navigation_menu WHERE is_active = TRUE ORDER BY display_order ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Error fetching navigation: " . $e->getMessage());
            return $this->getDefaultNavigation();
        }
    }

    // Fetch social links
    public function getSocialLinks() {
        try {
            $sql = "SELECT * FROM social_links ORDER BY display_order ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Error fetching social links: " . $e->getMessage());
            return $this->getDefaultSocialLinks();
        }
    }

    // Fetch site setting
    public function getSetting($key) {
        try {
            $sql = "SELECT setting_value FROM site_settings WHERE setting_key = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$key]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['setting_value'] : $this->getDefaultSetting($key);
        } catch(PDOException $e) {
            error_log("Error fetching setting {$key}: " . $e->getMessage());
            return $this->getDefaultSetting($key);
        }
    }

    // ==================== DEFAULT DATA FALLBACKS ====================
    
    // Default skills fallback
    private function getDefaultSkills() {
        return [
            [
                'name' => 'HTML',
                'category' => 'Frontend',
                'description' => 'Semantic markup, accessibility, and modern HTML5 features.',
                'icon_class' => 'fab fa-html5',
                'proficiency' => 95
            ],
            [
                'name' => 'CSS', 
                'category' => 'Frontend',
                'description' => 'Responsive design, Flexbox, Grid, animations, and CSS frameworks.',
                'icon_class' => 'fab fa-css3-alt',
                'proficiency' => 90
            ],
            [
                'name' => 'JavaScript',
                'category' => 'Frontend',
                'description' => 'ES6+, DOM manipulation, AJAX, and modern JS frameworks.',
                'icon_class' => 'fab fa-js-square', 
                'proficiency' => 85
            ]
        ];
    }

    // Default navigation fallback
    private function getDefaultNavigation() {
        return [
            ['menu_name' => 'Home', 'menu_link' => 'index.php'],
            ['menu_name' => 'About', 'menu_link' => 'about.php'],
            ['menu_name' => 'Skills', 'menu_link' => 'skills.php'],
            ['menu_name' => 'Projects', 'menu_link' => 'projects.php'],
            ['menu_name' => 'Contact', 'menu_link' => 'contact.php']
        ];
    }

    // Default social links fallback
    private function getDefaultSocialLinks() {
        return [
            [
                'platform_name' => 'LinkedIn', 
                'platform_url' => 'https://www.linkedin.com/in/rahul-parmar-880ba2272', 
                'platform_icon' => 'fab fa-linkedin'
            ],
            [
                'platform_name' => 'GitHub', 
                'platform_url' => 'https://github.com/ParmarRahul7765', 
                'platform_icon' => 'fab fa-github'
            ]
        ];
    }

    // Default settings fallback
    private function getDefaultSetting($key) {
        $defaults = [
            'site_title' => 'Rahulkumar Parmar | Full Stack Developer',
            'logo_text' => 'Rahul',
            'footer_text' => 'Full Stack Developer',
            'copyright_text' => 'Rahulkumar Parmar. All Rights Reserved.'
        ];
        return $defaults[$key] ?? '';
    }
}

// Initialize database - THIS SHOULD BE THE ONLY LINE OUTSIDE THE CLASS
$db = new Database();
?>