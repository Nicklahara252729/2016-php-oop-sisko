<?php
include"lib_sisko.php";
error_reporting(0);
$n_panggil=new database();
$n_panggil->koneksi();
$n_nisn = $_GET['nisn'];
$n_ambilmapel = $n_panggil->ambil_mapel();
$n_nilai = $n_panggil->tampil_nilai3($n_nisn);

?>
<?php
if(isset($_POST['nis'])){
    $n_kode_mapel    = $_POST['kode_mapel'];
    $n_nis           = $_POST['nis'];
    $n_nilai         = $_POST['nilain'];
    $n_semester      = $_POST['semester'];
    $n_kelas         = $_POST['kelas'];
    $n_panggil->insert_nilai2($n_nisn,$n_kode_mapel,$n_nilai,$n_semester,$n_kelas);
}
?>
<html>
    <head>
        <title>NILAI <?php echo $n_panggil->baca_nilai2("nama",$n_nisn); ?></title>
        <link href="css/style.css" rel="stylesheet">
        <style>
            header{
                background: white;
            }
        </style>
    </head>
    <body bgcolor="#f4f4f4">
        <header>
            <div class="sub-header">
            <ul>
                <li onclick="location.href='index.php'">Home</li>
                <li style=" font-weight:normal; text-transform:none;">Nama Siswa : <u><?php echo $n_panggil->baca_nilai2("nama",$n_nisn); ?></u></li>
                <li style=" font-weight:normal; text-transform:none;">Nilai Yang Kurang : &nbsp; <span class="jml"> <?php  echo $n_panggil->info_kurang($n_nisn); ?></span></li>
                <li style=" font-weight:normal; text-transform:none;">Nilai Yang Ada : &nbsp; <span class="jml"> <?php  echo $n_panggil->info_nilai($n_nisn); ?></span></li>
                <li style=" font-weight:normal; text-transform:none;">Seharusnya : &nbsp; <span class="jml"><?php  echo $n_panggil->info_seharusnya($n_nisn); ?></span></li>
            </ul>
                <form target="_self" name="cari" id="cari" enctype="multipart/form-data" method="get">
                    <input type="search" name="sch_cari" id="sch_cari" placeholder="Not Working">
                    <button type="submit" class="cari">Cari</button>
                </form>
                </div>
        </header>
        <div class="kotak">
        <div class="edit-semi" id="semi">
            <p>NILAI : <?php echo $n_panggil->baca_nilai2("nama",$n_nisn); ?></p>
        <form action="" method="post" enctype="multipart/form-data" id="edit_nilai" name="id_nilai" target="_self">
            <label>NISN : </label>
            <input type="text" id="nis" name="nis" placeholder="nisn" value="<?php echo $n_panggil->baca_nilai2("nisn",$n_nisn); ?>" readonly><br>
            <label>Mapel :</label>
            <select name="kode_mapel" id="kode_mapel" required>
                                <option selected disabled>- Pilih Mapel -</option>
                                <?php
                                foreach($n_ambilmapel as $n_lihatmapel){
                                    echo"<option value='$n_lihatmapel[kode_mapel]'>$n_lihatmapel[mapel]</option>";
                                }
                                ?>
                            </select>
                    <br>
            <label>Nilai :</label>
                    <input type="text" id="nilain" name="nilain" placeholder="Nilai" required><br>
            <label>Semester</label>
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
            <label>Kelas :</label>
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
            <button type="submit" id="submit" name="submit">Simpan</button>
            <button type="reset" onclick="location.href='index.php'">Kembali</button>
        </form>
            </div>
            <div class="lihat" id="semi">
                <table>
                    <tr>
                        <th>NO</th>
                        <th>NISN</th>
                        <th>Kode Mapel</th>
                        <th>Mapel</th>
                        <th>Nilai</th>
                        <th>Semester</th>
                        <th>Kelas</th>
                    </tr>
                    <?php
                    $nn = 1;
                    foreach($n_nilai as $d_nilai){
                        if($nn%2==0){
                            $warna ="#f8f8f8";
                        }else{
                            $warna ="white";
                        }
                        ?>
                    <tr bgcolor="<?php echo $warna; ?>">
                        <td align="center"><?php echo $nn; ?></td>
                        <td><?php echo $d_nilai['nisn']; ?></td>
                        <td align="center"><?php echo $d_nilai['kode_mapel']; ?></td>
                        <td><?php echo $d_nilai['mapel']; ?></td>
                        <td align="center"><?php echo $d_nilai['nilai']; ?></td>
                        <td align="center"><?php echo $d_nilai['semester']; ?></td>
                        <td align="center"><?php echo $d_nilai['kelas']; ?></td>
                    </tr>
                    <?php
                        $nn++;
                    }
                    ?>
                </table>
            </div>
            </div>
    </body>
</html>
<!-- Copyright (c) Nico Lahara 2016 ----->