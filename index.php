<?php 
	session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Home Page</h2>
	</div>
	<div class="content">

		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<table>
			<tr>
				<th>USERNAME</th>
				<th>EMAIL</th>
			</tr>
			<?php 
			    $con = mysqli_connect("localhost","root","","registration");
			    if ($con-> connect_error) {
			    	die("Connection failed:" . $con-> connect_error);
			    }
			    $sql ="SELECT  username ,email FROM users";
			    $result = $con-> query($sql);

			    if ($result-> num_rows >0) {
			    	while ($row = $result-> fetch_assoc()) {
			    		echo "<tr><td>". $row["username"]. "</td><td>".$row["email"]."</td></tr>";
			    	}
			    	echo "</table>";
			    }else{
			    	echo "0 results";
			    }
			    $con-> close();
			?>
			
		</table>

		<!-- logged in user information -->
		<?php  if (isset($_SESSION['username'])) : ?>
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
			<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
		<?php endif ?>
	</div>
		
</body>
</html>
