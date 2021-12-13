<?php
include"lib_sisko.php";
ERROR_REPORTING(0);
$n_panggil  = new database();
$n_panggil->koneksi();
$n_snilai     = $n_panggil->tampil_nilai2($_GET['sch_cari']);
?>
<?php
if(isset($_POST['nisnn'])){
    $n_masuk_nilai=$n_panggil->insert_nilai($_POST['nisnn'],$_POST['kode_mapeln'],$_POST['nilain'],$_POST['semester'],$_POST['kelas']);
}
?>

<?php
if(isset($_GET['id_nilai'])){
$n_idnilai   =$_GET['id_nilai'];
$n_hps_nilai =$n_panggil->hapus_nilai($n_idnilai);
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>OOP SISKO</title>
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
                <li onclick="location.href='index.php'">Tampil Data</li>               
            </ul>
                <form target="_self" name="cari" id="cari" enctype="multipart/form-data" method="get">
                    <input type="search" name="sch_cari" id="sch_cari" placeholder="Cari Nama siswa, Nilai, Mapel ,NISN">
                    <button type="submit" class="cari">Cari</button>
                </form>
                </div>
        </header>
        <main>
            <div class="container">
<!----------------------------- TAMPIL DATA ----------------------------->                
                <div class="sub-satu">
                <div class="nilai" id="tengah">
                    <p><button type="button" class="tambah" id="tn">+ Tambah</button> <button type="button" class="see" onclick="location.href='index.php'">Home</button>DATA NILAI <span class="jml" ><?php $n_panggil->jumlah_nilai(); ?></span></p>
                <table>
                    <tr class="tr-atas">
                        <th>No</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Kode Mapel</th>
                        <th>Mapel</th>
                        <th>Nilai</th>
                        <th>Nama Guru</th>
                        <th>Semester</th>
                        <th>Kelas</th>
                        <th>Tindakan</th>
                    </tr>
                        <?php
                        $nn=1;
                        foreach($n_snilai as $n_dnilai){
                             if($nn%2==0){
                        $warna = "#f8f8f8";
                    }else{
                        $warna = "white";
                    }
                            ?>
                    <tr bgcolor="<?php echo $warna; ?>">
                        <td align="center"><?php echo $nn; ?></td>
                        <td><?php echo $n_dnilai['nisn']; ?></td>
                        <td><?php echo $n_dnilai['nama']; ?></td>
                        <td align="center"><?php echo $n_dnilai['kode_mapel']; ?></td>
                        <td><?php echo $n_dnilai['mapel']; ?></td>
                        <td align="center"><?php echo $n_dnilai['nilai']; ?></td>
                        <td><?php echo $n_dnilai['nama_guru']; ?></td>
                        <td align="center"><?php echo $n_dnilai['semester']; ?></td>
                        <td align="center"><?php echo $n_dnilai['kelas']; ?></td>
                        <td align="center"><a href="index.php?id_nilai=<?php echo $n_dnilai['id_nilai']; ?>">HAPUS</a> &nbsp; 
                        <a href="edit-nilai.php?id_nilai=<?php echo $n_dnilai['id_nilai']; ?>">EDIT</a>
                    </td>
                        <?php
                            $nn++;
                        }
                        ?>
                    </tr>
                </table>
                    <p><?php echo $n_panggil->page_nilai2(); ?> <a href="" class="deleteall">DELETE ALL</a></p>
            </div>
                </div>
<!----------------------------------------------------------------------->
            </div>
			
        </main>
        <div class="input-spesifik">
            <div class="in-input" id="nilai">
                <div class="isi-input">
                        <p>INPUT NILAI</p>
                        <form action="" target="_self" id="input_nilai" name="input_nilai" enctype="multipart/form-data" method="post">
                            <select name="nisnn" id="nisnn" required>
                                <option selected disabled>- Pilih NISN -</option>
                                <?php
                                foreach($n_ambilsiswa as $n_lihatnisn){
                                    echo"<option value='$n_lihatnisn[nisn]'>$n_lihatnisn[nisn]</option>";
                                }
                                ?>
                            </select>
                    <br>
                            <select name="kode_mapeln" id="kode_mapeln" required>
                                <option selected disabled>- Pilih Mapel -</option>
                                <?php
                                foreach($n_ambilmapel as $n_lihatmapel){
                                    echo"<option value='$n_lihatmapel[kode_mapel]'>$n_lihatmapel[mapel]</option>";
                                }
                                ?>
                            </select>
                    <br>
                    <input type="text" id="nilain" name="nilain" placeholder="Nilai" required><br>
                            <select name="semester" id="semester" required>
                                <option disabled selected>- Pilih Semester -</option>
                                <?php
                                $sem = array('I','II','III','IV','V','VI');
                                for($i=0;$i<=5;$i++){
                                    echo"<option value='$sem[$i]'>$sem[$i]</option>";
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
                    <br>
                    <button type="submit" name="submit" id="submit">Simpan</button>
                    <button type="reset" name="reset" id="reset">Cancel</button>
                </form>
                    </div>
            </div>
        </div>
    </body>
</html>