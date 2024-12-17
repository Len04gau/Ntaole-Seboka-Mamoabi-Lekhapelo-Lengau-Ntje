<?php
include ('connection.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $verify_query = mysqli_query($con, "SELECT Email FROM institute WHERE Email='$email'");

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
            header("Location: institute Dashboard.php");
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
    
    <h1 class="text-center mt-4">Welcome to the Student Dashboard!</h1>

</header>
<div class="container mt-5">
    <div class="row">
        <!-- Apply for Courses Card -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Apply for Courses</h5>
                    <p class="card-text">Submit applications to your preferred courses.</p>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#applyModal">Apply</button>
                </div>
            </div>
        </div>

        <!-- View Admissions Card -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">View Admissions</h5>
                    <p class="card-text">Check admission results and status.</p>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#admissionsModal">View Admissions</button>
                </div>
            </div>
        </div>

        <!-- Student Profile Card -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Student Profile</h5>
                    <p class="card-text">View or update your personal details.</p>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#profileModal">Profile</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Apply Modal -->
<div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applyModalLabel">Apply for Courses</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="apply_handler.php" method="POST">
                    <div class="mb-3">
                        <label for="courseSelect" class="form-label">Select Course</label>
                        <select id="courseSelect" name="course" class="form-select" required>
                            <option value="">Select a course</option>
                            <option value="AP">Arts and Performance</option>
                            <option value="BIT">Business Information Technology</option>
                            <option value="GD">Graphic Designing</option>
                            <option value="MSE1">Multimedia in Software Engineering</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="applicationText" class="form-label">Reason for Application</label>
                        <textarea id="applicationText" name="reason" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Application</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Admissions Modal -->
<div class="modal fade" id="admissionsModal" tabindex="-1" aria-labelledby="admissionsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="admissionsModalLabel">View Admissions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="admissions_handler.php" method="POST">
                    <div class="mb-3">
                        <label for="admissionSelect" class="form-label">Select Admission Status</label>
                        <select id="admissionSelect" name="status" class="form-select" required>
                            <option value="accepted">Accepted</option>
                            <option value="pending">Pending</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">View Status</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Update Student Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="profile_handler.php" method="POST">
                    <div class="mb-3">
                        <label for="studentName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="studentName" name="name" value="<?php echo htmlspecialchars($student_name); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="studentEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="studentEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="studentPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="studentPassword" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
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
