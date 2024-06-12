<?php
require_once '../inc/config.php';
if(!isset($_SESSION['admin']))
{
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>admin panel</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav class="nav top-bar">
<h2 class="float-left mr-5">پنل مدیریت</h2>
</nav>

   <div class="container-fluid">
        <div class="row admin-panel">
            <div class="col-2">
                <div class="list-item">
                    <a href="index.php" class="text-decoration-none">پیشخوان</a>
                    <a href="../" class="text-decoration-none">مشاهده فروشگاه</a>
                    <a href="index.php?add-new-book" class="text-decoration-none">محصول جدید</a>
                    <a href="index.php?orders" class="text-decoration-none">سفارشات</a>
                    <a href="index.php?categories" class="text-decoration-none">دسته بندی ها</a>
                    <a href="index.php?authors" class="text-decoration-none">نویسنده ها</a>
                    <a href="index.php?publishers" class="text-decoration-none">ناشران</a>
                    <a href="logout.php" class="text-decoration-none">خروج</a>
                </div>
            </div>

            <div class="col-10">
                <?php
                    if(isset($_GET['add-new-book'])){
                        require_once 'add-new-product.php';
                    }elseif(isset($_GET['orders'])){
                        require_once 'orders.php';
                    }elseif(isset($_GET['categories'])){
                        require_once 'categories.php';
                    }elseif(isset($_GET['edit-book']) && isset($_GET['id']) && !empty($_GET['id'])){
                        require_once 'edit-book.php';
                    }
                    elseif (isset($_GET['authors'])){
                        require_once 'authors.php';
                    }elseif (isset($_GET['publishers'])){
                        require_once 'publishers.php';
                    }
                    else{
                    ?>
                        <div class="card mb-3">
                            <div class="card-header text-right">
                                لیست محصولات
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table float-right" style="direction: rtl">
                                        <thead>

                                        <tr>
                                            <th>ردیف</th>
                                            <th>تصویر</th>
                                            <th>نام</th>
                                            <th>نویسنده</th>
                                            <th>ناشر</th>
                                            <th>تعداد موجود</th>
                                            <th>قیمت</th>
                                            <th>حذف</th>
                                            <th>ویرایش</th>
                                        </tr>

                                        </thead>

                                        <tbody>
                                        <?php
                                            $num = 1;
                                            if(isset($_GET['auth_id'])){
                                                $auth_id = $_GET['auth_id'];
                                                $book_query = mysqli_query($connection, "SELECT * FROM books WHERE auth_id = '$auth_id'");
                                            }elseif (isset($_GET['pub_id'])){
                                                $pub_id = $_GET['pub_id'];
                                                $book_query = mysqli_query($connection, "SELECT * FROM books WHERE pub_id = '$pub_id'");
                                            }
                                            else{
                                                $book_query = mysqli_query($connection, "SELECT * FROM books");
                                            }
                                            while ($book_row = mysqli_fetch_array($book_query)):
                                        ?>

                                        <tr>
                                            <td><?php echo $num++; ?></td>
                                            <td><img src="../uploads/<?php echo $book_row['image'] ?>" width="auto" height="100px"></td>
                                            <td>
                                                <a href="../single.php?id=<?php echo $book_row['id'] ?>" class="text-dark"><?php echo $book_row['title']; ?></a>
                                            </td>
                                            <td>
                                                <a href="index.php?auth_id=<?php echo $book_row['auth_id']; ?>" class="text-dark">
                                                    <?php
                                                    $auth_id = $book_row['auth_id'];
                                                    $auth_query = mysqli_query($connection, "SELECT * FROM authors WHERE id = '$auth_id'");
                                                    $auth_row = mysqli_fetch_array($auth_query);
                                                    echo $auth_row['author_name'];
                                                    ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="index.php?pub_id=<?php echo $book_row['pub_id']; ?>" class="text-dark">
                                                    <?php
                                                    $pub_id = $book_row['pub_id'];
                                                    $pub_query = mysqli_query($connection, "SELECT * FROM publishers WHERE id = '$pub_id'");
                                                    $pub_row = mysqli_fetch_array($pub_query);
                                                    echo $pub_row['pub_name'];
                                                    ?>
                                                </a>
                                            </td>
                                            <td>
                                                <?php
                                                    echo $book_row['number'];
                                                ?>
                                            </td>
                                            <td><?php echo $book_row['price']; ?></td>
                                            <td>
                                                <a href="actions.php?delete_book=<?php echo $book_row['id']; ?>" class="btn btn-danger">حذف</a>
                                            </td>
                                            <td>
                                                <a href="index.php?edit-book&id=<?php echo $book_row['id']; ?>" class="btn btn-warning">ویرایش</a>
                                            </td>
                                        </tr>

                                        <?php
                                        endwhile;
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                ?>
            </div>
        </div>
   </div>

<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>

</body>
</html>