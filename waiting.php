<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
<title>候场教室</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <script src="bootstrap/jquery.min.js"></script>
    <script src="bootstrap/bootstrap.min.js"></script>
<?php
    include_once("config.php");
?>
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

<nav class="navbar navbar-default" role="navigation"> 
    <div class="container-fluid"> 
    <div class="navbar-header"> 
        <a class="navbar-brand" href="index.php">网协面试系统V1.1</a> 
    </div> 
    <div> 
        <ul class="nav navbar-nav"> 
            <li><a href="index.php">候场界面</a></li>
        </ul> 
    </div> 
    </div> 
</nav>
<div class="container">
<table class="table table-hover"> 
    <caption><h2>候场教室</h2></caption> 
    <thead> 
        <tr> 
            <th>日期</th>
            <th>教室</th> 
            <th>时间</th> 
            <th>姓名</th>
            <th>状态</th>

        </tr> 
    </thead> 
    <tbody> 

<?php
        $sql = "select date,room,time,name,status from record where status>0 and status<4 order by status desc";
    
    //echo $sql;
    $result = mysqli_query($config, $sql);
    $myrow = mysqli_fetch_array($result);
    mysqli_data_seek($result,0);  //指针复位 需要研究
    $nums = mysqli_num_fields($result);//获取字段数


    while($myrow = mysqli_fetch_row($result)){
        echo "<tr>";
        for ( $m = 0 ; $m < $nums ; $m++ ){
                if ($m==4){
                    if($myrow[$m]==1){
                        echo '<td><button type="button" class="btn btn-primary">候场</button></td>';
                    }elseif($myrow[$m]==2){
                        echo '<td><button type="button" class="btn btn-danger">出发</button></td>';
                    }else{
                        echo '<td><button type="button" class="btn btn-info">正在面试</button></td>';
                    }
                }elseif($myrow[4]==3){
                    echo "<td><b style='color:red;'>".$myrow[$m]."</b></td>";
                }else{
                    echo "<td><b>".$myrow[$m]."</b></td>";
                }
        }
        echo "</tr>";
    }
?>
        </tr>
    </tbody> 
</table>
</div>
</body>
<?php include_once('footer.html');?>
</html>