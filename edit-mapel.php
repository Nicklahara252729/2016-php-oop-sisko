<?php
include"lib_sisko.php";
error_reporting(0);
$n_panggil=new database();
$n_panggil->koneksi();
$n_id_mapel = $_GET['idmapel'];
?>
<?php
if(isset($_POST['kode_guru'])){
    $n_kode_guru    = $_POST['kode_guru'];
    $n_kode_mape    = $_POST['kode_mapel'];
    $n_mapel        = $_POST['mapel'];
    $n_panggil->edit_pelajaran($n_id_mapel,$n_kode_guru,$n_kode_mape,$n_mapel);
}
?>
<html>
    <head>
        <title>EDIT MAPEL</title>
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
            <p>EDIT MAPEL</p>
        <form action="" method="post" enctype="multipart/form-data" id="edit_mapel" name="id_mapel" target="_self">
            <label>Kode Guru :</label>
            <input type="text" id="kode_guru" name="kode_guru" placeholder="kode_guru" value="<?php echo $n_panggil->baca_mapel("kode_guru",$n_id_mapel); ?>"><br>
            <label>Kode Mapel :</label>
            <input type="text" id="kode_mapel" name="kode_mapel" placeholder="kode_mapel" value="<?php echo $n_panggil->baca_mapel("kode_mapel",$n_id_mapel); ?>"><br>
            <label>Mapel :</label>
            <input type="text" id="mapel" name="mapel" placeholder="mapel" value="<?php echo $n_panggil->baca_mapel("mapel",$n_id_mapel); ?>"><br>
            <button type="submit" id="submit" name="submit">Simpan</button>
            <button type="reset" onclick="location.href='index.php'">Kembali</button>
        </form>
            </div>
    </body>
</html>