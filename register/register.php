
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
<script src="../bootstrap/jquery.min.js"></script>
<script src="../bootstrap/bootstrap.min.js"></script>

<div class="container" style="margin-top: 10vh;">
<form class="form-horizontal" role="form" action="regcheck.php" method="post">
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">用户名</label>
    <div class="col-sm-10">
      <input type="text" name="username" class="form-control" id="firstname" placeholder="">
    </div>
  </div>
  <div class="form-group">
    <label for="firstname1" class="col-sm-2 control-label">密码</label>
    <div class="col-sm-10">
      <input type="password" name="password" class="form-control" id="firstname1" placeholder="">
    </div>
  </div>
  
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">确认密码</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="confirm"  id="lastname" >
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="Submit" value="注册" class="btn btn-default">注册</button>
    </div>
  </div>
</form>

</div>