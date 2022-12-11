<?php
   session_start(); 
   
    if($_SESSION["username"] == "")
    {
        echo 'not logged in';
        header("Location: login.php");
        exit;
    }

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <title>MD5</title>

    <style>

    .link-button {
    background: rgba(99, 14, 99, 0.438) none repeat scroll 0 0;
    border: 1px solid #a356aa;
    color: aliceblue;
    outline: medium none;
    padding: 15px;
    text-decoration: none;
    margin-left: 730px;
    }

    .link-button:hover {
    Background-color:  #a756aa;
    Color: #ffffff;
    }

    </style>


</head>

<body style="background: rgb(39, 14, 39)">
    <br><br><br>
    <h1 style="color:rgb(255, 255, 255);text-align:center;font-family: 'Julius Sans One', sans-serif;font-size: 40px;">MD5 Encoder and Decoder</h1>

    <br><br>
    <?php

    //echo "Hello ".$_SESSION['username']."<br>";
    print '<p style="text-align: center;font-size: 25px;font-family: Open Sans;color:rgb(179, 138, 180);margin-left: 150p">Welcome, '.$_SESSION['username'].'</p>';  
    
    ?>

    <br>
    <p style="text-align: center;font-size: 20px;font-family: Open Sans;">
    <a href="indexx.php" style="color:aliceblue;">MD5 Decoder [numerical]</a><br>
    <a href="makecode.php" style="color:aliceblue;">MD5 Encoder [numerical]</a><br><br>
    <a href="indexchar.php" style="color:aliceblue;">MD5 Decoder [alphabetical]</a><br>
    <a href="makecodechar.php" style="color:aliceblue;">MD5 Encoder [alphabetical]</a><br><br>
    <a href="md5.php" style="color:aliceblue;">MD5 Encoder [both]</a><br><br><br><br>
    <form>
        <button formaction="logout.php" class="link-button">Logout</button>
    </form>
   </p>

    
</body>
</html>


