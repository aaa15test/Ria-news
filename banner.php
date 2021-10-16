<?php
header('Content-Type: image/jpeg');
readfile('ria_ru.jpg');

$f=fopen("stat.dat","a+");
flock($f,LOCK_EX);

//счетчик посещений
$count=fread($f,100);
$count++;

//время
date_default_timezone_set('Russia/Moscow');
$date = date('m/d/Y h:i:s', time());

ftruncate($f,0);
fwrite($f,$count."\r\n");
fwrite($f, $date."\r\n");
fflush($f);
flock($f,LOCK_UN);
fclose($f);
?>