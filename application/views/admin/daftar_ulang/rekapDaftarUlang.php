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
              <div class="card-body">
                <div class="x_title" style="margin-bottom: 30px;">
                  <h2>Rekap Pembayaran Daftar Ulang </h2>
                  <div class="clearfix"></div>

                </div>

                <div>
                  <form action="<?php echo site_url('admin/daftar_ulang/rekapDaftarUlangGo') ?>" method="post" enctype="multipart/form-data" >

                    <div class="item form-group col-md-12 col-sm-12">
                      <label class="col-form-label col-md-1 col-sm-1 label-align" for="nama_siswa">Tahun Ajaran : </label>
                      <div class="col-md-4 col-sm-4 ">
                        <select class="select2_single form-control" name="tahun_ajaran" tabindex="-1">

                          <?php foreach ($tahun_ajaran as $tahun_ajaran): ?>
                            <?php if($tahun_ajaran->tahun_ajaran == $tahunAjaran){ ?>
                              <option value="<?php echo $tahun_ajaran->tahun_ajaran ?>" selected><?php echo $tahun_ajaran->tahun_ajaran ?></option>;
                            <?php } else { ?>
                              <option value="<?php echo $tahun_ajaran->tahun_ajaran ?>"><?php echo $tahun_ajaran->tahun_ajaran ?></option>;

                            <?php } ?>

                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="col-md-2 col-sm-2 label-align">
                        <button type="submit" class="btn btn-success">Go!</button>

                      </div>

                      
                    </div>
                  </form>
                </div>



                

              </div><!-- /card Body-->

            </div> <!-- /card mb3-->

            <div class="card mb-3">

              <div class="card-body">
                <div class="x_title" >
                  <h2><?php echo $tahunAjaran ?></h2>
                  <div class="clearfix"></div>

                </div>

                <div class="x_content">
                 <div class="row col-sm-12 col-md-12" style="display: inline-block;" align="center" >
                  <div class="top_tiles" >
                    <div class="col-md-4 col-sm-4  tile">
                      <span>Daftar Ulang Terbayar</span>
                      <h2>Rp. <?php $this->load->helper('rupiah_helper'); echo rupiah($daftar_ulang_terbayar->total) ?></h2>
                    </div>
                    <div class="col-md-4 col-sm-4  tile">
                      <span>Daftar Ulang Belum dibayar</span>
                      <h2>Rp. <?php $this->load->helper('rupiah_helper'); echo rupiah($daftar_ulang_belum_terbayar) ?></h2>
                    </div>
                    <div class="col-md-4 col-sm-4  tile">
                      <span>Target Daftar Ulang</span>
                      <h2>Rp. <?php $this->load->helper('rupiah_helper'); echo rupiah($target_pembayaran->total) ?></h2>
                    </div>

                  </div>
                </div>

              </div>



            </div>

            <div class="card-body">


              <div class="x_content">




                <div id="echart_pieSPP" style="height:450px;"></div>

              </div>



            </div>

          </div> 

          <div class="card mb-3">
            <div class="x_panel">
              <div class="x_title">
                <h2> Data Siswa Daftar Ulang <?php echo $tahunAjaran ?></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#lunas1" role="tab" aria-controls="home" aria-selected="true">Lunas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#belumlunas1" role="tab" aria-controls="profile" aria-selected="false">Belum Lunas</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="lunas1" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card-box table-responsive width">
                     <table class="display table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>NIS</th>
                          <th>Nama</th>
                          <th>Kelas</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $i = 1;
                        foreach ($siswa_lunas as $siswa_lunas): ?>
                          <tr>
                            <td width=10><?php echo $i ?></td>
                            <td><?php echo $siswa_lunas->NIS ?></td>
                            <td><?php echo $siswa_lunas->nama_siswa ?></td>
                            <td align="center"><?php 
                            if($siswa_lunas->kelas == 99){
                              echo "Alumni";
                            }else{
                              echo $siswa_lunas->kelas.$siswa_lunas->nama_kelas;
                            }
                            ?></td>
                            <td align="center">
                              <a href="<?php echo site_url('admin/daftar_ulang/detail/'.$siswa_lunas->no_bayar_daftar_ulang) ?>" style="margin-right: 9px" ><i class="fa fa-money"></i> Detail </a>
                            </td>
                          </tr> 

                          <?php $i++; endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="belumlunas1" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card-box table-responsive">
                     <table class="display table table-striped table-bordered " style="width:100%">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>NIS</th>
                          <th>Nama</th>
                          <th>Kelas</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $i = 1;
                        foreach ($siswa_blmlunas as $siswa_blmlunas): ?>
                          <tr>
                            <td width=10><?php echo $i ?></td>
                            <td><?php echo $siswa_blmlunas->NIS ?></td>
                            <td><?php echo $siswa_blmlunas->nama_siswa ?></td>
                            <td align="center"><?php 
                            if($siswa_blmlunas->kelas == 99){
                              echo "Alumni";
                            }else{
                              echo $siswa_blmlunas->kelas.$siswa_blmlunas->nama_kelas;
                            }
                            ?></td>
                            <td align="center">
                              <a href="<?php echo site_url('admin/daftar_ulang/detail/'.$siswa_blmlunas->no_bayar_daftar_ulang) ?>" style="margin-right: 9px" ><i class="fa fa-money"></i> Detail </a>
                            </td>
                          </tr> 

                          <?php $i++; endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>

                </div>

              </div>
            </div>
          </div>

          <div class="card mb-3">
            <div class="x_panel">
              <div class="x_title">
                <h2> Laporan Daftar Ulang <?php echo $tahunAjaran ?></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <!-- <h2>Laporan Kelas <?php echo $i ?></h2> -->

                <div class="card-box table-responsive">
                  <div align="right">
                    <a href="<?php echo site_url('admin/rekapitulasi/printRekapDaftarUlang/'.$tahunAjaran) ?>" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Excel</a>
                  </div>

                 <table class="table table-striped table-bordered " style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Target</th>
                      <th>SPP</th>
                      <th>Seragam</th>
                      <th>Kegiatan Siswa</th>
                      <th>SPI</th>
                      <th>Pembukaan Rek</th>
                      <th>Terbayar</th>
                      <th>Hutang</th>
                    </tr>

                    <tr>
                    </thead>
                    <tbody>
                      <?php 
                      $j = 1;
                      foreach ($lapDaftarUlangByKelas as $lapDaftarUlangByKelas): ?>

                        <tr>
                          <?php if($lapDaftarUlangByKelas->nama != "TOTAL") {  ?>  
                            <td width=10><?php echo $j ?></td>
                            <td><?php 
                            if($lapDaftarUlangByKelas->nama != 99 ){
                              echo "Kelas ".$lapDaftarUlangByKelas->nama;
                            }else {
                              echo "Alumni";
                            }?>
                          </td>
                          <td align="right"><?php echo rupiah($lapDaftarUlangByKelas->target) ?></td>
                          <td align="right"><?php echo rupiah($lapDaftarUlangByKelas->spp) ?></td>
                          <td align="right"><?php echo rupiah($lapDaftarUlangByKelas->seragam) ?></td>
                          <td align="right"><?php echo rupiah($lapDaftarUlangByKelas->keg_siswa) ?></td>
                          <td align="right"><?php echo rupiah($lapDaftarUlangByKelas->spi) ?></td>
                          <td align="right"><?php echo rupiah($lapDaftarUlangByKelas->pembukaan_rek) ?></td>
                          <td align="right"><?php echo rupiah($lapDaftarUlangByKelas->terbayar) ?></td>
                          <td align="right"><?php echo rupiah($lapDaftarUlangByKelas->hutang) ?></td>
                        <?php } else { ?>
                          <td colspan="2" align="center" style="font-weight: bold;"><?php echo $lapDaftarUlangByKelas->nama ?></td>
                          <td align="right" style="font-weight: bold;"><?php echo rupiah($lapDaftarUlangByKelas->target) ?></td>
                          <td align="right" style="font-weight: bold;"><?php echo rupiah($lapDaftarUlangByKelas->spp) ?></td>
                          <td align="right" style="font-weight: bold;"><?php echo rupiah($lapDaftarUlangByKelas->seragam) ?></td>
                          <td align="right" style="font-weight: bold;"><?php echo rupiah($lapDaftarUlangByKelas->keg_siswa) ?></td>
                          <td align="right" style="font-weight: bold;"><?php echo rupiah($lapDaftarUlangByKelas->spi) ?></td>
                          <td align="right" style="font-weight: bold;"><?php echo rupiah($lapDaftarUlangByKelas->pembukaan_rek) ?></td>
                          <td align="right" style="font-weight: bold;"><?php echo rupiah($lapDaftarUlangByKelas->terbayar) ?></td>
                          <td align="right" style="font-weight: bold;"><?php echo rupiah($lapDaftarUlangByKelas->hutang) ?></td>
                        <?php } ?>

                      </tr> 

                      <?php $j++; endforeach; ?>

                    </tbody>
                  </table>
                </div>

