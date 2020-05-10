<?php
 include "config/koneksi.php";
 ?>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIAbadi Cetak</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo $base_url;?>includes/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo $base_url;?>includes/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?php echo $base_url;?>incliudes/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
<?php
 
 if (isset($_POST['range'])){
     $awal= $_POST['awal'];
     $akhir = $_POST['akhir'];
   
   //    echo $awal."dan"."$akhir";
   
     if ($awal != null){
         
         
         $tang = 1;
         $total = mysqli_fetch_array(mysqli_query($connect,"select SUM(debit) as debit from jurnal_umum WHERE tanggal BETWEEN '$awal' and '$akhir'"));
         $total2 = mysqli_fetch_array(mysqli_query($connect,"select SUM(kredit) as kredit from jurnal_umum WHERE tanggal BETWEEN '$awal' and '$akhir'"));
     }else {
         $tang = 0;
         $total = mysqli_fetch_array(mysqli_query($connect,"select SUM(debit) as debit from jurnal_umum"));
         $total2 = mysqli_fetch_array(mysqli_query($connect,"select SUM(kredit) as kredit from jurnal_umum"));
     }
   } else {
     $tang = 0;
     $total = mysqli_fetch_array(mysqli_query($connect,"select SUM(debit) as debit from jurnal_umum"));
     $total2 = mysqli_fetch_array(mysqli_query($connect,"select SUM(kredit) as kredit from jurnal_umum"));
   }
 ?>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
                <div class="card-body">
                    <div class="body table-responsive">


                        <table class="table table-bordered table-striped table-hover dataTable js-exportable" width="100%">
                            <thead>
                            <tr align="center">
                                <td colspan="7"> <h1>Jaya Abadi Audio</h1></td>
                            </tr>
                            <tr align="center">
                                <td colspan="7"> <h1>Laporan Jurnal Umum</h1></td>
                            </tr>
                            <tr align="center">
                                <th width="2%">no</th>
                                <th width="15%">Tanggal</th>
                                <th class="center" width="15%">Nomor Bukti</th>
                                <th class="center" width="22%">Keterangan</th>
                                <th class="center" width="6%">Ref</th>
                                <th class="center" width="15%">Debit</th>
                                <th class="center" width="15%">Kredit</th>
                            </tr>

                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            $query = mysqli_query($connect,"select DISTINCT(id_jurnal),keterangan from jurnal_umum");
                            while ($tampil = mysqli_fetch_array($query)) {
                                $id = @$tampil['id_jurnal'];
                                $cek = 0;

                                if($tang == 1) {
                                    $query2 = mysqli_query($connect,"select A.*, B.nama_akun AS akun from jurnal_umum AS A 
                                    LEFT JOIN akun AS B ON (A.kode_akun = B.kode_akun) 
                                    WHERE A.id_jurnal='$id' and A.tanggal BETWEEN '$awal' and '$akhir'");
                                } else {
                                    $query2 = mysqli_query($connect,"select A.*, B.nama_akun AS akun from jurnal_umum AS A 
                                    LEFT JOIN akun AS B ON (A.kode_akun = B.kode_akun) 
                                    WHERE A.id_jurnal='$id'");
                                }

                                $op = 0;

                                while ($tampil2 = mysqli_fetch_array($query2)) {
                                    $op++;
                                    $ama =@$tampil2['keterangan'];
                            ?>
                            <tr>
                                <td align="center"><?php  if ($cek == 0) echo $no.")";?></td>
                                <td align="center"><?=date('d F Y', strtotime(@$tampil2['tanggal']));?></td>
                                <td class="center"><?=@$tampil2['id_jurnal']?></td>
                                <td class="left"><?=@$tampil2['akun']?></td>
                                <td align="center"><?=@$tampil2['kode_akun']?></td>
                                <td>Rp.<?=number_format(@$tampil2['debit'])?></td>
                                <td>Rp.<?=number_format(@$tampil2['kredit'])?></td>
                            </tr>

                            <?php $cek++;}?>
                                <?php
                                if($op == 0){

                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td align="center"><i><?= $ama ?></i></td>
                                        <td colspan="3"></td>
                                    </tr>
                                    <?php
                                }
                                    ?>
<!--                                <tr  height="10px">-->
<!--                                    <td bgcolor="#b0c4de" colspan="7"></td>-->
<!--                                </tr>-->
                                <?php $no++; ?>
                            <?php }?>
                            </tbody>

                            <tfoot>

                            <tr>
                                <td colspan="5" class="center" height="60px">
                                    <b>
                                        <div align="right">Total : </div>
                                    </b>
                                </td>
                                <?php
//                                $total = mysqli_fetch_array(mysqli_query($connect,"select SUM(debit) as debit from jurnal_umum"));
//                                $total2 = mysqli_fetch_array(mysqli_query($connect,"select SUM(kredit) as kredit from jurnal_umum"));
                                ?>
                                <td align="left"><b>Rp.<?=number_format(@$total['debit'])?>
                                    </b></td>
                                <td align="left"><b>Rp.<?=number_format(@$total2['kredit'])?>
                                    </b></td>
                            </tr>

                            </tfoot>

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<script>
    window.print();
</script>
 