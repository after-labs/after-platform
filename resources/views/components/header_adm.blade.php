<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header adm</title>
    @vite(["resources/css/components/header_adm.css"])

</head>
<body>

    <header class="main-header">
        <div class="container">
            <!-- Logo -->
            <div class="logo">
                 <img src="{{ asset('icons/after-logomarca-branco.svg') }}" alt="After Logo"> 
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
                <button class="icon-btn"><img src="{{  asset('icons/bell-icon.svg') }}" alt="Notifications"></button>
                <button class="icon-btn"><img src="{{ asset('icons/user-icon.svg') }}" alt="User"></button>
            </div>
        </div>
    </header>
