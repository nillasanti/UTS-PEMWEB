
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h5 class="m-0 font-weight-bold text-primary">Neraca Saldo</h5>
            </div>
            
           <div class="card-body">
              <div class="table-responsive">
			  <table class="table table-bordered" id="dataTable" data-toggle="table" data-pagination="true" data-search="true" >																		
                                        
								<tr align="center">
									<td colspan="4" align="center"><center><b>Jaya Abadi Audio</b><center></td>
								</tr>
								<tr align="center">
									<td colspan="4" align="center"><center><b>Neraca Saldo</b><center></td>
								</tr>
								<tr align="center">
									<th rowspan="2" align="center" class="center" width="10%"><center>Nomor Akun</center></th>
									<th rowspan="2" align="center" class="center" width="35%"><center>Nama Akun</center></th>
									<th colspan="2" align="center" class="center" width="30%"><center>Saldo</center></th>
								</tr>
								<tr align="center">
									<th><center>Debit</center></th>
									<th><center>Kredit</center></th>
								</tr>
								<?php
								$saldo_debit = 0;
								$saldo_kredit = 0;
								$sql = mysqli_query($connect,"SELECT * FROM akun ORDER BY kode_akun");


								while ($query = mysqli_fetch_array($sql)) {
									$kode_akun = $query['kode_akun'];

								?>
								<tr>
									<td class="center"><?=$query['kode_akun']?></td>
									<td class="center"><?=$query['nama_akun']?></td>
									<?php
									$sal = mysqli_query($connect,"SELECT SUM(debit) as debit FROM jurnal_umum WHERE kode_akun='$kode_akun'");
									$debit = mysqli_fetch_array($sal);

									$sal2 = mysqli_query($connect,"SELECT SUM(kredit) as kredit FROM jurnal_umum WHERE kode_akun='$kode_akun'");
									$kredit = mysqli_fetch_array($sal2);

									if($query['grup'] == "debit") {
										$salD = $debit['debit'] - $kredit['kredit'];
										$saldo_debit += $salD;
										$salK = 0;
									}
									else {
										$salD = 0;
										$salK = $kredit['kredit']-$debit['debit'];
										$saldo_kredit += $salK;
									}
									?>
									<td>Rp.<?=number_format($salD)?></td>
									<td>Rp.<?=number_format($salK)?></td>
								</tr>
								<?php } ?>
								<tr>
									<td colspan="2" align="right"><b>Total :</b></td>
									<td><b>Rp.<?=number_format($saldo_debit)?></b></td>
									<td><b>Rp.<?=number_format($saldo_kredit)?></b></td>
								</tr>
							
					<tbody>
					
					</tbody>
				</table>
                                
              </div>
            </div>
          </div>
