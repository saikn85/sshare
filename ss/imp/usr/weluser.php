<!DOCTYPE html>

<html>
    <head>
        
        <title>Welcome User</title>
        
        <meta charset="utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="../../css/bootstrap.min.css" type="text/css"/>
        
        <script src="../../js/jquery-3.1.0.js"></script>
        
        <script src="../../js/bootstrap.min.js"></script>
        
        <style type="text/css">
            p{ font-family: cursive; font-size: 18px; color: red;}
            
            body{
                text-align: justify; padding: 10px; margin: 8px; 
                background-color: #e6e6e6;
            }
            
            input[type="text"], input[type="password"], input[type="email"], 
            textarea{
                width: 100%; color: #3300cc; padding: 10px;
                margin: 10px;
            }
            
            h3{text-align: center;}
            
        </style>

    </head>
    
    <body>
        
        <div class="container">
            
            <h3>Welcome to Smart Share. User: 
                <?php session_start(); echo $_SESSION['uname'];?> 
                
                <a href="../logout.php" 
                   style="float: right; text-decoration: none;">
                    Logout
                </a>
            
            </h3>
            
            <ul class="nav nav-pills nav-justified">
                
                <li class="active">
                    <a data-toggle="tab" href="#home">Home</a>
                </li>
                
                <li>
                    <a data-toggle="tab" href="#menu1">View Profile</a>
                </li>
                
                <li>
                    <a data-toggle="tab" href="#menu2">View Documents</a>
                </li>
                
                <li>
                    <a data-toggle="tab" href="#menu3">Request Document</a>
                </li>
                
                <li>
                    <a data-toggle="tab" href="#menu4">Access Restricted Area</a>
                </li>
            
                <li>
                    <a data-toggle="tab" href="#menu5">Suggestions/Report</a>
                </li>
            
            </ul>
            
            <div class="tab-content">
                
                <div id="home" class="tab-pane fade in active">
                   
                    <h3>HOME SWEET HOME</h3>
                   
                    <div>
                       
                       <p>Welcome User.<br/>  
                       <strong>"With the Greatest Respect!"</strong>,
                       Please Update Your Profile 
                       & Regularly.<br/>I Feel Like Life is Really Short, 
                       and it's Really <strong>IMPORTANT</strong> to Enjoy Stuff
                       and <strong>SAVE</strong> Whatever Seems to be Important.
                       <br/>Please Free to Use this Software and Have a
                       Cheerful Day Ahead<strong> "And Good Luck With THAT!".
                       </strong><br/>P. S.:Please Don't Feel Annoyed.<br/>
                       This is the First Thing What Everyone See, When They Login,
                       So Chill. <strong>And Do Recommend This To Others.
                       </strong>
                       </p>
                       
                   </div>
                    
                </div>
                
                <div id="menu1" class="tab-pane fade">
                    
                    <h3>Manage Your Profile</h3>
                    
                    <form action='updateuser.php' 
                          method='POST' class="form-group">
                    
                    <?php 
                        $db = mysqli_connect('localhost',
                            'root', 'max555', 'ss', '3306', NULL);
                        
                        $a = $_SESSION['uid'];
                        
                        $query = "select * from users where uid ='$a'";
                        
                        $result = mysqli_query($db, $query);
                        
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    ?>
                    
                        <fieldset>
                        
                            <legend>This is What You Are!</legend>
                            
                            <label>User ID:</label>
                            <input type="text" readonly="" name="uid"
                                   value="<?php echo $row['uid'];?>"
                                   class="form-control"/>
                            
                            <label>Your Name:</label>
                            <input type="text" name="name" required=""
                                   value="<?php echo $row['uname'];?>"
                                   class="form-control"/>
                            
                            <label>Current Password:</label>
                            <input type="text" readonly="" name="pswd"
                                   value="<?php echo $row['pswd'];?>"
                                   class="form-control"/>
                            
                            <label>Change Your Password:</label>
                            <input type="password" name="pass" required=""
                                   placeholder="Enter a New Password"
                                   class="form-control"/>
                            
                            <label>Re-Enter New Password:</label>
                            <input type="password" name="repass" required=""
                                   placeholder="Re-Enter New Password"
                                   class="form-control"/>
                            
                            <label>Your Secret Code:</label>
                            <input type="text" readonly="" 
                                   value="<?php echo $row['seccode'];?>"
                                   class="form-control"/>
                            
                            <button type="submit" class="btn btn-default
                                    center-block">
                                Update
                            </button>
                            
                        </fieldset>
                        
                    </form>
                    
                </div>
                
                <div id="menu2" class="tab-pane fade">
                    
                    <h3>Documents in the System</h3>
                    
                    <?php 
                    
                        $db = mysqli_connect('localhost', 'root', '', 
                                '', '', NULL);
                    
                        $sql = "select docid,docname,author,version,doctype,docsize,"
                               . "verchd,pass from documents";
                        
                        $result = mysqli_query($db,$sql);
                    
                        if(($count = mysqli_num_rows($result)) == 0){
                                echo "<p>No Documents Uploaded!<p>";
                        }
                    
                    ?>
                    
                    <table id="datatable"
                           class="table table-striped">
                        
                        <thead>
                            
                            <tr>
                                
                                <th>Document ID</th>
                                <th>Document Name</th>
                                <th>Author</th>
                                <th>Version</th>
                                <th>Type</th>
                                <th>Size (MB)</th>
                                <th>Download</th>
                                
                            </tr>
                            
                        </thead>
                        
                        <?php
                            while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        ?>
           
                        <tbody>
                            
                            <tbody>
                            
                                <tr>
                                
                                    <td><?php echo $row['docid'];?></td>
                                
                                    <td><?php echo $row['docname'];?></td>
                                
                                    <td><?php echo $row['author'];?></td>
                                
                                    <td><?php echo $row['version'];?></td>
                                
                                    <td><?php echo $row['doctype'];?></td>
                                
                                    <td><?php echo number_format((($row['docsize'])/1024)/1024,2);?></td>
                                
                                    <td>
                                    
                                        <a href="../imp2/download.php?id=<?=$row['docid'];?>">
                                            Download
                                        </a>
                                
                                    </td>
                            
                                </tr>

                        </tbody>
                        
                        <?php } ?>
                        
                    </table>
                    
                </div>
                
                <div id="menu3" class="tab-pane fade">
                    
                    <h3>Request a Document</h3>
                    
                    <div class="container">
                    
                        <div class="col-sm-5">
                        
                            <form action="docreq.php" method="POST">
                            
                                <fieldset>
                                
                                    <legend>Post a Request</legend>
                                    
                                    <label>Document ID:</label>
                                    
                                    <input type="text" name="docid" required=""
                                           placeholder="Enter The Docuemnt ID"/>
                                    
                                    <label>User ID:</label>
                                    
                                    <input type="text" name="uid" readonly=""
                                           value="<?php echo $_SESSION['uid'];?>"/>
                                    
                                    <label>Enter Your Reason:</label>
                                    
                                    <textarea name="reason" required
                                        placeholder="Enter Reason(s)" >
                                    </textarea>
                                    
                                    <button type="submit" class="btn btn-default
                                            center-block">
                                    
                                        Request
                                    
                                    </button>
                                
                                </fieldset>
                            
                            </form>
                        
                        </div>
                        
                        <div class="col-sm-2"></div>
                        
                        <div class="col-sm-5">
                        
                            <form action="status.php" method="post">
                            
                                <fieldset>
                                
                                    <legend>Check Status</legend>
                                    
                                    <label>Request ID:</label>
                                    
                                    <input type='text' name='docrid' required=""
                                           placeholder="Enter Doc. Request ID"/>
                                    
                                    <label>Enter Access Code:</label>
                                    
                                    <input type="text" name="seccode" required=""
                                           placeholder="Enter Access Code"/>
                                    
                                    <button type='submit' class="btn btn-default
                                            center-block">
                                        Check
                                    </button>
                                
                                </fieldset>
                            
                            </form>
                        
                        </div>
                    
                    </div>
                    
                </div>
                
                <div id='menu4' class='tab-pane fade'>
                    
                    <h3>
                        Welcome, We <span>HIDE</span> Secrets From World Here!
                    </h3>
                    
                    <div class="container">
                    
                        <div class='col-sm-6'>
                        
                            <form action="access.php" method="post">
                            
                                <fieldset>
                                
                                    <legend>Access Area 51.</legend>
                                    
                                    <label>User ID:</label>
                                    
                                    <input type="text" readonly="" name="uid"
                                           value="<?php echo $_SESSION['uid']?>"
                                    />
                                    
                                    <label>Document ID:</label>
                                    
                                    <input type='text' required="" name='docid'
                                           placeholder="Enter The Document's ID"
                                           />
                                    
                                    <label>Access Code:</label>
                                    
                                    <input type='password' required="" 
                                           name='seccode'
                                           placeholder="Enter the Access Code"/>
                                    
                                    <button type='submit' class="btn btn-default
                                            center-block">
                                        Enter At Your Own Risk
                                    </button>
                                
                                </fieldset>
                            
                            </form>
                        
                        </div>
                        
                        <div class='col-sm-6'>
                        
                            <form action="upload.php" method="POST"
                                  enctype="multipart/form-data">
                                
                                <fieldset>
                                
                                    <legend>Upload Edited Document</legend>
                                    
                                    <label>Your ID:</label>
                                    
                                    <input type='text' readonly="" name='uid'
                                           value="<?php echo $_SESSION['uid']?>"/>
                                    
                                    <label>Document ID:</label>
                                    
                                    <input type='text' required="" name='docid'
                                           placeholder="Enter The Document's ID"
                                           />
                                    
                                    <label class="btn btn-default btn-files
                                           center-block">
                                        
                                        Select a File.
                                    
                                        <input type='file' name="userfile"
                                               style="display: none;"/>
                                    
                                    </label><br>
                                    
                                    <button type='submit' name='upload'
                                            class="btn btn-default
                                            center-block">
                                        Upload
                                    </button>
                                
                                </fieldset>
                            
                            </form>
                        
                        </div>
                    
                    </div>
                
                </div>
                
                <div id='menu5' class='tab-pane fade'>
                    
                    <h3>
                        Open Suggestions And Reports
                    </h3>
                    
                    <div class='container'>
                        
                        <div class='col-sm-5'>
                            
                            <form action="sug.php" method="post">
                            
                                <fieldset>
                                
                                    <legend>Suggestions</legend>
                                    
                                    <label>Your ID:</label>
                                    
                                    <input type="text" readonly="" name="uid"
                                           value="<?php echo $_SESSION['uid']?>"/>
                                    
                                    <label>Subject of the Report:</label>
                                    
                                    <input type='text' required="" name="sub"
                                           placeholder="Write Subject"/>
                                    
                                    <label>Specify Your Problems/Report:</label>
                                    
                                    <textarea required="" name="prob"
                                       placeholder="Write Here(max. chars. 150)"
                                       maxlength="150">           
                                    </textarea>
                                    
                                    <button type='submit' class="btn btn-default
                                            center-block">
                                        Submit Your Grievance
                                    </button>
                                
                                </fieldset>
                            
                            </form>
                        
                        </div>
                        
                        <div class="col-sm-2"></div>
                        
                        <div class="col-sm-5">
                            
                            <h3>Peoples Problems... :P</h3>
                        
                        <?php 
                            $db = mysqli_connect('localhost',
                            'root', '', '', '', NULL);
                            $result = mysqli_query($db, "Select * from sugg");
                             if(mysqli_num_rows($result) == 0){
                                echo '<p>No Suggestions/Grievances Reported!</p>';
                             }else{
                        ?>
                            <table class="table table-striped">
                        
                                <thead>
                                
                                    <tr>
                                    
                                        <th>User ID</th>
                                        
                                        <th>Subject</th>
                                        
                                        <th>His/Her Problems/Reports</th>
                                    
                                    </tr>
                                
                                </thead>
                        <?php
                            while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        ?>
                            
                                <tbody>
                                
                                    <tr>
                                    
                                        <td><?php echo $row['uid'];?></td>
                                        
                                        <td><?php echo $row['sub'];?></td>
                                        
                                        <td><?php echo $row['prob'];?></td>
                                    
                                    </tr>
                                
                                </tbody>
                        <?php 
                                } 
                            }
                        ?>
                            
                            </table>
                        
                        </div>
                    
                    </div>
                
                </div>

            </div>
            
        </div>

    </body>

</html>