<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view("admin/_partials/head.php") ?>

  <link rel="stylesheet" href="<?php echo base_url().'css/jquery-ui.css'?>">
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

            <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success" role="alert">
              <a href="#" class="close" data-dismiss="alert">&times;</a>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php } else if($this->session->flashdata('error')){ ?>  
            <div class="alert alert-danger">  
              <a href="#" class="close" data-dismiss="alert">&times;</a>  
              <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>  
            </div>  
            <?php } else if($this->session->flashdata('warning')){ ?>  
            <div class="alert alert-warning">  
              <a href="#" class="close" data-dismiss="alert">&times;</a>  
              <strong>Warning!</strong> <?php echo $this->session->flashdata('warning'); ?>  
            </div>  
            <?php } else if($this->session->flashdata('info')){ ?>  
            <div class="alert alert-info">  
              <a href="#" class="close" data-dismiss="alert">&times;</a>  
              <strong>Info!</strong> <?php echo $this->session->flashdata('info'); ?>  
            </div>  
            <?php } ?>

            <div class="card mb-3">
              <div class="card-header">
                <a href="<?php echo site_url('admin/pemasukkan_lain/') ?>"><i class="fa fa-arrow-left"></i> Back </a>
              </div>
              <div class="card-body">
                <div class="x_title">
                  <h2 class="col-md-12 col-sm-12" style="text-align: center;">Tambah Pemasukkan Lain</h2>
                  <div class="clearfix"></div>

                </div>

                <form role="form" action="<?php echo site_url('admin/pemasukkan_lain/add') ?>" method="post">
                  <div class="form-group col-md-12 col-sm-12">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Nama Kategori : </label>
                    <div class="col-md-4 col-sm-4 ">
                      <select class="select2_single form-control" name="kategori" tabindex="-1">
                        <option></option>
                        <?php foreach ($kategori as $kategori): ?>
                        <option value="<?php echo $kategori->id_kategori_pemasukkan_lain ?>"><?php echo $kategori->nama_kategori_pemasukkan_lain ?></option>';
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Tanggal Pembayaran : </label>
                    <div class='col-md-3 col-sm-3 '>
                          <div class="form-group">
                              <div class='input-group date' id='myDatepicker2'>
                                  <input type='text' class="form-control" placeholder="Tanggal Bayar" name="tanggal_bayar" required value="<?php echo $tanggal ?>" />
                                  <span class="input-group-addon" style="padding-top: 10px">
                              <span class="fa fa-calendar-o"></span>
                            </span>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="form-group col-md-12 col-sm-12">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Nominal (Rp) : </label>
                    <div class="col-md-4 col-sm-4 ">
                      <input class="form-control <?php echo form_error('biaya_catering') ? 'is-invalid':'' ?>" type="number" min=0 name="nominal" placeholder="0" required/>
                    </div>
                  </div>

                  <div class="form-group col-md-12 col-sm-12">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Nama Siswa* : </label>
                    <div class="col-md-4 col-sm-4 ">
                      <input class="form-control <?php echo form_error('nama_siswa') ? 'is-invalid':'' ?>" type="text" id="nama_siswa" name="nama_siswa" placeholder="Nama Siswa"/>
                    </div>
                  </div>
                  <div class="form-group col-md-12 col-sm-12">
                    <label class="col-form-label col-md-4 col-sm-4 label-align"></label>
                    <div class="col-md-4 col-sm-4 ">
                      <a style="font-size: 10px">*Kosongkan jika tidak dibutuhkan</a>
                    </div>
                  </div>

                  <div class="form-group col-md-12 col-sm-12">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Keterangan : </label>
                    <div class="col-md-4 col-sm-4 ">
                      <textarea class="form-control" name="keterangan_pemasukkan_lain" required></textarea>
                    </div>
                  </div>

                  <br>
                  <div class="modal-footer">  
                    <button type="submit" class="btn btn-success">Tambah</button>
                  </div>
                </form>


              </div>

              <div class="card-footer small text-muted">

              </div>

              <!-- /form Tambah -->



            </div>

          </div>
          <br />

        </div>
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
  <script src="<?php echo base_url('assets/jquery/dist/jquery.min.js') ?>"></script>
  <!-- Bootstrap -->
  <script src="<?php echo base_url('assets/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url('assets/fastclick/lib/fastclick.js') ?>"></script>
  <!-- NProgress -->
  <script src="<?php echo base_url('assets/nprogress/nprogress.js') ?>"></script>

  <script type="text/javascript">
    $(document).ready(function(){

      $('#nama_siswa').autocomplete({
        source: "<?php echo site_url('admin/bayar_spp/get_autocomplete');?>",
        select: function (event, ui) {
          $('[name="nama_siswa"]').val(ui.item.label); 
          $('[name="nis"]').val(ui.item.nomor);
          $('[name="kelas"]').val(ui.item.kelas);
          $('[name="biaya_spp"]').val(ui.item.biaya); 
        }
      });

    });
  </script>


  <!-- bootstrap-daterangepicker -->
  <script src="<?php echo base_url('assets/moment/min/moment.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>

  <script src="<?php echo base_url().'js/jquery-ui.js'?>" type="text/javascript"></script>

  <!-- bootstrap-datetimepicker -->    
  <script src="<?php echo base_url('assets/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') ?>"></script>

  <!-- Initialize datetimepicker -->
  <script  type="text/javascript">


    $('#myDatepicker2').datetimepicker({
      format: 'DD/MM/YYYY'
    });

    $('#myDatepicker3').datetimepicker({
      format: 'YYYY'
    });

    $('#myDatepicker4').datetimepicker({
      format: 'MM'
    });


  </script>


  <!-- Custom Theme Scripts -->
  <script src="<?php echo base_url('js/custom.min.js') ?>"></script>



</body>
</html>
