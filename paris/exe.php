<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
    session_start(); 
    $get = $_SESSION['who'];
    $a1 = array('tec' => '技术部', 
                'net' => '网络部',
                'org' => '组织部',
                'media' => '数字媒体部',
                'clinic' => '电脑诊所',
                'defjia' => 'test');
    $a2 = array('tec' => 5,
                'net' => 6,
                'media' => 7,
                'clinic' => 8,
                'org' => 9,
                'defjia' => 4);
    $dpm = $a1[$get];
    $no = $a2[$get];

	include_once('conn.php');
	$name = $_GET['name'];
	$eid = $_GET['eid'];
echo $eid;
echo $name;
echo $no;
	if ($eid != NULL || $name != NULL || $no != NULL){
		if($eid == 'y'){
			$sql = "update info_ set status_ = '$no' where name='$name'";
			$result = mysqli_query($conn, $sql);
			echo "<script>alert('下单成功'".$sql.");history.go(-1);</script>";

		}elseif($eid == 'n'){
			$sql = "update info_ set status_ = status_ - 1 where name='$name'";
			$result = mysqli_query($conn, $sql);
			echo '<script>alert("取消成功");history.go(-1);</script>';
		}else{
			echo '<script>alert("提交没成功");history.go(-1);</script>';
		}
	}else{
		echo '<script>alert("有点问题");history.go(-1);</script>';
	}

?>