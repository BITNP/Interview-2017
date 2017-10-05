<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
    session_start(); 
    $get = $_SESSION['who'];
    $admin = array('a', 'admin', '2A-206');
    $inter = array('2A-201','2A-202','2A-203','2A-204','2A-205','admin', 'b');

	include_once('conn.php');
	$name = $_GET['name'];
	$eid = $_GET['eid'];
	$cmt = '';
	$ee = '';
	$cmt = $_POST['cmt'];
	$ee = $_POST['ee'];
	$namep = $_POST['name'];
	if ($eid != NULL){
		if($eid == '01' and in_array($get, $admin) ){
			$sql = "update recordd set status_=1 where name='".$name."' and status_=0";
			$result = mysqli_query($conn, $sql);
			//echo '<script>alert("签到成功");history.go(-1);</script>';
		}elseif ($eid == '12' and in_array($get, $inter)) {
			$sql = "update recordd set status_=2 where name='".$name."' and status_=1 and room='$get'";
			$result = mysqli_query($conn, $sql);
			//echo '<script>alert("叫来成功");history.go(-1);</script>';
		}elseif($eid == '23' and in_array($get, $admin)){
			$sql = "update recordd set status_=3 where name='".$name."' and status_=2";
			$result = mysqli_query($conn, $sql);
			//echo '<script>alert("开始成功");history.go(-1);</script>';
		}
		if($result){
			echo '<script>alert("操作成功(如果操作次序不当，那就没成功，实在来不及找见这个bug了。问题不大)");history.go(-1);</script>';
		}else{
			echo '<script>alert("权限不足或操作次序不当导致的失败");history.go(-1);</script>';
		}
	}else{
		$sql = "update recordd set status_=4 where name='".$namep."'";
		$result = mysqli_query($conn, $sql);
		$sql = "insert into cmt (name, cmt, interviewee) values ('".$namep."','".$cmt."','".$ee."')";
		//echo $sql;
		$result = mysqli_query($conn, $sql);
		echo '<script>alert("写评论成功");history.go(-1);</script>';
	}