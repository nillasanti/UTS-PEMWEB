<?php
$ambil=$_GET['aksi'];
if($ambil=="tambah-user")
{
    $status = @$_POST['status'];
    $user 	= @$_POST['txtuser'];
    $email 	= @$_POST['txtemail'];
    $pass	= @$_POST['txtpass'];
    $nama	= @$_POST['txtnama'];
    $level	= @$_POST['txtlevel'];

    $tambah	= mysqli_query ($connect,"INSERT INTO user VALUES ('$nama','$email','$user','$pass','$level')")or die (mysqli_error());
		if ($tambah=true){
            echo"<script>alert('Tambah Data Berhasil');</script>";
            echo '<meta http-equiv="Refresh" content="0; url=halweb.php?pages=data-user"/>';
		}else {
			echo"<script>alert('Tambah Data Tidak Berhasil');</script>";
		}
} 
else if($ambil=="edit-user")
{
    $status = @$_POST['status'];
    $user 	= @$_POST['txtuser'];
    $email 	= @$_POST['txtemail'];
    $pass	= @$_POST['txtpass'];
    $nama	= @$_POST['txtnama'];
    $level	= @$_POST['txtlevel'];

    $edit	= "UPDATE user SET Username='$user',Password='$pass',Email='$email', Nama='$nama',Level='$level'";
		$edit .="WHERE Username='$user'";
		$edit	= mysqli_query($connect,$edit) or die (mysqli_error());
		if ($edit=true){
            echo"<script>alert('Update Data Berhasil');</script>";
            echo '<meta http-equiv="Refresh" content="0; url=halweb.php?pages=data-user"/>';

		}else {
			echo"<script>alert('Update Data Tidak Berhasil');</script>";
		}
}
else if($ambil=="hapus-user")
{
    $status = @$_POST['status'];
    $user 	= @$_POST['txtuser'];
    $email 	= @$_POST['txtemail'];
    $pass	= @$_POST['txtpass'];
    $nama	= @$_POST['txtnama'];
    $level	= @$_POST['txtlevel'];

    $id =$_GET['username'];
	$tambah	= mysqli_query ($connect,"DELETE FROM user WHERE Username ='$id'")or die (mysql_error());
		if ($tambah=true){
            echo"<script>alert('Delete Data Berhasil');</script>";
            echo '<meta http-equiv="Refresh" content="0; url=halweb.php?pages=data-user"/>';
		}else {
			echo"<script>alert('Delete Data Tidak Berhasil');</script>";
		}
    }
else if($ambil=="tambah-akun")
{
    $status = @$_POST['status'];
    $id_akun = @$_POST['id_akun'];
    $nama_akun 	= @$_POST['nama_akun'];



    $tambah	= mysqli_query ($connect,"INSERT INTO akun VALUES ('$id_akun','$nama_akun')")or die (mysqli_error());
		if ($tambah=true){
            echo"<script>alert('Tambah Data Berhasil');</script>";
            echo '<meta http-equiv="Refresh" content="0; url=halweb.php?pages=data-akun"/>';
		}else {
			echo"<script>alert('Tambah Data Tidak Berhasil');</script>";
		}
} 
else if($ambil=="hapus-akun")
{
    $status = @$_POST['status'];
    $id_akun = @$_POST['id_akun'];
    $nama_akun 	= @$_POST['nama_akun'];


    $id_akun =$_GET['id_akun'];
    $tambah	= mysqli_query ($connect,"DELETE FROM akun WHERE id_akun ='$id_akun'")or die (mysql_error());
		if ($tambah=true){
            echo"<script>alert('hapus akun Berhasil');</script>";
            echo '<meta http-equiv="Refresh" content="0; url=halweb.php?pages=data-akun"/>';
		}else {
			echo"<script>alert('Hapus akun Tidak Berhasil');</script>";
		}
} 
else if($ambil=="edit-akun")
{
      $status = @$_POST['status'];
      $id_akun = @$_POST['id_akun'];
      $nama_akun 	= @$_POST['nama_akun'];


    $edit	= "UPDATE akun SET id_akun='$id_akun',nama_akun='$nama_akun'";
		$edit .="WHERE id_akun='$id_akun'";
		$edit	= mysqli_query($connect,$edit) or die (mysqli_error());
		if ($edit=true){
            echo"<script>alert('Update Data Berhasil');</script>";
            echo '<meta http-equiv="Refresh" content="0; url=halweb.php?pages=data-akun"/>';

		}else {
			echo"<script>alert('Update Data Tidak Berhasil');</script>";
		}
}
else if($ambil=="tambah-beban")
{
    $status = @$_POST['status'];
    $tanggal = @$_POST['tanggal'];
    $id_beban = @$_POST['id_beban'];
    $kode_akun	= @$_POST['kode_akun'];
    $nama_beban=@$_POST['nama_beban'];
    $nominal	= @$_POST['nominal'];
    $keterangan=@$_POST['keterangan'];
    $no_transaksi=@$_POST['no_transaksi'];

    

    $tambah	= mysqli_query ($connect,"INSERT INTO beban VALUES ('','$tanggal','$kode_akun','$nama_beban','$nominal','$keterangan','$no_transaksi')")or die (mysqli_error());
  
    $tambah1=mysqli_query ($connect,"INSERT INTO jurnal_umum VALUES ('','$no_transaksi','$kode_akun','$nama_beban','$keterangan','$tanggal','$nominal','0')")or die (mysqli_error());
    $tambah2=mysqli_query ($connect,"INSERT INTO jurnal_umum VALUES ('','$no_transaksi','11','$nama_beban','$keterangan','$tanggal','0','$nominal')")or die (mysqli_error());
    

    if ($tambah=true AND $tambah1=true AND $tambah2=true){
    echo"<script>alert('Tambah Data Berhasil');</script>";
    echo "<meta http-equiv='Refresh' content='0; url=halweb.php?pages=beban'/>";
    }else {
          echo"<script>alert('Tambah Data Tidak Berhasil');</script>";
    }
} 

