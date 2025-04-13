<?php 

$conn = mysqli_connect("localhost", "root", "", "tiny_college");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM department";
$result = mysqli_query($conn, $sql);
?>

<div class="container mt-4">
    <h2>Department List</h2>
    <a href="?page=department/create" class="btn btn-success mb-3">Create New Department</a>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Dept Code</th>
                        <th>Name</th>
                        <th>School Code</th>
                        <th>Prof Num</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row['dept_code'] ?></td>
                            <td><?= $row['dept_name'] ?></td>
                            <td><?= $row['school_code'] ?></td>
                            <td><?= $row['prof_num'] ?></td>
                            <td>
                                <a href="?page=department/update&dept_code=<?= $row['dept_code'] ?>" class="btn btn-warning btn-sm">Update</a>
                                <a href="?page=department/delete&dept_code=<?= $row['dept_code'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info" role="alert">
            No department found. Please create a new department record.
        </div>
    <?php endif; ?>
</div>