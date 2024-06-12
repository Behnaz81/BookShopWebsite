<!--Connecting to database-->
<?php require_once 'inc/config.php' ?>

<!--Fetching the book's information-->
<?php
$id = $_GET['id'];
$query = mysqli_query($connection,"SELECT * FROM books WHERE id = '$id'");
$row = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title> <?php echo $row['title'] ?> </title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/shop-item.css" rel="stylesheet">

</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">

        <!--Shop Name linked to main page-->
        <a class="navbar-brand" href="index.php">کتاب پلاس</a>

        <!--collapse button in case page is small-->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <div class="row justify-content-center w-100">

                <!--Main Menu-->
                <div class="col-8">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="http://localhost/BookShop/index.php">صفحه اصلی</a></li>
                        <li class="nav-item"><a class="nav-link" href="http://localhost/BookShop/cart.php">سبد خرید</a></li>
                        <li class="nav-item"><a class="nav-link" href="http://localhost/BookShop/admin/<?php if(isset($_SESSION['admin'])){ echo 'index.php';} else{echo 'login.php';}?>">ورود/پنل ادمین</a></li>
                    </ul>
                </div>

                <!--Search Box-->
                <div class="col-4">
                    <form action="index.php" method="get" class="d-flex me-auto">
                        <input class="form-control me-2" type="search" name="search" placeholder="جستجوی عنوان کتاب" aria-label="Search">
                        <button class="btn btn-primary" type="submit" name="search-btn">برو</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</nav>

    <!-- Page Content -->
    <div class="container my-4">

        <div class="row">

            <!-- Sidebar / Categories -->
            <div class="col-lg-3">
                <div class="list-group my-4">

                    <!--Loading categories and showing them-->
                    <?php
                    $cat_query = mysqli_query($connection, "SELECT * FROM category");
                    while($cat_row = mysqli_fetch_array($cat_query)):
                        ?>
                        <a href="index.php?cat=<?php echo $cat_row['id'] ?>" class="list-group-item text-decoration-none text-right text-dark">
                            <?php echo $cat_row['cat_name']; ?>
                        </a>
                    <?php endwhile; ?>

                </div>
            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9">

                <div class="card mt-4">
                    <div class="card-body">
                    <div class="row no-gutters mb-3">

                        <!-- The image -->
                        <div class="col-md-4 text-center">
                            <img class="card-img-top img-fluid image-book" src="uploads/<?php echo $row['image'] ?>" alt="">
                        </div>

                        <div class="col-md-8 d-flex flex-column">

                                <h3 class="card-title text-right">
                                    <?php
                                        echo $row['title'];
                                    ?>
                                </h3>

                                <p class="text-right">
                                    <a href="index.php?auth=<?php echo $row['auth_id'] ?>" class="text-decoration-none text-dark">
                                        <?php
                                            $auth_id = $row['auth_id'];
                                            $get_auth_post = mysqli_query($connection, "SELECT * FROM authors WHERE id = '$auth_id'");
                                            $get_auth_row = mysqli_fetch_array($get_auth_post);
                                            echo $get_auth_row['author_name']
                                        ?>
                                    </a>
                                </p>

                                <ul class="list-unstyled custom-list">
                                    <li>
                                        <span class="title">دسته بندی:</span>
                                        <span class="info">
                                            <a href="index.php?cat=<?php echo $row['cat_id'] ?>" class="text-decoration-none text-dark">
                                                <?php
                                                    $cat_id = $row['cat_id'];
                                                    $get_cat_post = mysqli_query($connection,"SELECT * FROM category WHERE id = '$cat_id'");
                                                    $get_cat_row = mysqli_fetch_array($get_cat_post);
                                                    echo $get_cat_row['cat_name'];
                                                ?>
                                            </a>
                                        </span>
                                    </li>

                                    <li>
                                        <span class="title">ناشر:</span>
                                        <span class="info">
                                            <a href="index.php?pub=<?php echo $row['pub_id'] ?>" class="text-decoration-none text-dark">
                                                <?php
                                                    $pub_id = $row['pub_id'];
                                                    $get_pub_post = mysqli_query($connection,"SELECT * FROM publishers WHERE id = '$pub_id'");
                                                    $get_pub_row = mysqli_fetch_array($get_pub_post);
                                                    echo $get_pub_row['pub_name'];
                                                ?>
                                            </a>
                                        </span>
                                    </li>

                                    <li><span class="title">تعداد صفحات:</span><span class="info"><?php echo $row['pages']; ?></span></li>

                                    <li><span class="title">زبان:</span><span class="info"><?php echo $row['language']; ?></span></li>

                                    <li><span class="title">قیمت:</span><span class="info"><?php echo $row['price']; ?></span></li>
                                </ul>
                            </div>

                        </div>
                        <div class="card-footer mt-auto d-flex justify-content-center">
                            <a href="cart-controller.php?add-to-cart=<?php echo $row['id']; ?>" class="btn btn-primary">اضافه کردن به سبد خرید</a>
                        </div>

                    </div>
                </div>
                <!-- /.card -->

                <div class="card card-outline-secondary my-4">
                    <div class="card-header text-right">
                        توضیحات
                    </div>
                    <div class="card-body text-right pb-3">
                        <?php echo $row['description'] ?>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-lg-9 -->
        </div>
    </div>
    <!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">&copy; Book Plus <?php echo date("Y"); ?></p>
    </div>
    <!-- /.container -->
</footer>

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>
