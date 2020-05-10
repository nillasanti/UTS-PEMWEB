
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
           
          </div>

          <!-- Content Row -->
          <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-bottom-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-m font-weight-bold text-primary text-uppercase mb-1">Total Akun</div>
                      <?php    
                      $kueri = mysqli_query($connect, "SELECT * FROM akun");
 
                       $data = array ();
                        while (($row = mysqli_fetch_array($kueri)) != null){
                        $data[] = $row;
                        }
                       $cont = count ($data);

                      ?>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $cont; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-bottom-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-m font-weight-bold text-info text-uppercase mb-1">Total Supplier</div>
                      <?php    
                      $kueri = mysqli_query($connect, "SELECT * FROM supplier");
 
                       $data = array ();
                       while (($row = mysqli_fetch_array($kueri)) != null){
                       $data[] = $row;
                      }
                      $cont = count ($data);

                       ?>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $cont; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-bottom-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-m font-weight-bold text-primary text-uppercase mb-1">Laba Rugi</div>
                      <?php
                              $sqlT =mysqli_query($connect,"SELECT SUM(jurnal_umum.debit) AS jml_debit, SUM(jurnal_umum.kredit) AS jml_kredit, jurnal_umum.tanggal, jurnal_umum.kode_akun, akun.*
																	FROM jurnal_umum LEFT JOIN akun ON jurnal_umum.kode_akun=akun.kode_akun 
																	WHERE jurnal_umum.tanggal AND akun.laba_rugi='T' AND akun.laba_rugi !='N'
																	GROUP BY jurnal_umum.kode_akun
																	ORDER BY jurnal_umum.id_jurnal ASC");
															
															while($rowsT=mysqli_fetch_array($sqlT)){
																@$no++;
															@$total_debitT += $rowsT['jml_debit'];
															@$total_kreditT += $rowsT['jml_kredit'];
															@$totalT = $total_debitT+$total_kreditT;
															}
															
															?>
															
														<?php
															$sqlB = mysqli_query($connect,"SELECT SUM(jurnal_umum.debit) AS jml_debit, SUM(jurnal_umum.kredit) AS jml_kredit, jurnal_umum.tanggal, jurnal_umum.kode_akun, akun.*
																	FROM jurnal_umum INNER JOIN akun ON jurnal_umum.kode_akun=akun.kode_akun 
																	WHERE akun.laba_rugi='B' AND akun.laba_rugi !='N'
																	GROUP BY jurnal_umum.kode_akun
																	ORDER BY jurnal_umum.id_jurnal ASC");
															
															while($rowsB=mysqli_fetch_array($sqlB)){
															
														
															@$total_debitB += $rowsB['jml_debit'];
															@$total_kreditB += $rowsB['jml_kredit'];
															@$totalB = $total_debitB+$total_kreditB;
														}
														?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo "Rp. ".number_format(@$total_kreditT-$total_debitB,0,',','.').""; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-table fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-bottom-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-s font-weight-bold text-warning text-uppercase mb-1">Perubahan Modal</div>
                      <?php
									$modal = mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM modal"));
								$labaK = mysqli_query($connect,"
											SELECT SUM(jurnal_umum.kredit) AS labaK,
											jurnal_umum.tanggal
											FROM jurnal_umum INNER JOIN akun ON jurnal_umum.kode_akun=akun.kode_akun 
											WHERE jurnal_umum.tanggal AND akun.laba_rugi ='T'
										");
									$lbK = mysqli_fetch_array($labaK);

									$labaD = mysqli_query($connect,"
											SELECT SUM(jurnal_umum.debit) AS labaD,
											jurnal_umum.tanggal
											FROM jurnal_umum INNER JOIN akun ON jurnal_umum.kode_akun=akun.kode_akun 
											WHERE jurnal_umum.tanggal AND akun.laba_rugi ='B'
										");
									$lbD = mysqli_fetch_array($labaD);

									$total_laba = $lbK['labaK']-$lbD['labaD'];

									// $total_debit  = $lb['jml_debit'];
									// $total_kredit = $lb['jml_kredit'];
									// $total_laba   = $total_debit+$total_kredit;

									
										$prive = mysqli_fetch_array(mysqli_query($connect,"SELECT SUM(nominal) AS total_prive FROM prive"));
									
											$total = ($modal['nominal']+$total_laba)-$prive['total_prive'];
											
											?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
									<?php echo "Rp. ".number_format($total,0,',','.').""; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-bottom-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-m font-weight-bold text-success text-uppercase mb-1">AKTIVA</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                        <?php
												
                        $sqlL = mysqli_query($connect,"SELECT SUM(jurnal_umum.debit) AS jml_debit, SUM(jurnal_umum.kredit) AS jml_kredit, jurnal_umum.tanggal, jurnal_umum.kode_akun, akun.*
                            FROM jurnal_umum LEFT JOIN akun ON jurnal_umum.kode_akun=akun.kode_akun 
                            WHERE akun.posisi='L' AND akun.posisi !=''
                            GROUP BY jurnal_umum.kode_akun
                            ORDER BY jurnal_umum.id_jurnal ASC");													
                        while($rowsL=mysqli_fetch_array($sqlL)){
                        if($rowsL['grup']=='debit'){
                          $jml_debitL = $rowsL['jml_debit']-$rowsL['jml_kredit'];
                        }else{
                          $jml_kreditL = $rowsL['jml_kredit']-$rowsL['jml_debit'];
                        }
                        @$total_debitL += @$jml_debitL;
                        @$total_kreditL += @$jml_kreditL;
                        $totalL = $total_debitL+$total_kreditL;
                        }
                        ?>
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo "Rp. ".number_format(@$totalL,0,',','.').""; ?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-bottom-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-m font-weight-bold text-danger text-uppercase mb-1">Kewajiban dan Modal</div>
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
														
														if($rowsR['nama_akun']==$dataM){
														$jml_kredit = ($rowsR['jml_kredit']-$rowsR['jml_debit'])+$total_laba;
														$jml_kreditR = $jml_kredit - @$prive['total_prive'];
														}else{
														$jml_kreditR = $rowsR['jml_kredit']-$rowsR['jml_debit'];
														}@$total_debitR += @$jml_debitR;
													@$total_kreditR += @$jml_kreditR;
													$totalR = $total_debitR+$total_kreditR;
                          }
                          ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo "Rp. ".number_format(@$totalR,0,',','.').""; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-credit-card fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

        
          </div>