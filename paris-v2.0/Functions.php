<?php
/**
 * Created by PhpStorm.
 * User: defjia
 * Date: 18-10-3
 * Time: 下午11:33
 */
session_start();
include_once('../config.php');
// global variates

class Execute{
    var $user;
    var $id;
    var $title;
    function __construct($user, $id, $title){
        $this->user = $user;
        $this->id = $id;
        $this->title = $title;
    }
    function updateDB(){
        global $config;
        $this->id = (int)$this->id;
        $dpt_name = array('net', 'tech', 'clinic', 'dm', 'org');
        if(in_array($this->user, $dpt_name)) {
            if ($this->id > 0) {
                // id > 0 => enroll
                $new_status = 8 + array_search($this->user, $dpt_name);
                $sql = sprintf('update record set status = %d where id = %d', $new_status, $this->id);
            } else {
                // not enroll
                if($this->title != 'already')
                    $sql = sprintf('update record set status = status + 1 where id = %d', 0 - $this->id);
                else
                    $sql = sprintf('update record set status = 7 where id = %d', 0 - $this->id);
            }
            $result = mysqli_query($config, $sql);
            $result = mysqli_fetch_array($result);
            return $result[0];
        } else{
            return null;
        }
    }
}

class Auth{
    var $user;
    function __construct($user){
        $this->user = $user;
    }
    function judgeUser(){
        global $admin;
        $dpt_name = array('net', 'tech', 'clinic', 'dm', 'org');
        if (!$this->user) return null;
        else{
            if(in_array($this->user, $admin))
                return 'admin';
            elseif (in_array($this->user, $dpt_name))
                return $this->user;
            else
                return 'visitor';
        }
    }
}


class Page{
    var $title;
    var $user;
    function __construct($title, $user){
        $this->title = $title;
        $this->user = $user;
    }

    function echoHead(){
        global $titles;
        $head = sprintf('<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><head><title>%s</title><link rel="stylesheet" href="../bootstrap/bootstrap.min.css"><script src="../bootstrap/jquery.min.js"></script><script src="../bootstrap/bootstrap.min.js"></script><script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.0.js"></script><style>body{background-color:#D4EEC9;text-align:center;}caption,th,td{text-align:center;}</style></head>', $titles[$this->title]);
        return $head;
    }

    function echoNav(){
        $current_user = $this->user == '' ? '': sprintf('(当前用户:%s)', $this->user);
        $nav = sprintf('<nav class="navbar navbar-default" role="navigation"><div class="container-fluid"><div class="navbar-header"><a class="navbar-brand" href="../paris-v2.0/index.php">网协分赃系统V2.0</a></div><div><ul class="nav navbar-nav"><li><a href="../paris-v2.0/wait.php">可选列表</a><li><li><a href="../paris-v2.0/pick.php">捡漏队列</a></li><li><a href="../paris-v2.0/already.php">已录取名单</a><li><li><a href="../register/login.php">登录%s</a><li></ul></div></div></nav>', $current_user);
        return $nav;
    }

    function echoThead(){
        global $paris_fields;
        $ths = '';
        for($i = 0; $i < count($paris_fields); $i++)
            $ths .= sprintf('<th>%s</th>', $paris_fields[$i]);
        $thead = sprintf('<thead>%s</thead>', $ths);
        return $thead;
    }

    function generateSQL(){
        global $titles;
        global $dpt_user;
        global $dpt_name;
        global $admin;
        $limit = array();
        switch ($this->title) {
            case 'index':{
                $limit[0] = '(b.status < 0 or b.status > 3)';
                break;
            }
            case 'wait':{
                if (in_array($this->user, $dpt_user)) {
                    $dpt = $dpt_name[$this->user];
                    $ordinal_numeral = array('first', 'second', 'third');
                    for($i = 0; $i < 3; $i++){
                        $limit[$i] = sprintf('b.status = %d and %s = "%s"',4+$i, $ordinal_numeral[$i], $dpt);
                    }
                } else return 0;
                break;
            }
            case 'pick':{
                if (in_array($this->user, array_merge($dpt_user, $admin))){
                    $limit[0] = 'b.status = 7';
                } else return 0;
                break;
            }
            case 'already':{
                if (array_key_exists($this->user, $dpt_name)) {
                    // $dpt = $dpt_name[$this->user];
                    $index = 8 + array_search($this->user, $dpt_user);
                    $limit[0] = sprintf('b.status = %d', $index);
                } else return 0;
                break;
            }
            default:{
                break;
            }
        }
        return $limit;
    }

