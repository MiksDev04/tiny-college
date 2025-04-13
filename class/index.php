<?php
$conn = mysqli_connect("localhost", "root", "", "tiny_college");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

$result = mysqli_query($conn, "SELECT c.*, p.prof_fname, p.prof_lname, s.semester_year 
    FROM class c 
    LEFT JOIN professor p ON c.prof_num = p.prof_num 
    LEFT JOIN semester s ON c.semester_code = s.semester_code");

?>

<div class="container mt-4">
    <h2>Class List</h2>
    <a href="?page=class/create" class="btn btn-success mb-3">Create New Class</a>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Section</th>
                        <th>Time</th>
                        <th>Course Code</th>
                        <th>Professor</th>
                        <th>Room</th>
                        <th>Semester</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row['class_code'] ?></td>
                            <td><?= $row['class_section'] ?></td>
                            <td><?= $row['class_time'] ?></td>
                            <td><?= $row['crs_code'] ?></td>
                            <td><?= $row['prof_fname'] . ' ' . $row['prof_lname'] ?></td>
                            <td><?= $row['room_code'] ?></td>
                            <td><?= $row['semester_year'] ?></td>
                            <td>
                                <a href="?page=class/update&id=<?= $row['class_code'] ?>" class="btn btn-primary btn-sm">Update</a>
                                <a href="?page=class/delete&id=<?= $row['class_code'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">No records found.</div>
    <?php endif ?>
</div>