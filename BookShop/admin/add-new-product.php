<?php
$cat_query = mysqli_query($connection, "SELECT * FROM category");
$auth_query = mysqli_query($connection, "SELECT * FROM authors");
$pub_query = mysqli_query($connection, "SELECT * FROM publishers");
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>افزودن محصول جدید</title>
    <link href="../css/bootstrap.min.css">
    <link href="../css/books-admin.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="card mb-3">
        <div class="card-header text-right">
            افزودن محصول جدید
        </div>
        <div class="card-body">
            <!-- form area -->
            <form action="actions.php?add-new-book" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <input name="image" type="file" class="form-control-file">
                        </div>
                    </div>
                    <!--SIDEBAR-->
                    <div class="col-md-10">
                        <div class="form-group">
                            <input name="title" type="text" class="form-control text-right" placeholder="عنوان محصول" dir="rtl">
                        </div>
                        <div class="form-group">
                            <textarea name="desc" cols="30" rows="10" class="form-control text-right" placeholder="توضیحات محصول" dir="rtl"></textarea>
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
                                        <option>دسته بندی را انتخاب کنید</option>
                                        <?php while ($cat_row = mysqli_fetch_array($cat_query)): ?>
                                            <option value="<?php echo $cat_row['id']; ?>">
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
                                        <option>نویسنده را انتخاب کنید</option>
                                        <?php while ($auth_row = mysqli_fetch_array($auth_query)): ?>
                                            <option value="<?php echo $auth_row['id']; ?>">
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
                                    <option>ناشر را انتخاب کنید</option>
                                    <?php while ($pub_row = mysqli_fetch_array($pub_query)): ?>
                                        <option value="<?php echo $pub_row['id']; ?>">
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
                                <input name="lang" type="text" class="form-control text-right" placeholder="زبان">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group row">
                            <div class="col-3 text-right">
                                <label>قیمت:</label>
                            </div>
                            <div class="col-9">
                                <input name="price" type="number" class="form-control text-right" placeholder="قیمت">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-3 text-right">
                                <label>تعداد موجود:</label>
                            </div>
                            <div class="col-9">
                                <input name="num" type="number" class="form-control text-right" placeholder="تعداد موجود">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-3 text-right">
                                <label>تعداد صفحات:</label>
                            </div>
                            <div class="col-9">
                                <input name="pages" type="number" class="form-control text-right" placeholder="تعداد صفحات">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-group row d-flex">
                    <div class="col-6">
                        <input type="reset" class="btn btn-warning btn-lg text-center" value="پاک کردن">
                    </div>
                    <div class="col-6">
                        <input type="submit" class="btn btn-primary btn-lg text-center" value="افزودن">
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
