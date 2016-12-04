<?php 
session_start(); // Starting Session

$id= $_GET['id'];
$nama= $_GET['nama'];
$matkul = $_GET['matkul'];
$npm = $_GET['npm'];

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/lihat-log.css">
	<script src="javascript/jquery.min.js"></script>
	<script src="javascript/bootstrap.js"></script>
	<script type="text/javascript">
	
		function fetch_select(val,id,nama,npm)
		{
		 $.ajax({
		 type: 'post',
		 url: 'log_data_dosen.php',
		 data: {
		  get_option:val,
		  id:id,
		  nama:nama,
		  npm:npm
		 },
		 success: function (response) {
		  document.getElementById("log").innerHTML=response; 
		 }
		 });
		}

		</script>
	<meta charset="UTF-8">
	<meta name="description" content="LOG">

<title>LOG</title>
</head>
<body>

<div class="jumbotron text-center">
  <h1><b>Daftar Log</b></h1>

</div>
<div class="container">

		
  <div class="row">
  <div class="col-md-4">
	
    <div class="table-responsive">
    <table class="table table-bordered">
					  <tr>
						<th class="col-md-4 success" >Term</th>
						<td><select name="termOption" class="form-control" onchange=<?php echo "fetch_select(this.value,'$id','$nama','$npm')";?>>
						<option>Pilih Term</option>
						<?php
						$dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=basdat") or die('connection failed');
						$result = pg_query($dbconn, "select * FROM TERM;");
						while($term = pg_fetch_array($result)){
									if($term[1]==1)
									echo "<option>Ganjil, ".$term[0]."</option>";
									elseif($term[1]==2)
									echo "<option>Genap, ".$term[0]."</option>";
									else
									echo "<option>Pendek, ".$term[0]."</option>";
						}
						?>
						</select></td>
					  </tr>
					  <tr>
						<th class="col-md-4 success">Mata Kuliah</th>
						<td><?php echo $matkul;?></td>
					  </tr>
					  <tr>
						<th class="col-md-4 success">Nama</th>
						<td><?php echo $nama;?></td>
					  </tr>

      </table>
    </div>
	
	
	
	</div>
	<div class="col-md-12">
	
    <div class="table-responsive">
    <table class="table table-bordered">
					  <thead>
						  <tr>
							<th>NPM</th>
							<th>Nama</th>
							<th>Durasi</th>
							<th>Kategori</th>
							<th>Tanggal</th>
							<th>Jam Mulai</th>
							<th>Jam Selesai</th>
							<th>Deskripsi Kerja</th>
							<th>Status</th>
							<th></th>
						  </tr>
						</thead>
						<tbody id="log">
						 
						</tbody>
      </table>
	  
    </div>
	
	
	
	</div>
	
	</div>
  </div>
</div>



</body>
</html>