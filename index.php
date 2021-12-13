<?php
include"lib_sisko.php";
error_reporting(0);
$n_panggil  = new database();
$n_panggil->koneksi();
$n_sguru      = $n_panggil->tampil_guru(); 
$n_ssiswa     = $n_panggil->tampil_siswa();
$n_sjadwal    = $n_panggil->tampil_jadwal();
$n_snilai     = $n_panggil->tampil_nilai();
$n_spelajaran = $n_panggil->tampil_pelajaran();
$n_ambilnip   = $n_panggil->ambil_nip();
$n_ambilmapel = $n_panggil->ambil_mapel();
$n_ambilguru  = $n_panggil->ambil_guru();
$n_ambilsiswa = $n_panggil->ambil_siswa();


?>
<?php
if(isset($_POST['nip'])){
    $n_foto = $_FILES['foto']['name']?$_FILES['foto']['name']:"Koala.jpg";
    $n_masuk_guru =$n_panggil->insert_guru($_POST['nip'],$_POST['kode_guru'],$_POST['nama_guru'],$_POST['gol'],$_POST['status'],$_POST['agama'],$_POST['tgllahir'],$_POST['no_hp'],$_POST['alamat'],$n_foto,$_FILES['foto']['tmp_name']);
}
?>

<?php
if(isset($_POST['nisn'])){
        $n_foto = $_FILES['foto']['name']?$_FILES['foto']['name']:"Koala.jpg";
        $n_masuk_siswa =$n_panggil->insert_siswa($_POST['nisn'],$_POST['nama'],$_POST['jurusan'],$_POST['jenkel'],$_POST['tgllahir'],$_POST['agama'],$_POST['no_hp'],$_POST['nama_ayah'],$_POST['pekerjaan_ayah'],$_POST['no_telp_ayah'],$_POST['nama_ibu'],$_POST['pekerjaan_ibu'],$_POST['alamat'],$n_foto,$_FILES['foto']['tmp_name']);
}
?>

<?php
if(isset($_POST['nipj'])){
    $n_masuk_jadwal=$n_panggil->insert_jadwal($_POST['nipj'],$_POST['hari'],$_POST['jam'],$_POST['kode_mapel'],$_POST['ruang'],$_POST['kelas']);
}
?>

<?php
if(isset($_POST['kode_gurum'])){
    $n_masuk_mapel=$n_panggil->insert_pelajaran($_POST['kode_gurum'],$_POST['kode_mapelm'],$_POST['mapel']);
}
?>

<?php
if(isset($_POST['nisnn'])){
    $n_masuk_nilai=$n_panggil->insert_nilai($_POST['nisnn'],$_POST['kode_mapeln'],$_POST['nilain'],$_POST['semester'],$_POST['kelas']);
}
?>

<?php
if(isset($_GET['idguru'])){
$n_idguru   =$_GET['idguru'];
$n_hps_guru =$n_panggil->hapus_guru($n_idguru);
}
?>

<?php
if(isset($_GET['idsiswa'])){
$n_idsiswa   =$_GET['idsiswa'];
$n_hps_siswa =$n_panggil->hapus_siswa($n_idsiswa);
}
?>

<?php
if(isset($_GET['idjadwal'])){
$n_idjadwal   =$_GET['idjadwal'];
$n_hps_jadwal =$n_panggil->hapus_jadwal($n_idjadwal);
}
?>

<?php
if(isset($_GET['id_nilai'])){
$n_idnilai   =$_GET['id_nilai'];
$n_hps_nilai =$n_panggil->hapus_nilai($n_idnilai);
}
?>

<?php
if(isset($_GET['idmapel'])){
$n_idmapel   =$_GET['idmapel'];
$n_hps_mapel =$n_panggil->hapus_pelajaran($n_idmapel);
}
?>

<?php
if(isset($_GET['ok'])){
    $n_ok = $_GET['ok'];
    $n_delallnilai = $n_panggil->hapussemuanilai($n_ok);
}
?>

<?php
if(isset($_GET['oksiswa'])){
    $n_ok = $_GET['ok'];
    $n_delallnilai = $n_panggil->hapussemuasiswa($n_ok);
}
?>

<?php
if(isset($_GET['okjadwal'])){
    $n_ok = $_GET['okjadwal'];
    $n_delallnilai = $n_panggil->hapussemuajadwal($n_ok);
}
?>

