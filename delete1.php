<?php
    
    
	$host="localhost"; 
    $username="root"; 
    $password=""; 
    $db_name="questbook"; 
    $tbl_name="replies"; 
    $tbl_name1="likecheck1";

    
    mysql_connect("$host", "$username", "$password")or die("cannot connect");
    mysql_select_db("$db_name")or die("cannot select DB");
    $ID = $_GET["ID"];
    
    
    $sql="DELETE FROM $tbl_name WHERE ID='$ID'";
    $result=mysql_query($sql);
   
    if($result){
        $sql1="DELETE FROM $tbl_name1 WHERE IDreply='$ID'";
        $result1=mysql_query($sql1);
        if (!$result1){
            echo "ERROR_1";
        }
   
    header("location:guestbook.php");
    }

    else {
    echo "ERROR";
    }

    mysql_close();
?>