<?php
include"lib_sisko.php";
ERROR_REPORTING(0);
$n_panggil  = new database();
$n_panggil->koneksi();
$n_sjadwal    = $n_panggil->tampil_jadwal2($_GET['sch_cari']);

?>
<?php
if(isset($_POST['nipj'])){
    $n_masuk_jadwal=$n_panggil->insert_jadwal($_POST['nipj'],$_POST['hari'],$_POST['jam'],$_POST['kode_mapel'],$_POST['ruang'],$_POST['kelas']);
}
?>

<?php
if(isset($_GET['idjadwal'])){
$n_idjadwal   =$_GET['idjadwal'];
$n_hps_jadwal =$n_panggil->hapus_jadwal($n_idjadwal);
}
?>


<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>OOP SISKO | JADWAL</title>
        <link href="css/style.css" rel="stylesheet">
        <script src="js/jquery-2.1.4.js" type="text/javascript"></script>
        <script src="js/n_java.js" type="text/javascript"></script>
		<script>
		var i=1;
		function muncul(){
		if(i==1){
		document.getElementById('detail').style.display="block";
		i==2;
		}
		}
		</script>
    </head>
    <body>
        <header>
            <div class="sub-header">
            <ul>
                <li onclick="location.href='index.php'">Home</li>
            </ul>
                <form target="_self" name="cari" id="cari" enctype="multipart/form-data" method="get">
                    <input type="search" name="sch_cari" id="sch_cari" placeholder="Cari Hari, Mapel , Kode Mapel , Guru">
                    <button type="submit" class="cari">Cari</button>
                </form>
                </div>
        </header>
        <main>
            <div class="container">
<!----------------------------- TAMPIL DATA ----------------------------->                
                <div class="sub-satu">
                <div class="jadwal" id="tengah">
                    <p><button type="button" class="tambah" id="tj">+ Tambah</button> <button type="button" class="see" onclick="location.href='index.php'">Home</button>INFO JADWAL <span class="jml" ><?php $n_panggil->jumlah_jadwal(); ?></span></p>
                <table>
                    <tr class="tr-atas">
                        <th>No</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Kode Mapel</th>
                        <th>Ruang</th>
                        <th>Kelas</th>
                        <th>Kode Guru</th>
                        <th>Nama Guru</th>
                        <th>Mapel</th>
                        <th>Tindakan</th>
                    </tr>
                    <?php
                    $nn =1;
                    foreach($n_sjadwal as $n_djadwal){
                         if($nn%2==0){
                        $warna = "#f8f8f8";
                    }else{
                        $warna = "white";
                    }
                        ?>
                    <tr bgcolor="<?php echo $warna; ?>">
                        <td align="center"><?php echo $nn; ?></td>
                        <td><?php echo $n_djadwal['hari']; ?></td>
                        <td align="center"><?php echo $n_djadwal['jam']; ?></td>
                        <td align="center"><?php echo $n_djadwal['kode_mapel']; ?></td>
                        <td align="center"><?php echo $n_djadwal['ruang']; ?></td>
                        <td align="center"><?php echo $n_djadwal['kelas']; ?></td>
                        <td align="center"><?php echo $n_djadwal['kode_guru']; ?></td>
                        <td><?php echo $n_djadwal['nama_guru']; ?></td>
                        <td><?php echo $n_djadwal['mapel']; ?></td>
                        <td align="center"><a href="index.php?idjadwal=<?php echo $n_djadwal['id_jadwal']; ?>">HAPUS</a> &nbsp; 
                        <a href="edit-jadwal.php?idjadwal=<?php echo $n_djadwal['id_jadwal']; ?>">EDIT</a>
                    </td>
                    </tr>
                    <?php
                        $nn++;
                    }
                    ?>
                </table>
                    <p><?php echo $n_panggil->page_jadwal2(); ?>  <a href="" class="deleteall">DELETE ALL</a></p>
            </div>
                </div>
