<div class="card mb-3">
    <div class="card-header text-right">
        سفارشات
    </div>
    <div class="card-body">
        <div class="able-responsive">
            <table class="table float-right" style="direction: rtl">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>نام</th>
                    <th>قیمت</th>
                    <th>شماره تراکنش</th>
                    <th>وضعیت</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $num = 1;
                    $orders = mysqli_query($connection, "SELECT * FROM orders");
                    while ($row_orders = mysqli_fetch_assoc($orders)):
                ?>
                <tr>
                    <td><?php echo $num++; ?></td>
                    <td><?php echo $row_orders['name'] ?></td>
                    <td><?php echo $row_orders['price'] ?></td>
                    <td><?php echo $row_orders['id']; ?></td>
                    <td>
                        <?php
                            if($row_orders['status'] == 100){
                                echo 'پرداخت موفق';
                            }
                            else{
                                echo 'پرداخت ناموفق';
                            }
                        ?>
                    </td>
                </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
