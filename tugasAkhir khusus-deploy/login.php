<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<meta charset="UTF-8">
	<meta name="description" content="LOGIN">
	<script src="javascript/bootstrap.min.js"></script>

<title>Login Form</title>
</head>
<body>

			<?php
	$resp = "";
	$resp2 = "";
	if(isset($_POST["username"])){
		$user = $_POST["username"];
		$pass = $_POST["password"];	
		
	
		$conn = pg_connect("host=dbpg.cs.ui.ac.id port=5432 dbname=b02 user=b02 password=Xq9K3P") or die('connection failed');
		$sql = "SELECT * FROM mahasiswa WHERE username='$user' AND password='$pass'";
		$sqluser = "SELECT * FROM mahasiswa WHERE username='$user'";
		$sqlpass = "SELECT * FROM mahasiswa WHERE password='$pass'";
		$result = pg_query($conn, $sql);
		$resultuser = pg_query($conn, $sqluser);
		$resultpass = pg_query($conn, $sqlpass);
		
		if (pg_num_rows($result) > 0) {
			$sqlid = "SELECT npm FROM mahasiswa WHERE username='$user'";
			$results = pg_query($conn, $sqlid);
			$idx;		
			while($tmp = pg_fetch_array($results)){
				$idx = $tmp[0];
			}
			pg_close($conn);
			session_start();
			$_SESSION["userlogin"] =$user;
			$_SESSION["status"] ="mahasiswa";
			$_SESSION["id"] = $idx;
			header("Location: index.php");

		}
		else if (pg_num_rows($resultuser) == 0 )
		  {
				$sql = "SELECT * FROM dosen WHERE username='$user' AND password='$pass'";
				$sqluser = "SELECT * FROM dosen WHERE username='$user'";
				$sqlpass = "SELECT * FROM dosen WHERE password='$pass'";
				$result = pg_query($conn, $sql);
				$resultuser = pg_query($conn, $sqluser);
				$resultpass = pg_query($conn, $sqlpass);
				
					if (pg_num_rows($result) > 0) {
						$sqlid = "SELECT nip FROM Dosen WHERE username='$user'";
						$results = pg_query($conn, $sqlid);
						$idx;		
						while($tmp = pg_fetch_array($results)){
							$idx = $tmp[0];
						}
						pg_close($conn);
						session_start();
						$_SESSION["userlogin"] =$user;
						$_SESSION["status"] ="dosen";
						$_SESSION["id"] = $idx;
						header("Location: index.php");
					}
					else if (pg_num_rows($resultuser) == 0 ){
						$username=$_POST["username"];
						$password=$_POST["password"];
						if($username=="admin"&&$password=="admin"){
						pg_close($conn);
						session_start();
						$_SESSION["userlogin"] ="admin";
						$_SESSION["status"] ="admin";
						$_SESSION["id"] = 0;
						header("Location: index.php");
						}else if($username=="admin"){
							 echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>"."password tidak valid";
	 						header("Location: index.php");

						}
					else{
						 echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>"."username salah";	
 
						 pg_close($conn);

					}
					}
     	}
		else if (pg_num_rows($resultuser) > 0 && pg_num_rows($resultpass) == 0)
		  {
			  
			echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>"."password tidak valid";	
			pg_close($conn);
			return false;
		  } 
		else if (pg_num_rows($resultuser) > 0 && pg_num_rows($resultpass) > 0)
		  {
			  
             echo "<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>"."password tidak valid";	
 
			  pg_close($conn);
			return false;
		  }  
	
	}
	
?>		
			
		</div>
<div class="jumbotron text-center">
  <h1><b>SIASISTEN</b></h1>

</div>
<div class="container">

    <div class="row">
		<div class="col-md-4 col-md-offset-4">
			<form class="form" role="form" method="post" action="login.php" accept-charset="UTF-8" id="login-nav">
											<div class="form-group">
												 <label class="sr-only" for="exampleInputUsername">Username</label>
												 <input type="text" name="username" class="form-control" id="exampleInputUsername" placeholder="Username" required>
											</div>
											<div class="form-group">
												 <label class="sr-only" for="exampleInputPassword">Password</label>
												 <input type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="Password" required>
											</div>
											
											 <div class="form-group">
													<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
														Don't have an account! 
													<a href="#" onClick="signup()">
														Sign Up Here
													</a>
												</div>
											</div>
											
											<div class="form-group">
												 <button type="submit" value="sumbit" class="btn btn-primary btn-block">Sign in</button>
											</div>
										</form>

		</div>
	</div>
</div>

	</div>
  </div>
</div>



</body>
</html>
