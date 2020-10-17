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
              <div class="card mb-3">
                <div class="card-header">
                  <a href="<?php echo site_url('admin/siswa/') ?>"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="card-body">
                <div class="x_title">
                  <h2>Hasil Import</h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card-box table-responsive">
                       <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th>No.</th>
                              <th>NIS</th>
                              <th>Nama Siswa</th>
                              <th>Kelas</th>
                              <th>Biaya SPP</th>
                           
                            </tr>
                          </thead>
                          <tbody>
                            <?php $j = 1; ?>
                            <?php foreach ($data_siswa as $key=>$element): ?>
                            <tr>
                              <td><?php echo $j ;?></td>
                              <td width="70"><?php print $element['NIS'] ?></td>
                              <td><?php print $element['nama_siswa'] ?></td>
                              <td width="50" align="center"><?php print $element['kelas']; print $element['nama_kelas'] ?></td>
                              <td width="100" align="center">
                                Rp. <?php $this->load->helper('rupiah_helper'); print rupiah($element['biaya_spp']) ?>
                              </td>
                              
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
            </div>
              <!-- /DataTables -->


          </div>
          <br />

        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php $this->load->view("admin/_partials/footer.php") ?>
        <!-- /footer content -->
      </div>
    </div>

    <!-- Modal --> 
    <!-- Logout Delete Confirmation-->
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
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


      <!-- Tambah via Upload Modal -->
        <div class="modal fade" id="tambahModal" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title"> Upload Excel </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <?php if(form_error('fileURL')) {?>    
                  <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <?php print form_error('fileURL'); ?>
                  </div>       
                <?php } ?>
                  
          
                  <form action="<?php print site_url();?>/admin/siswa/upload" class="excel-upl" id="excel-upl" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="form-group col-md-12 col-sm-12">
                      <div class="col-md-8 col-sm-8">
                    
                        <input type="file" class="custom-file-input" id="validatedCustomFile" name="fileURL">
                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                      </div>
                      <div class="col-md-4 col-sm-4">
                    
                        <button type="submit" name="import" class="float-right btn btn-primary">Import</button>
                      </div>
                      
                    </div>
                    
                  </form>
              </div>
              <div class="modal-footer">
                <div class="col-md-12 col-sm-12">  
                    <div class="col-md-12">
                      <div> <label>Contoh template excel untuk upload</label>
                      </div>
                      <div class="float-right">  
                        <a href="<?php print base_url('assets/uploads/sample-xlsx.xlsx') ?>" class="btn btn-link btn-sm"><i class="fa fa-file-excel"></i> Sample .XLSX</a>
                        <a href="<?php print base_url('assets/uploads/sample-xls.xls') ?>" class="btn btn-link btn-sm"><i class="fa fa-file-excel"></i> Sample .XLS</a>
                        <a href="<?php print base_url('assets/uploads/sample-csv.csv') ?>" class="btn btn-link btn-sm" target="_blank" ><i class="fa fa-file-csv"></i> Sample .CSV</a>
                      </div> 
                    </div>
                  </div>

              </div>
            </div>
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
    </script>

  

    </script>
  
  </body>
</html>
