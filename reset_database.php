<?php
// reset_database.php
$host = 'localhost';
$username = 'root';
$password = '';

try {
    // Connect to MySQL
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Drop and recreate database
    $pdo->exec("DROP DATABASE IF EXISTS portfolio_admin");
    $pdo->exec("CREATE DATABASE portfolio_admin");
    $pdo->exec("USE portfolio_admin");

    // Create skills table with correct structure
    $pdo->exec("CREATE TABLE skills (
        id INT AUTO_INCREMENT PRIMARY KEY,
        skill_name VARCHAR(100) NOT NULL,
        skill_description TEXT,
        skill_icon VARCHAR(50),
        skill_level INT,
        display_order INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // Create navigation_menu table
    $pdo->exec("CREATE TABLE navigation_menu (
        id INT AUTO_INCREMENT PRIMARY KEY,
        menu_name VARCHAR(50) NOT NULL,
        menu_link VARCHAR(100) NOT NULL,
        display_order INT,
        is_active BOOLEAN DEFAULT TRUE
    )");

    // Create social_links table
    $pdo->exec("CREATE TABLE social_links (
        id INT AUTO_INCREMENT PRIMARY KEY,
        platform_name VARCHAR(50) NOT NULL,
        platform_url VARCHAR(255) NOT NULL,
        platform_icon VARCHAR(50),
        display_order INT
    )");

    // Create site_settings table
    $pdo->exec("CREATE TABLE site_settings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        setting_key VARCHAR(100) NOT NULL,
        setting_value TEXT NOT NULL
    )");

    // Insert correct skills data
    $pdo->exec("INSERT INTO skills (skill_name, skill_description, skill_icon, skill_level, display_order) VALUES
        ('HTML', 'Semantic markup, accessibility, and modern HTML5 features.', 'fab fa-html5', 95, 1),
        ('CSS', 'Responsive design, Flexbox, Grid, animations, and CSS frameworks.', 'fab fa-css3-alt', 90, 2),
        ('JavaScript', 'ES6+, DOM manipulation, AJAX, and modern JS frameworks.', 'fab fa-js-square', 85, 3),
        ('SQL', 'Database design, queries, optimization, and management.', 'fas fa-database', 80, 4),
        ('PHP', 'Server-side scripting, Laravel framework, and API development.', 'fab fa-php', 85, 5)");

    // Insert navigation menu
    $pdo->exec("INSERT INTO navigation_menu (menu_name, menu_link, display_order) VALUES
        ('Home', 'index.php', 1),
        ('About', 'about.php', 2),
        ('Skills', 'skills.php', 3),
        ('Projects', 'projects.php', 4),
        ('Contact', 'contact.php', 5)");

    // Insert social links
    $pdo->exec("INSERT INTO social_links (platform_name, platform_url, platform_icon, display_order) VALUES
        ('LinkedIn', 'https://www.linkedin.com/in/rahul-parmar-880ba2272', 'fab fa-linkedin', 1),
        ('GitHub', 'https://github.com/ParmarRahul7765', 'fab fa-github', 2),
        ('Twitter', '#', 'fab fa-twitter', 3),
        ('Instagram', '#', 'fab fa-instagram', 4)");

    // Insert site settings
    $pdo->exec("INSERT INTO site_settings (setting_key, setting_value) VALUES
        ('site_title', 'Rahulkumar Parmar | Full Stack Developer'),
        ('logo_text', 'Rahul'),
        ('footer_text', 'Full Stack Developer'),
        ('copyright_text', 'Rahulkumar Parmar. All Rights Reserved.')");

    echo "✅ Database reset completed successfully!<br>";
    echo "✅ All tables created with correct structure.<br>";
    echo "✅ Sample data inserted.<br>";
    echo "<a href='skills.php' style='color: blue;'>🚀 Go to Skills Page</a><br>";
    echo "<small>Delete this file after running for security.</small>";

} catch(PDOException $e) {
    die("❌ Database setup failed: " . $e->getMessage());
}
?>