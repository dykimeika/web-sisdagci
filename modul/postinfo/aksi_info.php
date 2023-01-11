<?php

session_start();
include "../../config/koneksi.php";

$module = $_GET[module];
$act = $_GET[act];

// Hapus info
if ($module == 'postinfo' AND $act == 'hapus') {
    mysql_query("DELETE FROM tbl_info WHERE kd_info='$_GET[id]'");
    header('location:../../index.php?module=' . $module);
}

// Input info
elseif ($module == 'postinfo' AND $act == 'input') {
    $nama_info = $_POST[nama_info];
    $detail_info = $_POST[detail_info];
    $solusi_info = $_POST[solusi_info];

    $fileName = $_FILES['gambar_info']['name'];
    move_uploaded_file($_FILES['gambar_info']['tmp_name'], "../../gambar/post/" . $_FILES['gambar_info']['name']);
    mysql_query("INSERT INTO tbl_info(
			      nama_info,detail_info,solusi_info,gambar_info) 
	                       VALUES(
				'$nama_info','$detail_info','$solusi_info','$fileName')");

    header("location:../../index.php?module=" . $module);
}

// Update info
elseif ($module == 'postinfo' AND $act == 'update') {
    $nama_info = $_POST[nama_info];
    $detail_info = $_POST[detail_info];
    $solusi_info = $_POST[solusi_info];

    $fileName = $_FILES['gambar_info']['name'];
    if ($fileName){
    move_uploaded_file($_FILES['gambar_info']['tmp_name'], "../../gambar/post/" . $_FILES['gambar_info']['name']);

    mysql_query("UPDATE tbl_info SET
					nama_info   = '$nama_info',
					detail_info   = '$detail_info',
					solusi_info   = '$solusi_info',
					gambar_info   = '$fileName'
               WHERE kd_info       = '$_POST[id]'");
    } else {
        mysql_query("UPDATE tbl_info SET
					nama_info   = '$nama_info',
					detail_info   = '$detail_info',
					solusi_info   = '$solusi_info'
               WHERE kd_info       = '$_POST[id]'");
    }
    header('location:../../index.php?module=' . $module);
}
?>