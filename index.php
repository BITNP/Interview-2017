<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
    //$get = $_GET['room'];
    session_start(); 
    $get = $_SESSION['who'];
?>
<head>
<title><?php echo $get; ?>实时监测</title>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">  
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php
    include_once("conn.php");
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
        <a class="navbar-brand" href="index.php">网协面试系统V0.1</a> 
    </div> 
    <div> 
        <ul class="nav navbar-nav"> 
            <li><a href="waiting.php">候场界面</a></li> 
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
<!--
<form action='index.php' method='get'>
<div class="form-group">
    <label class="radio-inline">
        <input type="radio" name="room" id="0" value="ALL" checked> 所有
    <label class="radio-inline">
        <input type="radio" name="room" id="1" value="2A-201" checked> 2A-201
    </label>
    <label class="radio-inline">
        <input type="radio" name="room" id="2" value="2A-202" checked> 2A-202
    </label>
    <label class="radio-inline">
        <input type="radio" name="room" id="3" value="2A-203" checked> 2A-203
    </label>
    <label class="radio-inline">
        <input type="radio" name="room" id="4" value="2A-204" checked> 2A-204
    </label>
    <label class="radio-inline">
        <input type="radio" name="room" id="5" value="2A-205" checked> 2A-205
    </label>
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default" >查询</button>
    </div>
</div>
</form>
-->

<table class="table table-hover"> 
    <caption><h2><?php echo $get; ?>实时监测</h2></caption> 
    <thead> 
        <tr> 
            <th>日期</th>
            <th>教室</th> 
            <th>时间</th> 
            <th>姓名</th>
            <th>状态</th>
            <th>签到(1)</th>
            <th>叫来(2)</th>
            <th>开始(3)</th>
            <th>评论(4)</th>
            <th>信息</th>
        </tr> 
    </thead> 
    <tbody> 

<?php
    $admin = array('a', 'admin', '2A-206','b');
    $inter = array('2A-201','2A-202','2A-203','2A-204','2A-205','admin');

    if (in_array($get, $admin)) {
        $sql = "select date,room,time,name,status_ from recordd";
    }else{
        $sql = "select date,room,time,name,status_ from recordd where room='".$get."'";
    }
    
    //echo $sql;
    $result = mysqli_query($conn, $sql);
    $myrow = mysqli_fetch_array($result);
    mysqli_data_seek($result,0);  //指针复位 需要研究
    $nums = mysqli_num_fields($result);//获取字段数


    while($myrow = mysqli_fetch_row($result)){
        echo "<tr>";
        for ( $m = 0 ; $m < $nums ; $m++ ){
            
            if ($m == 4){

                switch ($myrow[$m]) {
                    case 4:
                    echo '<td><button type="button" class="btn btn-success">结束</button></td>';
                        
                        break;
                    case 1:
                        echo '<td><button type="button" class="btn btn-primary">候场</button></td>';
                        break;
                    case 3:
                        echo '<td><button type="button" class="btn btn-info">正在面试</button></td>';
                        break;
                    case 2:
                        echo '<td><button type="button" class="btn btn-danger">出发</button></td>';
                        break;
                    default:
                        echo '<td><button type="button" class="btn btn-default">未到</button></td>';
                        break;
                }
            } else{
                echo "<td>".$myrow[$m]."</td>";
            }
        }
        echo '<td><a href="exe.php?eid=01&name='.$myrow[3].'"><button type="button" class="btn btn-primary">签到</button><a></td>';
        echo '<td><a href="exe.php?eid=12&name='.$myrow[3].'"><button type="button" class="btn btn-warning">叫来</button><a></td>';
        echo '<td><a href="exe.php?eid=23&name='.$myrow[3].'"><button type="button" class="btn btn-primary">前往</button><a></td>';
        echo '<td><a href="cmt.php?eid=34&name='.$myrow[3].'"><button type="button" class="btn btn-success">评论</button><a></td>';
        echo '<td><a href="info.php?name='.$myrow[3].'"><button type="button" class="btn btn-info">信息</button><a></td>';
        echo "</tr>";
    }
?>
        </tr>
    </tbody> 
</table>
</body>
<h3>看不到东西先去<a href='register/login.php'>注册界面</a></h3>
<hr color=#ccc width=61.8% />
<h6>Copyright © 2016 <a href='http://blog.defjia.top'>DefJia</a>. All rights reserved. </h6>
</html>