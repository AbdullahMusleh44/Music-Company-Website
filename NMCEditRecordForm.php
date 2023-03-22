<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1" name="viewport" >	<!-- for media queries -->
	<title>movies</title>
</head>

<body>

	<?php
		require_once("functions.php");
		$dbConn = getConnection();

		$recordID = filter_has_var(INPUT_GET,'recordID') ? $_REQUEST['recordID'] : null;
		$pubID = filter_has_var(INPUT_GET,'pubID') ? $_REQUEST['pubID'] : null;
		$pubName = filter_has_var(INPUT_GET,'pubName') ? $_REQUEST['pubName'] : null;
		$catID = filter_has_var(INPUT_GET,'catID') ? $_REQUEST['catID'] : null;
		$catDesc = filter_has_var(INPUT_GET,'catDesc') ? $_REQUEST['catDesc'] : null;

		echo "$recordID";

		if (empty($recordID)) {
			echo "<p>Please <a href='NMCViewRecords.php'>choose</a> a record.</p>\n"; //if empty, choose a record
		} else {

			try {
				require_once("functions.php"); //calling functions file
				$dbConn = getConnection(); //establishing connection

				
				$sqlQuery = "SELECT recordID, recordTitle, recordYear, recordPrice, pubID, catID
						FROM nmc_records
						WHERE recordID = '$recordID'"; 
				$queryResult = $dbConn->query($sqlQuery); //querying sql statement
				$rowObj = $queryResult->fetchObject();
				
				//outputting form with form fields
				echo "<form id='UpdateRecord' action='NMCUpdateRecord.php' method='post'>";
				
				echo "<label> ID: </label>";
				echo "<input type='text' name='recordID' value='{$rowObj->recordID}' readonly>";
				
				echo "<label> Title: </label>";
				echo "<input type='text' name='recordTitle' value='{$rowObj->recordTitle}'>";
				echo "<label> Year: </label>";
				echo "<input type='text' name='recordYear' value='{$rowObj->recordYear}'>";
				
				//dynamic drop down list of publishers
				$sql = "SELECT * FROM nmc_publisher";
				$queryResult = $dbConn->query($sql);
				echo "<label> Publisher Name<select name='pubID'>";
				while($current = $queryResult->fetchObject()){
					if($rowObj->pubID == $current->pubID){
						$selected = 'selected';
					} else {
						$selected = '';
					}
					echo "<option value = '{$current -> pubID}' $selected> $current->pubName</option>"; 
				}
				echo "</select>";
				echo "</label>";
				
				
				//dynamic drop down list of categories
				$sql = "SELECT * FROM nmc_category";
				$queryResult = $dbConn->query($sql);
				echo "<label> Category Name<select name='catID'>";
				while($current = $queryResult->fetchObject()){
					if($rowObj->catID == $current->catID){
						$selected = 'selected';
					} else {
						$selected = '';
					}
					echo "<option value = '{$current -> catID}' $selected> $current->catDesc </option>"; 
				}
				echo "</select>";
				echo "</label>";
				echo "<label> Price: </label>";
				echo "<input type='text' name='recordPrice' value='{$rowObj->recordPrice}'>";
				echo "<input type='submit' value='Update Record'>";
				echo "</form>";
				
				
				echo"<a href='logout.php'> Log Out </a>";	//outputting logout button
				
				} catch (Exception $e){
			echo "<p>Query failed: ".$e->getMessage()."</p>\n";
			}
		}
	?>
</body>
</html>