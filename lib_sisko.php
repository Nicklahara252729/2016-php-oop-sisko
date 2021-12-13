<?php
class database{
    private $n_host="localhost";
    private $n_user="root";
    private $n_pass="";
    private $n_db="sisko";
    
    function koneksi(){
        mysql_connect($this->n_host,$this->n_user,$this->n_pass);
        mysql_select_db($this->n_db) or die ("database tidak ada");
    }
    
    
    
//---------------------------- MASUKAN -----------------------------
    function insert_guru($n_nip,$n_kode_guru,$n_nama_guru,$n_gol,$n_status,$n_agama,$n_tgllahir,$n_no_hp,$n_alamat,$n_foto,$n_tmpfoto){
        $n_sql=mysql_query("insert into guru set nip='$n_nip', kode_guru='$n_kode_guru', nama_guru='$n_nama_guru', gol='$n_gol', status='$n_status', agama_guru='$n_agama', tgllahir_guru='$n_tgllahir', no_hp='$n_no_hp', alamat='$n_alamat',foto_guru='$n_foto', hapusguru='ok'");
        move_uploaded_file($n_tmpfoto,"img/".$n_foto);
        header("location:index.php");
    }
    
    function insert_siswa($n_nisn,$n_nama,$n_jurusan,$n_jenkel,$n_tgllahir,$n_agama,$n_no_hp,$n_nama_ayah,$n_pekerjaan_ayah,$n_no_hp_ayah,$n_nama_ibu,$n_pekerjaan_ibu,$n_alamat,$n_foto,$n_tmpfoto){
        $n_sql=mysql_query("insert into siswa set nisn='$n_nisn', nama='$n_nama', jurusan='$n_jurusan',jenkel='$n_jenkel',tgllahir='$n_tgllahir',agama='$n_agama',no_hp='$n_no_hp',nama_ayah='$n_nama_ayah',pekerjaan_ayah='$n_pekerjaan_ayah',ho_hp_ayah='$n_no_hp_ayah',nama_ibu='$n_nama_ibu',pekerjaan_ibu='$n_pekerjaan_ibu',alamat='$n_alamat',foto='$n_foto', hapussiswa='ok'");
        move_uploaded_file($n_tmpfoto,"img/".$n_foto);
        header("location:index.php");
    }
    
    function insert_jadwal($n_nip,$n_hari,$n_jam,$n_kode_mapel,$n_ruang,$n_kelas){
        $n_sql=mysql_query("insert into jadwal set kode_guru='$n_nip', hari='$n_hari',jam='$n_jam',kode_mapel='$n_kode_mapel',ruang='$n_ruang',kelas='$n_kelas',hapusjadwal='ok'");
        header("location:index.php");
    }
    
    function insert_nilai($n_nisn,$n_kode_mapel,$n_nilai,$n_semester,$n_kelas){
        $n_sql=mysql_query("insert into nilai set nisn='$n_nisn', kode_mapel='$n_kode_mapel',nilai='$n_nilai',semester='$n_semester',kelas='$n_kelas', hapus='ok'");
        header("location:index.php");
    }
    
    function insert_pelajaran($n_kode_guru,$n_kode_mapel,$n_mapel){
        $n_sql=mysql_query("insert into pelajaran set kode_guru='$n_kode_guru', kode_mapel='$n_kode_mapel', mapel='$n_mapel',hapusmapel='ok'");
        header("location:index.php");
    }
    
    function insert_nilai2($n_nisn,$n_kode_mapel,$n_nilai,$n_semester,$n_kelas){
        $n_sql  = mysql_query("insert into nilai set nisn='$n_nisn', kode_mapel='$n_kode_mapel', nilai='$n_nilai', semester='$n_semester', kelas='$n_kelas', hapus='ok'");
        header("location:input-nilai.php?nisn=$n_nisn");
    }
//---------------------------------------------------------------- 

//------------------------- PAGGING ------------------------------
    function page_guru(){
        $limit = 10;
        if(!isset($_GET['halaman'])){
            $halaman = 1;
            $posisi = 0;
        }else{
            $halaman = $_GET['halaman'];
            $posisi = ($halaman-1)*$limit;
        }
        $nn_sql = mysql_query("select * from guru");
        $jmldata = mysql_num_rows($nn_sql);
        $jmlhal = ceil($jmldata/$limit);
        if($halaman > 1){
            $prev = $halaman-1;
            echo"<a href='$_SERVER[PHP_SELF]?halaman=$prev' class='page'><< Prev</a>";
        }else{
            echo"<span disabled class='page'><< Prev</a>";
        }
        for($i=1;$i<=$jmlhal;$i++)
            if($i!=$halaman){
                echo"<a href='$_SERVER[PHP_SELF]?halaman=$i' class='page'>$i</a>";
            }else{
                echo"<span current class='page'>$i</a>";
            }
        if($halaman < $jmlhal){
            $next = $halaman+1;
            echo"<a href='$_SERVER[PHP_SELF]?halaman=$next' class='page'>Next >> </a>";
        }else{
            echo"<span disabled class='page'> Next >></span>";
        }
    }
    
