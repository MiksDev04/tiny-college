<?php
$conn = mysqli_connect("localhost", "root", "", "tiny_college");
$id = $_GET['id'];

$course = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT c.*, d.dept_name FROM course c 
    LEFT JOIN department d ON c.dept_code = d.dept_code 
    WHERE crs_code = $id
"));

if (isset($_POST['delete'])) {
    try {
        mysqli_query($conn, "DELETE FROM course WHERE crs_code = $id");
        header("Location: ?page=course/index");
        exit();
    } catch (\Throwable $th) {
        echo "<div class='container alert alert-danger'>This record cannot be deleted because it is referenced as a foreign key in another table.</div>";
    }
}
?>

<div class="container mt-4">
    <h2>Delete Course</h2>
    <p>Are you sure you want to delete this course?</p>
    <ul>
        <li><strong>Code:</strong> <?= $course['crs_code'] ?></li>
        <li><strong>Title:</strong> <?= $course['crs_title'] ?></li>
        <li><strong>Description:</strong> <?= $course['crs_description'] ?></li>
        <li><strong>Credit:</strong> <?= $course['crs_credit'] ?></li>
        <li><strong>Department:</strong> <?= $course['dept_name'] ?></li>
    </ul>
    <form method="post">
        <button name="delete" class="btn btn-danger">Delete</button>
        <a href="?page=course/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>
