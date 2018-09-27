<?php include_once("../config.php"); ?>
<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
<title>实时监控</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <script src="../bootstrap/jquery.min.js"></script>
    <script src="../bootstrap/bootstrap.min.js"></script>
<style>
body{
    background-color:#D4EEC9;
    text-align:center;
}
caption,th{
    text-align:center;
}
</style>
</head>
<body>
<?php include_once ('nav.html');?>
<div class="container">
<table class="table table-hover"> 
    <caption><h2>分赃系统实时监控</h2></caption>
    <thead>
        <tr> 
            <th>姓名</th>
            <th>性别</th> 
            <th>电话</th> 
            <th>学院</th>
            <th>专业</th>
            <th>第一志愿</th>
            <th>第二志愿</th>
            <th>第三志愿</th>
            <th>是否服从</th>
            <th>信息</th>
            <th>录取状态</th>
        </tr> 
    </thead> 
    <tbody> 

<?php
    $_sql = "select name, status_ from info_";
    //$sql = 'select name, sex, phone, school, major, first, second, third, is_ from info_';
    //echo $sql;
    $_result = mysqli_query($config, $_sql);
    //$myrow = mysqli_fetch_array($result);
    mysqli_data_seek($_result,0);  //指针复位 需要研究
    $_nums = mysqli_num_fields($_result);//获取字段数
while($_myrow = mysqli_fetch_row($_result)){
    $name = $_myrow[0];
    $status = $_myrow[1];
    $sql = "select name, sex, phone, school, major, first, second, third, is_ from info where name = '$name'";
    //echo $sql;
    $result = mysqli_query($config, $sql);
    //$myrow = mysqli_fetch_array($result);
    mysqli_data_seek($result,0);  //指针复位 需要研究
    $nums = mysqli_num_fields($result);//获取字段数
    while($myrow = mysqli_fetch_row($result)){
        echo "<tr>";
        for ( $m = 0 ; $m < $nums ; $m++ ){
            
                echo "<td>".$myrow[$m]."</td>";
            
        }
        echo '<td><a href="info.php?name='.$myrow[0].'"><button type="button" class="btn btn-info">信息</button><a></td>';

        echo '<td>';
        switch ($status) {
            case '1':
                echo '<button type="button" class="btn btn-danger">落选</button>';
                break;
            case '2':
                echo '<button type="button" class="btn btn-warning">等待第三志愿</button>';
                break;
            case '3':
                echo '<button type="button" class="btn btn-primary">等待第二志愿</button>';
                break;
            case '4':
                echo '<button type="button" class="btn btn-default">等待第一志愿</button>';
                break;
            case '5':
                echo '<button type="button" class="btn btn-success">技术部录取</button>';
                break;
            case '6':
                echo '<button type="button" class="btn btn-success">网络部录取</button>';
                break;
            case '7':
                echo '<button type="button" class="btn btn-success">数字媒体部录取</button>';
                break;
            case '8':
                echo '<button type="button" class="btn btn-success">电脑诊所录取</button>';
                break;
            case '9':
                echo '<button type="button" class="btn btn-success">组织部录取</button>';
                break;
            
            
            default:
                echo '<button type="button" class="btn btn-warning">？？？</button>';
                break;
        }
        //echo $status;
        echo "</td>";
        
        echo "</tr>";

    }
}
?>
        </tr>
    </tbody> 
</table>
</div>
</body>
<?php include_once ('../footer.html');?>
</html>