<?php

include 'config.php';
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
<div class="container">
    <h1 class="text text-center">Qarzlar haqidagi ma'lumot</h1>
    <a href="index.php" class="btn btn-success">Qarzdorlar ro'yhatiga qaytish</a>
<!--        <form class=" d-flex justify-content-between" action="" method="post">-->
<!--            <input style="width: 400px; height: 40px; border: 1px solid blue" placeholder="Kalit so'zni kiriting..." type="search" class=" form-control">-->
<!--            <input style="width: 100px;" type="submit" class="btn btn-outline-primary form-control" value="Izlash">-->
<!--        </form></div>-->


        <table class="table table-striped">
            <tr>
                <th>Tartib raqami</th>
                <th>Qarzdor</th>
                <th>Qarz miqdori</th>
                <th>Amallar</th>
            </tr>
            <?php
            $search=$_POST['search'];
            $sql="SELECT * FROM qarzdor where name like '%$search%'";
            $result=mysqli_query($conn,$sql);

            if (mysqli_num_rows($result) > 0) {

                $sn=1;

                while($dataold = mysqli_fetch_assoc($result)) {
                    $id_q=$dataold['id'];
                    $sql="select * from qarzlar where qarzdor_id='$id_q'";
                    $result3=mysqli_query($conn,$sql);
                while($data = mysqli_fetch_assoc($result3)) {
                    $ff=$data['qarzdor_id']; if($data['summasi']==0) continue;?>

                    <tr>
                        <td><?php echo $sn?></td>
                        <td>
                            <a href="show.php? id=<?php echo $ff ?>">
                                <?php
                                $tt=$data['qarzdor_id'];
                                $sql2="SELECT * FROM qarzdor where id='$tt'";
                                $result2=mysqli_query($conn,$sql2);
                                $dat = mysqli_fetch_assoc($result2);
                                $matn=$dat['name'];
                                $m_boshi=strpos($matn,$search);
                                $m_oxiri=strlen($search);
                                for($i=0;$i<strlen($matn);$i++){
                                    if($i>=$m_boshi && $i<($m_boshi+$m_oxiri)){
                                        ?>
                                        <span style="color: #f6a002; margin: -2px; font-weight: 900;"><?php echo $matn[$i] ?></span>
                                <?php
                                    }else{
                                        ?>
                                        <span style="margin: -2px;"><?php echo $matn[$i]?></span>
                                <?php
                                    }
                                }
                                ?>
                            </a>
                        </td>
                        <td><?php
                            $s="";
                            $s.=$data['summasi'] ;
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
                            ?> </td>
                        <td>
                            <a href="tulash.php? id=<?php echo $tt?>" class="btn btn-info">To'lash</a>
                            <a href="berish.php? id=<?php echo $tt?>" class="btn btn-warning">Qarz berish</a>
                        </td>
                    </tr>

                    <?php
                    $sn++;}}} else { ?>
                <h1 class="text text-center m-3">Hozircha qarzdorlar yo'q :-)</h1>

            <?php } ?>
        </table>
    </div>
</div>
</body>
</html>
