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
      <th colspan="5" align="center">REKAPITULASI BUKU KAS 
      </th>
    </tr>
    <tr>
      <th style="text-transform: uppercase;" colspan="5" align="center" >BULAN <?php echo strtoupper($bulan1);?> TAHUN <?php echo $tahun; ?></th>
    </tr>
    <tr>
    </tr>
    
    <tr align="center">
      <th width=78 style="border: solid;" bgcolor="92D050">NO</th>
      <th width=130 style="border: solid;" bgcolor="92D050">TANGGAL</th>
      <th width=130 style="border: solid;" bgcolor="92D050">KODE</th>
      <th width=380 style="border: solid;" bgcolor="92D050">KETERANGAN</th>
      <th width=180 style="border: solid;" bgcolor="92D050">DEBET</th>
      <th width=180 style="border: solid;" bgcolor="92D050">KREDIT</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1; ?>
    <?php foreach ($PerTanggal as $a){ ?>
      <tr>
        <td align="center" style="border: solid;"><?php echo $i ?></td>
        <td align="center" style="border: solid;"><?php echo $a->tanggal ?></td>
        <td align="center" style="border: solid;">
          <?php 
          if ($a->kode == "spp" ){
            if ($a->ket == "1A"){
              echo "20.2.11";
            }else if($a->ket == "1B"){
              echo "20.2.12";
            }else if($a->ket == "2A"){
              echo "20.2.21";
            }else if($a->ket == "2B"){
              echo "20.2.22";
            }else if($a->ket == "3A"){
              echo "20.2.31";
            }else if($a->ket == "3B"){
              echo "20.2.32";
            }else if($a->ket == "4A"){
              echo "20.2.41";
            }else if($a->ket == "4B"){
              echo "20.2.42";
            }else if($a->ket == "5A"){
              echo "20.2.51";
            }else if($a->ket == "5B"){
              echo "20.2.52";
            }else if($a->ket == "6A"){
              echo "20.2.61";
            }else if($a->ket == "6B"){
              echo "20.2.62";
            }

          }else{
            echo $a->kode;  
          }

          ?>          
        </td>
        <td style="border: solid;"><?php echo $a->keterangan ?></td>
        <td style="border: solid;"><?php 
        if($a->debet == ""){
          echo $a->debet;
        }else{
          echo rupiah($a->debet);  
        }
        ?></td>
        <td style="border: solid;"><?php 
        if($a->kredit == ""){
          echo $a->kredit;
        }else{
          echo rupiah($a->kredit);  
        }
        ?></td>
      </tr> 
      <?php $i++; ?>
    <?php } ?>
    <tr>
      <td style="border: solid;"></td>
      <td style="border: solid;"></td>
      <td style="border: solid;"></td>
      <td style="border: solid;"></td>
      <td style="border: solid;"></td>
      <td style="border: solid;"></td>
    </tr>
    <tr>
      <td style="border: solid;"></td>
      <td style="border: solid;"></td>
      <td style="border: solid;"></td>
      <td style="border: solid;"></td>
      <td style="border: solid;"></td>
      <td style="border: solid;"></td>
    </tr>
    <tr>
      <td style="border: solid;"></td>
      <td style="border: solid;"></td>
      <td style="border: solid;"></td>
      <td style="border: solid;"></td>
      <td style="border: solid;"></td>
      <td style="border: solid;"></td>
    </tr>
    <tr>
      <th colspan="4" style="border: solid;" align="center">TOTAL</th>
      <th style="border: solid;">Rp. <?php echo rupiah($pemasukkan) ?></th>
      <th style="border: solid;"> Rp. <?php echo rupiah($pengeluaran) ?></th>
    </tr>
    <tr>
    </tr>
    <tr>
     <td></td>
     <td colspan="2">Mengetahui </td>
     <td colspan="2" align="center">Semarang <?php echo $tanggal ?> </td>
   </tr>
   <tr>
     <td></td>
     <td colspan="2">Kepala Sekolah SD Petompon</td>
     <td colspan="2" align="center">PEREKAP</td>
   </tr>
   <tr>
   </tr>
   <tr>
     <td></td>
     <td colspan="2" style="font-style: italic;">(Nama Kepala Sekolah)</td>
     <td colspan="2" align="center" style="font-style: italic;">(Nama Perekap)</td>
   </tr>

 </tbody>
</table>
</font>