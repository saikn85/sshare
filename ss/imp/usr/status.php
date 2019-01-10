<?php

    $db = mysqli_connect('localhost', 'root', '', '', '', NULL);
    
    if(!$db){
        echo 'Connection Failed'. mysqli_connect_error();
    }
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $rid = mysqli_real_escape_string($db, $_POST['docrid']);
        
        $sec = mysqli_real_escape_string($db, $_POST['seccode']);
        
        $sql = "select created from docreq where docrid='$rid'"
                . "and seccode = '$sec' ";
        
        $res = mysqli_fetch_array(mysqli_query($db, $sql), MYSQLI_ASSOC);
        
        if($res['created'] == 1){
        
            echo '<script>alert("Your Request Has Been Approved.'
            . '\nYou\'ll Redirected in 5 Seconds");</script>';
        
        }
        else{
        
            echo '<script>alert("Document You Requested for:\n'
                 .'1. Is Either Rejected\n'
                 .'2. Or is Assigned to Another User.\n3. Not Yet Answered\n4.'
                 . 'Wrong Request ID.\n")'
                 . '</script>';
    
        }
     
    }
    
    mysqli_close($db);
        
    echo '<script>';
    
    echo 'setTimeout(function(){window.location.replace("/SmartShare'
         . '/imp/usr/weluser.php");},'
         . ' 0000);';
    
    echo '</script>';

?>