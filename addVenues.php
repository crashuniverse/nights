<?php 

include 'dbconfig.php';

$venues = array('4b5aaef9f964a520b8d028e3', '4b8b4d9ff964a5208b9b32e3', '4b7e9066f964a520f3f22fe3', '4b812e7ff964a5209a9930e3', '4b6c3087f964a5207c282ce3', '4c1ddb46fcf8c9b6af73ac0b', '4b6ef685f964a5207fd32ce3', '4b717255f964a5200d472de3', '4b853001f964a520ee4f31e3', '4b6ed273f964a5200acc2ce3', '4bb4bc45f1b976b08f381f20', '4b83ff91f964a5205d1a31e3', '4b6dd90df964a5205a952ce3', '4cf91b067b44224bd5e9d205', '4d307a3ff986a093aefefc66', '4d23471ed7b0b1f7d0552c9f', '4bdc5f92fed22d7f79dc57c9', '4c9f674b46978cfa3c7baa7f', '4be4290d2457a59328d0a915', '4bfbfb1db5cd2d7f96f030fb', '4ba0df90f964a520b88337e3', '4d7b43d2e04d6ea8e425e5d5', '4c1ceddcb9f876b089a97c46', '4b8d0ad3f964a52087e532e3', '4b6b944cf964a52005112ce3', '4b7fe86ff964a520b44330e3');
foreach($venues as $venueId){
	$query = "insert into venues values ('$venueId')";
	//mysql_query($query);	
}

?>