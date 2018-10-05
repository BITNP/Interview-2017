<?php
/**
 * Created by PhpStorm.
 * User: defjia
 * Date: 18-10-6
 * Time: 上午3:59
 */
include_once('Functions.php');

$user = $_SESSION['who'];
$post = $_POST['id'];
$title = 'already';

if($post){
    $exe = new Execute($user, $post, $title);
    $res = $exe->updateDB();
} else{
    $auth = new Auth($user);
    $page = new Page($title, $auth->judgeUser());

    $page->echoPage();
}
