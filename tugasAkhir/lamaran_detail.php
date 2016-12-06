<?php 
	//setname dan post_id
	session_start(); // Starting Session
	$uname = $_SESSION['userlogin'];
	$status = $_SESSION['status'];
	$npm_mhs = $_SESSION['id'];
	
	 ?>
	 

<style>
*{
    font-family: arial, sans-serif;
}
table {
    border-collapse: collapse;
    width: 60%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #FFF;
}
.button {
    font-family: arial, sans-serif;
	font-size:16px;
  color:#08233e;
  background-color:rgba(255,204,0,1);
  border:0px;
  -moz-border-radius:10px;
  -webkit-border-radius:10px;
  -moz-box-shadow:inset 0 1px 0 rgba(255,255,255,0.5);
  -webkit-box-shadow:inset 0 1px 0 rgba(255,255,255,0.5);
  cursor:pointer;
  padding:10px;
  color:#FFF;
 }
 .button:hover {
  background-color:rgba(255,204,0,0.8);
 }
</style>

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<meta charset="UTF-8">
	<meta name="description" content="Detail Pelamar">


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      <?php
	  if($status == "mahasiswa") {
      echo "<li><a href=\"#\">Melihat Lowongan</a></li>
			<li><a href=\"#\">Membuat Lamaran</a></li>
			<li><a href=\"ubah_profil.php\">Mengubah Profil</a></li>
			<li  class=\"active\"><a href=\"log_mhs.php\">Mengisi Log</a></li>
			<li><a href=\"logout.php\">Logout</a></li>
			";
							
		}
	  elseif($status=="dosen"){
		echo "<li><a href=\"#\">Membuka Lowongan</a></li>
			<li><a href=\"#\">Melihat Lowongan</a></li>
			<li><a href=\"#\">Melihat Daftar Pelamar</a></li>
			<li><a href=\"#\">Melihat Detail Pelamar</a></li>
			<li><a href=\"log_dosen.php\">Menyetujui Log</a></li>
			<li><a href=\"#\">Logout</a></li>
			
			";  
	  }
	  elseif($status=="admin"){
		echo "<li><a href=\"#\">Membuka Lowongan</a></li>
			<li><a href=\"#\">Melihat Lowongan</a></li>
			<li><a href=\"#\">Melihat Daftar Pelamar</a></li>
			<li><a href=\"#\">Melihat Detail Pelamar</a></li>
			<li><a href=\"log_dosen.php\">Menyetujui Log</a></li>
			<li><a href=\"#\">Logout</a></li>
			
			";    
	  }
?>
	  
    </ul>
  </div>
</nav>

 

<table cellspacing="0" cellpadding="0">
  <?php
	
	$dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=basdat") or die('connection failed');
	$npm =	"1306481235";
	$result = pg_query($dbconn, "select m.nama, m.email, m.npm, nomortelepon, m.waktu_kosong, m.bank, m.norekening, m.nama
	from mahasiswa m, lamaran l, telepon_mahasiswa tm
	where m.npm = '$npm' and l.npm = '$npm' and tm.npm = '$npm';");

	if (!$result) {
	  echo "An error occurred.\n";
	  exit;
	}
	
	$rows = pg_numrows($result);
	if ($rows >= 1) {
	while ($row = pg_fetch_row($result)) {
		$tnm = "Nama";
		$temail = "Email";
		$tnpm = "NPM";
		$tphone = "Telepon";
		$twk = "Waktu Kosong";
		$trek = "Detail Rekening";
		$tnorek = "Nomor Rekening";
		$tpemilik = "Nama Pemegang";
		
		$nama = $row[0];
		$email = $row[1];
		$npm = $row[2];
		$telepon = $row[3];
		$waktuKosong = $row[4];
		$norek = $row[5]." - ".$row[6]." a/n ".$row[7];
		
		
		echo 	"
				<h3><b>Detail Pelamar </b></h3>
				<tr><td><b>".$tnm."</b></td><td>".$nama."</td></tr>"."
				<tr><td><b>".$temail."</b></td><td>".$email."</td></tr>"."
				<tr><td><b>".$tnpm."</b></td><td>".$npm."</td></tr>"."
				<tr><td><b>".$tphone."</b></td><td>".$telepon."</td></tr>"."
				<tr><td><b>".$twk."</b></td><td>".$waktuKosong."</td></tr>"."
				<tr><td><b>".$trek."</b></td><td>".$norek."</td></tr>";
	}
	}
	?>
</table>
<br/>

<table cellspacing="0" cellpadding="0">
	<?php
	$npm =	"1306481235";
	$dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=basdat") or die('connection failed');
	
	$result2 = pg_query($dbconn, "select mk.nama, mkm.nilai, mk.prasyarat_dari
	from mata_kuliah mk, mhs_mengambil_kelas_mk mkm, kelas_mk km
	where mk.kode = km.kode_mk and mkm.idkelasmk = km.idkelasmk and mkm.npm = '$npm';");

	if (!$result2) {
	  echo "An error occurred.\n";
	  exit;
	}
	echo "<h3><b>Riwayat Akademis</b></h3>";
	$rows = pg_numrows($result2);
	if ($rows >= 1) {
	while ($row = pg_fetch_row($result2)) {
		
		$nama_mk = $row[0];
		$nilai_mk = $row[1];
		$prasyarat = $row[2];
		
		$riwayat = "Riwayat Akademis";
		$empty = " ";
		$tprasyarat1 = "Prasyarat 1: ";
		$tprasyarat2 = "Prasyarat 2: ";
		$tprasyarat3 = "Prasyarat 3: ";
		
		$syarat = $tprasyarat1." ".$row[2]; 
		
		$lapanlima = 85;
		$tujupuluh = 70;
		$limalima = 55;
		$empatpuluh = 40;
		
		
		if($nilai_mk >= $lapanlima){
		 $nilai = "A";
		}elseif($nilai_mk >= $tujupuluh && $nilai_mk <= $lapanlima){
	     $nilai = "B";
		} elseif($nilai_mk >= $limalima && $nilai_mk <= $tujupuluh){
         $nilai = "C";
		} elseif($nilai_mk >= $empatpuluh && $nilai_mk <= $limalima){
         $nilai = "D";
		} else $nilai = "E";
		
		echo "	
				<tr><td>".$nama_mk."</td><td>".$nilai."</td></tr>"."
				<tr><td>".$syarat."</td><td>".$empty."</td></tr>"."
				<tr><td>".$tprasyarat2."</td><td>".$empty."</td></tr>"."
				<tr><td>".$tprasyarat3."</td><td>".$empty."</td></tr>";
	}
	}
	?>
<br/>
</table>

<p>
	Silahkan klik tombol Rekomendasikan jika ingin memilih Andi Sartono sebagai Asisten, Administrator akan menerima lamaran mahasiswa tersebut jika mahasiswa tersebut jika beban jam kerja yang dimiliki oleh mahasiswa tersebut masih memadai 
</p>
<form action="proses_rekom.php" method="post">
		<input type="submit" class="button" value="Rekomendasikan" style="background-color:#0099FF; "/>
</form>
