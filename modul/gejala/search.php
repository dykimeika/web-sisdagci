<?php
    if (isset($_POST['search'])) {
        include "../../config/koneksi.php";
        $aksi="modul/gejala/aksi_gejala.php";
        $search = $_POST['search'];

    $hasil = mysql_query("SELECT * FROM tbl_gejala where nama_gejala like '%" . $search . "%'");
    $no = 1;
    $counter = 1;
    while ($r=mysql_fetch_array($hasil)){
    if ($counter % 2 == 0) $warna = "dark";
    else $warna = "light";
       echo "<tr class='".$warna."'>
             <td align=center>$no</td>
             <td>$r[nama_gejala]</td>
             <td>$r[detail_gejala]</td>
             <td align=center>
             <a type='button' class='btn btn-warning margin' href=gejala/editgejala/$r[kd_gejala]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;
              <a type='button' class='btn btn-danger margin' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=gejala&act=hapus&id=$r[kd_gejala]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><i class='fa fa-trash-o' aria-hidden='true'></i> Hapus</a>
             </td></tr>";
      $no++;
      $counter++;
    }
    echo "</tbody></table>";
} ?>