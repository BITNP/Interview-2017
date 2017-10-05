<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">  
   <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>



<h1>没有密码找贾老板</h1>
<div class='container'>
<form class="form-horizontal" role="form" action="logincheck.php" method="post">	
  
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">用户名</label>
    <div class="col-sm-10">
      <input type="text" name="username" class="form-control" id="firstname" placeholder="">
    </div>
  </div>

  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">密码</label>
    <div class="col-sm-10">
      <input type="password" name="password" class="form-control" id="firstname" placeholder="">
    </div>
  </div>
<!--
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label"密码</label>
    <div class="col-sm-10">
      <input type="password" name="password" class="form-control" id="lastname" placeholder="">
    </div>
  </div>
-->
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" name="submit" value="登陆" class="btn btn-default"/>
    </div>
  </div>

</form>
</div>