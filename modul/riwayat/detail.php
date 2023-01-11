<style type="text/css">
  @media print {
    button {
      display: none;
    }
    footer {
      display: none;
    }
  }
</style>
<title>Detail Riwayat - SisDagCI</title>
<?php

if ($_GET['id']) {
  $arcolor = array('#ffffff', '#cc66ff', '#019AFF', '#00CBFD', '#00FEFE', '#A4F804');
  date_default_timezone_set("Asia/Jakarta");
  $inptanggal = date('Y-m-d H:i:s');

  $arbobot = array('0', '1', '0.8', '0.6', '0.4', '0.2');
  $argejala = array();
  $detailHitung = array();
  $detailHitungCF = array();

  for ($i = 0; $i < count($_POST['kondisi']); $i++) {
    $arkondisi = explode("_", $_POST['kondisi'][$i]);
    if (strlen($_POST['kondisi'][$i]) > 1) {
      $argejala += array($arkondisi[0] => $arkondisi[1]);
    }
  }

  $sqlkondisi = mysql_query("SELECT * FROM tbl_kondisi order by id+0");
  while ($rkondisi = mysql_fetch_array($sqlkondisi)) {
    $arkondisitext[$rkondisi['id']] = $rkondisi['kondisi'];
  }

  $sqlpkt = mysql_query("SELECT * FROM tbl_penyakit order by kd_penyakit+0");
  while ($rpkt = mysql_fetch_array($sqlpkt)) {
    $arpkt[$rpkt['kd_penyakit']] = $rpkt['nama_penyakit'];
    $ardpkt[$rpkt['kd_penyakit']] = $rpkt['detail_penyakit'];
    $arspkt[$rpkt['kd_penyakit']] = $rpkt['solusi_penyakit'];
    $argpkt[$rpkt['kd_penyakit']] = $rpkt['gambar_penyakit'];
  }

  $sqlhasil = mysql_query("SELECT * FROM tbl_hasil where kd_hasil=" . $_GET['id']);
  while ($rhasil = mysql_fetch_array($sqlhasil)) {
    $arpenyakit = unserialize($rhasil['penyakit']);
    $argejala = unserialize($rhasil['gejala']);
    $arnama = $rhasil['nama'];
    $arjns_kelinci = $rhasil['jenis_kelinci'];
    $artgl = $rhasil['tanggal'];
  }

  $np1 = 0;
  foreach ($arpenyakit as $key1 => $value1) {
    $np1++;
    $idpkt1[$np1] = $key1;
    $vlpkt1[$np1] = $value1;
  }


// --------------------- END -------------------------
  echo"
<div class='content'><div id='print-area-1' class='print-area'>
  <h2 class='text text-primary'>Hasil Diagnosis &nbsp;&nbsp;<a id='print' href=javascript:printDiv('print-area-1');>
  <i class='fa fa-print'></i> Cetak</a><small class='pull-right' style='margin-top:15px; font-size: 12pt;'>Date: $artgl</small></h2>
  <hr>
  <div class='row invoice-info'>
    <div class='table-responsive'>
    <h4><b>Nama Pemilik</b> &nbsp $arnama</h4>
    <h4><b>Jenis Kelinci</b> &nbsp&nbsp&nbsp&nbsp $arjns_kelinci</h4>
  </div>
  ";
  echo "

      <table class='table table-striped '> 
          <th width=8%>No</th>
          <th width=10%>Kode</th>
          <th>Gejala yang dialami (keluhan)</th>
          <th width=20%>Pilihan</th>
          </tr>";
  $ig = 0;
  foreach ($argejala as $key => $value) {
    $kondisi = $value;
    $ig++;
    $gejala = $key;
    $sql4 = mysql_query("SELECT * FROM tbl_gejala where kd_gejala = '$key'");
    $r4 = mysql_fetch_array($sql4);
    echo '<tr><td>' . $ig . '</td>';
    echo '<td>G' . str_pad($r4[kd_gejala], 2, '0', STR_PAD_LEFT) . '</td>';
    echo '<td><span class="hasil text text-primary">' . $r4[nama_gejala] . "</span></td>";
    echo '<td><span class="kondisipilih" style="color:' . $arcolor[$kondisi] . '">' . $arkondisitext[$kondisi] . "</span></td></tr>";
  }
  $np = 0;
  foreach ($arpenyakit as $key => $value) {
    $np++;
    $idpkt[$np] = $key;
    $nmpkt[$np] = $arpkt[$key];
    $vlpkt[$np] = $value;
  }
  if ($argpkt[$idpkt[1]]) {
    $gambar = 'gambar/penyakit/' . $argpkt[$idpkt[1]];
  } else {
    $gambar = 'gambar/noimage.png';
  }
  echo "</table><div class='well well-small'><img class='card-img-top img-bordered-sm' style='float:right; margin-left:15px;' src='" . $gambar . "' height=200><h3>Hasil Diagnosa</h3>";
  echo "<div class='callout callout-default'>Jenis penyakit pencernaan yang diderita kelinci adalah <b><h3 class='text text-success'><a class='btn bg-olive btn-xs' style='text-decoration:none; font-size:12pt;' target='_blank' href=profil/$idpkt[1]>" . $nmpkt[1] . "</a></b> / " . $vlpkt[1] * 100 . " % (" . $vlpkt[1] . ")<br></h3></div><h4 style='font-size:11pt;'>Kemungkinan Lain:</h4>";
  for ($ipl = 2; $ipl <= count($idpkt); $ipl++) {
  echo "<h4 style='font-size:11pt;'><i class='fa fa-angle-double-right'></i><a class='btn bg-maroon btn-xs' style='text-decoration:none;' target='_blank' href=profil/$idpkt[$ipl]> " . $nmpkt[$ipl] . "</a></b> / " . $vlpkt[$ipl] * 100 . " % (" . $vlpkt[$ipl] . ")<br></h4>";
  } 
  echo "</div><div class='box box-default box-solid'><div class='box-header with-border'><h3 class='box-title'>Detail</h3></div><div class='box-body'><h4>";
  echo $ardpkt[$idpkt[1]];
  echo "</h4></div></div>
          <div class='box box-default box-solid'><div class='box-header with-border'><h3 class='box-title'>Saran</h3></div><div class='box-body'><h4>";
  echo $arspkt[$idpkt[1]];
  echo "</h4></div></div>";
}
?>

<textarea id="printing-css" style="display: none;"></textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display: none;"></iframe>
<script type="text/javascript">
  function printDiv(elementId) {
    var a = document.getElementById('printing-css').value;
    var b = document.getElementById(elementId).innerHTML;
    window.frames["print_frame"].document.title = document.title;
    window.frames["print_frame"].document.body.innerHTML = '<h3 style="text-align:center;">SISTEM DIAGNOSA PENYAKIT PEENCERNAAN PADA KELINCI MENGGUNAKAN METODE CERTAINTY FACTOR</h3><hr> <style type="text/css">@media print {a {display: inline;} .box{visibility:visible;} table{visibility:visible; width:100%; margin-top:10px; margin-bottom:10px; border: 1px solid #000000;} .well{padding: 10px; border: 1px solid #000000;} .box{padding: 10px; margin-top:10px; border: 1px solid #000000;} .nilaiuser {background-color:black;display: inline;padding: 5px 5px;border-radius: 5px;} span.kondisipilih {background-color: #2f2130;padding: 2px 4px;border-radius: 4px;} td {padding:5px;}}' + a + '</style>' + b;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
}
</script>