<?php
if(isset($_GET['okmapel'])){
    $n_ok = $_GET['okmapel'];
    $n_delallnilai = $n_panggil->hapussemuamapel($n_ok);
}
?>

<?php
if(isset($_GET['hpsguru'])){
    $n_ok = $_GET['hpsguru'];
    $n_delallnilai = $n_panggil->hapussemuaguru($n_ok);
}
?>

<?php
if(isset($_GET['sch_cari'])){
    $cari = $_GET['sch_cari'];
    $n_cari =$n_panggil->cari($cari);
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
                <li class="li-tampil">Tampil Data</li>
                <li class="li-input">Input Data</li>
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
				<div class="guru">
                <p>HASIL PENCARIAN &nbsp;<span class="jml"><?php
    if(isset($_GET['sch_cari'])){
    $cari = $_GET['sch_cari'];
    echo $n_panggil->jml_cari($cari);
} ?></span></p>
            <table>
                <tr class="tr-atas">
                    <th>No</th>
                    <th>NISN</th>
                    <th>Nama Siswa</th>
                    <th>Jurusan</th>
                    <th>Jenkel</th>
                    <th>Agama</th>
                    <th>Alamat</th>
                    <th>Nilai</th>
                    <th>Kelas</th>
                    <th>Mapel</th>
                    <th>Guru</th>
                </tr>
                <?php
				
                $nn=1;
                foreach($n_cari as $n_pencarian){
                     if($nn%2==0){
                        $warna = "#f8f8f8";
                    }else{
                        $warna = "white";
                    }
                 ?>
                <tr bgcolor="<?php echo $warna; ?>">
                    <td align="center" ><?php echo $nn; ?></td>
                    <td><?php echo $n_pencarian['nisn']; ?></td>
                    <td><?php echo $n_pencarian['nama']; ?></td>
                    <td><?php echo $n_pencarian['jurusan']; ?></td>
                    <td><?php echo $n_pencarian['jenkel']; ?></td>
                    <td><?php echo $n_pencarian['agama']; ?></td>
                    <td><?php echo $n_pencarian['alamat']; ?></td>
                    <td><?php echo $n_pencarian['nilai']; ?></td>
                    <td><?php echo $n_pencarian['kelas']; ?></td>
                    <td><?php echo $n_pencarian['mapel']; ?></td>
                    <td align="center"><?php echo $n_pencarian['nama_guru']; ?></td>
                </tr>
                <?php
                     $nn++;
                }
                ?>
                
            </table>
                    <p></p>
                </div>
                <div class="guru">
                <p><button type="button" class="tambah" id="tg">+ Tambah</button> <button type="button" class="see" onclick="location.href='all-guru.php'">All Record</button>DATA GURU <span class="jml" ><?php $n_panggil->jumlah_guru(); ?></span></p>
            <table>
                <tr class="tr-atas">
                    <th>No</th>
                    <th>NIP</th>
                    <th>Kode Guru</th>
                    <th>Nama Guru</th>
                    <th>Golongan</th>
                    <th>Status</th>
                    <th>Agama</th>
                    <th>T.T.L</th>
                    <th>No Telp</th>
                    <th>Alamat</th>
                    <th>Foto</th>
                    <th>Tindakan</th>
                </tr>
                <?php
                $nn=1;
                foreach($n_sguru as $n_dguru){
                    if($nn%2==1){
                        $warna = "red";
                    }else{
                        $warna = "white";
                    }
                 ?>
                <tr bgcolor="<?php echo $warna; ?>">
                    <td align="center"><?php echo $nn; ?></td>
                    <td><?php echo $n_dguru['nip']; ?></td>
                    <td align="center"><?php echo $n_dguru['kode_guru']; ?></td>
                    <td><?php echo $n_dguru['nama_guru']; ?></td>
                    <td align="center"><?php echo $n_dguru['gol']; ?></td>
                    <td><?php echo $n_dguru['status']; ?></td>
                    <td><?php echo $n_dguru['agama_guru']; ?></td>
                    <td><?php echo $n_dguru['tgllahir_guru']; ?></td>
                    <td><?php echo $n_dguru['no_hp']; ?></td>
                    <td><?php echo $n_dguru['alamat']; ?></td>
                    <td align="center"><img src="img/<?php echo $n_dguru['foto_guru']; ?>"></td>
                    <td align="center"><a href="index.php?idguru=<?php echo $n_dguru['idguru']; ?>">HAPUS</a> &nbsp; 
                        <a href="edit-guru.php?idguru=<?php echo $n_dguru['idguru']; ?>">EDIT</a> &nbsp;
                        <a href="report-guru.php?kode_guru=<?php echo $n_dguru['kode_guru']; ?>">DETAIL</a>
                    </td>
                </tr>
                <?php
                     $nn++;
                }
                ?>
                
            </table>
                    <p>
                      <?php echo $n_panggil->page_guru(); ?>  <a href="index.php?hpsguru=<?php echo $n_dguru['hapusguru']; ?>" class="deleteall">DELETE ALL</a>
                    </p>
                </div>
                <div class="siswa">
                    <p><button type="button" class="tambah" id="ts">+ Tambah</button> <button type="button" class="see" onclick="location.href='all-siswa.php'">All Record</button>DATA SISWA <span class="jml" ><?php $n_panggil->jumlah_siswa(); ?></span></p>
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
                        <td><a href="input-nilai.php?nisn=<?php echo $n_dsiswa['nisn']; ?>"><button type="button" class="plus">+</button></a> <?php echo $n_panggil->kosong($n_dsiswa['nisn']);?></td>
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
               <?php echo $n_panggil->page_siswa(); ?>  <a href="index.php?oksiswa=<?php echo $n_dsiswa['hapussiswa']; ?>" class="deleteall">DELETE ALL</a>
            </p>
            </div>
                <div class="jadwal" id="sama">
                    <p><button type="button" class="tambah" id="tj">+ Tambah</button> <button type="button" class="see" onclick="location.href='all-jadwal.php'">All Record</button>INFO JADWAL <span class="jml" ><?php $n_panggil->jumlah_jadwal(); ?></span></p>
                <table>
                    <tr class="tr-atas">
                        <th>No</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Kode Mapel</th>
                        <th>Ruang</th>
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
                        <td><?php echo $n_djadwal['ruang']; ?></td>
                        <td align="center"><a href="index.php?idjadwal=<?php echo $n_djadwal['id_jadwal']; ?>">HAPUS</a> &nbsp; 
                        <a href="edit-jadwal.php?idjadwal=<?php echo $n_djadwal['id_jadwal']; ?>">EDIT</a>
                    </td>
                    </tr>
                    <?php
                        $nn++;
                    }
                    ?>
                </table>
                    <p><?php echo $n_panggil->page_jadwal(); ?>  <a href="index.php?okjadwal=<?php echo $n_djadwal['hapusjadwal']; ?>" class="deleteall">DELETE ALL</a></p>
            </div>
                <div class="nilai" id="sama">
                    <p><button type="button" class="tambah" id="tn">+ Tambah</button> <button type="button" class="see" onclick="location.href='all-nilai.php'">All Record</button>DATA NILAI <span class="jml" ><?php $n_panggil->jumlah_nilai(); ?></span></p>
                <table>
                    <tr class="tr-atas">
                        <th>No</th>
                        <th>NISN</th>
                        <th>Kode Mapel</th>
                        <th>Nilai</th>
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
                        <td align="center"><?php echo $n_dnilai['kode_mapel']; ?></td>
                        <td align="center"><?php echo $n_dnilai['nilai']; ?></td>
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
                    <p><?php echo $n_panggil->page_nilai(); ?> <a href="?ok=<?php echo $n_dnilai['hapus']; ?>" class="deleteall">DELETE ALL</a></p>
            </div>
                <div class="pelajaran" id="sama">
                    <p><button type="button" class="tambah" id="tm">+ Tambah</button> <button type="button" class="see" onclick="location.href='all-mapel.php'">All Record</button>DATA MAPEL <span class="jml" ><?php $n_panggil->jumlah_mapel(); ?></span></p>
                <table>
                    <tr class="tr-atas">
                        <th>No</th>
                        <th>Kode Guru</th>
                        <th>Kode Mapel</th>
                        <th>Mapel</th>
                        <th>Tindakan</th>
                    </tr>
                    <?php
                    $nn=1;
                    foreach($n_spelajaran as $n_dpelajaran){
                         if($nn%2==0){
                        $warna = "#f8f8f8";
                    }else{
                        $warna = "white";
                    }
                        ?>
                    <tr bgcolor="<?php echo $warna; ?>">
                        <td align="center"><?php echo $nn; ?></td>
                        <td align="center"><?php echo $n_dpelajaran['kode_guru']; ?></td>
                        <td align="center"><?php echo $n_dpelajaran['kode_mapel']; ?></td>
                        <td><?php echo $n_dpelajaran['mapel']; ?></td>
                        <td align="center"><a href="index.php?idmapel=<?php echo $n_dpelajaran['idmapel']; ?>">HAPUS</a> &nbsp; 
                        <a href="edit-mapel.php?idmapel=<?php echo $n_dpelajaran['idmapel']; ?>">EDIT</a>
                    </td>
                    </tr>
                    <?php
                        $nn++;
                    }
                    ?>
                </table>
                    <p><?php echo $n_panggil->page_mapel(); ?> <a href="index.php?okmapel=<?php echo $n_dpelajaran['hapusmapel']; ?>" class="deleteall">DELETE ALL</a></p>
            </div>
                </div>
