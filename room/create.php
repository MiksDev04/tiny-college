<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'tiny_college';

$conn = mysqli_connect($host, $user, $password, $dbname);
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_code = $_POST['room_code'];
    $room_type = $_POST['room_type'];
    $bldg_code = $_POST['bldg_code'];

    $sql = "INSERT INTO room ( room_type, bldg_code) VALUES ( '$room_type', '$bldg_code')";
    mysqli_query($conn, $sql);
    header("Location: /tiny-college/?page=room/index"); // Redirect to the read page
    exit();
}
$bldgs = mysqli_query($conn, "SELECT * FROM building");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Create Room</h2>
    <form method="POST"  action="room/create.php">
        <div class="mb-3">
            <label>Room Type</label>
            <input type="text" name="room_type" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Building</label>
            <select name="bldg_code" class="form-control" required>
                <option value="">Select Building</option>
                <?php while($b = mysqli_fetch_assoc($bldgs)): ?>
                    <option value="<?= $b['bldg_code'] ?>"><?= $b['bldg_name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <button class="btn btn-success">Create</button>
        <a href="?page=room/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
