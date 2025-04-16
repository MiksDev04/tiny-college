<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'tiny_college'; // Replace with your actual database name
$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$class_code = $_GET['class_code'];
$stu_num = $_GET['stu_num'];

// Fetch current record data
$query = "SELECT * FROM enroll WHERE class_code = '$class_code' AND stu_num = '$stu_num'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $class_code2 = $_POST['class_code'];
    $stu_num2 = $_POST['stu_num'];
    $enroll_date = $_POST['enroll_date'];
    $enroll_grade = $_POST['enroll_grade'];

    $update_query = "UPDATE enroll SET class_code='$class_code2', stu_num='$stu_num2', enroll_date='$enroll_date', enroll_grade='$enroll_grade' 
                     WHERE class_code = '$class_code' AND stu_num = '$stu_num'";

    try {
        mysqli_query($conn, $update_query);
    header("Location: /tiny-college/?page=enroll/index");
    exit();
        //code...
    } catch (\Throwable $th) {
        header("Location: /tiny-college/?page=enroll/update&class_code=$class_code&stu_num=$stu_num&error=foreign_key");
        exit();
    }
}

$class_query = "SELECT class_code, class_section FROM class";
$student_query = "SELECT stu_num, CONCAT(stu_lname, ', ', stu_fname) AS full_name FROM student";
$class_result = mysqli_query($conn, $class_query);
$student_result = mysqli_query($conn, $student_query);
?>
<?php if (isset($_GET['error']) && $_GET['error'] == 'foreign_key'): ?>
    <div class="container alert alert-danger">
        This record cannot be updated into that because it is already existing in the table.
    </div>
<?php endif; ?>
<div class="container mt-3">
    <h2>Update Enrollment</h2>
    <form method="POST" action="enroll/update.php?class_code=<?= $class_code ?>&stu_num=<?= $stu_num ?>">
        <div class="mb-3">
            <label for="class_code">Class Section</label>
            <select name="class_code" id="class_code" class="form-control" required>
                <option value=""> --Select Class-- </option>
                <?php while ($class = mysqli_fetch_assoc($class_result)) { ?>
                    <option value="<?= $class['class_code'] ?>" <?= ($class['class_code'] == $row['class_code']) ? 'selected' : '' ?>><?= $class['class_section'] ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="stu_num">Student Name</label>
            <select name="stu_num" id="stu_num" class="form-control" required>
                <option value="">--Select Student--</option>
                <?php while ($student = mysqli_fetch_assoc($student_result)) { ?>
                    <option value="<?= $student['stu_num'] ?>" <?= ($student['stu_num'] == $row['stu_num']) ? 'selected' : '' ?>><?= $student['full_name'] ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="enroll_date">Enrollment Date</label>
            <input type="date" name="enroll_date" id="enroll_date" class="form-control" value="<?= $row['enroll_date'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="enroll_grade">Grade</label>
            <input type="text" name="enroll_grade" id="enroll_grade" class="form-control" value="<?= $row['enroll_grade'] ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Enrollment</button>
        <a href="?page=enroll/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>
