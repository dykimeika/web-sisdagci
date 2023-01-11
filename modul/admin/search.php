<?php
    if (isset($_POST['search'])) {
        include "../../config/koneksi.php";
        $aksi="modul/admin/aksi_admin.php";
        $search = $_POST['search'];

    $hasil = mysql_query("SELECT * FROM tbl_admin where username like '%" . $search . "%'");
    $no = 1;
    $counter = 1;
    while ($r=mysql_fetch_array($hasil)){
    if ($counter % 2 == 0) $warna = "light";
    else $warna = "dark";
       echo "<tr class='".$warna."'>
             <td align='center' width='50px'>$no</td>
             <td align='center' width='100px' ><img src='gambar/admin/$r[gambar_admin]' width=50></td>
             <td>$r[username]</td>
             <td>$r[nama_lengkap]</td>
             <td align=center>
             <a type='button' class='btn btn-warning margin' href=admin/editadmin/$r[username]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;
              <a type='button' class='btn btn-danger margin' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=admin&act=hapus&id=$r[username]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><i class='fa fa-trash-o' aria-hidden='true'></i> Hapus</a>
             </td></tr>";
      $no++;
      $counter++;
    }
    echo "</tbody></table>";
} ?>