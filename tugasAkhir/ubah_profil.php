<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<meta charset="UTF-8">
	<meta name="description" content="PROFIL">

<title>Profil</title>
</head>
<body>

<div class="jumbotron text-center">
  <h1><b>Profil</b></h1>

</div>
<div class="container">

		
  <div class="row">
  <div class="col-md-12" >
    <div class="table-responsive">
     <h2>Data Profil</h2>
	 
	 
	<button type="button" class="btn btn-success">Simpan</button>
	<button type="button" class="btn btn-success">Batal</button>
	<table class="table">
	<colgroup>
	<colgroup>
    <col span="1" style="width: 60%;"  >
      
	</colgroup>
	
	<?php
	
	$conn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=basdat") or die('connection failed');
			
			$npm = "1306481235";	
			$result1 = pg_query($conn, "select m.npm, nama, username, password, email, email_aktif, waktu_kosong, nomortelepon, bank, norekening, url_mukatab, url_foto
									from mahasiswa
									m, telepon_mahasiswa tm
									where m.npm = '$npm' and tm.npm = '$npm';");
								
								if (!$result1) {
									echo "An error occurred.\n";
								exit;
								}
	
			$rows = pg_numrows($result1);
				if ($rows >= 1) {
					while ($row = pg_fetch_row($result1)) {
						$tnpm = "NPM";
						$tnama = "Nama";
						$tpassword = "Password";
						$tusername = "Username";
						$temail = "Email";
						$temail_aktif = "Email Aktif";
						$twaktu_kosong = "Waktu kosong";
						$tnomortelepon = "Nomor Telepon";
						$tbank = "Bank";
						$tnorekening = "Nomor Rekening";
						$turl_mukatab = "Halaman muka buku tabungan(*.jpg)";
						$turl_foto = "Foto (*.jpg)";
	
						$npm = $row[0];
						$nama = $row[1];
						$username = $row[2];
						$password = $row[3];
						$email = $row[4];
						$email_aktif = $row[5];
						$waktu_kosong = $row[6];
						$nomortelepon = $row[7];
						$bank = $row[8];
						$norekening = $row[9];
						$url_mukatab = $row[10];
						$url_foto = $row[11];
					}
				}
	?>
	
	<?php
	$tmperror="";
	if(isset($_POST["kategori"])){
			$npm = $_POST["npm"];
			$nama = $_POST["nama"];
			$username = $_POST["username"];
			$password = $_POST["password"];
			$email = $_POST["email"];
			$email_aktif = $_POST["email_aktif"];
			$waktu_kosong = $_POST["waktu_kosong"];
			$no_telepon = $_POST["no_telepon"];
			$bank = $_POST["bank"];
			$no_rekening = $_POST["no_rekening"];
			
			$conn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=basdat") or die('connection failed');
			
			$query="UPDATE mahasiswa //ini
					SET (password, email_aktif, waktu_kosong, nomortelepon, bank, norekening) = 
					('$password','$email_aktif','$email_aktif','$waktu_kosong','$nmortelepon','$bank','$norekening',')
						WHERE npm = '$npm';";
									
								if (!$query) {
									echo "An error occurred.\n";
								exit;
								}
								
								$result=pg_query($conn,$query);
								$row_count= pg_num_rows($result);
								pg_free_result($result);
								pg_close($dbconn);
		}
	
	?>
	<tr>
		<th>NPM</th>
		<td><input type="npm" class="form-control" id="npm" name='NPM' value='<?php echo $npm; ?>' readonly></td>
	</tr>
	<tr>
		<th>Nama</th>
		<td><input type="nama" class="form-control" id="name" name='Nama' value='<?php echo $nama; ?>' readonly></td>
	</tr>
	<tr>
		<th>Username</th>
		<td><input type="username" class="form-control" id="username" name='Username' value='<?php echo $username; ?>' readonly></td>
	</tr>
	<tr>
		<th>Password</th>
		<td><input type="password" class="form-control" id="password"></td>
	</tr>
	<tr>
		<th>Email</th>
		<td><input type="email" class="form-control" id="email" name='Email' value='<?php echo $email; ?>' readonly></td>
	</tr>
	<tr>
		<th>Email Aktif</th>
		<td><input type="email-aktif" class="form-control" id="email_aktif"></td>
	</tr>
	<tr>
		<th>Waktu Kosong</th>
		<td><input type="waktu-kosong" class="form-control" id="waktu_kosong"></td>
	</tr>
	<tr>
		<th>No. Telp.</th>
		<td><input type="no-telp" class="form-control" id="no_telepon"></td>
	</tr>
	<tr>
		<th>Bank</th>
		<td><input type="bank" class="form-control" id="bk"></td>
	</tr>
	<tr>
		<th>No. Rekening</th>
		<td><input type="no-rekening" class="form-control" id="norek"></td>
	</tr>
	
	<?php
		$target_dir = "uploads/";
		$target_file = $target_dir;
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}	
		}
	?>
	
	<tr>
		<th>Halaman muka buku tabungan (*.jpg)</th>
		<td><input type="no-rekening" class="form-control" id="norek" name='Halaman muka buku tabungan (*.jpg)' value='<?php echo $url_mukatab; ?>'></td>
		<td><input type="file" name="datafile" size="40"></td>
	</tr>
	<tr>
		<th>Foto (*.jpg)</th>                  
		<td><input type="no-rekening" class="form-control" id="norek" name='Foto (*.jpg)' value='<?php echo $url_mukatab; ?>'></td> 
		<td><input type="file" name="datafile" size="40"></td>
	</tr>
	
	
	
	
	</table>
    </div>
	</div>
  </div>
</div>

</body>
</html>