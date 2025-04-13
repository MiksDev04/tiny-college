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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $semester_year = $_POST['semester_year'];
    $semester_term = $_POST['semester_term'];
    $semester_start_date = $_POST['semester_start_date'];
    $semester_end_date = $_POST['semester_end_date'];

    // Insert data into the database
    $sql = "INSERT INTO semester (semester_year, semester_term, semester_start_date, semester_end_date)
            VALUES ('$semester_year', '$semester_term', '$semester_start_date', '$semester_end_date')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: /tiny-college/?page=semester/index"); // Redirect to the read page
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>


    <div class="container mt-5">
        <h2>Create Semester</h2>
        <form action="semester/create.php" method="POST">
            <div class="mb-3">
                <label for="semester_year" class="form-label">Semester Year</label>
                <input type="number" name="semester_year" id="semester_year" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="semester_term" class="form-label">Semester Term</label>
                <input type="text" name="semester_term" id="semester_term" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="semester_start_date" class="form-label">Start Date</label>
                <input type="date" name="semester_start_date" id="semester_start_date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="semester_end_date" class="form-label">End Date</label>
                <input type="date" name="semester_end_date" id="semester_end_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Semester</button>
            <a href="?page=semester/index" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
