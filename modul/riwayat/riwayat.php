<title>Riwayat - SisDagCi</title>

<style type="text/css">
		form{
			width:500px;
            margin:auto auto;
		}
		.search {
            padding:8px 35px;
            width: 430px;
            height: 40px;
			background:rgba(50, 50, 50, 0.2);
            border:0px;
            border-radius: 40px;
        }
        .input-icon{
            position: relative;
        }

        form input+i{
            position: absolute; left: 14px; top:13px;
        }
        
        
	</style>
<br> 
<?php
include "config/fungsi_alert.php";
$aksi = "modul/riwayat/aksi_hasil.php";
switch ($_GET[act]) {
// Tampil hasil
    default:
        $offset = $_GET['offset'];
//jumlah data yang ditampilkan perpage
        $limit = 15;
        if (empty($offset)) {
            $offset = 0;
        }

        $sqlgjl = mysql_query("SELECT * FROM tbl_gejala order by kd_gejala+0");
        while ($rgjl = mysql_fetch_array($sqlgjl)) {
            $argjl[$rgjl['kd_gejala']] = $rgjl['nama_gejala'];
        }

        $sqlpkt = mysql_query("SELECT * FROM tbl_penyakit order by kd_penyakit+0");
        while ($rpkt = mysql_fetch_array($sqlpkt)) {
            $arpkt[$rpkt['kd_penyakit']] = $rpkt['nama_penyakit'];
            $ardpkt[$rpkt['kd_penyakit']] = $rpkt['detail_penyakit'];
            $arspkt[$rpkt['kd_penyakit']] = $rpkt['solusi_penyakit'];
        }

        $tampil=mysql_query("SELECT * FROM tbl_admin ORDER BY username");
    echo "
    <div class='has-feedback mt-3 mb-5' style='margin-top: 14px;'>
    <form>
    <div class='input-icon'>
    <input type='text' id='search'  class='form-control input-sm search' placeholder='Search here...'>
    <i class='fa fa-search'></i>
    </div>
    <form>
    </div>
    
    <!--<form>
    <input class='search' id='search' type='text' placeholder='Search here...'>
    <input class='button' type='button' value='Cari'>		
    </form>-->            
    <br>";

        $tampil = mysql_query("SELECT * FROM tbl_hasil ORDER BY kd_hasil");
        $baris = mysql_num_rows($tampil);
        if ($baris > 0) {
            echo"<div class='row'><div class='col-md-12' >
            <table class='table table-hover table-striped riwayat'>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Jenis Kelinci</th>
              <th>Tanggal</th>
              <th>Penyakit</th>
              <th nowrap>Nilai CF</th>
              <th nowrap>(%)</th>
              <th width='7%' class='text-center'>Aksi</th>
            </tr>
          </thead>
		  <tbody id='tampil'>
		  ";
            $hasil = mysql_query("SELECT * FROM tbl_hasil ORDER BY kd_hasil limit $offset,$limit");
            $no = 1;
            $no = 1 + $offset;
            $counter = 1;
            while ($r = mysql_fetch_array($hasil)) {
              if ($r[hasil_id]>0){
                if ($counter % 2 == 0)
                    $warna = "dark";
                else
                    $warna = "light";
                echo "<tr class='" . $warna . "'>
			 <td align=center>$no</td>
             <td>$r[nama]</td>
             <td>$r[jenis_kelinci]</td>
			 <td>$r[tanggal]</td>
			 <td>" . $arpkt[$r[hasil_id]] . "</td>
			 <td><span class='label label-danger'>" . $r[hasil_nilai] . "</span></td>
       <td><span class='label label-danger'>" . $r[hasil_nilai] * 100 . " %</span></td>
			 <td align=center>
			 <a type='button' class='btn btn-warning btn-xs' target='_blank' href=riwayat-detail/$r[kd_hasil]><i class='fa fa-eye' aria-hidden='true'></i> Detail </a> &nbsp;
	         </td></tr>";
                $no++;
                $counter++;
            }
            }
            echo "</tbody></table></div>";
            ?>

            <?php
            echo "</div><div class='col-md-12'><div class='row'><div class=paging>";

            if ($offset != 0) {
                $prevoffset = $offset - $limit;
                echo "<span class=prevnext> <a href=index.php?module=riwayat&offset=$prevoffset>Back</a></span>";
            } else {
                echo "<span class=disabled>Back</span>"; //cetak halaman tanpa link
            }
//hitung jumlah halaman
            $halaman = intval($baris / $limit); //Pembulatan

            if ($baris % $limit) {
                $halaman++;
            }
            for ($i = 1; $i <= $halaman; $i++) {
                $newoffset = $limit * ($i - 1);
                if ($offset != $newoffset) {
                    echo "<a href=index.php?module=riwayat&offset=$newoffset>$i</a>";
//cetak halaman
                } else {
                    echo "<span class=current>" . $i . "</span>"; //cetak halaman tanpa link
                }
            }

//cek halaman akhir
            if (!(($offset / $limit) + 1 == $halaman) && $halaman != 1) {

//jika bukan halaman terakhir maka berikan next
                $newoffset = $offset + $limit;
                echo "<span class=prevnext><a href=index.php?module=riwayat&offset=$newoffset>Next</a>";
            } else {
                echo "<span class=disabled>Next</span>"; //cetak halaman tanpa link
            }

            echo "</div></div></div>";
        } else {
            echo "<br><b>Data Kosong !</b>";
        }
}
?>

<script type="text/javascript">
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                $.ajax({
                    type: 'POST',
                    url: 'modul/riwayat/search.php',
                    data: {
                        search: $(this).val()
                    },
                    cache: false,
                    success: function(data) {
                        $('#tampil').html(data);
                    }
                });
            });
        });
    </script>




