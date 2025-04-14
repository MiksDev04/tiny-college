<?php
$conn = mysqli_connect("localhost", "root", "", "tiny_college");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM student WHERE stu_num = $id"));
$departments = mysqli_query($conn, "SELECT * FROM department");
$professors = mysqli_query($conn, "SELECT * FROM professor");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dept = $_POST['dept_code'];
    $prof = $_POST['prof_num'];
    $lname = $_POST['stu_lname'];
    $fname = $_POST['stu_fname'];
    $initial = $_POST['stu_initial'];
    $email = $_POST['stu_email'];

    $sql = "UPDATE student SET dept_code='$dept', prof_num='$prof', stu_lname='$lname', 
            stu_fname='$fname', stu_initial='$initial', stu_email='$email' WHERE stu_num=$id";
    mysqli_query($conn, $sql);
    header("Location: /tiny-college/?page=student/index");
    exit();
}
?>

<div class="container mt-4">
    <h2>Update Student</h2>
    <form method="post" action="student/update.php?id=<?= $id ?>">
        <div class="mb-3"><label class="form-label">Department</label>
            <select name="dept_code" class="form-select" required>
                <option value="">-- Select Department --</option>
                <?php while ($row = mysqli_fetch_assoc($departments)) : ?>
                    <option value="<?= $row['dept_code'] ?>" <?= $data['dept_code'] == $row['dept_code'] ? 'selected' : '' ?>>
                        <?= $row['dept_name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3"><label class="form-label">Professor</label>
            <select name="prof_num" class="form-select" required>
                <option value="">-- Select Professor --</option>
                <?php while ($row = mysqli_fetch_assoc($professors)) : ?>
                    <option value="<?= $row['prof_num'] ?>" <?= $data['prof_num'] == $row['prof_num'] ? 'selected' : '' ?>>
                        <?= $row['prof_fname'] ?> <?= $row['prof_lname'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3"><label class="form-label">Last Name</label><input name="stu_lname" value="<?= $data['stu_lname'] ?>" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">First Name</label><input name="stu_fname" value="<?= $data['stu_fname'] ?>" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Initial</label><input name="stu_initial" maxlength="1" value="<?= $data['stu_initial'] ?>" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Email</label><input name="stu_email" type="email" value="<?= $data['stu_email'] ?>" class="form-control" required></div>
        <button class="btn btn-primary">Update</button>
        <a href="?page=student/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>