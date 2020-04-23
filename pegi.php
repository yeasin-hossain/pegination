<?php 

// Database Configuration file

include('config.php');

if(isset($_GET['pegi'])){
    $pegi = $_GET['pegi'];
}else{
    $pegi = 1;
}

$show_data_lenght = 6;

$offset = ($pegi-1)*$show_data_lenght;

    $sql1 = "SELECT COUNT(id) FROM tbluser";
    $result1 = $con->query($sql1);
    $row_data = $result1->fetch_array()[0];

    $total_data = ceil($row_data / $show_data_lenght);
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body>
    <table class="table table-striped">
        <tr>
            <th>No</th>
            <th>name</th>
        </tr>

        <?php 
        $sql = "SELECT * FROM tbluser LIMIT $offset, $show_data_lenght";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['Name'] ?></td>
        </tr>
        <?php endwhile?>
    </table>

                <ul class="pagination">
        <li> <a href="?pegi=1">First</a> </li>

        <li class="<?php if($pegi<= 1){echo "disabled";}  ?>">

        <a href="<?php if($pegi <= 1 ){echo "#";}else{echo "?pegi=".($pegi - 1);}  ?>">prev</a>
        </li>

        <li class="<?php if($pegi >= $total_data){echo "disabled";}  ?>">

        <a href="<?php if($pegi >= $total_data ){echo "#";}else{echo "?pegi=".($pegi + 1);}  ?>">Next</a>
        </li>
        <li><a href="?pegi=<?= $total_data ; ?>">Last</a></li>
        </ul>
</body>
</html>