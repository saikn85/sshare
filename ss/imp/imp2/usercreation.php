<?php
    $db = mysqli_connect('localhost', 'root', '', '', '', NULL);
    if(!$db){
        die("Failed to Connect");
    }
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $uid = mysqli_real_escape_string($db, $_POST['uid']);
        $pass = mysqli_real_escape_string($db,$_POST['pswd']);
        $name = mysqli_real_escape_string($db,$_POST['name']);
        $seccode = mysqli_real_escape_string($db, $_POST['seccode']);
        $sql = "insert into users(uid,uname,pswd,seccode) ".
                "values('$uid','$name','$pass', '$seccode')";
        if (mysqli_query($db, $sql)) {
            $sql = "SELECT uid FROM users where uname= '$name'";
            $result = mysqli_query($db,$sql);
            $res = mysqli_fetch_array($result, MYSQLI_ASSOC);
            echo '<script type="text/javascript">'
            . 'alert("User ID '.$res['uid'].'.'
            . ' Created Successfully")</script>;';
            $sql1 = "update request set created='1' where seccode='$seccode'";
            $res1 = mysqli_query($db, $sql1);
            if($res1){} else {echo mysqli_error($db);}
        } else {
            //echo mysqli_error($db);
            '<script type="text/javascript">'
            . 'alert("An Error Occured While Creating User");'
            . '</script>';
        }                    
    }
    mysqli_close($db);
    echo '<script type="text/javascript">';
    echo 'setTimeout(function(){window.location.replace("/SmartShare/imp/imp2/welAdmin0.php")}, 0000)';
    echo '</script>';
?>