Create database ss;

USE ss;

Create table administration (AdminID int(1), 
                             AdName varchar(30), PSWD varchar(30), 
                             PRIMARY KEY(AdminID))Engine=InnoDB;


Create table request(rid int(9) UNIQUE AUTO_INCREMENT, 
                     uname varchar(50), email varchar(35), 
                     reason varchar(250), seccode int(6),
                     created boolean,
                     PRIMARY KEY (rid,seccode))Engine=InnoDB;


Create table users (rid int(1), uid int(5) UNIQUE, uname varchar(30) NOT NULL,
                    pswd varchar(50) NOT NULL, seccode int(6) NOT NULL,
                    count int(1), PRIMARY KEY(uid))Engine=InnoDB;


Create table documents(docid int(5) AUTO_INCREMENT, docname varchar(30),
                       author varchar(250), version decimal(3,1) NOT NULL, 
                       doctype varchar(10) NOT NULL, docsize int NOT NULL,
                       url varchar(250) NOT NULL, verchd tinyint(1), 
                       pass varchar(30) NOT NULL, 
                       PRIMARY KEY(docid))Engine=InnoDB;


Create table docassign (assignid int(5) AUTO_INCREMENT,
                        docid int(5) NOT NULL, adminid int(1) NOT NULL,
                        uid int(5) NOT NULL, seccode int(11) NOT NULL, 
                        issued varchar(30) NOT NULL, due varchar(30) NOT NULL, 
                        assigned tinyint(1) NOT NULL, 
                        checked tinyint(1) NOT NULL, pass varchar(30) NOT NULL, 
                        PRIMARY KEY(assignid))Engine=InnoDB;


Create table docreq(docrid int(5) AUTO_INCREMENT,
                    docid int(5) NOT NULL, uid int(5) NOT NULL, 
                    seccode int(11) NOT NULL, created tinyint(1), 
                    reason varchar(250) NOT NULL,
                    PRIMARY KEY(docrid))Engine=InnoDB;


Create table docreview (revid int(5) AUTO_INCREMENT, 
                        docid int(5) NOT NULL, reviewed boolean, 
                        PRIMARY KEY(revid))Engine=InnoDB;


Create table sugg ( uid int(5), 
                    sub varchar(35), 
                    prob varchar(500))Engine=InnoDB;

Create table docrev (docid int(5), docname varchar(50), uid int(5), 
                        type varchar(50), size int(10), path varchar(250)
                    )Engine=InnoDB;
