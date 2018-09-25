<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
include_once("config.php");
    $get = $_GET['name'];
    //if ($get != NULL){
        //$sql = "update record+ set status_=3 where name='".$get."'";
       // $result = mysqli_query($config, $sql);
    //}
?>
<head>
<title>给<?php echo $get;?>写评论</title>
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
    <caption><h2>给<?php echo $get;?>写评论</h2></caption> 
    <h1>人走以后再提交！EVERYONE！</h1>
        <form action='exe.php' method='post' role="form">
          <div class="form-group">
            <label for="ee" class="col-sm-2 control-label">面试官</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="ee" name="ee" placeholder="请输入名字">
            </div>
          </div>
          <div class="form-group">
            <label for="cmt" class="col-sm-2 control-label">评论</label>
            <div class="col-sm-10">
                <textarea class="form-control" name='cmt' rows="5"></textarea>
              <!--
              <input type="text" class="form-control" id="cmt" name="cmt" placeholder="请输入评论">
          -->
              <?php 
                    echo '<input name="name" value="'.$get.'" type="hidden">';
              ?>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">提交</button>
            </div>
          </div>
        </form>

</table>
</body>
<hr color=#ccc width=61.8% />
<h6>Copyright © 2016 <a href='http://blog.defjia.top'>DefJia</a>. All rights reserved. </h6>
</html>