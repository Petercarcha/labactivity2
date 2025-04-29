<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        .container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        h2 {
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            color: #333;
        }

        .form-group {
            margin-bottom: 1rem;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="password"],
        select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus,
        input[type="password"]:focus,
        select:focus {
            border-color: #28a745;
        }

        .gender-options {
            display: flex;
            gap: 10px;
            margin-top: 5px;
        }

        .gender-options label {
            font-weight: normal;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        button {
            width: 100%;
            padding: 0.75rem;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 1rem;
        }

        button:hover {
            background-color: #218838;
        }

        p {
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #666;
        }

        a {
            color: #28a745;
            text-decoration: none;
            font-weight: 600;
        }

        a:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .success {
            color: #28a745;
            text-align: center;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        @media (max-width: 600px) {
            h2 {
                font-size: 1.25rem;
            }

            .container {
                padding: 1.5rem;
            }

            input[type="text"],
            input[type="email"],
            input[type="tel"],
            input[type="password"],
            select {
                font-size: 0.9rem;
                padding: 0.5rem;
            }

            button {
                font-size: 0.9rem;
                padding: 0.5rem;
            }
        }
    </style>
    <script>
        // Display success alert if registration was successful
        window.onload = function() {
            <?php if (isset($_SESSION['success'])): ?>
                alert("<?php echo $_SESSION['success']; ?>");
                <?php unset($_SESSION['success']); // Clear the success message ?>
            <?php endif; ?>
        };
    </script>
</head>
<body>
    <div class="container">
        <h2>Student Registration Form</h2>
        <?php
        // Display error message if any
        if (isset($_SESSION['error'])) {
            echo '<p class="error">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']); // Clear the error message
        }
        // Display success message if any
        if (isset($_SESSION['success'])) {
            echo '<p class="success">' . $_SESSION['success'] . '</p>';
            unset($_SESSION['success']); // Clear the success message
        }
        ?>
        <form action="connection.php" method="POST">
            <div class="form-group">
                <label for="studentId">Student ID Number</label>
                <input type="text" id="studentId" name="studentsd" placeholder="Enter your Student ID Number" required>
            </div>

            <div class="form-group">
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" name="name" placeholder="Enter your full name" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label for="phoneNumber">Phone Number</label>
                <input type="tel" id="phoneNumber" name="phone" placeholder="Enter your phone number" required>
            </div>

            <div class="form-group">
                <label>Gender</label>
                <div class="gender-options">
                    <label><input type="radio" name="gender" value="male" required> Male</label>
                    <label><input type="radio" name="gender" value="female"> Female</label>
                    <label><input type="radio" name="gender" value="other"> Other</label>
                </div>
            </div>

            <div class="form-group">
                <label for="course">Select your course</label>
                <select id="course" name="course" required>
                    <option value="course1">BSIT</option>
                    <option value="course2">BSEDUC</option>
                    <option value="course3">BSCS</option>
                </select>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
            </div>

            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="index.php">Login here</a></p>
    </div>
</body>
</html>