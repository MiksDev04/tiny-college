<?php 

$conn = mysqli_connect("localhost", "root", "", "tiny_college");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$code = $_GET['dept_code'];
$sql = "SELECT * FROM department WHERE dept_code = '$code'";
$result = mysqli_query($conn, $sql);
$dept = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $sql = "DELETE FROM department WHERE dept_code = '$code'";
        mysqli_query($conn, $sql);
        header("Location: /tiny-college/?page=department/index");
        exit();
    } catch (\Throwable $th) {
        echo "<div class='container alert alert-danger'>This record cannot be deleted because it is referenced as a foreign key in another table.</div>";
    }
}
?>


<div class="container mt-4">
    <h2>Delete Department</h2>
    <p>Are you sure you want to delete this department?</p>
    <ul>
        <li><strong>Code:</strong> <?= $dept['dept_code'] ?></li>
        <li><strong>Name:</strong> <?= $dept['dept_name'] ?></li>
        <li><strong>School Code:</strong> <?= $dept['school_code'] ?></li>
        <li><strong>Prof Num:</strong> <?= $dept['prof_num'] ?></li>
    </ul>
    <form method="POST" action="department/delete.php?dept_code=<?= $code ?>">
        <button class="btn btn-danger">Delete</button>
        <a href="?page=department/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php mysqli_close($conn); ?>