<?php
session_start();
// 存储 session 数据
$get = $_GET['key'];
$_SESSION['room']=1;
?>

<html>
<head>
<meta charset="utf-8">
<title>注册界面</title>
</head>
<body>
<?php
// 检索 session 数据
echo "<h1>注册地点为：". $_SESSION['room']."</h1>";
?>

</body>
</html>