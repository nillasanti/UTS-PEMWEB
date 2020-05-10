<?php
include "config/koneksi.php";
if(isset($_GET['username'])){
$query = mysqli_query ($connect,"Select * FROM user where username='$_GET[username]'") or die (mysql_error());
$result_edit = mysqli_fetch_array($query);
}

?>

<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h5 class="m-0 font-weight-bold text-primary">Laporan Neraca</h5>
            </div>
            
           <div class="card-body">
              <div class="table-responsive">
			  <table class="table table-bordered" id="dataTable" data-toggle="table" data-pagination="true" data-search="true" >									
                                       
			  <tr>
													<th colspan="2" class="left" width="50%">Aktiva</th>
												</tr>
												<?php
												
													$sqlL = mysqli_query($connect,"SELECT SUM(jurnal_umum.debit) AS jml_debit, SUM(jurnal_umum.kredit) AS jml_kredit, jurnal_umum.tanggal, jurnal_umum.kode_akun, akun.*
															FROM jurnal_umum LEFT JOIN akun ON jurnal_umum.kode_akun=akun.kode_akun 
															WHERE akun.posisi='L' AND akun.posisi !=''
															GROUP BY jurnal_umum.kode_akun
															ORDER BY jurnal_umum.id_jurnal ASC");													
													while($rowsL=mysqli_fetch_array($sqlL)){
														// if($rowsL['grup']=='Debit'){
														// 	$jml_debitL = $rowsL['jml_debit']-$rowsL['jml_kredit'];
														// 	// $jml_debit = $rows['jml_debit'];
														// 	$jml_kredit = 0;
														// }else{
														// 	$jml_kreditL = $rowsL['jml_kredit']-$rowsL['jml_debit'];
														// 	// $jml_kredit = $rows['jml_kredit'];
														// 	$jml_debitL = 0;
														// }
												?>
												<tr>
													<td class="left"><?php echo $rowsL['nama_akun']; ?></td>
													<?php
													if($rowsL['grup']=='debit'){
														$jml_debitL = $rowsL['jml_debit']-$rowsL['jml_kredit'];
													?>
													<td class="right">
														<?php echo "Rp. ".number_format($jml_debitL,2,',','.').""; ?>
													</td>
													<?php
													}else{
														$jml_kreditL = $rowsL['jml_kredit']-$rowsL['jml_debit'];
													?>
													<td class="right">
														<?php echo "Rp. ".number_format($jml_kreditL,2,',','.').""; ?>
													</td>
													<?php
													}
													?>
												</tr>
												<?php
													@$total_debitL += @$jml_debitL;
													@$total_kreditL += @$jml_kreditL;
													$totalL = $total_debitL+$total_kreditL;
													}
													// $total_debitL += $jml_debitL;
													// $total_kreditL += $jml_kreditL;
												?>
												<tr>
													<td><b><div align="left">Jumlah Aktiva</div></b></td>

													<td class="right"><b><?php echo "Rp. ".number_format(@$totalL,2,',','.').""; ?></b></td>
												</tr>
												<!-- batas -->
												<tr>
													<th colspan="2" class="center" width="50%">&nbsp;</th>
												</tr>
												<tr>
													<th colspan="2" class="left" width="50%">Kewajiban dan Modal</th>
												</tr>
												<?php
													
													$labaK = mysqli_query($connect,"
																SELECT SUM(jurnal_umum.kredit) AS labaK,
																jurnal_umum.tanggal
																FROM jurnal_umum LEFT JOIN akun ON jurnal_umum.kode_akun=akun.kode_akun 
																WHERE akun.laba_rugi ='T'
															");
													$lbK = mysqli_fetch_array($labaK);

													$labaD = mysqli_query($connect,"
															SELECT SUM(jurnal_umum.debit) AS labaD,
															jurnal_umum.tanggal
															FROM jurnal_umum LEFT JOIN akun ON jurnal_umum.kode_akun=akun.kode_akun 
															WHERE akun.laba_rugi ='B'
														");
													$lbD = mysqli_fetch_array($labaD);

													$total_laba = $lbK['labaK']-$lbD['labaD'];


													$sqlR = "SELECT SUM(jurnal_umum.debit) AS jml_debit, SUM(jurnal_umum.kredit) AS jml_kredit, jurnal_umum.tanggal, jurnal_umum.kode_akun, akun.*
															FROM jurnal_umum LEFT JOIN akun ON jurnal_umum.kode_akun=akun.kode_akun 
															WHERE akun.posisi='R' AND akun.posisi !=''
															GROUP BY jurnal_umum.kode_akun
															ORDER BY jurnal_umum.id_jurnal ASC";
													$queryR	= mysqli_query($connect,$sqlR);

													while($rowsR=mysqli_fetch_array($queryR)){
														$cekM = mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM akun WHERE posisi='R' AND laba_rugi='N' AND pm=1"));
														$dataM = $cekM['nama_akun'];

														// if($rowsR['nama_akun']==$dataM){
														// 	if($rowsR['grup']=='Debit'){
														// 		$jml_debitR = ($rowsR['jml_debit']-$rowsR['jml_kredit'])+$labaD;
														// 	}else{
														// 		$jml_kreditR = ($rowsR['jml_kredit']-$rowsR['jml_debit'])+$labaD;
														// 	}
														// }else{
														// 	if($rowsR['grup']=='Debit'){
														// 		$jml_debitR = $rowsR['jml_debit']-$rowsR['jml_kredit'];
														// 	}else{
														// 		$jml_kreditR = $rowsR['jml_kredit']-$rowsR['jml_debit'];
														// 	}
														// }

												?>
												<tr>
													<td class="left"><?php echo $rowsR['nama_akun']; ?></td>
													<?php
													if($rowsR['nama_akun']==$dataM){
														$jml_kredit = ($rowsR['jml_kredit']-$rowsR['jml_debit'])+$total_laba;
														$jml_kreditR = $jml_kredit - @$prive['total_prive'];
													?>
													<td class="right">
														<?php echo "Rp. ".number_format($jml_kreditR,2,',','.').""; ?>
													</td>
													<?php
													}else{
														$jml_kreditR = $rowsR['jml_kredit']-$rowsR['jml_debit'];
													?>
													<td class="right">
														<?php echo "Rp. ".number_format($jml_kreditR,2,',','.').""; ?>
													</td>
													<?php
													}
													?>
												</tr>
												<?php
													@$total_debitR += @$jml_debitR;
													@$total_kreditR += @$jml_kreditR;
													$totalR = $total_debitR+$total_kreditR;
													}
													// $total_debitR += $jml_debitR;
													// $total_kreditR += $jml_kreditR;
												?>
												<tr>
													<td><b><div align="left">Total Kewajiban dari Modal</div></b></td>
													
													<td class="right"><b><?php echo "Rp. ".number_format(@$totalR,2,',','.').""; ?></b></td>
													
												</tr>
                </table> 
              </div>
            </div>
          </div>
