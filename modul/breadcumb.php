<!-- Breadcumb -->
          <?php
          if ($module == ""){
          echo " 
          <h1>
            Beranda
          </h1>
          <ol class='breadcrumb'>
            <li><a href='#''><i class='fa fa-home'></i> Beranda</a></li>
            <li class='active'>#</li>
          </ol>";
          } ?>
          <?php
          if ($module == "diagnosa"){
          echo " 
          <h1>
            Diagnosa
          </h1>
          <ol class='breadcrumb'>
            <li><a href='#''><i class='fa fa-home'></i> Beranda</a></li>
            <li class='active'>Diagnosa</li>
          </ol>";
          } ?>
          <?php
          $htriwayat=mysql_query("SELECT count(*) as total from tbl_hasil");
          $dtriwayat=mysql_fetch_assoc($htriwayat);
          if ($module == "riwayat"){
          echo " 
          <h1>
            Riwayat Konsultasi
            <small>Total Diagnosa : <span class='label label-success'>$dtriwayat[total]</span>
            </small>
          </h1>
          <ol class='breadcrumb'>
            <li><a href='#''><i class='fa fa-home'></i> Beranda</a></li>
            <li class='active'>Riwayat</li>
          </ol>";
          } ?>
           <?php
          if ($module == "informasi"){
          echo " 
          <h1>
            Informasi
          </h1>
          <ol class='breadcrumb'>
            <li><a href='#''><i class='fa fa-home'></i> Beranda</a></li>
            <li class='active'>Informasi</li>
          </ol>";
          } ?>
          <?php
          if ($module == "admin"){
          echo " 
          <h1>
            Admin
          </h1>
          <ol class='breadcrumb'>
            <li><a href='#''><i class='fa fa-home'></i> Beranda</a></li>
            <li class='active'>Admin</li>
          </ol>";
          } ?>
          <?php
          if ($module == "penyakit"){
          echo " 
          <h1>
            Penyakit
          </h1>
          <ol class='breadcrumb'>
            <li><a href='#''><i class='fa fa-home'></i> Beranda</a></li>
            <li class='active'>Penyakit</li>
          </ol>";
          } ?>
          <?php
          if ($module == "gejala"){
          echo " 
          <h1>
            Gejala
          </h1>
          <ol class='breadcrumb'>
            <li><a href='#''><i class='fa fa-home'></i> Beranda</a></li>
            <li class='active'>Gejala</li>
          </ol>";
          } ?>
          <?php
          if ($module == "pengetahuan"){
          echo " 
          <h1>
            Basis Pengetahuan
          </h1>
          <ol class='breadcrumb'>
            <li><a href='#''><i class='fa fa-home'></i> Beranda</a></li>
            <li class='active'>Pengetahuan</li>
          </ol>";
          } ?>
          <?php
          if ($module == "postinfo"){
          echo " 
          <h1>
            Post Informasi
          </h1>
          <ol class='breadcrumb'>
            <li><a href='#''><i class='fa fa-home'></i> Beranda</a></li>
            <li class='active'>Post Informasi</li>
          </ol>";
          } ?>
           <?php
          if ($module == "password"){
          echo " 
          <h1>
            Ubah Password
          </h1>
          <ol class='breadcrumb'>
            <li><a href='#''><i class='fa fa-home'></i> Beranda</a></li>
            <li class='active'>Ubah Password</li>
          </ol>";
          } ?>
          <!-- End Breadcumb -->