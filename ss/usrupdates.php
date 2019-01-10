<!DOCTYPE html>
<html>
    <head>
        <title>Updates</title>
                <style>
            body{
                background-color: wheat; color: black;
                padding: 12px; margin: 12px; font-family: cursive;
                font-size: 20px; text-align: center;
            }
            span{ color: red; }
            legend{text-align: center; border-bottom: solid #3300cc 1px;}
            a{
                text-decoration: none; cursor: pointer; font-size: 20px;
                color: black;
            }
            form{
                padding: 25px; margin: 25px; width: 40%;
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
    </head>
    <body>
        <header>Check Your Request Status.</header>
        <form method="POST" action="">
            <fieldset>
                <legend>Check Status</legend>
                <label>Request ID:<span>*</span></label>
                <input type="text" name="rid" required=""
                       placeholder="Enter Your Request ID Here"/>
                <label>Secret Code:<span>*</span></label>
                <input type="text"  name="seccode" required=""
                       placeholder="Enter Your Secret Code Here"/>
                <button type="submit">Check</button>
            </fieldset>
        </form>
        <a href="usrlogin.php">Click Here to Start Using Smart Share.</a>
        <footer>
            Smart Share - The Repository of Information&copy; 2016.
        </footer>
    </body>
</html>
<?php
   $db = mysqli_connect('localhost', 'root', '', '', '', NULL);
    if(!$db){
        die('Could not Connect' . mysqli_connect_error());
    }
    else{
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $rid = mysqli_real_escape_string($db, $_POST['rid']);
            $sec = mysqli_real_escape_string($db, $_POST['seccode']);
            $sql = "select seccode, created from request where rid='$rid'";
            $res = mysqli_query($db, $sql) or die("Error".  mysqli_error($db));
            $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
            if($sec == $row['seccode']){
                $sql = "select uid, pswd, count from users where seccode='$sec'";
                $res = mysqli_query($db, $sql);
                $row1 = mysqli_fetch_array($res, MYSQLI_ASSOC);
                $uid = $row1['uid'];
                if($row1['count'] == 1 || $row['created'] == 0 ){
                    echo '<script>alert("You\'ve Viewed Your Credentials\n'
                    . 'Continue to Login\n\nOR,\n\nYour Request Has Not Been Processed");'
                    . '</script>';
                }
                else{
                    echo '<script>'
                    . 'alert("Your UserID is: '.$row1['uid'].'.\n'
                    . 'Your Password is: '.$row1['pswd'].'.\n'
                    . 'For Security Reasons You\'ll Not Be Able to View This'
                    . ' Section.\nAs You\'ve Gained Your Credentials.");'
                    . '</script>';
                    $sql = "update users set count = '1' where uid='$uid'";
                    $res = mysqli_query($db, $sql);
                    if($res){
                        //do nothing. :)
                    }
                    else {
                        echo mysqli_error($db);
                        echo mysqli_errno($db);
                    }
                }
            }else{
                echo '<script>alert("Try Again!\nPossible Reasons:\n1. Wrong Credentials.'
                . '\n2. A Jerk Trying To Access System, Who Has NO IDEA About'
                . '\nThe System.");</script>';
            }
        }
    }
   mysqli_close($db);
?>