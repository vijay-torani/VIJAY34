<?php




$con=mysqli_connect("localhost","root","root","vijay");

$per_page=5;
$start=0;
$current_page=1;

if(isset($_GET['start'])){
    $start=$_GET['start'];
    $current_page=$start;
    $start--;
    $start=$start*$per_page;
}
$record=mysqli_num_rows(mysqli_query($con, "select id,title from page "));
$pagi=ceil($record/$per_page);


 $sql="select id,title from page limit $start,$per_page";
$res=mysqli_query($con,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <ul>
            <?php
            if (mysqli_num_rows($res)>0) {
                while ($row=mysqli_fetch_assoc($res)) {
                    ?>
            <li>
                <?php
                echo $row['title']; ?>
              
            </li>
            <?php
                }
            }else{
                echo "no records";
            } ?>
        </ul>
        <ol>
            <?php
            
            
            for ($i=1;$i<=$pagi;$i++) {
                   $class='';
                if ($current_page==$i) {
                    $class="active";
                } ?>
            
            <li>
                <a class=" <?php echo $class ?>"href="?start=<?php echo $i?>"><?php echo $i; ?></a>
            </li>
            <?php
            }
            ?>
        </ol>
    </div>
</body>
</html>