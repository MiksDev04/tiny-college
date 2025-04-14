<?php

$conn = mysqli_connect("localhost", "root", "", "tiny_college");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM professor";
$result = mysqli_query($conn, $sql);
?>

<div class="container mt-4">
    <h2>Professor Records</h2>
    <a href="?page=professor/create" class="btn btn-success mb-3">Add New Professor</a>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Dept. Code</th>
                        <th>Specialty</th>
                        <th>Rank</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Initial</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row['prof_num'] ?></td>
                            <td><?= $row['dept_code'] ?></td>
                            <td><?= $row['prof_specialty'] ?></td>
                            <td><?= $row['prof_rank'] ?></td>
                            <td><?= $row['prof_lname'] ?></td>
                            <td><?= $row['prof_fname'] ?></td>
                            <td><?= $row['prof_initial'] ?></td>
                            <td><?= $row['prof_email'] ?></td>
                            <td>
                                <a href="?page=professor/update&id=<?= $row['prof_num'] ?>" class="btn btn-warning btn-sm">Update</a>
                                <a href="?page=professor/delete&id=<?= $row['prof_num'] ?>" class="btn btn-danger btn-sm">Delete</a>
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