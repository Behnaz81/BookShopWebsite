<?php require_once '../inc/config.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header text-right">
                    افزودن دسته بندی
                </div>
                <div class="card-body">
                    <form action="actions.php?add-cat" method="POST">
                        <div class="input-group">
                            <input type="text" class="form-control text-right" placeholder="دسته بندی را وارد کنید" name="cat_name">
                            <button type="submit" class="btn btn-primary text-righ">افزودن</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header text-right">
                    دسته بندی ها
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped text-right">
                            <thead>
                            <tr>
                                <th scope="col">ردیف</th>
                                <th scope="col">نام</th>
                                <th scope="col">حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $num = 1;
                            $cat_query = mysqli_query($connection, "SELECT * FROM category");
                            while ($cat_row = mysqli_fetch_array($cat_query)):
                                ?>
                                <tr>
                                    <td><?php echo $num++; ?></td>
                                    <td><?php echo $cat_row['cat_name']; ?></td>
                                    <td>
                                        <a href="actions.php?delete_cat=<?php echo $cat_row['id']; ?>" class="btn btn-danger">حذف</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
