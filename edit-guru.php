<?php
include"lib_sisko.php";
error_reporting(0);
$n_panggil=new database();
$n_panggil->koneksi();
$n_id_guru = $_GET['idguru'];
?>
<?php
if(isset($_POST['nip'])){
    $n_nip          = $_POST['nip'];
    $n_kode_guru    = $_POST['kode_guru'];
    $n_nama_guru    = $_POST['nama_guru'];
    $n_gol          = $_POST['gol'];
    $n_status       = $_POST['status'];
    $n_agama        = $_POST['agama'];
    $n_tgllahir     = $_POST['tgllahir'];
    $n_no_hp        = $_POST['no_hp'];
    $n_alamat       = $_POST['alamat'];
    $n_panggil->edit_guru($n_id_guru,$n_nip,$n_kode_guru,$n_nama_guru,$n_gol,$n_status,$n_agama,$n_tgllahir,$n_no_hp,$n_alamat);
}
?>
<html>
    <head>
        <title>EDIT GURU</title>
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
            <p>EDIT GURU</p>
        <form action="" method="post" enctype="multipart/form-data" id="edit_guru" name="id_guru" target="_self">
            <table>
                <tr>
                    <td><label for="nip">NIP </label></td>
                    <td> : </td>
                    <td><input type="text" id="nip" name="nip" placeholder="NIP" value="<?php echo $n_panggil->baca_guru("nip",$n_id_guru); ?>"></td>
                    <td><label for="kode_guru">Kode Guru </label></td>
                    <td> : </td>
                    <td><input type="text" id="kode_guru" name="kode_guru" placeholder="NIP" value="<?php echo $n_panggil->baca_guru("kode_guru",$n_id_guru); ?>"></td>
                </tr>
                <tr>
                    <td><label for="nama_guru">Nama Guru </label></td>
                    <td> : </td>
                    <td><input type="text" id="nama_guru" name="nama_guru" placeholder="nama_guru" value="<?php echo $n_panggil->baca_guru("nama_guru",$n_id_guru); ?>"></td>
                    <td><label for="gol">Golongan </label></td>
                    <td> : </td>
                    <td><input type="text" id="gol" name="gol" placeholder="gol" value="<?php echo $n_panggil->baca_guru("gol",$n_id_guru); ?>"></td>
                </tr>
                <tr>
                    <td><label for="status">Status </label></td>
                    <td> : </td>
                    <td><input type="text" id="status" name="status" placeholder="status" value="<?php echo $n_panggil->baca_guru("status",$n_id_guru); ?>"></td>
                    <td><label for="agama">Agama </label></td>
                    <td> : </td>
                    <td><input type="text" id="agama" name="agama" placeholder="agama" value="<?php echo $n_panggil->baca_guru("agama_guru",$n_id_guru); ?>"></td>
                </tr>
                <tr>
                    <td><label for="tgl">Tanggal Lahir </label></td>
                    <td> : </td>
                    <td><input type="text" id="tgllahir" name="tgllahir" placeholder="tgllahir" value="<?php echo $n_panggil->baca_guru("tgllahir_guru",$n_id_guru); ?>"></td>
                    <td><label for="no">No Telp </label></td>
                    <td> : </td>
                    <td><input type="text" id="no_hp" name="no_hp" placeholder="NIP" value="<?php echo $n_panggil->baca_guru("no_hp",$n_id_guru); ?>"></td>
                </tr>
                <tr>
                    <td><label for="alamat">Alamat </label></td>
                    <td> : </td>
                    <td><textarea name="alamat" id="alamat" placeholder="Alamat"> <?php echo $n_panggil->baca_guru("alamat",$n_id_guru); ?></textarea></td>
                    <td colspan="3"><button type="submit" id="submit" name="submit">Simpan</button>
            <button type="reset" onclick="location.href='index.php'">Kembali</button></td>
                </tr>
                </table>
        </form>
            </div>
    </body>
</html>