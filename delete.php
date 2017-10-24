<?php
    
    
	$host="localhost"; 
    $username="root"; 
    $password=""; 
    $db_name="questbook"; 
    $tbl_name="comments"; 
    $tbl_name1="replies";
    $tbl_name2="likecheck";
    $tbl_name3="likecheck1";

    // Connect to server and select database
    
    mysql_connect("$host", "$username", "$password")or die("cannot connect");
    mysql_select_db("$db_name")or die("cannot select DB");
    $ID = $_GET["ID"];
    
    // Diagrafontas tin kathe eggrafi prepei na ginei delete kathe stoixeio se olous tous pinakes pou exoun sxesi me auti
    $sql="DELETE FROM $tbl_name WHERE ID='$ID'";
    $result=mysql_query($sql);
   
    if($result){
        $sql1="DELETE FROM $tbl_name1 WHERE IDcomment='$ID'";
        $result1=mysql_query($sql1);
        
        $sql2="DELETE FROM $tbl_name2 WHERE IDcomment='$ID'";
        $result2=mysql_query($sql2);
        
        $sql3="DELETE FROM $tbl_name3 WHERE IDcomment='$ID'";
        $result3=mysql_query($sql3);
        
        if(!$result1){
            echo "ERROR_1";
        }elseif (!$result2){
            echo "ERROR_2";
        }elseif (!$result3){
            echo "ERROR_3";
        }
    header("location:guestbook.php");
    }

    else {
    echo "ERROR";
    }

    mysql_close();
?>