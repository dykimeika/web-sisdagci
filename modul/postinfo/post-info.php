<title>Info - SisDagCI</title>

<script type="text/javascript">
    function Blank_TextField_Validator()
    {
      if (text_form.nama_info.value == "")
      {
        alert("Nama Informasi tidak boleh kosong !");
        text_form.nama_info.focus();
        return (false);
      }
      return (true);
    }
    function Blank_TextField_Validator_Cari()
    {
      if (text_form.keyword.value == "")
      {
        alert("Isi dulu keyword pencarian !");
        text_form.keyword.focus();
        return (false);
      }
      return (true);
    }
    -- ></script>
<?php
include "config/fungsi_alert.php";
$aksi = "modul/postinfo/aksi_info.php";
switch ($_GET[act]) {
    // Tampil informasi
    default:
        $offset = $_GET['offset'];
        //jumlah data yang ditampilkan perpage
        $limit = 15;
        if (empty($offset)) {
            $offset = 0;
        }
        $tampil = mysql_query("SELECT * FROM tbl_info ORDER BY kd_info");
        echo "<form method=POST action='?module=postinfo' name=text_form onsubmit='return Blank_TextField_Validator_Cari()'>
        <br><table class='table'>
      <tr><td style='width:15px;'><a class='btn bg-olive margin' type=button name=tambah value='Tambah info' onclick=\"window.location.href='postinfo/tambahinfo';\"><i class='fa fa-plus' aria-hidden='true'></i> Tambah Post Info</a></td><td align='right'>
      <!--<div class='input-group col-md-3' style='margin-top: 10px;'><input type='text' name='keyword' placeholder='Cari disini ...'' class='form-control' value='$_POST[keyword]'/> <span class='input-group-btn'><button type='submit' class='btn btn-success btn-flat' value='Cari' name=Go>Cari</button></span></div>-->

      <div class='has-feedback mt-3 mb-5' style='margin-top: 13px;'>
               <input type='text' id='search'  class='form-control input-sm' placeholder='Search here...'>
               <span class='fa fa-search form-control-feedback'></span>
      </div>
      </td> </tr>
          </table></form>";
        $baris = mysql_num_rows($tampil);
        if ($_POST[Go]) {
            $numrows = mysql_num_rows(mysql_query("SELECT * FROM tbl_info where nama_info like '%$_POST[keyword]%'"));
            if ($numrows > 0) {
                echo "<div class='alert alert-success alert-dismissible'>
                <h4><i class='icon fa fa-check'></i> Sukses!</h4>
                Informasi yang anda cari di temukan.
              </div>";
                $i = 1;
                echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Informasi</th>
        <th>Detail Informasi</th>
        <th>Saran Informasi</th>
              <th>Aksi</th>
            </tr>
          </thead>
      <tbody>";
                $hasil = mysql_query("SELECT * FROM tbl_info where nama_info like '%$_POST[keyword]%'");
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
            }
            else {
                echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-ban'></i> Gagal!</h4>
                Maaf, Informasi yang anda cari tidak ditemukan , silahkan inputkan dengan benar dan cari kembali.
              </div>";
            }
        } else {

            if ($baris > 0) {
                echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Informasi</th>
        <th>Detail Informasi</th>
        <th>Solusi Informasi</th>
              <th>Aksi</th>
            </tr>
          </thead>
      <tbody id='tampil'>
      ";
                $hasil = mysql_query("SELECT * FROM tbl_info ORDER BY kd_info limit $offset,$limit");
                $no = 1;
                $no = 1 + $offset;
                $counter = 1;
                while ($r = mysql_fetch_array($hasil)) {
                    if ($counter % 2 == 0)
                        $warna = "dark";
          if (strlen($r[detail_info]) > 150)
          {
            $maxLength = 140;
            $r[detail_info] = substr($r[detail_info], 0, $maxLength);
            }
            if (strlen($r[solusi_info]) > 150)
          {
            $maxLength = 140;
            $r[solusi_info] = substr($r[solusi_info], 0, $maxLength);
            }
                    else
                        $warna = "light";
                    echo "<tr class='" . $warna . "'>
       <td align=center>$no</td>
       <td>$r[nama_info]</td>
       <td>$r[detail_info]</td>
       <td>$r[solusi_info]</td>
       <td align=center>
       <a type='button' class='btn btn-warning margin' href=postinfo/editinfo/$r[kd_info]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;
            <a type='button' class='btn btn-danger margin' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=postinfo&act=hapus&id=$r[kd_info]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\">
        <i class='fa fa-trash-o' aria-hidden='true'></i> Hapus</a>
             </td></tr>";
                    $no++;
                    $counter++;
                }
                echo "</tbody></table>";
                echo "<div class=paging>";

                if ($offset != 0) {
                    $prevoffset = $offset - 10;
                    echo "<span class=prevnext> <a href=index.php?module=info&offset=$prevoffset>Back</a></span>";
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
                        echo "<a href=index.php?module=info&offset=$newoffset>$i</a>";
                        //cetak halaman
                    } else {
                        echo "<span class=current>" . $i . "</span>"; //cetak halaman tanpa link
                    }
                }

                //cek halaman akhir
                if (!(($offset / $limit) + 1 == $halaman) && $halaman != 1) {

                    //jika bukan halaman terakhir maka berikan next
                    $newoffset = $offset + $limit;
                    echo "<span class=prevnext><a href=index.php?module=info&offset=$newoffset>Next</a>";
                } else {
                    echo "<span class=disabled>Next</span>"; //cetak halaman tanpa link
                }

                echo "</div>";
            } else {
                echo "<br><b>Data Kosong !</b>";
            }
        }
        break;

    case "tambahinfo":
        echo "<br>
        <div class='col-md-12'>
            <div class='box box-success box-solid'>
              <div class='box-header with-border'>
                <h3 class='box-title'>Tambah Informasi</h3>  
                </div><!-- /.box-header -->
                <div class='box-body'>
                <form name=text_form method=POST action='$aksi?module=postinfo&act=input' onsubmit='return Blank_TextField_Validator()' enctype='multipart/form-data'>
                <table class='table table-bordered'>
                <tr><td width=120>Nama Informasi</td><td><input autocomplete='off' type=text placeholder='Masukkan informasi baru...' class='form-control' name='nama_info' size=30></td></tr>
                <tr><td width=120>Detail Informasi</td><td> <textarea id='editor1' rows='4' cols='50' class='form-control' name='detail_info'type=text placeholder='Masukkan detail informasi baru...'></textarea></td></tr>
                <tr><td width=120>Solusi Informasi</td><td><textarea id='editor2' rows='4' cols='50' class='form-control' name='solusi_info'type=text placeholder='Masukkan saran informasi baru...'></textarea></td></tr>
                <tr><td width=120>Gambar Informasi</td><td>Upload Gambar (Ukuran Maks = 1 MB) : <input type='file' class='form-control' name='gambar_info' required /></td></tr>
                <tr><td></td><td><input class='btn btn-success' type=submit name=submit value='Simpan' >
                <input class='btn btn-danger' type=button name=batal value='Batal' onclick=\"window.location.href='?module=postinfo';\"></td></tr>
                </table></form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

        ";
        break;

    case "editinfo":
        $edit = mysql_query("SELECT * FROM tbl_info WHERE kd_info='$_GET[id]'");
        $r = mysql_fetch_array($edit);
        if ($r[gambar_info]) {
            $gambar = 'gambar/post/' . $r[gambar_info];
        } else {
            $gambar = 'gambar/noimage.png';
        }

        echo "<br>
         <div class='col-md-8'>
              <div class='box box-warning box-solid'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Informasi</h3>
                  </div><!-- /.box-header -->
                  <div class='box-body'>
                  <form name=text_form method=POST action='$aksi?module=postinfo&act=update' onsubmit='return Blank_TextField_Validator()' enctype='multipart/form-data'>
                  <input type=hidden name=id value='$r[kd_info]'>
                  <table class='table table-bordered'>
                  <tr><td width=120>Nama Informasi</td><td><input autocomplete='off' type=text class='form-control' name='nama_info' size=30 value=\"$r[nama_info]\"></td></tr>
                  <tr><td width=120>Detail Informasi</td><td><textarea id='editor1' rows='4' cols='50' type=text class='form-control' name='detail_info'>$r[detail_info]</textarea></td></tr>
                  <tr><td width=120>Solusi Informasi</td><td><textarea id='editor2' rows='4' cols='50' type=text class='form-control' name='solusi_info'>$r[solusi_info]</textarea></td></tr>
                  <tr><td width=120>Gambar Informasi</td><td>Upload Gambar (Ukuran Maks = 1 MB) : <input id='upload' type='file' class='form-control' name='gambar_info' required /></td></tr>
                  
                  <tr><td></td><td><input class='btn btn-success' type=submit name=submit value='Simpan' >
                  <input class='btn btn-danger' type=button name=batal value='Batal' onclick=\"window.location.href='?module=postinfo';\"></td></tr>
                  </table></form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

            <div class='col-md-4 pull-right'>
              <div class='box box-warning box-solid'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Preview Gambar Informasi</h3>
                  </div><!-- /.box-header -->
                  <div class='box-body' align='center'>
                    <img id='preview' src='$gambar' width=200>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
        ";
        break;
}
?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                $.ajax({
                    type: 'POST',
                    url: 'modul/postinfo/search.php',
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


<script>
    function readURL(input) {

      if (input.files &&
              input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#upload").change(function () {
      readURL(this);
    });

    $(function () {
      CKEDITOR.replace('editor1');
      CKEDITOR.replace('editor2');
      CKEDITOR.replace('editor1a');
      CKEDITOR.replace('editor2a');
    })
</script>

