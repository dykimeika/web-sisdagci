       <!-- Info boxes -->
       <?php
       $htgejala=mysql_query("SELECT count(*) as total from tbl_gejala");
       $dtgejala=mysql_fetch_assoc($htgejala); ?>
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-plus-square" style="margin-top: 20px;"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Gejala</span>
                  <span class="info-box-number"><h4><b><?php echo $dtgejala["total"]; ?></b></h4></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <?php 
            $htpenyakit=mysql_query("SELECT count(*) as total from tbl_penyakit");
            $dtpenyakit=mysql_fetch_assoc($htpenyakit); ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-heartbeat" style="margin-top: 20px;"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Penyakit</span>
                  <span class="info-box-number"><h4><b><?php echo $dtpenyakit["total"]; ?></b></h4></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
          <?php 
          $htpengetahuan=mysql_query("SELECT count(*) as total from tbl_basispengetahuan");
          $dtpengetahuan=mysql_fetch_assoc($htpengetahuan); ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-server" style="margin-top: 20px;"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Pengetahuan</span>
                  <span class="info-box-number"><h4><b><?php echo $dtpengetahuan["total"]; ?></b></h4></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          <?php 
          $htadmin=mysql_query("SELECT count(*) as total from tbl_admin");
          $dtadmin=mysql_fetch_assoc($htadmin); ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-person-add" style="margin-top: 20px;"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total admin pakar</span>
                  <span class="info-box-number"><h4><b><?php echo $dtadmin["total"]; ?> </b></h4></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->