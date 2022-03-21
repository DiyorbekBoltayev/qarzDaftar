<?php
include 'config.php';
echo "<script>
             alert('Barcha qarzlar uzildi');
             
     </script>";
$idsi=$_GET['id'];
$sql="select * from qarzlar where qarzdor_id='$idsi'";
$result=mysqli_query($conn,$sql);
$data=mysqli_fetch_assoc($result);
$qarzi=$data['summasi']*-1;
$izohi="Barcha qarzlar uzildi";
date_default_timezone_set('Etc/GMT-5');
$date = date('Y/m/d', time());

$sql = "UPDATE qarzlar SET summasi='0' WHERE qarzdor_id='$idsi'";
$result_update=mysqli_query($conn,$sql);

$sql="INSERT INTO history(qarzdor_id,summasi,izoh,data)
    values ('$idsi','$qarzi','$izohi','$date')";
$result_history=mysqli_query($conn,$sql);


header("Location: index.php");
