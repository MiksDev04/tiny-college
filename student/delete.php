<?php
$conn = mysqli_connect("localhost", "root", "", "tiny_college");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

$id = $_GET['id'];
$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT student.*, department.*, professor.* 
    FROM student 
    LEFT JOIN department ON student.dept_code = department.dept_code 
    LEFT JOIN professor ON student.prof_num = professor.prof_num WHERE stu_num = $id"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
    $query = mysqli_query($conn, "DELETE FROM student WHERE stu_num = $id");
    header("Location: /tiny-college/?page=student/index");
    exit();
    //code...
    } catch (\Throwable $th) {
        echo "<div class='container alert alert-danger'>This record cannot be deleted because it is referenced as a foreign key in another table.</div>";
    }
}
?>

<div class="container mt-4">
    <h2>Delete Student</h2>
    <p>Are you sure you want to delete the following student?</p>
    <ul>
        <li><strong>Name:</strong> <?= $row['stu_fname'] ?> <?= $row['stu_initial'] ?>. <?= $row['stu_lname'] ?></li>
        <li><strong>Email:</strong> <?= $row['stu_email'] ?></li>
        <li><strong>Department:</strong> <?= $row['dept_code'] ?></li>
        <li><strong>Professor:</strong> <?= $row['prof_num'] ?></li>
    </ul>
    <form method="post">
        <button class="btn btn-danger">Delete</button>
        <a href="?page=student/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>
