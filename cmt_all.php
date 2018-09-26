<?php
session_start();
$get = $_SESSION['who'];
include_once("config.php");
?>
<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
<title>评论汇总</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <script src="bootstrap/jquery.min.js"></script>
    <script src="bootstrap/bootstrap.min.js"></script>
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
    <h1>严禁向协会外无关人员透露本站点网址以及相关隐私信息！</h1>
<table class="table table-hover"> 
    <caption><h2>评论汇总</h2></caption>
    <thead> 
        <tr> 
            <th>时间</th>
            <th>面试者</th>
            <th>评论</th> 
            <th>面试官</th>
        </tr> 
    </thead> 
    <tbody> 

<?php
if($get){
    $sql = "select time,name,cmt,interviewee from cmt order by `time` desc";
    $result = mysqli_query($config, $sql);
    $myrow = mysqli_fetch_array($result);
    mysqli_data_seek($result,0);
    $nums = mysqli_num_fields($result);
    while($myrow = mysqli_fetch_row($result)){
        echo "<tr>";
        for ( $m = 0 ; $m < $nums ; $m++ ){
                echo "<td>".$myrow[$m]."</td>";
        }
        echo "</tr>";
    }
}
?>
    </tbody> 
</table>
    <h3>看不到东西先去<a href='register/login.php'>登录界面</a></h3>
</div>
</body>
<hr color=#ccc width=61.8% />
<h6>Copyright © 2016 <a href='http://blog.defjia.top'>DefJia</a>. All rights reserved. </h6>
</html>