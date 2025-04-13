<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'tiny_college'; // Replace with your actual database name

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the semester_code from the URL
$semester_code = $_GET['semester_code'];

// Fetch the semester data to show before deletion
$sql = "SELECT * FROM semester WHERE semester_code = '$semester_code'";
$result = $conn->query($sql);
$semester = $result->fetch_assoc();

// Check if the form is submitted to delete the record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Delete the semester from the database
    $sql = "DELETE FROM semester WHERE semester_code = '$semester_code'";

    try {
        //code...
        mysqli_query($conn, $sql);
        header("Location: /tiny-college/?page=semester/index"); // Redirect to the read page
        exit();
    } catch (\Throwable $th) {
        echo "<div class='container alert alert-danger'>This record cannot be deleted because it is referenced as a foreign key in another table.</div>";
    }
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Delete Semester</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Delete Semester</h2>
        <p>Are you sure you want to delete this semester?</p>
        <ul>
            <li><strong>Semester Code:</strong> <?php echo $semester['semester_code']; ?></li>
            <li><strong>Semester Year:</strong> <?php echo $semester['semester_year']; ?></li>
            <li><strong>Semester Term:</strong> <?php echo $semester['semester_term']; ?></li>
            <li><strong>Start Date:</strong> <?php echo $semester['semester_start_date']; ?></li>
            <li><strong>End Date:</strong> <?php echo $semester['semester_end_date']; ?></li>
        </ul>

        <form method="POST">
            <button type="submit" class="btn btn-danger">Delete Semester</button>
            <a href="?page=semester/index" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
