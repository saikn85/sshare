<?php
    $db = mysqli_connect('localhost', 'root', '', '', '', NULL);
    $path = "uploads/";
    if(isset($_GET['id'])){
        $docid = $_GET["id"];
        $sql = "select * from documents where docid='$docid'";
        $res = mysqli_query($db,$sql);
        if(!$res){
            echo mysqli_error($db);
        }else{
            $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
            $fname = $row["docname"];
            $file = $path.$fname;
            if(file_exists($file)){
                echo "File found";
                $type = strtolower($row['doctype']);
                header('Content-Type:application/'.$type);
                header('Content-Disposition: inline; filename='.$file);
                header('Content-Transfer-Encoding: Binary');
                //header('Accept-Ranges : Bytes');
                @readfile($file);
            }else{
                echo "Error";
            }
        }
    }
    mysqli_close($db);
?>