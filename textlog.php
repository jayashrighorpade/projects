<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form method="post">
    <input type="text" name="username">
    <input type="submit" name="submit" value="login">
</form>
</body>
</html>

<?php
$goodtext = "Not found";


if(isset($_POST['submit']))
{
    $username = $_POST['username'];

    $mysqli = mysqli_connect("localhost","root","","projdb");
    $query = "SELECT Password FROM details WHERE Username = ?";

            if($stmt = $mysqli->prepare($query))
            {
                
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $stmt->store_result();
                if($stmt->num_rows === 0) exit('No rows');
                $stmt->bind_result($passwd);
                $stmt->fetch();
                echo $passwd;
                $stmt->close();
               
            }

            else 
            {
                $error = $mysqli->errno . ' ' . $mysqli->error;
                echo $error; 
            }


            if(ctype_alpha($passwd) && ctype_lower($passwd))
            {
        
                $txt = "abcdefghijklmnopqrstuvwxyz";
           
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
        
                            $hash = $goodtext;

                            }        
                        }        
                    }        
                }  
                echo($hash);
                if($hash == $passwd)
                {
                    
                    $err = "Logged In Successfully";
                    print '<p style="text-align: center;font-size: 15px;font-family: Open Sans;color:green;margin-left: 150p">'.$err.'</p>';
                    header('Refresh: 2; URL = home.html');
            
                }
        
                else
                {
                    $err = "Log In Failed";
                    print '<p style="text-align: center;font-size: 15px;font-family: Open Sans;color:red;margin-left: 150p">'.$err.'</p>';  
                    
                }
            }
}


?>