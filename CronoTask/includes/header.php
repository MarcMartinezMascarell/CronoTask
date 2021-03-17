<?php
        include_once 'functions/globalFunctions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CronoTASK</title>
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.0/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,300;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/global.css">
    <?php 
        $page = obtainPageName();
        if($page === 'index'){ ?>

            <link rel="stylesheet" href="css/headerBar.css">
            <link rel="stylesheet" href="css/sidebar.css">
            <link rel="stylesheet" href="css/mainContent.css">

        <?php
        }
    ?>
</head>