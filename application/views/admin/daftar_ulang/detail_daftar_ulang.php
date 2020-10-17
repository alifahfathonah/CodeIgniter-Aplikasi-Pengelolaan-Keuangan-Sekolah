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
                  <div class="x_title" style="margin-bottom: 30px;">
                    <h2>Detail Pembayaran Daftar Ulang No. <?php echo $daftar_ulang_detail->no_bayar_daftar_ulang ?></h2>
                    <ul class="nav navbar-right panel_toolbox"><a href="<?php echo site_url('admin/daftar_ulang/viewEditDaftarUlang/'.$daftar_ulang_detail->no_bayar_daftar_ulang) ?>"  class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</a></ul>
                    <div class="clearfix"></div>
                     
                  </div>

                  <div class="col-md-5 col-sm-5">

                    <div class="item form-group">
                      <label class="col-form-label col-md-5 col-sm-5 label-align" for="nama_siswa">Nama Siswa : </label>
                      <div class="col-md-6 col-sm-6 ">
                        <label class="col-form-label" style="text-align: left;"><?php echo $daftar_ulang_detail->nama_siswa ?></label>
                      </div>
                    </div>

                    <div class="item form-group">
                      <label class="col-form-label col-md-5 col-sm-5 label-align" for="NIS">NIS : </label>
                      <div class="col-md-6 col-sm-6 ">
                        <label class="col-form-label" style="text-align: left;"><?php echo $daftar_ulang_detail->NIS ?></label>
                      </div>
                    </div>

                    <div class="item form-group">
                      <label class="col-form-label col-md-5 col-sm-5 label-align" for="kelas">Kelas : </label>
                      <div class="col-md-6 col-sm-6 ">
                        <label class="col-form-label" style="text-align: left;"><?php echo $daftar_ulang_detail->kelas_nama ?></label>
                      </div>
                    </div>

                    <div class="item form-group">
                      <label class="col-form-label col-md-5 col-sm-5 label-align" for="kelas">Tahun Ajaran : </label>
                      <div class="col-md-6 col-sm-6 ">
                        <label class="col-form-label" style="text-align: left;"><?php echo $daftar_ulang_detail->tahun_ajaran ?></label>
                      </div>
                    </div>

                    <div class="item form-group">
                      <label class="col-form-label col-md-5 col-sm-5 label-align" for="kelas">Status Pembayaran : </label>
                      <div class="col-md-6 col-sm-6 ">
                        <label class="col-form-label" style="text-align: left;">
                          <?php 
                            if($daftar_ulang_detail->status == 0){
                              echo "Belum Lunas";
                            }else{
                              echo "LUNAS";
                            }
                          ?>
                            
                          </label>
                      </div>
                    </div>

                  </div>

                  <div class="col-md-6 col-sm-6">
                    <div class="item">
                      <label class="col-form-label col-md-5 col-sm-5 label-align" for="kelas">Detail Biaya  </label>
                      <div class="col-md-6 col-sm-6 ">
                      </div>
                    </div>
                      <div class="item" >
                        <label class="col-form-label col-md-5 col-sm-5 label-align">Biaya SPP : </label>
                        <div class="col-md-6 col-sm-6 ">
                          <label class="col-form-label" style="text-align: left;" >Rp. <?php $this->load->helper('rupiah_helper'); echo rupiah($daftar_ulang_detail->spp) ?></label>    
                        </div>
                      </div>

                      <div class="item" >
                        <label class="col-form-label col-md-5 col-sm-5 label-align">Biaya Seragam : </label>
                        <div class="col-md-6 col-sm-6 ">
                          <label class="col-form-label" style="text-align: left;" >Rp. <?php $this->load->helper('rupiah_helper'); echo rupiah($daftar_ulang_detail->seragam) ?></label>    
                        </div>
                      </div>

                      <div class="item" >
                        <label class="col-form-label col-md-5 col-sm-5 label-align">Kegiatan Siswa : </label>
                        <div class="col-md-6 col-sm-6 ">
                          <label class="col-form-label" style="text-align: left;" >Rp. <?php $this->load->helper('rupiah_helper'); echo rupiah($daftar_ulang_detail->kegiatan_siswa) ?></label>    
                        </div>
                      </div>

                      <div class="item" >
                        <label class="col-form-label col-md-5 col-sm-5 label-align">Biaya SPI : </label>
                        <div class="col-md-6 col-sm-6 ">
                          <label class="col-form-label" style="text-align: left;" >Rp. <?php $this->load->helper('rupiah_helper'); echo rupiah($daftar_ulang_detail->spi) ?></label>
                        </div>
                      </div>

                      <div class="item x_title" >
                        <label class="col-form-label col-md-5 col-sm-5 label-align">Pembukaan rekening : </label>
                        <div class="col-md-6 col-sm-6 ">
                          <label class="col-form-label " style="text-align: left;" >Rp. <?php $this->load->helper('rupiah_helper'); echo rupiah($daftar_ulang_detail->pembukaan_rek) ?></label>    
                        </div>
                      </div>

                     
                    

                    <div class="item form-group ">
                      <h1 class="col-md-5 col-sm-5 label-align">Total Biaya : </h1>
                      <div class="col-md-6 col-sm-6 " >
                        <h1 class="" style="text-align: left;" >Rp. <?php $this->load->helper('rupiah_helper'); echo rupiah($daftar_ulang_detail->jumlah) ?></h1>
 
                      </div>
                    </div>

                  </div>

                </div><!-- /card Body-->
                 
              </div> <!-- /card mb3-->

              <div class="card mb-3">
                <div class="card-body">
                  <div class="x_title" style="margin-bottom: 30px;">
                    <h2>Riwayat Pembayaran / Cicilan Daftar Ulang No. <?php echo $daftar_ulang_detail->no_bayar_daftar_ulang ?></h2>
                    <div class="clearfix"></div>
                     
                  </div>

                  <div class="col-md-6 col-sm-6">

                    <div class="item">
                      <label class="col-form-label col-md-5 col-sm-5 label-align">Total Yang Telah Dibayar : </label>
                      <div class="col-md-6 col-sm-6 ">
                        <label class="col-form-label" style="text-align: left;">Rp. <?php $this->load->helper('rupiah_helper'); echo rupiah($daftar_ulang_detail->terbayar) ?></label>
                      </div>
                    </div>

                    <div class="item" style="margin-bottom: 10px;">
                      <label class="col-form-label col-md-5 col-sm-5 label-align">Kekurangan : </label>
                      <div class="col-md-6 col-sm-6 ">
                        <label class="col-form-label" style="text-align: left;">
                          <?php 
                            $kekurangan =  ($daftar_ulang_detail->terbayar-$daftar_ulang_detail->jumlah);
                          ?>Rp. <?php
                          if($kekurangan < 1){
                            $this->load->helper('rupiah_helper'); echo rupiah($kekurangan);  
                          }else{
                            $this->load->helper('rupiah_helper'); echo rupiah($kekurangan)." (Kelebihan)";
                          }

                          ?>
                          </label>
                      </div>
                    </div>

                    <div class="item">
                      <label class="col-form-label col-md-5 col-sm-5 label-align"></label>
                      <div class="col-md-6 col-sm-6 ">
                        
                          <?php 
                            if ($daftar_ulang_detail->status == 0){
                              echo '<a href="#" data-toggle="modal" data-target="#bayarModal" style="text-align: left;" ><button type="button" class="btn btn-success btn-xs">Bayar</button></a>'
                              ;
                            }
                          ?>
                        
                      </div>
                    </div>

                   

                  </div>

                  <div class="col-md-6 col-sm-6">
                    <div class="col-sm-12">
                      <div class="card-box table-responsive">
                       <table id="list_daftar_ulang" class="table table-striped table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th>No.</th>
                              <th>Tanggal</th>
                              <th>Nominal</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                              $i = 1;
                            foreach ($cicil as $cicil): ?>
                            <tr>
                              <td align="center"><?php echo $i ?></td>
                              <td><?php echo $cicil->tanggal_bayar_daftarulang ?></td>
                              <td><?php echo rupiah($cicil->nominal) ?></td>
                              <td>
                                <a href="#" data-toggle="modal" data-target="#editCicil<?php echo $cicil->no_cicil_daftar_ulang; ?>" style="margin-right: 10px"><i class="fa fa-edit"></i> Edit</a>
                                <a href="#" data-toggle="modal" data-target="#deleteCicil<?php echo $cicil->no_cicil_daftar_ulang; ?>" style="margin-right: 10px"><i class="fa fa-trash"></i> Hapus</a>
                                
                              </td>
                            </tr>

                            <!-- Modal -->
