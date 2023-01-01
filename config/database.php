<?php

function runSQLtext($sSQL) {

	$serv = "35.240.192.212";
	$user = "test";
	$pass = "test123";
	$dbse = "cari_jurusan";
	$result = "";

	$conn = new mysqli($serv,$user,$pass,$dbse);
	if ($conn->connect_error) {
		die("connection failed " . $conn->connect_error);
	} else {
		$result = $conn->query($sSQL);
		$conn->close();
	}
	return $result;
}



?>