    function page_guru2(){
        $limit = 30;
        if(!isset($_GET['halaman'])){
            $halaman = 1;
            $posisi = 0;
        }else{
            $halaman = $_GET['halaman'];
            $posisi = ($halaman-1)*$limit;
        }
        $nn_sql = mysql_query("select * from guru");
        $jmldata = mysql_num_rows($nn_sql);
        $jmlhal = ceil($jmldata/$limit);
        if($halaman > 1){
            $prev = $halaman-1;
            echo"<a href='$_SERVER[PHP_SELF]?halaman=$prev' class='page'><< Prev</a>";
        }else{
            echo"<span disabled class='page'><< Prev</a>";
        }
        for($i=1;$i<=$jmlhal;$i++)
            if($i!=$halaman){
                echo"<a href='$_SERVER[PHP_SELF]?halaman=$i' class='page'>$i</a>";
            }else{
                echo"<span current class='page'>$i</a>";
            }
        if($halaman < $jmlhal){
            $next = $halaman+1;
            echo"<a href='$_SERVER[PHP_SELF]?halaman=$next' class='page'>Next >> </a>";
        }else{
            echo"<span disabled class='page'> Next >></span>";
        }
    }
    
    function page_siswa(){
        $limit = 10;
        if(!isset($_GET['halaman'])){
            $halaman = 1;
            $posisi = 0;
        }else{
            $halaman = $_GET['halaman'];
            $posisi = ($halaman-1)*$limit;
        }
        $nn_sql = mysql_query("select * from siswa");
        $jmldata = mysql_num_rows($nn_sql);
        $jmlhal = ceil($jmldata/$limit);
        if($halaman > 1){
            $prev = $halaman-1;
            echo"<a href='$_SERVER[PHP_SELF]?halaman=$prev' class='page'><< Prev</a>";
        }else{
            echo"<span disabled class='page'><< Prev</a>";
        }
        for($i=1;$i<=$jmlhal;$i++)
            if($i!=$halaman){
                echo"<a href='$_SERVER[PHP_SELF]?halaman=$i' class='page'>$i</a>";
            }else{
                echo"<span current class='page'>$i</a>";
            }
        if($halaman < $jmlhal){
            $next = $halaman+1;
            echo"<a href='$_SERVER[PHP_SELF]?halaman=$next' class='page'>Next >> </a>";
        }else{
            echo"<span disabled class='page'> Next >></span>";
        }
    }
    
    function page_siswa2(){
        $limit = 30;
        if(!isset($_GET['halaman'])){
            $halaman = 1;
            $posisi = 0;
        }else{
            $halaman = $_GET['halaman'];
            $posisi = ($halaman-1)*$limit;
        }
        $nn_sql = mysql_query("select * from siswa");
        $jmldata = mysql_num_rows($nn_sql);
        $jmlhal = ceil($jmldata/$limit);
        if($halaman > 1){
            $prev = $halaman-1;
            echo"<a href='$_SERVER[PHP_SELF]?halaman=$prev' class='page'><< Prev</a>";
        }else{
            echo"<span disabled class='page'><< Prev</a>";
        }
        for($i=1;$i<=$jmlhal;$i++)
            if($i!=$halaman){
                echo"<a href='$_SERVER[PHP_SELF]?halaman=$i' class='page'>$i</a>";
            }else{
                echo"<span current class='page'>$i</a>";
            }
        if($halaman < $jmlhal){
            $next = $halaman+1;
            echo"<a href='$_SERVER[PHP_SELF]?halaman=$next' class='page'>Next >> </a>";
        }else{
            echo"<span disabled class='page'> Next >></span>";
        }
    }
    
    function page_jadwal(){
        $limit = 10;
        if(!isset($_GET['halaman'])){
            $halaman = 1;
            $posisi = 0;
        }else{
            $halaman = $_GET['halaman'];
            $posisi = ($halaman-1)*$limit;
        }
        $nn_sql = mysql_query("select * from jadwal");
        $jmldata = mysql_num_rows($nn_sql);
        $jmlhal = ceil($jmldata/$limit);
        if($halaman > 1){
            $prev = $halaman-1;
            echo"<a href='$_SERVER[PHP_SELF]?halaman=$prev' class='page'><< Prev</a>";
        }else{
            echo"<span disabled class='page'><< Prev</a>";
        }
        for($i=1;$i<=$jmlhal;$i++)
            if($i!=$halaman){
                echo"<a href='$_SERVER[PHP_SELF]?halaman=$i' class='page'>$i</a>";
            }else{
                echo"<span current class='page'>$i</a>";
            }
        if($halaman < $jmlhal){
            $next = $halaman+1;
            echo"<a href='$_SERVER[PHP_SELF]?halaman=$next' class='page'>Next >> </a>";
        }else{
            echo"<span disabled class='page'> Next >></span>";
        }
    }
    
    function page_jadwal2(){
        $limit = 30;
        if(!isset($_GET['halaman'])){
            $halaman = 1;
            $posisi = 0;
        }else{
            $halaman = $_GET['halaman'];
            $posisi = ($halaman-1)*$limit;
        }
        
            $nn_sql=mysql_query("select * from jadwal join pelajaran on (jadwal.kode_mapel=pelajaran.kode_mapel) join guru on (pelajaran.kode_guru=guru.kode_guru)");
        
        $jmldata = mysql_num_rows($nn_sql);
        $jmlhal = ceil($jmldata/$limit);
        if($halaman > 1){
            $prev = $halaman-1;
            echo"<a href='$_SERVER[PHP_SELF]?halaman=$prev' class='page'><< Prev</a>";
        }else{
            echo"<span disabled class='page'><< Prev</a>";
        }
        for($i=1;$i<=$jmlhal;$i++)
            if($i!=$halaman){
                echo"<a href='$_SERVER[PHP_SELF]?halaman=$i' class='page'>$i</a>";
            }else{
                echo"<span current class='page'>$i</a>";
            }
        if($halaman < $jmlhal){
            $next = $halaman+1;
            echo"<a href='$_SERVER[PHP_SELF]?halaman=$next' class='page'>Next >> </a>";
        }else{
            echo"<span disabled class='page'> Next >></span>";
        }
    }
    
