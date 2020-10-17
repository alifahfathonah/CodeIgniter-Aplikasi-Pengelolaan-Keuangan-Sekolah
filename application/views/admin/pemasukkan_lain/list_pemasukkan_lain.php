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
                  <h2>Data Pemasukkan Lainnya</h2>
                  <ul class="nav navbar-right panel_toolbox"><a href="#"  data-toggle="modal" data-target="#filterModal" class="btn btn-info"><i class="fa fa-filter"></i> Filter</a></ul>
                  <ul class="nav navbar-right panel_toolbox"><a href="<?php echo site_url('admin/pemasukkan_lain/add') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Pemasukkan Lain</a></ul>
                  <!-- <ul class="nav navbar-right panel_toolbox"><a href="#"  data-toggle="modal" data-target="#tambahPemasukkanLain" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Pemasukkan Lain</a></ul> -->
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="row">

                    <div class="col-sm-12">
                      <div class="card-box table-responsive">
                       <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th style="text-align: center; width: 5%">No.</th>
                              <th style="width: 10%">Kategori</th>
                              <th style="text-align: center; width: 10%">Tanggal</th>
                              <th style="text-align: center; width: 10%">Nominal(Rp.)</th>
                              <th style="width: 20%">Keterangan</th>
                              <th style="width: 10%">Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $j = 1; ?>
                            <?php foreach ($pemasukkan_lain as $pemasukkan_lain): ?>
                            <tr>
                              <td align="center"><?php echo $j ?></td>
                              <td><?php echo $pemasukkan_lain->nama_kategori_pemasukkan_lain ?></td>
                              <td align="center"><?php echo $pemasukkan_lain->tanggal_pemasukkan_lain ?></td>
                              <td align="right" style="padding-right: 40px"><?php $this->load->helper('rupiah_helper'); echo rupiah($pemasukkan_lain->nominal_pemasukkan_lain) ?></td>
                              <td><?php echo $pemasukkan_lain->keterangan_pemasukkan_lain?> 
                              </td>
                              <td align="center">
                                <a href="#"  data-toggle="modal" data-target="#editModal<?php echo $pemasukkan_lain->no_pemasukkan_lain; ?>" style="margin-right: 9px" ><i class="fa fa-edit"></i> Edit </a>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal<?php echo $pemasukkan_lain->no_pemasukkan_lain; ?>" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
              <h4 class="modal-title"> Edit No. <?php echo $pemasukkan_lain->no_pemasukkan_lain ?> </h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
            <div class="modal-body">
            <form role="form" action="<?php echo site_url('admin/pemasukkan_lain/editPemasukkanLain/'.$pemasukkan_lain->no_pemasukkan_lain) ?>" method="post">
              <div class="form-group col-md-12 col-sm-12">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Nama Kategori : </label>
                <div class="col-md-6 col-sm-6 ">
                  <select class="select2_single form-control" name="kategori" tabindex="-1">
                      <?php foreach ($kategori as $kategori1): ?>
                        <?php if ($kategori1->id_kategori_pemasukkan_lain == $pemasukkan_lain->id_kategori_pemasukkan_lain) { ?>
                          <option value="<?php echo $kategori1->id_kategori_pemasukkan_lain ?>" selected><?php echo $kategori1->nama_kategori_pemasukkan_lain ?></option>
                      <?php } else { ?>
                          <option value="<?php echo $kategori1->id_kategori_pemasukkan_lain ?>"><?php echo $kategori1->nama_kategori_pemasukkan_lain ?></option>
                      <?php } 
                      endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Tanggal Pembayaran : </label>
                <div class='col-md-6 col-sm-6'>
                  <div class='input-group date myDatepicker2' >
                    <input type="text" class="form-control" placeholder="Tanggal Bayar" name="tanggal_bayar" required value="<?php echo $pemasukkan_lain->tanggal_pemasukkan_lain ?>" />
                    <span class="input-group-addon" style="padding-top: 10px">
                              <span class="fa fa-calendar-o"></span>
                      </span>
                  </div>
                </div>
              </div>

              <div class="form-group col-md-12 col-sm-12">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Nominal (Rp) : </label>
                <div class="col-md-6 col-sm-6 ">
                  <input class="form-control <?php echo form_error('biaya_catering') ? 'is-invalid':'' ?>" type="number" min=0 name="nominal" placeholder="0" required value="<?php echo $pemasukkan_lain->nominal_pemasukkan_lain ?>"/>
                </div>
              </div>

              <div class="form-group col-md-12 col-sm-12">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Keterangan : </label>
                <div class="col-md-6 col-sm-6 ">
                  <textarea class="form-control" name="keterangan_pemasukkan_lain" required><?php echo $pemasukkan_lain->keterangan_pemasukkan_lain ?></textarea>
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



                                <a onclick="deleteConfirm('<?php echo site_url('admin/pemasukkan_lain/deletePemasukkanLain/'.$pemasukkan_lain->no_pemasukkan_lain) ?>')" href="#!" ><i class="fa fa-trash"></i> Hapus</a>
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
            <form role="form" action="<?php echo site_url('admin/pemasukkan_lain/getPemasukkanLainByKategoriBulanTahun') ?>" method="post">
              <div class="form-group col-md-12 col-sm-12">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Kategori : </label>
                <div class="col-md-6 col-sm-6 ">
                  <select class="select2_single form-control" name="kategori" tabindex="-1">
                      <option value=0>Semua</option>
                      <?php foreach ($kategori as $kategori1): ?>
                          <option value="<?php echo $kategori1->id_kategori_pemasukkan_lain ?>"><?php echo $kategori1->nama_kategori_pemasukkan_lain ?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="form-group col-md-12 col-sm-12">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Bulan Bayar : </label>
                <div class="col-md-6 col-sm-6 ">
                  <select class="select2_single form-control" name="bulan" tabindex="-1">
                    <option value="0">Semua</option>;
                    <option value="01">Januari</option>;
                    <option value="02">Februari</option>;
                    <option value="03">Maret</option>;
                    <option value="04">April</option>;
                    <option value="05">Mei</option>;
                    <option value="06">Juni</option>;
                    <option value="07">Juli</option>;
                    <option value="08">Agustus</option>;
                    <option value="09">September</option>;
                    <option value="10">Oktober</option>;
                    <option value="11">November</option>;
                    <option value="12">Desember</option>;   
                  </select>
                </div>
              </div>

              <div class="form-group col-md-12 col-sm-12">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Tahun Bayar : </label>
                <div class="col-md-6 col-sm-6 ">
                  <select class="select2_single form-control" name="tahun" tabindex="-1">
                    <option value="">Semua</option>;
                    <?php foreach ($tahun as $tahun): ?>
                      <option value="<?php echo $tahun->tahun ?>"><?php echo $tahun->tahun ?></option>;
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

      <!-- Tambah K Modal -->
        <div class="modal fade" id="tambahPemasukkanLain" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              <h4 class="modal-title"> Tambah Pemasukkan Lainnya </h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
            <div class="modal-body">
            <form role="form" action="<?php echo site_url('admin/pemasukkan_lain/addPemasukkanLain') ?>" method="post">
              <div class="form-group col-md-12 col-sm-12">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Nama Kategori : </label>
                <div class="col-md-6 col-sm-6 ">
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
                <div class='col-md-6 col-sm-6'>
                  <div class='input-group date myDatepicker2' >
                    <input type="text" class="form-control" placeholder="Tanggal Bayar" name="tanggal_bayar" required/>
                    <span class="input-group-addon" style="padding-top: 10px">
                      <span class="fa fa-calendar-o"></span>
                    </span>
                  </div>
                </div>
              </div>

              <div class="form-group col-md-12 col-sm-12">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Nominal (Rp) : </label>
                <div class="col-md-6 col-sm-6 ">
                  <input class="form-control <?php echo form_error('biaya_catering') ? 'is-invalid':'' ?>" type="number" min=0 name="nominal" placeholder="0" required/>
                </div>
              </div>

              <div class="form-group col-md-12 col-sm-12">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Nama Siswa* : </label>
                <div class="col-md-6 col-sm-6 ">
                  <input class="form-control <?php echo form_error('nama_siswa') ? 'is-invalid':'' ?>" type="text" id="nama_siswa" name="nama_siswa" placeholder="Nama Siswa"/>
                </div>
              </div>
              <div class="form-group col-md-12 col-sm-12">
                <label class="col-form-label col-md-4 col-sm-4 label-align"></label>
                <div class="col-md-6 col-sm-6 ">
                  <a style="font-size: 10px">*Kosongkan jika tidak dibutuhkan</a>
                </div>
              </div>

              <div class="form-group col-md-12 col-sm-12">
                <label class="col-form-label col-md-4 col-sm-4 label-align">Keterangan : </label>
                <div class="col-md-6 col-sm-6 ">
                  <textarea class="form-control" name="keterangan_pemasukkan_lain" required></textarea>
                </div>
              </div>

              <br>
              <div class="modal-footer">  
                <button type="submit" class="btn btn-success">Tambah</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
        

        <!-- Delete Confirmation-->
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
