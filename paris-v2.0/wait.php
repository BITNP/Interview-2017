<?php
/**
 * Created by PhpStorm.
 * User: defjia
 * Date: 18-10-3
 * Time: 上午12:01
 */
include_once('Functions.php');

$user = $_SESSION['who'];
$post = $_POST['id'];
$title = 'wait';

if($post){
    $exe = new Execute($user, $post, $title);
    $res = $exe->updateDB();
} else{
    $auth = new Auth($user);
    $page = new Page($title, $auth->judgeUser());

    $page->echoPage();
}
