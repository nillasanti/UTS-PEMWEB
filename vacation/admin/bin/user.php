<?php
include"config/koneksi.php";
if(isset($_GET['username'])){
  $query = mysqli_query($connect, "SELECT * FROM user where username = '$_GET[username]'") or die(mysql_error());
  $result = mysqli_fetch_array($query);
}
?>
 <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h5 class="m-0 font-weight-bold text-primary">Data User</h5>
              <a class="btn btn-primary float-right" href="halweb.php?pages=tambah_user"><i class="fas fa-fw fa-plus"></i>Tambah</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead style="text-align: center">
                    <tr>
                      <th>No</th>
                      <th>Nama Lengkap</th>
                      <th>Username</th>
                      <th>Level</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody style="text-align: center">
                    <?php $no=1; 
                      $query = mysqli_query($connect, "SELECT * FROM user");
                      while($hasil=mysqli_fetch_array($query)){
                    ?>
                    <tr>
                      <td> <?php echo $no++; ?> </td>
                      <td> <?php echo $hasil['nama']; ?> </td>
                      <td> <?php echo $hasil['username']; ?> </td>
                      <td> <?php echo $hasil['level']; ?> </td>
                      <td>
                        <a class="btn btn-success text-white" href="halweb.php?pages=viewuser&username=<?php echo $hasil['username'];?>"><i class="fas fa-fw fa-list-alt"></i>View</a>
                        <a class='btn btn-primary' href="halweb.php?pages=tambah_user&status=edit&username=<?php echo $hasil['username'];?>"><i class="fas fa-fw fa-edit"></i>edit</a>
                        <a href='#' style='color:#fff;' class='btn btn-danger' onclick="if(confirm('Apakah yakin menghapus data ?')){window.location.href='halweb.php?pages=userp_proses&status=delete&username=<?php echo $hasil['username'];?>'}"><i class="fas fa-fw fa-trash"></i>Hapus</a>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>