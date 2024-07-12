<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'header.php'?>

    <img src="assets/images/banner2.jpg" alt="Banner Image" class="banner">

    <!-- https://worldpostalcode.com/sri-lanka/ -->

    <!-- Centered Text -->
    <div class="centered-text">
        <h1>Welcome to Post Code Manager</h1>
        <p>Manage your post codes efficiently with our app.</p>
    </div>

     <!-- Image Boxes -->
     <div class="image-boxes">
        <div class="image-box">
            <img src="assets/images/image1.jpg" alt="Image Box 1">
        </div>
        <div class="image-box">
            <img src="assets/images/image2.jpg" alt="Image Box 2">
        </div>
        <div class="image-box">
            <img src="assets/images/image3.jpg" alt="Image Box 3">
        </div>
    </div>

    <!-- Additional Content Section -->
    <div class="additional-content">
        <!-- <h2>Welcome to Post Code Manager</h2> -->
        <p><b><center>Effortlessly manage and explore postal codes with our comprehensive platform. Whether you're looking to find detailed information about a specific postal code or calculate the distance between two locations, we have the tools you need</center></b></p>

        <h3>What is a Postal Code?</h3>
        <p>A postal code (also known locally in various English-speaking countries throughout the world as a postcode, ZIP Code, or PIN) is a series of letters, numbers, or both, assigned to a geographic area to facilitate the sorting of mail. They are crucial for efficient mail delivery and are also used for identifying locations in various data systems.</p>
        <p>Reference:</p>
        <ul>
            <li><a href="https://en.wikipedia.org/wiki/Postal_code" target="_blank">"Postal Codes Around the World", Wikipedia</a></li>
        </ul>

        <h3>Why Manage Postal Codes?</h3>
        <p>Managing postal codes is essential for businesses and individuals alike. Here are a few reasons why:</p>
        <ul>
            <li><strong>Efficient Mail Delivery:</strong> Accurate postal code information ensures that mail and packages reach their intended destinations promptly.</li>
            <li><strong>Data Accuracy:</strong> Proper management of postal codes helps maintain accurate records for various applications, including customer databases and geographic information systems (GIS).</li>
            <li><strong>Logistics and Planning:</strong> Businesses can optimize delivery routes, reduce transportation costs, and improve service delivery by effectively managing postal codes.</li>
        </ul>
        <p>Reference:</p>
        <ul>
            <li><a href="https://www.logisticsbureau.com/the-importance-of-postal-codes-in-modern-logistics/" target="_blank">"The Importance of Postal Codes in Modern Logistics", Logistics Bureau</a></li>
        </ul>

        <h3>Distance Calculation Between Postal Codes</h3>
        <p>One of the unique features of our platform is the ability to calculate the distance between two postal codes. This feature is particularly useful for logistics companies, delivery services, and anyone needing to plan routes or estimate travel times.</p>
        <p>Our distance calculation tool uses the Haversine formula, which calculates the shortest distance between two points on the Earth's surface, giving you an accurate measurement of the distance between any two postal codes.</p>
        <p>Reference:</p>
        <ul>
            <li><a href="https://gisgeography.com/haversine-formula-calculate-geographic-distance/" target="_blank">"Haversine Formula - Calculate Geographic Distance", GIS Geography</a></li>
        </ul>

        <h3>How to Use Our Platform</h3>
        <ul>
            <li><strong>Search for a Postal Code:</strong> Enter the postal code you wish to find information about. Our database will provide detailed information, including location, region, and other relevant data.</li>
            <li><strong>Calculate Distance:</strong> Input two postal codes into our distance calculator to get the distance between them. This can help with planning deliveries, travel, and more.</li>
            <li><strong>Manage Your Data:</strong> Save and manage postal code data for easy access and efficient workflow management.</li>
        </ul>

        <h3>Join Us Today</h3>
        <p>Join thousands of satisfied users who rely on our platform for accurate postal code management and distance calculations. Sign up today and start exploring the benefits!</p>
        <p>Reference:</p>
        <ul>
            <li><a href="https://www.globaldatamanagement.com/benefits-of-efficient-postal-code-management/" target="_blank">"Benefits of Efficient Postal Code Management", Global Data Management</a></li>
        </ul>
    </div>

    <!-- <div class="image-slider">
        <div class="slides">
            <div class="slide">
                <img src="assets/images/slider1.jpg" alt="Image 1">
            </div>
            <div class="slide">
                <img src="assets/images/slider2.jpg" alt="Image 2">
            </div>
            <div class="slide">
                <img src="assets/images/slider3.jpg" alt="Image 3">
            </div>
        </div>
        <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
        <button class="next" onclick="changeSlide(1)">&#10095;</button>
    </div> -->
    
    <?php include 'footer.php'?>

    <script src="js/scripts.js"></script>
</body>
</html>
