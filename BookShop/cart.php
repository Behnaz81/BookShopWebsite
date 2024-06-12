<?php require_once 'inc/config.php'; ?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>سبد خرید</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">کتاب پلاس</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <div class="row w-100">
                <div class="col-lg-8 col-12">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="index.php">صفحه اصلی</a></li>
                        <li class="nav-item"><a class="nav-link active" href="cart.php">سبد خرید</a></li>
                        <li class="nav-item"><a class="nav-link" href="http://localhost/BookShop/admin/<?php if(isset($_SESSION['admin'])){ echo 'index.php';} else{echo 'login.php';}?>">ورود/پنل ادمین</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-12">
                    <form action="index.php" method="get" class="d-flex">
                        <input class="form-control me-2" type="search" name="search" placeholder="جستجوی عنوان کتاب" aria-label="Search">
                        <button class="btn btn-primary" type="submit" name="search-btn">برو</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container mt-5 pt-4">
    <?php
    $session = $_SESSION;
    $cart = [];
    foreach ($session as $keySession => $value) {
        if (substr($keySession, 0, 5) == 'cart_') {
            $cart[$keySession] = $value;
        }
    }
    ?>

    <table class="table table-hover mt-4">
        <thead>
        <tr class="text-center row">
            <th class="col">نام</th>
            <th class="col">نویسنده</th>
            <th class="col">ناشر</th>
            <th class="col">تعداد انتخاب شده</th>
            <th class="col">قیمت واحد</th>
            <th class="col">مجموع</th>
            <th class="col">عملیات</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($cart as $item => $values): ?>
            <tr class="text-center row">
                <td class="col"><?php echo $values['title']; ?></td>
                <td class="col">
                    <?php
                    $auth_id = $values['auth_id'];
                    $auth_query = mysqli_query($connection, "SELECT * FROM authors WHERE id = '$auth_id'");
                    $auth_row = mysqli_fetch_array($auth_query);
                    echo $auth_row['author_name'];
                    ?>
                </td>
                <td class="col">
                    <?php
                    $pub_id = $values['pub_id'];
                    $pub_query = mysqli_query($connection, "SELECT * FROM publishers WHERE id = '$pub_id'");
                    $pub_row = mysqli_fetch_array($pub_query);
                    echo $pub_row['pub_name'];
                    ?>
                </td>
                <td class="col"><?php echo $values['quantity']; ?></td>
                <td class="col"><?php echo $values['price'] / $values['quantity']; ?></td>
                <td class="col"><?php echo $values['price']; ?></td>
                <td class="col">
                    <div class="w-100 row">
                        <div class="w-50">
                            <div class="row mx-0">
                                <a href="cart-controller.php?add-to-cart=<?php echo $values['id']; ?>" class="btn btn-warning w-50">+</a>
                                <a href="cart-controller.php?minus=<?php echo $values['id']; ?>" class="btn btn-primary w-50">-</a>
                            </div>
                        </div>
                        <div class="w-50">
                            <a href="cart-controller.php?remove-cart=<?php echo $values['id']; ?>" class="btn btn-danger w-100 mx-2">حذف</a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div class="mt-4">
        <div>
            <table class="table">
                <tr class="row">
                    <td class="col text-center">جمع کل</td>
                    <td class="col"></td>
                    <td class="col"></td>
                    <td class="col text-center">
                        <?php
                        $total_number = array_sum(array_column($cart, 'quantity'));
                        echo $total_number;
                        ?>
                    </td>
                    <td class="col"></td>
                    <td class="col text-center">
                        <?php
                        $total = array_sum(array_column($cart, 'price'));
                        echo $total;
                        ?>
                    </td>
                    <td class="col text-center">
                        <a href="ZSend.php" class="btn btn-success w-100">پرداخت</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>
