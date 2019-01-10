<?php

    $db = mysqli_connect('localhost', 'root', '', '', '', NULL);
    
    if(!$db){
        
        die('Could not Connect' . mysqli_connect_error($db));
    }
    
    else{
        
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $docid = mysqli_real_escape_string($db, $_POST['docid']);
            
            $uid = mysqli_real_escape_string($db,$_POST['uid']);
            
            $reason = mysqli_real_escape_string($db,$_POST['reason']);
            
            $x = mt_rand(1, 5);
            
            $min = pow(5, $x);
            
            $max = pow(25, $x+1)-1;
            
            $otp = mt_rand($min, $max);
            
            $sql = "insert into docreq(docid, uid, seccode, created, reason)"
                   . "values('$docid','$uid', '$otp', 0, '$reason')";
            
            $result = mysqli_query($db, $sql);
            
            echo $result;
            
            if ($result) {
               
                $sql = $sql = "SELECT seccode, docrid FROM docreq WHERE docid = '$docid'";
                
                $result = mysqli_query($db,$sql);
                
                $res = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                echo '<script type="text/javascript">alert("Your Request '
                . 'Has Been Submited\n'.'Here Is Your Unique Request ID: '
                .$res['docrid'].'\nYou Will Be '.'NOTIFIED ASAP'.'\nThank You, '
                . 'Here is Your ACCESS CODE REMEBER IT: '.$res['seccode']
                . '\n\nP. S. Remeber Your RequestID.")</script>';
                
            } else {
                
                mysqli_error($db);
                
                echo '<script type="text/javascript">alert("An Error Occured '
                . 'While Updating Your Request.\n'
                . 'Possible Reasons Might be a Name Conflict or Pending Requests.\n'
                . 'Please Check Our Request Update Corner.");</script>';
                
            }
            
        }
        
        mysqli_close($db);
        
        echo '<script type="text/javascript">';
        
        echo 'setTimeout(function(){window.location.replace'
             .'("/SmartShare/imp/usr/weluser.php")}, 0000);';
        
        echo '</script>';
    }
?>