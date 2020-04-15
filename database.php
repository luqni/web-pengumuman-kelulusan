<?php

define('DB_HOST','localhost');
define('DB_USER','luqni');
define('DB_PASS','P@ssw0rd');
define('DB_NAME','info_kelulusan');

$db_conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

if(mysqli_connect_errno()){
	echo 'Gagal terhubung ke database: '.mysqli_connect_error();
	exit();
}
?>