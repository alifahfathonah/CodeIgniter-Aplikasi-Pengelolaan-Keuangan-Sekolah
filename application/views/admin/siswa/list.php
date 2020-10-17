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
                  <h2>Data Siswa </h2>
                  
                  <!-- <ul class="nav navbar-right panel_toolbox"><a href="<?php echo site_url('admin/siswa/add') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Siswa</a></ul>
                   -->
                   <ul class="nav navbar-right panel_toolbox"><a href="#"  data-toggle="modal" data-target="#filterModal" class="btn btn-info"><i class="fa fa-filter"></i> Filter</a></ul>
                   <ul class="nav navbar-right panel_toolbox"><a href="#"  data-toggle="modal" data-target="#tambahModal" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Siswa</a></ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card-box table-responsive">
                       <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th width="5%">No.</th>
                              <th>NIS</th>
                              <th>Nama Siswa</th>
                              <th>Kelas</th>
                              <th>Biaya SPP(Rp.)</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $j = 1; ?>
                            <?php foreach ($data_siswa as $siswa): ?>
                            <tr>
                              <td align="center"><?php echo $j ;?></td>
                              <td width="70"><?php echo $siswa->NIS ?></td>
                              <td><?php echo $siswa->nama_siswa ?></td>
                              <td width="50" align="center">
                                <?php if($siswa->kelas == 99){
                                  echo "Alumni";
                                }else{
                                  echo $siswa->kelas_nama;  
                                }
                                ?>
                              </td>
                              <td width="120" align="right">
                                <?php $this->load->helper('rupiah_helper'); echo rupiah($siswa->biaya_spp) ?>
                              </td>
                              <td width="150" align="center">
                                <a href="#"  data-toggle="modal" data-target="#editModal<?php echo $siswa->NIS; ?>" href="<?php echo site_url('admin/siswa/edit/'.$siswa->NIS) ?>" style="margin-right: 10px"><i class="fa fa-edit"></i> Edit</a>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal<?php echo $siswa->NIS; ?>" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title"> Edit No. <?php echo $siswa->NIS ?> </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <form role="form" action="<?php echo site_url('admin/siswa/edit/'.$siswa->NIS) ?>" method="post">
                  <div class="form-group col-md-12 col-sm-12">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Nama Siswa : </label>
                    <div class="col-md-6 col-sm-6 ">
                      <input class="form-control <?php echo form_error('nama_siswa') ? 'is-invalid':'' ?>" type="text" name="nama_siswa" placeholder="Nama Siswa" value="<?php echo $siswa->nama_siswa ?>"/>
                    </div>
                  </div>
                  <div class="form-group col-md-12 col-sm-12">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Kelas : </label>
                    <div class='col-md-3 col-sm-3'>
                      <select class="select2_single form-control form-control-sm" name="kelas" tabindex="-1">      
                            <?php 
                              for($i=1 ; $i <=6 ; $i++){
                                if($siswa->kelas == $i){ 
                                  echo '<option value='.$i.' selected="true" >'.$i.' </option>';
                                }else{
                                  echo '<option value='.$i.'>'.$i.' </option>';
                                }
                              }
                              if($siswa->kelas == 99){
                                echo '<option value=99 selected="true" >Alumni </option>';
                              }else{
                                echo '<option value=99 >Alumni </option>';
                              } 
                              
                            ?>

                      </select>
                    </div>
                    <div class='col-md-3 col-sm-3'>
                      <select class="select2_single form-control form-control-sm" name="nama_kelas" tabindex="-1">
                            <?php 
                              if($siswa->nama_kelas == "A"){ 
                                  echo '<option value="A" selected="true" >A</option>';
                                }else{
                                  echo '<option value="A">A</option>';
                                }
                              if($siswa->kelas == "B"){
                                echo '<option value="B" selected="true" >B</option>';
                              }else{
                                echo '<option value="B">B</option>';
                              } 
                              
                            ?>

                      </select>
                    </div>
                  </div>
                  <div class="form-group col-md-12 col-sm-12">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Biaya SPP (Rp) : </label>
                    <div class="col-md-6 col-sm-6 ">
                      <input class="form-control <?php echo form_error('biaya_spp') ? 'is-invalid':'' ?>" type="number" min="0" name="biaya_spp" placeholder="Biaya SPP" value="<?php echo $siswa->biaya_spp ?>"/>
                    </div>
                  </div>
                  <br>
                  <div class="modal-footer">  
                    <button type="submit" class="btn btn-success">Edit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

                                <a onclick="deleteConfirm('<?php echo site_url('admin/siswa/delete/'.$siswa->NIS) ?>')" href="#!" ><i class="fa fa-trash"></i> Hapus</a></td>
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
            <form role="form" action="<?php echo site_url('admin/siswa/getSiswaByKelas') ?>" method="post">
              <div class="form-group col-md-12 col-sm-12">
                <label class="col-form-label col-md-2 col-sm-2 label-align">Kelas : </label>
                <div class="col-md-4 col-sm-4 ">
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
                <div class="col-md-4 col-sm-4 ">
                  <select class="select2_single form-control" name="nama_kelas" tabindex="-1">
                    <option value="">Semua</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
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

        <!-- Tambah Modal -->
        <div class="modal fade" id="tambahModal" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title"> Tambah Siswa </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <div class="col-md-12 col-sm-12">  
                    <div class="col-md-6 col-sm-6" align="center">
                      <a href="#"  data-toggle="modal" data-target="#tambahExcelModal" class="btn btn-success"><i class="fa fa-plus"></i> Upload Excel</a>
                      
                    </div>
                    <div class="col-md-6 col-sm-6" align="center">
                      <a href="#"  data-toggle="modal" data-target="#tambahManualModal" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Manual</a>
                      
                    </div>
                  </div> 
                  
                
                  
              </div>
              <div class="modal-footer">
                <div class="col-md-12 col-sm-12">  
                    <div class="col-md-12">
                      
                    </div>
                  </div>

              </div>
            </div>
          </div>
        </div>

        <!-- Tambah via Upload Excel Modal -->
        <div class="modal fade" id="tambahExcelModal" role="dialog">
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
                        <a href="<?php print base_url('assets/uploads/sample1-xlsx.xlsx') ?>" class="btn btn-link btn-sm"><i class="fa fa-file-excel"></i> Sample .XLSX</a>
                        <a href="<?php print base_url('assets/uploads/sample-xls.xls') ?>" class="btn btn-link btn-sm"><i class="fa fa-file-excel"></i> Sample .XLS</a>
                        <a href="<?php print base_url('assets/uploads/sample-csv.csv') ?>" class="btn btn-link btn-sm" target="_blank" ><i class="fa fa-file-csv"></i> Sample .CSV</a>
                      </div> 
                    </div>
                  </div>

              </div>
            </div>
          </div>
        </div>


        <!-- Tambah Manual Modal -->
        <div class="modal fade" id="tambahManualModal" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title"> Form Tambah Siswa </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <div class="col-md-12 col-sm-12">  
                    <form action="<?php echo site_url('admin/Siswa/add') ?>" method="post" enctype="multipart/form-data" >
                    
                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="NIS">NIS</label>
                      <div class="col-md-6 col-sm-6 ">
                        <input class="form-control <?php echo form_error('nis') ? 'is-invalid':'' ?>" type="text" name="nis" placeholder="Nomor Induk Siswa" required />
                      </div>
                      <div class="invalid-feedback">
                        <?php echo form_error('nis') ?>
                      </div>
                    </div>

                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_siswa">Nama Siswa</label>
                      <div class="col-md-6 col-sm-6 ">
                        <input class="form-control <?php echo form_error('nama_siswa') ? 'is-invalid':'' ?>" type="text" name="nama_siswa" placeholder="Nama Siswa" required/>
                      </div>
                      <div class="invalid-feedback">
                        <?php echo form_error('nama_siswa') ?>
                      </div>
                    </div>

                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="kelas">Kelas</label>
                      <div class="col-md-3 col-sm-3 ">
                        <select class="select2_single form-control" name="kelas" tabindex="-1">
                            <?php 
                              for($i=1 ; $i <=6 ; $i++){
                                echo '<option value='.$i.'>'.$i.' </option>';
                                }  
                            ?>
                        </select>
                      </div>
                      <div class="col-md-3 col-sm-3 ">
                        <select class="select2_single form-control" name="nama_kelas" tabindex="-1">
                          <option value="A">A</option>
                          <option value="B">B</option>
                        </select>
                      </div>
                      <div class="invalid-feedback">
                        <?php echo form_error('kelas') ?>
                      </div>
                    </div>

                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="biaya_spp">Biaya SPP</label>
                      <div class="col-md-6 col-sm-6 ">
                        <input class="form-control <?php echo form_error('biaya_spp') ? 'is-invalid':'' ?>" type="number" min="0" name="biaya_spp" placeholder="Biaya SPP" required />
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
                  
                
                  
              </div>
              <div class="modal-footer">
                <div class="col-md-12 col-sm-12">  
                    <div class="col-md-12">
                      
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
