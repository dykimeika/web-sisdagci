<title>Keterangan - SisDagCI</title>

<div>
  <h3 align="center" style="font-size: 20pt;"><b>Informasi Penyakit</b></h3>
</div>
<hr>
<div class="row">

  <?php
  $hasil = mysql_query("SELECT * FROM tbl_info ORDER BY kd_info");
  while ($r = mysql_fetch_array($hasil)) {
      ?>

      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" data-aos="fade-right">
        <div class="card text-center">
          <img class="card-img-top img-bordered-sm" src="<?php echo 'gambar/post/' . $r['gambar_info']; ?>" alt="" width="100%" height="200">
          <div class="card-block">
            <h4 class="card-title"><h3 class="bg-keterangan"><?php echo $r['nama_info']; ?></h3>
              <a class="btn bg-maroon btn-flat margin" href="#" data-toggle="modal" data-target="#modal<?php echo $r['kd_info']; ?>"><i class="fa fa-external-link-square" aria-hidden="true"></i> Detail</a>
              <a class="btn bg-saran btn-flat margin" href="#" data-toggle="modal" data-target="#modaltindakan<?php echo $r['kd_info']; ?>"><i class="fa  fa-tags" aria-hidden="true"></i> Saran</a>
          </div>
        </div>
        <hr>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="modal<?php echo $r['kd_info'];?>" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header detail-ket">
              <button type="button" class="close" data-dismiss="modal" style="opacity: .99;color: #fff;">&times;</button>
              <h4 class="modal-title text text-ket"><i class="fa fa-external-link-square" aria-hidden="true"></i> Detail Untuk <?php echo $r[nama_info]; ?></h4>
            </div>
            <div class="modal-body" style="text-align: justify;text-justify: inter-word;">
              <p><?php echo $r[detail_info]; ?></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>
      
      <!-- Modal -->
      <div class="modal fade" id="modaltindakan<?php echo $r['kd_info'];?>" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header bg-saran">
              <button type="button" class="close" data-dismiss="modal" style="opacity: .99;color: #fff;">&times;</button>
              <h4 class="modal-title text text-ket"><i class="fa  fa-tags" aria-hidden="true"></i> Saran Untuk <?php echo $r[nama_info]; ?></h4>
            </div>
            <div class="modal-body" style="text-align: justify;text-justify: inter-word;">
              <p><?php echo $r[solusi_info]; ?></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>

  <?php } ?>

</div>
