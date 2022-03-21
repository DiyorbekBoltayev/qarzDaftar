<?php
include 'config.php';
if(isset($_POST['submit'])){
    $sana1=$_POST['sana1'];
    $sana2=$_POST['sana2'];

$sql="select * from history where  data between '$sana1' and '$sana2'";
    $result=mysqli_query($conn,$sql);
}else{
    $sql="select * from history";
    $result=mysqli_query($conn,$sql);

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

    <title>Hisobot</title>
</head>
<body>
<div class="container">
    <h1 class="text text-center m-4">Qarzlar haqida hisobot </h1>
    <div class="d-flex justify-content-between mb-3 mt-4"> <a href="index.php" class="btn btn-success">Orqaga</a>
        <form class=" d-flex justify-content-between " action="" method="post">
            <input name="sana1" style="width: 200px; height: 40px; border: 1px solid blue"  required type="date"  class=" form-control">
            <input name="sana1txt" style="width: 95px; height: 40px; border: 1px solid blue" value="sanasidan"  readonly type="text" class=" form-control">

            <input name="sana2" style="width: 200px; height: 40px; border: 1px solid blue" required  type="date" class=" form-control">
            <input name="sana2txt" style="width: 110px; height: 40px; border: 1px solid blue" value="sanasigacha"  readonly type="text" class=" form-control">

            <input style="width: 200px; font-weight: 900" type="submit" name="submit" class="btn btn-outline-success form-control "  value="Hisobot qurish">
        </form>

    </div>
    <div>
        <table class="table table-striped text-center">
            <tr>
                <th style="width: 5%">T/R</th>
                <th style="width: 20%;">Qarzdor</th>
                <th style="width: 15%">Qarz miqdori</th>
                <th style="width: 25%">Izoh</th>
                <th style="width: 15%">Holati</th>
                <th style="width: 20%">Sana</th>
            </tr>
           <?php if (mysqli_num_rows($result) > 0) {
            $sn=1;

            while($data = mysqli_fetch_assoc($result)) { $ff=$data['qarzdor_id']; ?>
            <tr>
                <td><?php echo  $sn?></td>
                <td>
                    <a href="show.php? id=<?php echo $ff ?>" style="width: 100%;" class="btn  text-primary">
                    <?php
                    $tt=$data['qarzdor_id'];
                    $sql2="SELECT * FROM qarzdor where id='$tt'";
                    $result2=mysqli_query($conn,$sql2);
                    $dat = mysqli_fetch_assoc($result2);
                    echo $dat['name'];
                    ?>
                    </a>

                    </td>
                <td>
                    <?php echo $data['summasi']?>
                </td>
                <td>
                    <?php echo $data['izoh']?>
                </td>
                <td>
                    <?php if($data['summasi']>0){?>
                        <span class="text-danger">qarz olingan</span>
                    <?php }else{?>
                        <span class="text-success">qarz qaytarilgan</span>

                    <?php } ?>
                </td>
                <td>
                    <?php echo $data['data']?>
                </td>
            </tr>
<?php $sn+=1; }}else { ?>
            <h1 class="text text-center text-danger m-4">Ushbu oraliqda qarzlar topilmadi !</h1>


         <?php  }?>
        </table>
    </div>
</div>
</body>
</html>
