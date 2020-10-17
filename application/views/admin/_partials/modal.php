 <!-- Naik Kelas Modal -->
 <div class="modal fade" id="naikKelasModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Semua siswa akan naik kelas, dan kelas 6 akan menjadi kelas alumni.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <a id="btn-delete" class="btn btn-danger" href="<?php echo site_url('admin/siswa/setNaikKelas') ?>">Naik</a>
      </div>
    </div>
  </div>
</div>

<!-- upload rekapan Modal -->
<div class="modal fade" id="uploadrekap" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">UPLOAD REKAP EXCEL</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo site_url('import/upload') ?>" enctype="multipart/form-data">
          <div class="form-group col-md-12 col-sm-12">
            <div class="col-md-8 col-sm-8">

             <input type="file" name="userfile" class="form-control">
           </div>
           <div class="col-md-4 col-sm-4">

            <button type="submit" class="btn btn-success">UPLOAD</button>
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
            <a href="<?php print base_url('assets/uploads/Contoh-Rekap.xlsx') ?>" class="btn btn-link btn-sm"><i class="fa fa-file-excel"></i> Contoh Template Upload Excel Rekap .XLSX</a>
          </div> 
        </div>
      </div>

    </div>

  </div>
</div>
</div>

<!-- Set Daftar Ulang satu Kelas Modal -->
<div class="modal fade" id="setDaftarUlangModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> Set Daftar Ulang Satu Kelas </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form role="form" action="<?php echo site_url('admin/daftar_ulang/setPembayaranSPP') ?>" method="post">
          <div class="form-group col-md-12 col-sm-12">
            <label class="col-form-label col-md-4 col-sm-4 label-align">Nama Siswa : </label>
            <div class="col-md-6 col-sm-6 ">
              <input class="form-control <?php echo form_error('nama_siswa') ? 'is-invalid':'' ?>" type="text" name="nama_siswa" placeholder="Nama Siswa" value="<?php echo $siswa->nama_siswa ?>"/>
            </div>
          </div>
          <div class="form-group col-md-12 col-sm-12">
            <label class="col-form-label col-md-4 col-sm-4 label-align">Kelas : </label>
            <div class='col-md-6 col-sm-6'>
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