    function page_nilai(){
        $limit = 10;
        if(!isset($_GET['halaman'])){
            $halaman = 1;
            $posisi = 0;
        }else{
            $halaman = $_GET['halaman'];
            $posisi = ($halaman-1)*$limit;
        }
        $nn_sql = mysql_query("select * from nilai");
        $jmldata = mysql_num_rows($nn_sql);
        $jmlhal = ceil($jmldata/$limit);
        if($halaman > 1){
            $prev = $halaman-1;
            echo"<a href='$_SERVER[PHP_SELF]?halaman=$prev' class='page'><< Prev</a>";
        }else{
            echo"<span disabled class='page'><< Prev</a>";
        }
        for($i=1;$i<=$jmlhal;$i++)
            if($i!=$halaman){
                echo"<a href='$_SERVER[PHP_SELF]?halaman=$i' class='page'>$i</a>";
            }else{
                echo"<span current class='page'>$i</a>";
            }
        if($halaman < $jmlhal){
            $next = $halaman+1;
            echo"<a href='$_SERVER[PHP_SELF]?halaman=$next' class='page'>Next >> </a>";
        }else{
            echo"<span disabled class='page'> Next >></span>";
        }
    }
    
    function page_nilai2(){
        $limit = 30;
        if(!isset($_GET['halaman'])){
            $halaman = 1;
            $posisi = 0;
        }else{
            $halaman = $_GET['halaman'];
            $posisi = ($halaman-1)*$limit;
        }
        $nn_sql = mysql_query("select * from nilai join siswa on (nilai.nisn=siswa.nisn) join pelajaran on (nilai.kode_mapel=pelajaran.kode_mapel) join guru on (pelajaran.kode_guru=guru.kode_guru)");
        $jmldata = mysql_num_rows($nn_sql);
        $jmlhal = ceil($jmldata/$limit);
        if($halaman > 1){
            $prev = $halaman-1;
            echo"<a href='$_SERVER[PHP_SELF]?halaman=$prev' class='page'><< Prev</a>";
        }else{
            echo"<span disabled class='page'><< Prev</a>";
        }
        for($i=1;$i<=$jmlhal;$i++)
            if($i!=$halaman){
                echo"<a href='$_SERVER[PHP_SELF]?halaman=$i' class='page'>$i</a>";
            }else{
                echo"<span current class='page'>$i</a>";
            }
        if($halaman < $jmlhal){
            $next = $halaman+1;
            echo"<a href='$_SERVER[PHP_SELF]?halaman=$next' class='page'>Next >> </a>";
        }else{
            echo"<span disabled class='page'> Next >></span>";
        }
    }   
    
    function page_mapel(){
        $limit = 10;
        if(!isset($_GET['halaman'])){
            $halaman = 1;
            $posisi = 0;
        }else{
            $halaman = $_GET['halaman'];
            $posisi = ($halaman-1)*$limit;
        }
        $nn_sql = mysql_query("select * from pelajaran");
        $jmldata = mysql_num_rows($nn_sql);
        $jmlhal = ceil($jmldata/$limit);
        if($halaman > 1){
            $prev = $halaman-1;
            echo"<a href='$_SERVER[PHP_SELF]?halaman=$prev' class='page'><< Prev</a>";
        }else{
            echo"<span disabled class='page'><< Prev</a>";
        }
        for($i=1;$i<=$jmlhal;$i++)
            if($i!=$halaman){
                echo"<a href='$_SERVER[PHP_SELF]?halaman=$i' class='page'>$i</a>";
            }else{
                echo"<span current class='page'>$i</a>";
            }
        if($halaman < $jmlhal){
            $next = $halaman+1;
            echo"<a href='$_SERVER[PHP_SELF]?halaman=$next' class='page'>Next >> </a>";
        }else{
            echo"<span disabled class='page'> Next >></span>";
        }
    }
    
    function page_mapel2(){
        $limit = 30;
        if(!isset($_GET['halaman'])){
            $halaman = 1;
            $posisi = 0;
        }else{
            $halaman = $_GET['halaman'];
            $posisi = ($halaman-1)*$limit;
        }
        $nn_sql = mysql_query("select * from pelajaran");
        $jmldata = mysql_num_rows($nn_sql);
        $jmlhal = ceil($jmldata/$limit);
        if($halaman > 1){
            $prev = $halaman-1;
            echo"<a href='$_SERVER[PHP_SELF]?halaman=$prev' class='page'><< Prev</a>";
        }else{
            echo"<span disabled class='page'><< Prev</a>";
        }
        for($i=1;$i<=$jmlhal;$i++)
            if($i!=$halaman){
                echo"<a href='$_SERVER[PHP_SELF]?halaman=$i' class='page'>$i</a>";
            }else{
                echo"<span current class='page'>$i</a>";
            }
        if($halaman < $jmlhal){
            $next = $halaman+1;
            echo"<a href='$_SERVER[PHP_SELF]?halaman=$next' class='page'>Next >> </a>";
        }else{
            echo"<span disabled class='page'> Next >></span>";
        }
    }
//----------------------------------------------------------------
    
//------------------------- TAMPIL -------------------------------
    function tampil_guru(){
        $limit = 10;
        if(!isset($_GET['halaman'])){
            $halaman = 1;
            $posisi = 0;
        }else{
            $halaman = $_GET['halaman'];
            $posisi = ($halaman-1)*$limit;
        }
        $n_sql=mysql_query("select * from guru order by nip asc limit $posisi,$limit");
        while ($nr=mysql_fetch_array($n_sql))
            $n_data[]=$nr;
        return $n_data;
    }
    
