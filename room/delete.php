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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $sql = "DELETE FROM room WHERE room_code='$room_code'";
        mysqli_query($conn, $sql);
        header("Location: /tiny-college/?page=room/index"); // Redirect to the read page
        exit();
    } catch (\Throwable $th) {
        echo "<div class='container alert alert-danger'>This record cannot be deleted because it is referenced as a foreign key in another table.</div>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Delete Room</h2>
    <p>Are you sure you want to delete the following room?</p>
    <ul>
        <li><strong>Room Code:</strong> <?= $room['room_code'] ?></li>
        <li><strong>Room Type:</strong> <?= $room['room_type'] ?></li>
        <li><strong>Building Code:</strong> <?= $room['bldg_code'] ?></li>
    </ul>
    <form method="POST">
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="?page=room/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
