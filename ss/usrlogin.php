<!DOCTYPE html>
<html>
    <head>
        <title>User Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <style>
            legend{text-align: center; border-bottom: solid #3300cc 1px;}
            #a1{
                float: left; text-decoration: none; color: yellowgreen; 
                font-size: 18px;
            }
            #a2{
                float: right; text-decoration: none; color: yellowgreen;
                font-size: 18px;
            }
        </style>

    </head>
    <body>
        <header class='container'>
            Login to Use Smart Share - The Repository of Information.
        </header>
        <section class='jumbotron'>
            <div class="col-sm-3"></div>
            <div class='col-sm-6 left'>
                <form action='' method="POST">
                    <fieldset>
                        <legend>User Login.</legend>
                        <label>User ID:<span>*</span></label>
                        <input type='text' placeholder="Enter Your User ID Here." 
                               required maxlength="10" name='username'/>
                        <label>Password:<span>*</span></label>
                        <input type="password" placeholder="Enter Passowrd" 
                               required maxlength="30" name='password'/>
                        <a href="imp/pswdchg.php" id="a1">Forgot Something?</a>
                        <a href="regis.php" id="a2">New to Smart Share!</a>
                        <button type='submit' class='but'>Let ME In!!</button>
                    </fieldset>
                </form>
            </div>
            <div class="col-sm-3"></div>
        </section>
        <footer>
            <a href="index.php">
                Smart Share - The Repository of Information&copy; 2016.
            </a>
        </footer>
    </body>
</html>

<?php
    
    $db = mysqli_connect('localhost', 'root', '', '', '', NULL);
    
    if(!$db)
        die("Couldn't Connect".  mysqli_error($db));
    
    session_start();
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
    
        // username and password sent from form 
        
        $myusername = mysqli_real_escape_string($db,$_POST['username']);
        
        $mypassword = mysqli_real_escape_string($db,$_POST['password']);
        
        $sql = "SELECT * FROM users WHERE "
               . "uid = '$myusername' and pswd = '$mypassword'";
        
        $result = mysqli_query($db,$sql);
        
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        $count = mysqli_num_rows($result);
        
        echo mysqli_error($db);
        
        // If result matched $myusername and $mypassword, table row must be 1 row
        
        if($count == 1) {
        
            
                $_SESSION['uname'] = $row['uname'];
                $_SESSION['uid'] = $row['uid'];
                
                header("location: /SmartShare/imp/usr/weluser.php");
                
        }
        
        else {
            
            echo '<script type="text/javascript">';
            echo 'alert("Login Failed, Credentials WRONGLY Entered.")';
            echo '</script>';
            
        }
                
    }
    
    mysqli_close($db);
    
?>