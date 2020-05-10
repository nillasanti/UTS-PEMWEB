   <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
           
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-bottom-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-m font-weight-bold text-primary text-uppercase mb-1">Member</div>
                      <?php    
                          $kueri = mysqli_query($connect, "SELECT * FROM user WHERE status ='member'");
       
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

                        <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-bottom-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-m font-weight-bold text-primary text-uppercase mb-1">Mitra</div>
                      <?php    
                          $kueri = mysqli_query($connect, "SELECT * FROM user WHERE status ='mitra'");
       
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
