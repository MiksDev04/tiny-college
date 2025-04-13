<?php
$conn = mysqli_connect("localhost", "root", "", "tiny_college");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

$departments = mysqli_query($conn, "SELECT * FROM department");
$professors = mysqli_query($conn, "SELECT * FROM professor");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dept = $_POST['dept_code'];
    $prof = $_POST['prof_num'];
    $lname = $_POST['stu_lname'];
    $fname = $_POST['stu_fname'];
    $initial = $_POST['stu_initial'];
    $email = $_POST['stu_email'];

    $sql = "INSERT INTO student (stu_num, dept_code, stu_lname, stu_fname, stu_initial, stu_email, prof_num)
            VALUES (NULL, '$dept', '$lname', '$fname', '$initial', '$email', '$prof')";
    mysqli_query($conn, $sql);
    header("Location: /tiny-college/?page=student/index");
    exit();
}
?>


<div class="container mt-4">
    <h2>Create Student</h2>
    <form method="post">
        <div class="mb-3"><label class="form-label">Department</label>
            <select name="dept_code" class="form-select" required>
                <option value="">-- Select Department --</option>
                <?php while ($row = mysqli_fetch_assoc($departments)) : ?>
                    <option value="<?= $row['dept_code'] ?>"><?= $row['dept_name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3"><label class="form-label">Professor</label>
            <select name="prof_num" class="form-select" required>
                <option value="">-- Select Professor --</option>
                <?php while ($row = mysqli_fetch_assoc($professors)) : ?>
                    <option value="<?= $row['prof_num'] ?>"><?= $row['prof_fname'] ?> <?= $row['prof_lname'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3"><label class="form-label">Last Name</label><input name="stu_lname" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">First Name</label><input name="stu_fname" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Initial</label><input name="stu_initial" maxlength="1" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Email</label><input name="stu_email" type="email" class="form-control" required></div>
        <button class="btn btn-success">Create</button>
        <a href="?page=student/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>

