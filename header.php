<div class="header">
    <nav>
        <ul>
            <li><a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Home</a></li>
            <li><a href="postcode.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'postcode.php' ? 'active' : ''; ?>">Post Code Manager</a></li>
            <?php if (isset($_SESSION['username'])): ?>
                <li><a href="logout.php">Logout (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a></li>
            <?php else: ?>
                <li><a href="#" onclick="showPopup()">Sign In</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
