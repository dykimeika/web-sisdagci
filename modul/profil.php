<head>
<title>Profil Penyakit - SisDagCI</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet prefetch' href='aset/tentang/style.css'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
<link rel="stylesheet" href="aset/login/css/style.css">
<style>
@media only screen and (max-width: 400px) {
    img {
        width: 100%;
    }
}
</style>
</head>

<?php

if ($_GET['id']) {
  $sqlhasil = mysql_query("SELECT * FROM tbl_penyakit where kd_penyakit=" . $_GET['id']);
  while ($rhasil = mysql_fetch_array($sqlhasil)) {
    $penyakit = $rhasil['nama_penyakit'];
    $detail = $rhasil['detail_penyakit'];
    $solusi = $rhasil['solusi_penyakit'];
    $gambar = $rhasil['gambar_penyakit'];
  }

echo "<body><div class='ma3'>";
echo "<article class='tc w-75 center pt5 pb2 ph3 mw6-ns ba bw1 b--light-gray' style='background: #fff;'>";
echo "<header class='mb4'>
<h2 class='f5 silver mt2 mb1'><i class='fa fa-heartbeat'> PROFIL PENYAKIT PENCERNAAN</i></h2><hr>
    <img  src='gambar/penyakit/" . $gambar . "' alt='Profile headshot' />
      <h1 class='f3 lh-title mv2 dark-gray'>" . $penyakit . "</h1>
         <br>";
              echo "<div class='box box-solid'>
                <div class='box-body'>
                  <div class='box-group' id='accordion'>
                    <div class='panel box box-primary'>
                      <div class='box-header with-border'>
                        <h4 class='box-title'>
                          <a data-toggle='collapse' data-parent='#accordion' href='#collapseOne'>
                            Detail Penyakit
                          </a>
                        </h4>
                      </div>
                      <div id='collapseOne' class='panel-collapse collapse in'>
                        <div class='box-body' align='justify'>
                           " . $detail . "
                        </div>
                      </div>
                    </div>
                    <div class='panel box box-danger'>
                      <div class='box-header with-border'>
                        <h4 class='box-title'>
                          <a data-toggle='collapse' data-parent='#accordion' href='#collapseTwo'>
                            Solusi Penanganan
                          </a>
                        </h4>
                      </div>
                      <div id='collapseTwo' class='panel-collapse collapse'>
                        <div class='box-body' align='left'>
                          " . $solusi . "
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>";
echo "</header>
  </article>
  </body>";
}
?>