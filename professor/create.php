<?php
$conn = mysqli_connect("localhost", "root", "", "tiny_college");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dept_code = $_POST['dept_code'];
    $specialty = $_POST['prof_specialty'];
    $rank = $_POST['prof_rank'];
    $lname = $_POST['prof_lname'];
    $fname = $_POST['prof_fname'];
    $initial = $_POST['prof_initial'];
    $email = $_POST['prof_email'];

    $sql = "INSERT INTO professor ( dept_code, prof_specialty, prof_rank, prof_lname, prof_fname, prof_initial, prof_email)
            VALUES ('$dept_code', '$specialty', '$rank', '$lname', '$fname', '$initial', '$email')";

    mysqli_query($conn, $sql);
    header("Location: /tiny-college/?page=professor/index");
    exit();
}

// Fetch departments
$departments = mysqli_query($conn, "SELECT dept_code, dept_name FROM department");
?>

<div class="container mt-4">
    <h2>Create New Professor</h2>
    <form method="post" action="professor/create.php">
        <div class="mb-3">
            <label class="form-label">Department Name</label>
            <select name="dept_code" class="form-select" required>
                <option value="">-- Select Department --</option>
                <?php while ($row = mysqli_fetch_assoc($departments)) : ?>
                    <option value="<?= $row['dept_code'] ?>"><?= htmlspecialchars($row['dept_name']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3"><label class="form-label">Specialty</label><input type="text" name="prof_specialty" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Rank</label><input type="text" name="prof_rank" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Last Name</label><input type="text" name="prof_lname" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">First Name</label><input type="text" name="prof_fname" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Initial</label><input type="text" name="prof_initial" maxlength="1" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Email</label><input type="email" name="prof_email" class="form-control" required></div>
        <button type="submit" class="btn btn-success">Create</button>
        <a href="?page=professor/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>
