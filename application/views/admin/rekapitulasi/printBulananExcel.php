<?php 

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");
$this->load->helper('bulan_helper'); 

$bulan1 = bulan($bulan);

?>
<font size="12" face="Arial Narrow" >
  <table id="tes" class="table table-striped table-bordered" style="width:100%">
    <thead>
     <tr>
      <th colspan="8" align="center">REKAP PENERIMAAN & PENGELUARAN
      </th>
    </tr>
    <tr>
      <th style="text-transform: uppercase;" colspan="8" align="center" >BULAN <?php echo strtoupper($bulan1);?> TAHUN <?php echo $tahun; ?></th>
    </tr>
    <tr>
    </tr>
    <tr>
      <th colspan="4" style="text-align: center !important; border: solid;" bgcolor="FF9999">PENERIMAAN</th>
      <th colspan="4" style="text-align: center !important; border: solid" bgcolor="9999FF">PENGELUARAN</th>
    </tr>
    <tr align="center">
      <th width=78 style="border: solid;">KODE</th>
      <th width=338 style="border: solid;">URAIAN</th>
      <th width=152 style="border: solid;">JUMLAH</th>
      <th width=151 style="border: solid;">TOTAL</th>
      <th width=78 style="border: solid;">KODE</th>
      <th width=338 style="border: solid;">URAIAN</th>
      <th width=152 style="border: solid;">JUMLAH</th>
      <th width=151 style="border: solid;">TOTAL</th>

    </tr>



  </thead>
  <tbody>

   <?php 
   $panjang;
   if((count($tes2))>=(count($pengeluaran2))){
    $panjang = count($tes2);
  }else{
    $panjang = count($pengeluaran2);
  }

  for($i=0;$i<$panjang;$i++){ ?>
    <tr>
      <?php if(!empty($tes2[$i]) AND !empty($pengeluaran2[$i])) { ?>
        <td style="border: solid">
          <?php 
          if ($tes2[$i]->kode == "spp" ){
            if ($tes2[$i]->kode_kelas == "1A"){
              echo "20.2.11";
            }else if($tes2[$i]->kode_kelas == "1B"){
              echo "20.2.12";
            }else if($tes2[$i]->kode_kelas == "2A"){
              echo "20.2.21";
            }else if($tes2[$i]->kode_kelas == "2B"){
              echo "20.2.22";
            }else if($tes2[$i]->kode_kelas == "3A"){
              echo "20.2.31";
            }else if($tes2[$i]->kode_kelas == "3B"){
              echo "20.2.32";
            }else if($tes2[$i]->kode_kelas == "4A"){
              echo "20.2.41";
            }else if($tes2[$i]->kode_kelas == "4B"){
              echo "20.2.42";
            }else if($tes2[$i]->kode_kelas == "5A"){
              echo "20.2.51";
            }else if($tes2[$i]->kode_kelas == "5B"){
              echo "20.2.52";
            }else if($tes2[$i]->kode_kelas == "6A"){
              echo "20.2.61";
            }else if($tes2[$i]->kode_kelas == "6B"){
              echo "20.2.62";
            }

          }else{
            echo $tes2[$i]->kode;  
          }

          ?>

        </td>
        <td style="border: solid"><?php echo $tes2[$i]->uraian; ?></td>
        <td style="border: solid">
          <?php 
          if ($tes2[$i]->jumlah == "") {
            echo $tes2[$i]->jumlah;
          }else{
            echo rupiah($tes2[$i]->jumlah);
          }
          ?>
          <td style="border: solid">
            <?php 
            if ($tes2[$i]->total == "") {
              echo $tes2[$i]->total;
            }else{
              echo rupiah($tes2[$i]->total);
            }
            ?>
          </td>
          <td style="border: solid">
            <?php
              echo $pengeluaran2[$i]->kode;                                 
            ?>
          </td>
          <td style="border: solid"><?php echo $pengeluaran2[$i]->uraian; ?></td>
          <td style="border: solid">
            <?php 
            if ($pengeluaran2[$i]->jumlah == "") {
              echo $pengeluaran2[$i]->jumlah;
            }else{
              echo rupiah($pengeluaran2[$i]->jumlah);
            }
            ?>
          </td>
          <td style="border: solid">
            <?php 
            if ($pengeluaran2[$i]->total == "") {
              echo $pengeluaran2[$i]->total;
            }else{
              echo rupiah($pengeluaran2[$i]->total);
            }
            ?>
          </td>
        <?php } else if(!empty($tes2[$i]) AND empty($pengeluaran2[$i])) { ?>
          <td style="border: solid">
            <?php 
          if ($tes2[$i]->kode == "spp" ){
            if ($tes2[$i]->kode_kelas == "1A"){
              echo "20.2.11";
            }else if($tes2[$i]->kode_kelas == "1B"){
              echo "20.2.12";
            }else if($tes2[$i]->kode_kelas == "2A"){
              echo "20.2.21";
            }else if($tes2[$i]->kode_kelas == "2B"){
              echo "20.2.22";
            }else if($tes2[$i]->kode_kelas == "3A"){
              echo "20.2.31";
            }else if($tes2[$i]->kode_kelas == "3B"){
              echo "20.2.32";
            }else if($tes2[$i]->kode_kelas == "4A"){
              echo "20.2.41";
            }else if($tes2[$i]->kode_kelas == "4B"){
              echo "20.2.42";
            }else if($tes2[$i]->kode_kelas == "5A"){
              echo "20.2.51";
            }else if($tes2[$i]->kode_kelas == "5B"){
              echo "20.2.52";
            }else if($tes2[$i]->kode_kelas == "6A"){
              echo "20.2.61";
            }else if($tes2[$i]->kode_kelas == "6B"){
              echo "20.2.62";
            }

          }else{
            echo $tes2[$i]->kode;  
          }

          ?>

          </td>
          <td style="border: solid"><?php echo $tes2[$i]->uraian; ?></td>
          <td style="border: solid">
            <?php 
            if ($tes2[$i]->jumlah == "") {
              echo $tes2[$i]->jumlah;
            }else{
              echo rupiah($tes2[$i]->jumlah);
            }
            ?>
          </td>
          <td style="border: solid">
            <?php 
            if ($tes2[$i]->total == "") {
              echo $tes2[$i]->total;
            }else{
              echo rupiah($tes2[$i]->total);
            }
            ?>
          </td>
          <td style="border: solid"></td>
          <td style="border: solid"></td>
          <td style="border: solid"></td>
          <td style="border: solid"></td>
        <?php } else if(empty($tes2[$i]) AND !empty($pengeluaran2[$i])) { ?>
          <td style="border: solid"></td>
          <td style="border: solid"></td>
          <td style="border: solid"></td>
          <td style="border: solid"></td>
          <td style="border: solid">
            <?php
              echo $pengeluaran2[$i]->kode;                                 
            ?>
          </td>
          <td style="border: solid"><?php echo $pengeluaran2[$i]->uraian; ?></td>
          <td style="border: solid">
            <?php 
            if ($pengeluaran2[$i]->total == "") {
              echo $pengeluaran2[$i]->total;
            }else{
              echo rupiah($pengeluaran2[$i]->total);
            }
            ?>
          </td>
          <td style="border: solid">
            <?php 
            if ($pengeluaran2[$i]->total == "") {
              echo $pengeluaran2[$i]->total;
            }else{
              echo rupiah($pengeluaran2[$i]->total);
            }
            ?>
          </td>
        <?php } ?>

      </tr>
    <?php } ?>
    <tr>
     <td style="border: solid"></td>
     <td style="border: solid"></td>
     <td style="border: solid"></td>
     <td style="border: solid"></td>
     <td style="border: solid"></td>
     <td style="border: solid"></td>
     <td style="border: solid"></td>
     <td style="border: solid"></td>
   </tr>
   <tr>
     <td style="border: solid"></td>
     <td style="border: solid"></td>
     <td style="border: solid"></td>
     <td style="border: solid"></td>
     <td style="border: solid"></td>
     <td style="border: solid"></td>
     <td style="border: solid"></td>
     <td style="border: solid"></td>
   </tr>
   <tr>
     <td style="border: solid"></td>
     <td style="border: solid"></td>
     <td style="border: solid"></td>
     <td style="border: solid"></td>
     <td style="border: solid"></td>
     <td style="border: solid"></td>
     <td style="border: solid"></td>
     <td style="border: solid"></td>
   </tr>

   <td colspan="3" style="text-align: center !important; font-weight: bold; border: solid;" >JUMLAH TOTAL DEBET <?php echo strtoupper($bulan1);?> <?php echo $tahun; ?> </td>
   <td style="text-align: center !important; font-weight: bold; border: solid;" > Rp. <?php $this->load->helper('rupiah_helper'); echo rupiah($pemasukkan) ?></td>
   <td colspan="3" style="text-align: center !important; font-weight: bold; border: solid;" >JUMLAH TOTAL KREDIT <?php echo strtoupper($bulan1);?> <?php echo $tahun; ?> </td>
   <td style="text-align: center !important; font-weight: bold; border: solid;" > Rp. <?php $this->load->helper('rupiah_helper'); echo rupiah($pengeluaran) ?></td>
 </tr>
 <tr style="text-align: center; font-weight: bold;">
  <td colspan="7" style="border: solid">
    SALDO AWAL BULAN 
    <?php 
    if (($bulan+1 == 13)) {
      $bulan1 = 1;
    } else {
      $bulan1 = $bulan+1;
    }
    echo strtoupper($bulan1);;

    if (($bulan1) == 1 ){
      echo $tahun+1;
    } else {
      echo " ".$tahun;
    }  
    ?>                                
  </td>
  <td style="border: solid">Rp. <?php echo rupiah($saldo) ?>
</td>
</tr>
<tr>
</tr>
<tr>
 <td></td>
 <td>Mengetahui </td>
 <td></td>
 <td></td>
 <td></td>
 <td colspan="3" align="center">Semarang <?php echo $tanggal ?> </td>
</tr>
<tr>
 <td></td>
 <td>Kepala Sekolah SD Petompon</td>
 <td></td>
 <td></td>
 <td></td>
 <td colspan="3" align="center">PEREKAP</td>
</tr>
<tr>
</tr>
<tr>
 <td></td>
 <td style="font-style: italic;">(Nama Kepala Sekolah)</td>
 <td></td>
 <td></td>
 <td></td>
 <td colspan="3" align="center" style="font-style: italic;">(Nama Perekap)</td>
</tr>

</tbody>
</table>
</font>