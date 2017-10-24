<?php

$host="localhost"; 
$username="root"; 
$password=""; 
$db_name="questbook";
$tbl_name="users"; 

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

// Get values from form
$username=filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$password=$_POST['password'];


$query1 = mysql_query("SELECT * FROM $tbl_name WHERE username = '$username' ") or die(mysql_error());

if(!$row = mysql_fetch_array($query1))
	{
        // Insert data into users table
		$sql="INSERT INTO $tbl_name(username, password)VALUES('$username', '$password')";
        $result=mysql_query($sql);
        echo "Your registration completed"; ?><br><br>
        <a href="starting_page.html"> Click Here to go back to sign in page </a> <?php
	}
    else
	{
		echo "Sorry the username already exists";
	}


?>

<?php
// close connection
mysql_close();
?>