<?php
$book_id = $_GET['id'];
$book_query = mysqli_query($connection, "SELECT * FROM books WHERE id = '$book_id'");
$book_row = mysqli_fetch_array($book_query);
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش محصول</title>
    <link href="../css/bootstrap.min.css">
    <link href="../css/books-admin.css" rel="stylesheet">
</head>

<body>
<div class="container">
    <div class="card mb-3">
        <div class="card-header text-right">
            ویرایش محصول
        </div>
        <div class="card-body">
            <!-- form area -->
            <form action="actions.php?edit-book=<?php echo $book_id ?>" method="POST" enctype="multipart/form-data">
                <div class="row">

                    <div class="col-md-2">
                        <div>
                            <img src="../uploads/<?php echo $book_row['image']; ?>" class="img-fluid book-image" alt="Image of <?php echo $book_row['title']; ?>">
                        </div>
                        <div class="form-group">
                            <input name="image" type="file" class="form-control-file">
                        </div>
                    </div>

                    <div class="col-md-10">
                        <div class="form-group">
                            <input name="title" type="text" class="form-control text-right" value="<?php echo $book_row['title']; ?>" placeholder="عنوان محصول" dir="rtl">
                        </div>
                        <div class="form-group">
                            <textarea name="desc" cols="30" rows="10" class="form-control text-right" placeholder="توضیحات محصول" dir="rtl"><?php echo trim($book_row['description']); ?></textarea>
                        </div>

                    </div>

                </div>
                <div class="row">
                    <div class="col-6">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-3 text-right">
                                    <label>دسته بندی:</label>
                                </div>
                                <div class="col-9">
                                    <select name="cat" class="form-control text-right">
                                        <?php
                                        $cat_query = mysqli_query($connection, "SELECT * FROM category");
                                        while ($cat_row = mysqli_fetch_array($cat_query)):
                                            ?>
                                            <option value="<?php echo $cat_row['id']; ?>" <?php echo ($cat_row['id'] == $book_row['cat_id']) ? 'selected' : ''; ?>>
                                                <?php echo $cat_row['cat_name']; ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="row">

                                <div class="col-3 text-right">
                                    <label>نویسنده:</label>
                                </div>

                                <div class="col-9">
                                    <select name="auth" class="form-control text-right">
                                        <?php
                                        $auth_query = mysqli_query($connection, "SELECT * FROM authors");
                                        while ($auth_row = mysqli_fetch_array($auth_query)):
                                            ?>
                                            <option value="<?php echo $auth_row['id']; ?>" <?php echo ($auth_row['id'] == $book_row['auth_id']) ? 'selected' : ''; ?>>
                                                <?php echo $auth_row['author_name']; ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-3 text-right">
                                <label>ناشر:</label>
                            </div>
                            <div class="col-9">
                                <select name="pub" class="form-control text-right">
                                    <?php
                                    $pub_query = mysqli_query($connection, "SELECT * FROM publishers");
                                    while ($pub_row = mysqli_fetch_array($pub_query)):
                                        ?>
                                        <option value="<?php echo $pub_row['id']; ?>" <?php echo ($pub_row['id'] == $book_row['pub_id']) ? 'selected' : ''; ?>>
                                            <?php echo $pub_row['pub_name']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-3 text-right">
                                <label>زبان:</label>
                            </div>
                            <div class="col-9">
                                <input name="lang" type="text" class="form-control text-right" value="<?php echo $book_row['language']; ?>" placeholder="زبان">
                            </div>
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="form-group row">
                            <div class="col-3 text-right">
                                <label>قیمت:</label>
                            </div>
                            <div class="col-9">
                                <input name="price" type="number" class="form-control text-right" value="<?php echo $book_row['price']; ?>" placeholder="قیمت">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-3 text-right">
                                <label>تعداد موجود:</label>
                            </div>
                            <div class="col-9">
                                <input name="num" type="number" class="form-control text-right" value="<?php echo $book_row['number']; ?>" placeholder="تعداد موجود">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-3 text-right">
                                <label>تعداد صفحات:</label>
                            </div>
                            <div class="col-9">
                                <input name="pages" type="number" class="form-control text-right" value="<?php echo $book_row['pages']; ?>" placeholder="تعداد صفحات">
                            </div>
                        </div>

                    </div>


                </div>

                <div class="btn-group row d-flex">
                    <div class="col-6">
                        <input type="reset" class="btn btn-warning btn-lg text-center" value="پاک کردن">
                    </div>
                    <div class="col-6">
                        <input type="submit" class="btn btn-primary btn-lg text-center" value="ویرایش">
                    </div>
                </div>
            </form>
            <!-- end form -->
        </div>
    </div>
</div>
<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>
</body>
</html>
