<?php
require_once 'inc/config.php';

if(isset($_GET['add-to-cart']) && !empty($_GET['add-to-cart'])){

    $get_book_id = $_GET['add-to-cart'];
    $get_book_query = mysqli_query($connection, "SELECT * FROM books WHERE id = '$get_book_id'");
    $book_row = mysqli_fetch_array($get_book_query);

    if(isset($_SESSION['cart_'. $book_row['id']])){
        $cart = $_SESSION['cart_'. $book_row['id']];
        $_SESSION['cart_'. $book_row['id']] = [
            'id' => $book_row['id'],
            'title' => $cart['title'],
            'price' => $cart['price'] + $book_row['price'],
            'auth_id' => $cart['auth_id'],
            'pub_id' => $cart['pub_id'],
            'quantity' => $cart['quantity'] + 1
        ];
    }
    else{

        $_SESSION['cart_'. $book_row['id']] = [
            'id' => $book_row['id'],
            'title' => $book_row['title'],
            'price' => $book_row['price'],
            'auth_id' => $book_row['auth_id'],
            'pub_id' => $book_row['pub_id'],
            'quantity' => 1,

        ];
    }

    header('location: cart.php');
}
elseif (isset($_GET['remove-cart']) && !empty($_GET['remove-cart'])){
    unset($_SESSION['cart_'. $_GET['remove-cart']]);
    header('location: cart.php');
}elseif (isset($_GET['minus']) && !empty($_GET['minus'])){
    $cart = $_SESSION['cart_'. $_GET['minus']];
    $get_book_id = $_GET['minus'];
    $get_book_query = mysqli_query($connection, "SELECT * FROM books WHERE id = '$get_book_id'");
    $book_row = mysqli_fetch_array($get_book_query);

    if($cart['quantity'] > 1){
        $_SESSION['cart_'. $_GET['minus']] = [
            'id' => $cart['id'],
            'title' => $cart['title'],
            'price' => $cart['price'] - $book_row['price'],
            'auth_id' => $cart['auth_id'],
            'pub_id' => $cart['pub_id'],
            'quantity' => $cart['quantity'] - 1
        ];

    }else{
        unset($_SESSION['cart_'. $_GET['minus']]);
    }
    header('location: cart.php');
}