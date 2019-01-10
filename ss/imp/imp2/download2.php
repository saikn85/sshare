<?php
    
    $db = mysqli_connect('localhost', 'root', '', '', '', NULL);
    
    $path = $_SERVER['DOCUMENT_ROOT'].'/SmartShare/imp/usr/usruploads/';
    
    echo $path;
    
    if(isset($_GET['id'])){
        
        $docid = $_GET["id"];
        
        $sql = "select * from docrev where docid = '$docid'";
        
        $res = mysqli_query($db,$sql);
        if(!$res){
            
            echo mysqli_error($db);
            
        }else{
            
            $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
            
            $fname = $row["docname"];
            
            $file = $path.$fname;
            
            if(file_exists($file)){
            
                echo "File found";
                
                $type = strtolower($row['type']);
                
                header('Content-Description: File Transfer');
                
                header('Content-Type: application/octet-stream');
                
                header('Content-Disposition: attachment; filename="'.basename($file).'"');
                
                header('Expires: 0');
                
                header('Cache-Control: must-revalidate');
                
                header('Pragma: public');
                
                header('Content-Length: ' . filesize($file));
                
                readfile($file);
                
                exit;
                
            }else{
                
                echo error_reporting();
                
            }
        }
    }
    
    mysqli_close($db);
?>