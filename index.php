<?php 

include 'dbconfig.php';

//decide time
$timeline = array();
$query = "SELECT DISTINCT timeOfRecord from weeklystats ORDER BY timeOfRecord desc";
$result = mysql_query($query);
while($resultArray = mysql_fetch_array($result)){
	array_push($timeline, $resultArray[0]);
}

//logic of timeline
$latestTime = $timeline[0];
$olderTime = $timeline[1];

$queryLatest = "SELECT name, usersCount FROM weeklystats WHERE timeOfRecord='$latestTime'";
$resultLatest = mysql_query($queryLatest);

$queryOlder = "SELECT name, usersCount FROM weeklystats WHERE timeOfRecord='$olderTime'";
$resultOlder = mysql_query($queryOlder);

//constructor - venues assoc array
$venues = array();

while($resultArray = mysql_fetch_array($resultLatest)){
	$name = $resultArray[0];
	$usersCount = $resultArray[1];
	$venues['latest'][$name] = $usersCount;
}

while($resultArray = mysql_fetch_array($resultOlder)){
	$name = $resultArray[0];
	$usersCount = $resultArray[1];
	$venues['older'][$name] = $usersCount;
}

//construct array with new checkins
$popularVenues = array();
foreach($venues['latest'] as $venuename => $usersCount){
	(int)$diff = $venues['latest'][$venuename] - $venues['older'][$venuename];
	$popularVenues[$venuename] = $diff; 
}

//calculation for average new people
$countOfVenues = count($popularVenues); 
$sumOfNewPeople = 0;
foreach($popularVenues as $venuename=>$newPeopleAtVenue){
	$sumOfNewPeople += $newPeopleAtVenue;
}
$avgNewPeople = $sumOfNewPeople/$countOfVenues;

//storing state of popularity for venues
$venueState = array();
foreach($popularVenues as $venuename=>$newPeopleAtVenue){
	if($newPeopleAtVenue > $avgNewPeople)
		$venueState[$venuename] = 'green';
	if($newPeopleAtVenue < $avgNewPeople)
		$venueState[$venuename] = 'orange';
	if($newPeopleAtVenue == 0)
		$venueState[$venuename] = 'red';
}

// sorting venues by decreasing no of new people who went in
arsort($popularVenues);

//if we calculate average and then place venues above average or below average to decide which 
// place is hot , it does make a sense


//exit();
?>
<html lang="en">
<head>
<title>[bangalore] nights</title>
<meta charset="UTF-8">
<meta name="description" content="[bangalore] nights - discover popular nighlife based on foursquare checkin patterns." />
<meta name="keywords" content="foursquare bangalore checkins nighlife popular venues" />
<meta content="Priya Ranjan Singh" name="Author"/>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div id="wrapper">
<header>
[bangalore] nights
</header>
<nav>
<ul>
<li><a href="index.php">Last week's popular venues</a></li>
<li><a href="showAllTimeVenues.php">All time popular venues</a></li>
<li><a href="onboardedVenues.php">Onboarded Venues</a></li>
</ul>
</nav>
<content>
<div id="popularVenues">
<ul>
<?php 
foreach($popularVenues as $venuename=>$diff){
	print '<li>'."\n";
	print '  <div class="trend">'.$venueState[$venuename].'</div>'."\n";
	print '  <div class="venue">'.$venuename.'</div>'."\n";
	print '  <div class="checkinCount">'.$popularVenues[$venuename].'</div>'."\n";
	print '  <div class="checkinsText"> new people were here last week</div>'."\n";
	print '</li>'."\n";
}
?>
</ul>
</div>
</content>
</div>
<footer>
<div id="footText">
<p>[bangalore nights] 2011. the website uses 4sq data to present popularity.<br/>Made on #4sqhackathon, Sep 17, 18.</p>
<p>[bangalore] nights onboards venues supporting nighlife in Bangalore, India and shows its popularity 
based on users been there before. It also would highlight (in future) venues growing popular faster 
than others.</p>
</div>
</footer>
<!--  <script type="text/javascript"> 
 
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-2317725-1']);
  _gaq.push(['_trackPageview']);
 
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
 
</script>  -->
</body>
</html>
