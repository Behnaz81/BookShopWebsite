<?php
require_once 'inc/config.php';
$session = $_SESSION;
$cart = [];
foreach($session as $keySession => $value){
    if(substr($keySession, 0, 5) == 'cart_'){
        $cart[$keySession] = $value;
        $book_id = $cart[$keySession]['id'];
        $num_sold = $cart[$keySession]['quantity'];
        $book_query = mysqli_query($connection, "SELECT * FROM books WHERE id = '$book_id'");
        $book_row = mysqli_fetch_array($book_query);
        if($book_row['number'] > $num_sold){
            $book_update_query = mysqli_query($connection, "UPDATE books SET number = number - '$num_sold' WHERE id = '$book_id'");
        }elseif ($book_row['number'] == $num_sold){
            $book_update_query = mysqli_query($connection, "DELETE FROM books WHERE id = '$book_id'");
        }
    }
}

$total = array_column($cart, 'price');
$total = array_sum($total);

$desc = array_column($cart, 'title');
$desc = implode(' و ', $desc);

$query = mysqli_query($connection, "INSERT INTO orders(name, price, status) VALUES('$desc', '$total', 100) ");

foreach($session as $keySession => $value){
    if(substr($keySession, 0, 5) == 'cart_'){
        unset($_SESSION[$keySession]);
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأیید پرداخت</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Styling Page with Custom Style -->
    <link href="css/ZSend.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="alert alert-success text-center">
                        <h1 class="card-title">با موفقیت پرداخت شد</h1>
                    </div>

                    <div class="row">
                        <div class="col">
                            <h2 class="card-text text-right">مبلغ پرداختی</h2>
                        </div>
                        <div class="col">
                            <p class="card-text text-right"><?php echo $total; ?> تومان</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h2 class="card-text text-right">توضیحات تراکنش</h2>
                        </div>
                        <div class="col">
                            <p class="card-text text-right"><?php echo $desc; ?></p>
                        </div>
                    </div>

                    <div class="text-center mt-4 w-100">
                        <a href="index.php" class="btn btn-custom">بازگشت به صفحه اصلی</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>
