<?php
include 'config.php';
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $summasi=$_POST['summasi'];
    $izoh=$_POST['izoh'];
    $sanasi=$_POST['sanasi'];

    $sql="select * from qarzdor where name='$name' and phone='$phone'";
    $result_is_set=mysqli_query($conn,$sql);
    if(!(mysqli_num_rows($result_is_set)>0)){
        $sql="INSERT INTO qarzdor(name,phone)
    values ('$name','$phone')";
        $result_qarzdor=mysqli_query($conn,$sql);
        $sql="select * from qarzdor where name='$name' and phone='$phone'";
        $result_is_set=mysqli_query($conn,$sql);
        $d=mysqli_fetch_assoc($result_is_set);
        $d_id=$d['id'];
    }else{
        $d=mysqli_fetch_assoc($result_is_set);
        $d_id=$d['id'];
    }

    $sql="INSERT INTO history(qarzdor_id,summasi,izoh,data)
    values ('$d_id','$summasi','$izoh','$sanasi')";
    $result_history=mysqli_query($conn,$sql);

    $sql="SELECT * FROM qarzlar WHERE qarzdor_id='$d_id'";
    $result_qarzlar=mysqli_query($conn,$sql);

    if(!(mysqli_num_rows($result_qarzlar)>0)){
        $sql="INSERT INTO qarzlar(qarzdor_id,summasi)
            values ('$d_id','$summasi')";
        $result_into_qarzlar=mysqli_query($conn,$sql);



    }else{
        $sql="SELECT * FROM qarzlar where qarzdor_id='$d_id'";
        $result=mysqli_query($conn,$sql);
        $dt=mysqli_fetch_assoc($result);
        $sm=$dt['summasi']+$summasi;
        $sql = "UPDATE qarzlar SET summasi='$sm' WHERE qarzdor_id='$d_id'";
        $result_update=mysqli_query($conn,$sql);


    }
    echo "<script>alert('Ma\'lumotlar saqlandi !')</script>";


}
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
<h1 class="text text-primary text-center">Qarzdor qo'shish</h1>
<a href="index.php" class="btn btn-primary">Qarzdorlar ro'yhatiga qaytish</a>
<div class="p-3" style="background-color: rgba(239,243,239,0.66); box-shadow: 0px 0px 20px 20px #c8c2ec; border-style: solid;border 30px; border-color:  #7009ef; border-radius: 20px; width: 400px; height: 530px; margin: 10px auto">
    <form action="" method="post">

        <div class="mb-3">
            <label for="exampleInputEmail1" style="color:#7009ef; font-weight: 700; font-size: 16px; " class="form-label">Qarzdor ismi</label>
            <input type="text" name="name" class="form-control" required   id="exampleInputEmail1">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" style="color:#7009ef; font-weight: 700; font-size: 16px; "class="form-label">Telefon raqami</label>
            <input type="text" name="phone" class="form-control" required  id="exampleInputEmail1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" style="color:#7009ef; font-weight: 700; font-size: 16px; " class="form-label">Qarz summasi</label>
            <input type="number" name="summasi" class="form-control" required  id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" style="color:#7009ef; font-weight: 700; font-size: 16px; " class="form-label">Qarz izoh</label>
            <input type="text" name="izoh" class="form-control"  required id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" style="color:#7009ef; font-weight: 700; font-size: 16px; " class="form-label">Sana</label>
            <input type="date" name="sanasi" class="form-control" required  id="exampleInputPassword1">
        </div>

        <br>
        <input type="submit" name="submit" style="font-weight: 700; font-size: 16px; " class="form-control btn btn-outline-success" value="Qo'shish">
    </form>
</div>

</body>
</html>