<?php
    
    
	$host="localhost"; 
    $username="root"; 
    $password=""; 
    $db_name="questbook"; 
    $tbl_name="replies"; 

    
    mysql_connect("$host", "$username", "$password")or die("cannot connect");
    mysql_select_db("$db_name")or die("cannot select DB");

    
    session_start();
    date_default_timezone_set("Europe/Athens");
    $myusername = $_SESSION['myusername'];
    $reply=filter_var($_POST['reply'], FILTER_SANITIZE_STRING);
    $ID = $_GET["ID"];
    $datetime=date("y-m-d h:i:s");
    $sql="INSERT INTO $tbl_name(username,IDcomment,reply,datetime1)VALUES('$myusername','$ID','$reply','$datetime')";
    $result=mysql_query($sql);
    
    
    if($result){
    
    
    header("location:guestbook.php");

    
    }

    else {
    echo "ERROR";
    }

    mysql_close();
?>