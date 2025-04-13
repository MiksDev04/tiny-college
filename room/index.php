<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'tiny_college';

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM room";
$result = mysqli_query($conn, $sql);
?>


<div class="container mt-4">
    <h2>Room List</h2>
    <a href="?page=room/create" class="btn btn-success mb-3">Create New Room</a>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Room Code</th>
                        <th>Room Type</th>
                        <th>Building Code</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row['room_code'] ?></td>
                            <td><?= $row['room_type'] ?></td>
                            <td><?= $row['bldg_code'] ?></td>
                            <td>
                                <a href="?page=room/update&room_code=<?= $row['room_code'] ?>" class="btn btn-warning btn-sm">Update</a>
                                <a href="?page=room/delete&room_code=<?= $row['room_code'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info" role="alert">
            No rooms found. Please create a new room.
        </div>
    <?php endif; ?>
</div>