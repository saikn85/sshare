<?php
    
    $db = mysqli_connect('localhost', 'root', '', '', '', null);
    
    $target_dir = "usruploads/";
    
    if(isset($_POST["upload"])) {
        
        $target_file = $target_dir. basename($_FILES["userfile"]["name"]);
    
        $uploadOk = 1;
    
        $FileType = pathinfo($target_file, PATHINFO_EXTENSION);
        
        $docid = mysqli_real_escape_string($db, $_POST['docid']);
        
        $uid = mysqli_real_escape_string($db, $_POST['uid']); 
        
        $check = filesize($_FILES["userfile"]["tmp_name"]);
        
        if($check !== false) {
            
            //echo "File is a - " . $check["mime"] . ".";
            $uploadOk = 1;
            
        } else {
            
            //echo "Not a File.";
            $uploadOk = 0;
            
        }
    }
    
    
    // Check file size
    if ($_FILES["userfile"]["size"] > 128000000) {
        
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
        
    }
    

    // Allow certain file formats
    if($FileType != "pdf" && $FileType != "txt" && $FileType != "xls"
        && $FileType != "rtf" && $FileType != "ppt" && $FileType != "pptx" 
        && $FileType != "doc"  && $FileType != "docx" && $FileType != "rar"
            && $FileType != "zip") {
            
        echo '<script type="text/javascript">';
        echo 'alert("Sorry, only rtf, doc, txt, pdf, xls, ppt, rar, '
            . 'zip files are allowed.");';
        echo '</script>';
            
        $uploadOk = 0;
    }
    
    else{
        
        $uploadOk = 1;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        
        
        echo '<script type="text/javascript">';
        echo 'setTimeout(function(){window.location.replace'
             .'("/SmartShare/imp/usr/weluser.php")}, 0000);';
        echo '</script>';
        
    // if everything is ok, try to upload file                    
    } else {
        if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
            
            echo "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
            
            $fname = $_FILES["userfile"]["name"];
            
            $fsize = $_FILES["userfile"]["size"];
                        
            $path = $target_dir.basename( $_FILES["userfile"]["name"]);
            
            $query = "INSERT INTO docrev (docid, docname, uid, type, "
                . "size, path) " . "VALUES ('$docid', '$fname', '$uid', "
                    . "'$FileType', '$fsize', '$path')";
            
            $res = mysqli_query($db, $query) or die('Error, query failed'.
                    mysqli_error($db));
            
            if($res){
                
                echo '<script>'
                    . 'alert("The File was Uploaded Successfully");'
                    . '</script>';
                
                mysqli_close($db);
                
                
                echo '<script type="text/javascript">';
                
                echo 'setTimeout(function(){window.location.replace'
                . '("/SmartShare/imp/usr/weluser.php")}, 0000);';
                
                echo '</script>';
             } else {
                
                echo '<script>'
                     . 'alert("Sorry, there was an error '
                        . 'uploading your file.!");'
                     . '</script>';
                }
        } else {
            
            echo '<script>'
                 . 'alert("Sorry, there was an error uploading your file.!");'
                 . '</script>';
        }
    }
    
    mysqli_close($db);
    
    echo '<script type="text/javascript">';
                
    echo 'setTimeout(function(){window.location.replace'
         . '("/SmartShare/imp/usr/weluser.php")}, 0000);';
                
    echo '</script>';
    
?>