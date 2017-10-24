<?php
    
    
	$host="localhost"; 
    $username="root"; 
    $password=""; 
    $db_name="questbook"; 
    $tbl_name="comments"; 

    
    mysql_connect("$host", "$username", "$password")or die("cannot connect");
    mysql_select_db("$db_name")or die("cannot select DB");

    
    session_start();
    date_default_timezone_set("Europe/Athens");
    $myusername = $_SESSION['myusername'];
    $comment=filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
    $datetime=date("y-m-d h:i:s");
    $sql="INSERT INTO $tbl_name(username,comment,datetime)VALUES('$myusername','$comment','$datetime')";
    $result=mysql_query($sql);

    //check if query successful
    if($result){
    
    
    header("location:guestbook.php");

    
    }

    else {
    echo "ERROR";
    }

    mysql_close();
?>