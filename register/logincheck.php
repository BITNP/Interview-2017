<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php  
    if(isset($_POST["submit"]) && $_POST["submit"] == "登陆")  
    {  
        $user = $_POST["username"];  
        $psw = $_POST["password"];  
        //$hash = password_hash($psw, PASSWORD_DEFAULT);
        if($user == "" || $psw == "")  
        {  
            echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";  
        }  
        else  
        {  
            include_once('../conn.php');  //连接数据库  
            $sql = "select password from user where username = '$_POST[username]'";  
            $result = mysqli_query($conn, $sql);  
            $row = mysqli_fetch_array($result);  
            $is_ = password_verify($psw, $row[0]);
            if($is_)  
            {  
                session_start();
                $_SESSION['who'] = $user;
                echo $_SESSION['who'];
                echo '注册成功';
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