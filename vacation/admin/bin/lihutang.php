   <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary">List Hutang Dagang</h4>
              <a class="btn btn-primary float-right" href="halweb.php?pages=pelunasan_hutang" role="button" ><i class="fas fa-fw close-door"></i> Kembali</a>
            </div>
            
           <div class="card-body">
              <div class="table-responsive">
			  <table class="table table-bordered" id="dataTable" data-toggle="table" data-pagination="true" data-search="true" >									
                        <thead>
                            <tr>
                            <th data-field="no" data-editable="true">No</th>
                                <th data-field="tanggal" data-editable="true">Tanggal</th>
                                <th data-field="id_transaksi" data-editable="true">No Transaksi</th>
                                <th data-field="id_pelanggan" data-editable="true">Nama Supplier</th>
                                <th data-field="harga" data-editable="true">Produk</th>
                                <th data-field="harga" data-editable="true">Jumlah Hutang</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $no = 1;
                            $query	= mysqli_query($connect,"SELECT A.*, B.nama AS supplier, C.nama_produk AS produk FROM hutang AS A 
                            LEFT JOIN supplier AS B ON(A.id_supplier = B.id)
                            LEFT JOIN produk AS C ON(A.id_produk = C.id_produk)");
                                while ($hasil = mysqli_fetch_array($query)) 
                                    
                                { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $hasil['tanggal'];?></td>
                                    <td><?php echo $hasil['id_hutang'];?></td>
                                    <td><?php echo $hasil['supplier'];?></td>
                                    <td><?php echo $hasil['produk'];?></td>
                                    <td><?php echo $hasil['jumlah_hutang'];?></td>
                                   
                                    </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                     
              </div>
            </div>
          </div>