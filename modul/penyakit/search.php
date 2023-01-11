<?php
    if (isset($_POST['search'])) {
        include "../../config/koneksi.php";
        $aksi = "modul/penyakit/aksi_penyakit.php";
        $search = $_POST['search'];

    $hasil = mysql_query("SELECT * FROM tbl_penyakit where nama_penyakit like '%" . $search . "%'");
    $no = 1;
    $counter = 1;
          while ($r = mysql_fetch_array($hasil)) {
            if ($counter % 2 == 0)
              $warna = "dark";
            else
              $warna = "light";
            echo "<tr class='" . $warna . "'>
             <td align=center>$no</td>
             <td>$r[nama_penyakit]</td>
             <td>$r[detail_penyakit]</td>
             <td>$r[solusi_penyakit]</td>
             <td align=center>
             <a type='button' class='btn btn-block btn-warning' href=penyakit/editpenyakit/$r[kd_penyakit]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;
              <a type='button' class='btn btn-block btn-danger' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=penyakit&act=hapus&id=$r[kd_penyakit]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\">
              <i class='fa fa-trash-o' aria-hidden='true'></i> Hapus</a>
             </td></tr>";
            $no++;
            $counter++;
          }
} ?>