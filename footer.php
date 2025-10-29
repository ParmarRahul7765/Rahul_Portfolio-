<?php
// footer.php
require_once 'config.php';

$social_links = $db->getSocialLinks();
$current_year = date('Y');
$logo_text = $db->getSetting('logo_text') ?? 'Rahul';
$footer_text = $db->getSetting('footer_text') ?? 'Full Stack Developer';
$copyright_text = $db->getSetting('copyright_text') ?? 'Rahulkumar Parmar. All Rights Reserved.';
?>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="footer-content">
            <a href="index.php" class="logo" style="color: white;">
                <?php echo htmlspecialchars($logo_text); ?>
                <span style="color: #94a3b8;">Kumar</span>
            </a>
            <p><?php echo htmlspecialchars($footer_text); ?></p>
            <div class="social-links">
                <?php foreach($social_links as $social): ?>
                    <?php 
                    $platform_name = $social['platform_name'] ?? 'Social';
                    $platform_url = $social['platform_url'] ?? '#';
                    $platform_icon = $social['platform_icon'] ?? 'fas fa-share-alt';
                    ?>
                    <a href="<?php echo htmlspecialchars($platform_url); ?>" 
                       target="_blank" 
                       title="<?php echo htmlspecialchars($platform_name); ?>">
                        <i class="<?php echo htmlspecialchars($platform_icon); ?>"></i>
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="copyright">
                <p>&copy; <?php echo $current_year; ?> <?php echo htmlspecialchars($copyright_text); ?></p>
            </div>
        </div>
    </div>
</footer>