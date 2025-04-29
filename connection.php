<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $student_id = trim($_POST['studentsd'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $gender = trim($_POST['gender'] ?? '');
    $course = trim($_POST['course'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirmPassword'] ?? '');

    // Validate inputs
    if (empty($student_id) || empty($name) || empty($email) || empty($phone) || empty($gender) || empty($course) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = "All fields are required.";
        header('Location: register.php');
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header('Location: register.php');
        exit();
    } elseif ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
        header('Location: register.php');
        exit();
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Database connection
        $host = 'localhost';
        $username = 'root';
        $db_password = ""; // Use a different variable name to avoid conflict
        $dbname = 'studentsform';

        $conn = new mysqli($host, $username, $db_password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check for duplicate student_id
        $checkQuery = "SELECT * FROM studentsform WHERE student_id = ?";
        $stmt = $conn->prepare($checkQuery);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param('s', $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['error'] = "Student ID already exists.";
            header('Location: register.php');
            exit();
        } else {
            // Insert new record
            $insertQuery = "INSERT INTO studentsform (student_id, full_name, email, phone_number, gender, course, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insertQuery);
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }
            $stmt->bind_param('sssssss', $student_id, $name, $email, $phone, $gender, $course, $hashed_password);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Registration successful! Please login.";
                header('Location: register.php'); // Redirect back to the registration page
                exit();
            } else {
                $_SESSION['error'] = "Error: " . $stmt->error;
                header('Location: register.php');
                exit();
            }
        }

        $conn->close();
    }
}
?>