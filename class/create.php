<?php
$conn = mysqli_connect("localhost", "root", "", "tiny_college");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

$professors = mysqli_query($conn, "SELECT prof_num, CONCAT(prof_fname, ' ', prof_lname) AS prof_name FROM professor");
$semesters = mysqli_query($conn, "SELECT semester_code, semester_year FROM semester");
$courses = mysqli_query($conn, "SELECT crs_code, crs_title FROM course");
$rooms = mysqli_query($conn, "SELECT room_code, room_type FROM room");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $section = $_POST['class_section'];
    $time = $_POST['class_time'];
    $crs_code = $_POST['crs_code'];
    $prof_num = $_POST['prof_num'];
    $room_code = $_POST['room_code'];
    $semester_code = $_POST['semester_code'];

    $sql = "INSERT INTO class (class_code, class_section, class_time, crs_code, prof_num, room_code, semester_code)
            VALUES (NULL, '$section', '$time', '$crs_code', '$prof_num', '$room_code', '$semester_code')";

    mysqli_query($conn, $sql);
    header("Location: /tiny-college/?page=class/index");
    exit();
}
?>

<div class="container mt-4">
    <h2>Create Class</h2>
    <form method="post" action="class/create.php">
        <div class="mb-3"><label>Section</label><input type="text" name="class_section" class="form-control" required></div>
        <div class="mb-3"><label>Time</label><input type="time" name="class_time" class="form-control" required></div>
        <div class="mb-3">
            <label>Course</label>
            <select name="crs_code" class="form-select" required>
                <option value="">-- Select Course --</option>
                <?php while ($c = mysqli_fetch_assoc($courses)): ?>
                    <option value="<?= $c['crs_code'] ?>"><?= $c['crs_title'] ?></option>
                <?php endwhile ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Professor</label>
            <select name="prof_num" class="form-select" required>
                <option value="">-- Select Professor --</option>
                <?php while ($p = mysqli_fetch_assoc($professors)): ?>
                    <option value="<?= $p['prof_num'] ?>"><?= $p['prof_name'] ?></option>
                <?php endwhile ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Room</label>
            <select name="room_code" class="form-select" required>
                <option value="">-- Select Room --</option>
                <?php while ($r = mysqli_fetch_assoc($rooms)): ?>
                    <option value="<?= $r['room_code'] ?>"><?= $r['room_type'] ?></option>
                <?php endwhile ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Semester</label>
            <select name="semester_code" class="form-select" required>
                <option value="">-- Select Semester --</option>
                <?php while ($s = mysqli_fetch_assoc($semesters)): ?>
                    <option value="<?= $s['semester_code'] ?>"><?= $s['semester_year'] ?></option>
                <?php endwhile ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
        <a href="?page=class/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>