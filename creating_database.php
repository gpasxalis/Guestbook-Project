<?php

	$db="questbook";
	$db_user="root";
	$db_password="";
	$db_host="localhost";

	$link=mysql_connect($db_host,$db_user,$db_password);
	if (!$link) {
	die('Could not connect: ' .mysql_error() );
	}

	
	if (mysql_query("CREATE DATABASE questbook",$link) ) {
	echo "Database and admin's account created successfully";
	}
	else {
	echo "Error creating database: " .mysql_error();
	}


	mysql_select_db("questbook",$link);
    $table= "CREATE TABLE users
			(ID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			username VARCHAR(30) NOT NULL ,
			password VARCHAR(30) NOT NULL )";
    mysql_query($table,$link);
    
            /* Ginetai create to account tou admin kai ginetai elegxos na min ftiaxtei 2 fores o logariasmos 
            stin periptosi pou patithei to koubaki gia create tis database pano apo 1 fora sto starting_page.html */
            
        $usrname="admin";
        $pswd="1234";
               
        $query1 = mysql_query("SELECT * FROM users WHERE username = '$usrname' ") or die(mysql_error());

        if(!$row = mysql_fetch_array($query1))
            {
                
                $sql="INSERT INTO users(username,password)VALUES('$usrname','$pswd')";
                $result=mysql_query($sql);
                
                }

	$table1="CREATE TABLE comments
			(ID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			username VARCHAR(30) NOT NULL,
			comment TEXT(500) NOT NULL,
            datetime DATETIME NOT NULL,
            likes INT(200) NOT NULL)";
	mysql_query($table1,$link);
    
    
    $table2="CREATE TABLE replies
			(ID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			username VARCHAR(30) NOT NULL,
			IDcomment INT(11) NOT NULL,
			reply TEXT(500) NOT NULL,
            datetime1 DATETIME NOT NULL,
            likes1 INT(200) NOT NULL)";
    mysql_query($table2,$link);
    
    $table3="CREATE TABLE likecheck
            (id INT (11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(30) NOT NULL,
            IDcomment INT(11) NOT NULL,
            checklike BOOLEAN NOT NULL)";
    mysql_query($table3,$link);        
            
    
    $table4="CREATE TABLE likecheck1
            (id INT (11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(30) NOT NULL,
            IDreply INT(11) NOT NULL,
            IDcomment INT(11) NOT NULL,
            checklike1 BOOLEAN NOT NULL)";
    mysql_query($table4,$link);
    
	
	mysql_close($link);
?>