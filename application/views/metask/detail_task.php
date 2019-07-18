  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tugas
        <small>Detail</small>
         <?php if($this->session->userdata('access')== 'root' || $this->session->userdata('access')== 'admin'){?>
          <?php
          foreach ($status as $status){
             if($status->statustask == 'M'){ ?>
                <a href="<?php echo base_url(); ?>home/edit/<?php echo $status->metaskID; ?>" class="btn btn-warning">Edit </a>
                <a href="<?php echo base_url(); ?>home/hapus/<?php echo $status->metaskID; ?>" class="btn btn-danger">Hapus</a>
              <?php }else{
                  echo '<span class="badge badge-warning"> Tugas ini telah dikerjakan</span>';
              } 
            }?>
        <?php }else{?>
           <?php
          foreach ($status as $status){
            if($status->statustask == 'M'){
            ?>
              <a href="#" class="btn btn-primary">Ambil </a>
            <?php 
            }
        }
      } ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tugas</a></li>
        <li class="active">Detail</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- row -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
          <?php
          foreach ($M as $M){
          ?>
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    <?php echo date('d M, Y', strtotime($M->start)); ?>
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                <h3 class="timeline-header"><a href="#"><?php echo $M->jenis; ?></a> <?php echo $M->nama; ?></h3>

                <div class="timeline-body">
                  <?php echo $M->rincian; ?>
                </div>
               <!--  <div class="timeline-footer">
                  <a class="btn btn-primary btn-xs">Read more</a>
                  <a class="btn btn-danger btn-xs">Delete</a>
                </div> -->
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-user bg-aqua"></i>

              <div class="timeline-item">

                <h3 class="timeline-header no-border"><a href="#">Ditambahkan</a> Sarah</h3>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-user bg-aqua"></i>

              <div class="timeline-item">
                

                <h3 class="timeline-header no-border"><a href="#">Status</a> Menunggu</h3>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-camera bg-purple"></i>

              <div class="timeline-item">

                <h3 class="timeline-header"><a href="#">Foto</a></h3>

                <div class="timeline-body">
                  <img src="<?php echo base_url(); ?>gambar/<?php echo $M->image; ?>" alt="..." class="margin">
                </div>
              </div>
            </li>
            <!-- END timeline item -->
          <?php } ?>
           <?php
          foreach ($P as $P){
          ?>
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-yellow">
                    <?php echo date('d M, Y', strtotime($P->start)); ?>
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                <h3 class="timeline-header"><a href="#"><?php echo $P->jenis; ?></a> <?php echo $P->nama; ?></h3>

                <div class="timeline-body">
                  <?php echo $P->rincian; ?>
                </div>
               <!--  <div class="timeline-footer">
                  <a class="btn btn-primary btn-xs">Read more</a>
                  <a class="btn btn-danger btn-xs">Delete</a>
                </div> -->
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-user bg-aqua"></i>

              <div class="timeline-item">

                <h3 class="timeline-header no-border"><a href="#">Di kerjakan</a> Adi</h3>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-user bg-aqua"></i>

              <div class="timeline-item">
                

                <h3 class="timeline-header no-border"><a href="#">Status</a> Proses</h3>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-camera bg-purple"></i>

              <div class="timeline-item">

                <h3 class="timeline-header"><a href="#">Foto</a></h3>

                <div class="timeline-body">
                  <img src="<?php echo base_url(); ?>gambar/<?php echo $P->image; ?>" alt="..." class="margin">
                </div>
              </div>
            </li>
            <!-- END timeline item -->
 <?php }
          foreach ($S as $S){
          ?>
             <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-green">
                    <?php echo date('d M, Y', strtotime($S->start)); ?>
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                <h3 class="timeline-header"><a href="#"><?php echo $S->jenis; ?></a> <?php echo $S->nama; ?></h3>

                <div class="timeline-body">
                  <?php echo $S->rincian; ?>
                </div>
               <!--  <div class="timeline-footer">
                  <a class="btn btn-primary btn-xs">Read more</a>
                  <a class="btn btn-danger btn-xs">Delete</a>
                </div> -->
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-user bg-aqua"></i>

              <div class="timeline-item">

                <h3 class="timeline-header no-border"><a href="#">Di Selesaikan</a> Sarah</h3>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-user bg-aqua"></i>

              <div class="timeline-item">

                 
                

                <h3 class="timeline-header no-border"><a href="#">Status</a> Selesai</h3>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-camera bg-purple"></i>

              <div class="timeline-item">

                <h3 class="timeline-header"><a href="#">Foto</a></h3>

                <div class="timeline-body">
                  <img src="<?php echo base_url(); ?>gambar/<?php echo $S->image; ?>" alt="..." class="margin">
                </div>
              </div>
            </li>
            <!-- END timeline item -->
<?php } ?>
         
          </ul>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

