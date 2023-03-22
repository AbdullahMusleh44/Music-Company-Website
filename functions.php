<?php
function getConnection() {
	try {
		$connection = new PDO("mysql:host=localhost;dbname=unn_w21006726",
						"unn_w21006726", "Abood2365");
		$connection->setAttribute(PDO::ATTR_ERRMODE,
		PDO::ERRMODE_EXCEPTION);
		return $connection;
	} catch (Exception $e) {
	throw new Exception("Connection error ". $e->getMessage(), 0, $e);
	}
}

function makePageStart($title, $css) {
	$pageStartContent = <<<PAGESTART
	<!doctype html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>$title</title> 
		<link href=$css rel="stylesheet" type="text/css">
	</head>
	<body>
<div id="gridContainer">
PAGESTART;
	$pageStartContent .="\n";
	return $pageStartContent;
}

function makeHeader($header1){
	$headContent = <<<HEAD
		<header>
			<h1>$header1</h1>
		</header>
HEAD;
	$headContent .="\n";
	return $headContent;
}

function makeNavMenu($navMenuHeader, array $links) {
	$output = "";
	foreach ($links as $key =>$value) {
	$output .= "<li><a href=$key>$value</a></li>";
	}
	$navMenuContent = <<<NAVMENU
		<nav>
			<h2>$navMenuHeader</h2>
			<ul>
			$output
			</ul>	
		</nav>
NAVMENU;
	$navMenuContent .= "\n";
	return $navMenuContent;
}

function startMain() {
			return "<main>\n";
		}






function endMain() {
			return "</main>\n";
		}


function makeFooter($footerDesc) {
$footContent = <<<FOOT
<footer>
<p>$footerDesc</p>
</footer>
FOOT;
	$footContent .="\n";
return $footContent;
}

function makePageEnd() {
return "</div>\n</body>\n</html>";
}


//HANDLING EXCEPTIONS
/** 
* define a function to be the global exception handler that 
* will fire if no catch block is found
* @param $e
*/
function exceptionHandler ($e) {
	echo "<p><strong>Problem occured</strong></p>";
log_error($e);
}
/* now set the php exception handler to be the one above */
set_exception_handler('exceptionHandler');

/**
* define a function to be the global error handler, this will
* convert errors into exceptions.
*/
function errorHandler ($errno, $errstr, $errfile, $errline) {
// check error isn’t excluded by server settings
  if(!(error_reporting() & $errno)) { 
return; 
}
  throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
}
/* now set the php error handler to be the one above */
set_error_handler('errorHandler');



function log_error($e) {
	$fileHandle = fopen("logs/error_log_file.log", "ab");	
	$errorDate = date('D M j G:i:s T Y');
	$errorMessage = $e->getMessage();

 	$toReplace = array("\r\n", "\n", "\r"); //chars to replace
 	$replaceWith = '';	
 	$errorMessage = str_replace($toReplace, $replaceWith, $errorMessage);

	fwrite($fileHandle, "$errorDate|$errorMessage".PHP_EOL);
	fclose($fileHandle);
}


?>
