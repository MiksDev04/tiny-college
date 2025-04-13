<?php 
$host = 'localhost'; // Database host
$user = 'root';
$password = '';
$dbname = 'tiny_college'; // Replace with your actual database name

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['bldg_name'];
    $location = $_POST['bldg_location'];

    $sql = "INSERT INTO building (bldg_name, bldg_location) VALUES ('$name', '$location')";

    if ($conn->query($sql) === TRUE) {
        header("Location: /tiny-college/?page=building/index"); // Redirect to the read page
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<div class="container mt-5">
    <h2>Create New Building</h2>
    <form method="POST" action="building/create.php">
        
        <div class="mb-3">
            <label class="form-label">Building Name</label>
            <input type="text" name="bldg_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" name="bldg_location" class="form-control" required>
        </div>
        <button class="btn btn-success">Create</button>
        <a href="?page=building/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>
