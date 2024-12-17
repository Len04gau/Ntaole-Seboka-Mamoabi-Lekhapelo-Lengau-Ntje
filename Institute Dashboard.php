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
    <title>Institution Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
<header class="bg-primary text-white text-center p-3">
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Career Guidance</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" 
            aria-expanded="false" aria-label="Toggle navigation">
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
    
    <h1><i class="fas fa-school"></i> Institution Dashboard</h1>
</header>
<div class="container mt-5">
    <div class="row">
        <!-- Add Faculty Card -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Add Faculty</h5>
                    <p class="card-text">Create new faculty departments for your institution.</p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFacultyModal">Add Faculty</button>
                </div>
            </div>
        </div>

        <!-- Add Course Card -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Add Courses</h5>
                    <p class="card-text">Add courses to the faculties of your institution.</p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourseModal">Add Course</button>
                </div>
            </div>
        </div>

        <!-- View Applications Card -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">View Applications</h5>
                    <p class="card-text">View and manage student applications.</p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewApplicationsModal">View Applications</button>
                </div>
            </div>
        </div>

        <!-- Publish Admissions Card -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Publish Admissions</h5>
                    <p class="card-text">Publish admission results for your students.</p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#publishAdmissionsModal">Publish</button>
                </div>
            </div>
        </div>

        <!-- Institution Profile Card -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Institution Profile</h5>
                    <p class="card-text">View and update institution details.</p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#institutionProfileModal">Profile</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Faculty Modal -->
<div class="modal fade" id="addFacultyModal" tabindex="-1" aria-labelledby="addFacultyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFacultyModalLabel">Add Faculty</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add_faculty_handler.php" method="POST">
                    <div class="mb-3">
                        <label for="facultyName" class="form-label">Faculty Name</label>
                        <input type="text" class="form-control" id="facultyName" name="faculty_name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Faculty</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Course Modal -->
<div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCourseModalLabel">Add Course to Faculty</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add_course_handler.html" method="POST">
                    <div class="mb-3">
                        <label for="facultySelect" class="form-label">Select Faculty</label>
                        <select id="facultySelect" name="faculty_id" class="form-select" required>
                            <!-- Dynamic list of faculties can be populated here -->
                            <option value="1">Faculty of Science</option>
                            <option value="2">Faculty of Arts</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="courseName" class="form-label">Course Name</label>
                        <input type="text" class="form-control" id="courseName" name="course_name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Course</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Applications Modal -->
<div class="modal fade" id="viewApplicationsModal" tabindex="-1" aria-labelledby="viewApplicationsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewApplicationsModalLabel">View Applications</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Here you can view all the student applications to your institution.</p>
                <!-- Dynamic content for applications goes here -->
                <button class="btn btn-primary">View Applications</button>
            </div>
        </div>
    </div>
</div>

<!-- Publish Admissions Modal -->
<div class="modal fade" id="publishAdmissionsModal" tabindex="-1" aria-labelledby="publishAdmissionsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="publishAdmissionsModalLabel">Publish Admissions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="publish_admissions_handler.hmtl" method="POST">
                    <div class="mb-3">
                        <label for="admissionsStatus" class="form-label">Select Admission Status</label>
                        <select id="admissionsStatus" name="admissions_status" class="form-select" required>
                            <option value="accepted">Accepted</option>
                            <option value="pending">Pending</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Publish Admissions</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Institution Profile Modal -->
<div class="modal fade" id="institutionProfileModal" tabindex="-1" aria-labelledby="institutionProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="institutionProfileModalLabel">Update Institution Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="profile_update_handler.html" method="POST">
                    <div class="mb-3">
                        <label for="institutionName" class="form-label">Institution Name</label>
                        <input type="text" class="form-control" id="institutionName" name="institution_name" value="<?php echo htmlspecialchars($institution_name); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="institutionEmail" class="form-label">Institution Email</label>
                        <input type="email" class="form-control" id="institutionEmail" name="institution_email" required>
                    </div>
                    <div class="mb-3">
                        <label for="institutionPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="institutionPassword" name="institution_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>

<footer class="bg-primary text-white text-center p-3 mt-5">
    &copy; 2024 Career Guidance Platform
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
