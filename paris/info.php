<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
include_once("conn.php");
    
        session_start(); 
    $get = $_SESSION['who'];
    $a1 = array('tec' => '技术部', 
                'net' => '网络部',
                'org' => '组织部',
                'media' => '数字媒体部',
                'clinic' => '电脑诊所',
                'defjia' => 'test');
    $a2 = array('tec' => 5,
                'net' => 6,
                'media' => 7,
                'clinic' => 8,
                'org' => 9,
                'defjia' => 4);
    $dpm = $a1[$get];
    $no = $a2[$get];
    $get = $_GET['name'];
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
        <a class="navbar-brand" href="index.php">网协分赃系统V1.0</a> 
    </div> 
    <div> 
        <ul class="nav navbar-nav"> 
            <li><a href="pick.php">捡漏</a></li> 
            <li><a href="wait.php">选人</a><li>
            <li><a href="already.php">查看</a><li>
            <li><a href="../register/login.php">登录</a><li>
        </ul> 
    </div> 
    </div> 
</nav>


<table class="table table-hover"> 
    <caption><h2><?php echo $get;?>的信息</h2></caption> 
    <tbody> 

<?php

        $sql = "select why,intro from info where name='".$get."'";
    
    //echo $sql;
    $result = mysqli_query($conn, $sql);
    $myrow = mysqli_fetch_array($result);
    mysqli_data_seek($result,0);  //指针复位 需要研究
    $nums = mysqli_num_fields($result);//获取字段数


    while($myrow = mysqli_fetch_row($result)){
        for ( $m = 0 ; $m < $nums ; $m++ ){
            if($m == 0){
                echo "<tr><td>介绍一</td>";
            }else{
                echo "<tr><td>介绍二</td>";
            }
                    echo "<td>".$myrow[$m]."</td></tr>";
                
        }
    }

    $sql_ = "select interviewee, cmt from cmt where name='".$get."'";
        //echo $sql_;
        $result_ = mysqli_query($conn, $sql_);
        //$myrow_ = mysqli_fetch_array($result_);
        mysqli_data_seek($result_,0);  //指针复位 需要研究
        $nums_ = mysqli_num_fields($result_);//获取字段数
        while ( $myrow_ = mysqli_fetch_row($result_)) {
            echo "<tr>";
            for ($i=0; $i < $nums_; $i++) { 
                echo "<td>".$myrow_[$i]."</td>";
            }
            echo "</tr>";
        }

    //echo '<tr><td><a href="exe.php?no='.$no.'eid=y&name='.$get.'"><button type="button" class="btn btn-success">提交订单</button></a></td>';
    //echo '<td><a href="exe.php?no='.$no.'eid=n&name='.$get.'"><button type="button" class="btn btn-danger">取消订单</button></a></td></tr>';

?>
        
    </tbody> 
</table>
</body>
<hr color=#ccc width=61.8% />
<h6>Copyright © 2016 <a href='http://blog.defjia.top'>DefJia</a>. All rights reserved. </h6>
</html>