<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Билетикус</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/fonts.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="/css/<?= /** @var string $view */
    $view ?>.css">
</head>
<body>
<div class="wrapper">
    <header class="header">
        <div class="container">
            <nav class="header__nav">
                <a href="/" class="header__logo__link">
                    <div class="header__logo">
                        <div class="header__logo__text">
                            Билетикус
                        </div>
                        <div class="header__logo__img">
                            <img src="/img/logo.png" alt="logo" class="">
                        </div>
                    </div>
                </a>
                <ul class="header__nav__list">
                    <li><a href="/">Билеты</a></li>
                    <li><a href="/theaters">Театры</a></li>
                    <?php if (\vendor\Evd\Main\Auth::guest()) { ?>
                        <li><a href="/login">Вход</a></li>
                        <li><a href="/registration">Регистрация</a></li>
                    <?php } else { ?>
                        <?php if (\vendor\Evd\Main\Auth::isAdmin()) { ?>
                            <li><a href="/admin">Админка</a></li>
                        <?php } else { ?>
                            <li><a href="/orders">Заказы</a></li>
                        <?php } ?>
                        <li><a href="/logout">Выход</a></li>
                    <?php } ?>
                </ul>
                <div class="header__burger">
                    <span></span>
                </div>
            </nav>
        </div>
    </header>
    <main class="main">