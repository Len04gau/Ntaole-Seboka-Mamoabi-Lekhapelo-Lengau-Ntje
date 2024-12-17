

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            background-color: #343a40;
            color: #fff;
            min-height: 100vh;
        }
        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
        }
        .sidebar a:hover {
            color: #fff;
        }
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0);
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="position-sticky">
                    <h4 class="text-center py-3">Admin Panel</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Manage Institutions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Manage Faculties</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Manage Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Publish Admissions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Profile</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>
                <div class="row">
                    <!-- Institutions Card -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header">Institutions</div>
                            <div class="card-body text-center">
                                <h5 class="card-title">Total: <span id="institution-count"></span></h5>
                                <a href="#" class="btn btn-primary">Manage</a>
                            </div>
                        </div>
                    </div>
                    <!-- Faculties Card -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header">Faculties</div>
                            <div class="card-body text-center">
                                <h5 class="card-title">Total: <span id="faculty-count"></span></h5>
                                <a href="#" class="btn btn-primary">Manage</a>
                            </div>
                        </div>
                    </div>
                    <!-- Courses Card -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header">Courses</div>
                            <div class="card-body text-center">
                                <h5 class="card-title">Total: <span id="course-count"></span></h5>
                                <a href="#" class="btn btn-primary">Manage</a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fetch data dynamically for dashboard cards
        fetch('dashboard-data.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById('institution-count').textContent = data.institutions || 0;
                document.getElementById('faculty-count').textContent = data.faculties || 0;
                document.getElementById('course-count').textContent = data.courses || 0;
            })
            .catch(err => console.error('Error fetching data:', err));
    </script>
</body>
</html>
