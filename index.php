<?php
include "database.php";
$que = mysqli_query($db_conn, "SELECT * FROM un_konfigurasi");
$hsl = mysqli_fetch_array($que);
$timestamp = strtotime($hsl['tgl_pengumuman']);
//echo $timestamp;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="aplikasi sederhana untuk menampilkan pengumuman hasil ujian nasional secara online">
    <meta name="author" content="slamet.bsan@gmail.com">
    <title>Pengumuman Kelulusan</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jasny-bootstrap.min.css" rel="stylesheet">
	<link href="css/kelulusan.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="./">Info Kelulusan <?=$hsl['sekolah'] ?></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="./">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
              </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    
    <div class="container">
        <h2>Pengumuman Kelulusan <?=$hsl['tahun'] ?></h2>
		<!-- countdown -->
		
		<div id="clock" class="lead"></div>
		
		<div id="xpengumuman">
		<?php
		if(isset($_REQUEST['submit'])){
			//tampilkan hasil queri jika ada
			$no_ujian = $_REQUEST['nomor'];
			
			$hasil = mysqli_query($db_conn,"SELECT * FROM data_siswa WHERE no_ujian='$no_ujian'");
			if(mysqli_num_rows($hasil) > 0){
				$data = mysqli_fetch_array($hasil);
				
		?>
			<table class="table table-bordered">
				<tr><td>Nomor Ujian</td><td><?php echo $data['no_ujian']; ?></td></tr>
				<tr><td>Nama Siswa</td><td><?php echo $data['nama']; ?></td></tr>
				<tr><td>Tempat Lahir</td><td><?php echo $data['tempat_lahir']; ?></td></tr>
				<tr><td>Tanggal Lahir</td><td><?php echo $data['tanggal_lahir']; ?></td></tr>
				<tr><td>Jurusan</td><td><?php echo $data['jurusan']; ?></td></tr>
			</table>
			
			<?php
			if( $data['status'] == 1 ){
				echo '<div class="alert alert-success" role="alert"><strong>SELAMAT !</strong> Anda dinyatakan LULUS.</div>';
			} else {
				echo '<div class="alert alert-danger" role="alert"><strong>MAAF !</strong> Anda dinyatakan TIDAK LULUS.</div>';
			}	
			?>
			<div class="center">
				<a  class="btn btn-primary" href="generate.php?id=<?php echo $no_ujian; ?>" target="_blank">Surat Kelulusan</a>
			</div>
	
			
		<?php
			} else {
				echo 'nomor ujian yang anda inputkan tidak ditemukan! periksa kembali nomor ujian anda.';
				//tampilkan pop-up dan kembali tampilkan form
			}
		} else {
			//tampilkan form input nomor ujian
		?>
        <p>Masukkan nomor ujianmu pada form yang disediakan.</p>
        
        <form method="post">
            <div class="input-group">
                <input type="text" name="nomor" class="form-control" data-mask="23-101-999-9" placeholder="Nomor Ujian" required>
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit" name="submit">Periksa!</button>
                </span>
            </div>
        </form>
		<?php
		}
		?>
		</div>
    </div><!-- /.container -->
	
	<footer class="footer">
		<div class="container">
			<p class="text-muted">&copy; <?=$hsl['tahun'] ?> &middot; Tim IT <?=$hsl['sekolah'] ?></p>
		</div>
	</footer>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jasny-bootstrap.min.js"></script>
	<script type="text/javascript">
	var skrg = Date.now();
	$('#clock').countdown("<?=$hsl['tgl_pengumuman'] ?>", {elapse: true})
	.on('update.countdown', function(event) {
	var $this = $(this);
	if (event.elapsed) {
		$( "#xpengumuman" ).show();
		$( "#clock" ).hide();
	} else {
		$this.html(event.strftime('Pengumuman dapat dilihat: <span>%H Jam %M Menit %S Detik</span> lagi'));
		$( "#xpengumuman" ).hide();
	}
	});

	</script>
</body>
</html>