<?php
    session_start();
    if(!isset($_SESSION['user'])){
        echo "<script> location.href='login.php'; </script>";
        exit;
    }

    $id = $_SESSION['user']["data"]["id"];
    $nama = $_SESSION['user']["data"]["nama"];
?>
<head>
    <title>Skripsi</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
    <style type="text/css">
        .accordion .card-header:after {
            font-family: 'FontAwesome';  
            content: "▲";
            float: right; 
        }
        .accordion .card-header.collapsed:after {
            /* symbol for "collapsed" panels */
            content: "▼"; 
        }
    </style>
</head>