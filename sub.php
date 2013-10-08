<?php

require("phpMQTT.php");
$memcache = new Memcache;
$memcache->connect('127.0.0.1', 11211) or die ("Could not connect");
$tmp = '0';
$memcache->set('app', $tmp, false, 0) or die ("Failed to save data at the server");

$mqtt = new phpMQTT("127.0.0.1", 1883, "PHP MQTT Client");

if(!$mqtt->connect()){
        exit(1);
}

$topics['app'] = array("qos"=>0, "function"=>"procmsg");
$mqtt->subscribe($topics,0);

while($mqtt->proc()){

}


$mqtt->close();

function procmsg($topic,$msg){
$memcache = new Memcache;
$memcache->connect('127.0.0.1', 11211) or die ("Could not connect");
        $memcache->set("app", $msg, false, 0);
echo $msg;
}



?>
