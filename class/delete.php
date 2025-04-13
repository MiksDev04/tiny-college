<?php
$conn = mysqli_connect("localhost", "root", "", "tiny_college");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM class WHERE class_code = $id"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "DELETE FROM class WHERE class_code = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: /tiny-college/?page=class/index");
        exit();
    } else {
        echo "<div class='container alert alert-danger'>This record cannot be deleted because it is referenced in another table.</div>";
    }
}
?>

<div class="container mt-4">
    <h2>Delete Class</h2>
    <ul >
        <li ><strong>Section:</strong> <?= $data['class_section'] ?></li>
        <li ><strong>Time:</strong> <?= $data['class_time'] ?></li>
        <li ><strong>Course Code: </strong><?= $data['crs_code'] ?></li>
        <li ><strong>Professor Num:</strong> <?= $data['prof_num'] ?></li>
        <li ><strong>Room Code:</strong> <?= $data['room_code'] ?></li>
        <li ><strong>Semester Code:</strong> <?= $data['semester_code'] ?></li>
    </ul>
    <form method="post">
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="?page=class/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>
