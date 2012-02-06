<?php
ob_start();
require_once 'EpiCurl.php';
require_once 'EpiFoursquare.php';
require_once'dbconfig.php';

//Credentials
$clientId = 'R5CZ5VDXFRMAPPLOD4A0AMRSXKJT0G30XSTPNYHAWMPUE2JA';
$clientSecret = 'RCSG54D4DBYBAHMO43PDBX2TASOUNT5KJDDQWL3R555PGSVH';
$code = 'BFVH1JK5404ZUCI4GUTHGPWO3BUIUTEG3V3TKQ0IHVRVGVHS';
$accessToken = 'DT32251AY1ED34V5ADCTNURTGSNHWXCNTOMTQM5ANJLBLO2O';

//Constructors
$fsObjUnAuth = new EpiFoursquare($clientId, $clientSecret);

//Time now
$timenow = date('Y-m-d H:m:s');

//Venue repository - array venueIds
$query = "SELECT * from venues";
$venues = mysql_query($query);
$venueIds = array();
while($resultArray = mysql_fetch_array($venues)){
	$id = $resultArray[0];
	array_push($venueIds, $id);
}


//Retrieval routines

foreach($venueIds as $venueId){
	$venue = $fsObjUnAuth->get('/venues/'.$venueId); 
	$venueName= $venue->response->venue->name;
	$usersCount= $venue->response->venue->stats->usersCount;
	$query = "insert into weeklystats values ('$venueId', '$venueName', '$usersCount', '$timenow')";
	mysql_query($query);
}

unset($query);

print "All venues updated successfully.";
?>