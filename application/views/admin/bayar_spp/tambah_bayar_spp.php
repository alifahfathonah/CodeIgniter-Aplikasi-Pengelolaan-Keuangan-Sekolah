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
                  <a href="<?php echo site_url('admin/bayar_spp/') ?>"><i class="fa fa-arrow-left"></i> Back </a>
                </div>
                <div class="card-body">
                  <div class="x_title">
                    <h2 class="col-md-12 col-sm-12" style="text-align: center;">Tambah Pembayaran SPP Siswa</h2>
                    <div class="clearfix"></div>
                     
                  </div>

                  <form action="<?php echo site_url('admin/bayar_spp/add') ?>" method="post" enctype="multipart/form-data" >
                    
                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_siswa">Nama Siswa (NIS)</label>
                      <div class="col-md-6 col-sm-6 ">
                        <input class="form-control <?php echo form_error('nama_siswa') ? 'is-invalid':'' ?>" type="text" id="nama_siswa" name="nama_siswa" placeholder="Nama Siswa"/>
                      </div>
                      <div class="invalid-feedback">
                        <?php echo form_error('nama_siswa') ?>
                      </div>
                    </div>


                   
                    <input class="form-control <?php echo form_error('nis') ? 'is-invalid':'' ?>" type="text" name="nis" placeholder="Nomor Induk Siswa" hidden />
                   
                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="kelas">Kelas</label>
                      <div class="col-md-1 col-sm-1 ">
                        <input class="form-control <?php echo form_error('kelas') ? 'is-invalid':'' ?>" type="text" name="kelas" placeholder="Kelas" readonly />
                      </div>
                      
                    
                      <label class="col-form-label col-md-1 col-sm-1" for="biaya_spp">SPP (Rp) </label>
                      <div class="col-md-4 col-sm-4 ">
                        <input class="form-control <?php echo form_error('biaya_spp') ? 'is-invalid':'' ?>" type="text" name="biaya_spp" placeholder="Biaya SPP"/>
                      </div>
                      <div class="invalid-feedback">
                        <?php echo form_error('biaya_spp') ?>
                      </div>
                    </div>


                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="tanggal_bayar">Tanggal Bayar</label>
                      <div class='col-md-6 col-sm-6 '>
                          <div class="form-group">
                              <div class='input-group date' id='myDatepicker2'>
                                  <input type='text' class="form-control" placeholder="Tanggal Bayar" name="tanggal_bayar_spp" required value="<?php echo $tanggal ?>" />
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
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="bulan">Pembayaran Bulan</label>
                      <div class="col-md-3 col-sm-3 ">
                       <!-- <select class="select2_single form-control" name="bulan_spp" tabindex="-1">
                          <option value=1>Januari</option>;
                          <option value=2>Februari</option>;
                          <option value=3>Maret</option>;
                          <option value=4>April</option>;
                          <option value=5>Mei</option>;
                          <option value=6>Juni</option>;
                          <option value=7>Juli</option>;
                          <option value=8>Agustus</option>;
                          <option value=9>September</option>;
                          <option value=10>Oktober</option>;
                          <option value=11>November</option>;
                          <option value=12>Desember</option>;   
                        </select> -->

                        <div class="form-group">
                          <div class='input-group date' id='myDatepicker4'>
                            <input type='text' class="form-control" placeholder="Bulan" name="bulan_spp" required value="<?php echo $bulan ?>" />
                            <span class="input-group-addon" style="padding-top: 10px">
                              <span class="fa fa-calendar-o"></span>
                            </span>
                          </div>
                        </div>


                      </div>
                      <div class="col-md-3 col-sm-3 ">
                       <div class="form-group">
                          <div class='input-group date' id='myDatepicker3'>
                            <input type='text' class="form-control" placeholder="Tahun" name="tahun_spp" required value="<?php echo $tahun ?>" />
                            <span class="input-group-addon" style="padding-top: 10px">
                              <span class="fa fa-calendar-o"></span>
                            </span>
                          </div>
                        </div>
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
