<?php
   session_start();
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
    <title>MD5 Login</title>

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

   <form method="post" action="login.php">
        <div class="card" style="background: rgb(110, 35, 110);">
            <br><br><br><br><br>
            <h1 style="color:rgb(255, 253, 253);text-align:center;font-family: 'Julius Sans One', sans-serif;font-size: 40px;">LOGIN</h1>

            <div class="container">
                <label style="text-align: center;font-size: 20px;font-family: Open Sans;color:aliceblue;margin-left: 150px">Username:</label><input type="text" name="username" style="margin-left: 20px" required>
                <br><br>
                <label style="text-align: center;font-size: 20px;font-family: Open Sans;color:aliceblue;margin-left: 150px">Password:</label><input type="password" name="passwd" id="passwd" style="margin-left: 26px" required>
                <br><br><br>
                <input type="submit" name="submit" value="Login" style="text-align: center;font-size: 20px;font-family: Open Sans;color:rgb(110, 35, 110);margin-left: 350px">
                <br><br><br>
                <input type="checkbox" onclick="myFunction()" style="margin-left: 350px;margin-top: -10px;" ><p style="text-align: center;font-size: 15px;font-family: Open Sans;color:aliceblue;margin-top: -20px;margin-left: 300px;">Show Password</p>
                <br><br><br>
                <a href="signup.php" style="text-align: center;font-size: 15px;font-family: Open Sans;color:aliceblue;margin-left: 150p"   >Don't have an account? Sign Up </a>
                <br><br><br><br>
                <script>
                    function myFunction() 
                    {
                        var x = document.getElementById("passwd");
                        if (x.type === "password") 
                        {
                            x.type = "text";
                        } 
                        else 
                        {
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

if(isset($_POST['submit'])) 
{
 
  $username = $_POST['username'];
  $pass = $_POST['passwd'];

    if(strlen($pass) != 4)
    {
        $err = "Password must be exactly 4 numbers or letters";
        print '<p style="text-align: center;font-size: 15px;font-family: Open Sans;color:red;margin-left: 150p">'.$err.'</p>';
    }

    else
    {
        $err = "";

   
    ////////////////////get pass hash

    $mysqli = mysqli_connect("localhost","root","","projdb");
    $query = "SELECT Password FROM details WHERE Username = ?";

            if($stmt = $mysqli->prepare($query))
            {
                
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $stmt->store_result();
                if($stmt->num_rows === 0)
                {
                    $err = "Enter Correct Credentials";
                    print '<p style="text-align: center;font-size: 15px;font-family: Open Sans;color:red;margin-left: 150p">'.$err.'</p>';
                    exit('.');

                }
                $stmt->bind_result($passwd);
                $stmt->fetch();
                //echo $passwd;
                $stmt->close();
            
            }

            else 
            {
                $error = $mysqli->errno . ' ' . $mysqli->error;
                echo $error; 
            }
   
    
///////////////////////convert to hash (num)

    if(ctype_digit($pass) == TRUE)
   {

        $txt = "0123456789";
        $goodtext = "Not found";

        for($i=0; $i<strlen($txt); $i++ ) 
        {
            $ch1 = $txt[$i];   

             for($j=0; $j<strlen($txt); $j++ ) 
            {
                $ch2 = $txt[$j];

                for($k=0; $k<strlen($txt); $k++ ) 
                {
                    $ch3 = $txt[$k];

                    for($l=0; $l<strlen($txt); $l++ ) 
                    {
                        $ch4 = $txt[$l];

                        $try = $ch1.$ch2.$ch3.$ch4;
                    
 
                    $check = hash('md5', $try);

                    if ( $check == $passwd ) 
                    {
                        $goodtext = $try;
                        break; 
                    }

                    }        
                }        
            }        
        }  

        $hash = $goodtext;


////////////////////// compare numhash

        if($hash == $pass)
        {
            
            $err = "Logged In Successfully";
            print '<p style="text-align: center;font-size: 15px;font-family: Open Sans;color:green;margin-left: 150p">'.$err.'</p>';
            header('Refresh: 2; URL = home.php');
    
        }

        else
        {
            $err = "Enter Correct Password";
            print '<p style="text-align: center;font-size: 15px;font-family: Open Sans;color:red;margin-left: 150p">'.$err.'</p>';  
            
        }
    }

//////////////////// convert to hash (alp)

    if(ctype_alpha($pass) && ctype_lower($pass))
    {

        $txt = "abcdefghijklmnopqrstuvwxyz";
        $goodtext = "Not found";
    
        for($i=0; $i<strlen($txt); $i++ ) 
        {
            $ch1 = $txt[$i];  

            for($j=0; $j<strlen($txt); $j++ ) 
            {
                $ch2 = $txt[$j];  

                for($k=0; $k<strlen($txt); $k++ ) 
                {
                    $ch3 = $txt[$k];

                    for($l=0; $l<strlen($txt); $l++ ) 
                    {
                        $ch4 = $txt[$l];  


                    $try = $ch1.$ch2.$ch3.$ch4;
        
                    $check = hash('md5', $try);

                    if ( $check == $passwd ) 
                    {
                        $goodtext = $try;
                        break;   
                    }


                    }        
                }        
            }        
        }  
        $hash = $goodtext;

////////////////////comapre alphash

        if($hash == $pass)
        {
            
            $err = "Logged In Successfully";
            print '<p style="text-align: center;font-size: 15px;font-family: Open Sans;color:green;margin-left: 150p">'.$err.'</p>';
            header('Refresh: 2; URL = home.php');
    
        }

        else
        {
            $err = "Enter Correct Password";
            print '<p style="text-align: center;font-size: 15px;font-family: Open Sans;color:red;margin-left: 150p">'.$err.'</p>';  
            
        }
    }



//////////////////////// sessions
            
    if (!empty($_POST['username']) && !empty($_POST['passwd'])) 
    {
        
       
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $pass;

        
        
    }


}

}
            
        


?>