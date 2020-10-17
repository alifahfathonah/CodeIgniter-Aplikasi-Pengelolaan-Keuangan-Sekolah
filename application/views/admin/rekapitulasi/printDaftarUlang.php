<?php 

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<font size="12" face="Arial Narrow" >
	<?php for($i=1;$i<=6;$i++) 
	{ ?>
		<table >
			<thead>
				<tr>
					<th colspan="11" align="center">Laporan Daftar Ulang</th>
				</tr>
				<tr>
					<th colspan="11" align="center">Kelas <?php echo $i ?></th>
				</tr>
				<tr>
					<th colspan="11" align="center">Sekolah Dasar Petompon</th>
				</tr>
				<tr>
					<th colspan="11" align="center">Periode <?php echo $tahunAjaran; ?></th>
				</tr>
				<tr>
					<th width=40 bgcolor="FFFF00" style="text-align: center !important; border: solid;">No</th>
					<th width=360 bgcolor="FFFF00" style="text-align: center !important; border: solid;">Nama</th>
					<th width=80 bgcolor="FFFF00" style="text-align: center !important; border: solid;">Kelas</th>
					<th width=160 bgcolor="FFFF00" style="text-align: center !important; border: solid;">Target</th>
					<th width=160 bgcolor="FFFF00" style="text-align: center !important; border: solid;">SPP</th>
					<th width=160 bgcolor="FFFF00" style="text-align: center !important; border: solid;">Seragam</th>
					<th width=160 bgcolor="FFFF00" style="text-align: center !important; border: solid;">Kegiatan Siswa</th>
					<th width=160 bgcolor="FFFF00" style="text-align: center !important; border: solid;">SPI</th>
					<th width=160 bgcolor="FFFF00" style="text-align: center !important; border: solid;">Pembukaan Rek</th>
					<th width=165 bgcolor="FFFF00" style="text-align: center !important; border: solid;">Terbayar</th>
					<th width=160 bgcolor="FFFF00" style="text-align: center !important; border: solid;">Hutang</th>
				</tr>


			</thead>
			<tbody>
				<?php 
				$j = 1;
				foreach (${'listSiswaDaftarUlang'.$i} as ${'listSiswaDaftarUlang'.$i}): ?>

					<tr>
						<?php if((${'listSiswaDaftarUlang'.$i}->nama != NULL) AND (${'listSiswaDaftarUlang'.$i}->target != NULL)  ) {?>
							<?php if(${'listSiswaDaftarUlang'.$i}->nama != "TOTAL") {  ?>  
								<td style="border: solid;"><?php echo $j ?></td>
								<td style="border: solid;"><?php echo ${'listSiswaDaftarUlang'.$i}->nama ?></td>
								<td style="border: solid;"><?php echo ${'listSiswaDaftarUlang'.$i}->kelas_nama ?></td>

								<td align="right" style="border: solid;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->target) ?></td>
								<td align="right" style="border: solid;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->spp) ?></td>
								<td align="right" style="border: solid;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->seragam) ?></td>
								<td align="right" style="border: solid;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->keg_siswa) ?></td>
								<td align="right" style="border: solid;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->spi) ?></td>
								<td align="right" style="border: solid;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->pembukaan_rek) ?></td>
								<td align="right" style="border: solid;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->terbayar) ?></td>
								<td align="right" style="border: solid;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->hutang) ?></td>
							<?php } else { ?>
								<td colspan="3" align="center" style="font-weight: bold; border: solid;"><?php echo ${'listSiswaDaftarUlang'.$i}->nama ?></td>
								<td align="right" style="font-weight: bold; border: solid;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->target) ?></td>
								<td align="right" style="font-weight: bold; border: solid;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->spp) ?></td>
								<td align="right" style="font-weight: bold; border: solid;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->seragam) ?></td>
								<td align="right" style="font-weight: bold; border: solid;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->keg_siswa) ?></td>
								<td align="right" style="font-weight: bold; border: solid;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->spi) ?></td>
								<td align="right" style="font-weight: bold; border: solid;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->pembukaan_rek) ?></td>
								<td align="right" style="font-weight: bold; border: solid;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->terbayar) ?></td>
								<td align="right" style="font-weight: bold; border: solid;"><?php echo rupiah(${'listSiswaDaftarUlang'.$i}->hutang) ?></td>
							<?php } ?>
						<?php } ?>
					</tr> 

					<?php $j++; 
				endforeach; ?>


				</tbody>
			</table>


			<br/>

		<?php } ?>



		<table >
			<thead>
				<tr>
					<th colspan="10" align="center">Laporan Daftar Ulang </th>
				</tr>
				<tr>
					<th colspan="10" align="center">Kelas 1 sampai 5 </th>
				</tr>
				<tr>
					<th colspan="10" align="center">Sekolah Dasar Petompon</th>
				</tr>
				<tr>
					<th colspan="10" align="center">Periode <?php echo $tahunAjaran; ?></th>
				</tr>
				<tr>
				</tr>
				<tr>
					<th width=10 bgcolor="FFFF00" style="text-align: center !important; border: solid;">No</th>
					<th width=360 bgcolor="FFFF00" style="text-align: center !important; border: solid;">Nama</th>
					<th width=160 bgcolor="FFFF00" style="text-align: center !important; border: solid;">Target</th>
					<th width=160 bgcolor="FFFF00" style="text-align: center !important; border: solid;">SPP</th>
					<th width=160 bgcolor="FFFF00" style="text-align: center !important; border: solid;">Seragam</th>
					<th width=160 bgcolor="FFFF00" style="text-align: center !important; border: solid;">Kegiatan Siswa</th>
					<th width=160 bgcolor="FFFF00" style="text-align: center !important; border: solid;">SPI</th>
					<th width=160 bgcolor="FFFF00" style="text-align: center !important; border: solid;">Pembukaan Rek
					</th>
					<th width=165 bgcolor="FFFF00" style="text-align: center !important; border: solid;">Terbayar</th>
					<th width=160 bgcolor="FFFF00" style="text-align: center !important; border: solid;">Hutang</th>
				</tr>


			</thead>
			<tbody>
				<?php 	
				$j = 1;
				foreach ($lapDaftarUlangByKelas as $lapDaftarUlangByKelas): ?>
					<tr>
						<?php if($lapDaftarUlangByKelas->nama != "TOTAL") {  ?>  
							<td style="border: solid;"><?php echo $j ?></td>
							<td style="border: solid;"><?php 
							if($lapDaftarUlangByKelas->nama != 99 ){
								echo "Kelas ".$lapDaftarUlangByKelas->nama;
							}else {
								echo "Alumni";
							}?>
						</td>
						<td align="right" style="border: solid;"><?php echo rupiah($lapDaftarUlangByKelas->target) ?></td>
						<td align="right" style="border: solid;"><?php echo rupiah($lapDaftarUlangByKelas->spp) ?></td>
						<td align="right" style="border: solid;"><?php echo rupiah($lapDaftarUlangByKelas->seragam) ?></td>
						<td align="right" style="border: solid;"><?php echo rupiah($lapDaftarUlangByKelas->keg_siswa) ?></td>
						<td align="right" style="border: solid;"><?php echo rupiah($lapDaftarUlangByKelas->spi) ?></td>
						<td align="right" style="border: solid;"><?php echo rupiah($lapDaftarUlangByKelas->pembukaan_rek) ?></td>
						<td align="right" style="border: solid;"><?php echo rupiah($lapDaftarUlangByKelas->terbayar) ?></td>
						<td align="right" style="border: solid;"><?php echo rupiah($lapDaftarUlangByKelas->hutang) ?></td>
					<?php } else { ?>
						<td colspan="2" align="center" style="font-weight: bold; border: solid;"><?php echo $lapDaftarUlangByKelas->nama ?></td>
						<td align="right" style="font-weight: bold; border: solid;"><?php echo rupiah($lapDaftarUlangByKelas->target) ?></td>
						<td align="right" style="font-weight: bold; border: solid;"><?php echo rupiah($lapDaftarUlangByKelas->spp) ?></td>
						<td align="right" style="font-weight: bold; border: solid;"><?php echo rupiah($lapDaftarUlangByKelas->seragam) ?></td>
						<td align="right" style="font-weight: bold; border: solid;"><?php echo rupiah($lapDaftarUlangByKelas->keg_siswa) ?></td>
						<td align="right" style="font-weight: bold; border: solid;"><?php echo rupiah($lapDaftarUlangByKelas->spi) ?></td>
						<td align="right" style="font-weight: bold; border: solid;"><?php echo rupiah($lapDaftarUlangByKelas->pembukaan_rek) ?></td>
						<td align="right" style="font-weight: bold; border: solid;"><?php echo rupiah($lapDaftarUlangByKelas->terbayar) ?></td>
						<td align="right" style="font-weight: bold; border: solid;"><?php echo rupiah($lapDaftarUlangByKelas->hutang) ?></td>
					<?php } ?>

				</tr> 

				<?php 
				$j++; 
			endforeach; ?>
		</tr>
		<tr>
		</tr>
		<tr></tr>
		

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
