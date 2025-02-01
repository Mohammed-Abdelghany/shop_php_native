<?php
session_start();
if(isset($_GET['lang']) && in_array($_GET['lang'], ['english', 'arabic'])) {
$_SESSION['lang'] = $_GET['lang'];   
}

//default lang

if(!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'english';
}

$prev_page= $_SERVER['HTTP_REFERER'] ?? 'index.php';
header("Location: $prev_page" );
?>