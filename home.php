<?php
session_start();


   if(!isset($_SESSION["id"])){
   	header("Location:index.php");


   	die("You need to login first");
   }
    $conn = mysqli_connect("localhost","root","","NsroTution");

?>


<!DOCTYPE html>
<html>
<head>
	<title><?php echo($_SESSION["username"])  ?></title>
</head>
<body>


	<?php echo $_SESSION["id"] ?><br>
	<?php echo $_SESSION["username"] ?><br>
	<?php echo $_SESSION["fname"] ?><br>
	<?php echo $_SESSION["lname"] ?><br>

	<form action="#" method="POST">
			<input type="submit" name="Logout" value="signout"><br>		
	</form>

	<form action="#" method="POST">
		<input type="submit" name="Delete" value="Delete Account">
	</form>

	<?php

	if(!$_SESSION["id"]){

		header("Location:index.php");
	}	

	 ?>

	 <?php
	 if(isset($_REQUEST["Delete"])){

	 	$myId = $_SESSION["id"];


	 	//mysqli_query($conn ,"SELECT * user WHERE active = 'no'");

	 	mysqli_query($conn, "UPDATE users SET active ='no ' WHERE id = '$myId' ");

	 	 session_destroy("Location:index.php");




	 	//echo "Account DELETED!!";\


    }




	 


	 ?>






	
</body>
</html>