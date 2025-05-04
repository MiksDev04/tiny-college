<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./includes/style.css">
    <link rel="stylesheet" href="./bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    
    <title>Document</title>
    <!-- Set theme early -->
    <script>
        (function() {
            const theme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-bs-theme', theme);
        })();
    </script>
</head>

<body>

    <div class=" min-vh-100">



        <?php
        include "./includes/navbar.php"; // Include the navigation bar

        $page = isset($_GET['page']) ? $_GET['page'] : 'account/login';
        $allowed_pages = [
            'includes/home',
            'building/index',
            'building/create',
            'building/update',
            'building/delete',
            'semester/index',
            'semester/create',
            'semester/update',
            'semester/delete',
            'room/index',
            'room/create',
            'room/update',
            'room/delete',
            'professor/index',
            'professor/create',
            'professor/update',
            'professor/delete',
            'school/index',
            'school/create',
            'school/update',
            'school/delete',
            'department/index',
            'department/create',
            'department/update',
            'department/delete',
            'course/index',
            'course/create',
            'course/update',
            'course/delete',
            'student/index',
            'student/create',
            'student/update',
            'student/delete',
            'enroll/index',
            'enroll/create',
            'enroll/update',
            'enroll/delete',
            'class/index',
            'class/create',
            'class/update',
            'class/delete',
            'includes/contact',
        ];

        if (!in_array($page, $allowed_pages)) {
            $page = 'includes/home'; // Default to home if the page is not allowed
        }
        include "$page.php"; // Include the requested page

        include "./includes/footer.php";
        ?>

    </div>

    <script src="./bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
</body>

</html>