<?php 
$hostname = "localhost";
$username = "root";
$password = "";
$db_name = "teduh";

$connect = mysqli_connect($hostname, $username, $password, $db_name);
if ($connect->connect_error) {
    echo("Koneksi gagal: error ".$connect->connect_error);
}
?>