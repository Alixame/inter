<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LUMIRA | AUTOMAÇÃO</title>
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
<body class="hold-transition login-page backgound-login">

    <div class="login-box">
        <div  class="text-center">
          <img src="/resources/img/logo.png" width="120">
        </div>
        <div class="login-logo">
          <a href=""><strong>Mensagem Enviada</strong> </a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
          <a href="/"><img src="/resources/img/back.svg" width="30"></a>
      
          <p class="login-box-msg">Recebemos a mensagem com sucesso!</p>
            
          <br>
          
            <div class="alert alert-success" role="alert">
                <span>Agradecemos pelo contato, aguarde que logo iremos responde-lo.</span>
            </div>   

        <br>
          
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

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

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