<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header adm</title>
    <link rel="stylesheet" href="/css/header_adm.css">
    <link rel="stylesheet" href="/css/global.css">

</head>
<body>

    <header class="main-header">
        <div class="container">
            <!-- Logo -->
            <div class="logo">
                 <img src="/icons/after_logomarca_branco.svg" alt="After Logo"> 
            </div>

            <!-- Navegação Central -->
            <nav class="nav-menu">
                <ul>
                    <li><a href="#">{{ __('Users') }}</a></li>
                    <li><a href="#">{{ __('Games') }}</a></li>
                    <li><a href="#">{{ __('Orders') }}</a></li>
                </ul>
            </nav>

            <!-- Ícones da Direita -->
            <div class="user-actions">
                <button class="icon-btn"><img src="/icons/notifications.svg" alt="Notifications"></button>
                <button class="icon-btn"><img src="/icons/user.svg" alt="User"></button>
            </div>
        </div>
    </header>
