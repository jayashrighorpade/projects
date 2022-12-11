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
<head>
    <title>MD5 Cracker</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>


<body style="background: rgb(39, 14, 39)">

<h1 style="color:rgb(255, 255, 255);text-align:center;font-family: 'Julius Sans One', sans-serif;font-size: 40px;">MD5 cracker [Alphabetic Decoder]</h1>
<p style="text-align: center;font-size: 20px;font-family: Open Sans;color:aliceblue;">This application takes an MD5 hash of a four-character lower case string and attempts to hash all four-character combinations to determine the original four characters.</p>

<form>
<br><br><br><input type="text" name="md5" size="60" />
<input type="submit" value="Crack MD5"/>
</form>

<pre>

<p style="text-align:left;font-size: 20px;font-family: Open Sans;color:aliceblue;">Debug Output:</p>

<?php

$goodtext = "Not found";

// If there is no parameter, this code is all skipped
if ( isset($_GET['md5']) ) 
{
    $time_pre = microtime(true);
    $md5 = $_GET['md5'];

    // This is our alphabet
    $txt = "abcdefghijklmnopqrstuvwxyz";
    $show = 10;

    // Outer loop go go through the alphabet for the
    // first position in our "possible" pre-hash
    // text
    for($i=0; $i<strlen($txt); $i++ ) 
    {
        $ch1 = $txt[$i];   // The first of two characters

        // Our inner loop Not the use of new variables
        // $j and $ch2 
        for($j=0; $j<strlen($txt); $j++ ) 
        {
            $ch2 = $txt[$j];  // Our second character

            for($k=0; $k<strlen($txt); $k++ ) 
            {
                $ch3 = $txt[$k];  // Our third character

                for($l=0; $l<strlen($txt); $l++ ) 
                {
                    $ch4 = $txt[$l];  // Our fourth character

                    
            // Concatenate the two characters together to 
            // form the "possible" pre-hash text
            $try = $ch1.$ch2.$ch3.$ch4;

            // Run the hash and then check to see if we match
            $check = hash('md5', $try);
            if ( $check == $md5 ) 
            {
                $goodtext = $try;
                break;   // Exit the inner loop
            }

            // Debug output until $show hits 0
            if ( $show > 0 ) 
            {
                print "<p style='text-align:left ;font-size: 15px;font-family: Open Sans;color:aliceblue;'>".$check.$try."<p>";
                $show = $show - 1;
            }       
        }
    }
}
}
     


    // Compute elapsed time
    $time_post = microtime(true);
    echo "<p style='text-align:left ;font-size: 15px;font-family: Open Sans;color:aliceblue;'>Elapsed time: ";
    echo $time_post-$time_pre."</p>";
}
?>
</pre>


<!-- Use the very short syntax and call htmlentities() -->
<p style="text-align:left ;font-size: 20px;font-family: Open Sans;color:lightgreen;">Original Text: <?= htmlentities($goodtext); ?></p>



<ul>
<li><a href="indexchar.php" style="text-align: center;font-size: 20px;font-family: Open Sans;color:aliceblue;">Reset</a></li><br><br>
<li><a href="makecodechar.php" style="text-align: center;font-size: 20px;font-family: Open Sans;color:aliceblue;">MD5 Code Maker</a></li><br>
<li><a href="home.php" style="text-align: center;font-size: 20px;font-family: Open Sans;color:aliceblue;">Home</a></li>

</ul>

</body>
</html>

