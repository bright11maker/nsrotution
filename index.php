 <?php

  session_start();

  if(isset($_SESSION["id"])){
  	header("Location:home.php");
  }

   $conn = mysqli_connect("localhost","root","","NsroTution");


   if(!$conn){
   	//this negative statement notify when there error in connecting to the database

   	echo "NOT CONNECTED!";
   }

    //echo($_SESSION["username"]);
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>NsroTution</title>
</head>
<body>



 <form action="#" method="POST">
 	<input type="text" name="username" placeholder="ENTER YOUR USERNAME"><br>
 	<input type="PassWord" name="password" placeholder="ENTER YOUR PASSWORD"><br>
 	<input type="submit" name="Signin" value="sign in"><br>
 	<br>
 	<br>

 	<!-- <input type="submit" name="" value="Sign in"><br> -->
 </form>


<form action="#" method="POST">
  <input type="text" name="username" placeholder="Choose Your Username: "> <br>
  <input type="text" name="fname" placeholder="Enter Your firstname: "> <br>
  <input type="text" name="lname" placeholder="Enter Your Lastname: "><br>
  <input type="PassWord" name="password" placeholder="Enter Your PassWord: "><br>
  <input type="PassWord" name="rpassword" placeholder="Repeat Your PassWord: "><br>

  <input type="submit" name="Signup" value="Sign up"><br>
</form>
   
</body>
</html>


 <?php 
 //trigger for log in section
 if(isset($_REQUEST["Signin"])){
 	$username = $_REQUEST["username"];
 	$pass=$_REQUEST["password"];


 	if($username != ""){
 		if($pass!= ""){
 			//password is encrypted
 		 $enc_pas = md5($pass);
 			

   $query = mysqli_query($conn,"SELECT * FROM users WHERE username = '$username' AND password = '$enc_pas' AND active = 'yes'");

 			$numOfRow = mysqli_num_rows($query);
 			//echo "$numOfRow";

 			if($numOfRow  != 0){
 				//echo "Log In Successful";
 				//$_SESSION["username"] = $username;
 				$fetch = mysqli_fetch_assoc($query);
 				$_SESSION["username"] = $fetch["username"];
 				$_SESSION["id"] = $fetch["id"];
 				$_SESSION["fname"] = $fetch["fname"];
 				$_SESSION["lname"] = $fetch["lname"];

                //linking to the header page
 				header("Location:home.php");

 			}else{
 				echo "USERNAME AND PASSWORD do not match!!";

 			}

 			//echo "<span style=\"color:green\">YOU ARE THROUGH</span>";
 		}else{
 			echo "<span style=\"color:red\">TYPE YOUR PASSWORD</span>";
 		}
 		
 	}else{
 		echo "<span style=\"color:red\">TYPE Your USERNAME!</span>";
 	}	

 }


    //triger for the sign up section
   if(isset($_POST["Signup"])){
   	
   	$username=$_POST["username"];
   	$firstname=$_POST["fname"];
   	$lastname=$_POST["lname"];
   	$password=$_POST["password"];
   	$rpassword=$_POST["rpassword"];

  	 				
   			if($username != "" AND $password != "" AND $rpassword != ""){

   			          if($rpassword === $password){

   			          	//sign up only when username and active is zero
   			          	 $query = mysqli_query($conn,"SELECT * FROM users WHERE username = '$username' AND active = 'yes'");
   			          	// $numOfRow = mysqli_num_rows($query);
   			          	  $num = mysqli_num_rows($query);
   			          	 			          	
   			          if( $num != 0) {
			          	echo "Username Already Exist";

    		          }else{
 			          	$enc_pas = md5($password);
   			          	mysqli_query($conn, "INSERT INTO users(fname,lname,password,username) 
   			          	 VALUES('$firstname','$lastname','$enc_pas','$username' )");

   			          	//echo "Account created";

   			          }

   	     	          	// 	echo " Username : $username<br/>; fname : $firstname<br/>; lname : $lastname<br/>;
   			           // password : $password<br/>; rpassword : $rpassword<br/>";

   			          	//echo "<span style=\"color:green\">PassWord Confirmed! </span> ";

   			          }else{
   			          	echo "<span style=\"color:red\">Mismatched password! </span>";
   			          }
   			}else{

   				echo "<span style=\"color:red\"> Please fill the empty spaces </span> ";  				
   			}	
   }

 ?>


   


