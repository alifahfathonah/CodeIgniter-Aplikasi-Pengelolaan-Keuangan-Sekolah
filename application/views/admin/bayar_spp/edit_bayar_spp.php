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
                <a href="<?php echo site_url('admin/bayar_spp/') ?>"><i class="fa fa-arrow-left"></i> Back</a>
              </div>
              <div class="card-body">
                <div class="x_title">
                  <h2 class="col-md-12 col-sm-12" style="text-align: center;">Edit Pembayaran SPP No <?php echo $bayar_spp->no_bayar_spp ?></h2>
                  <div class="clearfix"></div>

                </div>

                <form action="<?php echo site_url('admin/bayar_spp/edit/'.$bayar_spp->no_bayar_spp) ?>" method="post" enctype="multipart/form-data" >
                  <input type="hidden" name="no_bayar_spp" value="<?php echo $bayar_spp->no_bayar_spp; ?>">
                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_siswa">Nama Siswa : </label>
                    <div class="col-md-6 col-sm-6 ">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_siswa" style="text-align: left;"><?php echo $bayar_spp->nama_siswa ?></label>
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="NIS">NIS : </label>
                    <div class="col-md-6 col-sm-6 ">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_siswa" style="text-align: left;"><?php echo $bayar_spp->NIS ?></label>
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="kelas">Kelas : </label>
                    <div class="col-md-6 col-sm-6 ">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_siswa" style="text-align: left;">
                        <?php if($bayar_spp->kelas == 99){
                          echo "Alumni";
                        }else{
                          echo $bayar_spp->kelas_nama;  
                        }
                        ?>
                      </label>
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="bulan">Pembayaran Bulan : </label>
                    <div class="col-md-6 col-sm-6 ">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="bulantahun" style="text-align: left;"><?php $this->load->helper('bulan_helper'); echo bulan($bayar_spp->bulan_spp); echo " "; echo $bayar_spp->tahun_spp; ?></label>
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="biaya_spp">Biaya SPP : </label>
                    <div class="col-md-3 col-sm-3 ">
                      <input class="form-control <?php echo form_error('biaya_spp') ? 'is-invalid':'' ?>" type="number" min=0 name="biaya_spp" placeholder="Biaya SPP" value="<?php echo $bayar_spp->jumlah ?>" required/>
                    </div>
                    <div class="invalid-feedback">
                      <?php echo form_error('biaya_spp') ?>
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="tanggal_bayar">Tanggal Bayar : </label>
                    <div class='col-md-3 col-sm-3 '>
                      <div class="form-group">
                        <div class='input-group date' id='myDatepicker2'>
                          <input type='text' class="form-control" placeholder="Tanggal Bayar" name="tanggal_bayar_spp" value="<?php echo $bayar_spp->tanggal_bayar_spp ?>" />
                          <span class="input-group-addon" style="padding-top: 10px">
                            <span class="fa fa-calendar-o"></span>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="invalid-feedback">
                      <?php echo form_error('tanggal_bayar') ?>
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

              </div>

              <!-- /form Tambah -->



            </div>

          </div>
          <br />

        </div>
        <!-- /page content -->
</div>
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


    </script>


    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('js/custom.min.js') ?>"></script>

    

  </body>
  </html>
