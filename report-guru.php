<?php
error_reporting(0);
include"lib_sisko.php";
$n_panggil  = new database();
$n_panggil->koneksi();
$kodedetail = $_GET['kode_guru'];
$n_sdetail	= $n_panggil->tampil_detailguru($kodedetail,$_GET['sch_cari']);

?>
<?php
if(isset($_GET['del'])){
    $del = $_GET['del'];
     $hps = $n_panggil->hapus_detailguru($del,$_GET['kode_guru']);   
}
?>
<?php
if(isset($_GET['delall'])){
    $del_nip = $_GET['delall'];
    $hps = $n_panggil->hapus_alldetail_guru($del_nip);
}
?>
<!doctype html>
<html>
    <head>
        <title>Report | <?php echo $n_panggil->baca_detailguru("nama_guru",$kodedetail); ?></title>
        <link href="css/style.css" rel="stylesheet">
        <script src="js/jquery-2.1.4.js" type="text/javascript"></script>
        <script src="js/n_java.js" type="text/javascript"></script>
		
    </head>
    <body bgcolor="#464646">
        
        <main>
            <div class="content">
                <div class="atas">
                    <form action="report-guru.php?nip=$nipdetail&" name="cari" id="cari" method="get" enctype="multipart/form-data">
                        <input type="hidden" name="kode_guru" id="kode_guru" value="<?php echo $n_panggil->baca_detailguru("kode_guru",$kodedetail); ?>">
                        <input type="search" name="sch_cari" id="sch_id" placeholder="Cari Mapel, Hari, Ruangan, Kelas, Kode Mapel" onkeyup="this.submit();"> 
                    </form>
                    <button type="button" onclick="location.href='index.php'" class="x">X</button>
                </div>
                <div class="header">
                    <div class="isi-header" id="left-header">
                        <img src="img/<?php echo $n_panggil->baca_detailguru("foto_guru",$kodedetail); ?>">
                    </div>
                    <div class="isi-header" id="main-header">
                        <table>
                            <tr>
                                <td>NIP</td>
                                <td style="width:60px;" align="center">:</td>
                                <td style="width:300px;"><?php echo $n_panggil->baca_detailguru("nip",$kodedetail); ?></td>
                                <td>No Telp</td>
                                <td style="width:60px;" align="center">:</td>
                                <td><?php echo $n_panggil->baca_detailguru("no_hp",$kodedetail); ?>
                            </tr>
                            </tr>
                            <tr>
                                <td>Kode Guru</td>
                                <td style="width:60px;" align="center">:</td>
                                <td><?php echo $n_panggil->baca_detailguru("kode_guru",$kodedetail); ?></td>
                                <td>Tanggal Lahir</td>
                                <td style="width:60px;" align="center">:</td>
                                <td><?php echo $n_panggil->baca_detailguru("tgllahir_guru",$kodedetail); ?></td>
                            </tr>
                            <tr>
                                <td>Nama Guru</td>
                                <td style="width:60px;" align="center">:</td>
                                <td><?php echo $n_panggil->baca_detailguru("nama_guru",$kodedetail); ?></td>                  
                                <td>Alamat</td>
                                <td style="width:60px;" align="center">:</td>
                                <td><?php echo $n_panggil->baca_detailguru("alamat",$kodedetail); ?></td>
                            </tr>
                            <tr>
                                <td>Golongan</td>
                                <td style="width:60px;" align="center">:</td>
                                <td><?php echo $n_panggil->baca_detailguru("gol",$kodedetail); ?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td style="width:60px;" align="center">:</td>
                                <td><?php echo $n_panggil->baca_detailguru("status",$kodedetail); ?></td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td style="width:60px;" align="center">:</td>
                                <td><?php echo $n_panggil->baca_detailguru("agama_guru",$kodedetail); ?></td>
                            </tr>
                        </table>
                    </div>
				</div>
                <div class="isi">
				<table>
                    <tr>
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>Kode Mapel</th>
                        <th>Hari</th>
                        <th>Jam ke - </th>
                        <th>Ruangan</th>
                        <th>Kelas</th>
                        <th>Tidakan</th>
                    </tr>
                    
				<?php
                    $nn=1;
                    foreach($n_sdetail as $n_ddetail){
                        if($nn%2==0){
                        $warna ="#f8f8f8";
                    }else{
                        $warna ="white";
                    }
                        ?>
				<tr bgcolor="<?php echo $warna; ?>">
				<td align="center"><?php echo $nn; ?></td>
				<td><?php echo $n_ddetail['mapel']; ?></td>
                <td align="center"><?php echo $n_ddetail['kode_mapel']; ?></td>
                <td align="center"><?php echo $n_ddetail['hari']; ?></td>
                <td align="center"><?php echo $n_ddetail['jam']; ?></td>
                <td align="center"><?php echo $n_ddetail['ruang']; ?></td>
                <td align="center"><?php echo $n_ddetail['kelas']; ?></td>
                    <td align="center"><a href="?del=<?php echo $n_ddetail['id_jadwal']; ?>&kode_guru=<?php echo $n_ddetail['kode_guru']; ?>">HAPUS</a> | <a href="edit-jadwal.php?idjadwal=<?php echo $n_ddetail['id_jadwal']; ?>">EDIT</a></td>
				</tr>
				<?php
                        $nn++;
                    }
                    ?>
				</table>
				</div>
            <a href="?delall=<?php echo $n_ddetail['nip']; ?>" class="delete">DELETE ALL</a>
            <button type="button" onclick="window.print();" class="print">PRINT</button>
            </div>
			
        </main>
    </body>
</html>