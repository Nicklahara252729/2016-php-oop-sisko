<?php
include"lib_sisko.php";
ERROR_REPORTING(0);
$n_panggil  = new database();
$n_panggil->koneksi();
$n_sguru      = $n_panggil->tampil_guru2($_GET['sch_cari']); 
?>
<?php
if(isset($_POST['nip'])){
    $n_foto = $_FILES['foto']['name']?$_FILES['foto']['name']:"Koala.jpg";
    $n_masuk_guru =$n_panggil->insert_guru($_POST['nip'],$_POST['kode_guru'],$_POST['nama_guru'],$_POST['gol'],$_POST['status'],$_POST['agama'],$_POST['tgllahir'],$_POST['no_hp'],$_POST['alamat'],$n_foto,$_FILES['foto']['tmp_name']);
}
?>

<?php
if(isset($_GET['idguru'])){
$n_idguru   =$_GET['idguru'];
$n_hps_guru =$n_panggil->hapus_guru($n_idguru);
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>OOP SISKO | GURU</title>
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
                    <input type="search" name="sch_cari" id="sch_cari" placeholder="Cari Nama Guru, NIP , Kode Guru">
                    <button type="submit" class="cari">Cari</button>
                </form>
                </div>
        </header>
        <main>
            <div class="container">              
                <div class="sub-satu">
                <div class="guru">
                <p><button type="button" class="tambah" id="tg">+ Tambah</button> <button type="button" class="see" onclick="location.href='index.php'">Home</button>DATA GURU <span class="jml" ><?php $n_panggil->jumlah_guru(); ?></span></p>
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
                    if($nn%2==0){
                        $warna = "#f8f8f8";
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
                        <?php echo $n_panggil->page_guru2(); ?> <a href="" class="deleteall">DELETE ALL</a>
                    </p>
                </div>
                </div>
            </div>
        </main>
        <div class="input-spesifik">
            <div class="in-input" id="guru">
                <div class="isi-input">
                        <p>INPUT GURU</p>
                        <form action="" target="_self" id="input_guru" name="input_guru" enctype="multipart/form-data" method="post">
                    <input type="text" id="nip" name="nip" placeholder="NIP"><br>
                    <input type="text" id="kode_guru" name="kode_guru" placeholder="Kode Guru"><br>
                    <input type="text" id="nama_guru" name="nama_guru" placeholder="Nama Guru"><br>
                            <select name="gol" id="gol">
                                <option disabled selected > - Pilih Golongan -</option>
                                <?php
                                $gol = array('A1','A2','A3');
                                for($i=0;$i<=2;$i++){
                                    echo"<option value='$gol[$i]'>$gol[$i]</option>";
                                }
                                ?>
                            </select><br>
                            <select name="status" id="status">
                                <option disabled selected>- Pilih Status -</option>
                                <option value="HONOR">HONOR</option>
                                                                <option value="PNS">PNS</option>

                            </select>
                    <br>
                            <select name="agama" id="agama">
                                <option disabled selected>- Pilih Agama -</option>
                                <?php
                                $agama = array('Islam','Protestan','Khatolik','Buddha','Hindu','Konghuchu');
                                for($i=0;$i<=5;$i++){
                                    echo"<option value='$agama[$i]'>$agama[$i]</option>";
                                }
                                ?>
                            </select>
                    <br>
                    <input type="text" id="tgllahir" name="tgllahir" placeholder="Tgl Lahir (1999-05-25)"><br>
                    <input type="text" id="no_hp" name="no_hp" placeholder="No Telp"><br>
                            <textarea name="alamat" id="alamat" placeholder="Alamat"></textarea>
                            <input type="file" name="foto" id="foto">
                    <button type="submit" name="submit" id="submit">Simpan</button>
                    <button type="reset" name="reset" id="reset">Cancel</button>
                </form>
                    </div>
            </div>
        </div>
    </body>
</html>