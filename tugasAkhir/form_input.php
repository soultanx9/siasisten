<style>
table {
    font-family: arial, sans-serif;
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

<script>
 	function hanyaAngka(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
		return true;
	}
</script>
<div class="jumbotron text-center">
<h1><b>Daftar Lowongan</b></h1>
</div>
<form action="proses.php" method="post">
<table cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%"><p><strong>Term</strong></p></td>
    <td width="80%"><?php echo "nama_variabel_php";?></td>
  </tr>
  <tr>
    <td><p><strong> Kode </strong></p></td>
    <td><?php echo "nama_variabel_php";?></td>
  </tr>
  <tr>
    <td><p><strong> Mata Kuliah </strong></p></td>
    <td><?php echo "nama_variabel_php";?></td>
  </tr>
  <tr>
    <td><p><strong> IPK </strong></p></td>
    <td><input type="text" required name="ipk" style="height:30px; width:40px;" maxlength="4"/>&nbsp;&nbsp;&nbsp;<span style="background-color:#FFFFCC; padding:2px; border:1px solid #FFCC66; text-align:center;">*Skala 4 & Menggunakan koma (,) </span></td>
  </tr>
  <tr>
    <td><p><strong> SKS</strong><br>
            <strong></strong></p>
	</td>
    <td><input type="text" required name="sks"  style="height:30px; width:40px; " onkeypress="return hanyaAngka(event)" maxlength="3"/>&nbsp;&nbsp;&nbsp;<span style="background-color:#FFFFCC; padding:2px; border:1px solid #FFCC66; text-align:center;">*Masukkan hanya angka</span></td>
  </tr>
  <tr>
    <td colspan="2">
		<input type="submit" class="button" value="Daftar" style="background-color:#0099FF; "/>
		<input type="reset" class="button" value="Batal" style="background-color:#0099FF; "/>
	</td>
  </tr>
</table>
</form>