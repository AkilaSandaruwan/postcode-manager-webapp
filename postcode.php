<?php
session_start();
?>
<?php
include 'functions.php';

// Check if user is logged in
$userLoggedIn = isset($_SESSION['userID']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_postcode'])) {
        
        if (!isAuthenticated()) {
            header("Location: postcode.php?error=unauthorized");
            exit();
        }

        $postcode = $_POST['postcode'];
        $longitude = $_POST['longitude'];
        $latitude = $_POST['latitude'];

        if (!validatePostcode($postcode)) {
            header("Location: postcode.php?error=invalid_postcode");
            exit();
        }

        if (addPostcode($postcode, $longitude, $latitude)) {
            header("Location: postcode.php?success=1");
            exit();
        } else {
            header("Location: postcode.php?error=1");
            exit();
        }

        header("Location: postcode.php"); // Redirect back to the postcode page
        exit();
    } elseif (isset($_POST['sign-in-form'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Fetch user details
        $userDetails = getUserDetails($username);

        if ($userDetails) {
            if (password_verify($password, $userDetails['password'])) {
                // Password is correct, start a session
                $_SESSION['userID'] = $userDetails['userID'];
                $_SESSION['username'] = $username;
                header("Location: postcode.php");
                exit();
            } else {
                // Password is incorrect
                $error_message = "Invalid username or password";
            }
        } else {
            // No user found
            $error_message = "Invalid username or password";
        }
    } elseif (isset($_POST['delete_postcode'])) {

        if (!isAuthenticated()) {
            header("Location: postcode.php?error=unauthorized");
            exit();
        }

        $postcodeID = $_POST['postcodeID'];

        if (deletePostcode($postcodeID)) {
            header("Location: postcode.php?success=2");
            exit();
        } else {
            header("Location: postcode.php?error=2");
            exit();
        }

        header("Location: postcode.php"); // Redirect back to the postcode page
        exit();
    } elseif (isset($_POST['view_postcode'])) {
        $postcodeID = $_POST['postcodeID'];
        $postcodeDetails = fetchPostcodeDetails($postcodeID);
    } elseif (isset($_POST['update_postcode'])) {

        if (!isAuthenticated()) {
            header("Location: postcode.php?error=unauthorized");
            exit();
        }

        // Handling code for updating an existing postcode
        $postcodeID = $_POST['postcodeID'];
        $postcode = $_POST['postcode'];
        $longitude = $_POST['longitude'];
        $latitude = $_POST['latitude'];

        if (!validatePostcode($postcode)) {
            header("Location: postcode.php?error=invalid_postcode");
            exit();
        }

        if (updatePostcodeByID($postcodeID, $postcode, $longitude, $latitude)) {
            header("Location: postcode.php?success=3"); // Choose appropriate success code
            exit();
        } else {
            header("Location: postcode.php?error=3"); // Choose appropriate error code
            exit();
        }
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
    <?php include 'header.php'; ?>
    <div class="content">
    <?php
        // Check for success pararmeterand display message 
        if (isset($_GET['success'])) {
            $success_code = $_GET['success'];
            if ($success_code == 1) {
                echo "<p class='success-message'>New postcode added successfully</p>";
            } elseif ($success_code == 2) {
                echo "<p class='success-message'>Record deleted successfully</p>";
            } elseif ($success_code == 3) {
                echo "<p class='success-message'>Postcode updated successfully</p>";
            }
        }

        // Checkfor suuccess parameter and display messages
        if (isset($_GET['error'])) {
            $error_code = $_GET['error'];
            if ($error_code == 1) {
                echo "<p class='error-message'>Postcode could not be added.</p>";
            } elseif ($error_code == 2) {
                echo "<p class='error-message'>Unable to delete record.</p>";
            } elseif ($error_code == 3) {
                echo "<p class='error-message'>Failed to update postcode</p>";
            } elseif ($error_code == 'unauthorized') {
                echo "<p class='error-message'>Unauthorized action. Please sign in.</p>";
            } elseif ($error_code == 'invalid_postcode') {
                echo "<p class='error-message'>Invalid postcode! Please enter a valid postcode. 
                For more details, visit <a href='https://ideal-postcodes.co.uk/guides/uk-postcode-format' target='_blank'>this guide</a>.</p>";
            }
        }
        
        ?>
        <div class="postcode-calculator">
            <h3>Calculate Distance</h3>
            <div class="postcode-input">
                <label for="postcode1">Post Code 1:</label>
                <select id="postcode1" class="selectbox">
                    <option value="" disabled selected>Select postcode</option>
                    <?php
                    if (!empty($postcodes)) {
                        foreach ($postcodes as $row) {
                            echo "<option value='" . htmlspecialchars($row['postcodeID']) . "' data-lat='" . htmlspecialchars($row['latitude']) . "' data-lon='" . htmlspecialchars($row['longitude']) . "'>" . htmlspecialchars($row['postcode']) . " (" . htmlspecialchars($row['longitude']) . ", " . htmlspecialchars($row['latitude']) . ")</option>";
                        }
                    } else {
                        echo "<option value=''>No postcodes available</option>";
                    }
                    ?>
                </select>
                <label for="postcode2">Post Code 2:</label>
                <select id="postcode2" class="selectbox">
                    <option value="" disabled selected>Select postcode</option>
                    <?php
                    if (!empty($postcodes)) {
                        foreach ($postcodes as $row) {
                            echo "<option value='" . htmlspecialchars($row['postcodeID']) . "' data-lat='" . htmlspecialchars($row['latitude']) . "' data-lon='" . htmlspecialchars($row['longitude']) . "'>" . htmlspecialchars($row['postcode']) . " (" . htmlspecialchars($row['longitude']) . ", " . htmlspecialchars($row['latitude']) . ")</option>";
                        }
                    } else {
                        echo "<option value=''>No postcodes available</option>";
                    }
                    ?>
                </select>
                <button class="calculate-button" onclick="calculateDistance()">Calculate</button>
                <label for="distance">Distance:</label>
                <input type="text" id="distance" class="textbox" readonly>
            </div>
        </div>
        <hr>
        <?php
        // Display message for not logged-in users
        if (!$userLoggedIn) {
            echo "<p>You need to sign in to add postcodes.</p>";
        }
         if ($userLoggedIn) { ?>
        <h3 id="form-title">Add Postcode</h3>
        <div class="postcode-form">
            <form action="postcode.php" method="POST" id="postcode-form">
                <input type="hidden" id="postcodeID" name="postcodeID">
                <label for="postcode">Post Code:</label>
                <input type="text" id="postcode" name="postcode" class="textbox" required>
                <label for="longitude">Longitude:</label>
                <input type="text" id="longitude" name="longitude" class="textbox" required>
                <label for="latitude">Latitude:</label>
                <input type="text" id="latitude" name="latitude" class="textbox" required>
                <button class="add-button" type="submit" name="add_postcode" id="submit-button">Add Post Code</button>
                <button type="button" class="cancel-button" id="cancel-button" onclick="cancelUpdate()" style="display:none;">Cancel Update</button>
            </form>
        </div>
        <?php } ?>
        <hr>
        <div class="postcode-list">
            <h2>Post Code List</h2>
            <table>
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
            <td>" . htmlspecialchars($row["postcode"]) . "</td>
            <td>";
            
            // Always display View button
            echo "<form action='postcode.php' method='POST' style='display:inline;'>
                    <input type='hidden' name='postcodeID' value='" . htmlspecialchars($row['postcodeID']) . "'>
                    <button type='submit' name='view_postcode'>View</button>
                </form>";
            
            if ($userLoggedIn) {
                // Display Edit and Delete buttons for logged-in users
                echo "<button onclick='editPostcode(" . htmlspecialchars($row['postcodeID']) . ")'>Edit</button>
                      <form action='postcode.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='postcodeID' value='" . htmlspecialchars($row['postcodeID']) . "'>
                        <button type='submit' name='delete_postcode'>Delete</button>
                      </form>";
            } else {
                echo "<span>Please sign in to perform edit/delete actions.</span>";
            }
            
            echo "<!-- Hidden fields for postcode details -->
                <input type='hidden' class='postcode-details' id='postcodeDetails_" . htmlspecialchars($row['postcodeID']) . "' 
                       data-postcode='" . htmlspecialchars($row['postcode']) . "' 
                       data-longitude='" . htmlspecialchars($row['longitude']) . "' 
                       data-latitude='" . htmlspecialchars($row['latitude']) . "'>
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
        <script src="js/scripts.js"></script>

        <?php
        if (isset($postcodeDetails)) {
            echo "<div class='postcode-details'>
            <h2>Post Code Details</h2>
            <p><strong>Post Code ID:</strong> " . htmlspecialchars($postcodeDetails['postcodeID']) . "</p>
            <p><strong>Post Code:</strong> " . htmlspecialchars($postcodeDetails['postcode']) . "</p>
            <p><strong>Longitude:</strong> " . htmlspecialchars($postcodeDetails['longitude']) . "</p>
            <p><strong>Latitude:</strong> " . htmlspecialchars($postcodeDetails['latitude']) . "</p>
        </div>";
        echo "<script>scrollToBottom();</script>";
        }
        ?>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>