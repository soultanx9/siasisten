<?php 
if(isset($_REQUEST))
{
$dbconn = pg_connect("host=dbpg.cs.ui.ac.id port=5432 dbname=b02 user=b02 password=Xq9K3P") or die('connection failed');

$id=$_POST['id'];
$status=$_POST['value'];

$sql="update log set id_st_log='$status' where id='$id'";
$result=pg_query($sql);

$tmp="select status from status_log where id='$status'";
$result2=pg_query($tmp);

$statusid;		
			while($tmp2 = pg_fetch_array($result2)){
				$statusid = $tmp2[0];
			}

if($result){
echo $statusid;
}
}

?>