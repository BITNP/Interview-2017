<?php include_once('header.php');?>
<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
include_once("config.php");
    $id = $_GET['id'];
    $sql = sprintf("select * from info where id=%d", $id);
    $result = mysqli_query($config, $sql);
    $nums = mysqli_num_fields($result);
    $result = mysqli_fetch_array($result);
    $name = $result[1];
?>
<head>
<title><?php echo $name;?>的信息</title>
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
            <li><a href="waiting.php">候场界面</a></li>
        </ul> 
    </div> 
    </div> 
</nav>

<div class="container" style="width: 61.8%">
<table class="table table-hover"> 
    <caption><h2><?php echo $name;?>的信息</h2></caption>
    <thead><th>类别</th><th>信息</th></thead>
    <tbody>
<?php
    for($i = 0; $i < $nums-1; $i++){
        $info = sprintf("<tr><td>%s</td><td>%s</td></tr>", $info_field[$i], $result[$i]);
        echo $info;
    }
?>
    </tbody>
</table>

<form action='exe.php' method='post' role="form">
    <h1>请各位面试结束后再提交:-)</h1>
    <div class="form-group">
        <label for="ee" class="col-sm-2 control-label">面试官</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="ee" name="ee" placeholder="请输入自己的名字" required="required">
        </div>
    </div>
    <div class="form-group" >
        <label for="cmt" class="col-sm-2 control-label" style="margin-top: 2vh;">评论</label>
        <div class="col-sm-10" style="margin-top: 2vh;">
            <textarea class="form-control" name='cmt' rows="5" placeholder="请输入对<?php echo $name; ?>的评价" required="required"></textarea>
            <?php
            echo '<input name="id" value="'.$id.'" type="hidden">';
            echo '<input name="name" value="'.$name.'" type="hidden">';
            ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default" style="margin-top: 2vh;">我是一个丑陋的提交按钮</button>
        </div>
    </div>
    </form>
</div>
</body>
<?php include_once ('footer.html');?>
</html>
