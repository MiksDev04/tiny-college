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

// Fetch the existing semester data
$sql = "SELECT * FROM semester WHERE semester_code = '$semester_code'";
$result = $conn->query($sql);
$semester = $result->fetch_assoc();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $semester_year = $_POST['semester_year'];
    $semester_term = $_POST['semester_term'];
    $semester_start_date = $_POST['semester_start_date'];
    $semester_end_date = $_POST['semester_end_date'];

    // Update the database record
    $sql = "UPDATE semester SET semester_year='$semester_year', semester_term='$semester_term', semester_start_date='$semester_start_date', semester_end_date='$semester_end_date' WHERE semester_code='$semester_code'";

    if ($conn->query($sql) === TRUE) {
        header("Location: /tiny-college/?page=semester/index"); // Redirect to the read page
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Update Semester</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Update Semester</h2>
        <form action="semester/update.php?semester_code=<?php echo $semester['semester_code']; ?>" method="POST">
            <div class="mb-3">
                <label for="semester_year" class="form-label">Semester Year</label>
                <input type="number" name="semester_year" id="semester_year" class="form-control" value="<?php echo $semester['semester_year']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="semester_term" class="form-label">Semester Term</label>
                <input type="text" name="semester_term" id="semester_term" class="form-control" value="<?php echo $semester['semester_term']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="semester_start_date" class="form-label">Start Date</label>
                <input type="date" name="semester_start_date" id="semester_start_date" class="form-control" value="<?php echo $semester['semester_start_date']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="semester_end_date" class="form-label">End Date</label>
                <input type="date" name="semester_end_date" id="semester_end_date" class="form-control" value="<?php echo $semester['semester_end_date']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Semester</button>
            <a href="?page=semester/index" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
