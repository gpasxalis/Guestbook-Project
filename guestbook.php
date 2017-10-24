<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html>
<div class="site-head"><a id ="logout" href="Logout.php">Log out</a></div>
<head>
	<title>Your.Guestbook </title>
    <script type="text/javascript" src="js/guestbook.js"></script> 
	<link rel="stylesheet" href="css/guestbook.css">
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

<body>
	<div class="textarea_align">
	<form id="form1" name="form1" method="post" action="addguestbook.php" onsubmit="return checktext();">
		<textarea name="comment" cols="130" id="comment"></textarea>
		</br>
		<input type="submit" name="Submit" value="Submit" id="submit" />
	</form>
	</div>


		<!-- main posts (comments) -->
	<div class= "main_posts">
		<?php while($rows=mysql_fetch_array($result)){    

		$id = $rows['ID'];
		$like = $rows['likes'];?>
		

		<div class="post_head">
			Posted on <?php echo $rows['datetime']; ?> by <a href="SearchForComments.php?username=<?php echo $rows['username']; ?>"><?php echo $rows['username']; ?></a>
		</div>

		

		<?php echo $rows['comment']; ?>
		
		<form id="form_2" name="form_2" method="post" action="addlikes.php?ID=<?php echo $rows['ID']; ?>" ><input type="submit" value="Like" id="like_1" name="like_1"></form>
		<div class="links">
			<?php if ($myusername==$rows['username']){?><a id="delete_link" href="delete.php?ID=<?php echo $rows['ID']; ?>">Delete</a> 
			<?php } elseif ($myusername=='admin') {?> <a id="delete_link" href="delete.php?ID=<?php echo $rows['ID']; ?>">Delete</a><?php } ?>
			
			<a id="reply_link" href="javascript:my_function(document.getElementById('<?php echo $rows['ID']; ?>'))">Reply</a>
		</div>
		
		<div class="like_count">
			<?php if ($like==1) { ?>
			<?php echo $rows['likes'] ?> person like this post<?php }elseif ($like>0){ ?>
			<?php echo $rows['likes'] ?> people like this post<?php } ?>
		</div>
		
		<div class="show-replies">
			<a  href="javascript:myFunction()">Show replies</a>
		</div>
		
		<div align="center" style="display: none" id="<?php echo $rows['ID']; ?>">
		
			<form id="form2" name="form2" method="post" action="addreply.php?ID=<?php echo $rows['ID']; ?>" >
			<textarea cols="50" id="reply" name="reply"></textarea> <br> <input type="submit" name="submit1" value="Submit" ></form>
		</div> 

		
	</div>





		<!-- replies to comments -->

	<div id= "replies-to-hide" style="display: none">
		<?php 

		$sql1="SELECT * FROM $tbl_name1 WHERE IDcomment='$id' ORDER BY datetime1 DESC";
		$result1=mysql_query($sql1);


		while($rows1=mysql_fetch_array($result1)){ 
		$like1 = $rows1['likes1'];
		 ?>



		<div class="replies">
		
			<div class="reply_head">
				Posted on <?php echo $rows1['datetime1']; ?> by <a href="SearchForComments.php?username=<?php echo $rows1['username']; ?>"><?php echo $rows1['username']; ?></a>
			</div>

			<?php echo $rows1['reply']; ?>
			
			<div class="reply_likes">
				<form id="form_3" name="form_3" method="post" action="addlikes1.php?ID=<?php echo $rows1['ID']; ?>&IDc=<?php echo $rows['ID']; ?>" >
				<input type="submit" value="Like" id="like_2" name="like_2"></form>
			</div>
			
			<div class="reply_links">
				<?php if ($myusername==$rows1['username']){?><a href="delete1.php?ID=<?php echo $rows1['ID']; ?>">Delete</a> <?php } elseif ($myusername=='admin') {?>
				<a href="delete1.php?ID=<?php echo $rows1['ID']; ?>">Delete</a><?php } ?>
			</div>
			
			<div class = "reply-like-counts">
				<?php if ($like1==1) { ?>
				<?php echo $rows1['likes1'] ?> person like this post<?php }elseif ($like1>0){ ?>
				<?php echo $rows1['likes1'] ?> people like this post<?php }} ?>
			</div>
			
		</div>
	</div>
		
	





	<?php
	}
	mysql_close(); //close database
	?>
</body>
</html>