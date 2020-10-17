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
              <div class="x_panel">
                <div class="x_title">
                  <h2>Data Kelas </h2>
                  <ul class="nav navbar-right panel_toolbox"><a href="<?php echo site_url('admin/kelas/add') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Kelas</a></ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card-box table-responsive">
                       <table id="datatable" class="table table-striped table-bordered" style="width:50%; text-align: center; margin: 0px auto;">
                          <thead>
                            <tr>
                              <th>Kelas</th>
                              <th>Biaya SPP</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($kelas as $data_kelas): ?>
                            <tr>
                              <td width="50"><?php echo $data_kelas->nama_kelas ?></td>
                              <td width="70">Rp. <?php $this->load->helper('rupiah_helper'); echo rupiah($data_kelas->biaya_spp) ?></td>
                              <td width="150" align="center">
                                <a href="<?php echo site_url('admin/kelas/edit/'.$data_kelas->id_kelas) ?>" style="margin-right: 10px"><i class="fa fa-edit"></i> Edit</a>
                                <a onclick="deleteConfirm('<?php echo site_url('admin/kelas/delete/'.$data_kelas->id_kelas) ?>')" href="#!" ><i class="fa fa-trash"></i> Hapus</a></td>
                            </tr>
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
    <?php $this->load->view("admin/_partials/modal.php") ?>
    
    <!-- jQuery -->
    <?php $this->load->view("admin/_partials/js.php") ?>
    <script>
      function deleteConfirm(url){
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
      }
    </script>
	
  </body>
</html>