    function tampil_guru2($cari){
        $limit = 30;
        if(!isset($_GET['halaman'])){
            $halaman = 1;
            $posisi = 0;
        }else{
            $halaman = $_GET['halaman'];
            $posisi = ($halaman-1)*$limit;
        }
        if(isset($cari)){
             $n_sql=mysql_query("select * from guru where nip like '%$cari%' or kode_guru like '%$cari%' or nama_guru like '%$cari%' order by nip asc limit $posisi,$limit");
        }else{
             $n_sql=mysql_query("select * from guru order by nip asc limit $posisi,$limit");
        }
        while ($nr=mysql_fetch_array($n_sql))
            $n_data[]=$nr;
        return $n_data;
    }

    function tampil_siswa(){
        $limit = 10;
        if(!isset($_GET['halaman'])){
            $halaman = 1;
            $posisi = 0;
        }else{
            $halaman = $_GET['halaman'];
            $posisi = ($halaman-1)*$limit;
        }
        $n_sql=mysql_query("select * from siswa order by nisn asc limit $posisi,$limit");
        while ($nr=mysql_fetch_array($n_sql))
            $n_data[]=$nr;
        return $n_data;
       
    }
    
    function tampil_siswa2($cari){
        $limit = 30;
        if(!isset($_GET['halaman'])){
            $halaman = 1;
            $posisi = 0;
        }else{
            $halaman = $_GET['halaman'];
            $posisi = ($halaman-1)*$limit;
        }
        if(isset($cari)){
            $n_sql=mysql_query("select * from siswa where nama like '%$cari%' or jurusan like '%$cari%' or nisn like '%$cari%' order by nisn asc limit $posisi,$limit");
        }else{
            $n_sql=mysql_query("select * from siswa order by nisn asc limit $posisi,$limit");
        }
        
        while ($nr=mysql_fetch_array($n_sql))
            $n_data[]=$nr;
        return $n_data;
       
    }
    
    function tampil_jadwal(){
        $limit=10;
        if(!isset($_GET['halaman'])){
            $halaman = 1;
            $posisi = 0;
        }else{
            $halaman = $_GET['halaman'];
            $posisi = ($halaman-1)*$limit;
        }
        $n_sql=mysql_query("select * from jadwal limit $posisi,$limit");
        while ($nr=mysql_fetch_array($n_sql))
            $n_data[]=$nr;
        return $n_data;
    }
    
    function tampil_jadwal2($cari){
        $limit=30;
        if(!isset($_GET['halaman'])){
            $halaman = 1;
            $posisi = 0;
        }else{
            $halaman = $_GET['halaman'];
            $posisi = ($halaman-1)*$limit;
        }
        if(isset($cari)){
           $n_sql=mysql_query("select * from jadwal join pelajaran on (jadwal.kode_mapel=pelajaran.kode_mapel) join guru on (pelajaran.kode_guru=guru.kode_guru) where jadwal.hari like '%$cari%' or pelajaran.mapel like '%$cari%' or jadwal.kode_mapel like '%$cari%' or guru.nama_guru like '%$cari%' limit $posisi,$limit");
        }else{
            $n_sql=mysql_query("select * from jadwal join pelajaran on (jadwal.kode_mapel=pelajaran.kode_mapel) join guru on (pelajaran.kode_guru=guru.kode_guru) limit $posisi,$limit");
        }
        while ($nr=mysql_fetch_array($n_sql))
            $n_data[]=$nr;
        return $n_data;
    }
    
    function tampil_nilai(){
        $limit = 10;
        if(!isset($_GET['halaman'])){
            $halaman = 1;
            $posisi = 0;
        }else{
            $halaman = $_GET['halaman'];
            $posisi = ($halaman-1)*$limit;
        }
        $n_sql=mysql_query("select * from nilai order by nisn asc limit $posisi,$limit");
        while ($nr=mysql_fetch_array($n_sql))
            $n_data[]=$nr;
        return $n_data;
    }
    
    function tampil_nilai2($cari){
        $limit = 30;
        if(!isset($_GET['halaman'])){
            $halaman = 1;
            $posisi = 0;
        }else{
            $halaman = $_GET['halaman'];
            $posisi = ($halaman-1)*$limit;
        }
        if(isset($cari)){
            $n_sql=mysql_query("select * from nilai join siswa on (nilai.nisn=siswa.nisn) join pelajaran on (nilai.kode_mapel=pelajaran.kode_mapel) join guru on (pelajaran.kode_guru=guru.kode_guru) where siswa.nama like '%$cari%' or nilai.nilai like '%$cari%' or pelajaran.mapel like '%$cari%' or nilai.nisn like '%$cari%' limit $posisi,$limit");
        }else{
            $n_sql=mysql_query("select * from nilai join siswa on (nilai.nisn=siswa.nisn) join pelajaran on (nilai.kode_mapel=pelajaran.kode_mapel) join guru on (pelajaran.kode_guru=guru.kode_guru) limit $posisi,$limit");
        }
        while ($nr=mysql_fetch_array($n_sql))
            $n_data[]=$nr;
        return $n_data;
    }
    
    function tampil_nilai3($nisn){
        $n_sql = mysql_query("select * from nilai join pelajaran on (nilai.kode_mapel=pelajaran.kode_mapel) where nilai.nisn='$nisn'");
        while ($r= mysql_fetch_array($n_sql))
            $n_data[]=$r;
        return $n_data;
    }
    
    function tampil_pelajaran(){
        $limit = 10;
        if(!isset($_GET['halaman'])){
            $halaman = 1;
            $posisi = 0;
        }else{
            $halaman = $_GET['halaman'];
            $posisi = ($halaman-1)*$limit;
        }
        $n_sql=mysql_query("select * from pelajaran order by kode_guru asc limit $posisi,$limit");
        while ($nr=mysql_fetch_array($n_sql))
            $n_data[]=$nr;
        return $n_data;
    }
    
