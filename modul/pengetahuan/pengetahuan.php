<title>Pengetahuan - SisDagCI</title>
<?php

session_start();
if (!(isset($_SESSION['username']) && isset($_SESSION['password']))) {
    header('location:index.php');
    exit();
} else {
    ?>
<script type="text/javascript">
function Blank_TextField_Validator()
{
if (text_form.kd_penyakit.value == "")
{
   alert("Pilih dulu penyakit !");
   text_form.kd_penyakit.focus();
   return (false);
}
if (text_form.kd_gejala.value == "")
{
   alert("Pilih dulu gejala !");
   text_form.kd_gejala.focus();
   return (false);
}
if (text_form.mb.value == "")
{
   alert("Isi dulu MB !");
   text_form.mb.focus();
   return (false);
}
if (text_form.md.value == "")
{
   alert("Isi dulu MD !");
   text_form.md.focus();
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
$aksi="modul/pengetahuan/aksi_pengetahuan.php";
switch($_GET[act]){
	// Tampil pengetahuan
  default:
  $offset=$_GET['offset'];
	//jumlah data yang ditampilkan perpage
	$limit = 15;
	if (empty ($offset)) {
		$offset = 0;
	}
  $tampil=mysql_query("SELECT * FROM tbl_basispengetahuan ORDER BY kd_pengetahuan");
	echo "<form method=POST action='?module=pengetahuan' name=text_form onsubmit='return Blank_TextField_Validator_Cari()'>
          <br><table class='table'>
		  <tr><td style='width:15px;'><a class='btn bg-olive margin' type=button name=tambah value='Tambah Basis Pengetahuan' onclick=\"window.location.href='pengetahuan/tambahpengetahuan';\"><i class='fa fa-plus' aria-hidden='true'></i> Tambah Pengetahuan</a></td><td align='right'>
		  <!--<div class='input-group col-md-3' style='margin-top: 10px;'><input type='text' name='keyword' placeholder='Cari disini ...'' class='form-control' value='$_POST[keyword]'/> <span class='input-group-btn'><button type='submit' class='btn btn-success btn-flat' value='Cari' name=Go>Cari</button></span></div>-->

		  <div class='has-feedback mt-3 mb-5' style='margin-top: 13px;'>
               <input type='text' id='search'  class='form-control input-sm' placeholder='Search here...'>
               <span class='fa fa-search form-control-feedback'></span>
          </div>
		  </td> </tr>
          </table></form>";
		  	$baris=mysql_num_rows($tampil);
	if ($_POST[Go]){
			$numrows = mysql_num_rows(mysql_query("SELECT * FROM tbl_basispengetahuan b,tbl_penyakit p where b.kd_penyakit=p.kd_penyakit AND p.nama_penyakit like '%$_POST[keyword]%'"));
			if ($numrows > 0){
				echo "<div class='alert alert-success alert-dismissible'>
                <h4><i class='icon fa fa-check'></i> Sukses!</h4>
                Pengetahuan yang anda cari di temukan.
              </div>";
				$i = 1;
	echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Penyakit</th>
              <th>Gejala</th>
              <th>MB</th>
              <th>MD</th>
              <th>CF Pakar</th>
              <th width='21%'>Aksi</th>
            </tr>
          </thead>
		  <tbody>"; 
	$hasil = mysql_query("SELECT * FROM tbl_basispengetahuan b,tbl_penyakit p where b.kd_penyakit=p.kd_penyakit AND p.nama_penyakit like '%$_POST[keyword]%'");
	$no = 1;
	$counter = 1;
    while ($r=mysql_fetch_array($hasil)){
	if ($counter % 2 == 0) $warna = "dark";
	else $warna = "light";
	$sql = mysql_query("SELECT * FROM tbl_gejala where kd_gejala = '$r[kd_gejala]'");
	$rgejala=mysql_fetch_array($sql);
	$cfpakar = $r[mb] - $r[md];
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
			}
			else{
				echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-ban'></i> Gagal!</h4>
                Maaf, Pengetahuan yang anda cari tidak ditemukan , silahkan inputkan dengan benar dan cari kembali.
              </div>";
			}
		}else{
	
	if($baris>0){
	echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Penyakit</th>
              <th>Gejala</th>
              <th>MB</th>
              <th>MD</th>
              <th>CF Pakar</th>
              <th width='21%'>Aksi</th>
            </tr>
          </thead>
		  <tbody id='tampil'>
		  "; 
	$hasil = mysql_query("SELECT * FROM tbl_basispengetahuan ORDER BY kd_pengetahuan limit $offset,$limit");
	$no = 1;
	$no = 1 + $offset;
	$counter = 1;
    while ($r=mysql_fetch_array($hasil)){
	if ($counter % 2 == 0) $warna = "dark";
	else $warna = "light";
	$sql = mysql_query("SELECT * FROM tbl_gejala where kd_gejala = '$r[kd_gejala]'");
	$rgejala=mysql_fetch_array($sql);
	$sql2 = mysql_query("SELECT * FROM tbl_penyakit where kd_penyakit = '$r[kd_penyakit]'");
	$rpenyakit=mysql_fetch_array($sql2);
	$cfpakar = $r[mb] - $r[md];
       echo "<tr class='".$warna."'>
			 <td align=center>$no</td>
			 <td>$rpenyakit[nama_penyakit]</td>
			 <td>$rgejala[nama_gejala]</td>
			 <td align=center>$r[mb]</td>
			 <td align=center>$r[md]</td>
			 <td align=center>$cfpakar</td>
			 <td align=center>
			 <a type='button' class='btn btn-warning margin' href=pengetahuan/editpengetahuan/$r[kd_pengetahuan]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;
	          <a type='button' class='btn btn-danger margin' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=pengetahuan&act=hapus&id=$r[kd_pengetahuan]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\">
			  <i class='fa fa-trash-o' aria-hidden='true'></i> Hapus</a>
             </td></tr>";
      $no++;
	  $counter++;
    }
    echo "</tbody></table>";
	echo "<div class=paging>";

	if ($offset!=0) {
		$prevoffset = $offset-10;
		echo "<span class=prevnext> <a href=index.php?module=pengetahuan&offset=$prevoffset>Back</a></span>";
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
			echo "<a href=index.php?module=pengetahuan&offset=$newoffset>$i</a>";
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
		echo "<span class=prevnext><a href=index.php?module=pengetahuan&offset=$newoffset>Next</a>";
	}
	else {
		echo "<span class=disabled>Next</span>";//cetak halaman tanpa link
	}
	
	echo "</div>";
	}else{
	echo "<br><b>Data Kosong !</b>";
	}
	}
    break;
  
  case "tambahpengetahuan":
	echo "	<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                <h4><i class='icon fa fa-exclamation-triangle'></i>Petunjuk Pengisian Pakar !</h4>
                Silahkan pilih gejala yang sesuai dengan penyakit yang ada, dan berikan <b>nilai kepastian (MB & MB)</b> dengan cakupan sebagai berikut:<br><br>
				<b>1.0</b> (Pasti Ya)&nbsp;&nbsp;|&nbsp;&nbsp;<b>0.8</b> (Hampir Pasti)&nbsp;&nbsp;|<br>
				<b>0.6</b> (Kemungkinan Besar)&nbsp;&nbsp;|&nbsp;&nbsp;<b>0.4</b> (Mungkin)&nbsp;&nbsp;|<br>
				<b>0.2</b> (Hampir Mungkin)&nbsp;&nbsp;|&nbsp;&nbsp;<b>0.0</b> (Tidak Tahu atau Tidak Yakin)&nbsp;&nbsp;|<br><br>
				<b>CF(Pakar) = MB – MD</b><br>
				MB : Ukuran kenaikan kepercayaan (measure of increased belief) MD : Ukuran kenaikan ketidakpercayaan (measure of increased disbelief) <br> <br>
				<b>Contoh:</b><br>
				Jika kepercayaan <b>(MB)</b> anda terhadap gejala Anorexia untuk penyakit Gastrointestinal Hipomotolity adalah <b>0.6 (Kemungkinan Besar)</b><br>
				Dan ketidakpercayaan <b>(MD)</b> anda terhadap gejala Anorexia untuk penyakit Gastrointestinal Hipomotolity adalah <b>0.2 (Hampir Mungkin)</b><br><br>
				<b>Maka:</b> CF(Pakar) = MB – MD (0.6 - 0.2) = <b>0.4</b> <br>
				Dimana nilai kepastian anda terhadap gejala Mencret keputih-putihan untuk penyakit Berak Kapur adalah <b>0.4 (Kemungkinan Besar)</b>
              </div>

           <div class='col-md-8'>
            <div class='box box-success box-solid'>
              <div class='box-header with-border'>
                <h3 class='box-title'>Tambah Basis Pengetahuan</h3>  
                </div><!-- /.box-header -->
                <div class='box-body'>
                <form name=text_form method=POST action='$aksi?module=pengetahuan&act=input' onsubmit='return Blank_TextField_Validator()'>
          		<table class='table table-bordered'>
		  		<tr><td width=120>Penyakit</td><td><select class='form-control' name='kd_penyakit'  id='kd_penyakit'><option value=''>- Pilih Penyakit -</option>";
				$hasil4 = mysql_query("SELECT * FROM tbl_penyakit order by nama_penyakit");
				while($r4=mysql_fetch_array($hasil4)){
				echo "<option value='$r4[kd_penyakit]'>$r4[nama_penyakit]</option>";
				}
				echo	"</select></td></tr>
				<tr><td>Gejala</td><td><select class='form-control' name='kd_gejala' id='kd_gejala'><option value=''>- Pilih Gejala -</option>";
				$hasil4 = mysql_query("SELECT * FROM tbl_gejala order by nama_gejala");
				while($r4=mysql_fetch_array($hasil4)){
				echo "<option value='$r4[kd_gejala]'>$r4[nama_gejala]</option>";
				}
				echo	"</select></td></tr>
				<tr><td>MB</td><td><input autocomplete='off' placeholder='Masukkan MB' type=text class='form-control' name='mb' size=15 ></td></tr>
				<tr><td>MD</td><td><input autocomplete='off' placeholder='Masukkan MD' type=text class='form-control' name='md' size=15 ></td></tr>
		  		<tr><td></td><td><input class='btn btn-success' type=submit name=submit value='Simpan' >
		  		<input class='btn btn-danger' type=button name=batal value='Batal' onclick=\"window.location.href='?module=pengetahuan';\"></td></tr>
          		</table></form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          ";
     break;
    
  case "editpengetahuan":
    $edit=mysql_query("SELECT * FROM tbl_basispengetahuan WHERE kd_pengetahuan='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	
    echo "<br>
	<div class='col-md-8'>
              <div class='box box-warning box-solid'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Basis Pengetahuan</h3>
                  </div><!-- /.box-header -->
                  <div class='box-body'>
                  <form name=text_form method=POST action='$aksi?module=pengetahuan&act=update' onsubmit='return Blank_TextField_Validator()'>
          		  <input type=hidden name=id value='$r[kd_pengetahuan]'>
          		  <table class='table table-bordered'>
		  		  <tr><td width=120>Penyakit</td><td><select class='form-control' name='kd_penyakit' id='kd_penyakit'>";
				  $hasil4 = mysql_query("SELECT * FROM tbl_penyakit order by nama_penyakit");
				  while($r4=mysql_fetch_array($hasil4)){
				  echo "<option value='$r4[kd_penyakit]'"; if($r[kd_penyakit]==$r4[kd_penyakit]) echo "selected";
				  echo ">$r4[nama_penyakit]</option>";
				  }
				  echo	"</select></td></tr>
				 <tr><td>Gejala</td><td><select class='form-control' name='kd_gejala' id='kd_gejala'>";
				 $hasil4 = mysql_query("SELECT * FROM tbl_gejala order by nama_gejala");
				 while($r4=mysql_fetch_array($hasil4)){
				 echo "<option value='$r4[kd_gejala]'"; if($r[kd_gejala]==$r4[kd_gejala]) echo "selected";
				 echo ">$r4[nama_gejala]</option>";
				 }
				 echo	"</select></td></tr>
				 <tr><td>MB</td><td><input autocomplete='off' placeholder='Masukkan MB' type=text class='form-control' name='mb' size=15 value='$r[mb]'></td></tr>
				 <tr><td>MD</td><td><input autocomplete='off' placeholder='Masukkan MD' type=text class='form-control' name='md' size=15 value='$r[md]'></td></tr>
          		 <tr><td></td><td><input class='btn btn-success' type=submit name=submit value='Simpan' >
		  		 <input class='btn btn-danger' type=button name=batal value='Batal' onclick=\"window.location.href='?module=pengetahuan';\"></td></tr>
          		 </table></form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
	";
    break;  
}
?>
<?php } ?>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                $.ajax({
                    type: 'POST',
                    url: 'modul/pengetahuan/search.php',
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