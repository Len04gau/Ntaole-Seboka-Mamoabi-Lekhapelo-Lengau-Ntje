<?php
// xammp Database connection
$servername = "localhost"; // Update with your database server
$username = "root";        // Update with your database username
$password = "";            // database password
$dbname = "cs";            // Database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Checking connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sign-Up part
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO students (Name, Email, Password) VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Sign-up successful!'); window.location.href = 'student.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href = 'student.php';</script>";
    }
}

// Log-In part
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['login'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE Email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            echo "<script>alert('Login successful!'); window.location.href = 'same_page.php';</script>";
        } else {
            echo "<script>alert('Invalid password!'); window.location.href = 'same_page.php';</script>";
        }
    } else {
        echo "<script>alert('Email not registered!'); window.location.href = 'same_page.php';</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>


<header class="bg-success text-white text-center p-3">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Career Guidance</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="institute.php">Institution</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="student.php">Student</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <h1><i class="fas fa-user-graduate"></i> Student Dashboard</h1>
</header>


<div class="container mt-5">
    <p>Welcome to the Student panel. Use the button below to log in.</p>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#studentModal">
        <i class="fas fa-sign-in-alt"></i> Student Login
    </button>
</div>

<div class="container mt-5">
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</button>
     <i class="fas fa-sign-in-alt"></i> 
 </button>
</div>

<!-- Student Login Modal -->
<div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="StudentModalLabel">Institution Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="studentdashboard.php" method="POST">
                    <div class="mb-3">
                        <label for="institutionEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="institutionEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="institutionPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="institutionPassword" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Student Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form class="signup-form" action="" method="post">
                    <div class="mb-3">
                        <label for="signupName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="signupName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="signupEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="signupEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="signupPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="signupPassword" name="password" required>
                    </div>
                    <button type="submit" id="submit" name="submit" class="btn btn-success">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
</div>


<footer class="bg-success text-white text-center p-3 mt-5">
    &copy; 2024 Career Guidance Platform
</footer>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>