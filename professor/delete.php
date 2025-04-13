<?php
$conn = mysqli_connect("localhost", "root", "", "tiny_college");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET['id'];
$sql = "SELECT * FROM professor WHERE prof_num = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $sql = "DELETE FROM professor WHERE prof_num = $id";
        mysqli_query($conn, $sql);
        header("Location: /tiny-college/?page=professor/index");
        exit();
    } catch (\Throwable $th) {
        echo "<div class='container alert alert-danger'>This record cannot be deleted because it is referenced as a foreign key in another table.</div>";
    }
}
?>

<div class="container mt-4">
    <h2>Delete Professor</h2>
    <p>Are you sure you want to delete the following professor?</p>
    <ul>
        <li><strong>Professor ID:</strong> <?= $row['prof_num'] ?></li>
        <li><strong>Department Code:</strong> <?= $row['dept_code'] ?></li>
        <li><strong>Specialty:</strong> <?= htmlspecialchars($row['prof_specialty']) ?></li>
        <li><strong>Rank:</strong> <?= htmlspecialchars($row['prof_rank']) ?></li>
        <li><strong>Last Name:</strong> <?= htmlspecialchars($row['prof_lname']) ?></li>
        <li><strong>First Name:</strong> <?= htmlspecialchars($row['prof_fname']) ?></li>
        <li><strong>Initial:</strong> <?= htmlspecialchars($row['prof_initial']) ?></li>
        <li><strong>Email:</strong> <?= htmlspecialchars($row['prof_email']) ?></li>
    </ul>
    <form method="post">
        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
        <a href="?page=professor/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>