<?php
    if (isset($_POST['search'])) {
        include "../../config/koneksi.php";
        $aksi="modul/postinfo/aksi_info.php";
        $search = $_POST['search'];

    $hasil = mysql_query("SELECT * FROM tbl_info where nama_info like '%" . $search . "%'");
    $no = 1;
    $counter = 1;
    while ($r = mysql_fetch_array($hasil)) {
    if ($counter % 2 == 0)
    $warna = "dark";
    else
    $warna = "light";
    echo "<tr class='" . $warna . "'>
    <td align=center>$no</td>
    <td>$r[nama_info]</td>
    <td>$r[detail_info]</td>
    <td>$r[solusi_info]</td>
    <td align=center><a type='button' class='btn btn-warning margin' href=postinfo/editinfo/$r[kd_info]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;
            <a type='button' class='btn btn-danger margin' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=postinfo&act=hapus&id=$r[kd_info]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"> <i class='fa fa-trash-o' aria-hidden='true'></i> Hapus</a>
    </td></tr>";
    $no++;
    $counter++;
    }
    echo "</tbody></table>";
} ?>