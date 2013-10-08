<?php
// Set the JSON header
header("Content-type: text/json");

// The x value is the current JavaScript time, which is the Unix time multiplied
// by 1000.
$x = time() * 1000;
// The y value is a random number
$memcache = new Memcache;
$memcache->connect('127.0.0.1', 11211) or die ("Could not connect");
$get_result = $memcache->get('app');
$y = intval($get_result);
// Create a PHP array and echo it as JSON
$ret = array($x, $y);
echo json_encode($ret);
?>
