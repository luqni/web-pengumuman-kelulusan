<?php
include "database.php";
// memanggil library FPDF
require('fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('P','mm','A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('times','B',11);
// mencetak string 
$pdf->Cell(190,5,'PEMERINTAH PROVINSI JAWA TENGAH',0,1,'C');
$pdf->Image('images/logo-jateng.png',8,10,25,25);
$pdf->Cell(190,5,'DINAS PENDIDIKAN DAN KEBUDAYAAN',0,1,'C');
$pdf->SetFont('times','B',16);
$pdf->Cell(190,7,'SEKOLAH MENENGAH ATAS NEGERI 1 COMAL',0,1,'C');
$pdf->SetFont('times','',9);
$pdf->Cell(190,7,'Jalan Jendral Ahmad Yani Nomor 77, Pemalang Kode Pos 52363 Telepon 0285 577190',0,1,'C');
$pdf->Cell(190,2,'Surat Elektronik smanegeri_1comal@yahoo.co.id Website:http://sman1comal.sch.id/',0,1,'C');
$pdf->Line(20, 40, 210-20, 40);
$pdf->SetFont('times','U',16);
$pdf->Cell(190,30,'SURAT KETERANGAN',0,1,'C');
$pdf->SetFont('times','B',9);
$pdf->Cell(190,-15,'Nomor : 421.3 / 302 / 2019',0,1,'C');
$pdf->SetFont('times','',10);
$pdf->Cell(150,40,'Yang bertanda tangan dibawah ini Kepala SMA Negeri 1 Comal Kabupaten Pemalang,',0,1);
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('times','',10);
$pdf->Cell(20,-35,'Nama',0,0);
$pdf->Cell(25,-35,'',0,0);
$pdf->Cell(27,-35,': Drs. Murhono, M.Pd',0,1);
$pdf->Cell(20,45,'NIP',0,0);
$pdf->Cell(25,45,'',0,0);
$pdf->Cell(27,45,': NIP. 19650302 199512 1 004',0,1);
$pdf->Cell(20,-35,'Pangkat / Gol',0,0);
$pdf->Cell(25,-35,'',0,0);
$pdf->Cell(27,-35,': Pembina',0,1);

$pdf->SetFont('times','',10);
$pdf->Cell(150,55,'Dengan ini menerangkan bahwa,',0,1);

$no_ujian = $_REQUEST['id'];
$hasil = mysqli_query($db_conn,"SELECT * FROM data_siswa WHERE no_ujian='$no_ujian'");
while ($row = mysqli_fetch_array($hasil)){
    $pdf->SetFont('times','',10);
    $pdf->Cell(20,-35,'Nama',0,0);
    $pdf->Cell(28,-35,':',0,0,'R');
    $pdf->Cell(27,-35,$row['nama'],0,1);
    $pdf->Cell(20,45,'TTL',0,0);
    $pdf->Cell(28,45,':',0,0,'R');
    $pdf->Cell(15,45,$row['tempat_lahir'],0,0);
    $pdf->Cell(2,45,',',0,0,'R');
    $pdf->Cell(27,45,$row['tanggal_lahir'],0,1,'L');
    $pdf->Cell(20,-35,'No. Peserta',0,0);
    $pdf->Cell(28,-35,':',0,0,'R');
    $pdf->Cell(27,-35,$row['no_ujian'],0,1);
    $pdf->Cell(20,45,'NIS',0,0);
    $pdf->Cell(28,45,':',0,0,'R');
    $pdf->Cell(27,45,$row['nis'],0,1);
    $pdf->Cell(20,-35,'NISN',0,0);
    $pdf->Cell(28,-35,':',0,0,'R');
    $pdf->Cell(27,-35,$row['nisn'],0,1);
}

$pdf->SetFont('times','',10);
$pdf->Cell(150,65,'Telah mengikuti Ujian Sekolah Berstandar Nasional Berbasis Komputer pada tahun 2020 dan dinyatakan',0,0);
$pdf->SetFont('times','B',10);

$no_ujian = $_REQUEST['id'];
$hasil = mysqli_query($db_conn,"SELECT status FROM data_siswa WHERE no_ujian='$no_ujian'");
while ($row = mysqli_fetch_array($hasil)){
    if($row['status'] == 1){
        $pdf->Cell(27,65,'LULUS',0,1);
    }else{
        $pdf->Cell(27,65,'TIDAK LULUS',0,1);
    }
}

$pdf->SetFont('times','',10);
$pdf->Cell(150,-55,'Demikian Surat Keterangan ini dibuat untuk dapat digunakan sebagaimana mestinya.',0,1);

$pdf->SetFont('times','',10);
$pdf->Cell(130,100,'',0,0);
$pdf->Cell(30,100,'Comal, 04 Mei 2020',0,1);
$pdf->Cell(130,-90,'',0,0);
$pdf->Cell(28,-90,'Kepala Sekolah,',0,1);
$pdf->Image('images/tanda_tangan.jpeg',140,180,25,25);
$pdf->Cell(130,130,'',0,0);
$pdf->Cell(28,130,'Drs. Murhono, M.Pd',0,1);
$pdf->Cell(130,-120,'',0,0);
$pdf->Cell(28,-120,'19650302 199512 1 004',0,1);

$pdf->AddPage();

// form nilai
$pdf->SetFont('times','',10);
// mencetak string 
$pdf->Cell(190,10,'KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN REPUBLIK INDONESIA',0,1,'C');
$pdf->SetFont('times','B',11);
// mencetak string 
$pdf->Cell(190,10,'LEGGER IJAZAH SEKOLAH MENENGAH ATAS',0,1,'C');

$pdf->Output();
?>