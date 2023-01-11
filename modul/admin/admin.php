<title>Admin - SisDagCI</title>
<?php
session_start();
if (!(isset($_SESSION['username']) && isset($_SESSION['password']))) {
    header('location:index.php');
    exit();
} else {
    ?>
<script Language="JavaScript">
<!-- 
function Blank_TextField_Validator()
{
if (text_form.username.value == "")
{
   alert("Username tidak boleh kosong !");
   text_form.username.focus();
   return (false);
}
if (text_form.password.value == "")
{
   alert("Password tidak boleh kosong !");
   text_form.password.focus();
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
-->
</script>
<?php
include "config/fungsi_alert.php";
$aksi="modul/admin/aksi_admin.php";
switch($_GET[act]){
	// Tampil admin
  default:
  $offset=$_GET['offset'];
	//jumlah data yang ditampilkan perpage
	$limit = 10;
	if (empty ($offset)) {
		$offset = 0;
	}
  $tampil=mysql_query("SELECT * FROM tbl_admin ORDER BY username");
	echo "<form method=POST action='?module=admin' name=text_form onsubmit='return Blank_TextField_Validator_Cari()'>
          <br><table class='table'>
		  <tr><td style='width:15px;'><a class='btn bg-olive margin' type=button name=tambah value='Tambah Admin' onclick=\"window.location.href='admin/tambahadmin';\"><i class='fa fa-plus' aria-hidden='true'></i> Tambah Admin</a></td><td align='right'>
		  <div class='has-feedback mt-3 mb-5' style='margin-top: 14px;'>
               <input type='text' id='search'  class='form-control input-sm' placeholder='Search here...'>
               <span class='fa fa-search form-control-feedback'></span>
          </div>
		  </div></td>
		  </tr>
          </table></form>";

	$baris=mysql_num_rows($tampil);	
	if($baris>0){
	echo" <table class='table table-bordered table-hover' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Gambar</th>
              <th>Username</th>
              <th>Nama Lengkap</th>
              <th width='21%'>Aksi</th>
            </tr>
          </thead>
		  <tbody id='tampil'>"; 
	$hasil = mysql_query("SELECT * FROM tbl_admin ORDER BY username limit $offset,$limit");
	$no = 1;
	$no = 1 + $offset;
	$counter = 1;
    while ($r=mysql_fetch_array($hasil)){
	if ($counter % 2 == 0) $warna = "dark";
	else $warna = "light";
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
	echo "<div class=paging>";

	if ($offset!=0) {
		$prevoffset = $offset-10;
		echo "<span class=prevnext> <a href=index.php?module=admin&offset=$prevoffset>Back</a></span>";
	}
	else {
		echo "<span class=disabled>Back</span>";//cetak halaman tanpa link
	}
	//hitung jumlah halaman
	$halaman = intval($baris/$limit);//Pembulatan

	if ($baris%$limit){
		$halaman++;
	}
	for($i=1;$i<=$halaman;$i++){
		$newoffset = $limit * ($i-1);
		if($offset!=$newoffset){
			echo "<a href=index.php?module=admin&offset=$newoffset>$i</a>";
			//cetak halaman
		}
		else {
			echo "<span class=current>".$i."</span>";//cetak halaman tanpa link
		}
	}

	//cek halaman akhir
	if(!(($offset/$limit)+1==$halaman) && $halaman !=1){

		//jika bukan halaman terakhir maka berikan next
		$newoffset = $offset + $limit;
		echo "<span class=prevnext><a href=index.php?module=admin&offset=$newoffset>Next</a>";
	}
	else {
		echo "<span class=disabled>Next</span>";//cetak halaman tanpa link
	}
	
	echo "</div>";
	}else{
	echo "<br><b>Data Kosong !</b>";
	}
    break;
  
  case "tambahadmin":
	echo "<br>
            <div class='col-md-8'>
              <div class='box box-success box-solid'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Admin</h3>  
                </div><!-- /.box-header -->
                <div class='box-body'>
                <form name=text_form method=POST action='$aksi?module=admin&act=input' onsubmit='return Blank_TextField_Validator()' enctype='multipart/form-data'>
                <table class='table table-bordered'>
                <tr><td>Nama Lengkap</td>   <td>  <input autocomplete='off' placeholder='Masukkan nama lengkap...' type=text class='form-control' name='nama_lengkap' size=30></td></tr>
                <tr><td>Username</td>   <td>  <input autocomplete='off' placeholder='Masukkan username...' type=text class='form-control' name='username' size=30></td></tr>
                <tr><td>Password</td>   <td> <input autocomplete='off' placeholder='Masukkan password admin...' type=password class='form-control' name='password' size=30></td></tr>
                <tr><td width=120>Gambar Post</td><td>Upload Gambar (Ukuran Maks = 1 MB) : <input type='file' class='form-control' name='gambar_admin' required /></td></tr>      
                <tr><td></td><td>
                <input class='btn btn-success' type=submit name=submit value='Simpan' >
                <input class='btn btn-danger' type=button name=batal value='Batal' onclick=\"window.location.href='?module=admin';\">
                </td></tr>
                </table></form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col --> ";
     break;
    
  case "editadmin":
    $edit=mysql_query("SELECT * FROM tbl_admin WHERE username='$_GET[id]'");
    $r=mysql_fetch_array($edit);
      if ($r[gambar_admin]) {
        $gambar = 'gambar/admin/' . $r[gambar_admin];
      } else {
        $gambar = 'gambar/noimage.png';
      }
	
    echo "<br>
          <div class='col-md-8'>
              <div class='box box-warning box-solid'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Admin</h3>
                  </div><!-- /.box-header -->
                  <div class='box-body'>
                    <form name=text_form method=POST action='$aksi?module=admin&act=update' onsubmit='return Blank_TextField_Validator()' enctype='multipart/form-data'>
                    <input type=hidden name=id value='$r[username]'>
                    <table class='table table-bordered'>
                    <tr><td>Username</td> <td>  <input autocomplete='off' type=text class='form-control' name='username' value=\"$r[username]\" size=30></td></tr>
                    <tr><td>Nama Lengkap</td> <td>  <input autocomplete='off' type=text class='form-control' name='nama_lengkap' value=\"$r[nama_lengkap]\" size=30></td></tr>
                    <tr><td width=120>Gambar Post</td><td>Upload Gambar (Ukuran Maks = 1 MB) : <input id='upload' type='file' class='form-control' name='gambar_admin' required /></td></tr>
      
                    <tr><td></td><td>
                    <input class='btn btn-success' type=submit name=submit value='Simpan' >
                    <input class='btn btn-danger' type=button name=batal value='Batal' onclick=\"window.location.href='?module=admin';\"></td></tr>
                    </table></form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

            <div class='col-md-4 pull-right'>
              <div class='box box-warning box-solid'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Preview Gambar Admin</h3>
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

<?php 
} ?>

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
  </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                $.ajax({
                    type: 'POST',
                    url: 'modul/admin/search.php',
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