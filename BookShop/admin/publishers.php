<?php require_once '../inc/config.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header text-right">
                    افزودن ناشر
                </div>
                <div class="card-body">
                    <form action="actions.php?add-pub" method="POST">
                        <div class="input-group">
                            <input type="text" class="form-control text-right" placeholder="نام ناشر را وارد کنید" name="pub_name">
                            <button type="submit" class="btn btn-primary text-right">افزودن</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header text-right">
                    ناشران
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
                            $pub_query = mysqli_query($connection, "SELECT * FROM publishers");
                            while ($pub_row = mysqli_fetch_array($pub_query)):
                                ?>
                                <tr>
                                    <td><?php echo $num++; ?></td>
                                    <td><?php echo $pub_row['pub_name']; ?></td>
                                    <td>
                                        <a href="actions.php?delete-pub=<?php echo $pub_row['id']; ?>" class="btn btn-danger">حذف</a>
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
