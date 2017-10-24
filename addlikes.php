<?php
    
    
	$host="localhost"; 
    $username="root"; 
    $password=""; 
    $db_name="questbook"; 
    $tbl_name="comments"; 
    $tbl_name1="likecheck";

    
    mysql_connect("$host", "$username", "$password")or die("cannot connect");
    mysql_select_db("$db_name")or die("cannot select DB");
    session_start();
    $ID = $_GET["ID"];
    $username = $_SESSION['myusername'];
    
    
    // update ton like sta comment kata ena kai elegxos ama exei kanei idi like sto post o xristis
    $sql1="SELECT checklike FROM $tbl_name1 where IDcomment='$ID' AND username='$username'";
    $result1=mysql_query($sql1);
    $rows=mysql_fetch_array($result1);
    
    
    if (empty($rows['checklike'])) {
        $sql="UPDATE $tbl_name SET likes=likes+1 WHERE ID='$ID' ";
        $result=mysql_query($sql);
        
        if($result){
        $sql2="INSERT INTO $tbl_name1 (username,IDcomment,checklike)VALUES('$username','$ID','1')";
        $result2=mysql_query($sql2);
        
        header("location:guestbook.php");

        
        }
    }elseif ($rows['checklike']=='1'){
        
        echo "You can't like a post twice";
        header( "refresh:3;url=guestbook.php" );        } 
        
    
    
    mysql_close();
?>