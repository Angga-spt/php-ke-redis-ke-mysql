<?php

$fn = fopen("uwsgi.log","r");

	$redis = new Redis();
	$redis->connect('127.0.0.1', 6379);
	

  while(! feof($fn))  {
  $result = fgets($fn);
  $parsing = [];
  $parsing_pattern = preg_match_all("/^(\{(\D+)\s(\d+\s\S+)\}) (\{(\D+)\s(\d+\s\S+)\}) (\[(\D+)\s(\d+))/",$result,$parsing);
	$address_space = $parsing[3][0] ?? "";
	$rss = $parsing[6][0] ?? "";
	$pid = $parsing[9][0] ?? "";
	// echo "$address_space, $rss, $pid \n";
	$jsson = ["address_space" => $address_space, "rss" => $rss, "pid" => $pid];
	$jsson = json_encode($jsson);
	
	// $redis->select (1);
	$redis->rPush("uwsgi",$jsson);
  }
fclose($fn);
?>