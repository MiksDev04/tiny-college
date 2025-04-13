<?php 
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'tiny_college';

$conn = mysqli_connect($host, $user, $password, $dbname);

?>
<?php
$room_code = $_GET['room_code'];
$result = mysqli_query($conn, "SELECT * FROM room WHERE room_code='$room_code'");
$room = mysqli_fetch_assoc($result);
$bldgs = mysqli_query($conn, "SELECT * FROM building");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_type = $_POST['room_type'];
    $bldg_code = $_POST['bldg_code'];

    $sql = "UPDATE room SET room_type='$room_type', bldg_code='$bldg_code' WHERE room_code='$room_code'";
    mysqli_query($conn, $sql);
    header("Location: /tiny-college/?page=room/index"); // Redirect to the read page
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Update Room</h2>
    <form method="POST" action="room/update.php?room_code=<?= $room_code ?>">
        <div class="mb-3">
            <label>Room Type</label>
            <input type="text" name="room_type" class="form-control" value="<?= $room['room_type'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Building</label>
            <select name="bldg_code" class="form-control" required>
                <?php while($b = mysqli_fetch_assoc($bldgs)): ?>
                    <option value="<?= $b['bldg_code'] ?>" <?= $b['bldg_code'] == $room['bldg_code'] ? 'selected' : '' ?>>
                        <?= $b['bldg_name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="?page=room/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
