<?php
$host = "localhost";
$user = "";
$pwd = "";
$db_name = "bitnpInterview";
$config = mysqli_connect($host, $user, $pwd, $db_name);
mysqli_query($config, "set names 'utf8'");

$admin = array('defjia', 'admin');
$waiting_room = array('2B-501');
$interview_room = array('2B-503', '2B-504', '2B-505');

$info_field = array('姓名', '性别', '手机号码', '专业', '第一志愿', '第二志愿', '第三志愿', '自我介绍', '加入网协原因', '是否服从调剂', '出生日期', 'QQ号', '微信号');
$status_code = array('没来', '候场', '准备出发', '面试中', '结束');
$status_color = array('default', 'primary', 'danger', 'info', 'success');

$current_date = '2018/9/26';
