<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1" name="viewport" >	<!-- for media queries -->
	<title>Records</title>
	<link href="NMCStyling.css" rel="stylesheet">  <!-- linking css file -->
</head>

<body>
<h1> Edit Records </h1>
<p> To edit a record, click on the record title. </p>
<?php
	try {
		require_once("functions.php"); //calling fucntions file
		$dbConn = getConnection();	//connecting to db

		//SQL select statement getting record data
		$sqlQuery = "SELECT recordID, recordTitle, recordYear, catDesc, recordPrice, pubName
				FROM nmc_records
				INNER JOIN nmc_category
				ON nmc_category.catID = nmc_records.catID
				INNER JOIN nmc_publisher
				ON nmc_records.pubID = nmc_publisher.pubID
				ORDER BY recordTitle";
		
		//Querying sql statement
		$queryResult = $dbConn->query($sqlQuery);
		
		//output the record data
		while ($rowObj = $queryResult->fetchObject()) {
			echo "<div class='records'>\n
			<span class='title'>
			<span class='recordID'>{$rowObj->recordID}</span>\n
			<a href='NMCEditRecordForm.php?recordID={$rowObj->recordID}'>{$rowObj->recordTitle} </a>;
			</span>\n
			<span class='recordYear'>{$rowObj->recordYear}</span>\n
			<span class='catDesc'>{$rowObj->catDesc}</span>\n
			<span class='recordPrice'>{$rowObj->recordPrice}</span>\n
			<span class='pubName'>{$rowObj->pubName}</span>\n
			
			</div>\n";
			
		}
		}
	catch (Exception $e) {
		echo "<p>Query failed: ".$e->getMessage()."</p>\n";	//error handling
	}
?>

<a class="LogOutButtonStyle" href='logout.php'> Log Out </a>		<!-- logout button -->
<a class="HomePageButtonStyle" href='NMCHomePage.html'> Home Page </a>	<!-- home page button -->

</body>
</html>
