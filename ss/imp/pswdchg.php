<!DOCTYPE html>
<html>
    <head>
        <title>Change Password.</title>
        <style>
            body{
                background-color: wheat; color: black;
                padding: 5px; margin: 5px; font-family: cursive;
                font-size: 12px; text-align: center;
            }
            span{ color: red; } 
            a{
                text-decoration: none; cursor: pointer; font-size: 20px;
                color: black;
            }
            form{
                padding: 20px; margin: 20px; width: 40%;
                text-align: left; display: inline-block; color: black;
                font-size: 18px; font-family: cursive;
            }
            input[type="text"], input[type="password"]{
                width: 90%; color: #3300cc; padding: 10px 10px 10px 10px;
                margin: 10px 10px 10px 10px;
            }
            button{ width: 94%; margin: 10px; padding: 10px; 
                    background-color: pink; color: black; 
                    text-decoration: none; font-size: 18px; 
                    border: none; cursor: auto; font-family: cursive;
            }
        </style>
        <script type='text/javascript'>
            function check(){
                var x = document.forms["form1"]["pswd"].value;
                var y = document.forms["form1"]["repass"].value;
                var k = x.toLocaleString(); var m = y.toLocaleString();
                var n = k.localeCompare(m);
                if(n === 0) return true;
                else{
                    alert("Passwords Don't Match, Try Again!");
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <h1>Hello, Need Assistance in Changing the Password.<br/>Well, You've Come to Right Place.</h1>       
        <form action='' method='POST' name='form1' onsubmit="return check();">
            <fieldset>
                <legend>Reset Password</legend>
                <label>User ID: <span>*</span></label>
                <input type="text" name='uid' required
                       placeholder="Enter Your User ID Here."/>
                <label>New Password: <span>*</span></label>
                <input type='password' placeholder="New Password"
                       name='pswd' required/>
                <label>Re-Enter Password: <span>*</span></label>
                <input type='password' placeholder="Re-Enter Password"
                       name='repass' required/>
                <label>Security Code: <span>*</span></label>
                <input type="text" name="seccode" required=""
                       placeholder="Enter Your Secret Code"/>
                <button type='submit' id='but' name="change">Change</button>
            </fieldset>
        </form>
        <a href='../usrlogin.php'>...Continue to Login.</a>
    </body>
</html>

<?php

    $db = mysqli_connect('localhost', 'root', '', '', '', NULL)
            or die(mysqli_error($db));
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        $uid = mysqli_real_escape_string($db, $_POST['uid']); 
        
        $pass = mysqli_real_escape_string($db, $_POST['pswd']);
        
        $seccode = mysqli_real_escape_string($db, $_POST['seccode']);
        
        $sql = "select * from users where uid = '$uid'" ;
        
        $res = mysqli_query($db, $sql) or die(mysqli_error($db));
        
        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
        
        
        if($row['seccode'] == $seccode){
            
            $sql = "update  users set pswd = '$pass' where uid = '$uid'";
            
            $res = mysqli_query($db, $sql);
            
            if($res){
                
                echo '<script type="text/javascript">';
                echo 'alert("Password Successfully Changed.")';
                echo '</script>';
                
            }
            
            else{
                
                echo '<script type="text/javascript">';
                echo 'alert("Something Went Wrong.")';
                echo '</script>';
                echo mysqli_error($db);
                
            }
            
        }
        else{
            
            echo '<script type="text/javascript">';
            echo 'alert("No Credentials Found or Unauthorized User")';
            echo '</script>';
            
        }
        
    }
    else{
        
        echo mysqli_error($db);
        echo mysqli_errno($db);
        
    }
    
    mysqli_close($db);
    
?>