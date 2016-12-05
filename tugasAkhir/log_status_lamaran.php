<?php 
$dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=basdat") or die('connection failed');
				

 $value = $_POST['valbtn'];
 $btnid = $_POST['idbtn'];
 echo "<button class=\"btn btn-danger btn-xs btnstatus\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#delete\" value=5 >Batalsss</button>";
	
?>