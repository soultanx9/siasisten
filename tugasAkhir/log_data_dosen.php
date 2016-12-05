<?php

if(isset($_POST['get_option']))
{
$dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=basdat") or die('connection failed');
				

 $term = $_POST['get_option'];
 $term = substr($term,0,-6);
 $id = $_POST['id'];
 $nama = $_POST['nama'];
 $npm = $_POST['npm'];
 if($term=="Ganjil"){
	 $term=1;
 }elseif($term=="Genap"){
	 $term=2;
 }
 else{
	 $term=3;
 }

 $result = pg_query($dbconn, "select k.kategori, to_char(l.tanggal,'dd-mm-yyyy') as tanggal, to_char(l.jam_mulai, 'HH24:MI') as jam_mulai,to_char(l.jam_selesai, 'HH24:MI') as jam_selesai, l.deskripsi_kerja, s.status, EXTRACT(HOUR FROM (jam_selesai - jam_mulai)) as Durasi, l.id
								 from log l, kategori_log k, status_log s, lamaran la, lowongan lo, kelas_mk mk
								 where l.npm='$npm' and l.id_kat_log = k.id and l.id_st_log = s.id and l.idlamaran='$id' and l.idlamaran=la.idlamaran and la.idlowongan=lo.idlowongan and lo.idkelasmk=mk.idkelasmk and mk.semester='$term';");
	
	if (!$result) {
	  echo "An error occurred.\n";
	  exit;
	}
	
	$rows = pg_numrows($result);
	
	if($term=="Pilih Term"){
		exit;
	}
	
	if($rows >= 1){
	$nama = str_replace('_', ' ', $nama);

									
									while($log = pg_fetch_array($result)){
									echo "<tr>".
										"<td>".$npm."</td>".
										"<td>".$nama."</td>".
										"<td>".$log[6]."</td>".
										"<td>".$log[0]."</td>".
										"<td>".$log[1]."</td>".
										"<td>".$log[2]."</td>".
										"<td>".$log[3]."</td>".
										"<td>".$log[4]."</td>".
										"<td>".$log[5]."</td>".
										(($log[5]!="dilaporkan")?"<td id=".$log[7]."show"."><button id='$log[7]' class=\"btn btn-danger btn-xs btnstatus \" data-toggle=\"modal\" data-target=\"#delete\" value=5 >Batal</button></td>":"<td id=".$log[7]."show"."class=\"text-center\" id='$log[7]+\"hide\"'><button id=".$log[7]." class=\"btn btn-success btn-xs btnstatus\" data-toggle=\"modal\" data-target=\"#edit\" value=3>Setujui</button>
								
										<button class=\"btn btn-danger btn-xs btnstatus\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#delete\" button id='$log[7]' value=4>tolak</button>	</td>")."</tr>";
										
										
									   
									}
								}
	

 exit;
}
?>