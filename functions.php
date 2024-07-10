<?php
include_once 'db.php';

// Function to update postcode by ID
function updatePostcodeByID($postcodeID, $postcode, $longitude, $latitude) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("UPDATE tbl_postcodes SET postcode = ?, longitude = ?, latitude = ? WHERE postcodeID = ?");
    $stmt->bind_param("sssi", $postcode, $longitude, $latitude, $postcodeID);
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $success;
}

// Function to calculate the distance between two points using the Haversine formula
function calculateDistance($latitude1, $longitude1, $latitude2, $longitude2) {
    // Convert degrees to radians
    $earthRadius = 6371000; // Radius of the Earth in meters
    $lat1 = deg2rad($latitude1);
    $lon1 = deg2rad($longitude1);
    $lat2 = deg2rad($latitude2);
    $lon2 = deg2rad($longitude2);

    $latDelta = $lat2 - $lat1;
    $lonDelta = $lon2 - $lon1;

    $a = sin($latDelta / 2) * sin($latDelta / 2) +
         cos($lat1) * cos($lat2) *
         sin($lonDelta / 2) * sin($lonDelta / 2);

    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    $distance = $earthRadius * $c; // Distance in meters

    return $distance;
}

// Function to check if user is authenticated
function isAuthenticated() {
    // Check if both userID and username session variables are set
    return isset($_SESSION['userID']) && isset($_SESSION['username']);
}

// Function to get user details by username
function getUserDetails($username) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT userID, Password FROM tbl_users WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userID, $hashed_password);
        $stmt->fetch();
        $userDetails = ['userID' => $userID, 'password' => $hashed_password];
    } else {
        $userDetails = null;
    }

    $stmt->close();
    $conn->close();
    return $userDetails;
}

// Function to add postcode
function addPostcode($postcode, $longitude, $latitude) {
    try {
        $conn = getDBConnection();
        
        if (!$conn) {
            throw new Exception("Database connection failed.");
        }
        
        $stmt = $conn->prepare("INSERT INTO tbl_postcodes (postcode, longitude, latitude) VALUES (?, ?, ?)");
        
        if (!$stmt) {
            throw new Exception("Failed to prepare statement.");
        }
        
        $stmt->bind_param("sss", $postcode, $longitude, $latitude);
        
        if (!$stmt->execute()) {
            throw new Exception("Failed to execute statement: " . $stmt->error);
        }
        
        $stmt->close();
        $conn->close();
        
        return true; 
    } catch (Exception $e) {
        error_log("Error adding postcode: " . $e->getMessage());
        return false;
    }
}


// Function to fetch all postcodes
function fetchPostcodes() {
    $conn = getDBConnection();
    $sql = "SELECT * FROM tbl_postcodes";
    $result = $conn->query($sql);
    $postcodes = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $postcodes[] = $row;
        }
    }
    $conn->close();
    return $postcodes;
}

// Function to fetch postcode details by ID
function fetchPostcodeDetails($postcodeID) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT * FROM tbl_postcodes WHERE postcodeID = ?");
    $stmt->bind_param("i", $postcodeID);
    $stmt->execute();
    $result = $stmt->get_result();
    $postcodeDetails = null;
    if ($result->num_rows > 0) {
        $postcodeDetails = $result->fetch_assoc();
    }
    $stmt->close();
    $conn->close();
    return $postcodeDetails;
}

// Function to delete postcode
function deletePostcode($postcodeID) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("DELETE FROM tbl_postcodes WHERE postcodeID = ?");
    $stmt->bind_param("i", $postcodeID);
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $success;
}
?>
