<?php

// buffer for read file
$buf_size = 10000;

// sleep time for view new site
$timer = 99999;

/*
* open and read file by json 
* format and translate to array
*/
$file = fopen("sites.json", "r");
$file_query = fread($file, $buf_size);
$sites_array = json_decode($file_query, 1)['sites'];

// get sites by curl in cicle
foreach ($sites_array as $site) {

	$site_name = $site['url'];

	// curl working...
	$ch = curl_init($site_name);
	curl_setopt($ch, CURLOPT_CONNECT_ONLY, 1);
	curl_exec($ch);
	curl_close($ch);

	// time and view select site
	usleep($timer);
	echo $site_name . "\n";
}


fclose($file);