<?php
include "config/koneksi.php";
if(isset($_GET['id_fasilitas'])){
$query = mysqli_query ($connect,"Select * FROM fasilitas where id_fasilitas='$_GET[id_fasilitas]'") or die (mysql_error());
$result_edit = mysqli_fetch_array($query);
}
?>
      <!-- Static Table Start -->
      <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h5 class="m-0 font-weight-bold text-primary">Data Fasilitas</h5>
              <a href="halweb.php?pages=add_fasilitas" class="btn btn-primary float-right" role="button"><i class="fas fa-fw fa-plus"></i>Tambah</a>
            </div>
            
           <div class="card-body">
            
              <div class="table-responsive"> <table class="table table-bordered" id="dataTable" data-toggle="table" data-pagination="true" data-search="true" >
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Supplier</th>
                      <th>Alamat</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $no = 1;
                        $query  = mysqli_query($connect,"SELECT * FROM fasilitas");
                            while ($hasil = mysqli_fetch_array($query)) 
                                
                            { ?>
                                
                                <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $hasil['nama_fasilitas'];?></td>
                                <td><?php echo $hasil['deskripsi'];?></td>
                                <td>
                                <a class='btn btn-primary' href="halweb.php?pages=sup_add&status=edit&id=<?php echo $hasil['id'];?>"> <i class="fas fa-fw fa-edit"></i></a>
                                <a href='#' style='color:#fff;' class='btn btn-danger' onclick="if(confirm('Apakah yakin menghapus data ?')){window.location.href='halweb.php?pages=sup_proses&status=delete&id=<?php echo $hasil['id'];?>'}"><i class="fas fa-fw fa-trash"></i></a>
                                    </td>
                             </tr>   
                                      
                    <?php } ?>                 
                  </tbody>     
                </table>
                

              </div>
            </div>
          </div>
        