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

              <div class="x_panel">
                <div class="x_title">
                  <h2>Data Pembayaran Angsuran Daftar Ulang</h2>
                  <ul class="nav navbar-right panel_toolbox"><a href="#"  data-toggle="modal" data-target="#filterModal" class="btn btn-info"><i class="fa fa-filter"></i> Filter</a></ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="row">

                    <div class="col-sm-12">
                      <div class="card-box table-responsive">
                       <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th>No. Cicil</th>
                              <th>Nama Siswa</th>
                              <th>Kelas</th>
                              <th>Tahun Ajaran</th>
                              <th>Tanggal Bayar </th>
                              <th>Nominal</th>
                              
                            </tr>
                          </thead>
                          <tbody>
                            <?php $j = 1; ?>
                            <?php foreach ($cicil as $cicil): ?>
                            <tr>
                              <td align="center" width="10%"><?php echo $j ?></td>
                              <td><?php echo $cicil->nama_siswa ?></td>
                              <td width="10" align="center"><?php 
                              if ($cicil->kelas != 99){
                              echo $cicil->kelas_nama;   
                                }else{
                                  echo "Alumni";
                                }
                              ?></td>
                              <td align="center"><?php echo $cicil->tahun_ajaran?> 
                              </td>
                              <td align="center"><?php echo $cicil->tanggal_bayar_daftarulang?> 
                              </td>
                              
                              <td>Rp. <?php $this->load->helper('rupiah_helper'); echo rupiah($cicil->nominal) ?></td>
                            </tr>
                            <?php $j++; ?>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <!-- /DataTables -->


          </div>
          <br />

        </div>
        <!-- /page content -->

        <!-- modal -->
        <!-- Filter Modal -->
        <div class="modal fade" id="filterModal" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
              <h4 class="modal-title"> Filter </h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
            <div class="modal-body">
            <form role="form" action="<?php echo site_url('admin/daftar_ulang/getCicilByKelasPeriodeTahun') ?>" method="post">
              <div class="form-group col-md-12 col-sm-12">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Kelas : </label>
                <div class="col-md-3 col-sm-3 ">
                  <select class="select2_single form-control" name="kelas" tabindex="-1">
                    <option value=0>Semua Kelas</option>
                      <?php 
                        for($i=1 ; $i <=6 ; $i++){
                          echo '<option value='.$i.'>'.$i.' </option>';
                        }  
                      ?>
                      <option value=99>Alumni</option>
                  </select>
                </div>
                <div class="col-md-3 col-sm-3 ">
                  <select class="select2_single form-control" name="nama_kelas" tabindex="-1">
                    <option value="">Semua</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                  </select>
                </div>
              </div>

              <div class="form-group col-md-12 col-sm-12">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Tahun Ajaran : </label>
                <div class="col-md-6 col-sm-6 ">
                  <select class="select2_single form-control" name="tahun_ajaran" tabindex="-1">
                    <option value="">Semua</option>;
                    <?php foreach ($tahun_ajaran as $tahun_ajaran): ?>
                      <option value="<?= $tahun_ajaran->tahun_ajaran ?>"><?php echo $tahun_ajaran->tahun_ajaran ?></option>;
                    <?php endforeach; ?>     
                  </select>
                </div>
              </div>

              <br>
              <div class="modal-footer">  
                <button type="submit" class="btn btn-success">Filter</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
        

        <!-- Logout Delete Confirmation-->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>
              </div>
            </div>
          </div>
        </div>




        <!-- footer content -->
        <?php $this->load->view("admin/_partials/footer.php") ?>
        <!-- /footer content -->
      </div>
    </div>
<!-- MODAL -->
    <?php $this->load->view("admin/_partials/modal.php") ?>    
    <!-- js -->
     <!-- jQuery -->
    <script src="<?php echo base_url('assets/jquery/dist/jquery.min.js') ?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url('assets/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url('assets/fastclick/lib/fastclick.js') ?>"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url('assets/nprogress/nprogress.js') ?>"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url('assets/iCheck/icheck.min.js') ?>"></script>

    <!-- Datatables -->
    <script src="<?php echo base_url('assets/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/datatables.net-buttons/js/dataTables.buttons.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/datatables.net-buttons/js/buttons.flash.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/datatables.net-buttons/js/buttons.html5.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/datatables.net-keytable/js/dataTables.keyTable.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/datatables.net-responsive/js/dataTables.responsive.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/datatables.net-responsive-bs/js/responsive.bootstrap.js') ?>"></script>
    <script src="<?php echo base_url('assets/datatables.net-scroller/js/dataTables.scroller.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/jszip/dist/jszip.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/pdfmake/build/pdfmake.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/pdfmake/build/vfs_fonts.js') ?>"></script>

    <!-- Datatable DSC -->
    <script type="text/javascript">
      $(document).ready(function() {
        $('#list_daftar_ulang').DataTable( {
          "order": [[ 0, "desc" ]]
        } );
      } );

    </script>


    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('js/custom.min.js') ?>"></script>

    <!-- uang --> 
    <script src="<?php echo base_url('https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js') ?>"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        // Format mata uang.
        $( '.uang' ).mask('0.000.000.000', {reverse: true});
    })
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

  </body>
</html>
