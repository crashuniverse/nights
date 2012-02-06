<?php 

include 'dbconfig.php';

$query = "SELECT * from venues";
$venues = mysql_query($query);

$venueIds = array();

while($resultArray = mysql_fetch_array($venues)){
	$id = $resultArray[0];
	array_push($venueIds, $id);
}

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
<div id="onboardedVenues">
<ul>
<?php
foreach($venueIds as $venueId){
	print '<li>'.$venueId.'</li>'."\n";
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