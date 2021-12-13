<?php
include"lib_sisko.php";
error_reporting(0);
$n_panggil=new database();
$n_panggil->koneksi();
$n_id_jadwal = $_GET['idjadwal'];
?>
<?php
if(isset($_POST['nip'])){
    $n_nip          = $_POST['nip'];
    $n_hari         = $_POST['hari'];
    $n_jam          = $_POST['jam'];
    $n_kode_mapel   = $_POST['kode_mapel'];
    $n_ruang        = $_POST['ruang'];
    $n_panggil->edit_jadwal($n_id_jadwal,$n_nip,$n_hari,$n_jam,$n_kode_mapel,$n_ruang);
}
?>
<html>
    <head>
        <title>EDIT JADWAL</title>
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
            </ul>
                <form target="_self" name="cari" id="cari" enctype="multipart/form-data" method="get">
                    <input type="search" name="sch_cari" id="sch_cari" placeholder="Cari Hari, Mapel , Kode Mapel , Guru">
                    <button type="submit" class="cari">Cari</button>
                </form>
                </div>
        </header>
        <div class="edit">
            <p>EDIT JADWAL</p>
        <form action="" method="post" enctype="multipart/form-data" id="edit_jadwal" name="id_jadwal" target="_self">
            <label>Kode Guru :</label>
            <input type="text" id="nip" name="nip" placeholder="NIP" value="<?php echo $n_panggil->baca_jadwal("kode_guru",$n_id_jadwal); ?>"><br>
            <label>Hari :</label>
            <input type="text" id="hari" name="hari" placeholder="hari" value="<?php echo $n_panggil->baca_jadwal("hari",$n_id_jadwal); ?>"><br>
            <label>Jam :</label>
            <input type="text" id="jam" name="jam" placeholder="jam" value="<?php echo $n_panggil->baca_jadwal("jam",$n_id_jadwal); ?>"><br>
            <label>Kode Mapel :</label>
            <input type="text" id="kode_mapel" name="kode_mapel" placeholder="Kode Mapel" value="<?php echo $n_panggil->baca_jadwal("kode_mapel",$n_id_jadwal); ?>"><br>
            <label>Ruang :</label>
            <input type="text" id="ruang" name="ruang" placeholder="ruang" value="<?php echo $n_panggil->baca_jadwal("ruang",$n_id_jadwal); ?>"><br>
            <button type="submit" id="submit" name="submit">Simpan</button>
            <button type="reset" onclick="location.href='index.php'">Kembali</button>
        </form>
            </div>
    </body>
</html>