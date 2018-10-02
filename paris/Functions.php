<?php
/**
 * Created by PhpStorm.
 * User: defjia
 * Date: 18-10-2
 * Time: 下午11:33
 */
include_once ('../config.php');
// global variates

class getInfo{

}

class Auth{

}


class Page{

    function echoHead($title){
        global $titles;
        $head = sprintf('<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><head><title>%s</title><link rel="stylesheet" href="../bootstrap/bootstrap.min.css"><script src="../bootstrap/jquery.min.js"></script><script src="../bootstrap/bootstrap.min.js"></script><style>body{background-color:#D4EEC9;text-align:center;}caption,th{text-align:center;}</style></head>', $titles[$title]);
        return $head;
    }

    function echoNav(){
        $nav = sprintf('<nav class="navbar navbar-default" role="navigation"><div class="container-fluid"><div class="navbar-header"><a class="navbar-brand" href="index.php">网协分赃系统V1.1</a></div><div><ul class="nav navbar-nav"><li><a href="wait.php">可选列表</a><li><li><a href="pick.php">捡漏队列</a></li><li><a href="already.php">已录取名单</a><li><li><a href="../register/login.php">登录</a><li></ul></div></div></nav>
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

    function echoTbody(){
        $tbody = sprintf('<tbody></tbody>');
        return $tbody;
    }

    function echoTable(){
        $thead = $this->echoThead();
        $tbody = $this->echoTbody();
        $table = sprintf('<div class="container"><table class="table table-hover">%s%s</table></div>', $thead, $tbody);
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

    function echoPage($title){
        $head = $this->echoHead($title);
        $body = $this->echoBody();
        $page = sprintf('<!DOCTYPE><html>%s%s</html>', $head, $body);
        echo $page;
    }
}