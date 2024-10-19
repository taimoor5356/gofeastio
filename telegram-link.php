<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Database Configuration
$servername = "localhost";
$username = "gomeoqfj_tg_bot";
$password = "a}kr^u-d56DO";
$dbname = "gomeoqfj_tg_bot";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to handle link click events
function handleLinkClick() {
    global $conn;

    // Get user IP address
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Find the corresponding click record in the database based on IP address
    $select_sql = "SELECT clicks FROM clicks WHERE ip_address = ?";
    $select_stmt = $conn->prepare($select_sql);
    $select_stmt->bind_param("s", $ip_address);
    $select_stmt->execute();

    // Store the results
    $select_stmt->store_result();

    // Check if rows were fetched
    if ($select_stmt->num_rows > 0) {
        // User already clicked, increment the click count

        // Bind the result variable
        $select_stmt->bind_result($click_count);

        // Fetch the results
        $select_stmt->fetch();

        $click_count++;

        // Update the click count in the database
        $update_sql = "UPDATE clicks SET clicks = ? WHERE ip_address = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("is", $click_count, $ip_address);
        $update_stmt->execute();

        // Close the statements
        $update_stmt->close();
        $select_stmt->close();

        // Perform additional actions if needed

        header("Location: https://t.me/GoFeastService"); // Redirect to Telegram link
        exit();
    } else {
        // Insert a new click record into the database
        $insert_sql = "INSERT INTO clicks (ip_address, clicks) VALUES (?, 1)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("s", $ip_address);
        $insert_stmt->execute();

        // Close the statements
        $insert_stmt->close();

        // Perform additional actions if needed

        // Redirect to Telegram link
        header("Location: https://t.me/GoFeastService");
        exit();
    }
}

// Call the function to handle the link click
handleLinkClick();

?>
