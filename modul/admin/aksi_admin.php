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

// Hapus admin
if ($module=='admin' AND $act=='hapus'){
  mysql_query("DELETE FROM tbl_admin WHERE username='$_GET[id]'");
  header('location:../../index.php?module='.$module);
}

// Input admin
elseif ($module=='admin' AND $act=='input'){
$username=$_POST[username];
$nama_lengkap=$_POST[nama_lengkap];
$pass=md5($_POST[password]);
$fileName = $_FILES['gambar_admin']['name'];
    move_uploaded_file($_FILES['gambar_admin']['tmp_name'], "../../gambar/admin/" . $_FILES['gambar_admin']['name']);
mysql_query("INSERT INTO tbl_admin(
			      username,password,nama_lengkap,gambar_admin) 
	                       VALUES(
				'$username','$pass','$nama_lengkap','$fileName')");

  header('location:../../index.php?module='.$module);
}

// Update admin
  elseif ($module == 'admin' AND $act == 'update') {
    $username = $_POST[username];
    $nama_lengkap = $_POST[nama_lengkap];

    $fileName = $_FILES['gambar_admin']['name'];
    if ($fileName) {
      move_uploaded_file($_FILES['gambar_admin']['tmp_name'], "../../gambar/admin/" . $_FILES['gambar_admin']['name']);

      mysql_query("UPDATE tbl_admin SET
          username      = '$username',
          nama_lengkap  = '$nama_lengkap',
                      gambar_admin   = '$fileName'
               WHERE username      = '$_POST[id]'");
    } else {
      mysql_query("UPDATE tbl_admin SET
          username      = '$username',
          nama_lengkap  = '$nama_lengkap'
               WHERE username      = '$_POST[id]'");
    }
    header('location:../../index.php?module=' . $module);
  }
  ?>
<?php } ?>