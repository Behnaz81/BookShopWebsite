<?php
require_once('../inc/config.php');

unset($_SESSION['admin']);
session_destroy();

header('location:../index.php');
?>