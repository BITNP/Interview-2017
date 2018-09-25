<?php
echo $_SESSION['who'];
?>
<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
<title>面试第一天评论汇总</title>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">  
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
            <!--
            <li><a href="http://localhost/budget/write/expense_daily.html">支出</a></li>
            <li><a href="http://localhost/budget/write/59store.html">59store</a></li> 
            
            <li class="dropdown"> 
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                    读取
                    <b class="caret"></b> 
                </a> 
                <ul class="dropdown-menu"> 
                    <li><a href="http://localhost/budget/read/income_daily.php">今日收入明细</a></li> 
                    <li><a href="http://localhost/budget/read/expense_daily.php">今日支出明细</a></li> 
                    <li><a href="http://localhost/budget/read/59store.php">今日明细</a></li> 
                    <li class="divider"></li>
                    <li><a href="http://localhost/budget/read/Sept.php">本月收支总览</a></li>
                    <li class="divider"></li> 
                    <li><a href="http://localhost/budget/read/income_total.php">本学期收入计划</a></li>
                    <li><a href="http://localhost/budget/read/expense_total.php">本学期支出预算</a></li> 
                </ul> 
            </li> 
        -->
        </ul> 
    </div> 
    </div> 
</nav>


<table class="table table-hover"> 
    <caption><h2>面试第一天评论汇总</h2></caption> 
    <thead> 
        <tr> 
            <th>时间</th>
            <th>interviewee</th> 
            <th>评论</th> 
            <th>interviewer</th>

        </tr> 
    </thead> 
    <tbody> 

<?php
    $sql = "select time,name,cmt,interviewee from cmt order by `time` desc";
    
    //echo $sql;
    $result = mysqli_query($config, $sql);
    $myrow = mysqli_fetch_array($result);
    mysqli_data_seek($result,0);  //指针复位 需要研究
    $nums = mysqli_num_fields($result);//获取字段数


    while($myrow = mysqli_fetch_row($result)){
        echo "<tr>";
        for ( $m = 0 ; $m < $nums ; $m++ ){
            
            
            
                echo "<td>".$myrow[$m]."</td>";
            
        }
    }
?>
        </tr>
    </tbody> 
</table>
</body>
<hr color=#ccc width=61.8% />
<h6>Copyright © 2016 <a href='http://blog.defjia.top'>DefJia</a>. All rights reserved. </h6>
</html>