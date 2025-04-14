<?php
$conn = mysqli_connect("localhost", "root", "", "tiny_college");
$departments = mysqli_query($conn, "SELECT * FROM department");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['crs_code'];
    $dept = $_POST['dept_code'];
    $title = $_POST['crs_title'];
    $desc = $_POST['crs_description'];
    $credit = $_POST['crs_credit'];

    mysqli_query($conn, "INSERT INTO course ( dept_code, crs_title, crs_description, crs_credit)
                         VALUES ( '$dept', '$title', '$desc', '$credit')");
    header("Location: ?page=course/index");
    exit();
}
?>

<div class="container mt-4">
    <h2>Add Course</h2>
    <form method="post" action="course/create.php">
        <div class="mb-3"><label>Title</label><input name="crs_title" class="form-control" required></div>
        <div class="mb-3"><label>Description</label><textarea name="crs_description" class="form-control"></textarea></div>
        <div class="mb-3"><label>Credit</label><input name="crs_credit" type="number" class="form-control" required></div>
        <div class="mb-3">
            <label>Department</label>
            <select name="dept_code" class="form-select" required>
                <option value="">-- Select Department --</option>
                <?php while ($d = mysqli_fetch_assoc($departments)): ?>
                    <option value="<?= $d['dept_code'] ?>"><?= htmlspecialchars($d['dept_name']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <button class="btn btn-success">Create</button>
        <a href="?page=course/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>
