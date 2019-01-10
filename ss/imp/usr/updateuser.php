<?php
    
    $db = mysqli_connect('localhost', 'root', '', '', '', NULL);
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // username and password sent from form 
        
        $uid = mysqli_real_escape_string($db,$_POST['uid']);
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $pass = mysqli_real_escape_string($db,$_POST['pass']);
        $repass = mysqli_real_escape_string($db, $_POST['repass']);
        if($pass == $repass){
            
            $sql = "UPDATE users set pswd = '$pass', uname = '$name' where uid = '$uid'";
            
            $result = mysqli_query($db,$sql);
                      
            if($result){
                
                echo '<script type="text/javascript">';
                echo 'alert("Profile Successfully Updated.")';
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
            echo 'alert("Passwords Don\'t Match!")';
            echo '</script>';
            
        }
    }   
    
    mysqli_close($db);
    echo '<script type="text/javascript">';
    echo 'setTimeout(function(){window.location.replace'
          .'("/SmartShare/imp/usr/weluser.php")}, 0000);';
    echo '</script>';
?>