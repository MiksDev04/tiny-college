<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'tiny_college'; // Replace with your actual database name

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Only run this when form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check user
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user_name'] = $user['fullname'];
        header("Location: /tiny-college/?page=includes/home");
        session_start();

        exit();
    } else {
        echo "<div class='container alert alert-danger text-center'>Account doesn't exist. Register first to login</div>";
    }
}
?>

<!-- HTML FORM -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded-4">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Login</h3>

                    <!-- Show error if login failed -->
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Login</button>
                        </div>
                        <p class="text-center mt-3">Don't have an account? <a href="?page=account/register">Register here</a>.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>