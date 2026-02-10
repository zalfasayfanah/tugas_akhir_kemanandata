<?php
$host = 'localhost:3307';
$user = 'root';
$pass = 'password';
$db = 'tugas_akhir';


$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>