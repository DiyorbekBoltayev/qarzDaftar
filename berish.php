<?php
include 'config.php';
$idsi=$_GET['id'];
if(isset($_POST['submit'])){
    $tsum=$_POST['tsum'];
    $izoh=$_POST['izoh'];
    $sana=$_POST['sana'];

    $sql="select * from qarzlar where qarzdor_id='$idsi'";
    $result=mysqli_query($conn,$sql);
    $data_qarzdor1=mysqli_fetch_assoc($result);
    $oldsumm=$data_qarzdor1['summasi'];
    $oldsumm+=$tsum;


    $sql="UPDATE qarzlar SET summasi='$oldsumm' WHERE id='$idsi'";
    $result=mysqli_query($conn,$sql);



    $sql="INSERT INTO history(qarzdor_id,summasi,izoh,data)
    values ('$idsi','$tsum','$izoh','$sana')";
    $result_history=mysqli_query($conn,$sql);
    echo "<script>alert('Ma\'lumotlar saqlandi !')</script>";



}


$sql="select * from qarzdor where id='$idsi'";
$result=mysqli_query($conn,$sql);
$data_qarzdor=mysqli_fetch_assoc($result);

$sql="select * from qarzlar where qarzdor_id='$idsi'";
$result=mysqli_query($conn,$sql);
$data_qarzlar=mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>


<h1 class="text text-primary text-center">Qarz berish oynasi</h1>
<a href="index.php" class="btn btn-primary">Qarzdorlar ro'yhatiga qaytish</a>
<div class="p-3" style="background-color: rgba(160,191,167,0.66); border-radius: 20px; width: 400px; height: 530px; margin: 10px auto">
    <form action="" method="post">

        <div class="mb-3 text-center h3">
            <?php echo "Qarzdor:" ?> <span class="text-primary"> <?php echo $data_qarzdor['name'] ?> </span> <br>
            <?php echo "Telefon raqami:" ?> <span class="text-primary"> <?php echo $data_qarzdor['phone'] ?> </span> <br>
            <?php echo "Qarz miqdori:" ?> <span class="text-primary"> <?php echo $data_qarzlar['summasi'] ?> </span> <br>




        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Berilayotgan qarz</label>
            <input type="number" name="tsum" class="form-control" required  id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Izoh</label>
            <input type="text" name="izoh" class="form-control"  required id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Sana</label>
            <input type="date" name="sana" class="form-control" required  id="exampleInputPassword1">
        </div>

        <br>
        <input type="submit" name="submit" class="form-control btn btn-success" value="Qo'shish">
    </form>
</div>

</body>
</html>