<br>

                <!-- Tabel Per Kelas -->

                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#kelas1" role="tab" aria-controls="home" aria-selected="true">Kelas 1</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#kelas2" role="tab" aria-controls="profile" aria-selected="false">Kelas 2</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#kelas3" role="tab" aria-controls="profile" aria-selected="false">Kelas 3</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#kelas4" role="tab" aria-controls="profile" aria-selected="false">Kelas 4</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#kelas5" role="tab" aria-controls="profile" aria-selected="false">Kelas 5</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#kelas6" role="tab" aria-controls="profile" aria-selected="false">Kelas 6</a>
                  </li>
                </ul>

                <div class="tab-content" id="myTabContent">

                <?php for($i=1;$i<=6;$i++) { 
                  if ($i == 1){ ?>
                    <div class="tab-pane fade show active" id='<?php echo "kelas".$i ?>' role="tabpanel" aria-labelledby="home-tab">
                      <div class="card-box table-responsive width">
                        <h2>Laporan Kelas <?php echo $i ?></h2>

                      <div class="card-box table-responsive">
                       <table class="table table-striped table-bordered " style="width:100%">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Nama</th>
                              <th>Kelas</th>
                              <th>Target</th>
                              <th>SPP</th>
                              <th>Seragam</th>
                              <th>Kegiatan Siswa</th>
                              <th>SPI</th>
                              <th>Pembukaan Rek</th>
                              <th>Terbayar</th>
                              <th>Hutang</th>
                            </tr>

                            <tr>
                          </thead>
                          <tbody>
                            <?php 
                              $j = 1;
                            foreach (${'listSiswaDaftarUlang'.$i} as ${'listSiswaDaftarUlang'.$i}): ?>
                              
                            <tr>
                              <?php if((${'listSiswaDaftarUlang'.$i}->nama != NULL) AND (${'listSiswaDaftarUlang'.$i}->target != NULL)  ) {?>
                                <?php if(${'listSiswaDaftarUlang'.$i}->nama != "TOTAL") {  ?>  
                                  <td width=10><?php echo $j ?></td>
                                  <td><?php echo ${'listSiswaDaftarUlang'.$i}->nama ?></td>
                                  <td align="center"><?php echo ${'listSiswaDaftarUlang'.$i}->kelas_nama ?></td>
                                  <td align="right"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->target) ?></td>
                                  <td align="right"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->spp) ?></td>
                                  <td align="right"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->seragam) ?></td>
                                  <td align="right"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->keg_siswa) ?></td>
                                  <td align="right"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->spi) ?></td>
                                  <td align="right"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->pembukaan_rek) ?></td>
                                  <td align="right"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->terbayar) ?></td>
                                  <td align="right"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->hutang) ?></td>
                                <?php } else { ?>
                                  <td colspan="3" align="center" style="font-weight: bold;"><?php echo ${'listSiswaDaftarUlang'.$i}->nama ?></td>
                                  
                                  <td align="right" style="font-weight: bold;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->target) ?></td>
                                  <td align="right" style="font-weight: bold;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->spp) ?></td>
                                  <td align="right" style="font-weight: bold;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->seragam) ?></td>
                                  <td align="right" style="font-weight: bold;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->keg_siswa) ?></td>
                                  <td align="right" style="font-weight: bold;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->spi) ?></td>
                                  <td align="right" style="font-weight: bold;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->pembukaan_rek) ?></td>
                                  <td align="right" style="font-weight: bold;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->terbayar) ?></td>
                                  <td align="right" style="font-weight: bold;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->hutang) ?></td>
                                <?php } ?>
                              <?php } ?>
                            </tr> 

                            <?php $j++; endforeach; ?>
                        
                           
                          </tbody>
                        </table>
                      </div>

                   <br/>
                      </div>
                  </div>

                  <?php } else {?>
                  <div class="tab-pane fade show" id='<?php echo "kelas".$i ?>' role="tabpanel" aria-labelledby="home-tab">
                      <div class="card-box table-responsive width">
                        <h2>Laporan Kelas <?php echo $i ?></h2>

                      <div class="card-box table-responsive">
                       <table class="table table-striped table-bordered " style="width:100%">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Nama</th>
                              <th>Kelas</th>
                              <th>Target</th>
                              <th>SPP</th>
                              <th>Seragam</th>
                              <th>Kegiatan Siswa</th>
                              <th>SPI</th>
                              <th>Pembukaan Rek</th>
                              <th>Terbayar</th>
                              <th>Hutang</th>
                            </tr>

                            <tr>
                          </thead>
                          <tbody>
                            <?php 
                              $j = 1;
                            foreach (${'listSiswaDaftarUlang'.$i} as ${'listSiswaDaftarUlang'.$i}): ?>
                              
                            <tr>
                              <?php if((${'listSiswaDaftarUlang'.$i}->nama != NULL) AND (${'listSiswaDaftarUlang'.$i}->target != NULL)  ) {?>
                                <?php if(${'listSiswaDaftarUlang'.$i}->nama != "TOTAL") {  ?>  
                                  <td width=10><?php echo $j ?></td>
                                  <td><?php echo ${'listSiswaDaftarUlang'.$i}->nama ?></td>
                                  <td align="center"><?php echo ${'listSiswaDaftarUlang'.$i}->kelas_nama ?></td>
                                  <td align="right"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->target) ?></td>
                                  <td align="right"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->spp) ?></td>
                                  <td align="right"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->seragam) ?></td>
                                  <td align="right"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->keg_siswa) ?></td>
                                  <td align="right"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->spi) ?></td>
                                  <td align="right"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->pembukaan_rek) ?></td>
                                  <td align="right"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->terbayar) ?></td>
                                  <td align="right"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->hutang) ?></td>
                                <?php } else { ?>
                                  <td colspan="3" align="center" style="font-weight: bold;"><?php echo ${'listSiswaDaftarUlang'.$i}->nama ?></td>
                                  
                                  <td align="right" style="font-weight: bold;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->target) ?></td>
                                  <td align="right" style="font-weight: bold;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->spp) ?></td>
                                  <td align="right" style="font-weight: bold;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->seragam) ?></td>
                                  <td align="right" style="font-weight: bold;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->keg_siswa) ?></td>
                                  <td align="right" style="font-weight: bold;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->spi) ?></td>
                                  <td align="right" style="font-weight: bold;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->pembukaan_rek) ?></td>
                                  <td align="right" style="font-weight: bold;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->terbayar) ?></td>
                                  <td align="right" style="font-weight: bold;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->hutang) ?></td>
                                <?php } ?>
                              <?php } ?>
                            </tr> 

                            <?php $j++; endforeach; ?>
                        
                           
                          </tbody>
                        </table>
                      </div>

                   <br/>
                      </div>
                  </div>

                <?php 
                  }
                } ?>
                  </div>


              </div>
            </div>




          </div>





        </div> 

      </div>

    </div>

  </div>


  <!-- /page content -->

  <!-- footer content -->
  <?php $this->load->view("admin/_partials/footer.php") ?>
  <!-- /footer content -->
