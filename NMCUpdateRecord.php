<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1" name="viewport" >	<!-- for media queries -->
	<title>Update Records</title>
</head>

<body>

<?php
	//retrieving fields from database
	$recordID = filter_has_var(INPUT_POST, 'recordID') ? $_REQUEST['recordID'] : null;
	$recordTitle = filter_has_var(INPUT_POST, 'recordTitle') ? $_REQUEST['recordTitle'] : null;
	$recordYear = filter_has_var(INPUT_POST, 'recordYear') ? $_REQUEST['recordYear'] : null;	
	$pubID = filter_has_var(INPUT_POST, 'pubID') ? $_REQUEST['pubID'] : null;
	$catID = filter_has_var(INPUT_POST, 'catID') ? $_REQUEST['catID'] : null;
	$recordPrice = filter_has_var(INPUT_POST, 'recordPrice') ? $_REQUEST['recordPrice'] : null;

	//outputting fields 
	echo $recordID;
	echo $recordTitle;
	echo $recordYear;		
	echo $pubID;
	echo $catID;
	echo $recordPrice;


	$errors = false;

	//if any fields are missing, output user friendly text to enter into fields 
	if (empty($recordTitle)) {
			echo "<p>You have to select a record title.</p>\n";
			$errors = true;
	}
	if (empty($recordYear)) {
			echo "<p>You have to select a record year.</p>\n";						
			$errors = true;
	}
	if (empty($recordPrice)) {
			echo "<p>You have to select a price.</p>\n";
			$errors = true;
	}
	//if any errors occur, output to user to try again
	if ($errors) {
			echo "<p> Try again</p>\n";
	} 
	else {	 
			try {
				require_once("functions.php");	//call functions file
				$dbConn = getConnection();	//connect to db

				//sql update statement, setting fields to whatever user entered
				$sqlUpdate = "UPDATE nmc_records SET			
							recordTitle = '".$recordTitle."',
							recordYear = '$recordYear',
							pubID = '".$pubID."',
							catID = '".$catID."',
							recordPrice = '$recordPrice'
							WHERE recordID = '$recordID'";
							
				$dbConn->exec($sqlUpdate);	//execute sql statement
				echo "<p>Record Updated</p>\n";	//output text confirming changes made
				echo "<a href='NMCViewRecords.php'> Return to records page</a>\n";	//output records page button

				}	
			catch (Exception $e){
				echo "<p>Record details not found: ".$e->getMessage()."</p>\n";	//error handling
			}
		}
	?>
</body>
</html>