<!----------------------------------------------------------------------->
<!----------------------------- INPUT DATA ------------------------------>
                <div class="input">
                    <div class="input-guru" id="inpt">
                        <p>INPUT GURU</p>
                        <form action="" target="_self" id="input_guru" name="input_guru" enctype="multipart/form-data" method="post">
                            <label for="nisn">NIP Terakhir : <?php echo $n_panggil->baca_guru2("nip"); ?></label><br><br>
                    <input type="text" id="nip" name="nip" placeholder="NIP" required><br>
                    <input type="text" id="kode_guru" name="kode_guru" placeholder="Kode Guru" required><br>
                    <input type="text" id="nama_guru" name="nama_guru" placeholder="Nama Guru" required><br>
                            <select name="gol" id="gol" required>
                                <option disabled selected > - Pilih Golongan -</option>
                                <?php
                                $gol = array('A1','A2','A3');
                                for($i=0;$i<=2;$i++){
                                    echo"<option value='$gol[$i]'>$gol[$i]</option>";
                                }
                                ?>
                            </select><br>
                            <select name="status" id="status" required>
                                <option disabled selected>- Pilih Status -</option>
                                <option value="HONOR">HONOR</option>
                                                                <option value="PNS">PNS</option>

                            </select>
                    <br>
                            <select name="agama" id="agama" required>
                                <option disabled selected>- Pilih Agama -</option>
                                <?php
                                $agama = array('Islam','Protestan','Khatolik','Buddha','Hindu','Konghuchu');
                                for($i=0;$i<=5;$i++){
                                    echo"<option value='$agama[$i]'>$agama[$i]</option>";
                                }
                                ?>
                            </select>
                    <br>
                    <input type="text" id="tgllahir" name="tgllahir" placeholder="Tgl Lahir (1999-05-25)" required><br>
                    <input type="text" id="no_hp" name="no_hp" placeholder="No Telp" required><br>
                            <textarea name="alamat" id="alamat" placeholder="Alamat" required></textarea>
                            <input type="file" name="foto" id="foto">
                    <button type="submit" name="submit" id="submit">Simpan</button>
                    <button type="reset" name="reset" id="reset">Cancel</button>
                </form>
                    </div>
                    <div class="input-siswa" id="inpt">
                        <p>INPUT SISWA</p>
                        <form action="" target="_self" id="input_siswa" name="input_siswa" enctype="multipart/form-data" method="post">
                            <label for="nisn">NISN Terakhir : <?php echo $n_panggil->baca_siswa2("nisn"); ?></label><br><br>
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
                    <div class="input-jadwal" id="inpt">
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
                                $ruang = array('Mushola','Aula','LAB 1','LAB 2','LAB 3','LAB 4','LAB 5','LAB 6','LAB PEKSOS','R 01','R 02','R 03','R 04','R 05','R 06','R 07','R 08','R 09','R 10','R 11','R 12','R 13','R 14','R 15','R 16','R 17','R 18','R 19','R 20','R 21','R 22','R 23','R 24','R 25','R 26','R 27','R 28','R 29','R 30','R 31','R 32','R 33','R 34');
                                for ($i=0;$i<=40;$i++){
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
                    <div class="input-mapel" id="inpt">
                        <p>INPUT MAPEL</p>
                        <form action="" target="_self" id="input_mapel" name="input_mapel" enctype="multipart/form-data" method="post">
                            <select name="kode_gurum" id="kode_gurum" required>
                                <option selected disabled>- Pilih Guru -</option>
                                <?php
                                foreach($n_ambilguru as $n_lihatguru){
                                    echo"<option value='$n_lihatguru[kode_guru]'>$n_lihatguru[nama_guru]</option>";
                                }
                                ?>
                            </select>
                    <br>
                    <input type="text" id="kode_mapelm" name="kode_mapelm" placeholder="Kode Mapel" required><br>
                    <input type="text" id="mapel" name="mapel" placeholder="Mapel" required><br>                    
                    <button type="submit" name="submit" id="submit">Simpan</button>
                    <button type="reset" name="reset" id="reset">Cancel</button>
                </form>
                    </div>
                    <div class="input-nilai" id="inpt">
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
<!----------------------------------------------------------------------->
            </div>
			
        </main>
        <div class="input-spesifik">
            <div class="in-input" id="guru">
                <div class="isi-input">
                        <p>INPUT GURU</p>
                        <form action="" target="_self" id="input_guru" name="input_guru" enctype="multipart/form-data" method="post">
                            <label for="nisn">NIP Terakhir : <?php echo $n_panggil->baca_guru2("nip"); ?></label><br><br>
                    <input type="text" id="nip" name="nip" placeholder="NIP" required><br>
                    <input type="text" id="kode_guru" name="kode_guru" placeholder="Kode Guru" required><br>
                    <input type="text" id="nama_guru" name="nama_guru" placeholder="Nama Guru" required><br>
                            <select name="gol" id="gol" required>
                                <option disabled selected > - Pilih Golongan -</option>
                                <?php
                                $gol = array('A1','A2','A3');
                                for($i=0;$i<=2;$i++){
                                    echo"<option value='$gol[$i]'>$gol[$i]</option>";
                                }
                                ?>
                            </select><br>
                            <select name="status" id="status" required>
                                <option disabled selected>- Pilih Status -</option>
                                <option value="HONOR">HONOR</option>
                                                                <option value="PNS">PNS</option>

                            </select>
                    <br>
                            <select name="agama" id="agama" required>
                                <option disabled selected>- Pilih Agama -</option>
                                <?php
                                $agama = array('Islam','Protestan','Khatolik','Buddha','Hindu','Konghuchu');
                                for($i=0;$i<=5;$i++){
                                    echo"<option value='$agama[$i]'>$agama[$i]</option>";
                                }
                                ?>
                            </select>
                    <br>
                    <input type="text" id="tgllahir" name="tgllahir" placeholder="Tgl Lahir (1999-05-25)" required><br>
                    <input type="text" id="no_hp" name="no_hp" placeholder="No Telp" required><br>
                            <textarea name="alamat" id="alamat" placeholder="Alamat" required></textarea>
                            <input type="file" name="foto" id="foto">
                    <button type="submit" name="submit" id="submit">Simpan</button>
                    <button type="reset" name="reset" id="reset">Cancel</button>
                </form>
                    </div>
            </div>
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
            <div class="in-input" id="pelajaran">
                <div class="isi-input">
                        <p>INPUT MAPEL</p>
                        <form action="" target="_self" id="input_mapel" name="input_mapel" enctype="multipart/form-data" method="post">
                            <select name="kode_gurum" id="kode_gurum" required>
                                <option selected disabled>- Pilih Guru -</option>
                                <?php
                                foreach($n_ambilguru as $n_lihatguru){
                                    echo"<option value='$n_lihatguru[kode_guru]'>$n_lihatguru[nama_guru]</option>";
                                }
                                ?>
                            </select>
                    <br>
                    <input type="text" id="kode_mapelm" name="kode_mapelm" placeholder="Kode Mapel" required><br>
                    <input type="text" id="mapel" name="mapel" placeholder="Mapel" required><br>                    
                    <button type="submit" name="submit" id="submit">Simpan</button>
                    <button type="reset" name="reset" id="reset">Cancel</button>
                </form>
                    </div>
            </div>
        </div>
    </body>
</html>