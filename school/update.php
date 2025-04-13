<?php
$conn = mysqli_connect('localhost', 'root', '', 'tiny_college');
if (!$conn) die("Connection failed: " . mysqli_connect_error());

$school_code = $_GET['school_code'];
$school = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM school WHERE school_code='$school_code'"));
$profs = mysqli_query($conn, "SELECT * FROM professor");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $school_name = $_POST['school_name'];
    $prof_num = $_POST['prof_num'];
    $sql = "UPDATE school SET school_name='$school_name', prof_num='$prof_num' WHERE school_code='$school_code'";
    mysqli_query($conn, $sql);
    header("Location: /tiny-college/?page=school/index");
    exit();
}
?>

<div class="container mt-4">
    <h2>Update School</h2>
    <form method="POST" action="school/update.php?school_code=<?= $school_code ?>">
        <div class="mb-3">
            <label>School Name</label>
            <input type="text" name="school_name" value="<?= $school['school_name'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Professor</label>
            <select name="prof_num" class="form-select" required>
                <option value="">-- Select Professor(Head) --</option>
                <?php while ($row = mysqli_fetch_assoc($profs)): ?>
                    <option value="<?= $row['prof_num'] ?>" <?= ($row['prof_num'] == $school['prof_num']) ? 'selected' : '' ?>>
                    Prof. <?= $row['prof_lname'] ?>, <?= $row['prof_fname'] ?> <?= $row['prof_initial'] ?>.
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <button class="btn btn-primary" type="submit">Update</button>
        <a href="?page=school/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>
