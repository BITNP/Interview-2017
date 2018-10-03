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

}

class Auth{
    var $user;

    function judgeUser(){
        global $admin;
        global $dpt_name;
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
    var $auth;

    function echoHead(){
        $head = sprintf('<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><head><title>%s</title><link rel="stylesheet" href="../bootstrap/bootstrap.min.css"><script src="../bootstrap/jquery.min.js"></script><script src="../bootstrap/bootstrap.min.js"></script><style>body{background-color:#D4EEC9;text-align:center;}caption,th,td{text-align:center;}</style></head>', $this->title);
        return $head;
    }

    function echoNav(){
        $nav = sprintf('<nav class="navbar navbar-default" role="navigation"><div class="container-fluid"><div class="navbar-header"><a class="navbar-brand" href="../paris/index.php">网协分赃系统V2.0</a></div><div><ul class="nav navbar-nav"><li><a href="../paris/wait.php">可选列表</a><li><li><a href="../paris/pick.php">捡漏队列</a></li><li><a href="../paris/already.php">已录取名单</a><li><li><a href="../register/login.php">登录</a><li></ul></div></div></nav>
');
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
        global $dpt_name;
        global $admin;
        $limit = array();
        switch (array_search($this->title, $titles)) {
            case 'index':{
                $limit[0] = '(b.status < 0 or b.status > 3)';
                break;
            }
            case 'wait':{
                if (in_array($this->auth, $dpt_name)) {
                    $dpt = $dpt_name[$this->auth];
                    $ordinal_numeral = array('first', 'second', 'third');
                    for($i = 0; $i < 3; $i++)
                        $limit[$i] = sprintf('b.status = %d and %s = %s',4+$i, $ordinal_numeral[$i], $dpt);
                } else return 0;
                break;
            }
            case 'pick':{
                if (in_array($this->auth, array_merge($dpt_name, $admin))){
                    $limit[0] = 'b.status = 7';
                } else return 0;
                break;
            }
            case 'already':{
                if (in_array($this->auth, $dpt_name)) {
                    // $dpt = $dpt_name[$this->auth];
                    $index = 0 - array_search($this->auth, $dpt_name);
                    $limit[0] = sprintf('b.status = %d', $index);
                } else return 0;
                break;
            }
        }
        return $limit;
    }

    function generateButton(){
        // needs title and id;
        // generate status info actions
        return '';
    }

    function getData($limit){
        global $config;
        $sql_base = 'select a.name, a.sex, a.phone, a.major, a.first, a.second, a.third, a.is_, a.id, b.status from info a LEFT JOIN record b ON a.id = b.id';
        $content = '';
        for($i = 0; $i < count($limit); $i++){
            $sql = sprintf('%s where %s', $sql_base, $limit[$i]);
            $result = mysqli_query($config, $sql);
            $rows = mysqli_num_rows($result);
            $columns = mysqli_num_fields($result);
            $raw_content = mysqli_fetch_all($result);
            $content = '';
            for($j = 0; $j < $rows; $j++){
                $row = '';
                $cur = $raw_content[$j];
                for($k = 0; $k < $columns-2; $k++)
                    $row .= sprintf('<td>%s</td>', $cur[$k]);
                $row = sprintf('<tr>%s%s</tr>', $row, $this->generateButton());
                $content .= $row;
            }
            mysqli_free_result($result);
            return $content;
        }
    }

    function echoTbody(){
        $content = $this->getData($this->generateSQL());
        $tbody = sprintf('<tbody>%s</tbody>', $content);
        return $tbody;
    }

    function echoTable(){
        $caption = sprintf('<caption><h2>%s</h2></caption>', $this->title);
        $thead = $this->echoThead();
        $tbody = $this->echoTbody();
        $table = sprintf('<div class="container"><table class="table table-hover">%s%s%s</table></div>', $caption, $thead, $tbody);
        return $table;
    }

    function echoFooter(){
        $footer = '<hr color=#ccc width=61.8% /><h4>Copyright © 2018 <a href="https://www.bitnp.net">BITNP</a> & <a href="https://github.com/DefJia">DefJia</a>. All rights reserved. </h4>';
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
        $this->title = $titles[$this->title];
        $head = $this->echoHead();
        $body = $this->echoBody();
        $page = sprintf('<!DOCTYPE><html>%s%s</html>', $head, $body);
        echo $page;
        mysqli_close($config);
    }
}