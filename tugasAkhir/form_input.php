<?php
		$conn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=basdat") or die('connection failed');
?>

<?php 
	if(!isset($_POST['simpan'])){
		#CONTOH YANG DIPAKAI ID LOWONGAN 109
		$lowongan = "SELECT lowongan.idlowongan, lowongan.jumlah_asisten, lowongan.jml_pelamar, mata_kuliah.kode, mata_kuliah.nama, kelas_mk.idkelasmk, kelas_mk.semester, kelas_mk.tahun  
							FROM lowongan
							LEFT JOIN kelas_mk ON lowongan.idkelasmk = kelas_mk.idkelasmk
							LEFT JOIN mata_kuliah ON mata_kuliah.kode = kelas_mk.kode_mk
							WHERE lowongan.status = 'true' AND lowongan.idlowongan = '109'
							ORDER BY lowongan.idlowongan ASC
					";
					
		$rl = pg_query($conn, $lowongan);
		
		$arr = pg_fetch_array($rl, NULL, PGSQL_ASSOC);
		?>
    
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
            <form action="form_input.php?action=OK&npm=1120345090&idlowongan=109" method="post">
            <table cellspacing="0" cellpadding="0">
              <tr>
                <td width="20%"><p><strong>Term</strong></p></td>
                <td width="80%"><?php echo $arr["tahun"];?></td>
              </tr>
              <tr>
                <td><p><strong> Kode </strong></p></td>
                <td><?php echo $arr["kode"];?></td>
              </tr>
              <tr>
                <td><p><strong> Mata Kuliah </strong></p></td>
                <td><?php echo $arr["nama"];?></td>
              </tr>
              <tr>
                <td><p><strong> IPK </strong></p></td>
                <td>
                    <input type="text" required name="ipk" style="height:30px; width:40px;" maxlength="4"/>&nbsp;&nbsp;&nbsp;<span style="background-color:#FFFFCC; padding:2px; border:1px solid #FFCC66; text-align:center;">*Skala 4 & Menggunakan titik (.) </span></td>
              </tr>
              <tr>
                <td><p><strong> SKS</strong><br>
                        <strong></strong></p>
                </td>
                <td>
                    <input type="text" required name="sks"  style="height:30px; width:40px; " onkeypress="return hanyaAngka(event)" maxlength="3"/>&nbsp;&nbsp;&nbsp;<span style="background-color:#FFFFCC; padding:2px; border:1px solid #FFCC66; text-align:center;">*Masukkan hanya angka</span></td>
              </tr>
              <tr>
                <td colspan="2">
                    <input type="submit" class="button" value="Daftar" id="Daftar" name="simpan" style="background-color:#0099FF; "/>  
                    
                    
                    
                    <input type="reset" class="button" value="Batal" id="Batal" style="background-color:#0099FF; "/>
                </td>
              </tr>
            </table>
            </form>
     <?php
	}
	if(isset($_POST['simpan'])){
		$id = $_GET['idlowongan'];
		$npm = $_GET['npm'];
		$ipk = $_POST['ipk'];
		$sks = $_POST['sks'];
		
		$lamaran_1 = "SELECT lowongan.idlowongan, lowongan.jumlah_asisten, lowongan.jml_pelamar, mata_kuliah.kode, mata_kuliah.nama, kelas_mk.idkelasmk, kelas_mk.semester, kelas_mk.tahun  
							FROM lowongan
							LEFT JOIN kelas_mk ON lowongan.idkelasmk = kelas_mk.idkelasmk
							LEFT JOIN mata_kuliah ON mata_kuliah.kode = kelas_mk.kode_mk
							WHERE lowongan.status = 'true' AND lowongan.idlowongan = '$id'
							ORDER BY lowongan.idlowongan ASC
					";
					
		$ra = pg_query($conn, $lamaran_1);
		
		$arra = pg_fetch_array($ra, NULL, PGSQL_ASSOC);
		
		$jmlpel = $arra['jml_pelamar'];
		$tmb = $jmlpel+1;
		
		$lamaran_2 = "INSERT into lamaran (idlamaran, npm, idlowongan, id_st_lamaran, ipk, JumlahSKS, nip) 
									VALUES(200, '1120345090', 765 ,1, '$ipk', '$sks', '197107201998031001')";
		$ra2 = pg_query($conn, $lamaran_2);
		
		$lamaran_3 = "UPDATE lowongan SET jml_lamaran = '$tmb' WHERE idlowongan = '$id'";
		$ra3 = pg_query($conn, $lamaran_3);
		
		if(isset($_GET['action'])){
			if($_GET['action']=="OK"){
				echo "<p style=background-color:#03C935;color:#FFF;padding:10px;font-family:arial,verdana;width:36%;>Proses melamar berhasil. Silahkan tunggu proses selanjutnya </p><br/>";	
			}
		}
	}?>
