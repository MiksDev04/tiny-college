<?php
$conn = mysqli_connect("localhost", "root", "", "tiny_college");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM class WHERE class_code = $id"));

$professors = mysqli_query($conn, "SELECT prof_num, CONCAT(prof_fname, ' ', prof_lname) AS prof_name FROM professor");
$semesters = mysqli_query($conn, "SELECT semester_code, semester_year FROM semester");
$rooms = mysqli_query($conn, "SELECT room_code, room_type FROM room");
$courses = mysqli_query($conn, "SELECT crs_code, crs_title FROM course");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $section = $_POST['class_section'];
    $time = $_POST['class_time'];
    $crs_code = $_POST['crs_code'];
    $prof_num = $_POST['prof_num'];
    $room_code = $_POST['room_code'];
    $semester_code = $_POST['semester_code'];

    $sql = "UPDATE class SET 
            class_section='$section', class_time='$time', crs_code='$crs_code',
            prof_num='$prof_num', room_code='$room_code', semester_code='$semester_code'
            WHERE class_code=$id";

    mysqli_query($conn, $sql);
    header("Location: /tiny-college/?page=class/index");
    exit();
}
?>

<div class="container mt-4">
    <h2>Update Class</h2>
    <form method="post"  action="class/update.php?id=<?= $id ?>">
        <div class="mb-3"><label>Section</label><input type="text" name="class_section" value="<?= $data['class_section'] ?>" class="form-control" required></div>
        <div class="mb-3"><label>Time</label><input type="time" name="class_time" value="<?= $data['class_time'] ?>" class="form-control" required></div>
        <div class="mb-3">
            <label>Course</label>
            <select name="crs_code" class="form-select" required>
                <option value="">-- Select Course --</option>
                <?php while ($c = mysqli_fetch_assoc($courses)): ?>
                    <option value="<?= $c['crs_code'] ?>" <?= $c['crs_code'] == $data['crs_code'] ? 'selected' : '' ?>>
                        <?= $c['crs_title'] ?>
                    </option>
                <?php endwhile ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Professor</label>
            <select name="prof_num" class="form-select" required>
                <?php while ($p = mysqli_fetch_assoc($professors)): ?>
                    <option value="<?= $p['prof_num'] ?>" <?= $p['prof_num'] == $data['prof_num'] ? 'selected' : '' ?>>
                        <?= $p['prof_name'] ?>
                    </option>
                <?php endwhile ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Room</label>
            <select name="room_code" class="form-select" required>
                <option value="">-- Select Room --</option>
                <?php while ($r = mysqli_fetch_assoc($rooms)): ?>
                    <option value="<?= $r['room_code'] ?>" <?= $r['room_code'] == $data['room_code'] ? 'selected' : '' ?>>
                        <?= $r['room_type'] ?>
                    </option>
                <?php endwhile ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Semester</label>
            <select name="semester_code" class="form-select" required>
                <?php while ($s = mysqli_fetch_assoc($semesters)): ?>
                    <option value="<?= $s['semester_code'] ?>" <?= $s['semester_code'] == $data['semester_code'] ? 'selected' : '' ?>>
                        <?= $s['semester_year'] ?>
                    </option>
                <?php endwhile ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="?page=class/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>