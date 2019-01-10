<!DOCTYPE html>
<html>
    
    <head>
        
        <title>Login/Register</title>
        
        <meta charset="UTF-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
       
        <link rel="stylesheet" type="text/css" href="css/login.css">
        
        <style>
            
            legend{text-align: center; border-bottom: solid #3300cc 1px;}
        
        
        </style>
    
    </head>
    
    <body>
    
        <header class='container'>
        
            Welcome, You've Come to the Right Place to Learn More.
        
        </header>
        
        <section class="jumbotron">
        
            <div class='col-sm-3'></div>
            
            <div class='col-sm-6 right'>
            
                <form action="" method='POST'>
                
                    <fieldset>
                    
                        <legend>Send in a Request.</legend>
                        
                        <label>Enter Your Name:<span>*</span></label>
                        
                        <input type='text' name='uname' 
                               placeholder="Enter Your Name" required/>
                        
                        <label>Enter E-Mail ID:<span>*</span></label>
                        
                        <input type='email' name='email' 
                               placeholder="Enter Your E-Mail ID." required/>
                        
                        <label>Enter Your Reason:<span>*</span></label>
                        
                        <textarea maxlength="150" name="reason"
                                  placeholder="Maximum Limit is 75 Characters">
                        </textarea>                    
                        
                        <button type="submit" class='but'>Send in a Request.</button>
                    
                    </fieldset>
                
                </form>
            
            </div>
            
            <div class="col-sm-3"></div>
        
        </section>
        
        <footer class="container">
        
            <a href="index.php">
            
                Smart Share - The Repository of Information&copy; 2016.
            
            </a>
        
        </footer>
    
    </body>

</html>
    

    

<?php

    $db = mysqli_connect('localhost', 'root', '', '', '', NULL);
    if(!$db){
        die('Could not Connect' . mysqli_connect_error($db));
    }
    else{
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $uname = mysqli_real_escape_string($db, $_POST['uname']);
            $email = mysqli_real_escape_string($db,$_POST['email']);
            $reason = mysqli_real_escape_string($db,$_POST['reason']);
            $x = mt_rand(1, 5);
            $min = pow(5, $x);
            $max = pow(25, $x+1)-1;
            $otp = mt_rand($min, $max);
            $sql = "insert into request(uname,email,reason, seccode, created)"
                   . "values('$uname','$email','$reason', '$otp', 0)";
            if (mysqli_query($db, $sql)) {
                $sql = "SELECT rid, seccode FROM request WHERE uname = '$uname'";
                $result = mysqli_query($db,$sql);
                $res = mysqli_fetch_array($result, MYSQLI_ASSOC);
                echo '<script type="text/javascript">alert("Your Request '
                . 'Has Been Submited\n'.'Here Is Your Unique Request ID: '
                .$res['rid'].'\nYou Will Be '.'NOTIFIED ASAP'.'\nThank You, '
                . 'for Choosing Our Solution. :-)\n\n'
                . 'Here is Your SECRECT CODE REMEBER IT: '.$res['seccode']
                . '\n\nP. S. Remeber Your RequestID.")</script>';
            } else {
                echo '<script type="text/javascript">alert("An Error Occured '
                . 'While Updating Your Request.\n'
                . 'Possible Reasons Might be a Name Conflict or Pending Requests.\n'
                . 'Please Check Our Request Update Corner.");</script>';
            }
        }
        mysqli_close($db);
    }
?>