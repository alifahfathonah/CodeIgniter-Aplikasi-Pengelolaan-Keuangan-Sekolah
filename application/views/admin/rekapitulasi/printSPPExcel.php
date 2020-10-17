<?php 

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");
$this->load->helper('bulan_helper'); 

$bulan1 = bulan($bulan);

?>

<font size="12" face="Arial Narrow" >
<table id="tes" class="table table-bordered" style="width:100%">
	<thead>
		<tr>
			<th colspan="8" align="center">REKAP PENERIMAAN & TUNGGAKAN SPP</th>
		</tr>
		<tr>
			<th colspan="8" align="center">BULAN <?php echo strtoupper($bulan1);?> TAHUN <?php echo $tahun; ?></th>
		</tr>
		<tr>
		</tr>
		<tr>
			<th colspan="4" style="text-align: center !important; border: solid;" bgcolor="FF9999">PENERIMAAN</th>
			<th colspan="4" style="text-align: center !important; border: solid;" bgcolor="9999FF">TUNGGAKAN</th>

		</tr>

		<tr align="center">
			<th width=79 style="border: solid;">KODE</th>
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
		<tr>
			<td style="border: solid;font-weight: bold;"></td>
			<td style="border: solid;font-weight: bold;"><?php echo $rekapSPPBayarTotal->uraian ?></td>
			<td style="border: solid;font-weight: bold;"><?php echo $rekapSPPBayarTotal->jumlah ?></td>
			<td style="border: solid;font-weight: bold;"><?php echo rupiah($rekapSPPBayarTotal->total) ?></td>
			<td style="border: solid;font-weight: bold;"></td>
			<td style="border: solid;font-weight: bold;"><?php echo $rekapSPPBelumBayarTotal->uraian ?></td>
			<td style="border: solid;font-weight: bold;"><?php echo $rekapSPPBelumBayarTotal->jumlah ?></td>
			<td style="border: solid;font-weight: bold;"><?php echo rupiah($rekapSPPBelumBayarTotal->total) ?></td>
		</tr>

		<?php 
		$panjang;
		if((count($rekapSPPTerbayarGroupByKelas))>=(count($rekapSPPBelumTerbayarGroupByKelas))){
			$panjang = count($rekapSPPTerbayarGroupByKelas);
		}else{
			$panjang = count($rekapSPPBelumTerbayarGroupByKelas);
		}

		for($i=0;$i<$panjang;$i++){ ?>
			<tr>
				<?php if(!empty($rekapSPPTerbayarGroupByKelas[$i]) AND !empty($rekapSPPBelumTerbayarGroupByKelas[$i])) { ?>
					<td style="border: solid;"></td>
					<td style="border: solid;"><?php echo $rekapSPPTerbayarGroupByKelas[$i]->uraian; ?></td>
					<td style="border: solid;">
						<?php 
						if ($rekapSPPTerbayarGroupByKelas[$i]->jumlah == "") {
							echo $rekapSPPTerbayarGroupByKelas[$i]->jumlah;
						}else{
							echo rupiah($rekapSPPTerbayarGroupByKelas[$i]->jumlah);
						}
						?>
						<td style="border: solid;">
							<?php 
							if ($rekapSPPTerbayarGroupByKelas[$i]->total == "") {
								echo $rekapSPPTerbayarGroupByKelas[$i]->total;
							}else{
								echo rupiah($rekapSPPTerbayarGroupByKelas[$i]->total);
							}
							?>
						</td>
						<td style="border: solid;"></td>
						<td style="border: solid;"><?php echo $rekapSPPBelumTerbayarGroupByKelas[$i]->uraian; ?></td>
						<td style="border: solid;">
							<?php 
							if ($rekapSPPBelumTerbayarGroupByKelas[$i]->jumlah == "") {
								echo $rekapSPPBelumTerbayarGroupByKelas[$i]->jumlah;
							}else{
								echo rupiah($rekapSPPBelumTerbayarGroupByKelas[$i]->jumlah);
							}
							?>
						</td>
						<td style="border: solid;">
							<?php 
							if ($rekapSPPBelumTerbayarGroupByKelas[$i]->total == "") {
								echo $rekapSPPBelumTerbayarGroupByKelas[$i]->total;
							}else{
								echo rupiah($rekapSPPBelumTerbayarGroupByKelas[$i]->total);
							}
							?>
						</td>
					<?php } else if(!empty($rekapSPPTerbayarGroupByKelas[$i]) AND empty($rekapSPPBelumTerbayarGroupByKelas[$i])) { ?>
						<td style="border: solid;"></td>
						<td style="border: solid;"><?php echo $rekapSPPTerbayarGroupByKelas[$i]->uraian; ?></td>
						<td style="border: solid;">
							<?php 
							if ($rekapSPPTerbayarGroupByKelas[$i]->jumlah == "") {
								echo $rekapSPPTerbayarGroupByKelas[$i]->jumlah;
							}else{
								echo rupiah($rekapSPPTerbayarGroupByKelas[$i]->jumlah);
							}
							?>
						</td>
						<td style="border: solid;">
							<?php 
							if ($rekapSPPTerbayarGroupByKelas[$i]->total == "") {
								echo $rekapSPPTerbayarGroupByKelas[$i]->total;
							}else{
								echo rupiah($rekapSPPTerbayarGroupByKelas[$i]->total);
							}
							?>
						</td>
						<td style="border: solid;"></td>
						<td style="border: solid;"></td>
						<td style="border: solid;"></td>
						<td style="border: solid;"></td>
					<?php } else if(empty($rekapSPPTerbayarGroupByKelas[$i]) AND !empty($rekapSPPBelumTerbayarGroupByKelas[$i])) { ?>
						<td style="border: solid;"></td>
						<td style="border: solid;"></td>
						<td style="border: solid;"></td>
						<td style="border: solid;"></td>
						<td style="border: solid;"></td>
						<td style="border: solid;"><?php echo $rekapSPPBelumTerbayarGroupByKelas[$i]->uraian; ?></td>
						<td style="border: solid;">
							<?php 
							if ($rekapSPPBelumTerbayarGroupByKelas[$i]->jumlah == "") {
								echo $rekapSPPBelumTerbayarGroupByKelas[$i]->jumlah;
							}else{
								echo rupiah($rekapSPPBelumTerbayarGroupByKelas[$i]->jumlah);
							}
							?>
						</td>
						<td style="border: solid;">
							<?php 
							if ($rekapSPPBelumTerbayarGroupByKelas[$i]->total == "") {
								echo $rekapSPPBelumTerbayarGroupByKelas[$i]->total;
							}else{
								echo rupiah($rekapSPPBelumTerbayarGroupByKelas[$i]->total);
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
				<td colspan="3" align="center" style="border: solid; font-weight: bold;">JUMLAH TOTAL PENERIMAAN <?php echo strtoupper($bulan1);?> <?php echo $tahun; ?></td>
				<td style="border: solid; font-weight: bold;"><?php echo "Rp. ".rupiah($rekapSPPBayarTotal->total) ?></td>
				<td colspan="3" align="center" style="border: solid; font-weight: bold;">JUMLAH TOTAL TUNGGAKAN <?php echo strtoupper($bulan1);?> <?php echo $tahun; ?></td>
				<td style="border: solid; font-weight: bold;"><?php echo "Rp. ".rupiah($rekapSPPBelumBayarTotal->total) ?></td>
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
