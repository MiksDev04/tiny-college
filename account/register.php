<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'tiny_college'; // Replace with your actual database name
$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    // Check if email already exists
    $check_email_query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $check_email_query);

    if (mysqli_num_rows($result) > 0) {
        echo "<div class='container alert alert-danger text-center'>Email is already taken.</div>";
    } else {
        // Insert user into the database
        $query = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$password')";

        if (mysqli_query($conn, $query)) {
            header("Location: /tiny-college/account/login.php"); // Redirect to login page after successful registration
            exit();
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./includes/style.css">
    <link rel="stylesheet" href="/tiny-college/bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded-4">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Register</h3>
                    <form method="POST">
                        <div class="form-floating mb-3">
                            <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Juan Dela Criz" required>
                            <label for="fullname" class="form-label">Full Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" id="email" class="form-control" placeholder="juandelacruz@gmail.com" required>
                            <label for="email" class="form-label">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" id="password" class="form-control" placeholder="1234" required>
                            <label for="password" class="form-label">Password</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Create Account</button>
                        </div>
                        <p class="text-center mt-3">Already have an account? <a href="/tiny-college/account/login.php">Login here</a>.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/tiny-college/bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
</body>

</html>