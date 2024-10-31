<?php header("Content-Type:text/html; charset=windows-1251");

// Initialize an URL to the variable 
$url = "https://www.holytrinityorthodox.com/calendar/calendar2.php"; 
  
// Use get_headers() function 
$headers = @get_headers($url); 
  
// Use condition to check the existence of URL 
if($headers && strpos( $headers[0], '200')) {  
    $month = $_GET['month'];
	$year = $_GET['year'];
	$today = $_GET['today'];
	$trp = $_GET['trp'];
	$header = $_GET['header'];
	$lives = $_GET['lives'];
	$scripture = $_GET['scripture'];
	$dt = $_GET['dt'];

	$contents = file_get_contents("https://www.holytrinityorthodox.com/calendar/calendar2.php?month=$month&today=$today&year=$year&dt=$dt&header=$header&lives=$lives&trp=$trp&scripture=$scripture");

	echo $contents;
} 
else { 
    echo("Blessed is he who comes in the name of the LORD.");
   
} 
  


?>
