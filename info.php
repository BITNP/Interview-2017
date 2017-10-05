<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
include_once("conn.php");
    $get = $_GET['name'];
    //if ($get != NULL){
       /// $sql = "update recordd set status_=3 where name='".$get."' and status_=2";
       // $result = mysqli_query($conn, $sql);
    //}
?>
<head>
<title><?php echo $get;?>的信息</title>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">  
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
    <caption><h2><?php echo $get;?>的信息</h2></caption> 
    <?php
    echo '<td><a href="cmt.php?eid=34&name='.$get.'"><button type="button" class="btn btn-success">评论</button><a></td>';
    ?>
    <thead> 
        <tr> 
            <th></th>
            <th></th> 
            <th></th> 
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>

        </tr> 
    </thead> 
    <tbody> 

<?php
        $sql = "select * from info where name='".$get."'";
    
    //echo $sql;
    $result = mysqli_query($conn, $sql);
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