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
                  <a href="<?php echo site_url('admin/daftar_ulang/') ?>"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="card-body">
                  <div class="x_title">
                    <h2 class="col-md-12 col-sm-12" style="text-align: center;">Tambah Pembayaran Daftar Ulang</h2>
                    <div class="clearfix"></div>
                  </div>

                  <form action="<?php echo site_url('admin/daftar_ulang/add') ?>" method="post" enctype="multipart/form-data" >
                    
                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_siswa">Nama Siswa (NIS)</label>
                      <div class="col-md-6 col-sm-6 ">
                        <input class="form-control <?php echo form_error('nama_siswa') ? 'is-invalid':'' ?>" type="text" id="nama_siswa" name="nama_siswa" placeholder="Nama Siswa" required/>
                      </div>
                      <div class="invalid-feedback">
                        <?php echo form_error('nama_siswa') ?>
                      </div>
                    </div>

                        <input class="form-control <?php echo form_error('nis') ? 'is-invalid':'' ?>" type="text" name="nis" placeholder="Nomor Induk Siswa" required hidden/>
                    
                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="kelas_bayar_spp">Kelas</label>
                      <div class="col-md-6 col-sm-6 ">
                        <input class="form-control <?php echo form_error('kelas_daftar_ulang') ? 'is-invalid':'' ?>" type="text" name="kelas_daftar_ulang" placeholder="Kelas" required readonly/>
                      </div>
                    </div>                      

                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="kelas_bayar_spp">Tahun Ajaran</label>
                      <div class="col-md-6 col-sm-6 ">
                        <div class="col-md-5 col-sm-5 ">
                          <div class="form-group">
                            <div class='input-group date' id='myDatepicker3'>
                              <input type='text' class="form-control" placeholder="Tahun" name="tahun_ajaran1" />
                              <span class="input-group-addon" style="padding-top: 10px">
                              <span class="fa fa-calendar-o"></span>
                            </span>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-2 col-sm-2" align="center">
                          <a style="font-size: 30px"> / </a>
                        </div>
                        <div class="col-md-5 col-sm-5 ">
                          <div class="form-group">
                            <div class='input-group date' id='myDatepicker4'>
                              <input type='text' class="form-control" placeholder="Tahun" name="tahun_ajaran2" />
                              <span class="input-group-addon" style="padding-top: 10px">
                              <span class="fa fa-calendar-o"></span>
                            </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>  

                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="spp">SPP (Rp.) </label>
                      <div class="col-md-6 col-sm-6 ">
                        <input class="form-control <?php echo form_error('spp') ? 'is-invalid':'' ?>" type="number" min=0 name="spp" placeholder="SPP" required value=0 onkeyup="setJumlah()"/>
                      </div>
                      <div class="invalid-feedback">
                        <?php echo form_error('spp') ?>
                      </div>
                    </div>

                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="seragam">Seragam (Rp.) </label>
                      <div class="col-md-6 col-sm-6 ">
                        <input class="form-control <?php echo form_error('seragam') ? 'is-invalid':'' ?>" type="number" min=0 name="seragam" placeholder="Seragam" required value=0 onkeyup="setJumlah()"/>
                      </div>
                      <div class="invalid-feedback">
                        <?php echo form_error('seragam') ?>
                      </div>
                    </div>

                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="kegiatan_siswa">Kegiatan Siswa (Rp.) </label>
                      <div class="col-md-6 col-sm-6 ">
                        <input class="form-control <?php echo form_error('kegiatan_siswa') ? 'is-invalid':'' ?>" type="number" min=0 name="kegiatan_siswa" placeholder="Kegiatan Siswa" required value=0 onkeyup="setJumlah()"/>
                      </div>
                      <div class="invalid-feedback">
                        <?php echo form_error('kegiatan_siswa') ?>
                      </div>
                    </div>

                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="spi">SPI (Rp.) </label>
                      <div class="col-md-6 col-sm-6 ">
                        <input class="form-control <?php echo form_error('spi') ? 'is-invalid':'' ?>" type="number" min=0 name="spi" placeholder="SPI" required value=0 onkeyup="setJumlah()"/>
                      </div>
                      <div class="invalid-feedback">
                        <?php echo form_error('spi') ?>
                      </div>
                    </div>

                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="pembukaan_rek">Pembukaan Rekening (Rp.) </label>
                      <div class="col-md-6 col-sm-6 ">
                        <input class="form-control <?php echo form_error('pembukaan_rek') ? 'is-invalid':'' ?>" type="number" min=0 name="pembukaan_rek" placeholder="Pembukaan Rekening" required value=0 onkeyup="setJumlah()"/>
                      </div>
                      <div class="invalid-feedback">
                        <?php echo form_error('pembukaan_rek') ?>
                      </div>
                    </div>

                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="total">Total Biaya (Rp.) </label>
                      <div class="col-md-6 col-sm-6 ">
                        <input class="form-control <?php echo form_error('total') ? 'is-invalid':'' ?>" type="number" min=0 name="total" placeholder="Total" required value=0/>
                      </div>
                      <div class="invalid-feedback">
                        <?php echo form_error('total') ?>
                      </div>
                    </div>

                    <!-- <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="total">Apakah Naik Kelas? </label>
                      <div class="col-md-6 col-sm-6 ">
                        <div class="col-md-3 col-sm-3 " style="padding-top: 10px;">
                        <input type="radio" id="ya" name="naikkelas" value=1 checked='checked'>
                        <label for="female">YA</label>
                        </div>
                        <div class="col-md-3 col-sm-3 " style="padding-top: 10px;">
                        <input type="radio" id="tidak" name="naikkelas" value=0>
                        <label for="other">TIDAK</label>
                        </div>                        
                      </div>
                      <div class="invalid-feedback">
                        <?php echo form_error('total') ?>
                      </div>
                    </div> -->

                    



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
                    $('[name="kelas_daftar_ulang"]').val(ui.item.kelas);
                    $('[name="spp"]').val(ui.item.biaya); 
                    
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
    <script type="text/javascript">
        $('#myDatepicker2').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        $('#myDatepicker3').datetimepicker({
            format: 'YYYY'
        });
        $('#myDatepicker4').datetimepicker({
            format: 'YYYY'
        });
    </script>

    <script type="text/javascript">
        function setJumlah() {
          var a = document.getElementsByName("spp")[0].value;
          var b = document.getElementsByName("seragam")[0].value;
          var c = document.getElementsByName("kegiatan_siswa")[0].value;
          var d = document.getElementsByName("spi")[0].value;
          var e = document.getElementsByName("pembukaan_rek")[0].value;
          var z = parseInt(a)+parseInt(b)+parseInt(c)+parseInt(d)+parseInt(e);
          document.getElementsByName("total")[0].value = z;
        }
    </script>


    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('js/custom.min.js') ?>"></script>

    
	
  </body>
</html>
