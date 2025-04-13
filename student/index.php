<?php
$conn = mysqli_connect("localhost", "root", "", "tiny_college");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

$result = mysqli_query($conn, "SELECT student.*, department.*, professor.* 
    FROM student 
    LEFT JOIN department ON student.dept_code = department.dept_code 
    LEFT JOIN professor ON student.prof_num = professor.prof_num");
?>


<div class="container mt-4">
    <h2>Student Records</h2>
    <a href="?page=student/create" class="btn btn-success mb-3">Create New Student</a>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Professor</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?= $row['stu_num'] ?></td>
                            <td><?= $row['stu_fname'] ?> <?= $row['stu_initial'] ?>. <?= $row['stu_lname'] ?></td>
                            <td><?= $row['stu_email'] ?></td>
                            <td><?= $row['dept_name'] ?></td>
                            <td>Prof. <?= $row['prof_lname'] ?>, <?= $row['prof_fname'] ?> <?= $row['prof_initial'] ?>.</td>
                            <td>
                                <a href="?page=student/update&id=<?= $row['stu_num'] ?>" class="btn btn-primary btn-sm">Update</a>
                                <a href="?page=student/delete&id=<?= $row['stu_num'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info">No student records found.</div>
    <?php endif; ?>
</div>