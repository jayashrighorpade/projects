<?php
   session_start(); 
   
    if($_SESSION["username"] == "")
    {
        echo 'not logged in';
        header("Location: login.php");
        exit;
    }

?>

<?php
$md5 = "Not computed";

if ( isset($_GET['encode']) ) 
{
    $md5 = hash('md5', $_GET['encode']);
}
?>


<!DOCTYPE html>
<head>
    <title>MD5</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>


<body style="background: rgb(39, 14, 39)">

<h1 style="color:rgb(255, 255, 255);text-align:center;font-family: 'Julius Sans One', sans-serif;font-size: 40px;">MD5 PIN Maker [numerical+alphabetic]</h1>

<p style='text-align:left ;font-size: 15px;font-family: Open Sans;color:lightgreen;'>MD5: <?= htmlentities($md5); ?></p>

<form>
<input type="text" name="encode" size="40" />
<input type="submit" value="Compute MD5"/>
</form>

<ul>
<li><a href="md5.php" style="text-align: center;font-size: 20px;font-family: Open Sans;color:aliceblue;">Reset</a></li><br><br>
<li><a href="home.php" style="text-align: center;font-size: 20px;font-family: Open Sans;color:aliceblue;">Home</a></li>
</ul>

</body>
</html>