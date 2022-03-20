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
    <div class="d-flex justify-content-between"> <a href="add.php" class="btn btn-success"> + qarzdor qo'shish</a>
        <form class=" d-flex justify-content-between" action="topilgan.php" method="post">
            <input name="search" style="width: 400px; height: 40px; border: 1px solid blue" placeholder="Kalit so'zni kiriting..." type="search" class=" form-control">
            <input style="width: 100px;" type="submit" class="btn btn-outline-primary form-control" value="Izlash">
        </form></div>

    <div>
        <table class="table table-striped">
            <tr>
                <th>Tartib raqami</th>
                <th>Qarzdor</th>
                <th>Qarz miqdori</th>
                <th>Amallar</th>
            </tr>
    <?php
    $sql="SELECT * FROM qarzlar";

    $result=mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) {
    $sn=1;

    while($data = mysqli_fetch_assoc($result)) { $ff=$data['qarzdor_id']; if($data['summasi']==0) continue;?>

            <tr>
                <td><?php echo $sn?></td>
                <td>
                    <a href="show.php? id=<?php echo $ff ?>">
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
                    <a href="tulash.php? id=<?php echo $tt?>" class="btn btn-info">To'lash</a>
                    <a href="berish.php? id=<?php echo $tt?>" class="btn btn-warning">Qarz berish</a>
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
