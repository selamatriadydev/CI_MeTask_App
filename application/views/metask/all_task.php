 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

<section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">task</h3>
              <?php
              if($this->session->userdata('access')== 'root' || $this->session->userdata('access')== 'admin'):?>
              <a href="<?php echo base_url(); ?>home/add" class="btn btn-primary">Tambah</a>
          <?php endif; ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#No</th>
                  <th>Jenis</th>
                  <th>Nama</th>
                  <th>Start</th>
                  <th>Finish</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                foreach ($data as $row ) {
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $row->jenis; ?></td>
                  <td><?php echo $row->nama; ?></td>
                  <td><?php echo date('d M, Y', strtotime($row->start)); ?></td>
                  <td><?php echo date('d M, Y', strtotime($row->finish)); ?></td>
                  <td>
                  	<?php $status = $row->statustask; 
                  	if($status =='M') {?>
                  <span class="badge badge-secondary"> Menunggu</span>
	              <?php }elseif($status =='P'){?>
	              	  <span class="badge badge-warning"> Proses</span>
	              <?php }else{?>
	              	  <span class="badge badge-success"> Selesai</span>
	              <?php } ?>
	              </td>
                  <td>
                    <a href="<?php echo base_url(); ?>home/detail/<?php echo $row->metaskID; ?>" class="btn btn-warning">Detail</a>
                </td>
                </tr>
            <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>


</div>

