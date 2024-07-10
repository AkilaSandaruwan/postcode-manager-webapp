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
    <div class="image-slider">
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
    </div>
    
    <?php include 'footer.php'?>

    <script src="js/scripts.js"></script>
</body>
</html>
