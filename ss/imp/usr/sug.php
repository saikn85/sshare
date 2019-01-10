<?php
    
    $db = mysqli_connect('localhost', 'root', '', '', '', NULL);
    
    if(!$db){
    
        die('Could not Connect' . mysqli_connect_error());
        
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        $uid = mysqli_real_escape_string($db, $_POST['uid']);
        
        $sub = mysqli_real_escape_string($db, $_POST['sub']);
        
        $prob = mysqli_real_escape_string($db, $_POST['prob']);
        
        $sql = "insert into sugg(uid, sub, prob)"
               . "values('$uid', '$sub', '$prob')";
        
        $res = mysqli_query($db, $sql);
        
        if($res){
            
            echo '<script>';
            echo 'alert("Suggestion/Report Posted...");';
            echo '</script>';
            
        }
        
        else{
            
            mysqli_error($db);
            
        }
        
    }
    
    mysqli_close($db);
    
    echo '<script type="text/javascript">';
                
    echo 'setTimeout(function(){window.location.replace'
         . '("/SmartShare/imp/usr/weluser.php")}, 0000);';
                
    echo '</script>';
?>