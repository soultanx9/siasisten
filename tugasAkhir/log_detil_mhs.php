<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/lihat-log.css">
	<script src="javascript/jquery.min.js"></script>
	<script src="javascript/bootstrap.js"></script>
	
	<meta charset="UTF-8">
	<meta name="description" content="LOG">

<title>LOG</title>
</head>
<body>

<div class="jumbotron text-center">
  <h1><b>Daftar Log</b></h1>
  <h1>Basis Data Lanjut</h1>

</div>
<div class="container">

		
  <div class="row">
  <div class="col-md-12">
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Tambah</button>
    <div class="table-responsive" style="margin-top:10px">
      <table class="table table-bordered">
    <thead>
      <tr>
        <th>Kategori</th>
        <th>Tanggal</th>
        <th>Jam Mulai</th>
		<th>Jam Selesai</th>
		<th>Deskripsi Kerja</th>
		<th>Status</th>
		<th></th>
      </tr>
    </thead>
    <tbody>
	<?php
	$dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=basdat") or die('connection failed');
	$result = pg_query($dbconn, "select k.kategori, to_char(l.tanggal,'dd-mm-yyyy') as tanggal, to_char(l.jam_mulai, 'HH24:MI') as jam_mulai,to_char(l.jam_selesai, 'HH24:MI') as jam_selesai, l.deskripsi_kerja, s.status
								 from log l, kategori_log k, status_log s
								 where l.id_kat_log = k.id and l.id_st_log = s.id;");
	
	if (!$result) {
	  echo "An error occurred.\n";
	  exit;
	}
	
	$rows = pg_numrows($result);
	
	if($rows >= 1){
									
									while($log = pg_fetch_array($result)){
									echo "<tr>".
										"<td>".$log[0]."</td>".
										"<td>".$log[1]."</td>".
										"<td>".$log[2]."</td>".
										"<td>".$log[3]."</td>".
										"<td>".$log[4]."</td>".
										(($log[5] == "dilaporkan")?"<td>-</td>":"<td>".$log[5]."</td>").
										(($log[5]!="disetujui")?"<td class=\"text-center\"><button class=\"btn btn-primary btn-xs\" data-title=\"Edit\" data-toggle=\"modal\" data-target=\"#edit\" >
										<span class=\"glyphicon glyphicon-pencil\"></span></button>
								
										<button class=\"btn btn-danger btn-xs\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#delete\" >
										<span class=\"glyphicon glyphicon-remove\"></span></button>	</td>"
										:"<td></td>")."</tr>";
										
										
									   
									}
								}
	
	?>
	
	
	
      <tr>
		<td>Mengoreksi</td>
        <td>12-09-2016</td>
        <td>09:00</td>
		<td>11:00</td>
		<td>Tugas 2</td>
		<td>-</td>
		<td class="text-center"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" >
		<span class="glyphicon glyphicon-pencil"></span></button>
		
        <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" >
		<span class="glyphicon glyphicon-remove"></span></button>
		</td>
      </tr>
      <tr class="success">
       <td>mengawas</td>
        <td>12-09-2016</td>
        <td>10:00</td>
		<td>11:00</td>
		<td>UTS</td>
		<td>Disetujui</td>
		<td></td>
      </tr>
	  <tr>
        <td>Mengoreksi</td>
        <td>10-09-2016</td>
        <td>10:00</td>
		<td>12:00</td>
		<td>Tugas 1</td>
		<td>Ditolak</td>
		<td></td>
      </tr>
    </tbody>
  </table>
    </div>
	
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                    </button>
                     <h4 class="modal-title" id="myModalLabel"> Buat Log</h4>

                </div>
                <div class="modal-body">
						
					  <div class="table-responsive">
					  <table class="table table-bordered">
					  <tr>
						<th class="col-md-4">Kategori</th>
						<td><select class="form-control">
						  <option>1</option>
						  <option>2</option>
						  <option>3</option>
						  <option>4</option>
						  <option>5</option>
						</select></td>
					  </tr>
					  <tr>
						<th>Tanggal</th>
						<td><input type="date" class="form-control" id="usr"></td>
					  </tr>
					  <tr>
						<th>Jam Mulai</th>
						<td><input type="time" class="form-control" id="usr"></td>
					  </tr>
					   <tr>
						<th>Jam Selesai</th>
						<td><input type="time" class="form-control" id="usr"></td>
					  </tr>
					   <tr>
						<th>Deskripsi Kerja</th>
						<td><textarea class="form-control" rows="3"></textarea></td>
					  </tr>
					  </table>
					</div>
				
				
				
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
	</div>
	</div>
	
	</div>
  </div>
</div>



</body>
</html>