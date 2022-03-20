<?php
include 'config.php';
$idsi=$_GET['id'];
$sql="select * from qarzdor where id='$idsi'";
$result=mysqli_query($conn,$sql);
$data=mysqli_fetch_assoc($result);

$sql="select * from history where qarzdor_id='$idsi'";
$result=mysqli_query($conn,$sql);
$historys=mysqli_fetch_all($result);





?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title><?php echo $data['name'] ?>ning qarzlar tarixi</title>
</head>
<body>
<div class="container">
    <h2 class="text text-center"> <span class="text-primary"><?php echo strtoupper($data['name'])?></span>  qarzlari haqidagi ma'lumot</h2>
    <h3 class="text text-center">Telefon raqami: <span class="text-primary"> <?php echo $data['phone']?></span></h3>
    <a href="index.php" class="btn btn-success">Orqaga</a>
    <div>
        <table class="table table-striped">
            <tr>
                <th>Tartib raqami</th>
                <th>Miqdor</th>
                <th>Izoh</th>
                <th>Holati</th>
                <th>Sana</th>

            </tr>
            <?php

                $sn=0;
            foreach ($historys as $history){
                $sn+=1;

                    ?>

                    <tr>
                        <td><?php echo $sn?></td>
                        <td><?php
                            $s="";
                            $s.=$history[2] ;
                            $ss=""; $k=0;
                            for($i=strlen($s)-1;$i>=0;$i--){
                                $ss=$s[$i].$ss;
                                $k+=1;
                                if($k==3){
                                    $ss=" ".$ss;
                                    $k=0;
                                }
                            }
                            echo $ss." so'm ";
                            ?>

                        </td>
                        <td><?php echo  $history[3]; ?> </td>
                        <td><?php if($history[2]>0){?>
                            <span class="text-danger">qarz olingan</span>
                            <?php }else{?>
                                <span class="text-success">qarz qaytarilgan</span>

                           <?php } ?> </td>
                        <td><?php echo  $history[4]; ?> </td>
                    </tr>

                    <?php
                    } ?>
        </table>
    </div>
</div>

</body>
</html>