    function tampil_pelajaran2($cari){
        $limit = 30;
        if(!isset($_GET['halaman'])){
            $halaman = 1;
            $posisi = 0;
        }else{
            $halaman = $_GET['halaman'];
            $posisi = ($halaman-1)*$limit;
        }
        if(isset($cari)){
            $n_sql=mysql_query("select * from pelajaran join guru on (pelajaran.kode_guru=guru.kode_guru) where guru.nama_guru like '%$cari%' or pelajaran.kode_mapel like '%$cari%' or pelajaran.mapel like '%$cari%' or guru.kode_guru like '%$cari%' limit $posisi,$limit");
        }else{
            $n_sql=mysql_query("select * from pelajaran join guru on (pelajaran.kode_guru=guru.kode_guru) limit $posisi,$limit");    
        }
        while ($nr=mysql_fetch_array($n_sql))
            $n_data[]=$nr;
        return $n_data;
    }
	
	function tampil_detail($nisndetail,$cari){
        if(isset($cari)){
            if($cari==""){
                $n_sql=mysql_query("select * from siswa join nilai on (siswa.nisn=nilai.nisn) join pelajaran on (pelajaran.kode_mapel=nilai.kode_mapel) join guru on (guru.kode_guru=pelajaran.kode_guru) where siswa.nisn='$nisndetail'");
            }else{
                $n_sql=mysql_query("select * from siswa join nilai on (siswa.nisn=nilai.nisn) join pelajaran on (pelajaran.kode_mapel=nilai.kode_mapel) join guru on (guru.kode_guru=pelajaran.kode_guru) where siswa.nisn='$nisndetail' and  nilai.semester like '%$cari%'");
            }
        }else{
	$n_sql=mysql_query("select * from siswa join nilai on  (siswa.nisn=nilai.nisn) join pelajaran on (pelajaran.kode_mapel=nilai.kode_mapel) join guru on (guru.kode_guru=pelajaran.kode_guru) where siswa.nisn='$nisndetail'");
        }
        while ($nr=mysql_fetch_array($n_sql))
            $n_data[]=$nr;
        return $n_data;
	}
    
    function tampil_detailguru($kodedetail,$cari){
        if(isset($cari)){
            if($cari==""){
                $n_sql=mysql_query("select * from guru join pelajaran on (guru.kode_guru=pelajaran.kode_guru) join jadwal on (jadwal.kode_mapel=pelajaran.kode_mapel) where pelajaran.kode_guru='$kodedetail'");
            }
            else{
            $n_sql=mysql_query("select * from guru join pelajaran on (guru.kode_guru=pelajaran.kode_guru) join jadwal on (jadwal.kode_mapel=pelajaran.kode_mapel) where pelajaran.kode_guru='$kodedetail' and pelajaran.mapel like '%$cari%' or jadwal.hari like '%$cari%' or jadwal.ruang  like '%$cari%' or jadwal.kelas like '%$cari%' or pelajaran.kode_mapel like '%$cari%'");
            }
        }else{
            $n_sql=mysql_query("select * from guru join pelajaran on (guru.kode_guru=pelajaran.kode_guru) join jadwal on (jadwal.kode_mapel=pelajaran.kode_mapel) where pelajaran.kode_guru='$kodedetail'");
        }
        while ($nr=mysql_fetch_array($n_sql))
            $n_data[]=$nr;
        return $n_data;
	}
    
    function ambil_nip(){
        $n_sql = mysql_query("select * from guru");
        while ($nr=mysql_fetch_assoc($n_sql))
            $n_data[]=$nr;
        return $n_data;
    }
    
    function ambil_mapel(){
        $n_sql = mysql_query("select * from pelajaran");
        while ($nr=mysql_fetch_assoc($n_sql))
            $n_data[]=$nr;
        return $n_data;
    }
    
    function ambil_guru(){
        $n_sql = mysql_query("select * from guru");
        while ($nr=mysql_fetch_assoc($n_sql))
            $n_data[]=$nr;
        return $n_data;
    }
    
    function ambil_siswa(){
        $n_sql = mysql_query("select * from siswa");
        while ($nr=mysql_fetch_assoc($n_sql))
            $n_data[]=$nr;
        return $n_data;
    }
    
    function jumlah_guru(){
        $n_sql = mysql_query("select * from guru");
        $jml_guru = mysql_num_rows($n_sql);
        echo $jml_guru;
    }
    
    function jumlah_siswa(){
        $n_sql = mysql_query("select * from siswa");
        $jml_siswa = mysql_num_rows($n_sql);
        echo $jml_siswa;
    }
    
    function jumlah_jadwal(){
        $n_sql = mysql_query("select * from jadwal");
        $jml_jadwal = mysql_num_rows($n_sql);
        echo $jml_jadwal;
    }
    
    function jumlah_nilai(){
        $n_sql = mysql_query("select * from nilai");
        $jml_nilai = mysql_num_rows($n_sql);
        echo $jml_nilai;
    }
    
    function jumlah_mapel(){
        $n_sql = mysql_query("select * from pelajaran");
        $jml_mapel = mysql_num_rows($n_sql);
        echo $jml_mapel;
    }
    
    function kosong($nisn){
        $sql = mysql_query("select * from nilai where nisn='$nisn'");
                        $jml_nilai = mysql_num_rows($sql);
                        if($jml_nilai==17){
                            echo"Lengkap";
                        }else if($jml_nilai>0){
                            echo"Tidak Lengkap";
                        }else if($jml_nilai==0){
                            echo"Kosong";
                        }
    }
    
