<?php
$conn = mysqli_connect("localhost", "root", "", "tiny_college");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET['id'];

// Get professor info
$sql = "SELECT * FROM professor WHERE prof_num = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Fetch all departments
$departments = mysqli_query($conn, "SELECT dept_code, dept_name FROM department");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dept_code = $_POST['dept_code'];
    $specialty = $_POST['prof_specialty'];
    $rank = $_POST['prof_rank'];
    $lname = $_POST['prof_lname'];
    $fname = $_POST['prof_fname'];
    $initial = $_POST['prof_initial'];
    $email = $_POST['prof_email'];

    $sql = "UPDATE professor SET
                dept_code='$dept_code',
                prof_specialty='$specialty',
                prof_rank='$rank',
                prof_lname='$lname',
                prof_fname='$fname',
                prof_initial='$initial',
                prof_email='$email'
            WHERE prof_num=$id";

    mysqli_query($conn, $sql);
    header("Location: /tiny-college/?page=professor/index");
    exit();
}
?>

<div class="container mt-4">
    <h2>Update Professor</h2>
    <form method="post" action="professor/update.php?id=<?= $id ?>">
        <div class="mb-3">
            <label class="form-label">Department Name</label>
            <select name="dept_code" class="form-select" required>
                <option value="">-- Select Department --</option>
                <?php while ($dept = mysqli_fetch_assoc($departments)) : ?>
                    <option value="<?= $dept['dept_code'] ?>" <?= $dept['dept_code'] == $row['dept_code'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($dept['dept_name']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3"><label class="form-label">Specialty</label><input type="text" name="prof_specialty" value="<?= $row['prof_specialty'] ?>" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Rank</label><input type="text" name="prof_rank" value="<?= $row['prof_rank'] ?>" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Last Name</label><input type="text" name="prof_lname" value="<?= $row['prof_lname'] ?>" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">First Name</label><input type="text" name="prof_fname" value="<?= $row['prof_fname'] ?>" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Initial</label><input type="text" name="prof_initial" maxlength="1" value="<?= $row['prof_initial'] ?>" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Email</label><input type="email" name="prof_email" value="<?= $row['prof_email'] ?>" class="form-control" required></div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="?page=professor/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>
