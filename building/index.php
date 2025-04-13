<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'tiny_college'; // Replace with your actual database name

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$result = $conn->query("SELECT * FROM building");
?>

<div class="container mt-5">
    <h2>Building List</h2>
    <a href="?page=building/create" class="btn btn-success mb-3">Create New Building</a>

    <?php
    if ($result->num_rows > 0):
    ?>
        <div class="table-responsive">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()):
                    ?>
                        <tr>
                            <td><?= $row['bldg_code'] ?></td>
                            <td><?= $row['bldg_name'] ?></td>
                            <td><?= $row['bldg_location'] ?></td>
                            <td>
                                <a href="?page=building/update&bldg_code=<?= $row['bldg_code'] ?>" class="btn btn-warning btn-sm">Update</a>
                                <a href="?page=building/delete&bldg_code=<?= $row['bldg_code'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <!-- No records found message -->
        <div class="alert alert-info" role="alert">
            No building found. Please create a new building record.
        </div>
    <?php endif; ?>
</div>