<?php

session_start();
if (!(isset($_SESSION['username']) && isset($_SESSION['password']))) {
    header('location:index.php');
    exit();
} else {
?>
<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus pengetahuan
if ($module=='pengetahuan' AND $act=='hapus'){
  mysql_query("DELETE FROM tbl_basispengetahuan WHERE kd_pengetahuan='$_GET[id]'");
  header('location:../../index.php?module='.$module);
}

// Input pengetahuan
elseif ($module=='pengetahuan' AND $act=='input'){
$kd_penyakit=$_POST[kd_penyakit];
$kd_gejala=$_POST[kd_gejala];
$mb=$_POST[mb];
$md=$_POST[md];
mysql_query("INSERT INTO tbl_basispengetahuan(
			      kd_penyakit,kd_gejala,mb,md) 
	                       VALUES(
				'$kd_penyakit','$kd_gejala','$mb','$md')");
header('location:../../index.php?module='.$module);
}

// Update pengetahuan
elseif ($module=='pengetahuan' AND $act=='update'){
$kd_penyakit=$_POST[kd_penyakit];
$kd_gejala=$_POST[kd_gejala];
$mb=$_POST[mb];
$md=$_POST[md];
  mysql_query("UPDATE tbl_basispengetahuan SET
					kd_penyakit   = '$kd_penyakit',
					kd_gejala   = '$kd_gejala',
					mb   = '$mb',
					md   = '$md'
               WHERE kd_pengetahuan       = '$_POST[id]'");
  header('location:../../index.php?module='.$module);
 }
 
?>
<?php } ?>