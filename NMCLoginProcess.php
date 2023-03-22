<?php
ini_set("session.save_path", "/home/unn_w21006726/sessionData"); //initializing session
session_start();
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1" name="viewport" >	<!-- for media queries -->
	<title>Log In Process </title>
</head>

<body>

	<?php
	// Retrieve the username and the password from the form
	$username = filter_has_var(INPUT_POST, 'username') ? $_POST['username']: null;
	$password = filter_has_var(INPUT_POST, 'password') ? $_POST['password']: null;

	// checking if empty
	if (empty ($username) || empty ($password)){
		echo "<p> Please input both username and password</p>\n";
	}

	//Trimming whitespace
	$username = trim($username);
	$password = trim($password);

	try {
		//Conecting to database
		require_once("functions.php");
		$dbConn = getConnection();
		
		//Querying nmc_users database table to get password hash for username entered, using a PDO named placeholder for the username */
		$querySQL = "SELECT passwordHash FROM nmc_users
		WHERE username = :username";
		
		//Prepare the sql statement using PDO
		$stmt = $dbConn->prepare($querySQL);
		
		//Execute the query using PDO
		$stmt->execute(array(':username' => $username));
		
		//Checking if a record was returned by the query.  
		$user = $stmt->fetchObject();
		
		//Check if password entered by user was correct. Otherwise, indicate an error.
		if ($user) { 	
		$passwordHash = $user->passwordHash;
		
		// Using password_verify function
			if (password_verify($password, $passwordHash)) {
				echo "<p>Log in succesful </p>\n";
				$_SESSION['logged-in'] = 'true';
				echo "<a href='NMCViewRecords.php'> Admin Page Here </a> "; //outputting admin page link
				echo "<p>To logout, click below </p>\n";
				echo "<a href='logout.php'> Log Out </a> "; //outputting logout link
			
			}
			else{
				echo "<p>Login details invalid, try again.</p>\n";
				echo "<a href='NMCLoginForm.html'> Try Again </a> "; //outputting login form link
			}
		}
		else {
		// Output text indicating invalid details.
		echo "<p>Login details invalid, try again.</p>\n";
		echo "<a href='NMCLoginForm.html'> Try Again </a> "; //outputting login form link
		}
	} catch (Exception $e) {
		echo "There was a problem: " . $e->getMessage();
	}

	?>
</body>
</html>
