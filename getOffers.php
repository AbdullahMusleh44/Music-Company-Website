<?php
try {
	// include the file for the database connection
	require_once('functions.php');
	$dbConn = getConnection(); // get database connection
	$dbConn = getConnection();

	// echo what getJSONOffer returns
	echo getJSONOffer($dbConn);
}
catch (Exception $e) {
	echo "Error " . $e->getMessage(); //throw exception if problem occurs
}

function getJSONOffer($dbConn) {
    header("Content-Type: application/json; charset=UTF-8"); 

	try {
	    $sql = "select recordID, recordTitle, catDesc, recordPrice 
		from nmc_special_offers inner join nmc_category on nmc_special_offers.catID = nmc_category.catID 
		order by rand() limit 1";
	   	$rsOffer = $dbConn->query($sql);; //query sql statement
	    $offer = $rsOffer->fetchObject();
	    return json_encode($offer);
	}
	catch (Exception $e) {
		throw new Exception("problem: " . $e->getMessage()); //throw exception if problem occurs
	}
}

?>