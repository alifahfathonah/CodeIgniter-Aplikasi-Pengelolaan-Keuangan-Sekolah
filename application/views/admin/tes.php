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
              
            <!-- DataTables -->
              <div class="card mb-3">
                <div class="card-header">
                  <a href="<?php echo site_url('admin/siswa/add') ?>"><i class="fas fa-plus"></i> Add New</a>
                </div>
                <div class="card-body">

                  <div class="table-responsive">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>NIS</th>
                          <th>Nama Siswa</th>
                          <th>Tahun Masuk</th>
                          <th>Kelas</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data_siswa as $siswa): ?>
                        <tr>
                          <td>
                            <?php echo $siswa->nis ?>
                          </td>
                          <td>
                            <?php echo $siswa->nama_siswa ?>
                          </td>
                          <td>
                            <?php echo $siswa->tahun_masuk ?>
                          </td>
                          <td>
                            <?php echo $siswa->kelas ?> 
                          </td>
                          <td width="250">
                            <a href="<?php echo site_url('admin/siswa/edit/'.$siswa->nis) ?>"
                             class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
                            <a onclick="deleteConfirm('<?php echo site_url('admin/siswa/delete/'.$siswa->nis) ?>')"
                             href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
                          </td>
                        </tr>
                        <?php endforeach; ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <!-- /DataTables -->




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

    <!-- jQuery -->
    <?php $this->load->view("admin/_partials/js.php") ?>
	
  </body>
</html>
