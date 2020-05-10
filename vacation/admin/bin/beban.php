<?php
include "config/koneksi.php";
if(isset($_GET['username'])){
$query = mysqli_query ($conn,"Select * FROM user where username='$_GET[username]'") or die (mysql_error());
$result_edit = mysqli_fetch_array($query);
}
$sql = "SELECT max(id_jurnal) FROM jurnal_umum";
$query = mysqli_query($connect, $sql);
$transaksi = mysqli_fetch_array($query);

if ($transaksi) {
    $nilai = substr($transaksi[0], 1);
    $kode = (int)$nilai;

    //tambahkan sebanyak + 1
    $kode = $kode + 1;
    $auto_kode = str_pad($kode, 5, "0",  STR_PAD_LEFT);
} else {
    $auto_kode = "00001";
}
?>       
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h5 class="m-0 font-weight-bold text-primary">Beban</h5>
              <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal"><i class="fas fa-fw fa-plus"></i>Tambah Transaksi</button>
            </div>
            
           <div class="card-body">
              <div class="table-responsive">
			  <table class="table table-bordered" id="dataTable" data-toggle="table" data-pagination="true" data-search="true" >									
                                       
                                        <thead>
                                            <tr>
                                                <th data-field="no" data-editable="true">No</th>
                                                <th data-field="tanggal" data-editable="true">Tanggal</th>
                                                <th data-field="nama_beban" data-editable="true">Nama Beban</th>
                                                <th data-field="keterangan" data-editable="true">Keterangan</th>
                                                <th data-field="nominal" data-editable="true">Jumlah</th>
                                                
                                            </tr>
                                        </thead>
                                           
                                        <tbody>
										<?php
											$no = 1;
											$query	= mysqli_query($connect,"SELECT * FROM beban");
												while ($hasil = mysqli_fetch_array($query)) 
													
												{ ?>
                                                <tr>
                                                    <td><?php echo $no++; ?></td>
													<td><?php echo $hasil['tanggal'];?></td>
                                                    
                                                    <td><?php echo $hasil['nama_beban'];?></td>
													<td><?php echo $hasil['keterangan'];?></td>
                                                   
                                                    <td> <?php echo "Rp. ".number_format($hasil['nominal'],2,',','.')."";?></td>
                                                  </tr>
										    <?php }?>
                                        </tbody>
                                    </table> 
              </div>
            </div>
          </div>
        <!-- Static Table Start -->
        <div class="data-table-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list">
                           <!-- Modal -->
                            <div class="modal fade" id="myModal" role="dialog">
                              <div class="modal-dialog">
                              
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Tambah Data Beban</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                                  <div class="modal-body">
										<form action="halweb.php?pages=proses&aksi=tambah-beban" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                                <label class="control-label" for="">Tanggal</label>
                                                <input type="date" name="tanggal" class="form-control" id="" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="">No Transaksi</label>
                                                <input type="text" readonly name="no_transaksi" class="form-control" placeholder="auto" id=""  value="<?php echo $auto_kode; ?>/JU/IV/2020">
                                            </div>
                                        <div class="form-group">
                                                <label class="control-label" for="">Akun</label>
                                                
                                                <select class="form-control" id="kode_akun" name="kode_akun"  required>
                                                <option  value="">Kode Akun</option>
                                                <?php
                                                $query=mysqli_query($connect,"SELECT*FROM akun WHERE kode_akun IN (51,52,53,54,55,56)");
                                                
                                                while($hasil=mysqli_fetch_array($query)){
                                                    echo "<option value='$hasil[kode_akun]'>$hasil[kode_akun]|$hasil[nama_akun]</option>";
                                                   
                                                }
                                                ?>
                                                                                                                
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="">Nama Beban</label>
                                                <select class="form-control"id="nama_beban" name="nama_beban" >
                                                <option  value="">Pilih Beban</option>
												<option value="Beban Listrik">Beban Listrik</option>
												<option value="Beban Sewa">Beban Sewa</option>
												<option value="Beban Serba-Serbi">Beban Serba-Serbi</option>
												</select>
                                            </div>
                                            
											<div class="form-group">
                                                <label class="control-label" for="">Keterangan</label>
                                                <textarea name="keterangan" class="form-control"></textarea>
                                            </div>
											
                                            <div class="form-group">
                                                <label class="control-label" for="">Nominal</label>
                                                <input type="number" name="nominal" class="form-control" id="" required>
                                            </div>
                                                                                                                       
                                            </select>
                                            <div class="form-group">                                         
                                            <div class="modal-footer">
                                             <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success" name="tambah"><i class="fas fa-fw fa-save"></i>Simpan</button>
                                                </div>
                                            </div>
                                            </form>
                                            
                                  </div>
                                </div>
                            </div>
                        </div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        