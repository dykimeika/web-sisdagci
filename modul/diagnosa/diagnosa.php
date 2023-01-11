<title>Diagnosa - SisDagCi</title>
<?php
switch ($_GET['act']) {

  default:
    if ($_POST['submit']) {
     $arcolor = array('#ffffff', '#cc66ff', '#019AFF', '#00CBFD', '#00FEFE', '#A4F804');
      date_default_timezone_set("Asia/Jakarta");
      $inptanggal = date('Y-m-d H:i:s');

      $arbobot = array('0', '1', '0.8', '0.6', '0.4', '0.2');
      $argejala = array();

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


//print_r($arkondisitext); echo "<br>";
//print_r($argejala);echo "<br>";

// -------- perhitungan certainty factor (CF) ---------
      $sqlpenyakit = mysql_query("SELECT * FROM tbl_penyakit order by kd_penyakit");
      $arpenyakit = array();
      $detailHitung = array();
      $detailHitungCF = array();
      while ($rpenyakit = mysql_fetch_array($sqlpenyakit)) {
        $cftotal_temp = 0;
        $cf = 0;
        $sqlgejala = mysql_query("SELECT * FROM tbl_basispengetahuan where kd_penyakit=$rpenyakit[kd_penyakit]");
        $cflama = 0;
        while ($rgejala = mysql_fetch_array($sqlgejala)) {
          //$arkondisi = explode("_", $_POST['kondisi'][0]);
          //$gejala = $arkondisi[0];
          for ($i = 0; $i < count($_POST['kondisi']); $i++) {
            $arkondisi = explode("_", $_POST['kondisi'][$i]);
            $gejala = $arkondisi[0];
            if ($rgejala['kd_gejala'] == $gejala) {
              $cf = ($rgejala['mb'] - $rgejala['md']) * $arbobot[$arkondisi[1]];
              $detailHitung[$rpenyakit['nama_penyakit']][] = [$rgejala['mb'],  $rgejala['md'], $arbobot[$arkondisi[1]], $cf];
              if (($cf >= 0) && ($cf * $cflama >= 0)) {
               $cflama_temp = $cflama + ($cf * (1 - $cflama));
                $detailHitungCF[$rpenyakit['nama_penyakit']][] = [$cflama, $cf, $cflama_temp];
                $cflama = $cflama_temp;
              }
              //if ($cf * $cflama < 0) {
              //  $cflama = ($cflama + $cf) / (1 - Math . Min(Math . abs($cflama), Math . abs($cf)));
              //}
              //if (($cf < 0) && ($cf * $cflama >= 0)) {
              //  $cflama = $cflama + ($cf * (1 + $cflama));
              //}
            }
          }
        }
        if ($cflama > 0) {
           $jmlCF = count($detailHitung[$rpenyakit['nama_penyakit']]);
          if ($jmlCF == 1) {
            $detailHitung[$rpenyakit['nama_penyakit']][] = 'Karena CF hanya 1, maka hasil akhir CF sebagai berikut';
          } else {
            $detailHitung[$rpenyakit['nama_penyakit']][] = 'Karena CF lebih dari 1, maka harus dihitung CF kombinasinya. Dan hasil akhir CF sebagai berikut';
          }
          $arpenyakit += array($rpenyakit[kd_penyakit] => number_format($cflama, 4));
        }
      }

      arsort($arpenyakit);

      $inpgejala = serialize($argejala);
      $inppenyakit = serialize($arpenyakit);
      $inpnama = $_POST[nama];
      $inpjeniskelinci = $_POST[jenis_kelinci];

      $np1 = 0;
      foreach ($arpenyakit as $key1 => $value1) {
        $np1++;
        $idpkt1[$np1] = $key1;
        $vlpkt1[$np1] = $value1;
      }

      mysql_query("INSERT INTO tbl_hasil(
                  nama,
                  jenis_kelinci,
                  tanggal,
                  gejala,
                  penyakit,
                  hasil_id,
                  hasil_nilai
				  ) 
	        VALUES(
                '$inpnama',
                '$inpjeniskelinci',
                '$inptanggal',
                '$inpgejala',
                '$inppenyakit',
                '$idpkt1[1]',
                '$vlpkt1[1]'
				)");
// --------------------- END -------------------------

echo"
<div class='content'>
  <div class='content'><div id='print-area-1' class='print-area'>
  <h2 class='text text-primary'>Hasil Diagnosis &nbsp;&nbsp;<a id='print' href=javascript:printDiv('print-area-1');>
  <i class='fa fa-print'></i> Cetak</a><small class='pull-right' style='margin-top:15px; font-size: 12pt;'>Date: $inptanggal</small></h2>
  <hr>
  <div class='row invoice-info'>
    <div class='table-responsive'>
    <h4><b>Nama Pemilik</b> &nbsp $inpnama</h4>
    <h4><b>Jenis Kelinci</b> &nbsp&nbsp&nbsp&nbsp $inpjeniskelinci</h4>
  </div>
  </div>
  ";
  echo "
      <table class='table table-striped'> 
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
  echo "<div class='callout callout-default'>Jenis penyakit pencernaan yang diderita kelinci adalah <h3 class='text text-success'><b><a class='btn bg-olive btn-xs' style='text-decoration:none; font-size:12pt;' target='_blank' href=profil/$idpkt[1]>" . $nmpkt[1] . "</a></b> / " . $vlpkt[1] * 100 . " % (" . $vlpkt[1] . ")<br></h3></div><h4 style='font-size:11pt;'>Kemungkinan Lain:</h4>";
  for ($ipl = 2; $ipl <= count($idpkt); $ipl++) {
  echo "<h4 style='font-size:11pt;'><i class='fa fa-angle-double-right'></i><a class='btn bg-maroon btn-xs' style='text-decoration:none;' target='_blank' href=profil/$idpkt[$ipl]> " . $nmpkt[$ipl] . "</a></b> / " . $vlpkt[$ipl] * 100 . " % (" . $vlpkt[$ipl] . ")<br></h4>";
  } 
  echo "</div><div class='box box-default box-solid'><div class='box-header with-border'><h3 class='box-title'>Detail</h3></div><div class='box-body'><h4>";
  echo $ardpkt[$idpkt[1]];
  echo "</h4></div></div>
          <div class='box box-default box-solid'><div class='box-header with-border'><h3 class='box-title'>Saran</h3></div><div class='box-body'><h4>";
  echo $arspkt[$idpkt[1]];
  //--------------------------------------------------
  echo "</h4></div></div><div class='box box-default box-solid'><div class='box-header with-border'><h3 class='box-title'>Detail Perhitungan</h3></div><div class='box-body'><h4>";
  echo " <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Gejala</th>
              <th>Penyakit</th>
              <th>MB</th>
              <th>MD</th>
              <th>CF Pakar</th>
              <th>Kondisi</th>
            </tr>
          </thead>
      <tbody>";
      $urt = 0;
      foreach ($argejala as $key => $value) {
        $kondisi = $value;
        $urt++;
        $gejala = $key;
        $sql4 = mysql_query("SELECT * FROM tbl_basispengetahuan where kd_gejala = '$key'");
        while ($r4=mysql_fetch_array($sql4)){
          $sqlg = mysql_query("SELECT * FROM tbl_gejala where kd_gejala = '$r4[kd_gejala]'");
        $sgejala=mysql_fetch_array($sqlg);
        $sqlp = mysql_query("SELECT * FROM tbl_penyakit where kd_penyakit = '$r4[kd_penyakit]'");
        $spenyakit=mysql_fetch_array($sqlp);
        $cfpakar = $r4[mb] - $r4[md];
        echo '<tr><td>' . $urt . '</td>';
        echo '<td>' . $sgejala[nama_gejala] . '</td>';
        echo '<td>' . $spenyakit[nama_penyakit] . '</td>';
        echo '<td>' . $r4[mb] . '</td>';
        echo '<td>' . $r4[md] . '</td>';
        echo '<td align=center>' . $cfpakar . '</td>';
        echo '<td><span>' . $arkondisitext[$kondisi] . "(". $arbobot[$kondisi] . ")" . "</span></td>";
      }}
      echo "</tbody></table>";
      echo "</div>";

      echo '<div class="panel-body">';
      echo '<ol>';
      foreach ($detailHitung as $hitung => $items) {
        echo '<li class="mt-4"> <strong>' . $hitung . '</strong></li>';
        echo '<ol>';
        $max = count($items);
        $n = 0;
        foreach ($items as $item) {
          if (++$n === $max) {
            echo "" . $item . " ";
          } else {
            echo '<li>CF '. $n .' = (MB - MD) * CF User = ( ' . $item[0] . ' - ' . $item[1] . ' ) x ' . $item[2] . ' = ' . $item[3] . '</li>';
          }
        }
        //echo "HASIL COBA ADALAH" . $items;
        foreach ($detailHitungCF[$hitung] as $hitungCF => $itemCF) {
          echo '<ul>';
          $k = 0;
          // var_dump($itemCF[0]);
          echo '<li>CF = CFlama + (CFbaru x (1 - CFlama)) = ' . $itemCF[0] . ' + ( ' . $itemCF[1] . '  x ( 1 -' . $itemCF[0] . ')) = ' . $itemCF[2] . ' </li>';
          echo '</ul>';
        }
        echo '</ol>';
        echo '<ul>maka hasil akhir CF adalah <strong>' . $itemCF[2] .'</strong></ul><br>';
      }
      echo '</ol>';
      echo '<h4>Jadi diagnosa penyakit yang dialami adalah ' . $nmpkt[1] . ' dengan nilai sebesar ' . ($vlpkt[1] * 100) . ' % (' . $vlpkt[1] . ')</h4>';
      echo '</div>';
   echo "</div></div></div>";
   //----------------------------------------------------------------------------
    } else {
      echo "
    <br>
		<form name=text_form method=POST action='diagnosa' >
    <table class='table table-bordered'>
    <tr><td>Nama Lengkap</td>   <td>  <input autocomplete='off' autofocus='on' placeholder='Masukkan nama lengkap...' type=text class='form-control' name='nama' size=30 onkeyup='this.value=this.value.toUpperCase()' required></td></tr>
    <tr><td>Jenis Kelinci</td><td>   
    <select class='form-control' name='jenis_kelinci' >
      <option>- Pilih Jenis Kelinci -</option>
      <option>Rex</option>
      <option>Lop</option>
      <option>New Zeland</option>
      <option>Flamish Giant</option>
      <option>Netherland Dwarf</option>
      <option>Anggora</option>
      <option>Himalaya</option>
      <option>Dutch</option>
      <option>Jersey Wooly</option>
      <option>Havana</option>
      <option>American Sable</option>
      <option>Polish</option>
      <option>Satin</option>
      <option>Chinchilia</option>
    </select></td></tr>
    </table>
    <table class='table table-bordered table-striped konsultasi'><tbody class='pilihkondisi'>
    <tr><th>No</th><th>Kode</th><th>Gejala</th><th width='20%'>Pilih Kondisi</th></tr>";
      $sql3 = mysql_query("SELECT * FROM tbl_gejala order by kd_gejala");
      $i = 0;
      while ($r3 = mysql_fetch_array($sql3)) {
        $i++;

        if ($r3[gambar_detail]) {
          $gambar = 'gambar/gejala/' . $r3[gambar_detail];
        } else {
          $gambar = 'gambar/noimage.png';
        }

        echo "<tr><td class=opsi>$i</td>";
        echo "<td class=opsi>G" . str_pad($r3[kd_gejala], 2, '0', STR_PAD_LEFT) . "</td>";
        echo "<td class=gejala>$r3[nama_gejala]  
        <a class='btn btn-default btn-xs' href='#' data-toggle='modal' data-target='#modal$r3[kd_gejala]'><i class='fa fa-eye' aria-hidden='true'></i></a></td>";
        //---------modal detail gejala---------------------
        echo "
        <div class='modal fade' id='modal$r3[kd_gejala]' role='dialog'>
        <div class='modal-dialog'>

          <div class='modal-content'>
            <div class='modal-header detail-ket'>
              <button type='button' class='close' data-dismiss='modal' style='opacity: .99;color: #fff;'>&times;</button>
              <h4 class='modal-title text text-ket'><i class='fa fa-external-link-square' aria-hidden='true'></i> Detail Gejala Untuk -$r3[nama_gejala]-</h4>
            </div>
            <div class='box-body' align='center'>
            <img id='preview' src='$gambar' width=200>
            </div>
            <div class='modal-body' style='text-align: justify;text-justify: inter-word;'>
              <p>$r3[detail_gejala]</p>
            </div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
          </div>

        </div>
      </div>
         ";
       //------------------end modal--------------------------

        echo '<td class="opsi"><select name="kondisi[]" id="sl' . $i . '" class="opsikondisi"/><option data-id="0" value="0">Pilih jika sesuai</option>';
        $s = "select * from tbl_kondisi order by id";
        $q = mysql_query($s) or die($s);
        while ($rw = mysql_fetch_array($q)) {
          ?>
          <option data-id="<?php echo $rw['id']; ?>" value="<?php echo $r3['kd_gejala'] . '_' . $rw['id']; ?>"><?php echo $rw['kondisi']; ?></option>
          <?php
        }
        echo '</select></td>';
        ?>
        <script type="text/javascript">
          $(document).ready(function () {
            var arcolor = new Array('#ffffff', '#cc66ff', '#019AFF', '#00CBFD', '#00FEFE', '#A4F804', '#fff947');
            setColor();
            $('.pilihkondisi').on('change', 'tr td select#sl<?php echo $i; ?>', function () {
              setColor();
            });
            function setColor()
            {
              var selectedItem = $('tr td select#sl<?php echo $i; ?> :selected');
              var color = arcolor[selectedItem.data("id")];
              $('tr td select#sl<?php echo $i; ?>.opsikondisi').css('background-color', color);
              console.log(color);
            }
          });
        </script>
        <?php
        echo "</tr>";
      }
      echo "
		  <input class='float' type=submit data-toggle='tooltip' data-placement='top' title='Klik disini untuk mendiagnosa' name=submit value='&#xf00e;' style='font-family:Arial, FontAwesome'>
          </tbody></table></form>";
    }
    break;
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