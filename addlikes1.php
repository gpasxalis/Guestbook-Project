<?php
    
    
	$host="localhost"; 
    $username="root"; 
    $password=""; 
    $db_name="questbook"; 
    $tbl_name="replies"; 
    $tbl_name1="likecheck1";

    
    mysql_connect("$host", "$username", "$password")or die("cannot connect");
    mysql_select_db("$db_name")or die("cannot select DB");
    session_start();
    $ID = $_GET["ID"];
    $IDc=$_GET["IDc"];
    $username = $_SESSION['myusername'];
    
    
    // update ton like sta replies kata ena kai elegxos ama exei kanei idi like sto post o xristis
    $sql1="SELECT checklike1 FROM $tbl_name1 where IDreply='$ID' AND username='$username'";
    $result1=mysql_query($sql1);
    $rows=mysql_fetch_array($result1);
    
    
    if (empty($rows['checklike1'])) {
        $sql="UPDATE $tbl_name SET likes1=likes1+1 WHERE ID='$ID' ";
        $result=mysql_query($sql);
        
        if($result){
        $sql2="INSERT INTO $tbl_name1 (username,IDreply,IDcomment,checklike1)VALUES('$username','$ID','$IDc','1')";
        $result2=mysql_query($sql2);
        
        header("location:guestbook.php");

        
        }
    }elseif ($rows['checklike1']=='1'){
        
        echo "You can't like a post twice";
        header( "refresh:3;url=guestbook.php" );        } 
        
    
    
    mysql_close();
?>