<!-- Modal Edit Cicil -->
    <div class="modal fade" id="editCicil<?php echo $cicil->no_cicil_daftar_ulang; ?>" role="dialog">
      <div class="modal-dialog">
      <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"> Edit Pembayaran / Cicilan </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <div class="modal-body">
            <form role="form" action="<?php echo site_url('admin/daftar_ulang/editCicil/'.$cicil->no_cicil_daftar_ulang) ?>" method="post">
              <input type="hidden" name="no_cicil_daftar_ulang" value="<?php echo $cicil->no_cicil_daftar_ulang ?>">
              
              <div class="form-group col-md-12 col-sm-12">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Nominal (Rp.) : </label>
                <div class="col-md-8 col-sm-8 ">
                  <input class="form-control form-control-sm col-md-8 col-sm-8" type="number" min=0 name="nominal_bayar" placeholder="Nominal Pembayaran" required value="<?php echo $cicil->nominal ?>" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Tanggal Pembayaran : </label>
                <div class='col-md-8 col-sm-8'>
                  <div class='input-group date myDatepicker2 col-md-8 col-sm-8' >
                    <input type="text" class="form-control form-control-sm" placeholder="Tanggal Bayar" name="tanggal_bayar" required value="<?php echo $cicil->tanggal_bayar_daftarulang ?>"/>
                    <span class="input-group-addon" style="padding-top: 10px">
                              <span class="fa fa-calendar-o"></span>
                            </span>
                  </div>
                </div>
              </div>                                                  
              <br>
              
              <div class="modal-footer">  
                <button type="submit" class="btn btn-success">Edit Pembayaran</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Delete -->
    <div class="modal fade" id="deleteCicil<?php echo $cicil->no_cicil_daftar_ulang; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                Apakah anda yakin?
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a id="btn-delete" class="btn btn-danger" href="<?php echo site_url('admin/daftar_ulang/delete_cicil/'.$cicil->no_cicil_daftar_ulang) ?>">Hapus</a>
              </div>
            </div>
          </div>
        </div>

                          <!-- End Modal -->

                            <?php $i++; endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>

                  </div>

                </div><!-- /card Body-->
                 
              </div> <!-- /card mb3-->

              </div>

            </div>

          </div>
          

        <!-- /page content -->

        <!-- footer content -->
        <?php $this->load->view("admin/_partials/footer.php") ?>
        <!-- /footer content -->
      </div>
    </div>

     <!-- Modal --> 
    <?php $this->load->view("admin/_partials/modal.php") ?>
    <!-- Modal bayar-->
    <div class="modal fade" id="bayarModal" role="dialog">
      <div class="modal-dialog">
      <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"> No Pembayaran : <?php echo $daftar_ulang_detail->no_bayar_daftar_ulang ?> </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <div class="modal-body">
            <form role="form" action="<?php echo site_url('admin/daftar_ulang/addCicil/'.$daftar_ulang_detail->no_bayar_daftar_ulang) ?>" method="post">
              <input type="hidden" name="no_bayar_daftar_ulang" value="<?php echo $daftar_ulang_detail->no_bayar_daftar_ulang; ?>">
              <div class="form-group">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Nama Siswa : </label>
                <label class="col-form-label col-md-8 col-sm-8" style="text-align: left;"><?php echo $daftar_ulang_detail->nama_siswa ?></label>
              </div>
              <div class="form-group">
                <label class="col-form-label col-md-4 col-sm-4 label-align">NIS : </label>
                <label class="col-form-label col-md-8 col-sm-8" style="text-align: left;"><?php echo $daftar_ulang_detail->NIS; ?></label>
              </div>
              <div class="form-group col-md-12 col-sm-12">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Nominal (Rp.) : </label>
                <div class="col-md-8 col-sm-8 ">
                  <input class="form-control form-control-sm col-md-8 col-sm-8" type="number" min=0 name="nominal_bayar" placeholder="Nominal Pembayaran" required value=0 />
                </div>
              </div>
              <div class="form-group">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Tanggal Pembayaran : </label>
                <div class='col-md-8 col-sm-8'>
                  <div class='input-group date myDatepicker2 col-md-8 col-sm-8' >
                    <input type="text" class="form-control form-control-sm" placeholder="Tanggal Bayar" name="tanggal_bayar" required/>
                    <span class="input-group-addon" style="padding-top: 10px">
                              <span class="fa fa-calendar-o"></span>
                            </span>
                  </div>
                </div>
              </div>                                                  
              <br>
              
              <div class="modal-footer">  
                <button type="submit" class="btn btn-success">Bayar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
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
                source: "<?php echo site_url('admin/bayar_catering/get_autocomplete');?>",
                select: function (event, ui) {
                    $('[name="nama_siswa"]').val(ui.item.label); 
                    $('[name="nis"]').val(ui.item.nomor);
                    $('[name="kelas"]').val(ui.item.kelas);
                    $('[name="biaya_catering"]').val(ui.item.biaya); 
                }
            });

    });
  </script>

  <script>
      function deleteConfirm(url){
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
      }

      // function bayarsppConfirm(url){
      //   $('#btn-bayar').attr('href', url);
      //   $('#bayarModal').modal();
      // }
    </script>


    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url('assets/moment/min/moment.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>

    <script src="<?php echo base_url().'js/jquery-ui.js'?>" type="text/javascript"></script>

    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url('assets/moment/min/moment.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>

    <script src="<?php echo base_url().'js/jquery-ui.js'?>" type="text/javascript"></script>

    <!-- bootstrap-datetimepicker -->    
    <script src="<?php echo base_url('assets/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') ?>"></script>

    <!-- Initialize datetimepicker -->
    <script  type="text/javascript">
        $('.myDatepicker2').datetimepicker({
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