    function info_nilai($nisn){
        $n_sql = mysql_query("select * from nilai where nisn='$nisn'");
        $jmln = mysql_num_rows($n_sql);
        echo $jmln;
    }
    
    function info_seharusnya($nisn){
        $n_sql = mysql_query("select * from nilai where nisn='$nisn'");
        $semester = mysql_fetch_array($n_sql);
        
        if($semester['semester']=="V" or $semester['semester']=="VI" ){
            echo "17";
        }else if($semester['semester']=="IV" or $semester['semester']=="III"){
            echo "15";
        }else if($semester['semester']=="I" or $semester['semester']=="II"){
            echo "13";
        }
    }
    
    function info_kurang($nisn){
         $n_sql = mysql_query("select * from nilai where nisn='$nisn'");
        $semester = mysql_fetch_array($n_sql);
        $jml = mysql_num_rows($n_sql);
        if($semester['semester']=="V" or $semester['semester']=="VI" ){
            $var=17;
            echo $var - $jml;
        }else if($semester['semester']=="IV" or $semester['semester']=="III"){
            $var=15;
            echo $var - $jml;
        }else if($semester['semester']=="I" or $semester['semester']=="II"){
            $var=13;
            echo $var - $jml;
        }
    }
    
    function localrank($nisn){
        $n_sql = mysql_query("select sum(nilai) as secnilai where nisn='$nisn'");
        //Rank Fail
        
    }
    
    function total($nisndetail){
        $n_sql = mysql_query("select sum(nilai) as baru from nilai where nisn='$nisndetail'");
        $fetch = mysql_fetch_array($n_sql);
        echo $fetch['baru'];
    }
    
    function rata($nisndetail){
        $n_sql = mysql_query("select sum(nilai) as baru from nilai where nisn='$nisndetail'");
        $fetch = mysql_fetch_array($n_sql);
        $rata = round($fetch['baru']/17);
        echo $rata;
    }
//----------------------------------------------------------------
    
    
    
//----------------------- HAPUS ----------------------------------
    function hapus_guru($n_id_guru){
        $n_sql= mysql_query("delete from guru where idguru='$n_id_guru'");
        header("location:index.php");
    }
    
    function hapus_siswa($n_id_siswa){
        $n_sql= mysql_query("delete from siswa where idsiswa='$n_id_siswa'");
        header("location:index.php");
    }
    
    function hapus_jadwal($n_id_jadwal){
        $n_sql= mysql_query("delete from jadwal where id_jadwal='$n_id_jadwal'");
        header("location:index.php");
    }
    
    function hapus_nilai($n_id_nilai){
        $n_sql= mysql_query("delete from nilai where id_nilai='$n_id_nilai'");
        header("location:index.php");
    }
    
    function hapus_pelajaran($n_id_pelajaran){
        $n_sql= mysql_query("delete from pelajaran where idmapel='$n_id_pelajaran'");
        header("location:index.php");
    }
    
    function hapus_detail($del,$nisn){
        $n_sql= mysql_query("delete from nilai where id_nilai='$del'");
        header("location:report.php?nisn=$nisn");
    }
    
    function hapus_detailguru($del,$kode){
        $n_sql= mysql_query("delete from jadwal where id_jadwal='$del'");
        header("location:report-guru.php?kode_guru=$kode");
    }
    
    function hapus_alldetail($del_nisn){
        $n_sql = mysql_query("delete from nilai where nisn='$del_nisn'");
        header("location:index.php");
    }
    
    function hapus_alldetail_guru($del_nip){
        $n_sql = mysql_query("delete from jadwal where nip='$del_nip'");
        header("location:index.php");
    }
    
    function hapussemuanilai($n_ok){
        $n_sql = mysql_query("delete from nilai where hapus='$n_ok'");
        header("location:index.php");
    }
    
    function hapussemuaguru($n_ok){
        $n_sql = mysql_query("delete from guru where hapusguru='$n_ok'");
        header("location:index.php");
    }
    
    function hapussemuasiswa($n_ok){
        $n_sql = mysql_query("delete from guru where hapussiswa='$n_ok'");
        header("location:index.php");
    }
    
    function hapussemuajadwal($n_ok){
        $n_sql = mysql_query("delete from guru where hapusjadwal='$n_ok'");
        header("location:index.php");
    }
    
    function hapussemuamapel($n_ok){
        $n_sql = mysql_query("delete from guru where hapusmapel='$n_ok'");
        header("location:index.php");
    }
//----------------------------------------------------------------
    
    
//------------------------- BACA ---------------------------------    
    function baca_guru($n_isi, $n_id_guru){
        $n_sql  = mysql_query("select * from guru where idguru='$n_id_guru'");
        $n_data=mysql_fetch_array($n_sql);
        if($n_isi == "nip")
            return $n_data['nip'];
        else if($n_isi == "kode_guru")
            return $n_data['kode_guru'];
        else if($n_isi == "nama_guru")
            return $n_data['nama_guru'];
        else if($n_isi == "gol")
            return $n_data['gol'];
        else if($n_isi == "status")
            return $n_data['status'];
        else if($n_isi == "agama_guru")
            return $n_data['agama_guru'];
        elseif($n_isi == "tgllahir_guru")
             return $n_data['tgllahir_guru'];
        else if($n_isi == "no_hp")
            return $n_data['no_hp'];
        else if($n_isi == "alamat")
            return $n_data['alamat'];
    }
    
    function baca_guru2($n_isi){
        $n_sql = mysql_query("select * from guru order by nip desc");
        $n_data = mysql_fetch_array($n_sql);
        if($n_isi == "nip")
            return $n_data['nip'];
    }
    
