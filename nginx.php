<?php

$fn = fopen("nginx.log","r");

	$redis = new Redis();
	$redis->connect('127.0.0.1', 6379);
	
  while(! feof($fn))  {
	$result = fgets($fn);
	$parsing = [];
	$parsing_pattern = preg_match_all("/^(\S+) (\W) (\W) (\[(\d+\D+\d+\D\d+\D\d+\D\d+\s\W\d+)\]) (\"(\w+\s\S+\s\w+\W\d\W\d)\") (\d+) (\d+) (\"(\S+)\") (\D+)(\S+) (\D+\"(\S+)\") (\D+\"(\S+)\") (\D+\"(\S+)\") (\D+\"(\S+)\")/",$result,$parsing);
	//memisahkan time
	//  $parsing_pattern = preg_match_all("/^(\S+) (\W) (\W) (\W(\d+\D+\d+\D\d+\D\d+\D\d+)\s(\W\d+)\W) (\"(\w+\s\S+\s\w+\W\d\W\d)\") (\d+) (\d+) (\"(\S+)\") (\D+)(\S+) (\D+\"(\S+)\") (\D+\"(\S+)\") (\D+\"(\S+)\") (\D+\"(\S+)\")/",$result,$parsing);
	$ip = $parsing[1][0] ?? "";
	$date = $parsing[5][0] ?? "";
	$method = $parsing[7][0] ?? "";
	$status = $parsing[8][0] ?? "";
	$ms = $parsing[9][0] ?? "";
	$site = $parsing[11][0] ?? "";
	$rt = $parsing[13][0] ?? "";
	$uct = $parsing[15][0] ?? "";
	$uht = $parsing[17][0] ?? "";
	$urt = $parsing[19][0] ?? "";
	$gz = $parsing[21][0] ?? "";
	// echo "$ip, $date, $method, $status, $ms, $site, $rt, $uct, $uht, $urt, $gz \n";
	$jsson = ["ip" => $ip, "date" => $date, "method" => $method, "status" => $status, "ms" => $ms, "site" => $site, "rt" => $rt, "uct" => $uct, "uht" => $uht, "urt" => $urt, "gz" => $gz];
	$jsson = json_encode($jsson);

	$redis->rPush("nginx",$jsson);
 }

fclose($fn);
?>