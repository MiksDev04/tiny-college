<?php
$conn = mysqli_connect('localhost', 'root', '', 'tiny_college');
if (!$conn) die("Connection failed: " . mysqli_connect_error());

$school_code = $_GET['school_code'];
$school = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM school WHERE school_code='$school_code'"));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        mysqli_query($conn, "DELETE FROM school WHERE school_code='$school_code'");
        header("Location: /tiny-college/?page=school/index");
        exit();
    } catch (\Throwable $th) {
        echo "<div class='container alert alert-danger'>This record cannot be deleted because it is referenced as a foreign key in another table.</div>";
    }
}
?>

<div class="container mt-4">
    <h2>Delete School</h2>
    <p>Are you sure you want to delete the following school?</p>
    <ul>
        <li><strong>School Code:</strong> <?= $school['school_code'] ?></li>
        <li><strong>School Name:</strong> <?= $school['school_name'] ?></li>
        <li><strong>Professor ID:</strong> <?= $school['prof_num'] ?></li>
    </ul>
    <form method="POST">
        <button class="btn btn-danger" type="submit">Delete</button>
        <a href="?page=school/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>
