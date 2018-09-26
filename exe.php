<?php include_once('header.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
    session_start(); 
    $get = $_SESSION['who'];

	include_once('config.php');
	$name = $_GET['id'];
	$eid = $_GET['eid'];
	$cmt = '';
	$ee = '';
	$id = $_POST['id'];
	$cmt = $_POST['cmt'];
	$ee = $_POST['ee'];
	$namep = $_POST['name'];
	$waiting = array_merge($waiting_room, $admin);
	$interview = array_merge($interview_room, $admin);
	if ($eid != NULL){
		if($eid == '01' and in_array($get, $waiting) ){
		    $current_status = 0;
		    $sql = sprintf("update record set status=%d where id=%d and status=%d", $current_status+1, $name, $current_status);
			$result = mysqli_query($config, $sql);
			// 有点不太明白为什么没有影响任何一行，$result还是1呢。
			if($result) echo '<script>alert("签到成功");history.go(-1);</script>';
            else echo '<script>alert("权限不足或操作次序不当，导致操作失败！");history.go(-1);</script>';
		}elseif ($eid == '12' and in_array($get, $interview)) {
            $current_status = 1;
            $sql = sprintf("update record set status=%d where id=%d and status=%d", $current_status+1, $name, $current_status);
			$result = mysqli_query($config, $sql);
            if($result) echo '<script>alert("已让候场教室安排");history.go(-1);</script>';
            else echo '<script>alert("权限不足或操作次序不当，导致操作失败！");history.go(-1);</script>';
		}elseif($eid == '23' and in_array($get, $waiting)){
            $current_status = 2;
            $sql = sprintf("update record set status=%d where id=%d and status=%d", $current_status+1, $name, $current_status);
			$result = mysqli_query($config, $sql);
            if($result) echo '<script>alert("安排好了");history.go(-1);</script>';
            else echo '<script>alert("权限不足或操作次序不当，导致操作失败！");history.go(-1);</script>';
		} else{
            echo '<script>alert("权限不足或操作次序不当，导致操作失败");history.go(-1);</script>';
        }
		/*
		if($result){
			echo '<script>alert("操作成功(如果操作次序不当，那就没成功，实在来不及找见这个bug了。问题不大)");history.go(-1);</script>';
		}else{
			echo '<script>alert("权限权限不足或操作次序不当，导致操作失败！");history.go(-1);</script>';
		}
		*/
	}else{
		$sql = "update record set status=4 where id='".$id."'";
		$result = mysqli_query($config, $sql);
		$sql = "insert into cmt (name, cmt, interviewee) values ('".$namep."','".$cmt."','".$ee."')";
		$result = mysqli_query($config, $sql);
		echo '<script>alert("写评论成功");history.go(-2);</script>';
	}
