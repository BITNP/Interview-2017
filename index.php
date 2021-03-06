<?php
session_start();
include_once('header.php');
?>
<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
    $get = $_SESSION['who'];
?>
<head>
<title><?php echo $get; ?>实时监测</title>
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

<?php include_once ('nav.html');?>

<div class="container">
<table class="table table-hover"> 
    <caption><h2><?php echo sprintf("%s面试清单(%s)", $current_date, $get); ?></h2></caption>
    <thead> 
        <tr> 
            <th>日期</th>
            <th>教室</th> 
            <th>时间</th> 
            <th>姓名</th>
            <th>状态</th>
            <th>候场教室操作</th>
            <th>面试教室操作</th>
            <th>候场教室操作</th>
            <th>信息</th>
        </tr> 
    </thead> 
    <tbody> 

<?php
    if($get != ''){
        if (in_array($get, $interview_room)) {
            /*
            $sql = sprintf("select type from user where username=%s", $get);
            $res = mysqli_query($config, $sql);
            $type = mysqli_fetch_array($res)[0];
            */
            $type = 0;
        } else if($get != 'bitnp') $type = 1;
        else $type = 3;
/*
        if($type > 0)
            $sql = sprintf("select date,room,time,name,status,id from record where DATE = '%s' order by time", $current_date);
        else
            $sql = sprintf("select date,room,time,name,status,id from record where DATE = '%s' and room = '%s' order by time", $current_date, $get);
*/
        $sql = sprintf("select date,room,time,name,status,id from record order by time");
        // 紧急修复 -> 全名单
        $result = mysqli_query($config, $sql);
        $myrow = mysqli_fetch_array($result);
        mysqli_data_seek($result,0);
        $nums = mysqli_num_fields($result);
        while($myrow = mysqli_fetch_row($result)){
            echo "<tr>";
            for ( $m = 0 ; $m < $nums-1 ; $m++ ){
                if ($m == 4){
                    if($myrow[$m] <= 4)
                        $tmp = sprintf('<td><button type="button" class="btn btn-%s">%s</button></td>', $status_color[$myrow[$m]], $status_code[$myrow[$m]]);
                    else
                        $tmp = sprintf('<td><button type="button" class="btn btn-%s">%s</button></td>', 'info', '进入录取环节');
                } else{
                    $tmp = sprintf("<td>%s</td>", $myrow[$m]);
                }
                echo $tmp;
            }

            echo '<td><a href="exe.php?eid=01&id='.$myrow[5].'"><button type="button" class="btn btn-primary">签到</button><a></td>';
            echo '<td><a href="exe.php?eid=12&id='.$myrow[5].'"><button type="button" class="btn btn-warning">准备面试</button><a></td>';
            echo '<td><a href="exe.php?eid=23&id='.$myrow[5].'"><button type="button" class="btn btn-primary">已出发</button><a></td>';
            echo '<td><a href="info.php?id='.$myrow[5].'"><button type="button" class="btn btn-info">信息</button><a></td>';
            echo "</tr>";
        }
    }
?>
    </tbody> 
</table>
</div>
<h3>看不到东西先去<a href='register/login.php'>登录界面</a></h3>
</body>
<?php include_once ("footer.html");?>
</html>
