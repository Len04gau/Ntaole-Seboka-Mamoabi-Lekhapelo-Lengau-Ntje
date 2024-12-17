<?php
include ('connection.php');

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $verify_query = mysqli_query($con, "SELECT Email FROM admin sign up WHERE Email='$email'");

    if (mysqli_num_rows($verify_query) != 0) {
        echo "<div class='message'>
        <p>This email is already used, please try another one!</p>
        </div><br>";
        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
    } else {
        // Hash password for security
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        // Insert the data into the database
        $insert_query = mysqli_query($con, "INSERT INTO admin sign up (Fullname, Email, Password) 
        VALUES ('$fullname', '$email', '$hashed_password')") or die("Database error: " . mysqli_error($con));

        if ($insert_query) {
            // Redirect to login page if registration successful 
            header("Location: index.php");
            exit;
        } else {
            echo "<p>Error Occurred during registration. Please try again.</p>";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Career Guidance Platform</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        header {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .btn-choice {
            width: 200px;
            margin: 10px;
            padding: 15px;
            font-size: 16px;
            display: block;
            text-align: center;
        }
        .welcome-container {
            margin-top: 50px;
            text-align: center;
        }
    </style>
</head>
<body>


<header>
    <h1>Welcome to the Career Guidance Platform</h1>
</header>


<div class="container welcome-container">
    <h2>Choose Your Role</h2>
    <p>Please select an option below to proceed:</p>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <a href="admin.php" class="btn btn-dark btn-choice">
                <i class="fas fa-user-shield"></i> Admin
            </a>
        </div>
        <div class="col-md-4">
            <a href="institute.php" class="btn btn-primary btn-choice">
                <i class="fas fa-school"></i> Institution
            </a>
        </div>
        <div class="col-md-4">
            <a href="student.php" class="btn btn-success btn-choice">
                <i class="fas fa-user-graduate"></i> Student
            </a>
        </div>
    </div>
</div>


<footer class="bg-dark text-white text-center p-3 mt-5">
    &copy; 2024 Career Guidance Platform
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>