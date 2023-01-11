<?php
    if (isset($_POST['search'])) {
        include "../../config/koneksi.php";
        $aksi = "modul/riwayat/aksi_hasil.php";
        $search = $_POST['search'];

        $sqlpkt = mysql_query("SELECT * FROM tbl_penyakit order by kd_penyakit+0");
        while ($rpkt = mysql_fetch_array($sqlpkt)) {
            $arpkt[$rpkt['kd_penyakit']] = $rpkt['nama_penyakit'];
            $ardpkt[$rpkt['kd_penyakit']] = $rpkt['detail_penyakit'];
            $arspkt[$rpkt['kd_penyakit']] = $rpkt['solusi_penyakit'];
        }
        

    $hasil = mysql_query("SELECT * FROM tbl_hasil where nama like '%" . $search . "%'");
    $no = 1;
            
            $counter = 1;
            while ($r = mysql_fetch_array($hasil)) {
              if ($r['hasil_id']>0){
                if ($counter % 2 == 0)
                    $warna = "dark";
                else
                    $warna = "light";
                echo "<tr class='" . $warna . "'>
			 <td align=center>$no</td>
             <td>$r[nama]</td>
             <td>$r[jenis_kelinci]</td>
			 <td>$r[tanggal]</td>
			 <td>" . $arpkt[$r['hasil_id']] . "</td>
			 <td><span class='label label-danger'>" . $r['hasil_nilai'] . "</span></td>
       <td><span class='label label-danger'>" . $r['hasil_nilai'] * 100 . " %</span></td>
			 <td align=center>
			 <a type='button' class='btn btn-warning btn-xs' target='_blank' href=riwayat-detail/$r[kd_hasil]><i class='fa fa-eye' aria-hidden='true'></i> Detail </a> &nbsp;
	         </td></tr>";
                $no++;
                $counter++;
            }
        }
    echo "</tbody></table>";
} ?>