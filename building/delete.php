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

    try {
        $sql = "DELETE FROM building WHERE bldg_code = '$bldg_code'";
        mysqli_query($conn, $sql);
        header("Location: /tiny-college/?page=building/index");
        exit();
    } catch (\Throwable $th) {
        header("Location: /tiny-college/?page=building/delete&bldg_code=$bldg_code&error=foreign_key");
        exit();
    }
}
?>

<?php if (isset($_GET['error']) && $_GET['error'] == 'foreign_key'): ?>
    <div class="container alert alert-danger">
        This record cannot be deleted because it is referenced as a foreign key in another table.
    </div>
<?php endif; ?>
<div class="container mt-5">
    <h2>Delete Building</h2>
    <p>Are you sure you want to delete the following building?</p>
    <ul>
        <li><strong>Code:</strong> <?= $building['bldg_code'] ?></li>
        <li><strong>Name:</strong> <?= $building['bldg_name'] ?></li>
        <li><strong>Location:</strong> <?= $building['bldg_location'] ?></li>
    </ul>
    <form method="POST" action="building/delete.php?bldg_code=<?= $bldg_code ?>">
        <button class="btn btn-danger" type="submit">Delete</button>
        <a href="?page=building/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>

