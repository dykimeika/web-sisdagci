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

  $module = $_GET[module];
  $act = $_GET[act];

// Hapus penyakit
  if ($module == 'penyakit' AND $act == 'hapus') {
    mysql_query("DELETE FROM tbl_penyakit WHERE kd_penyakit='$_GET[id]'");
    header('location:../../index.php?module=' . $module);
  }

// Input penyakit
  elseif ($module == 'penyakit' AND $act == 'input') {
    $nama_penyakit = $_POST[nama_penyakit];
    $detail_penyakit = $_POST[detail_penyakit];
    $solusi_penyakit = $_POST[solusi_penyakit];
    $fileName = $_FILES['gambar_penyakit']['name'];
    move_uploaded_file($_FILES['gambar_penyakit']['tmp_name'], "../../gambar/penyakit/" . $_FILES['gambar_penyakit']['name']);
    mysql_query("INSERT INTO tbl_penyakit(
			      nama_penyakit,detail_penyakit,solusi_penyakit,gambar_penyakit) 
	                       VALUES(
				'$nama_penyakit','$detail_penyakit','$solusi_penyakit','$fileName')");

    header('location:../../index.php?module=' . $module);
  }

// Update penyakit
  elseif ($module == 'penyakit' AND $act == 'update') {
    $nama_penyakit = $_POST[nama_penyakit];
    $detail_penyakit = $_POST[detail_penyakit];
    $solusi_penyakit = $_POST[solusi_penyakit];

    $fileName = $_FILES['gambar_penyakit']['name'];
    if ($fileName) {
      move_uploaded_file($_FILES['gambar_penyakit']['tmp_name'], "../../gambar/penyakit/" . $_FILES['gambar_penyakit']['name']);

      mysql_query("UPDATE tbl_penyakit SET
					nama_penyakit   = '$nama_penyakit',
					detail_penyakit   = '$detail_penyakit',
					solusi_penyakit   = '$solusi_penyakit',
                      gambar_penyakit   = '$fileName'
               WHERE kd_penyakit       = '$_POST[id]'");
    } else {
      mysql_query("UPDATE tbl_penyakit SET
					nama_penyakit   = '$nama_penyakit',
					detail_penyakit   = '$detail_penyakit',
					solusi_penyakit   = '$solusi_penyakit'
               WHERE kd_penyakit       = '$_POST[id]'");
    }
    header('location:../../index.php?module=' . $module);
  }
  ?>
<?php } ?>