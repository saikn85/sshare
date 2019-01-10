<?php
    
    $db = mysqli_connect('localhost', 'root', '', '', '', NULL);
    
    if(!$db){
        die("Failed to Connect");
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $docid = mysqli_real_escape_string($db, $_POST['docid']);
        
        $uid = mysqli_real_escape_string($db,$_POST['uid']);
        
        $seccode = mysqli_real_escape_string($db,$_POST['seccode']);
        
        $sql = "select * from docassign where docid = '$docid' ";
        
        $res = mysqli_query($db, $sql);
        
        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
        
        if($row['assigned'] == 1 && $row['checked'] == 1){
            
            echo '<script>';
            echo 'alert("You\'ve Either Gained Access or The Document is '
                 . 'Assinged to Someone Else... Please Wait... Till Next Time.")';
            echo '</script>';
            
        }
        
        else if($row['assigned'] == 1 && $row['checked'] == 0){
            
            if($row['uid'] == $uid and $row['seccode'] == $seccode){
                
                $sql1 = "update docassign set checked = 1 where docid = '$docid'"
                        . "and uid = '$uid' ";
                
                $res = mysqli_query($db, $sql1);
                
                if($res){
                    
                   echo '<script type="text/javascript">alert("Here Are The '
                        . 'Document\'s Details.'.'\nHere Is The Document\'s '
                        . 'Password: '.$row['pass'].'\nMake Changes as per Your '
                        . 'Need and\n Return the Document On or Before The Deadline'
                        . ' Is Reached. \n\nSuccess.")</script>'; 
                    
                }
                
                else mysqli_error ($db);
                
            }
            
            else{
                
                echo '<script>';
                echo 'alert("Failed Something Went Wrong...")';
                echo '</script>';
                
            }
            
        }else{
            
            echo '<script>';
            echo 'alert("Your Request Hasn\'t Been Answered Yet.")';
            echo '</script>';
            
        }
        
    }
    
    mysqli_close($db);
    
    echo '<script type="text/javascript">';
    echo 'setTimeout(function(){window.location.replace'
         .'("/SmartShare/imp/usr/weluser.php")}, 0000);';
    echo '</script>';
    
?>