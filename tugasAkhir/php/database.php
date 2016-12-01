<?php
function connectDB(){
$dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=basdat") or die('connection failed');
return $dbconn;
}
?>