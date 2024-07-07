<?php
include_once 'db.php';

// Function to add postcode
function addPostcode($postcode, $longitude, $latitude) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("INSERT INTO tbl_postcodes (postcode, longitude, latitude) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $postcode, $longitude, $latitude);
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $success;
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
