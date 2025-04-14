<?php
// Include DB connection
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'tiny_college'; // Replace with your actual database name
$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$class_code = $_GET['class_code'];
$stu_num = $_GET['stu_num'];

// Fetch record to delete
$query = "SELECT e.class_code, c.class_section, e.stu_num, s.stu_lname, s.stu_fname, e.enroll_date, e.enroll_grade
          FROM enroll e
          JOIN class c ON e.class_code = c.class_code
          JOIN student s ON e.stu_num = s.stu_num
          WHERE e.class_code = '$class_code' AND e.stu_num = '$stu_num'";

$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Delete the record
    $delete_query = "DELETE FROM enroll WHERE class_code = '$class_code' AND stu_num = '$stu_num'";

    try {
        mysqli_query($conn, $delete_query);
        header("Location: /tiny-college/?page=enroll/index");
        exit();
        //code...
    } catch (\Throwable $th) {
        header("Location: /tiny-college/?page=enroll/delete&class_code=$class_code&stu_num=$stu_num&error=foreign_key");
        exit();
    }
}

mysqli_close($conn);
?>

<?php if (isset($_GET['error']) && $_GET['error'] == 'foreign_key'): ?>
    <div class="container alert alert-danger">
        This record cannot be deleted because it is referenced as a foreign key in another table.
    </div>
<?php endif; ?>
<div class="container mt-4">
    <h2>Delete Enrollment</h2>
    <p><strong>Class Section:</strong> <?= $row['class_section'] ?></p>
    <p><strong>Student Name:</strong> <?= $row['stu_lname'] . ', ' . $row['stu_fname'] ?></p>
    <p><strong>Enrollment Date:</strong> <?= $row['enroll_date'] ?></p>
    <p><strong>Grade:</strong> <?= $row['enroll_grade'] ?></p>

    <form action="?page=enroll/delete&class_code=<?= $row['class_code'] ?>&stu_num=<?= $row['stu_num'] ?>" method="POST">
        <button type="submit" class="btn btn-danger">Confirm Delete</button>
        <a href="?page=enroll/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>