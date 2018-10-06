<?php
/**
 * Created by PhpStorm.
 * User: defjia
 * Date: 18-9-24
 * Time: 上午12:49
 */
error_reporting(0);
$host = "localhost";
$user = "";
$pwd = "";
$db_name = "bitnpInterview";
$config = mysqli_connect($host, $user, $pwd, $db_name);
mysqli_query($config, "set names 'utf8'");


$admin = array('defjia', 'admin', 'Defjia');
$waiting_room = array('2B-501');
$interview_room = array('2B-503', '2B-504', '2B-505');
// $interview_users = array_merge($admin, $waiting_room, $interview_room);

$info_field = array('序号', '姓名', '性别', '手机号码', '专业', '第一志愿', '第二志愿', '第三志愿', '自我介绍', '加入网协原因', '是否服从调剂', '出生日期', 'QQ号', '微信号');
$status_code = array('没来', '候场', '准备出发', '面试中', '结束');
$status_color = array('default', 'primary', 'danger', 'info', 'success');

$current_date = '2018/9/26';

/*
 * The above is configure of interview system.
 */

$titles = array("index"=>"网协面试录取系统", "wait"=>"可选列表", "pick"=>"捡漏队列", "already"=>"已录取名单");
$paris_fields = array('姓名', '性别', '手机号码', '专业', '第一志愿', '第二志愿', '第三志愿', '是否服从调剂', '录取状态', '信息', '操作');
/*
 * 不同页面的操作按钮
 * index 空
 * wait 录取/不录取
 * pick 录取
 * already 不录取
 */
$dpt_name = array('net' => '网络部', 'tech' => '技术部', 'clinic' => '电脑诊所', 'dm' => '数字媒体', 'org' => '组织部');
$dpt_user = array('net', 'tech', 'clinic', 'dm', 'org');




