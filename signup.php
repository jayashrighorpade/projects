


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
    <title>MD5 Sign Up</title>

    <style>
        .card {
          box-shadow: 0 4px 8px 0 rgb(199, 96, 199);;
          transition: 0.3s;
          width: 40%;
          border-radius: 15px;
          margin-left: 450px;
          margin-top: 100px;
        }
        
        .card:hover {
          box-shadow: 0 8px 16px 0 rgb(102, 100, 100);
        }
        
        img {
          border-radius: 5px 5px 0 0;
        }
        
        .container {
          padding: 8px 16px;
        }
        </style>


</head>
<body style="background: rgb(39, 14, 39)">

   <form method="post" action="signup.php">
        <div class="card" style="background: rgb(110, 35, 110);">
            <br><br>
            <h1 style="color:rgb(255, 253, 253);text-align:center;font-family: 'Julius Sans One', sans-serif;font-size: 40px;">SIGN UP</h1>

            <div class="container">
                <label style="text-align: center;font-size: 20px;font-family: Open Sans;color:aliceblue;margin-left: 150px">Name:</label><input type="text" name="name" style="margin-left: 60px" required>
                <br><br>
                <label style="text-align: center;font-size: 20px;font-family: Open Sans;color:aliceblue;margin-left: 150px">Email:</label><input type="email" name="email" style="margin-left: 65px" required>
                <br><br>
                <label style="text-align: center;font-size: 20px;font-family: Open Sans;color:aliceblue;margin-left: 150px">Username:</label><input type="text" name="username" style="margin-left: 20px" required>
                <br><br>
                <label style="text-align: center;font-size: 20px;font-family: Open Sans;color:aliceblue;margin-left: 150px">Password:</label><input type="password" name="passwd" id="passwd" style="margin-left: 26px" required>
               
                <br><br><br>
                <input type="submit" name="submit" value="Sign Up" style="text-align: center;font-size: 20px;font-family: Open Sans;color:rgb(110, 35, 110);margin-left: 350px">
                <br><br><br>
                <input type="checkbox" onclick="myFunction()" style="margin-left: 350px;margin-top: -10px;" ><p style="text-align: center;font-size: 15px;font-family: Open Sans;color:aliceblue;margin-top: -20px;margin-left: 300px;">Show Password</p>
                <br><br><br><br>
                <a href="login.php" style="text-align: center;font-size: 15px;font-family: Open Sans;color:aliceblue;margin-left: 150p">Already have an account? Log In </a>
                <br><br><br><br>
                <p style="text-align: left;font-size: 15px;font-family: Open Sans;color:lightgreen;margin-left: 1px">Note: Please enter a 4 character password [numbers or letters(lowercase)] and no special symbols
                <script>
                    function myFunction() {
                    var x = document.getElementById("passwd");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }
                    }
                </script>

            </div>
          </div>

    </form>
</body>
</html>




<?php

$md5 = false;
$pass = "";
$err = "";

if(isset($_POST['submit'])) 
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $pass = $_POST['passwd'];
    

    if(strlen($pass) != 4)
    {
        $err = "Input must be exactly 4 numbers or letters";
        print '<p style="text-align: center;font-size: 15px;font-family: Open Sans;color:red;margin-left: 150p">'.$err.'</p>';
    }

    else
    {
        if(ctype_digit($pass) == TRUE)
        {
            $err = "";
            $md5 = hash('md5', $pass);
        }


        if(ctype_alpha($pass) && ctype_lower($pass))
        {
            $err = "";
            $md5 = hash('md5', $pass);
        }
    }


    if($err == "")
    {

        if($md5 != "")
        {
            $suc = "Signed in successfully";
            print '<p style="text-align: center;font-size: 15px;font-family: Open Sans;color:green;margin-left: 150p">'.$suc.'</p>';
            header('Refresh: 2; URL = login.php');

            $mysqli = mysqli_connect("localhost","root","","projdb");
            $query = "INSERT INTO details(Name, Email, Username, Password) VALUES (?,?,?,?)";

            if($stmt = $mysqli->prepare($query))
            {

                $stmt->bind_param('ssss', $name, $email, $username, $md5);
                $stmt->execute();

            }

            else 
            {
                $error = $mysqli->errno . ' ' . $mysqli->error;
                echo $error; 
            }
        }

        else
        {

            $err = "Enter Correct Password";
            print '<p style="text-align: center;font-size: 15px;font-family: Open Sans;color:red;margin-left: 150p">'.$err.'</p>';
            
        }
    }



}



?>