    function generateButton($id, $status){
        // needs title and id and status;
        // generate status, info, actions
        // Prepare
        $enroll_info = array('等待第一志愿', '等待第二志愿', '等待第三志愿', '落选-等待捡漏', '网络部录取', '技术部录取', '电脑诊所录取', '树莓录取', '组织部录取');
        $enroll_style = array('default', 'primary', 'warning', 'danger', 'success', 'success', 'success', 'success', 'success');
        $enroll_button = sprintf("<td><button type='button' class='btn btn-%s'>%s</button></td>", $enroll_style[$status-4], $enroll_info[$status-4]);
        // Enroll button above.
        $info_button = sprintf("<td><a href='../info.php?id=%d'><button type='button' class='btn btn-info'>信息</button><a></td>", $id);
        // Info button above
        $enroll_action = sprintf('<a href="" class="a_post"><button type="button" class="btn btn-success" id=%d>录取</button></a>', $id);
        $not_enroll_action = sprintf('<a href="" class="a_post"><button type="button" class="btn btn-danger" id=%d>删除</button></a>', 0-$id);
        switch ($this->title){
            case 'index':{
                $enroll_action = $not_enroll_action = ''; break;
            }
            case 'pick':{
                $not_enroll_action = ''; break;
            }
            case 'already':{
                $enroll_action = ''; break;
            }
            default:{
                break;
            }
        }
        $action_buttons = sprintf("<td>%s%s</td>", $enroll_action, $not_enroll_action);
        // Enroll button above;
        $all_button = sprintf("%s%s%s", $enroll_button, $info_button, $action_buttons);
        return $all_button;
    }

    function getData($limit){
        global $config;
        $sql_base = 'select a.id, a.name, a.sex, a.phone, a.major, a.first, a.second, a.third, a.is_, a.id, b.status from info a LEFT JOIN record b ON a.id = b.id';
        $content_all = '';
        for($i = 0; $i < count($limit); $i++){
            $sql = sprintf('%s where %s', $sql_base, $limit[$i]);
            $result = mysqli_query($config, $sql);
            $content = '';
            if($result){
                $rows = mysqli_num_rows($result);
                $columns = mysqli_num_fields($result);
                $raw_content = mysqli_fetch_all($result);
                for($j = 0; $j < $rows; $j++){
                    $row = '';
                    $cur = $raw_content[$j];
                    for($k = 0; $k < $columns-2; $k++)
                        $row .= sprintf('<td>%s</td>', $cur[$k]);
                    $row = sprintf('<tr>%s%s</tr>', $row, $this->generateButton($cur[$columns-2], $cur[$columns-1]));
                    // echo $raw_content[$columns-1];
                    $content .= $row;
                }
                mysqli_free_result($result);
            }
            $content_all .= $content;
        }
        return $content_all;
    }

    function echoTbody(){
        $content = $this->getData($this->generateSQL());
        $tbody = sprintf('<tbody>%s</tbody>', $content);
        return $tbody;
    }

    function echoTable(){
        global $titles;
        $caption = sprintf('<caption><h2>%s</h2></caption>', $titles[$this->title]);
        $thead = $this->echoThead();
        $tbody = $this->echoTbody();
        $table = sprintf('<div class="container"><table class="table table-hover">%s%s%s</table></div>', $caption, $thead, $tbody);
        return $table;
    }

    function echoFooter(){
        $footer = '<hr color=#ccc width=61.8% /><h4>Copyright © 2018 <a href="https://www.bitnp.net">BITNP</a> & <a href="https://github.com/DefJia">DefJia</a>. All rights reserved. </h4><script>$(document).ready(function(){$(".a_post").on("click",function(event){event.preventDefault();$.post("",{id:event.target.id},function(){alert("操作成功！");location.reload();});});});</script>';
        return $footer;
    }

    function echoBody(){
        $nav = $this->echoNav();
        $table = $this->echoTable();
        $footer = $this->echoFooter();
        $body = sprintf('<body>%s%s%s</body>', $nav, $table, $footer);
        return $body;
    }

    function echoPage(){
        global $config;
        global $titles;
        $head = $this->echoHead();
        $body = $this->echoBody();
        $page = sprintf('<!DOCTYPE><html>%s%s</html>', $head, $body);
        echo $page;
        mysqli_close($config);
    }
}
