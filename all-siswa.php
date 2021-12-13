<?php
include"lib_sisko.php";
ERROR_REPORTING(0);
$n_panggil  = new database();
$n_panggil->koneksi();
$n_ssiswa     = $n_panggil->tampil_siswa2($_GET['sch_cari']);
?>


<?php
if(isset($_POST['nisn'])){
        $n_foto = $_FILES['foto']['name']?$_FILES['foto']['name']:"Koala.jpg";
        $n_masuk_siswa =$n_panggil->insert_siswa($_POST['nisn'],$_POST['nama'],$_POST['jurusan'],$_POST['jenkel'],$_POST['tgllahir'],$_POST['agama'],$_POST['no_hp'],$_POST['nama_ayah'],$_POST['pekerjaan_ayah'],$_POST['no_telp_ayah'],$_POST['nama_ibu'],$_POST['pekerjaan_ibu'],$_POST['alamat'],$n_foto,$_FILES['foto']['tmp_name']);
}
?>



<?php
if(isset($_GET['idsiswa'])){
$n_idsiswa   =$_GET['idsiswa'];
$n_hps_siswa =$n_panggil->hapus_siswa($n_idsiswa);
}
?>



<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>OOP SISKO | SISWA</title>
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
                    <input type="search" name="sch_cari" id="sch_cari" placeholder="Cari Nama siswa, Jurusan,NISN">
                    <button type="submit" class="cari">Cari</button>
                </form>
                </div>
        </header>
        <main>
            <div class="container">
<!----------------------------- TAMPIL DATA ----------------------------->                
                <div class="sub-satu">
                <div class="siswa">
                    <p><button type="button" class="tambah" id="ts">+ Tambah</button> <button type="button" class="see" onclick="location.href='index.php'">Home</button>DATA SISWA <span class="jml" ><?php $n_panggil->jumlah_siswa(); ?></span></p>
                <table>
                    <tr class="tr-atas">
                        <th>No</td>
                        <th>NISN</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Jenkel</th>
                        <th>T.T.L</th>
                        <th>Agama</th>
                        <th>No Telp</th>
                        <th>Nama Ayah</th>
                        <th>No Telp Ayah</th>
                        <th>Nama Ibu</th>
                        <th>Status Nilai</th>
                        <th>Alamat</th>
                        <th>Foto</th>
                        <th>Tindakan</th>
                    </tr>
                    <?php
                    $nn=1;
                    foreach($n_ssiswa as $n_dsiswa){
                         if($nn%2==0){
                        $warna = "#f8f8f8";
                    }else{
                        $warna = "white";
                    }
                        ?>
                    <tr bgcolor="<?php echo $warna; ?>">
                        <td align="center"><?php echo $nn; ?></td>
                        <td><?php echo $n_dsiswa['nisn']; ?></td>
                        <td><?php echo $n_dsiswa['nama']; ?></td>
                        <td align="center"><?php echo $n_dsiswa['jurusan']; ?></td>
                        <td align="center"><?php echo $n_dsiswa['jenkel']; ?></td>
                        <td><?php echo $n_dsiswa['tgllahir']; ?></td>
                        <td align="center"><?php echo $n_dsiswa['agama']; ?></td>
                        <td><?php echo $n_dsiswa['no_hp']; ?></td>
                        <td><?php echo $n_dsiswa['nama_ayah']; ?></td>
                        <td><?php echo $n_dsiswa['ho_hp_ayah']; ?></td>
                        <td><?php echo $n_dsiswa['nama_ibu']; ?></td>
                        <td><button type="button" class="plus">+</button> <?php echo $n_panggil->kosong($n_dsiswa['nisn']);?></td>
                        <td><?php echo $n_dsiswa['alamat']; ?></td>
                        <td align="center"><img src="img/<?php echo $n_dsiswa['foto']; ?>"></td>
                        <td align="center"><a href="index.php?idsiswa=<?php echo $n_dsiswa['idsiswa']; ?>">HAPUS</a> &nbsp; 
                        <a href="edit-siswa.php?idsiswa=<?php echo $n_dsiswa['idsiswa']; ?>">EDIT</a> &nbsp;
                            <a href="report.php?nisn=<?php echo $n_dsiswa['nisn']; ?>">DETAIL</a></button>
                    </td>
                    </tr>
                    <?php
                        $nn++;
                    }
                    ?>
                    <tr>
                    </tr>
                </table>
            <p>
               <?php echo $n_panggil->page_siswa2(); ?>  <a href="" class="deleteall">DELETE ALL</a>
            </p>
            </div>
                </div>
<!----------------------------------------------------------------------->
            </div>
			
        </main>
        <div class="input-spesifik">
            <div class="in-input" id="siswa">
                <div class="isi-input">
                        <p>INPUT SISWA</p>
                        <form action="" id="input_siswa" name="input_siswa" enctype="multipart/form-data" method="post">
                            <label for="nisn">NISN Terakhir : <?php echo $n_panggil->baca_siswa2("nisn"); ?></label><br>
                    <input type="text" id="nisn" name="nisn" placeholder="NISN" required><br>
                    <input type="text" id="nama" name="nama" placeholder="Nama Lengkap" required><br>
                            <select name="jurusan" id="jurusan" required>
                                <option selected disabled>- Pilih Jurusan -</option>
                                <?php
                                $jur = array('RPL','TKJ','PEKSOS','ANIMASI','DKV','MULTIMEDIA');
                                for($i=0;$i<=5;$i++){
                                    echo"<option value='$jur[$i]'>$jur[$i]</option>";
                                }
                                ?>
                            </select><br>
                            <select name="jenkel" id="jenkel" required>
                                <option selected disabled>- Pilih Jenis Kelamin -</option>
                                <option value="P">P</option>
                                                                <option value="L">L</option>

                            </select>
<br>
                    <input type="text" id="tgllahir" name="tgllahir" placeholder="Tgl Lahir (1999-05-25)" required><br>
                    <select name="agama" id="agama" required>
                                <option disabled selected>- Pilih Agama -</option>
                                <?php
                                $agama = array('Islam','Protestan','Khatolik','Buddha','Hindu','Konghuchu');
                                for($i=0;$i<=5;$i++){
                                    echo"<option value='$agama[$i]'>$agama[$i]</option>";
                                }
                                ?>
                            </select><br>
                    <input type="text" id="no_hp" name="no_hp" placeholder="No Telp" required><br>
                            <input type="text" id="nama_ayah" name="nama_ayah" placeholder="Nama Ayah" required><br>
                            <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" placeholder="Pekerjaan Ayah" required><br>
                    <input type="text" id="no_telp_ayah" name="no_telp_ayah" placeholder="No Telp Ayah" required><br>
                            <input type="text" id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu" required><br>
                            <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" placeholder="Pekerjaan Ibu" required><br>
                            <textarea name="alamat" id="alamat" placeholder="Alamat" required></textarea>
                            <input type="file" id="foto"  name="foto">
                            <br>
                    <button type="submit" name="submit" id="submit">Simpan</button>
                    <button type="reset" name="reset" id="reset">Cancel</button>
                </form>
                    </div>
            </div>
        </div>
    </body>
</html>