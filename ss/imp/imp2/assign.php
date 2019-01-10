<?php
    $db = mysqli_connect('localhost', 'root', '', '', '', NULL);
    if(!$db){
        die("Failed to Connect");
    }
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $docid = mysqli_real_escape_string($db, $_POST['docid']);
        $aid = mysqli_real_escape_string($db, $_POST['adminid']);
        $uid = mysqli_real_escape_string($db,$_POST['uid']);
        $seccode = mysqli_real_escape_string($db,$_POST['seccode']);
        $issuedate = mysqli_real_escape_string($db, $_POST['issuedate']);
        $duedate = mysqli_real_escape_string($db, $_POST['duedate']);
        if(isset($_POST['assigned'])== 'yes'){
            $assigned = '1';
        }
        else{
            $assigned = '0';
        }
        $pass = mysqli_real_escape_string($db, $_POST['pass']);
        $sql = "insert into docassign(docid ,adminid, uid, seccode, issued, due, assigned"
                . ", checked, pass) ".
                "values('$docid','$aid','$uid','$seccode', '$issuedate', '$duedate',"
                . "'$assigned', '0', '$pass')";
        if (mysqli_query($db, $sql)) {
            $sql1 = "update docreq set created = 1 where docid='$docid'";
            $res1 = mysqli_query($db, $sql1);
            if($res1){
                echo '<script type="text/javascript">'
                     .'alert("Access Granted.")</script>;';
            } else {echo mysqli_error($db);}
        } else {
            //echo mysqli_error($db);
            echo '<script type="text/javascript">'
            . 'alert("An Error Occured While Processing User\'s Request ");'
            . '</script>';
        }                    
    }
    mysqli_close($db);
    echo '<script type="text/javascript">';
    echo 'setTimeout(function(){window.location.replace("/SmartShare/imp/imp2/welAdmin1.php")}, 0000)';
    echo '</script>';
?>