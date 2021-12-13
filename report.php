<?php
error_reporting(0);
include"lib_sisko.php";
$n_panggil  = new database();
$n_panggil->koneksi();
$nisndetail = $_GET['nisn'];
$n_sdetail	= $n_panggil->tampil_detail($nisndetail,$_GET['sch_cari']);

?>
<?php
if(isset($_GET['del'])){
    $del = $_GET['del'];
    $hps = $n_panggil->hapus_detail($del,$_GET['nisn']);
}
?>
<?php
if(isset($_GET['delall'])){
    $del_nisn = $_GET['delall'];
    $hps = $n_panggil->hapus_alldetail($del_nisn);
}
?>
<!doctype html>
<html>
    <head>
        <title>Report | <?php echo $n_panggil->baca_detail("nama",$nisndetail); ?></title>
        <link href="css/style.css" rel="stylesheet">
        <script src="js/jquery-2.1.4.js" type="text/javascript"></script>
        <script src="js/n_java.js" type="text/javascript"></script>
		
    </head>
    <body bgcolor="#464646">
        
        <main>
            <div class="content">
                <div class="atas">
                    <form target="_self" name="cari" id="cari" method="get" enctype="multipart/form-data">
                        <input type="hidden" name="nisn" id="nisn" value="<?php echo $n_panggil->baca_detail("nisn",$nisndetail); ?>">
                        <label>Tampilkan Sesuai : </label>
                        <select name="sch_cari" id="sch_cari">
                            <option disabled selected>- Pilih Semester -</option>
                           <?php
                            $sem = array('I','II','III','IV','V','VI');
                            for($i=0;$i<=5;$i++){
                                echo"<option value='$sem[$i]'>$sem[$i]</option>";
                            }
                            ?>
                        </select>
                        <button type="submit" class="sub">GO</button>
                    </form>
                    <button type="button" onclick="location.href='index.php'" class="x">X</button>
                </div>
                <div class="header">
                    <div class="isi-header" id="left-header">
                        <img src="img/<?php echo $n_panggil->baca_detail("foto",$nisndetail); ?>">
                    </div>
                    <div class="isi-header" id="main-header">
                        <table>
                            <tr>
                                <td>NISN</td>
                                <td style="width:60px;" align="center">:</td>
                                <td style="width:300px;"><?php echo $n_panggil->baca_detail("nisn",$nisndetail); ?></td>
                                <td>No Telp</td>
                                <td style="width:60px;" align="center">:</td>
                                <td><?php echo $n_panggil->baca_detail("no_hp",$nisndetail); ?>
                            </tr>
                            </tr>
                            <tr>
                                <td>Nama Siswa</td>
                                <td style="width:60px;" align="center">:</td>
                                <td><?php echo $n_panggil->baca_detail("nama",$nisndetail); ?></td>
                                <td>Nama Ayah</td>
                                <td style="width:60px;" align="center">:</td>
                                <td><?php echo $n_panggil->baca_detail("nama_ayah",$nisndetail); ?></td>
                            </tr>
                            <tr>
                                <td>Jurusan</td>
                                <td style="width:60px;" align="center">:</td>
                                <td><?php echo $n_panggil->baca_detail("jurusan",$nisndetail); ?></td>                  
                                <td>Pekerjaan Ayah</td>
                                <td style="width:60px;" align="center">:</td>
                                <td><?php echo $n_panggil->baca_detail("pekerjaan_ayah",$nisndetail); ?></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td style="width:60px;" align="center">:</td>
                                <td><?php echo $n_panggil->baca_detail("jenkel",$nisndetail); ?></td>
                                <td>No Telp Orang Tua</td>
                                <td style="width:60px;" align="center">:</td>
                                <td><?php echo $n_panggil->baca_detail("ho_hp_ayah",$nisndetail); ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td style="width:60px;" align="center">:</td>
                                <td><?php echo $n_panggil->baca_detail("tgllahir",$nisndetail); ?></td>
                                <td>Nama Ibu</td>
                                <td style="width:60px;" align="center">:</td>
                                <td><?php echo $n_panggil->baca_detail("nama_ibu",$nisndetail); ?></td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td style="width:60px;" align="center">:</td>
                                <td><?php echo $n_panggil->baca_detail("agama",$nisndetail); ?></td>
                                <td>Pekerjaan Ibu</td>
                                <td style="width:60px;" align="center">:</td>
                                <td><?php echo $n_panggil->baca_detail("pekerjaan_ibu",$nisndetail); ?></td>
                            </tr>
                        </table>
                    </div>
                <div class="isi-header" id="right-header">
                    <table>
                        <tr>
                            <td class="td1" colspan="2">RANK : <span>1</span></td>
                        </tr>
                        <tr>
                            <td class="td2" colspan="2">UMUM : <span>2</span></td>
                        </tr>
                        <tr>
                            <td class="td3">AVG : <?php echo $n_panggil->rata($nisndetail); ?></td>
                            <td class="td3">TOTAL : <?php echo $n_panggil->total($nisndetail); ?></td>
                        </tr>
                    </table>
                </div>
				</div>
                <div class="isi">
				<table>
                    <tr>
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>Nilai</th>
                        <th>Semester</th>
                        <th>Nama Guru</th>
                        <th>Tidakan</th>
                    </tr>
                    
				<?php
                    $nn=1;
                    foreach($n_sdetail as $n_ddetail){
                        if($nn%2==0){
                        $warna ="#f8f8f8";
                    }else{
                        $warna ="white";
                    }
                        ?>
				<tr bgcolor="<?php echo $warna; ?>">
				<td align="center"><?php echo $nn; ?></td>
				<td><?php echo $n_ddetail['mapel']; ?></td>
                <td align="center"><?php echo $n_ddetail['nilai']; ?></td>
                <td align="center"><?php echo $n_ddetail['semester']; ?></td>
                <td><?php echo $n_ddetail['nama_guru']; ?></td>
                    <td align="center"><a href="?del=<?php echo $n_ddetail['id_nilai']; ?>&nisn=<?php echo $n_ddetail['nisn']; ?>">HAPUS</a> | <a href="edit-nilai.php?id_nilai=<?php echo $n_ddetail['id_nilai']; ?>">EDIT</a></td>
				</tr>
				<?php
                        $nn++;
                    }
                    ?>
				</table>
				</div>
            <a href="?delall=<?php echo $n_ddetail['nisn']; ?>" class="delete">DELETE ALL</a>
            <button type="button" onclick="window.print();" class="print">PRINT</button>
            </div>
			
        </main>
    </body>
</html>