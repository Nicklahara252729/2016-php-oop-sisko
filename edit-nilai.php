<?php
include"lib_sisko.php";
error_reporting(0);
$n_panggil=new database();
$n_panggil->koneksi();
$n_id_nilai = $_GET['id_nilai'];
?>
<?php
if(isset($_POST['nisn'])){
    $n_nisn          = $_POST['nisn'];
    $n_kode_mapel    = $_POST['kode_mapel'];
    $n_nilai         = $_POST['nilai'];
    $n_semester      = $_POST['semester'];
    $n_kelas         = $_POST['kelas'];
    $n_panggil->edit_nilai($n_id_nilai,$n_nisn,$n_kode_mapel,$n_nilai,$n_semester,$n_kelas);
}
?>
<html>
    <head>
        <title>EDIT NILAI</title>
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
            <p>EDIT NILAI</p>
        <form action="" method="post" enctype="multipart/form-data" id="edit_nilai" name="id_nilai" target="_self">
            <label>NISN :</label>
            <input type="text" id="nisn" name="nisn" placeholder="nisn" value="<?php echo $n_panggil->baca_nilai("nisn",$n_id_nilai); ?>"><br>
            <label>Kode Mapel :</label>
            <input type="text" id="kode_mapel" name="kode_mapel" placeholder="kode_mapel" value="<?php echo $n_panggil->baca_nilai("kode_mapel",$n_id_nilai); ?>"><br>
            <label>Nilai :</label>
            <input type="text" id="nilai" name="nilai" placeholder="nilai" value="<?php echo $n_panggil->baca_nilai("nilai",$n_id_nilai); ?>"><br>
            <label>Semester :</label>
            <input type="text" id="semester" name="semester" placeholder="semester" value="<?php echo $n_panggil->baca_nilai("semester",$n_id_nilai); ?>"><br>
            <label>Kelas :</label>
            <input type="text" id="kelas" name="kelas" placeholder="kelas" value="<?php echo $n_panggil->baca_nilai("kelas",$n_id_nilai); ?>"><br>
            <button type="submit" id="submit" name="submit">Simpan</button>
            <button type="reset" onclick="location.href='index.php'">Kembali</button>
        </form>
            </div>
    </body>
</html>