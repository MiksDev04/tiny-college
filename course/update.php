<?php
$conn = mysqli_connect("localhost", "root", "", "tiny_college");
$id = $_GET['id'];

$departments = mysqli_query($conn, "SELECT * FROM department");
$course = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM course WHERE crs_code = $id"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dept = $_POST['dept_code'];
    $title = $_POST['crs_title'];
    $desc = $_POST['crs_description'];
    $credit = $_POST['crs_credit'];

    mysqli_query($conn, "UPDATE course SET dept_code='$dept', crs_title='$title', crs_description='$desc', crs_credit='$credit'
                         WHERE crs_code = $id");
    header("Location: /tiny-college/?page=course/index");
    exit();
}
?>

<div class="container mt-4">
    <h2>Update Course</h2>
    <form method="post" action="course/update.php?id=<?= $id ?>">
        <div class="mb-3"><label>Title</label><input name="crs_title" value="<?= $course['crs_title'] ?>" class="form-control" required></div>
        <div class="mb-3"><label>Description</label><textarea name="crs_description" class="form-control"><?= $course['crs_description'] ?></textarea></div>
        <div class="mb-3"><label>Credit</label><input name="crs_credit" type="number" value="<?= $course['crs_credit'] ?>" class="form-control" required></div>
        <div class="mb-3">
            <label>Department</label>
            <select name="dept_code" class="form-select" required>
                <option value="">-- Select Department --</option>
                <?php while ($d = mysqli_fetch_assoc($departments)): ?>
                    <option value="<?= $d['dept_code'] ?>" <?= $d['dept_code'] == $course['dept_code'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($d['dept_name']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="?page=course/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>
