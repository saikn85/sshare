<?php
    $db = mysqli_connect('localhost', 'root', '', '', '', null);
    
    $target_dir = "uploads/";
    
    $target_file = $target_dir . basename($_FILES["userfile"]["name"]);
    
    $uploadOk = 1;
    
    $FileType = pathinfo($target_file, PATHINFO_EXTENSION);
    
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["upload"])) {
        
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
             .'("/SmartShare/imp/imp2/welAdmin1.php")}, 0000);';
        echo '</script>';
        
    // if everything is ok, try to upload file                    
    } else {
        if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
            
            echo "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
            
            $fname = $_FILES["userfile"]["name"];
            
            $fsize = $_FILES["userfile"]["size"];
            
            $author = $_POST["author"]; $pass = $_POST["pass"]; $ver = $_POST["version"]; 
            
            $path = $target_dir.basename( $_FILES["userfile"]["name"]);
            
            $query = "INSERT INTO documents (docname, author, version, doctype, "
                . "docsize, url, verchd, pass) " .
                "VALUES ('$fname', '$author', '$ver', '$FileType', '$fsize', '$path'"
                . ",'0', '$pass')";
            
            $res = mysqli_query($db, $query) or die('Error, query failed'.
                    mysqli_error($db));
            
            if($res){
                
                echo '<script>'
                    . 'alert("The File was Uploaded Successfully");'
                    . '</script>';
                mysqli_close($db);
                
                echo '<script type="text/javascript">';
                echo 'setTimeout(function(){window.location.replace'
                . '("/SmartShare/imp/imp2/welAdmin1.php")}, 0000);';
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
?>