    function baca_siswa($n_isi, $n_id_siswa){
        $n_sql  = mysql_query("select * from siswa where idsiswa='$n_id_siswa'");
        $n_data=mysql_fetch_array($n_sql);
        if($n_isi == "nisn")
            return $n_data['nisn'];
        else if($n_isi == "nama")
            return $n_data['nama'];
        else if($n_isi == "jurusan")
            return $n_data['jurusan'];
        else if($n_isi == "jenkel")
            return $n_data['jenkel'];
        else if($n_isi == "tgllahir")
            return $n_data['tgllahir'];
        else if($n_isi == "agama")
            return $n_data['agama'];
        else if($n_isi == "no_hp")
            return $n_data['no_hp'];
        else if($n_isi == "nama_ayah")
            return $n_data['nama_ayah'];
        else if($n_isi == "pekerjaan_ayah")
            return $n_data['pekerjaan_ayah'];
        else if($n_isi == "ho_hp_ayah")
            return $n_data['ho_hp_ayah'];
        else if($n_isi == "nama_ibu")
            return $n_data['nama_ibu'];
        else if($n_isi == "pekerjaan_ibu")
            return $n_data['pekerjaan_ibu'];
        else if($n_isi == "alamat")
            return $n_data['alamat'];
    }
    
    function baca_siswa2($n_isi){
        $n_sql = mysql_query("select * from siswa order by nisn desc");
        $n_data = mysql_fetch_array($n_sql);
        if($n_isi == "nisn")
            return $n_data['nisn'];
    }
    
    function baca_jadwal($n_isi, $n_id_jadwal){
        $n_sql  = mysql_query("select * from jadwal where id_jadwal='$n_id_jadwal'");
        $n_data=mysql_fetch_array($n_sql);
        if($n_isi == "kode_guru")
            return $n_data['kode_guru'];
        else if($n_isi == "hari")
            return $n_data['hari'];
        else if($n_isi == "jam")
            return $n_data['jam'];
        else if($n_isi == "kode_mapel")
            return $n_data['kode_mapel'];
        else if($n_isi == "ruang")
            return $n_data['ruang'];
    }
    
    function baca_nilai($n_isi, $n_id_nilai){
        $n_sql  = mysql_query("select * from nilai where id_nilai='$n_id_nilai'");
        $n_data=mysql_fetch_array($n_sql);
        if($n_isi == "nisn")
            return $n_data['nisn'];
        else if($n_isi == "kode_mapel")
            return $n_data['kode_mapel'];
        else if($n_isi == "nilai")
            return $n_data['nilai'];
        else if($n_isi == "semester")
            return $n_data['semester'];
        else if($n_isi == "kelas")
            return $n_data['kelas'];
    }
    
    function baca_nilai2($n_isi, $n_nisn){
        $n_sql  = mysql_query("select * from siswa  where siswa.nisn='$n_nisn'");
        $n_data=mysql_fetch_array($n_sql);
        if($n_isi == "nisn")
            return $n_data['nisn'];
        if($n_isi == "kelas")
            return $n_data['kelas'];
        if($n_isi == "semester")
            return $n_data['semester'];
        if($n_isi == "nama")
            return $n_data['nama'];
    }
    
    function baca_mapel($n_isi, $n_id_mapel){
        $n_sql  = mysql_query("select * from pelajaran where idmapel='$n_id_mapel'");
        $n_data=mysql_fetch_array($n_sql);
        if($n_isi == "kode_guru")
            return $n_data['kode_guru'];
        else if($n_isi == "kode_mapel")
            return $n_data['kode_mapel'];
        else if($n_isi == "mapel")
            return $n_data['mapel'];
    }
    
    function baca_detail($n_isi, $nisndetail){
        $n_sql  = $n_sql=mysql_query("select * from siswa join nilai on  (siswa.nisn=nilai.nisn) join pelajaran on (pelajaran.kode_mapel=nilai.kode_mapel) join guru on (guru.kode_guru=pelajaran.kode_guru)  where siswa.nisn='$nisndetail'");
        $n_data=mysql_fetch_array($n_sql);
        if($n_isi == "nisn")
            return $n_data['nisn'];
        else if($n_isi == "nama")
            return $n_data['nama'];
        else if($n_isi == "jurusan")
            return $n_data['jurusan'];
        else if($n_isi == "jenkel")
            return $n_data['jenkel'];
        else if($n_isi == "tgllahir")
            return $n_data['tgllahir'];
        else if($n_isi == "agama")
            return $n_data['agama'];
        else if($n_isi == "no_hp")
            return $n_data['no_hp'];
        else if($n_isi == "nama_ayah")
            return $n_data['nama_ayah'];
        else if($n_isi == "pekerjaan_ayah")
            return $n_data['pekerjaan_ayah'];
        else if($n_isi == "ho_hp_ayah")
            return $n_data['ho_hp_ayah'];
        else if($n_isi == "nama_ibu")
            return $n_data['nama_ibu'];
        else if($n_isi == "pekerjaan_ibu")
            return $n_data['pekerjaan_ibu'];
        else if($n_isi == "jurusan")
            return $n_data['jurusan'];
        else if($n_isi == "alamat")
            return $n_data['alamat'];
        else if($n_isi == "foto")
            return $n_data['foto'];
    }
    
