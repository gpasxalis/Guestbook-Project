<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html>
<div align = "right"><a href="Logout.php">Log out</a></div>
<head>
<title> Your Guestbook </title>
    <script type="text/javascript">
        function my_function(which){
        if (!document.getElementById)
        return
        if (which.style.display=="block")
        which.style.display="none"
        else
        which.style.display="block"
        }
        
        function checktext(){
        
            var x=document.forms["form1"]["comment"].value;
            
            if (x==null || x=="" )
                {
                  alert("You can't post a comment without content");
                 
                  return false;
                }
        }
        

            
    </script> 
    
</head>

<?php

if(!isset($_SESSION))
{
session_start();
}
$myusername = $_SESSION['myusername'];
echo "Welcome $myusername"; 


    $host="localhost"; 
    $username="root"; 
    $password=""; 
    $db_name="questbook"; 
    $tbl_name="comments"; 
    $tbl_name1="replies";

    // Connect to server and select database.
    
    mysql_connect("$host", "$username", "$password")or die("cannot connect");
    mysql_select_db("$db_name")or die("cannot select DB");

$sql="SELECT * FROM $tbl_name ORDER BY datetime DESC";
$result=mysql_query($sql);


?>

<body bgcolor="#E6E6E6">

<form id="form1" name="form1" method="post" action="addguestbook.php" onsubmit="return checktext();">
<div align="center">
<textarea name="comment" cols="130" id="comment"></textarea>
</br>
<input type="submit" name="Submit" value="Submit" />
</form>


<br><br>

    <!-- main posts (comments) -->

<?php while($rows=mysql_fetch_array($result)){    

$id = $rows['ID'];
$like = $rows['likes'];?>
<table width="650" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="4B5CFF"> <!--bgcolor="#CCCCCC" -->
<tr>
<td><table width="600" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">

<tr> <font size="-1"> <b>Posted on <?php echo $rows['datetime']; ?> by <a href="SearchForComments.php?username=<?php echo $rows['username']; ?>"><?php echo $rows['username']; ?></a></b></font></tr>

<tr>

<td><?php echo $rows['comment']; ?></td></tr>
<tr><td><div align="right"><form id="form_2" name="form_2" method="post" action="addlikes.php?ID=<?php echo $rows['ID']; ?>" ><input type="submit" value="Like" id="like_1" name="like_1"></form><?php if ($myusername==$rows['username']){?><a href="delete.php?ID=<?php echo $rows['ID']; ?>">Delete</a> <?php } elseif ($myusername=='admin') {?> <a href="delete.php?ID=<?php echo $rows['ID']; ?>">Delete</a><?php } ?>
    &nbsp <a href="javascript:my_function(document.getElementById('<?php echo $rows['ID']; ?>'))">Reply</a></div></td></tr>
<?php if ($like==1) { ?>
<tr><td><font size="-1"><?php echo $rows['likes'] ?> person like this post</font></td></tr> <?php }elseif ($like>0){ ?>
<tr><td><font size="-1"><?php echo $rows['likes'] ?> people like this post</font></td></tr> <?php } ?>
</table></td>
</tr>
<br>

<tr><td>

<div align="center" style="display: none" id="<?php echo $rows['ID']; ?>">
<br>
<form id="form2" name="form2" method="post" action="addreply.php?ID=<?php echo $rows['ID']; ?>" >
<textarea cols="50" id="reply" name="reply"></textarea> <br> <input type="submit" name="submit1" value="Submit" ></form>
</div> </td></tr>


</table>





    <!-- replies to comments -->


<?php 

$sql1="SELECT * FROM $tbl_name1 WHERE IDcomment='$id' ORDER BY datetime1 DESC";
$result1=mysql_query($sql1);


while($rows1=mysql_fetch_array($result1)){ 
$like1 = $rows1['likes1'];
 ?>




<table width="550" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#949ef7" style="position:relative;left:50px;"> <!--bgcolor="#CCCCCC" -->
<tr>
<td><table width="500" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">

<tr> <font size="-1"> <b>Posted on <?php echo $rows1['datetime1']; ?> by <a href="SearchForComments.php?username=<?php echo $rows1['username']; ?>"><?php echo $rows1['username']; ?></a></b> </font></tr>

<tr>

<td><?php echo $rows1['reply']; ?></td></tr><td> <div align="right"><form id="form_3" name="form_3" method="post" action="addlikes1.php?ID=<?php echo $rows1['ID']; ?>&IDc=<?php echo $rows['ID']; ?>" ><input type="submit" value="Like" id="like_2" name="like_2"></form>
    <?php if ($myusername==$rows1['username']){?><a href="delete1.php?ID=<?php echo $rows1['ID']; ?>">Delete</a> <?php } elseif ($myusername=='admin') {?> <a href="delete1.php?ID=<?php echo $rows1['ID']; ?>">Delete</a><?php } ?>
    </div></td>
<?php if ($like1==1) { ?>
<tr><td><font size="-1"><?php echo $rows1['likes1'] ?> person like this post</font></td></tr> <?php }elseif ($like1>0){ ?>
<tr><td><font size="-1"><?php echo $rows1['likes1'] ?> people like this post</font></td></tr> <?php } ?>
</table></td>
</tr>
<br>
</table><?php }  ?>





<?php
}
mysql_close(); //close database
?>
</body>
</html>