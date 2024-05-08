<?php
// Assuming your database credentials
$servername = "localhost"; // Change this if your database is hosted elsewhere
$dbusername = "root"; // Change this to your database username
$dbpassword = ""; // Change this to your database password
$dbname = "groundnut"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error());
}

// Retrieve username, password, and role from the form submission
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

// Prepare SQL statement to retrieve user information
$sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password' AND role = '$role'";
$result = $conn->query($sql);
$role = strtolower($role);
// Check if any row matched the query
if ($result->num_rows > 0) {
    // User is authenticated, redirect based on role
    switch ($role) {
        case 'agent':
            header("Location: Details.html");
            break;
        case 'manager':
            header("Location: managerdash.html");
            break;
        case 'admin':
            header("Location: admindash.html");
            break;
        default:
            // Handle unexpected role
            echo "Unexpected role!";
            break;
    }
} else {
    // User authentication failed, redirect back to the login page or display an error message
    session_start();
    $_SESSION['error_message'] = "Incorrect credentials. Please try again.";
    header("Location: index.php");
    exit(); // Redirect back to the login page
    // Alternatively, you can display an error message
    // echo "Login failed. Please check your credentials and try again.";
}

// Close database connection
$conn->close();
?>
