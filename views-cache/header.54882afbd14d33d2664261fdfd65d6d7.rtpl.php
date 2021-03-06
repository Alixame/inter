<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> LUMIRA | PAINEL </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/resources/admin/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- AdminLTE style -->
  <link rel="stylesheet" href="/resources/admin/dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="/resources/admin/dist/css/skins/skin-blue.css">
  <link rel="stylesheet" href="/resources/admin/dist/css/styles.css">
  
</head>

<body class="hold-transition skin-blue sidebar-mini ">
<div class="wrapper">

  <header class="main-header">

    <a href="/admin" class="logo">
      <span class="logo-mini"></span>
      <span class="logo-lg"><img src="/resources/img/logo_text.png" width="100"></span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Botão de Navegação</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <li class="dropdown notifications-menu">           
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">5</span>
            </a>

            <ul class="dropdown-menu">
              <li class="header">Você tem 5 notificações novas</li>
              
              <li>
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 novos clientes
                    </a>
                  </li>
                </ul>
              </li>

              <li class="footer"><a href="#">Ver tudo</a></li>
              
            </ul>
          </li>

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/resources/img/profiles/default.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo getUserName(); ?></span>
            </a>

            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="/resources/img/profiles/default.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo getUserName(); ?>

                </p>
              </li>
    
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="/admin/logout" class="btn btn-default btn-flat">Sair</a>
                </div>
              </li>
            </ul>
          </li>

          <li>
            <a href="#"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
          </li>

        </ul>
      </div>
    </nav>
  </header>

  <aside class="main-sidebar">

    <section class="sidebar">

      <div class="user-panel">
        <div class="pull-left image">
          <img src="/resources/img/profiles/default.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo getUserName(); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <ul class="sidebar-menu">
        <li class="header">AÇÕES</li>

        <li><a href="/admin/users"><i class="fa fa-users"></i> <span>Usuarios</span></a></li>
        <li><a href="/admin/messages"><i class="fa fa-comment"></i> <span>Mensagens de Clientes</span></a></li>
        <li><a href="/admin/devices"><i class="fa fa-lightbulb-o" aria-hidden="true"></i> <span> Dispositivos</span></a></li>
        <li><a href="/admin/rooms"><i class="fa fa-home" aria-hidden="true"></i> <span>Comodos</span></a></li>
    
    <!--<li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li>-->
        
      </ul>

    </section>
  </aside>