</div>


<!-- Modal --> 
<?php $this->load->view("admin/_partials/modal.php") ?>





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
<script type="text/javascript">
  $(document).ready(function() {
    $('table.display').DataTable();
  } );


</script>



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
    <script src="<?php echo base_url('assets/echarts/dist/echarts.min.js') ?>"></script>

    <!-- Initialize datetimepicker -->
    <script  type="text/javascript">
      $('.myDatepicker2').datetimepicker({
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
    <script type="text/javascript">

      function init_echarts() {

        if( typeof (echarts) === 'undefined'){ return; }
        console.log('init_echarts');


        var theme = {
          color: [
          '#26B99A', '#34495E', '#BDC3C7', '#3498DB',
          '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
          ],

          title: {
            itemGap: 8,
            textStyle: {
              fontWeight: 'normal',
              color: '#408829'
            }
          },

          dataRange: {
            color: ['#1f610a', '#97b58d']
          },

          toolbox: {
            color: ['#408829', '#408829', '#408829', '#408829']
          },

          tooltip: {
            backgroundColor: 'rgba(0,0,0,0.5)',
            axisPointer: {
              type: 'line',
              lineStyle: {
                color: '#408829',
                type: 'dashed'
              },
              crossStyle: {
                color: '#408829'
              },
              shadowStyle: {
                color: 'rgba(200,200,200,0.3)'
              }
            }
          },

          dataZoom: {
            dataBackgroundColor: '#eee',
            fillerColor: 'rgba(64,136,41,0.2)',
            handleColor: '#408829'
          },
          grid: {
            borderWidth: 0
          },

          categoryAxis: {
            axisLine: {
              lineStyle: {
                color: '#408829'
              }
            },
            splitLine: {
              lineStyle: {
                color: ['#eee']
              }
            }
          },

          valueAxis: {
            axisLine: {
              lineStyle: {
                color: '#408829'
              }
            },
            splitArea: {
              show: true,
              areaStyle: {
                color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
              }
            },
            splitLine: {
              lineStyle: {
                color: ['#eee']
              }
            }
          },
          timeline: {
            lineStyle: {
              color: '#408829'
            },
            controlStyle: {
              normal: {color: '#408829'},
              emphasis: {color: '#408829'}
            }
          },

          k: {
            itemStyle: {
              normal: {
                color: '#68a54a',
                color0: '#a9cba2',
                lineStyle: {
                  width: 1,
                  color: '#408829',
                  color0: '#86b379'
                }
              }
            }
          },
          map: {
            itemStyle: {
              normal: {
                areaStyle: {
                  color: '#ddd'
                },
                label: {
                  textStyle: {
                    color: '#c12e34'
                  }
                }
              },
              emphasis: {
                areaStyle: {
                  color: '#99d2dd'
                },
                label: {
                  textStyle: {
                    color: '#c12e34'
                  }
                }
              }
            }
          },
          force: {
            itemStyle: {
              normal: {
                linkStyle: {
                  strokeColor: '#408829'
                }
              }
            }
          },
          chord: {
            padding: 4,
            itemStyle: {
              normal: {
                lineStyle: {
                  width: 1,
                  color: 'rgba(128, 128, 128, 0.5)'
                },
                chordStyle: {
                  lineStyle: {
                    width: 1,
                    color: 'rgba(128, 128, 128, 0.5)'
                  }
                }
              },
              emphasis: {
                lineStyle: {
                  width: 1,
                  color: 'rgba(128, 128, 128, 0.5)'
                },
                chordStyle: {
                  lineStyle: {
                    width: 1,
                    color: 'rgba(128, 128, 128, 0.5)'
                  }
                }
              }
            }
          },
          gauge: {
            startAngle: 225,
            endAngle: -45,
            axisLine: {
              show: true,
              lineStyle: {
                color: [[0.2, '#86b379'], [0.8, '#68a54a'], [1, '#408829']],
                width: 8
              }
            },
            axisTick: {
              splitNumber: 10,
              length: 12,
              lineStyle: {
                color: 'auto'
              }
            },
            axisLabel: {
              textStyle: {
                color: 'auto'
              }
            },
            splitLine: {
              length: 18,
              lineStyle: {
                color: 'auto'
              }
            },
            pointer: {
              length: '90%',
              color: 'auto'
            },
            title: {
              textStyle: {
                color: '#333'
              }
            },
            detail: {
              textStyle: {
                color: 'auto'
              }
            }
          },
          textStyle: {
            fontFamily: 'Arial, Verdana, sans-serif'
          }
        };


         //echart Pie

         if ($('#echart_pieSPP').length ){  

          var echartPie = echarts.init(document.getElementById('echart_pieSPP'), theme);

          echartPie.setOption({
            tooltip: {
              trigger: 'item',
              formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
              x: 'center',
              y: 'bottom',
              data: ['Lunas', 'Belum Lunas']
            },
            toolbox: {
              show: true,
              feature: {
                magicType: {
                  show: true,
                  type: ['pie', 'funnel'],
                  option: {
                    funnel: {
                      x: '25%',
                      width: '50%',
                      funnelAlign: 'left',
                      max: 1548
                    }
                  }
                },
                restore: {
                  show: true,
                  title: "Restore"
                },
                saveAsImage: {
                  show: true,
                  title: "Save Image"
                }
              }
            },
            calculable: true,
            series: [{
              name: '<?php echo $tahunAjaran ?>',
              type: 'pie',
              radius: '75%',
              center: ['50%', '48%'],
              data: [{
          //value: 50, name: 'Lunas'
          value: <?php echo $jumlah_lunas ?>, name: 'Lunas'
        }, {
          value: <?php echo $jumlah_blmlunas ?>, name: 'Belum Lunas'
        }]
      }]
    });

          var dataStyle = {
            normal: {
              label: {
                show: false
              },
              labelLine: {
                show: false
              }
            }
          };

          var placeHolderStyle = {
            normal: {
              color: 'rgba(0,0,0,0)',
              label: {
                show: false
              },
              labelLine: {
                show: false
              }
            },
            emphasis: {
              color: 'rgba(0,0,0,0)'
            }
          };

        } 
        


      }



    </script>


    

  </body>
  </html>
