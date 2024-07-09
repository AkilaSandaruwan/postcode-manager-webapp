<!-- header.php -->
<div class="header">
    <nav>
        <ul>
            <li><a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Home</a></li>
            <li><a href="postcode.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'postcode.php' ? 'active' : ''; ?>">Post Code Manager</a></li>
            <li><a href="#" onclick="showPopup()">Sign In</a></li>
        </ul>
    </nav>
</div>
