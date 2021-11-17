<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> LUMIRA | LOGIN </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/resources/admin/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/resources/admin/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/resources/admin/plugins/iCheck/square/blue.css">
  
  <link rel="stylesheet" href="/resources/site/css/style.css">

</head>
<body class="hold-transition login-page backgound-page">
<div class="login-box">
  <div  class="text-center">
    <img src="/resources/img/logo.png" width="120">
  </div>
  <div class="login-logo">
    <a href=""><strong>LUMIRA LOGIN</strong> </a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    
    <a href="/"><img src="/resources/img/back.svg" width="30"></a>

    <p class="login-box-msg">Acesse o Painel Administrativo</p>

    <form action="/admin/login" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Login" name="login">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Senha" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <div>
          <div class="checkbox icheck">
            <label class="col-md-12" style="align-self: center; text-align: center; align-items: center;">
              <input type="checkbox"> Lembrar-me 
            </label>
          </div>
        </div>

        <div>
          <label class="col-xs-12" style="align-self: center; text-align: center; align-items: center; margin-top: 10px;">
            <a href="/admin/forgot">Esqueci minha senha! </a>
          </label>
        </div>

        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">ENTRAR</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="/resources/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/resources/admin/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="/resources/admin/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