<!----------------------------------------------------------------------->
            </div>
			
        </main>
        <div class="input-spesifik">
            <div class="in-input" id="jadwal">
                <div class="isi-input">
                        <p>INPUT JADWAL</p>
                        <form action="" target="_self" id="input_jadwal" name="input_jadwal" enctype="multipart/form-data" method="post">
                            <select name="nipj" id="nipj" required>
                                <option selected disabled>- Pilih Guru -</option>
                                <?php
                                foreach($n_ambilnip as $n_lihatnip){
                                    echo"<option value='$n_lihatnip[kode_guru]'>$n_lihatnip[nama_guru]</option>";
                                }
                                ?>
                            </select>
                    <br>
                            <select name="hari" id="hari" required>
                                <option disabled selected>- Pilih Hari -</option>
                                <?php
                                $hari = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');
                                for ($i=0;$i<=5;$i++){
                                    echo"<option value='$hari[$i]'>$hari[$i]</option>";
                                }
                                ?>
                            </select>
                    <br>
                    <input type="text" id="jam" name="jam" placeholder="Jam (1 atau 1 - 16)" required><br>
                            <select name="kode_mapel" id="kode_mapel" required>
                                <option selected disabled>- Pilih Mapel -</option>
                                <?php
                                foreach($n_ambilmapel as $n_lihatmapel){
                                    echo"<option value='$n_lihatmapel[kode_mapel]'>$n_lihatmapel[mapel]</option>";
                                }
                                ?>
                            </select>
                    <br>
                            <select name="ruang" id="ruang" required>
                                <option disabled selected>- Pilih Ruangan -</option>
                                <?php
                                $ruang = array('Musholla','Aula','LAB 1','LAB 2','LAB 3','LAB 4','LAB 5','LAB 6','LAB PEKSOS','R 01','R 02','R 03','R 04','R 05','R 06','R 07','R 08','R 09','R 10','R 11','R 12','R 13','R 14','R 15','R 16','R 17','R 18','R 19','R 20','R 21','R 22','R 23','R 24','R 25','R 26','R 27','R 28','R 29','R 30','R 31','R 32','R 33','R 34');
                                for ($i=0;$i<=42;$i++){
                                    echo"<option value='$ruang[$i]'>$ruang[$i]</option>";
                                }
                                ?>
                            </select>
                    <br>
                            <select name="kelas" id="kelas" required>
                                <option selected disabled>- Pilih Kelas -</option>
                                <?php
                                $kel = array('X - RPL 1','X - RPL 2','X - RPL 3','X - RPL 4','X - RPL 5','X - TKJ 1','X - TKJ 2','X - TKJ 3','X - TKJ  4','X - TKJ 5','X - PS 1','X - PS 2','X - PS 3','X - PS 4','X - ANIMASI 1','X - ANIMASI 2','X - DKV 1','X - DKV 2','X - MULTIMEDIA 1','X - MULTIMEDIA 2','XI - RPL 1','XI - RPL 2','XI - RPL 3','XI - RPL 4','XI - RPL 5','XI - TKJ 1','XI - TKJ 2','XI - TKJ 3','XI - TKJ 4','XI - TKJ 5','XI - PS 1','XI - PS 2','XI - PS 3','XI - PS 4','XI - ANIMASI 1','XI - ANIMASI 2','XI - DKV 1','XI - DKV 2','XI - MULTIMEDIA 1','XI - MULTIMEDIA 2','XII - RPL 1','XII - RPL 2','XII - RPL 3','XII - RPL 4','XII - RPL 5','XII - TKJ 1','XII - TKJ 2','XII - TKJ 3','XII - TKJ 4','XII - TKJ 5','XII - PS 1','XII - PS 2','XII - PS 3','XII - PS 4');
                                for ($i=0;$i<=53;$i++){
                                    echo"<option value='$kel[$i]'>$kel[$i]</option>";
                                }
                                ?>
                            </select>
                    <button type="submit" name="submit" id="submit">Simpan</button>
                    <button type="reset" name="reset" id="reset">Cancel</button>
                </form>
                    </div>
            </div>
        </div>
    </body>
</html>