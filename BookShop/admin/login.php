<?php require "../inc/config.php"; ?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styling login page -->
    <link href="../css/login-admin.css">
</head>
<body class="d-flex align-items-center" style="height: 100vh;">
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">کتاب پلاس</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <div class="row justify-content-center w-100">
                <div class="col-8">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="http://localhost/BookShop/index.php">صفحه اصلی</a></li>
                        <li class="nav-item"><a class="nav-link" href="http://localhost/BookShop/cart.php">سبد خرید</a></li>
                        <li class="nav-item"><a class="nav-link active" href="http://localhost/BookShop/admin/<?php if(isset($_SESSION['admin'])){ echo 'index.php';} else{echo 'login.php';}   ?>">ورود/پنل ادمین</a></li>

                    </ul>
                </div>
                <div class="col-4">
                    <form action="http://localhost/BookShop/index.php" method="get" class="d-flex me-auto">
                        <input class="form-control me-2" type="search" name="search" placeholder="جستجوی عنوان کتاب" aria-label="Search">
                        <button class="btn btn-primary" type="submit" name="search-btn">برو</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-center">ورود مدیر</h5>
                    <form action="" method="post">
                        <div class="mb-3 text-right">
                            <label for="name" class="form-label">نام</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="نام" required>
                        </div>
                        <div class="mb-3 text-right">
                            <label for="pass" class="form-label">رمز عبور</label>
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="رمز عبور" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" name="submit">ورود</button>
                    </form>
                </div>
            </div>
            <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
                <?php
                $name = $_POST['name'];
                $pass = $_POST['pass'];
                $query = mysqli_query($connection, "SELECT * FROM admins WHERE name = '$name' AND password = '$pass'");
                if (mysqli_num_rows($query) == 1) {
                    $_SESSION['admin'] = $name;
                    header('Location: index.php');
                } else {
                    echo '<div class="alert alert-danger mt-3 text-center">نام کاربری یا رمز عبور اشتباه است</div>';
                }
                ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>

</body>
</html>
