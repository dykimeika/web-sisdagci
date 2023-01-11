<?php
    if (isset($_POST['search'])) {
        include "../../config/koneksi.php";
        $aksi="modul/pengetahuan/aksi_pengetahuan.php";
        $search = $_POST['search'];

    $hasil = mysql_query("SELECT * FROM tbl_basispengetahuan b,tbl_penyakit p where b.kd_penyakit=p.kd_penyakit AND p.nama_penyakit like '%" . $search . "%'");
   $no = 1;
    $counter = 1;
    while ($r=mysql_fetch_array($hasil)){
    if ($counter % 2 == 0) $warna = "dark";
    else $warna = "light";
    $sql = mysql_query("SELECT * FROM tbl_gejala where kd_gejala = '$r[kd_gejala]'");
    $rgejala=mysql_fetch_array($sql);
    $cfpakar = $r['mb'] - $r['md'];
       echo "<tr class='".$warna."'>
             <td align=center>$no</td>
             <td>$r[nama_penyakit]</td>
             <td>$rgejala[nama_gejala]</td>
             <td align=center>$r[mb]</td>
             <td align=center>$r[md]</td>
             <td align=center>$cfpakar</td>
             <td align=center><a type='button' class='btn btn-warning margin' href=pengetahuan/editpengetahuan/$r[kd_pengetahuan]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;
              <a type='button' class='btn btn-danger margin' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=pengetahuan&act=hapus&id=$r[kd_pengetahuan]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><i class='fa fa-trash-o' aria-hidden='true'></i> Hapus</a>
             </td></tr>";
      $no++;
      $counter++;
    }
    echo "</tbody></table>";
} ?>