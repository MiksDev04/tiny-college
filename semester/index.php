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

$sql = "SELECT * FROM semester";
$result = $conn->query($sql);
?>


<div class="container mt-5">
    <h2>Semesters</h2>
    <a href="?page=semester/create" class="btn btn-success mb-3">Create New Semester</a>

    <!-- Check if there are records, otherwise show an empty state message -->
    <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Semester Code</th>
                        <th scope="col">Year</th>
                        <th scope="col">Term</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['semester_code']; ?></td>
                            <td><?php echo $row['semester_year']; ?></td>
                            <td><?php echo $row['semester_term']; ?></td>
                            <td><?php echo $row['semester_start_date']; ?></td>
                            <td><?php echo $row['semester_end_date']; ?></td>
                            <td>
                                <a href="?page=semester/update&semester_code=<?php echo $row['semester_code']; ?>" class="btn btn-warning">Update</a>
                                <a href="?page=semester/delete&semester_code=<?php echo $row['semester_code']; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <!-- No records found message -->
        <div class="alert alert-info" role="alert">
            No semester found. Please create a new semester record.
        </div>
    <?php endif; ?>
</div>