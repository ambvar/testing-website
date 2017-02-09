<?php

session_start();

$host = "classdb.it.mtu.edu"; // Host name
$user = "acvaraca"; // Mysql username
$pass = "cracker123"; // Mysql password
$db_name = "acvaraca"; // Database name

mysql_connect("$host", "$user", "$pass") or die("cannot connect");
mysql_select_db("$db_name") or die("cannot select DB");


?>
