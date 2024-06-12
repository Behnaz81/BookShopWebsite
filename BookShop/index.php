<!--Including connection file-->
<?php require_once 'inc/config.php'; ?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>صفحه اصلی</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">
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
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="http://localhost/BookShop/index.php">صفحه اصلی</a></li>
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
            <div class="list-group">

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

        <!-- Main Content -->
        <div class="col-lg-9">
            <div class="row">

                <!--Loading books and showing them-->
                <?php
                    if(isset($_GET['search']))
                    {
                        $search = $_GET['search'];
                        $query = mysqli_query($connection, "SELECT * FROM books WHERE title LIKE '%$search%' OR description LIKE '%$search%'");
                    }
                    else if(isset($_GET['cat']))
                    {
                        $cat = $_GET['cat'];
                        $query = mysqli_query($connection, "SELECT * FROM books WHERE cat_id = '$cat'");
                    }
                    else if(isset($_GET['auth']))
                    {
                        $auth = $_GET['auth'];
                        $query = mysqli_query($connection, "SELECT * FROM books WHERE auth_id = '$auth'");
                    }
                    else if(isset($_GET['pub']))
                    {
                        $pub = $_GET['pub'];
                        $query = mysqli_query($connection, "SELECT * FROM books WHERE pub_id = '$pub'");
                    }
                    else
                    {
                        $query = mysqli_query($connection, "SELECT * FROM books");
                    }
                    while($row = mysqli_fetch_array($query)):
                ?>
                    <!--Book Cards-->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="border text-center w-100">
                                <a href="single.php?id=<?php echo $row['id']; ?>" class="text-center">
                                    <img class="card-img-top mt-3 mb-3" src="uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>">
                                </a>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title text-center">
                                    <a href="single.php?id=<?php echo $row['id']; ?>" class="text-decoration-none text-dark"><?php echo $row['title']; ?></a>
                                </h4>
                                <h5 class="text-center">
                                    <a href="index.php?auth=<?php echo $row['auth_id']; ?>" class="text-decoration-none text-dark">
                                        <?php
                                        $auth_query = mysqli_query($connection, "SELECT * FROM authors WHERE id = '$row[auth_id]'");
                                        $auth_row = mysqli_fetch_array($auth_query);
                                        echo $auth_row['author_name'];
                                        ?>
                                    </a>
                                </h5>
                                <h5 class="text-center"><?php echo $row['price']; ?> تومان</h5>
                            </div>
                            <div class="card-footer text-center">
                                <a href="cart-controller.php?add-to-cart=<?php echo $row['id']; ?>" class="btn btn-primary">افزودن به سبد خرید</a>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.col-lg-9 -->
    </div>
    <!-- /.row -->
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
