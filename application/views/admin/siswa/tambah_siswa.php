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

              <!-- form Tambah -->
              
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
              </div>
              <?php endif; ?>

              <div class="card mb-3">
                <div class="card-header">
                  <a href="<?php echo site_url('admin/siswa/') ?>"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="card-body">
                  <div class="x_title">
                    <h2 class="col-md-12 col-sm-12" style="text-align: center;">Tambah Siswa</h2>
                    <div class="clearfix"></div>
                     
                  </div>

                  <form action="<?php echo site_url('admin/Siswa/add') ?>" method="post" enctype="multipart/form-data" >
                    
                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="NIS">NIS</label>
                      <div class="col-md-6 col-sm-6 ">
                        <input class="form-control <?php echo form_error('nis') ? 'is-invalid':'' ?>" type="text" name="nis" placeholder="Nomor Induk Siswa" />
                      </div>
                      <div class="invalid-feedback">
                        <?php echo form_error('nis') ?>
                      </div>
                    </div>

                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_siswa">Nama Siswa</label>
                      <div class="col-md-6 col-sm-6 ">
                        <input class="form-control <?php echo form_error('nama_siswa') ? 'is-invalid':'' ?>" type="text" name="nama_siswa" placeholder="Nama Siswa" />
                      </div>
                      <div class="invalid-feedback">
                        <?php echo form_error('nama_siswa') ?>
                      </div>
                    </div>

                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="kelas">Kelas</label>
                      <div class="col-md-6 col-sm-6 ">
                        <select class="select2_single form-control" name="kelas" tabindex="-1">
                            <option></option>
                            <?php 
                              for($i=1 ; $i <=6 ; $i++){
                                echo '<option value='.$i.'>'.$i.' </option>';
                                }  
                            ?>
                        </select>
                      </div>
                      <div class="invalid-feedback">
                        <?php echo form_error('kelas') ?>
                      </div>
                    </div>

                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="biaya_spp">Biaya SPP</label>
                      <div class="col-md-6 col-sm-6 ">
                        <input class="form-control <?php echo form_error('biaya_spp') ? 'is-invalid':'' ?>" type="number" min="0" name="biaya_spp" placeholder="Biaya SPP" />
                      </div>
                      <div class="invalid-feedback">
                        <?php echo form_error('biaya_spp') ?>
                      </div>
                    </div>

                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                          <input class="btn btn-success" type="submit" name="btn" value="Save" />
                        </div>
                    </div>

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

    <!-- MODAL -->
    <?php $this->load->view("admin/_partials/modal.php") ?>

    <!-- jQuery -->
    <?php $this->load->view("admin/_partials/js.php") ?>
	
  </body>
</html>
