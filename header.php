<?php
// header.php
require_once 'config.php';

$navigation = $db->getNavigationMenu();
$current_page = basename($_SERVER['PHP_SELF']);
$logo_text = $db->getSetting('logo_text') ?? 'Rahul';
?>

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
            <a href="index.php" class="logo"><?php echo htmlspecialchars($logo_text); ?><span>Kumar</span></a>
            <ul class="nav-links">
                <?php foreach($navigation as $nav_item): ?>
                    <?php 
                    $menu_name = $nav_item['menu_name'] ?? 'Menu';
                    $menu_link = $nav_item['menu_link'] ?? '#';
                    ?>
                    <li>
                        <a href="<?php echo htmlspecialchars($menu_link); ?>" 
                           class="<?php echo ($current_page == $menu_link) ? 'active' : ''; ?>">
                            <?php echo htmlspecialchars($menu_name); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="hamburger">
                <i class="fas fa-bars"></i>
            </div>
        </nav>
    </div>
</header>