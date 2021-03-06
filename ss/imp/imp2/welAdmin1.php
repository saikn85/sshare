<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Administration</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../css/bootstrap.min.css" type="text/css"/>
        <script src="../../js/jquery-3.1.0.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <style>
            p{ font-family: cursive; font-size: 25px; color: red;}
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
                width: 100%; margin-left: auto; margin-right: auto;
                display: inline-block; text-align: left; font-weight: normal;
                border-width: 1px; border-style: groove; padding:25px 25px;
                border-spacing: 3px; border-color: pink; font-size: 15px;
            }
            .form2{
                width: 50%; margin-left: auto; margin-right: auto;
                display: inline-block; text-align: left; font-weight: normal;
                border-width: 1px; border-style: groove; padding:25px 25px;
                border-spacing: 3px; border-color: pink; font-size: 15px;
            }
            input[type="text"], input[type="password"], input[type="email"], 
            select, textarea{
                width: 100%; color: #3300cc; padding: 10px;
                margin: 10px;
            }
            .but{
                width: 100%; margin: 10px; background-color: pink; 
                padding: 10px; color: black; text-decoration: none; 
                font-size: 18px; border: none;
            }
            input[type="file"] {
                display: none;
            }
            .inputfile {
                width:35%; float: left; border: none; color: black;
                background-color: pink; display: inline-block; margin:10px;
                padding: 6px 12px; cursor: pointer; text-align: center;
            }
            .upload{ font-weight: bold;
                width:35%; float: right; border: none; color: black;
                background-color: pink; display: inline-block; margin:10px;
                padding: 6px 12px; cursor: pointer; text-align: center;
            }
        </style>
    </head>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
    <body>
        <div class="container">
            <h3>Welcome to Administration, Document Administrator:  
                <?php session_start(); echo $_SESSION['uname'];?>
                <a href="../logout.php" style="float: right; text-decoration: none;">Logout</a>
            </h3>
            <ul class="nav nav-pills nav-justified">
                <li class="active">
                    <a data-toggle="tab" href="#home">Home</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#menu1">Document's Status</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#menu2">View Documents</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#menu3">Document Requests</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#menu4">Grant Permission</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#menu5">Revoke Permission</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#menu6">Review</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#menu7">Report Center</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                   <h3>HOME SWEET HOME</h3>
                   <p>
                       Welcome Admin. It seems that<br/>YOU'VE<br/>lot of work Today.
                       <br/>So Cheer Up.
                   </p>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <?php $db = mysqli_connect('localhost',
                            'root', '', '', '', NULL);
                    ?>
                    <table>
                        <tr>
                            <th>Basis</th>
                            <th>Count</th>
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
                            <td>Documents to be Reviewed</td>
                            <td><?php echo $res = mysqli_num_rows(mysqli_query($db, "select * from docreview where reviewed='0'"));?></td>
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
                <div id="menu2" class="tab-pane fade">
                    <h3>Documents in the System</h3>
                    <?php 
                        $db = mysqli_connect('localhost', 'root', '', '', '', NULL);
                        $sql = "select docid,docname,author,version,doctype,docsize,"
                                . "verchd,pass from documents";
                        $result = mysqli_query($db,$sql);
                        if(($count = mysqli_num_rows($result)) == 0){
                            echo "<p>No Documents Uploaded!<p>";
                        }
                    ?>
                    <form method="POST" action="deldoc.php">
                        <table>
                            <tr>
                                <th>Document ID</th>
                                <th>Document Name</th>
                                <th>Author</th>
                                <th>Version</th>
                                <th>Type</th>
                                <th>Size (MB)</th>
                                <th>Version Changed</th>
                                <th>Password</th>
                                <th>Download</th>
                                <th>Delete</th>
                    <?php
                        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    ?> 
                         <tr>
                            <td><?php echo $row['docid'];?></td>
                            <td><?php echo $row['docname'];?></td>
                            <td><?php echo $row['author'];?></td>
                            <td><?php echo $row['version'];?></td>
                            <td><?php echo $row['doctype'];?></td>
                            <td><?php echo number_format((($row['docsize'])/1024)/1024,3);?></td>
                            <td><?php echo $row['verchd'];?></td>
                            <td><?php echo $row['pass'];?></td>
                            <td><a href="download.php?id=<?=$row['docid'];?>">
                                    Download
                                </a></td>
                            <td>
                                <input name="checkbox[]" type="checkbox" 
                                    value="<?=$row['docid'];?>"/>
                            </td>
                        </tr>
                    <?php } ?>
                        <tr>
                            <td colspan="10">
                                <button type="submit" name="del">
                                    Delete Unwanted Documents
                                </button>
                            </td>
                        </tr>
                    </table>
                </form>
                </div>
                <div id="menu3" class="tab-pane fade">
                   <div class="container">
                        <div class="col-sm-6 text-left">
                            <h3>Upload Documents</h3>
                            <form action='upload.php' method='post' 
                                  class="form1"
                                  enctype="multipart/form-data">
                                <fieldset>
                                    <legend>Select Document</legend>
                                    <label>Author:</label>
                                    <input type="text" name="author" required=""
                                        placeholder="Name of the Author"/>
                                    <label>Version:</label>
                                    <input type="text" name="version" required=""
                                        placeholder="Document's Version"/>
                                    <label>Password:</label>
                                    <input type="password" required name="pass"
                                        placeholder="Document's Password"/>
                                    <label>Document Type:</label>
                                    <select name='select'>
                                        <option selected>
                                            Select Type of Document
                                        </option>
                                        <option>PDF</option>
                                        <option>XLS</option>
                                        <option>DOC/DOCX</option>
                                        <option>PPT/PPTX</option>
                                        <option>TXT</option>
                                        <option>RTF</option>
                                        <option>RAR</option>
                                        <option>ZIP</option>
                                    </select>
                                    <label class='inputfile'>
                                        Select a File
                                        <input type="file" name="userfile" required/>
                                    </label>
                                    <button type="submit" name='upload' 
                                            class="upload">
                                        Upload
                                    </button>
                                </fieldset>
                            </form>
                        </div>
                        <div class="col-sm-6 text-left">
                            <h3>Document Requests</h3>
                            <?php 
                                $db = mysqli_connect('localhost', 'root', '', '', '', NULL);
                                $sql = "select * from docreq";
                                $result = mysqli_query($db,$sql);
                                if(($count = mysqli_num_rows($result)) == 0){
                                    echo "<p>No Requests Available as of Now!<p>";
                                }
                            ?>
                            <form method="POST" action="docviewreq.php">
                                <table>
                                    <tr>
                                        <th>Document Request ID</th>
                                        <th>Document ID</th>
                                        <th>User ID</th>
                                        <th>Secret Code</th>
                                        <th>Reason</th>
                                        <th>Delete Request</th>
                            <?php
                                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                            ?> 
                                    <tr>
                                        <td><?php echo $row['docrid'];?></td>
                                        <td><?php echo $row['docid'];?></td>
                                        <td><?php echo $row['uid'];?></td>
                                        <td><?php echo $row['seccode'];?></td>
                                        <td><?php echo $row['reason'];?></td>
                                        <td>
                                            <input name="checkbox[]" type="checkbox" 
                                                value="<?=$row['docrid'];?>"/>
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
                    </div>
                </div>
                <div id="menu4" class="tab-pane fade">
                    <h3>Issue Documents to Users</h3>
                    <form action='assign.php' method="post" class='form2'>
                        <fieldset>
                            <legend>Grant Permissions</legend>
                            <label>Document ID:</label>
                            <input type='text' name='docid' required=""
                                    placeholder="Enter Document's ID"/>
                            <label>Administrator ID:</label>
                            <input type='text' name='adminid' required=""
                                   placeholder="Enter Administrator ID"/>
                            <label>User ID:</label>
                            <input type='text' name='uid' required=""
                                   placeholder="Enter User ID"/>
                            <label>Secret Code:</label>
                            <input type="password" name="seccode" required=""
                                   placeholder="Enter Secret Code"/>
                            <br/><br/>
                            <label>Issue Date:</label>
                            <input type='date' name='issuedate'/>
                            <label>Due Date:</label>
                            <input type='date' name='duedate'/><br/><br/>
                            <label>Assigned:</label>
                            <label>Yes
                                <input type='radio' name='assigned' value='yes'/>
                            </label>
                            <label>No
                                <input type="radio" name="assigned" value="no"/>
                            </label>
                            <br/><br/>
                            <label>Password:</label>
                                <input type='password' name='pass' required=""
                                       placeholder="Enter Document's Password"/>
                            <button type='submit' name='grant' class='but'>
                                Grant Access
                            </button>
                        </fieldset>
                    </form>
                </div>
                <div id="menu5" class="tab-pane fade">
                <h3>Revoke Permissions</h3>
                    <?php 
                        $db = mysqli_connect('localhost', 'root', '', '', '', NULL);
                        $sql = "select * from docassign";
                        $result = mysqli_query($db,$sql);
                        if(($count = mysqli_num_rows($result)) == 0){
                            echo "<p>No Documents Assigned!<p>";
                        }
                    ?>
                    <form method="POST" action="revoke.php">
                        <table>
                            <tr>
                                <th>Assign ID</th>
                                <th>Document ID</th>
                                <th>Administrator ID</th>
                                <th>User ID</th>
                                <th>Access Code</th>
                                <th>Issued On</th>
                                <th>Due On</th>
                                <th>Assigned</th>
                                <th>Checked</th>
                                <th>Password</th>
                                <th>Revoke</th>
                    <?php
                        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    ?> 
                            <tr>
                                <td><?php echo $row['assignid'];?></td>
                                <td><?php echo $row['docid'];?></td>
                                <td><?php echo $row['adminid'];?></td>
                                <td><?php echo $row['uid'];?></td>
                                <td><?php echo $row['seccode'];?></td>
                                <td><?php echo $row['issued'];?></td>
                                <td><?php echo $row['due'];?></td>
                                <td><?php echo $row['assigned'];?></td>
                                <td><?php echo $row['checked'];?></td>
                                <td><?php echo $row['pass'];?></td>
                                <td>
                                    <input name="checkbox[]" type="checkbox" 
                                        value="<?=$row['assignid'];?>"/>
                                </td>
                            </tr>
                    <?php } ?>
                            <tr>
                                <td colspan="11">
                                    <button type="submit" name="del">
                                        Revoke Permissions
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div id="menu6" class="tab-pane fade">
                    <h3>Review Documents</h3>
                    <div class="container">
                        <div class="col-sm-6 text-left">
                            <h3>Upload Reviewed Documents</h3>
                            <form action='uploadrev.php' method='post' 
                                  class="form1"
                                  enctype="multipart/form-data">
                                <fieldset>
                                    <legend>Select Reviewed Document</legend>
                                    <label>Document ID:</label>
                                    <input type='text' name='docid' required=""
                                           placeholder="Enter Document's ID"/>
                                    <label>Version:</label>
                                    <input type="text" name="version" required=""
                                        placeholder="Document's Version"/>
                                    <label>Password:</label>
                                    <input type="password" required name="pass"
                                        placeholder="Document's Password"/>
                                    <label>Document Type:</label>
                                    <select name='select'>
                                        <option selected>
                                            Select Type of Document
                                        </option>
                                        <option>PDF</option>
                                        <option>XLS</option>
                                        <option>DOC/DOCX</option>
                                        <option>PPT/PPTX</option>
                                        <option>TXT</option>
                                        <option>RTF</option>
                                    </select>
                                    <label class='inputfile'>
                                        Select a File
                                    <input type="file" name="userfile" required/>
                                    </label>
                                    <button type="submit" name='upload' 
                                            class="upload">
                                        Upload
                                    </button>
                                </fieldset>
                            </form>
                        </div>
                        <div class="col-sm-6 text-left">
                            <h3>Review Documents</h3>
                        <?php
                            $db = mysqli_connect('localhost', 'root', 
                                    'max555', 'ss', '3306', NULL);
                            $sql = "select * from docreview";
                            $result = mysqli_query($db,$sql);
                            if(($count = mysqli_num_rows($result)) == 0){
                                echo "<p>No Documents to Review!<p>";
                            }
                         ?>   <table>
                                <tr>
                                    <th>Review ID</th>
                                    <th>Document ID</th>
                                    <th>Reviewed</th>
                                </tr>
                        <?php
                         while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        ?> 
                                <tr>
                                    <td><?php echo $row['revid'];?></td>
                                    <td><?php echo $row['docid'];?></td>
                                    <td><?php echo $row['reviewed'];?></td>
                                </tr>
                        <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="menu7" class="tab-pane fade">
                    <h2>Report Center Welcomes You.</h2>
                    <h3>Here You'll Find User Uploaded Documents</h3>
                    <?php 
                        $db = mysqli_connect('localhost',
                             'root', '', '', '', NULL);
                        
                        $result = mysqli_query($db, "select * from docrev");
                    ?>
                    <form method="POST" action="deldoc2.php">
                        <table>
                            <tr>
                                <th>Document ID</th>
                                <th>Document Name</th>
                                <th>User ID</th>
                                <th>Type</th>
                                <th>Size (MB)</th>
                                <th>Download</th>
                                <th>Delete</th>
                            </tr>
                    <?php
                        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    ?> 
                            <tr>
                                <td><?php echo $row['docid'];?></td>
                                <td><?php echo $row['docname'];?></td>
                                <td><?php echo $row['uid'];?></td>
                                <td><?php echo $row['type'];?></td>
                                <td>
                                   <?php echo number_format((
                                        ($row['size'])
                                        /1024)/1024,3);?>
                                </td>
                                <td>
                                    <a href="download2.php?id=
                                        <?=$row['docid'];?>">
                                            Download
                                    </a>
                                </td>
                                <td>
                                    <input name="checkbox[]" type="checkbox" 
                                           value="<?=$row['docid'];?>"/>
                                </td>
                            </tr>
                    <?php } ?>
                            <tr>
                                <td colspan="7">
                                <button type="submit" name="del">
                                    Delete Unwanted Documents
                                </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>