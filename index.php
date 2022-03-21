<?php
//bismillah
include 'config.php';
$git_p=1700;
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
    <div class="d-flex justify-content-between mb-2"> <a href="add.php" style="font-weight: 800" class="btn btn-success">Qarzdor qo'shish</a>
        <form class=" d-flex justify-content-between" action="topilgan.php" method="post">
            <input name="search" style="width: 400px; height: 40px; border: 1px solid blue" required placeholder="Kalit so'zni kiriting..." type="search" class=" form-control">
            <input style="width: 100px; font-weight: 600" type="submit" class="btn btn-outline-primary form-control" value="Izlash">
        </form>
        <a href="hisobot.php" style="font-weight: 900" class="btn btn-success"> Hisobot qurish</a>
    </div>

    <div>
        <table class="table table-striped text-center">
            <tr>
                <th style="width: 15%">Tartib raqami</th>
                <th style="width: 23%;">Qarzdor</th>
                <th style="width: 25%">Qarz miqdori</th>
                <th style="width: 38%">Amallar</th>
            </tr>
    <?php
    $sql="SELECT * FROM qarzlar ORDER BY id DESC";

    $result=mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) {
    $sn=1;

    while($data = mysqli_fetch_assoc($result)) { $ff=$data['qarzdor_id']; if($data['summasi']==0) continue;?>

            <tr>
                <td><?php echo $sn?></td>
                <td>
                    <a href="show.php? id=<?php echo $ff ?>" style="width: 100%; font-weight: 600" class="btn  text-primary">
                    <?php
                    $tt=$data['qarzdor_id'];
                    $sql2="SELECT * FROM qarzdor where id='$tt'";
                    $result2=mysqli_query($conn,$sql2);
                    $dat = mysqli_fetch_assoc($result2);
                    echo $dat['name'];
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
                    <a href="tulash.php? id=<?php echo $tt?>"  style="font-weight: 600" class="btn btn-outline-primary">To'lash</a>
                    <a href="berish.php? id=<?php echo $tt?>" style="font-weight: 600"  class="btn btn-outline-warning text-dark">Qarz berish</a>
                    <a href="uzish.php? id=<?php echo $tt?>" style="font-weight: 600"  class="btn btn-outline-danger ">Barcha qarzlarni uzish</a>
                </td>
            </tr>

        <?php
        $sn++;}} else { ?>
            <h1 class="text text-center m-3">Hozircha qarzdorlar yo'q</h1>

    <?php } ?>
        </table>
    </div>
</div>
</body>
</html>