else if($ambil=="tambah-pengeluaran")
{
    $status = @$_POST['status'];
    $tanggal = @$_POST['tanggal'];
    $id_pengeluaran = @$_POST['id_pengeluaran'];
    $kode_akun	= @$_POST['kode_akun'];
    $nama =@$_POST['nama_pengeluaran'];
    $nominal	= @$_POST['nominal'];
    $keterangan=@$_POST['keterangan'];
    $no_transaksi=@$_POST['no_transaksi'];
    $tambah	= mysqli_query ($connect,"INSERT INTO pengeluaran VALUES ('$id_pengeluaran','$tanggal','$nama','$nominal','$keterangan')");
    $tambah1=mysqli_query ($connect,"INSERT INTO jurnal_umum VALUES ('','$no_transaksi','$kode_akun','$nama','$keterangan','$tanggal','$nominal','0')")or die (mysqli_error());
    $tambah2=mysqli_query ($connect,"INSERT INTO jurnal_umum VALUES ('','$no_transaksi','11','$nama','$keterangan','$tanggal','0','$nominal')")or die (mysqli_error());
    if ($tambah=true AND $tambah1=true AND $tambah2=true){
    echo"<script>alert('Tambah Data Berhasil');</script>";
    echo "<meta http-equiv='Refresh' content='0; url=halweb.php?pages=pengeluaran'/>";
    }else {
          echo"<script>alert('Tambah Data Tidak Berhasil');</script>";
    }
} 
else if($ambil=="tambah-pemasukan")
{
      $tanggal=@$_POST['tanggal'];
      $program =@$_POST['program'];
      $kodeakun =@$_POST['id_transaksi'];
      $keterangan = @$_POST['keterangan'];
      $siswa	=@$_POST['siswa'];
      $hutang = @$_POST['hutang'];
      $jum = @$_POST['jumlah'];
	    $a1 = mysqli_query($connect,"SELECT * from produk where id_produk='$program'");
	    $har = mysqli_fetch_array($a1);
      $juml=$har['jumlah'];
      $harga = $har['harga_jual'];
      if($hutang==true){
        $hartot= $harga*$jum;
        $sebagian = $hartot-$hutang;
        $jj=$juml-$jum;
        $tambah = mysqli_query($connect,"INSERT INTO pemasukan VALUES ('$kodeakun','$tanggal','$siswa','$program','$jum','$sebagian')");
        $tambah1=mysqli_query ($connect,"INSERT INTO jurnal_umum VALUES ('','$kodeakun','11','Pendapatan Penjualan','$keterangan','$tanggal','$sebagian','0')")or die (mysqli_error());
        $tambah2=mysqli_query ($connect,"INSERT INTO jurnal_umum VALUES ('','$kodeakun','12','Piutang penjualan','$keterangan','$tanggal','$hutang','0')")or die (mysqli_error());
        $tambah3=mysqli_query ($connect,"INSERT INTO jurnal_umum VALUES ('','$kodeakun','41','Pendapatan penjualan','$keterangan','$tanggal','0','$hartot')")or die (mysqli_error());
        $tambah4=mysqli_query($connect,"INSERT INTO piutang VALUES ('$kodeakun','$tanggal','$siswa','$program','$hutang','$keterangan')")or die(mysql_error());
        $edit="UPDATE produk SET jumlah='$jj'";
        $edit .= "WHERE id_produk='$program'";
        $edit = mysqli_query($connect,$edit) or die (mysqli_error($connect));
      }else{
        $hartot=$harga*$jum;
        $jj=$juml-$jum;
        $tambah = mysqli_query($connect,"INSERT INTO pemasukan VALUES ('$kodeakun','$tanggal','$siswa','$program','$jum','$hartot')");
        $tambah1=mysqli_query($connect,"INSERT INTO jurnal_umum VALUES ('','$kodeakun','11','Pendapatan Penjualan','$keterangan','$tanggal','$hartot','0')")or die (mysqli_error());
        $tambah3=mysqli_query($connect,"INSERT INTO jurnal_umum VALUES ('','$kodeakun','41','Pendapatan penjualan','$keterangan','$tanggal','0','$hartot')")or die (mysqli_error());
                $edit="UPDATE produk SET jumlah='$jj'";
        $edit .= "WHERE id_produk='$program'";
        $edit = mysqli_query($connect,$edit) or die (mysqli_error($connect));
      }
      
      
    if ($tambah=true AND $tambah1=true AND $tambah2=true){
    echo"<script>alert('Tambah Data Berhasil');</script>";
    echo '<meta http-equiv="Refresh" content="0; url=halweb.php?pages=penjualan"/>';
    }else {
          echo"<script>alert('Tambah Data Tidak Berhasil');</script>";
    }

} else if($ambil=="pelunasan_piutang")
{
      $tanggal=@$_POST['tanggal'];
      $kodeakun =@$_POST['id_transaksi'];
      $program =@$_POST['program'];
      $keterangan = @$_POST['keterangan'];
      $siswa  =@$_POST['siswa'];
      $hutang = @$_POST['hutang'];
      $jum = @$_POST['jumlah'];
      $a1 = mysqli_query($connect,"SELECT * from piutang where id_piutang='$program'");
      $har = mysqli_fetch_array($a1);
      $harga = $har['jumlah_piutang'];
      if($jum<$harga){
        $sisa= $harga-$jum;
        $tambah = mysqli_query($connect,"INSERT INTO pelunasan_piutang VALUES ('$kodeakun','$tanggal','$siswa','$program','$sisa','$jum')");
        $tambah1=mysqli_query ($connect,"INSERT INTO jurnal_umum VALUES ('','$kodeakun','11','Pelunasan Piutang','$keterangan','$tanggal','$jum','0')")or die (mysqli_error());
        $tambah2=mysqli_query ($connect,"INSERT INTO jurnal_umum VALUES ('','$kodeakun','12','Pelunasan Piutang','$keterangan','$tanggal','0','$jum')")or die (mysqli_error());
        $edit="UPDATE piutang SET jumlah_piutang='$sisa'";
        $edit .= "WHERE id_piutang='$program'";
        $edit = mysqli_query($connect,$edit) or die (mysqli_error());
      }elseif($harga==$jum){
        $sisa= $harga-$jum;
        $tambah = mysqli_query($connect,"INSERT INTO pelunasan_piutang VALUES ('$kodeakun','$tanggal','$siswa','$program','Lunas','$jum')");
        $tambah1=mysqli_query($connect,"INSERT INTO jurnal_umum VALUES ('','$kodeakun','11','Pelunasan Piutang','$keterangan','$tanggal','$jum','0')")or die (mysqli_error());
        $tambah2=mysqli_query($connect,"INSERT INTO jurnal_umum VALUES ('','$kodeakun','12','Pelunasan piutang','$keterangan','$tanggal','0','$jum')")or die (mysqli_error());
        $del=mysqli_query($connect,"DELETE FROM piutang WHERE id_piutang='$program'")or die(mysqli_error($connect));
      }
    if ($tambah=true AND $tambah1=true AND $tambah2=true){
    echo"<script>alert('Tambah Data Berhasil');</script>";
    echo '<meta http-equiv="Refresh" content="0; url=halweb.php?pages=pelunasan_piutang"/>';
    }else {
          echo"<script>alert('Tambah Data Tidak Berhasil');</script>";
    }
} 
else if($ambil=="tambah-modal")
{
      $tanggal=@$_POST['tanggal'];
      $kode_akun=@$_POST['kode_akun'];
     $keterangan=@$_POST['keterangan'];  
      $nominal=@$_POST['nominal'];
      $no_transaksi=@$_POST['no_transaksi'];
    

    $tambah	= mysqli_query ($connect,"INSERT INTO modal VALUES ('','$tanggal','$kode_akun','$keterangan','$nominal','$no_transaksi')") or die (mysqli_error());
    $tambah1=mysqli_query ($connect,"INSERT INTO jurnal_umum VALUES ('','$no_transaksi','11','Modal Awal','$keterangan','$tanggal','$nominal','0')")or die (mysqli_error());
    $tambah2=mysqli_query ($connect,"INSERT INTO jurnal_umum VALUES ('','$no_transaksi','$kode_akun','Modal Awal','$keterangan','$tanggal','0','$nominal')")or die (mysqli_error());
    if ($tambah=true AND $tambah1=true AND $tambah2=true){
    echo"<script>alert('Tambah Data Berhasil');</script>";
    echo '<meta http-equiv="Refresh" content="0; url=halweb.php?pages=modal"/>';
    }else {
          echo"<script>alert('Tambah Data Tidak Berhasil');</script>";
    }
}  
else if($ambil=="tambah-prive")
{
    $status = @$_POST['status'];
    $tanggal = @$_POST['tanggal'];
    $kode_akun	= @$_POST['kode_akun'];
    $keterangan=@$_POST['keterangan'];
    $nominal	= @$_POST['nominal'];
    $no_transaksi=@$_POST['no_transaksi'];

    $tambah	= mysqli_query ($connect,"INSERT INTO prive VALUES ('','$kode_akun','$tanggal','$keterangan','$nominal','$no_transaksi')")or die (mysqli_error());

    $tambah1=mysqli_query ($connect,"INSERT INTO jurnal_umum VALUES ('','$no_transaksi','$kode_akun','Prive','$keterangan','$tanggal','$nominal','0')")or die (mysqli_error());
    $tambah2=mysqli_query ($connect,"INSERT INTO jurnal_umum VALUES ('','$no_transaksi','11','Prive','$keterangan','$tanggal','0','$nominal')")or die (mysqli_error());
    
    if ($tambah=true AND $tambah1=true AND $tambah2=true){
    echo"<script>alert('Tambah Data Berhasil');</script>";
    echo '<meta http-equiv="Refresh" content="0; url=halweb.php?pages=prive"/>';
    }else {
          echo"<script>alert('Tambah Data Tidak Berhasil');</script>";
    }
}elseif($ambil=="tambah-pproduk"){

 $tanggal=@$_POST['tanggal'];
      $program =@$_POST['program'];
      $kodeakun =@$_POST['no_transaksi'];
      $keterangan = @$_POST['keterangan'];
      $siswa  =@$_POST['siswa'];
      $hutang = @$_POST['hutang'];
      $jum = @$_POST['jumlah'];
      $a1 = mysqli_query($connect,"SELECT * from produk where id_produk='$program'");
      $har = mysqli_fetch_array($a1);
      $juml=$har['jumlah'];
      $harga = $har['harga_beli'];
      if($hutang==true){
        $hartot= $harga*$jum;
        $sebagian = $hartot-$hutang;
        $jj= $juml+$jum;
        $tambah = mysqli_query($connect,"INSERT INTO p_produk VALUES ('$kodeakun','$tanggal','$program','$jum','$siswa','$hartot','$keterangan')");
        $tambah1=mysqli_query ($connect,"INSERT INTO jurnal_umum VALUES ('','$kodeakun','16','Pembelian Barang Bagang','$keterangan','$tanggal','$hartot','0')")or die (mysqli_error());
        $tambah2=mysqli_query ($connect,"INSERT INTO jurnal_umum VALUES ('','$kodeakun','11','Pembelian Barang Dagang','$keterangan','$tanggal','0','$sebagian')")or die (mysqli_error());
        $tambah3=mysqli_query ($connect,"INSERT INTO jurnal_umum VALUES ('','$kodeakun','21','Hutang Barang Dagang','$keterangan','$tanggal','0','$hutang')")or die (mysqli_error());
        $tambah4=mysqli_query($connect,"INSERT INTO hutang VALUES ('$kodeakun','$tanggal','$keterangan','$siswa','$program','$hutang')")or die(mysql_error());
        $edit="UPDATE produk SET jumlah='$jj'";
        $edit .= "WHERE id_produk='$program'";
        $edit = mysqli_query($connect,$edit) or die (mysqli_error($connect));
      }else{
        $hartot=$harga*$jum;
        $jj= $juml+$jum;
        $tambah = mysqli_query($connect,"INSERT INTO p_produk VALUES ('$kodeakun','$tanggal','$program','$jum','$siswa','$hartot','$keterangan')");
        $tambah1=mysqli_query($connect,"INSERT INTO jurnal_umum VALUES ('','$kodeakun','16','Pembelian Barang Dagang','$keterangan','$tanggal','$hartot','0')")or die (mysqli_error());
        $tambah3=mysqli_query($connect,"INSERT INTO jurnal_umum VALUES ('','$kodeakun','11','Pembelian Barang Dagang','$keterangan','$tanggal','0','$hartot')")or die (mysqli_error());
        $edit="UPDATE produk SET jumlah='$jj'";
        $edit .= "WHERE id_produk='$program'";
        $edit = mysqli_query($connect,$edit) or die (mysqli_error($connect));
      }
      
    if ($tambah=true AND $tambah1=true AND $tambah2=true AND $tambah3=true AND $edit=true){
    echo"<script>alert('Tambah Data Berhasil');</script>";
    echo '<meta http-equiv="Refresh" content="0; url=halweb.php?pages=pembelian_produk"/>';
    }else {
          echo"<script>alert('Tambah Data Tidak Berhasil');</script>";
    }
}elseif($ambil=="pelunasan_hutang"){

      $tanggal=@$_POST['tanggal'];
      $kodeakun =@$_POST['id_transaksi'];
      $program =@$_POST['program'];
      $keterangan = @$_POST['keterangan'];
      $siswa  =@$_POST['siswa'];
      $hutang = @$_POST['hutang'];
      $jum = @$_POST['jumlah'];
      $a1 = mysqli_query($connect,"SELECT * from hutang where id_hutang='$program'");
      $har = mysqli_fetch_array($a1);
      $harga = $har['jumlah_hutang'];
      if($jum<$harga){
        $sisa= $harga-$jum;
        $tambah = mysqli_query($connect,"INSERT INTO pelunasan_hutang VALUES ('$kodeakun','$tanggal','$siswa','$program','$sisa','$jum')");
        $tambah2=mysqli_query ($connect,"INSERT INTO jurnal_umum VALUES ('','$kodeakun','21','Pelunasan Hutang','$keterangan','$tanggal','$jum','0')")or die (mysqli_error());
        $tambah1=mysqli_query ($connect,"INSERT INTO jurnal_umum VALUES ('','$kodeakun','11','Pelunasan Hutang','$keterangan','$tanggal','0','$jum')")or die (mysqli_error());
        $edit="UPDATE hutang SET jumlah_hutang='$sisa'";
        $edit .= "WHERE id_hutang='$program'";
        $edit = mysqli_query($connect,$edit) or die (mysqli_error());
      }elseif($harga==$jum){
        $sisa= $harga-$jum;
        $tambah = mysqli_query($connect,"INSERT INTO pelunasan_hutang VALUES ('$kodeakun','$tanggal','$siswa','$program','$sisa','$jum')");
        $tambah1=mysqli_query($connect,"INSERT INTO jurnal_umum VALUES ('','$kodeakun','21','Pelunasan Hutang Dagang','$keterangan','$tanggal','$jum','0')")or die (mysqli_error());
        $tambah2=mysqli_query($connect,"INSERT INTO jurnal_umum VALUES ('','$kodeakun','11','Pelunasan Hutang Dagang','$keterangan','$tanggal','0','$jum')")or die (mysqli_error());
        $del=mysqli_query($connect,"DELETE FROM hutang WHERE id_hutang='$program'")or die(mysqli_error());
      }
    if ($tambah=true AND $tambah1=true AND $tambah2=true){
    echo"<script>alert('Tambah Data Berhasil');</script>";
    echo '<meta http-equiv="Refresh" content="0; url=halweb.php?pages=pelunasan_hutang"/>';
    }else {
          echo"<script>alert('Tambah Data Tidak Berhasil');</script>";
    }
}
?>
