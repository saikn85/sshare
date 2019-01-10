<?php
    $db = mysqli_connect('localhost', 'root', '', '', '', NULL);
    if(isset($_REQUEST['del'])){
        $delco = $_REQUEST['checkbox'];
        for($i = 0; $i < count($delco);$i++){
            $del_id = $delco[$i];
            $sql = "DELETE FROM request WHERE rid='$del_id'";
            $result = mysqli_query($db, $sql);
    }
    if($result){
        echo '<script type="text/javascript">';
        echo 'alert("Request(s) Deleted");';
        echo '</script>';
    } else{
        echo 'Error at' .  mysqli_error($db);
        }
    }
    mysqli_close($db);
    echo '<script type="text/javascript">';
    echo 'setTimeout(function(){window.location.replace("/SmartShare/imp/imp2/welAdmin0.php")}, 0000)';
    echo '</script>';
?>