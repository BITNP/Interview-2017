<?php include_once('../header.php'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php  
    if(isset($_POST["submit"]) && $_POST["submit"] == "登陆")  
    {  
        $user_ = $_POST["username"];
        $psw = $_POST["password"];  
        //$hash = password_hash($psw, PASSWORD_DEFAULT);
        if($user_ == "" || $psw == "")
        {  
            echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";  
        }  
        else  
        {  
            include_once('../config.php');  //连接数据库  
            $sql = "select password from user where username = '$_POST[username]'";
            $result = mysqli_query($config, $sql);  
            $row = mysqli_fetch_array($result);  
            $is_ = password_verify($psw, $row[0]);
            if($is_)  
            {  
                session_start();
                $_SESSION['who'] = $user_;
                echo '<script>alert("登陆成功");window.location="../index.php";</script>';
            }  
            else  
            {  
                echo "<script>alert('用户名或密码不正确！');history.go(-1);</script>";  
            }  
        }  
    }  
    else  
    {  
        echo "<script>alert('提交未成功！'); history.go(-1);</script>";
    }  
  
?>  
