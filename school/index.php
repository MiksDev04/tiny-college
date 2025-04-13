<?php
$conn = mysqli_connect('localhost', 'root', '', 'tiny_college');
if (!$conn) die("Connection failed: " . mysqli_connect_error());

$result = mysqli_query($conn, "SELECT * FROM school");
?>

<div class="container mt-4">
    <h2>School List</h2>
    <a href="?page=school/create" class="btn btn-success mb-3">Create New School</a>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>School Code</th>
                        <th>School Name</th>
                        <th>Professor ID</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row['school_code'] ?></td>
                            <td><?= $row['school_name'] ?></td>
                            <td><?= $row['prof_num'] ?></td>
                            <td>
                                <a href="?page=school/update&school_code=<?= $row['school_code'] ?>" class="btn btn-warning btn-sm">Update</a>
                                <a href="?page=school/delete&school_code=<?= $row['school_code'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <!-- No records found message -->
        <div class="alert alert-info" role="alert">
            No school found. Please create a new school record.
        </div>
    <?php endif; ?>
</div>