<?php
// Include DB connection
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'tiny_college'; // Replace with your actual database name
$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}   

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $class_code = $_POST['class_code'];
    $stu_num = $_POST['stu_num'];
    $enroll_date = $_POST['enroll_date'];
    $enroll_grade = $_POST['enroll_grade'];

    $query = "INSERT INTO enroll (class_code, stu_num, enroll_date, enroll_grade) 
              VALUES ('$class_code', '$stu_num', '$enroll_date', '$enroll_grade')";

    mysqli_query($conn, $query);
    header("Location: /tiny-college/?page=enroll/index");
    exit();
}

$class_query = "SELECT class_code, class_section FROM class";
$student_query = "SELECT stu_num, CONCAT(stu_lname, ', ', stu_fname) AS full_name FROM student";
$class_result = mysqli_query($conn, $class_query);
$student_result = mysqli_query($conn, $student_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Enrollment</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Create Enrollment</h2>
        <form  method="POST">
            <div class="mb-3">
                <label for="class_code">Class Section</label>
                <select name="class_code" id="class_code" class="form-control" required>
                    <option value=""> --Select Class--</option>
                    <?php while ($row = mysqli_fetch_assoc($class_result)) { ?>
                        <option value="<?= $row['class_code'] ?>"><?= $row['class_section'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="stu_num">Student Name</label>
                <select name="stu_num" id="stu_num" class="form-control" required>
                    <option value=""> --Select Student-- </option>
                    <?php while ($row = mysqli_fetch_assoc($student_result)) { ?>
                        <option value="<?= $row['stu_num'] ?>"><?= $row['full_name'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="enroll_date">Enrollment Date</label>
                <input type="date" name="enroll_date" id="enroll_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="enroll_grade">Grade</label>
                <input type="text" name="enroll_grade" id="enroll_grade" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Enrollment</button>
            <a href="?page=enroll/index" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
