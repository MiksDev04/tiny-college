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

$query = "SELECT e.class_code, c.class_section, e.stu_num, s.stu_lname, s.stu_fname, e.enroll_date, e.enroll_grade
          FROM enroll e
          JOIN class c ON e.class_code = c.class_code
          JOIN student s ON e.stu_num = s.stu_num";

$result = mysqli_query($conn, $query);
?>


<div class="container mt-4">
    <h2>Enrollment List</h2>
    <a href="?page=enroll/create" class="btn btn-primary mb-3">Add New Enrollment</a>
    <?php if (mysqli_num_rows($result) > 0) { ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Class Section</th>
                        <th>Student Name</th>
                        <th>Enrollment Date</th>
                        <th>Grade</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= $row['class_section'] ?></td>
                            <td><?= $row['stu_lname'] . ', ' . $row['stu_fname'] ?></td>
                            <td><?= $row['enroll_date'] ?></td>
                            <td><?= $row['enroll_grade'] ?></td>
                            <td>
                                <a href="?page=enroll/update&class_code=<?= $row['class_code'] ?>&stu_num=<?= $row['stu_num'] ?>" class="btn btn-warning">Edit</a>
                                <a href="?page=enroll/delete&class_code=<?= $row['class_code'] ?>&stu_num=<?= $row['stu_num'] ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } else { ?>
        <div class="alert alert-info" role="alert">
            No enrollment found. Please create a new enrollment record.
        </div>
    <?php } ?>
</div>