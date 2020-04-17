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
$pdf->Cell(190,-15,'Nomor : 421.3 /  / 2020',0,1,'C');
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
$pdf->Cell(150,65,'Telah mengikuti seluruh program pembelajaran dari semester 1 (satu) sampai dengan semester 6 (enam), Ujian Praktik',0,1);
$pdf->Cell(75,-50,'dan Ujian Sekolah pada tahun 2020 dan dinyatakan',0,0);
$pdf->SetFont('times','B',10);

$no_ujian = $_REQUEST['id'];
$hasil = mysqli_query($db_conn,"SELECT status FROM data_siswa WHERE no_ujian='$no_ujian'");
while ($row = mysqli_fetch_array($hasil)){
    if($row['status'] == 1){
        $pdf->Cell(15,-50,'LULUS / TIDAK LULUS',0,1);
        $pdf->Line(99, 153, 125, 153);
    }else{
        $pdf->Cell(15,-50,'LULUS / TIDAK LULUS',0,1);
        $pdf->Line(99, 153, 85, 153);
    }
}

$pdf->SetFont('times','',10);
$pdf->Cell(150,65,'Demikian Surat Keterangan ini dibuat untuk dapat digunakan sebagaimana mestinya.',0,1);

$pdf->SetFont('times','',10);
$pdf->Cell(130,5,'',0,0);
$pdf->Cell(30,5,'Comal, 4 Mei 2020',0,1);
$pdf->Cell(130,3,'',0,0);
$pdf->Cell(28,3,'Kepala Sekolah,',0,1);
$pdf->Image('images/tanda_tangan.jpeg',140,202,25,25);
$pdf->Cell(130,70,'',0,0);
$pdf->Cell(28,70,'NIP.19650302 199512 1 004',0,1);
$pdf->Cell(130,-80,'',0,0);
$pdf->Cell(130,-80,'Drs. Murhono, M.Pd',0,1);
$no_ujian = $_REQUEST['id'];
$hasil = mysqli_query($db_conn,"SELECT username FROM data_siswa WHERE no_ujian='$no_ujian'");
    while ($row = mysqli_fetch_array($hasil)){
    $path = 'images/foto/';
    $filename = $row['username'].'.JPG';
    $filepath = $path.$filename;
    $pdf->Image($filepath,85,198,30,40);
    }
$pdf->Image('images/stempel.png',98,195,60,50);
$pdf->AddPage();

// form nilai
$pdf->SetFont('times','',10);
// mencetak string 
$pdf->Cell(190,10,'KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN REPUBLIK INDONESIA',0,1,'C');
$pdf->SetFont('times','B',11);
// mencetak string 
$pdf->Cell(190,10,'LEGGER IJAZAH SEKOLAH MENENGAH ATAS',0,1,'C');
$pdf->SetFont('times','',11);
$no_ujian = $_REQUEST['id'];
$hasil = mysqli_query($db_conn,"SELECT deskripsi_jurusan FROM data_siswa WHERE no_ujian='$no_ujian'");
while ($row = mysqli_fetch_array($hasil)){
    $pdf->Cell(190,1,$row['deskripsi_jurusan'],0,1,'C');
}
$pdf->Cell(190,10,'TAHUN PELAJARAN 2020/2021',0,1,'C');

