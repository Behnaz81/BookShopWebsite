<?php

require_once '../inc/config.php';

if(isset($_GET['delete_book'])){
    $book_id = $_GET['delete_book'];
    $query = mysqli_query($connection, "DELETE FROM books WHERE id = '$book_id'");
    header('location: index.php');
}
else if(isset($_GET['delete_cat'])){
    $cat_id = $_GET['delete_cat'];
    $query = mysqli_query($connection, "DELETE FROM category WHERE id = '$cat_id'");
    header('location: index.php?categories');
}else if(isset($_GET['add-new-book']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $_POST['title'];
    $image = $_FILES['image']['name'];
    $upload = '../uploads/'. basename($image);
    $desc = $_POST['desc'];
    $cat = $_POST['cat'];
    $price = $_POST['price'];
    $auth = $_POST['auth'];
    $pub = $_POST['pub'];
    $num = $_POST['num'];
    $pages = $_POST['pages'];
    $lang = $_POST['lang'];
    $query = mysqli_query($connection, "INSERT INTO books(title, image, description, cat_id, price, pub_id, auth_id, number, language, pages) VALUES ('$title', '$image', '$desc', '$cat', '$price', '$pub', '$auth', '$num', '$lang', '$pages')");
    if($query)
    {
        move_uploaded_file($_FILES['image']['tmp_name'], $upload);
        header("location: index.php");
    }
    else{
        die('we can\'t add new book');
    }
}
else if(isset($_GET['add-cat']) && $_SERVER['REQUEST_METHOD'] == 'POST')
{
    $new_cat = $_POST['cat_name'];
    $query = mysqli_query($connection, "INSERT INTO category (cat_name) VALUES ('$new_cat')");
    header('Location: index.php?categories');
}
else if(isset($_GET['edit-book']) && !empty($_GET['edit-book']) && $_SERVER['REQUEST_METHOD'] == 'POST')
{
    $book_id = $_GET['edit-book'];
    $title = $_POST['title'];
    if(!empty($_FILES['image']['name']))
    {
        $image = $_FILES['image']['name'];
        $image_query = mysqli_query($connection, "UPDATE books SET image = '$image' WHERE id = '$book_id'");
        $upload = '../uploads/'. basename($image);
    }
    $desc = $_POST['desc'];
    $cat = $_POST['cat'];
    $price = $_POST['price'];
    $auth = $_POST['auth'];
    $pub = $_POST['pub'];
    $num = $_POST['num'];
    $lang = $_POST['lang'];
    $pages = $_POST['pages'];
    $query = mysqli_query($connection, "UPDATE books SET title = '$title' , description = '$desc' , cat_id = '$cat', price = '$price', auth_id = '$auth', pub_id = '$pub', pages = '$pages', number = '$num', language = '$lang' WHERE id = '$book_id'");
    if($query)
    {
        move_uploaded_file($_FILES['image']['tmp_name'], $upload);
        header("location: index.php");
    }
    else{
        die('we can\'t edit this book');
    }
}else if(isset($_GET['add-auth']) && $_SERVER['REQUEST_METHOD'] == 'POST')
{
    $new_auth = $_POST['auth_name'];
    $new_auth_query = mysqli_query($connection, "INSERT INTO authors(author_name) VALUES ('$new_auth')");
    header('Location: index.php?authors');
}else if(isset($_GET['delete-auth']))
{
    echo "Hi";
    $auth_id = $_GET['delete-auth'];
    $delete_auth_query = mysqli_query($connection, "DELETE FROM authors WHERE id = '$auth_id'");
    header('location: index.php?authors');
}else if (isset($_GET['add-pub']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
    $new_pub = $_POST['pub_name'];
    $new_pub_query = mysqli_query($connection, "INSERT INTO publishers(pub_name) VALUES ('$new_pub')");
    header('Location: index.php?publishers');
}else if(isset($_GET['delete-pub'])){
    $pub_id = $_GET['delete-pub'];
    $delete_pub_query = mysqli_query($connection, "DELETE FROM publishers WHERE id = '$pub_id'");
    header('location: index.php?publishers');
}