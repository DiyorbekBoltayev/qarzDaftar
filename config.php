<?php
$server="localhost";
$user="root";
$password="";
$database="qarzdaftar";
$conn=mysqli_connect($server,$user,$password,$database);
if(!$conn){
    die("<script>alert('Ulanishda Xatolik.')</script>");
}

?>
