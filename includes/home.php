<?php
// Database connection
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'tiny_college';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get count from a table
function getCount($conn, $table) {
    $sql = "SELECT COUNT(*) as total FROM $table";
    $result = $conn->query($sql);
    if ($result && $row = $result->fetch_assoc()) {
        return $row['total'];
    }
    return 0;
}

// Get counts for all tables
$counts = [
    'professor' => getCount($conn, 'professor'),
    'school' => getCount($conn, 'school'),
    'department' => getCount($conn, 'department'),
    'semester' => getCount($conn, 'semester'),
    'course' => getCount($conn, 'course'),
    'student' => getCount($conn, 'student'),
    'enroll' => getCount($conn, 'enroll'),
    'building' => getCount($conn, 'building'),
    'room' => getCount($conn, 'room'),
    'class' => getCount($conn, 'class')
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiny College Management System</title>
    <style>
        :root {
            --card-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            --hover-transform: translateY(-5px);
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 3rem;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .card-btn {
            border: none;
            border-radius: 12px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            box-shadow: var(--card-shadow);
        }
        
        .card-btn:hover {
            transform: var(--hover-transform);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
        }
        
        .btn-icon {
            width: 48px;
            height: 48px;
            margin-bottom: 1rem;
        }
        
        .count-badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #fff;
            color: #333;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        
        .btn-container {
            position: relative;
        }
        
        .btn-primary { background-color: #4e73df; }
        .btn-secondary { background-color: #858796; }
        .btn-success { background-color: #1cc88a; }
        .btn-info { background-color: #36b9cc; }
        .btn-warning { background-color: #f6c23e; color: #2c3e50; }
        .btn-danger { background-color: #e74a3b; }
        .btn-dark { background-color: #5a5c69; }
        .btn-light { background-color: #f8f9fc; color: #2c3e50; }
        
        .btn-outline-primary { border: 2px solid #4e73df; color: #4e73df; }
        .btn-outline-success { border: 2px solid #1cc88a; color: #1cc88a; }
        
        .btn-outline-primary:hover { background-color: #4e73df; color: white; }
        .btn-outline-success:hover { background-color: #1cc88a; color: white; }
    </style>
</head>
<body class=" bg-body">
    <!-- Header -->
    <div class="header">
        <div class="container">
            <h1 class="text-center display-4 fw-bold">Tiny College Management System</h1>
            <p class="text-center lead mt-3">Comprehensive academic administration at your fingertips</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="row g-4">
            <!-- Professor Card -->
            <div class="col-md-4 col-lg-3">
                <div class="btn-container">
                    <a href="/tiny-college/?page=professor/index" class="card-btn btn btn-primary text-decoration-none">
                        <svg class="btn-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                        </svg>
                        <h5 class="mb-0">Manage Professors</h5>
                    </a>
                    <span class="count-badge"><?= $counts['professor'] ?></span>
                </div>
            </div>
            
            <!-- School Card -->
            <div class="col-md-4 col-lg-3">
                <div class="btn-container">
                    <a href="/tiny-college/?page=school/index" class="card-btn btn btn-secondary text-decoration-none">
                        <svg class="btn-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor" d="M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82zM12 3L1 9l11 6 9-4.91V17h2V9L12 3z"/>
                        </svg>
                        <h5 class="mb-0">Manage Schools</h5>
                    </a>
                    <span class="count-badge"><?= $counts['school'] ?></span>
                </div>
            </div>
            
            <!-- Department Card -->
            <div class="col-md-4 col-lg-3">
                <div class="btn-container">
                    <a href="/tiny-college/?page=department/index" class="card-btn btn btn-success text-decoration-none">
                        <svg class="btn-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor" d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                        </svg>
                        <h5 class="mb-0">Manage Departments</h5>
                    </a>
                    <span class="count-badge"><?= $counts['department'] ?></span>
                </div>
            </div>
            
            <!-- Semester Card -->
            <div class="col-md-4 col-lg-3">
                <div class="btn-container">
                    <a href="/tiny-college/?page=semester/index" class="card-btn btn btn-warning text-decoration-none">
                        <svg class="btn-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor" d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                        </svg>
                        <h5 class="mb-0">Manage Semesters</h5>
                    </a>
                    <span class="count-badge"><?= $counts['semester'] ?></span>
                </div>
            </div>
            
            <!-- Course Card -->
            <div class="col-md-4 col-lg-3">
                <div class="btn-container">
                    <a href="/tiny-college/?page=course/index" class="card-btn btn btn-info text-decoration-none">
                        <svg class="btn-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor" d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 9H9V9h10v2zm-4 4H9v-2h6v2zm4-8H9V5h10v2z"/>
                        </svg>
                        <h5 class="mb-0">Manage Courses</h5>
                    </a>
                    <span class="count-badge"><?= $counts['course'] ?></span>
                </div>
            </div>
            
            <!-- Student Card -->
            <div class="col-md-4 col-lg-3">
                <div class="btn-container">
                    <a href="/tiny-college/?page=student/index" class="card-btn btn btn-danger text-decoration-none">
                        <svg class="btn-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                        </svg>
                        <h5 class="mb-0">Manage Students</h5>
                    </a>
                    <span class="count-badge"><?= $counts['student'] ?></span>
                </div>
            </div>
            
            <!-- Enrollment Card -->
            <div class="col-md-4 col-lg-3">
                <div class="btn-container">
                    <a href="/tiny-college/?page=enroll/index" class="card-btn btn btn-dark text-decoration-none">
                        <svg class="btn-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor" d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4zM14 13h-3v3H9v-3H6v-2h3V8h2v3h3v2z"/>
                        </svg>
                        <h5 class="mb-0">Manage Enrollments</h5>
                    </a>
                    <span class="count-badge"><?= $counts['enroll'] ?></span>
                </div>
            </div>
            
            <!-- Building Card -->
            <div class="col-md-4 col-lg-3">
                <div class="btn-container">
                    <a href="/tiny-college/?page=building/index" class="card-btn btn btn-light text-decoration-none">
                        <svg class="btn-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor" d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-1 11h-4v4h-4v-4H6v-4h4V6h4v4h4v4z"/>
                        </svg>
                        <h5 class="mb-0">Manage Buildings</h5>
                    </a>
                    <span class="count-badge"><?= $counts['building'] ?></span>
                </div>
            </div>
            
            <!-- Room Card -->
            <div class="col-md-4 col-lg-3">
                <div class="btn-container">
                    <a href="/tiny-college/?page=room/index" class="card-btn btn btn-outline-primary text-decoration-none">
                        <svg class="btn-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor" d="M12 3L4 9v12h16V9l-8-6zm-2.25 9.5c.69 0 1.25.56 1.25 1.25S10.44 15 9.75 15s-1.25-.56-1.25-1.25.56-1.25 1.25-1.25zM17 18h-1v-1.5H8V18H7v-7h1v4.5h3.5V12H17v6z"/>
                        </svg>
                        <h5 class="mb-0">Manage Rooms</h5>
                    </a>
                    <span class="count-badge"><?= $counts['room'] ?></span>
                </div>
            </div>
            
            <!-- Class Card -->
            <div class="col-md-4 col-lg-3">
                <div class="btn-container">
                    <a href="/tiny-college/?page=class/index" class="card-btn btn btn-outline-success text-decoration-none">
                        <svg class="btn-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor" d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/>
                        </svg>
                        <h5 class="mb-0">Manage Classes</h5>
                    </a>
                    <span class="count-badge"><?= $counts['class'] ?></span>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
<?php
$conn->close();
?>