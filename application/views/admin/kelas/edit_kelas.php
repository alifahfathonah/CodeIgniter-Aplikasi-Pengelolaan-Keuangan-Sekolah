<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view("admin/_partials/head.php") ?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php $this->load->view("admin/_partials/sidebar.php") ?>

        <!-- top navigation -->
        <?php $this->load->view("admin/_partials/navbar.php") ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          
          <div class="row">
            <div class="col-md-12 col-sm-12 ">

              <!-- form Edit -->
              
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
              </div>
              <?php endif; ?>

              <div class="card mb-3">
                <div class="card-header">
                  <a href="<?php echo site_url('admin/kelas/') ?>"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="card-body">

                  <form action="<?php echo site_url('admin/kelas/edit/'.$kelas->id_kelas) ?>" method="post" enctype="multipart/form-data" >

                    <input type="hidden" name="id_kelas" value="<?php echo $kelas->id_kelas?>" />

                    <div class="form-group">
                      <label for="nama_kelas">Nama Kelas</label>
                      <input class="form-control <?php echo form_error('nama_kelas') ? 'is-invalid':'' ?>"
                       type="text" name="nama_kelas" placeholder="Nama Kelas" value="<?php echo $kelas->nama_kelas ?>"/>
                      <div class="invalid-feedback">
                        <?php echo form_error('nama_kelas') ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="biaya_spp">Biaya SPP</label>
                      <input class="form-control <?php echo form_error('biaya_spp') ? 'is-invalid':'' ?>"
                       type="text" name="biaya_spp" placeholder="Biaya SPP" value="<?php echo $kelas->biaya_spp ?>"/>
                      <div class="invalid-feedback">
                        <?php echo form_error('biaya_spp') ?>
                      </div>
                    </div>

                    <input class="btn btn-success" type="submit" name="btn" value="Save" />
                  </form>

                </div>

                <div class="card-footer small text-muted">
                  * required fields
                </div>

              <!-- /form Tambah -->



            </div>

          </div>
          <br />

        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php $this->load->view("admin/_partials/footer.php") ?>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <?php $this->load->view("admin/_partials/js.php") ?>
	
  </body>
</html>