$no_ujian = $_REQUEST['id'];
$hasil = mysqli_query($db_conn,"SELECT * FROM data_siswa WHERE no_ujian='$no_ujian'");
while ($row = mysqli_fetch_array($hasil)){
    $pdf->SetFont('times','',10);
    $pdf->Cell(50,10,'Nama',0,0);
    $pdf->Cell(28,10,':',0,0,'R');
    $pdf->SetFont('times','B',10);
    $pdf->Cell(27,10,$row['nama'],0,1);
    $pdf->SetFont('times','',10);
    $pdf->Cell(50,2,'Tempat dan Tanggal Lahir',0,0);
    $pdf->Cell(28,2,':',0,0,'R');
    $pdf->Cell(15,2,$row['tempat_lahir'],0,0);
    $pdf->Cell(2,2,',',0,0,'R');
    $pdf->Cell(27,2,$row['tanggal_lahir'],0,1,'L');
    $pdf->Cell(50,9,'Nama Orang Tua / Wali',0,0);
    $pdf->Cell(28,9,':',0,0,'R');
    $pdf->Cell(27,9,$row['nama_orangtua'],0,1);
    $pdf->Cell(50,2,'Nomor Induk Siswa',0,0);
    $pdf->Cell(28,2,':',0,0,'R');
    $pdf->Cell(27,2,$row['nis'],0,1);
    $pdf->Cell(50,9,'Nomor Induk Siswa Nasional',0,0);
    $pdf->Cell(28,9,':',0,0,'R');
    $pdf->Cell(27,9,$row['nisn'],0,1);
    $pdf->Cell(50,2,'Nomor Peserta Ujian Nasional',0,0);
    $pdf->Cell(28,2,':',0,0,'R');
    $pdf->Cell(27,2,$row['no_ujian'],0,1);
    $pdf->Cell(50,9,'Sekolah Penyelenggara Ujian Sekolah',0,0);
    $pdf->Cell(28,9,':',0,0,'R');
    $pdf->Cell(27,9,'SMA Negeri 1 Comal',0,1);
    $pdf->Cell(50,2,'Sekolah penyelenggara Ujian Nasional',0,0);
    $pdf->Cell(28,2,':',0,0,'R');
    $pdf->Cell(27,2,'SMA Negeri 1 Comal',0,1);
    $pdf->Cell(27,10,'',0,1);

    $pdf->SetFont('times','B',10); 
    $pdf->Cell(10,10,'No',1,0, 'C');
    $pdf->Cell(85,10,'Mata Pelajaran',1,0,'C');
    $pdf->Cell(40,10,'Nilai Rata-rata Rapor',1,0,'C');
    $pdf->Cell(40,10,'Nilai Ujian Sekolah',1,1, 'C');
    $pdf->Cell(175,1,'',1,1);

    $pdf->Cell(175,7,'Kelompok A',1,1);
    $pdf->SetFont('times','',10); 
    $pdf->Cell(10,5,'1',1,0, 'C');
    $pdf->Cell(85,5,'Pendidikan Agama dan Budi Pekerti',1,0);
    $pdf->Cell(40,5,$row['n_pai_a'],1,0,'C');
    $pdf->Cell(40,5,$row['n_uas_pai_a'],1,1, 'C');
    $pdf->Cell(10,5,'2',1,0, 'C');
    $pdf->Cell(85,5,'Pendidikan Pancasila dan Kewarganegaraan',1,0);
    $pdf->Cell(40,5,$row['n_pkn_a'],1,0,'C');
    $pdf->Cell(40,5,$row['n_uas_pkn_a'],1,1, 'C');
    $pdf->Cell(10,5,'3',1,0, 'C');
    $pdf->Cell(85,5,'Bahasa Indonesia',1,0);
    $pdf->Cell(40,5,$row['n_bindonesia_a'],1,0,'C');
    $pdf->Cell(40,5,$row['n_uas_bindonesia_a'],1,1, 'C');
    $pdf->Cell(10,5,'4',1,0, 'C');
    $pdf->Cell(85,5,'Matematika',1,0);
    $pdf->Cell(40,5,$row['n_matematika_a'],1,0,'C');
    $pdf->Cell(40,5,$row['n_uas_matematika_a'],1,1, 'C');
    $pdf->Cell(10,5,'5',1,0, 'C');
    $pdf->Cell(85,5,'Sejarah Indonesia',1,0);
    $pdf->Cell(40,5,$row['n_sejarah_a'],1,0,'C');
    $pdf->Cell(40,5,$row['n_uas_sejarah_a'],1,1, 'C');
    $pdf->Cell(10,5,'6',1,0, 'C');
    $pdf->Cell(85,5,'Bahasa Inggris',1,0);
    $pdf->Cell(40,5,$row['n_binggris_a'],1,0,'C');
    $pdf->Cell(40,5,$row['n_uas_binggris_a'],1,1, 'C');

    $pdf->SetFont('times','B',10); 
    $pdf->Cell(175,7,'Kelompok B',1,1);
    $pdf->SetFont('times','',10);
    $pdf->Cell(10,5,'1',1,0, 'C');
    $pdf->Cell(85,5,'Seni Budaya',1,0);
    $pdf->Cell(40,5,$row['n_seni_b'],1,0,'C');
    $pdf->Cell(40,5,$row['n_uas_seni_b'],1,1, 'C');
    $pdf->Cell(10,5,'2',1,0, 'C');
    $pdf->Cell(85,5,'Pendidikan Jasmani, Olahraga dan Kesehatan',1,0);
    $pdf->Cell(40,5,$row['n_penjas_b'],1,0,'C');
    $pdf->Cell(40,5,$row['n_uas_penjas_b'],1,1, 'C');
    $pdf->Cell(10,5,'3',1,0, 'C');
    $pdf->Cell(85,5,'Prakarya dan Kewirausahaan',1,0);
    $pdf->Cell(40,5,$row['n_prakarya_b'],1,0,'C');
    $pdf->Cell(40,5,$row['n_uas_prakarya_b'],1,1, 'C');
    $pdf->Cell(10,5,'4',1,0, 'C');
    $pdf->Cell(165,5,'Muatan Lokal',1,1);
    $pdf->Cell(10,5,'',1,0, 'C');
    $pdf->Cell(85,5,'a. Bahasa Jawa',1,0);
    $pdf->Cell(40,5,$row['n_bjawa_b'],1,0,'C');
    $pdf->Cell(40,5,$row['n_uas_bjawa_b'],1,1, 'C');
    $pdf->Cell(10,5,'',1,0, 'C');
    $pdf->Cell(85,5,'b.',1,0);
    $pdf->Cell(40,5,'',1,0,'C');
    $pdf->Cell(40,5,'',1,1, 'C');
    $pdf->Cell(10,5,'',1,0, 'C');
    $pdf->Cell(85,5,'c. ',1,0);
    $pdf->Cell(40,5,'',1,0,'C');
    $pdf->Cell(40,5,'',1,1, 'C');

    $pdf->SetFont('times','B',10);
    $pdf->Cell(175,7,'Kelompok C',1,1);
    $pdf->SetFont('times','',10);

    $no_ujian = $_REQUEST['id'];
    $hasil = mysqli_query($db_conn,"SELECT * FROM data_siswa WHERE no_ujian='$no_ujian'");
    while ($row = mysqli_fetch_array($hasil)){
        if($row['deskripsi_jurusan'] == 'PEMINATAN MATEMATIKA ILMU PENGETAHUAN ALAM'){
            $pdf->Cell(10,5,'1',1,0, 'C');
            $pdf->Cell(85,5,'Matematika',1,0);
            $pdf->Cell(40,5,$row['n_matematika_c'],1,0,'C');
            $pdf->Cell(40,5,$row['n_uas_matematika_c'],1,1, 'C');
            $pdf->Cell(10,5,'2',1,0, 'C');
            $pdf->Cell(85,5,'Biologi',1,0);
            $pdf->Cell(40,5,$row['n_biologi_c'],1,0,'C');
            $pdf->Cell(40,5,$row['n_uas_biologi_c'],1,1, 'C');
            $pdf->Cell(10,5,'3',1,0, 'C');
            $pdf->Cell(85,5,'Fisika',1,0);
            $pdf->Cell(40,5,$row['n_fisika_c'],1,0,'C');
            $pdf->Cell(40,5,$row['n_uas_fisika_c'],1,1, 'C');
            $pdf->Cell(10,5,'4',1,0, 'C');
            $pdf->Cell(85,5,'Kimia',1,0);
            $pdf->Cell(40,5,$row['n_kimia_c'],1,0,'C');
            $pdf->Cell(40,5,$row['n_uas_kimia_c'],1,1, 'C');
            $pdf->Cell(10,5,'5',1,0, 'C');
            $pdf->Cell(165,5,'Pilihan Lintas Minat / Pendalaman Minat',1,1);
            $pdf->Cell(10,5,'',1,0, 'C');
            if($row['jurusan'] == 'MIPA 5' && 'MIPA 6'){
                $pdf->Cell(85,5,'Sastra Inggris',1,0);
                $pdf->Cell(40,5,$row['n_minat_c'],1,0,'C');
                $pdf->Cell(40,5,$row['n_uas_minat_c'],1,1, 'C');
            }else{
                $pdf->Cell(85,5,'Geografi',1,0);
                $pdf->Cell(40,5,$row['n_minat_c'],1,0,'C');
                $pdf->Cell(40,5,$row['n_uas_minat_c'],1,1, 'C');
            }
            
        }elseif($row['deskripsi_jurusan'] == 'PEMINATAN ILMU PENGETAHUAN SOSIAL'){
            $pdf->Cell(10,5,'1',1,0, 'C');
            $pdf->Cell(85,5,'Geografi',1,0);
            $pdf->Cell(40,5,$row['n_matematika_c'],1,0,'C');
            $pdf->Cell(40,5,$row['n_uas_matematika_c'],1,1, 'C');
            $pdf->Cell(10,5,'2',1,0, 'C');
            $pdf->Cell(85,5,'Sejarah',1,0);
            $pdf->Cell(40,5,$row['n_biologi_c'],1,0,'C');
            $pdf->Cell(40,5,$row['n_uas_biologi_a'],1,1, 'C');
            $pdf->Cell(10,5,'3',1,0, 'C');
            $pdf->Cell(85,5,'Sosiologi',1,0);
            $pdf->Cell(40,5,$row['n_fisika_c'],1,0,'C');
            $pdf->Cell(40,5,$row['n_uas_fisika_c'],1,1, 'C');
            $pdf->Cell(10,5,'4',1,0, 'C');
            $pdf->Cell(85,5,'Ekonomi',1,0);
            $pdf->Cell(40,5,$row['n_kimia_c'],1,0,'C');
            $pdf->Cell(40,5,$row['n_uas_kimia_c'],1,1, 'C');
            $pdf->Cell(10,5,'5',1,0, 'C');
            $pdf->Cell(165,5,'Pilihan Lintas Minat / Pendalaman Minat',1,1);
            $pdf->Cell(10,5,'',1,0, 'C');
            $pdf->Cell(85,5,'Sastra Inggris',1,0);
            $pdf->Cell(40,5,$row['n_minat_c'],1,0,'C');
            $pdf->Cell(40,5,$row['n_uas_minat_c'],1,1, 'C');
        }else{
            $pdf->Cell(10,5,'1',1,0, 'C');
            $pdf->Cell(85,5,'Bahasa dan Satra indonesia',1,0);
            $pdf->Cell(40,5,$row['n_matematika_c'],1,0,'C');
            $pdf->Cell(40,5,$row['n_uas_matematika_c'],1,1, 'C');
            $pdf->Cell(10,5,'2',1,0, 'C');
            $pdf->Cell(85,5,'Bahasa dan sastra inggis',1,0);
            $pdf->Cell(40,5,$row['n_biologi_c'],1,0,'C');
            $pdf->Cell(40,5,$row['n_uas_biologi_a'],1,1, 'C');
            $pdf->Cell(10,5,'3',1,0, 'C');
            $pdf->Cell(85,5,'Bahasa dan sastra perancis',1,0);
            $pdf->Cell(40,5,$row['n_fisika_c'],1,0,'C');
            $pdf->Cell(40,5,$row['n_uas_fisika_c'],1,1, 'C');
            $pdf->Cell(10,5,'4',1,0, 'C');
            $pdf->Cell(85,5,'Antropologo',1,0);
            $pdf->Cell(40,5,$row['n_kimia_c'],1,0,'C');
            $pdf->Cell(40,5,$row['n_uas_kimia_c'],1,1, 'C');
            $pdf->Cell(10,5,'5',1,0, 'C');
            $pdf->Cell(165,5,'Pilihan Lintas Minat / Pendalaman Minat',1,1);
            $pdf->Cell(10,5,'',1,0, 'C');
            $pdf->Cell(85,5,'Biologi',1,0);
            $pdf->Cell(40,5,$row['n_minat_c'],1,0,'C');
            $pdf->Cell(40,5,$row['n_uas_minat_c'],1,1, 'C');
        }

        $pdf->SetFont('times','B',10);
        $pdf->Cell(95,7,'Rata-rata',1,0,'C');
        $pdf->Cell(40,7,$row['rata_rata_rapor'],1,0,'C');
        $pdf->Cell(40,7,$row['rata_rata_uas'],1,1, 'C');
    }
}

$pdf->Output();
?>