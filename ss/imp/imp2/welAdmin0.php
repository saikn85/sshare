<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Head Administration</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../css/bootstrap.min.css" type="text/css"/>
        <script src="../../js/jquery-3.1.0.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <style>
            p{ font-family: cursive; font-size: 41px; color: red;}
            body{
                text-align: center; padding: 10px; margin: 8px; 
                background-color: #e6e6e6;
            }
            legend{text-align: center; border-bottom: solid #3300cc 1px;}
            h1{ padding: 15px; margin: 10px;}
            table, td, th{
                margin-left: auto; margin-right: auto; margin-top: 25px;
                text-align: center; border-width: 1px; border-style: groove; 
                padding:8px; border-spacing: 3px; border-color: pink; 
                font-size: 15px;
            }
            button{
                background-color: pink; border: none; color: black;
                padding: 10px; text-align: center; text-decoration: none;
                display: inline-block;
            }
            .form1{
                width: 50%; margin-left: auto; margin-right: auto;
                display: inline-block; text-align: left; font-weight: normal;
                border-width: 1px; border-style: groove; padding:25px 25px;
                border-spacing: 3px; border-color: pink; font-size: 15px;
            }
            input[type="text"], input[type="password"], input[type="email"], 
            textarea{
                width: 100%; color: #3300cc; padding: 10px;
                margin: 10px;
            }
            .but{
                width: 100%; margin: 10px; background-color: pink; 
                padding: 10px; color: black; text-decoration: none; 
                font-size: 18px; border: none;
            }
        </style>
    </head>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
    <body>
        <div class="container">
            <h3>Welcome to Administration, Head Administrator:  
                <?php session_start(); echo $_SESSION['uname'];?>
                <a href="../logout.php" style="float: right; text-decoration: none;">Logout</a>
            </h3>
            <ul class="nav nav-pills nav-justified">
                <li class="active">
                    <a data-toggle="tab" href="#home">Home</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#menu1">System Status</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#menu2">User Requests</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#menu3">Create Users</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#menu4">Remove Users</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                   <h3>HOME SWEET HOME</h3>
                   <p>
                       Welcome Administrator. It seems that<br/>YOU'VE<br/>lot of work Today.
                       <br/>So Cheer Up.
                   </p>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <h3>Requests</h3>
                    <?php 
                        $db = mysqli_connect('localhost', 'root', '', '', '', NULL);
                        $sql = "select * from request where created = '0'";
                        $result = mysqli_query($db,$sql);
                        if(($count = mysqli_num_rows($result)) == 0){
                            echo "<p>No Requests Available as of Now!<p>";
                        }
                    ?>
                    <form method="POST" action="viewreq.php">
                        <table>
                            <tr>
                                <th>Request ID</th>
                                <th>User Name</th>
                                <th>E-Mail</th>
                                <th>Reason</th>
                                <th>Secret Code</th>
                                <th>Delete Request</th>
                        <?php
                            while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        ?> 
                        <tr>
                            <td><?php echo $row['rid'];?></td>
                            <td><?php echo $row['uname'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['reason'];?></td>
                            <td><?php echo $row['seccode'];?></td>
                            <td>
                                <input name="checkbox[]" type="checkbox" 
                                       value="<?=$row['rid'];?>"/>
                            </td>
                        </tr>
                            <?php } ?>
                        <tr>
                            <td colspan="6">
                                <button type="submit" name="del">
                                    Delete Unwanted Requests
                                </button>
                            </td>
                        </tr>
                        </table>
                    </form>
                </div>
                <div id="menu3" class="tab-pane fade">
                    <h3>Register a User</h3>
                    <form class="form1" action="usercreation.php" method="POST">
                        <fieldset>
                            <legend>Create a User.</legend>
                            <label>User ID:</label>
                            <input type="text" name="uid" 
                                   placeholder="Create a Unique ID."/>
                            <label>User Name:</label>
                            <input type="text" required name="name"
                                   placeholder="Enter User's Name"
                                   />
                            <label>Secret Code:</label>
                            <input type="text" required name='seccode'
                                   placeholder="Enter Secrect Code"/>
                            <label>Password:</label>
                            <input type="password" name="pswd"
                                   placeholder="Create a Password"/>
                            <button type="submit" class="but">Create User</button>
                        </fieldset>
                    </form> 
                </div>
                <div id="menu4" class="tab-pane fade">
                    <h3>Lets Delete Some Unwanted Users</h3>
                    <form action="deluser.php" method="POST">
                        <?php
                            $db = mysqli_connect('localhost', 'root', '', '', '', NULL);
                            $sql = "select * from users";
                            $result = mysqli_query($db,$sql);
                            if(($count = mysqli_num_rows($result)) == 0){
                                echo "<p>Empty!<p>";
                            }
                        ?>
                        <table>
                            <tr>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Password</th>
                                <th>Secret Code</th>
                                <th>Delete User(s)</th>
                        <?php
                            while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        ?> 
                        <tr>
                            <td><?php echo $row['uid'];?></td>
                            <td><?php echo $row['uname'];?></td>
                            <td><?php echo $row['pswd'];?></td>
                            <td><?php echo $row['seccode'];?></td>
                            <td>
                                <input name="checkbox[]" type="checkbox" 
                                       value="<?=$row['uid'];?>"/>
                            </td>
                        </tr>
                            <?php } ?>
                        <tr>
                            <td colspan="5">
                                <button type="submit" name="del">
                                    Delete Unwanted Users
                                </button>
                            </td>
                        </tr>
                        </table>
                    </form>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <h3>Current State of the System.</h3>
                    <?php
                        $db = mysqli_connect('localhost', 'root', '', '', '', NULL);
                    ?>
                    <table>
                        <tr>
                            <th>Basis</th>
                            <th>Count</th>
                        </tr>
                        <tr>
                            <td>Pending Requests</td>
                            <td><?php echo $res = mysqli_num_rows(mysqli_query($db, "select * from request where created='0'"));?></td>
                        </tr>
                        <tr>
                            <td>User Count:</td>
                            <td><?php echo $res = mysqli_num_rows(mysqli_query($db, "select * from users"));?></td>
                        </tr>
                        <tr>
                            <td>Document Count:</td>
                            <td><?php echo $res = mysqli_num_rows(mysqli_query($db, "select * from documents"));?></td>
                        </tr>
                        <tr>
                            <td>Documents Assigned</td>
                            <td><?php echo $res = mysqli_num_rows(mysqli_query($db, "select * from docassign where assigned='1'"));?></td>
                        </tr>
                        <tr>
                            <td>Documents Reviewed</td>
                            <td><?php echo $res = mysqli_num_rows(mysqli_query($db, "select * from docreview where reviewed='1'"));?></td>
                        </tr>
                        <tr>
                            <td>Documents Uploaded After Review</td>
                            <td><?php echo $res = mysqli_num_rows(mysqli_query($db, "select * from documents where verchd = '1'"));?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>