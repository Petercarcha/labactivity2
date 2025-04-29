<?php
session_start();

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentId = $_POST['studentId'];
    $password = $_POST['password'];

    // Database connection
    $host = 'localhost';
    $username = 'root';
    $db_password = ""; // Use a different variable name to avoid conflict
    $dbname = 'studentsform';

    $conn = new mysqli($host, $username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch user data from the database
    $query = "SELECT * FROM studentsform WHERE student_id = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param('s', $studentId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Set session variable to indicate the user is logged in
            $_SESSION['loggedin'] = true;
            $_SESSION['studentId'] = $studentId; // Store student ID in session if needed

            // Redirect to the Food Hub page
            header('Location: food.php');
            exit();
        } else {
            // Invalid password
            echo "<script>alert('Invalid Student ID or Password.'); window.location.href='index.php';</script>";
            exit();
        }
    } else {
        // Invalid student ID
        echo "<script>alert('Invalid Student ID or Password.'); window.location.href='index.php';</script>";
        exit();
    }

    $conn->close();
}
?>