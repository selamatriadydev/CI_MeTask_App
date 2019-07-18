<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tugas
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Form</a></li>
        <li class="active">add</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Tugas</h3>
            </div>
            <!-- /.box-header -->

      <?php if ($error != ' '):?>
           <div class="alert alert-warning" role="alert">
             <?php echo $error;?>
            </div>
    <?php endif; ?>
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url(); ?>index.php/home/addpost" enctype="multipart/form-data">
              <div class="box-body">
                <input type="hidden" name="userID" value="<?php echo $sesion_userid; ?>">
                <div class="form-group">
                  <label for="exampleInputEmail1">Jenis</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="jenis" placeholder="Jenis">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Nama</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" name="nama" placeholder="Nama">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Rincian</label>
                  <textarea class="form-control" placeholder="Rincian" name="rincian"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Start</label>
                  <input type="date" class="form-control" id="exampleInputPassword1" name="start" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Finish</label>
                  <input type="date" class="form-control" id="exampleInputPassword1" name="finish" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input type="file" id="exampleInputFile" name="image">

                  <p class="help-block">Example block-level help text here.</p>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox"> Check me out
                  </label>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add</button>
                
                <a href="<?php echo base_url(); ?>home/alltask" class="btn btn-warning">Batal</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
</div>