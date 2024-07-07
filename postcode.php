<?php
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_postcode'])) {
        $postcode = $_POST['postcode'];
        $longitude = $_POST['longitude'];
        $latitude = $_POST['latitude'];

        if (addPostcode($postcode, $longitude, $latitude)) {
            echo "New record created successfully";
        } else {
            echo "Error: Unable to create record";
        }

        header("Location: postcode.php"); // Redirect back to the postcode page
        exit();
    } elseif (isset($_POST['delete_postcode'])) {
        $postcodeID = $_POST['postcodeID'];

        if (deletePostcode($postcodeID)) {
            echo "Record deleted successfully";
        } else {
            echo "Error: Unable to delete record";
        }

        header("Location: postcode.php"); // Redirect back to the postcode page
        exit();
    } elseif (isset($_POST['view_postcode'])) {
        $postcodeID = $_POST['postcodeID'];
        $postcodeDetails = fetchPostcodeDetails($postcodeID);
    }
}

// Fetch postcodes for displaying in the table
$postcodes = fetchPostcodes();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Code Page</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="header">
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="postcode.php" class="active">Post Code Manager</a></li>
                <li><a href="#" onclick="showSignInPopup()">Sign In</a></li>
            </ul>
        </nav>
    </div>
    <div class="content">
        <div class="postcode-calculator">
            <div class="postcode-input">
                <label for="postcode1">Post Code 1:</label>
                <input type="text" id="postcode1" class="textbox">
                <label for="postcode2">Post Code 2:</label>
                <input type="text" id="postcode2" class="textbox">
                <button class="calculate-button" onclick="calculateDistance()">Calculate</button>
                <label for="distance">Distance:</label>
                <input type="text" id="distance" class="textbox">
            </div>
        </div>
        <div class="postcode-form">
            <form action="postcode.php" method="POST">
                <label for="postcode">Post Code:</label>
                <input type="text" id="postcode" name="postcode" class="textbox" required>
                <label for="longitude">Longitude:</label>
                <input type="text" id="longitude" name="longitude" class="textbox" required>
                <label for="latitude">Latitude:</label>
                <input type="text" id="latitude" name="latitude" class="textbox" required>
                <button class="add-button" type="submit" name="add_postcode">Add Post Code</button>
            </form>
        </div>
        <div class="postcode-list">
            <h2>Post Code List</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>Post Code</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($postcodes)) {
                        foreach ($postcodes as $row) {
                            echo "<tr>
                                <td>" . $row["postcode"] . "</td>
                                <td>
                                    <form action='postcode.php' method='POST' style='display:inline;'>
                                        <input type='hidden' name='postcodeID' value='" . $row['postcodeID'] . "'>
                                        <button type='submit' name='view_postcode'>View</button>
                                    </form>
                                    <button>Edit</button>
                                    <form action='postcode.php' method='POST' style='display:inline;'>
                                        <input type='hidden' name='postcodeID' value='" . $row['postcodeID'] . "'>
                                        <button type='submit' name='delete_postcode'>Delete</button>
                                    </form>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>No postcodes available</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        if (isset($postcodeDetails)) {
            echo "<div class='postcode-details'>
            <h2>Post Code Details</h2>
            <p><strong>Post Code ID:</strong> " . htmlspecialchars($postcodeDetails['postcodeID']) . "</p>
            <p><strong>Post Code:</strong> " . htmlspecialchars($postcodeDetails['postcode']) . "</p>
            <p><strong>Longitude:</strong> " . htmlspecialchars($postcodeDetails['longitude']) . "</p>
            <p><strong>Latitude:</strong> " . htmlspecialchars($postcodeDetails['latitude']) . "</p>
        </div>";        
        }
        ?>
    </div>
    <script src="js/scripts.js"></script>
    <div class="footer">
        <p>Footer</p>
    </div>
</body>
</html>