    function baca_detailguru($n_isi, $kodedetail){
        $n_sql  = $n_sql=mysql_query("select * from guru join pelajaran on (guru.kode_guru=pelajaran.kode_guru) join jadwal on (jadwal.kode_mapel=pelajaran.kode_mapel) where guru.kode_guru='$kodedetail'");
        $n_data=mysql_fetch_array($n_sql);
        if($n_isi == "nip")
            return $n_data['nip'];
        else if($n_isi == "kode_guru")
            return $n_data['kode_guru'];
        else if($n_isi == "nama_guru")
            return $n_data['nama_guru'];
        else if($n_isi == "gol")
            return $n_data['gol'];
        else if($n_isi == "status")
            return $n_data['status'];
        else if($n_isi == "agama_guru")
            return $n_data['agama_guru'];
        else if($n_isi == "tgllahir_guru")
            return $n_data['tgllahir_guru'];
        else if($n_isi == "no_hp")
            return $n_data['no_hp'];
        else if($n_isi == "alamat_guru")
            return $n_data['alamat_guru'];
        else if($n_isi == "foto_guru")
            return $n_data['foto_guru'];
        else if($n_isi == "ho_hp_ayah")
            return $n_data['ho_hp_ayah'];
        else if($n_isi == "hari")
            return $n_data['hari'];
        else if($n_isi == "jam")
            return $n_data['jam'];
        else if($n_isi == "kode_mapel")
            return $n_data['kode_mapel'];
        else if($n_isi == "ruang")
            return $n_data['ruang'];
        else if($n_isi == "mapel")
            return $n_data['mapel'];
        else if($n_isi == "id_mapel")
            return $n_data['id_mapel'];
        else if($n_isi == "alamat")
            return $n_data['alamat'];
        else if($n_isi == "kelas")
            return $n_data['kelas'];
        else if($n_isi == "id_jadwal")
            return $n_data['id_jadwal'];
    }
//----------------------------------------------------------------
    
    
    
//------------------------ UPDATE --------------------------------    
    function edit_guru($n_idguru,$n_nip,$n_kode_guru,$n_nama_guru,$n_gol,$n_status,$n_agama,$n_tgllahir,$n_no_hp,$n_alamat){
        $n_sql = mysql_query("update guru set nip='$n_nip', kode_guru='$n_kode_guru', nama_guru='$n_nama_guru', gol='$n_gol', status='$n_status', agama_guru='$n_agama', tgllahir_guru='$n_tgllahir', no_hp='$n_no_hp', alamat='$n_alamat' where idguru='$n_idguru'");
        header("location:index.php");
    }
    
    function edit_jadwal($n_id_jadwal,$n_nip,$n_hari,$n_jam,$n_kode_mapel,$n_ruang){
        $n_sql = mysql_query("update jadwal set nip='$n_nip', hari='$n_hari', jam='$n_jam', kode_mapel='$n_kode_mapel', ruang='$n_ruang' where id_jadwal='$n_id_jadwal'");
        header("location:index.php");
    }
    
    function edit_nilai($n_id_nilai,$n_nisn,$n_kode_mapel,$n_nilai,$n_semester,$n_kelas){
        $n_sql  = mysql_query("update nilai set nisn='$n_nisn', kode_mapel='$n_kode_mapel', nilai='$n_nilai', semester='$n_semester', kelas='$n_kelas' where id_nilai='$n_id_nilai'");
        header("location:index.php");
    }
    
    function edit_pelajaran($n_id_mapel,$n_kode_guru,$n_kode_mapel,$n_mapel){
        $n_sql  = mysql_query("update pelajaran set kode_guru='$n_kode_guru', kode_mapel='$n_kode_mapel', mapel='$n_mapel' where idmapel='$n_id_mapel'");
        header("location:index.php");
    }
    
    function edit_siswa($n_id_siswa,$n_nisn,$n_nama,$n_jurusan,$n_jenkel,$n_tgllahir,$n_agama,$n_no_hp,$n_nama_ayah,$n_pekerjaan_ayah,$n_no_hp_ayah,$n_nama_ibu,$n_pekerjaan_ibu,$n_alamat){
        $n_sql  = mysql_query("update siswa set nisn='$n_nisn', nama='$n_nama', jurusan='$n_jurusan', jenkel='$n_jenkel', tgllahir='$n_tgllahir', agama='$n_agama', no_hp='$n_no_hp', nama_ayah='$n_nama_ayah', pekerjaan_ayah='$n_pekerjaan_ayah', ho_hp_ayah='$n_no_hp_ayah', nama_ibu='$n_nama_ibu', pekerjaan_ibu='$n_pekerjaan_ibu', alamat='$n_alamat' where idsiswa='$n_id_siswa'");
        header("location:index.php");
    }
//----------------------------------------------------------------    


//------------------------- Cari ---------------------------------
    function cari($cari){
        $n_sql = mysql_query("select * from siswa join nilai on (siswa.nisn=nilai.nisn) join pelajaran on (pelajaran.kode_mapel=nilai.kode_mapel) join guru on (pelajaran.kode_guru=guru.kode_guru) where siswa.nama like '%$cari%' or siswa.nisn like '%$cari%' or siswa.jurusan like '%$cari%'");
		while ($nr=mysql_fetch_array($n_sql))
            $n_data[]=$nr;
        return $n_data;
    }
    
    function jml_cari($cari){
        $n_sql = mysql_query("select * from siswa join nilai on (siswa.nisn=nilai.nisn) join pelajaran on (pelajaran.kode_mapel=nilai.kode_mapel) join guru on (pelajaran.kode_guru=guru.kode_guru) where siswa.nama like '%$cari%' or siswa.nisn like '%$cari%' or siswa.jurusan like '%$cari%'");
        $jml_cari = mysql_num_rows($n_sql);
            echo $jml_cari;
    }    
}
//------------------  Copyright (c) Nico Lahara 2016 -------------
?>