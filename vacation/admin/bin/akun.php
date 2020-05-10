  <?php
include "config/koneksi.php";
if(isset($_GET['id_akun'])){
$query = mysqli_query ($connect,"Select * FROM akun where id_akun='$_GET[id_akun]'") or die (mysql_error());
$result_edit = mysqli_fetch_array($query);
}
?>
      <!-- Static Table Start -->
      <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h5 class="m-0 font-weight-bold text-primary">Bagan akun</h5>
              <a href="halweb.php?pages=akun_tambah" class="btn btn-primary float-right" role="button"><i class="fas fa-fw fa-plus"></i>Tambah</a>
            </div>
            
           <div class="card-body">            
              <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" data-toggle="table" data-pagination="true" data-search="true" >
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode</th>
                      <th>Nama akun</th>
                      
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $no = 1;
                        $query  = mysqli_query($connect,"SELECT * FROM akun");
                            while ($hasil = mysqli_fetch_array($query)) 
                                
                            { ?>
                                
                                <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $hasil['kode_akun'];?></td>
                                <td><?php echo $hasil['nama_akun'];?></td>
                                <td>
                                <a class='btn btn-primary' href="halweb.php?pages=akun_tambah&status=edit&kode_akun=<?php echo $hasil['kode_akun'];?>"><i class="fas fa-fw fa-edit"></i>Edit</a>
                                    <a href='#' style='color:#fff;' class='btn btn-danger' onclick="if(confirm('Apakah yakin menghapus data ?')){window.location.href='halweb.php?pages=akun_proses&status=delete&kode_akun=<?php echo $hasil['kode_akun'];?>'}"><i class="fas fa-fw fa-trash"></i>Delete</a>
                                    </td>
                             </tr>  
     
                    <?php } ?>                            
                  </tbody>         
                </table>
                

              </div>
            </div>
          </div>
        