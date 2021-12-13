<?php
include"lib_sisko.php";
ERROR_REPORTING(0);
$n_panggil  = new database();
$n_panggil->koneksi();
$n_spelajaran = $n_panggil->tampil_pelajaran2($_GET['sch_cari']);
?>

<?php
if(isset($_POST['kode_gurum'])){
    $n_masuk_mapel=$n_panggil->insert_pelajaran($_POST['kode_gurum'],$_POST['kode_mapelm'],$_POST['mapel']);
}
?>

<?php
if(isset($_GET['idmapel'])){
$n_idmapel   =$_GET['idmapel'];
$n_hps_mapel =$n_panggil->hapus_pelajaran($n_idmapel);
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>OOP SISKO | ALL MAPEL</title>
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
                    <input type="search" name="sch_cari" id="sch_cari" placeholder="Cari Guru , Kode Guru , Mapel , Kode Mapel">
                    <button type="submit" class="cari">Cari</button>
                </form>
                </div>
        </header>
        <main>
            <div class="container">
<!----------------------------- TAMPIL DATA ----------------------------->                
                <div class="sub-satu">
                <div class="pelajaran" id="tengah">
                    <p><button type="button" class="tambah" id="tm">+ Tambah</button> <button type="button" class="see" onclick="location.href='index.php'">Home</button>DATA MAPEL <span class="jml" ><?php $n_panggil->jumlah_mapel(); ?></span></p>
                <table>
                    <tr class="tr-atas">
                        <th>No</th>
                        <th>Kode Guru</th>
                        <th>NIP</th>
                        <th>Nama Guru</th>
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
                        <td align="center"><?php echo $n_dpelajaran['nip']; ?></td>
                        <td align="center"><?php echo $n_dpelajaran['nama_guru']; ?></td>
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
                    <p><?php echo $n_panggil->page_mapel2(); ?> <a href="" class="deleteall">DELETE ALL</a></p>
            </div>
                </div>
<!----------------------------------------------------------------------->
            </div>
        </main>
        <div class="input-spesifik">
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