<?php
include"lib_sisko.php";
error_reporting(0);
$n_panggil=new database();
$n_panggil->koneksi();
$n_id_siswa = $_GET['idsiswa'];
?>
<?php
if(isset($_POST['nisn'])){
    $n_nisn              = $_POST['nisn'];
    $n_nama              = $_POST['nama'];
    $n_jurusan           = $_POST['jurusan'];
    $n_jenkel            = $_POST['jenkel'];
    $n_tgllahir          = $_POST['tgllahir'];
    $n_agama             = $_POST['agama'];
    $n_no_hp             = $_POST['no_hp'];
    $n_nama_ayah         = $_POST['nama_ayah'];
    $n_pekerjaan_ayah    = $_POST['pekerjaan_ayah'];
    $n_no_hp_ayah        = $_POST['no_hp_ayah'];
    $n_nama_ibu          = $_POST['nama_ibu'];
    $n_pekerjaan_ibu     = $_POST['pekerjaan_ibu'];
    $n_alamat            = $_POST['alamat'];
    $n_panggil->edit_siswa($n_id_siswa,$n_nisn,$n_nama,$n_jurusan,$n_jenkel,$n_tgllahir,$n_agama,$n_no_hp,$n_nama_ayah,$n_pekerjaan_ayah,$n_no_hp_ayah,$n_nama_ibu,$n_pekerjaan_ibu,$n_alamat);
}
?>
<html>
    <head>
        <title>EDIT SISWA</title>
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
        <div class="edit-pro">
            <p>EDIT SISWA</p>
        <form action="" method="post" enctype="multipart/form-data" id="edit_siswa" name="id_siswa" target="_self">
            <table>
                <tr>
                    <td><label>NISN </label></td>
                    <td> : </td>
                    <td><input type="text" id="nisn" name="nisn" placeholder="NISN" value="<?php echo $n_panggil->baca_siswa("nisn",$n_id_siswa); ?>"></td>
                    <td><label>Nama Lengkap </label></td>
                    <td> : </td>
                    <td><input type="text" id="nama" name="nama" placeholder="Nama" value="<?php echo $n_panggil->baca_siswa("nama",$n_id_siswa); ?>"></td>
                </tr>
                <tr>
                    <td><label>Jurusan</label></td>
                    <td> : </td>
                    <td><input type="text" id="jurusan" name="jurusan" placeholder="jurusan" value="<?php echo $n_panggil->baca_siswa("jurusan",$n_id_siswa); ?>"></td>
                    <td><label>Jenis Kelamin </label></td>
                    <td> : </td>
                    <td><input type="text" id="jenkel" name="jenkel" placeholder="jenkel" value="<?php echo $n_panggil->baca_siswa("jenkel",$n_id_siswa); ?>"></td>
                </tr>
                <tr>
                    <td><label>Tanggal Lahir </label></td>
                    <td> : </td>
                    <td><input type="text" id="tgllahir" name="tgllahir" placeholder="tgllahir" value="<?php echo $n_panggil->baca_siswa("tgllahir",$n_id_siswa); ?>"></td>
                    <td><label>Agama</label></td>
                    <td> : </td>
                    <td><input type="text" id="agama" name="agama" placeholder="agama" value="<?php echo $n_panggil->baca_siswa("agama",$n_id_siswa); ?>"></td>
                </tr>
                <tr>
                    <td><label>No Telp </label></td>
                    <td> : </td>
                    <td> <input type="text" id="no_hp" name="no_hp" placeholder="no_hp" value="<?php echo $n_panggil->baca_siswa("no_hp",$n_id_siswa); ?>"></td>
                    <td><label>Nama Ayah </label></td>
                    <td> : </td>
                    <td><input type="text" id="nama_ayah" name="nama_ayah" placeholder="nama_ayah" value="<?php echo $n_panggil->baca_siswa("nama_ayah",$n_id_siswa); ?>"></td>
                </tr>
                <tr>
                    <td><label>Pekerjaan Ayah </label></td>
                    <td> : </td>
                    <td><input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" placeholder="pekerjaan_ayah" value="<?php echo $n_panggil->baca_siswa("pekerjaan_ayah",$n_id_siswa); ?>"></td>
                    <td><label>No Telp Orang Tua </label></td>
                    <td> : </td>
                    <td><input type="text" id="no_hp_ayah" name="no_hp_ayah" placeholder="No Telp Ayah" value="<?php echo $n_panggil->baca_siswa("ho_hp_ayah",$n_id_siswa); ?>"></td>
                </tr>
                <tr>
                    <td><label>Nama Ibu </label></td>
                    <td> : </td>
                    <td><input type="text" id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu" value="<?php echo $n_panggil->baca_siswa("nama_ibu",$n_id_siswa); ?>"></td>
                    <td><label>Pekerjaan Ibu</label></td>
                    <td> : </td>
                    <td> <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" placeholder="pekerjaan_ibu" value="<?php echo $n_panggil->baca_siswa("pekerjaan_ibu",$n_id_siswa); ?>"></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td> : </td>
                    <td>
                        <textarea name="alamat" id="alamat" placeholder="Alamat"><?php echo $n_panggil->baca_siswa("alamat",$n_id_siswa); ?></textarea>
                        </td>
                    <td colspan="3"><button type="submit" id="submit" name="submit">Simpan</button>
                    <button type="reset" onclick="location.href='index.php'">Kembali</button></td>
                </tr>
                <tr>
                    <td colspan="6"></td>
                </tr>
                </table>
        </form>
            </div>
    </body>
</html>