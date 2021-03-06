<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUMIRA | AUTOMAÇÃO</title>
    <link rel="stylesheet" href="../../resources/css/home.css">
</head>
<body>
    <!-- HEADER -->
    <header id="header">
        <a href="/" class="logo font-logo">LUMIRA</a>
        <ul>
            <li><a href="#home" onclick="toggle()"><ion-icon name="home-outline"></ion-icon> Home</a></li>
            <li><a href="#about" onclick="toggle()"><ion-icon name="business-outline"></ion-icon> Sobre</a></li>
            <li><a href="#services" onclick="toggle()"><ion-icon name="briefcase-outline"></ion-icon> Serviços</a></li>
            <li><a href="#portfolio" onclick="toggle()"><ion-icon name="images-outline"></ion-icon> Portfolio</a></li>
            <li><a href="#team" onclick="toggle()"><ion-icon name="id-card-outline"></ion-icon> Time</a></li>
            <li><a href="#contact" onclick="toggle()"><ion-icon name="call-outline"></ion-icon> Contatos</a></li>
            <li><a href="/login" onclick="toggle()"><ion-icon name="log-in-outline"></ion-icon> Entrar</a></li>
        </ul>
        <div class="toggle" onclick="toggle()"></div>
    </header>