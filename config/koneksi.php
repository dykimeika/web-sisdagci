<?php
//include "parser-php-version.php"; //konversi dan migrasi PHP version
$server = "localhost";
$username = "root";
$password = "";
$database = "sisdagci";

mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Maaf, Database tidak bisa dibuka");
?>