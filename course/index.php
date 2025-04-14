<?php
$conn = mysqli_connect("localhost", "root", "", "tiny_college");
$courses = mysqli_query($conn, "SELECT c.*, d.dept_name FROM course c LEFT JOIN department d ON c.dept_code = d.dept_code");
?>

<div class="container mt-4">
    <h2>Course List</h2>
    <a href="?page=course/create" class="btn btn-success mb-3">Add Course</a>
    <?php if (mysqli_num_rows($courses) > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Title</th>
                        <th>Credit</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($courses)): ?>
                        <tr>
                            <td><?= $row['crs_code'] ?></td>
                            <td><?= htmlspecialchars($row['crs_title']) ?></td>
                            <td><?= $row['crs_credit'] ?></td>
                            <td><?= htmlspecialchars($row['dept_name']) ?></td>
                            <td>
                                <a href="?page=course/update&id=<?= $row['crs_code'] ?>" class="btn btn-warning btn-sm">Update</a>
                                <a href="?page=course/delete&id=<?= $row['crs_code'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info" role="alert">
            No professor found. Please create a new professor record.
        </div>
    <?php endif; ?>
</div>