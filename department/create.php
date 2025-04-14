<?php 

$conn = mysqli_connect("localhost", "root", "", "tiny_college");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['dept_name'];
    $school = $_POST['school_code'];
    $prof = $_POST['prof_num'];

    $sql = "INSERT INTO department ( dept_name, school_code, prof_num)
            VALUES ('$name', '$school', '$prof')";
    mysqli_query($conn, $sql);
    header("Location: /tiny-college/?page=department/index");
    exit();
}

$schools = mysqli_query($conn, "SELECT * FROM school");
$profs = mysqli_query($conn, "SELECT * FROM professor");
?>

<div class="container mt-4">
    <h2>Create Department</h2>
    <form method="POST" action="department/create.php">
        <div class="mb-3">
            <label>Dept Name</label>
            <input type="text" name="dept_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>School Name</label>
            <select name="school_code" class="form-control" required>
                <option value="">-- Select School</option>
                <?php while ($s = mysqli_fetch_assoc($schools)): ?>
                    <option value="<?= $s['school_code'] ?>"><?= $s['school_name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Professor Name</label>
            <select name="prof_num" class="form-control" required>
                <option value="">-- Select Professor(Dean)</option>
                <?php while ($p = mysqli_fetch_assoc($profs)): ?>
                    <option value="<?= $p['prof_num'] ?>">Prof. <?= $p['prof_lname'] ?>, <?= $p['prof_fname'] ?> <?= $p['prof_initial'] ?>.</option>
                <?php endwhile; ?>
            </select>
        </div>
        <button class="btn btn-primary" type="submit">Create</button>
        <a href="?page=department/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php mysqli_close($conn); ?>