<?php
 include "config/koneksi.php";
 ?>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIABADI CETAK</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo $base_url;?>includes/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo $base_url;?>includes/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?php echo $base_url;?>incliudes/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
<?php
if (isset($_POST['range'])){
    $awal = $_POST['awal'];
    $akhir = $_POST['akhir'];

//    echo $awal."dan"."$akhir";

    if ($awal != null){
        
        $tang = 1;
    }else {
        $tang = 0;
    }
} else {
    $tang = 0;
}
?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Buku Besar</h6>
            </div>
            
           <div class="card-body">
           <div class="table-responsive">
			  <table class="table table-bordered" id="dataTable" data-toggle="table" data-pagination="true" data-search="true" >									
                                      <tbody>
										<?php
											
                                            $sql	= "SELECT * FROM akun";
                                            $query = mysqli_query($connect,$sql);
                                                while ($hasil = mysqli_fetch_array($query)) 

                                               {?>
                                                <tr>
                                                   <tr>
                                                        <th colspan="4"><b>Nama Akun : <?=$hasil['nama_akun']?></b></th>
                                                        <th colspan="3"><div align="right"><b>Kode Akun : <?=$hasil['kode_akun']?></b></div></th>
                                                    </tr>
                                                    <tr>
                                                        <th rowspan="2" class="center" width="8%"><b>Tanggal</b></th>
                                                        <th rowspan="2" class="center" width="26%"><b>Keterangan</b></th>
                                                        <th rowspan="2" class="right" width="16%"><b>Debit</b></th>
                                                        <th rowspan="2" class="right" width="16%"><b>Kredit</b></th>
                                                        <th colspan="2" class="center"><b>Saldo</b></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="right" width="16%"><b>Debit</b></th>
                                                        <th class="right" width="16%"><b>Kredit</b></th>
                                                    </tr>                                  
                                                </tr>
                                            <?php
                                            
    
                                                        $kode_akun = $hasil['kode_akun'];
                                                        if($tang == 1) {
                                                            $sal = mysqli_query($connect,"SELECT * FROM jurnal_umum WHERE kode_akun=$kode_akun and tanggal BETWEEN '$awal' and '$akhir'ORDER BY tanggal ASC");
                                                        } else {
                                                            $sal = mysqli_query($connect,"SELECT * FROM jurnal_umum WHERE kode_akun=$kode_akun ORDER BY tanggal ASC");
                                                        }
                                //                        $sal = mysqli_query($connect,"SELECT * FROM jurnal_umum WHERE kode_akun=$kode_akun");
                                
                                                        $hitung = mysqli_num_rows($sal);
                                
                                                        $saldo11 = mysqli_fetch_array($sal);
                                
                                                        $saldo = 0;
                                                        $posisi = "";
                                
                                
                                                        if(@$saldo11['debit'] == 0){
                                                            $saldo = @$saldo11['kredit'];
                                                            $posisi = "kanan";
                                                        }else{
                                                            $saldo = @$saldo11['debit'];
                                                            $posisi = "kiri";
                                                        }
                                
                                                        $hitung2 = 1;
                                                        if($tang == 1) {
                                                            $query222 = "SELECT * FROM jurnal_umum WHERE kode_akun=$kode_akun and tanggal BETWEEN '$awal' and '$akhir' ORDER BY tanggal ASC";
                                                        } else {
                                                            $query222 = "SELECT * FROM jurnal_umum WHERE kode_akun=$kode_akun ORDER BY tanggal ASC";
                                                        }
                                //                        $query222 = "SELECT * FROM jurnal_umum WHERE kode_akun=$kode_akun";
                                                        $querys	= mysqli_query($connect, $query222);
                                                        $no =0;
                                                        while($rows1=mysqli_fetch_array($querys)){ $no++;
                                                        ?>
                                                        <tr>
                                                    <td class="center"><?php echo @$rows1['tanggal']//$tglstr; ?></td>
                                                    <td class="center"><?php echo @$rows1['tipe']; ?></td>
                                                    <td class="right">
                                                        <?php echo "Rp. ".number_format(@$rows1['debit'],2,',','.').""; ?>
                                                    </td>
                                                    <td class="right">
                                                        <?php echo "Rp. ".number_format(@$rows1['kredit'],2,',','.').""; ?>
                                                    </td>
                                                    <?php

                                                        
if($posisi == "kiri"){
    if($rows1['debit'] == 0){
        $saldo = $saldo - @$rows1['kredit'];
        $salD = $saldo;
        $salK = 0;
    }else{
        if($no == 1){
            $salD=$saldo;
            $salK=0;
        } else {
            $saldo =  $saldo + @$rows1['debit'];
            $salD = $saldo;
            $salK = 0;
        }
    }

}else {
    if($rows1['kredit'] == 0){
        $saldo = $saldo - @$rows1['debit'];
        $salD = 0;
        $salK = $saldo;
    }else{
        if($no == 1){
            $salD=0;
            $salK=$saldo;
        } else {
            $saldo = $saldo + @$rows1['kredit'];
            $salD = 0;
            $salK = $saldo;
        }
    }
}
?>
<?php
$warna = "";
if($hitung2 == $hitung)
    $warna = " style='color:#fff;background:#3e64d3;'";

?>
<td align ="right" class="center" <?=$warna?>>
    <?php
    if($hitung2 == $hitung)
    echo "<b>Rp.".number_format($salD)."</b>";
    else echo "Rp.".number_format($salD);
    ?></td>
<td align ="right" class="center" <?=$warna?>>
    <?php
    if($hitung2 == $hitung)
        echo "<b>Rp.".number_format($salK)."</b>";
    else echo "Rp.".number_format($salK);
    ?></td>
</tr>
<?php $hitung2++; } ?>
                                        </tbody>
                                        <?php } ?>
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script>
    window.print();
</script>
 