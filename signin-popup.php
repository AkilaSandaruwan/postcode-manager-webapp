
<?php if (!empty($error_message)): ?>
    <div class="popup-overlay" id="signinPopup" style="display: flex;">
<?php else: ?>
    <div class="popup-overlay" id="signinPopup">
<?php endif; ?>
    <div class="popup-container">
        <button class="close-btn" onclick="closePopup()">&times;</button>
        <h2>Sign In</h2>
        <?php if (isset($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form action="postcode.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="sign-in-form">Sign In</button>
        </form>
    </div>
</div>

<script>
    

    // Function to show the popup
    function showPopup() {
        document.getElementById('signinPopup').style.display = 'flex';
    }

    // Function to hide the popup
    function closePopup() {
        document.getElementById('signinPopup').style.display = 'none';
    }

    // Hide the popup when clicking outside of it
    window.onclick = function(event) {
        var popup = document.getElementById('signinPopup');
        if (event.target == popup) {
            popup.style.display = 'none';
        }
    }
</script>
