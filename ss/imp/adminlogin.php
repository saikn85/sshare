<!DOCTYPE html>
<html>
    <head>
        <title>Administration Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/login.css">
    </head>
    <body>
        <header class='container'>
            Login Administrator
        </header>
        <section class='jumbotron'>
            <div class="col-sm-3"></div>
            <div class='col-sm-6 left'>
                <form action='' method="POST">
                    <fieldset>
                        <legend>Administrator Login.</legend>
                        <label>Administration ID:<span>*</span></label>
                        <input type='text' placeholder="Enter Your User ID Here." 
                               required maxlength="10" name='username'/>
                        <label>Password:<span>*</span></label>
                        <input type="password" placeholder="Enter Passowrd" 
                               required maxlength="30" name='password'/>
                        <button type='submit' class='but'>Let ME In!!</button>
                    </fieldset>
                </form>
            </div>
            <div class="col-sm-3"></div>
        </section>
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
        
        $sql = "SELECT * FROM administration WHERE "
               . "AdminID = '$myusername' and PSWD = '$mypassword'";
        
        $result = mysqli_query($db,$sql);
        
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        $count = mysqli_num_rows($result);
        
        echo mysqli_error($db);
        
        // If result matched $myusername and $mypassword, table row must be 1 row
        
        if($count == 1) {
        
            if($myusername == 0){
            
                $_SESSION['uname'] = $row['AdName'];
                
                header("location: /SmartShare/imp/imp2/welAdmin0.php");
                
            }
            else{
                
                $_SESSION['uname'] = $row['AdName'];
                
                header("location: /SmartShare/imp/imp2/welAdmin1.php");
                
            }
        }
        else {
            
            echo '<script type="text/javascript">';
            echo 'alert("Login Failed, Credentials WRONGLY Entered.")';
            echo '</script>';
            
        }
                
    }
    
    mysqli_close($db);
    
?>