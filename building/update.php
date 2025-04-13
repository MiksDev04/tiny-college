<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'tiny_college';

// Create connection
$conn = mysqli_connect($host, $user, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$bldg_code = $_GET['bldg_code'];

$sql = "SELECT * FROM building WHERE bldg_code='$bldg_code'";
$result = mysqli_query($conn, $sql);
$building = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['bldg_name'];
    $location = $_POST['bldg_location'];

    $sql = "UPDATE building SET bldg_name = '$name', bldg_location = '$location' WHERE bldg_code = '$bldg_code'";
    mysqli_query($conn, $sql);

    header("Location: /tiny-college?page=building/index");
    exit();
}

?>


<div class="container mt-5">
    <h2>Update Building</h2>
    <form method="POST" action="building/update.php?bldg_code=<?= $bldg_code ?>">
        <div class="mb-3">
            <label class="form-label">Building Name</label>
            <input type="text" name="bldg_name" class="form-control" value="<?= $building['bldg_name'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" name="bldg_location" class="form-control" value="<?= $building['bldg_location'] ?>" required>
        </div>
        <button class="btn btn-warning" type="submit">Update</button>
        <a href="?page=building/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>
