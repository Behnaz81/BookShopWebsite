<?php require_once '../inc/config.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header text-right">
                    افزودن نویسنده
                </div>
                <div class="card-body">
                    <form action="actions.php?add-auth" method="POST">
                        <div class="input-group">
                            <input type="text" class="form-control text-right" placeholder="نام نویسنده را وارد کنید" name="auth_name">
                            <button type="submit" class="btn btn-primary text-center">افزودن</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header text-right">
                    نویسندگان
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
                            $auth_query = mysqli_query($connection, "SELECT * FROM authors");
                            while ($auth_row = mysqli_fetch_array($auth_query)):
                                ?>
                                <tr>
                                    <td><?php echo $num++; ?></td>
                                    <td><?php echo $auth_row['author_name']; ?></td>
                                    <td>
                                        <a href="actions.php?delete-auth=<?php echo $auth_row['id']; ?>" class="btn btn-danger">حذف</a>
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
