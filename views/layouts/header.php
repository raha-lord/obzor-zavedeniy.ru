<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title>OBZOR-Заведений.ru</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="keywords" content="Дагестан, Махачкала, СМИ, Пресса, Новости, Сегодня, Обзор, Обозреваетель СМИ, Дербент, Кизляр, Хасавюрт, Буйнакск, Каспийск">
    <meta name="description" content="Задача MDN — в том, чтобы обучить новичков всему тому, что нужно им для разработки веб-сайтов и приложений.">
    <meta name="viewport" content="width=900, initial-scale=1">
    <link rel="stylesheet" href="/template/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300&family=Poppins:wght@500&family=Source+Serif+Pro&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/template/img/logo-fav.png" type="image/x-icon">
    <?php if (isset($_SESSION['user'])):?>
        <link rel="stylesheet" href="/template/style-user.css">
    <?php endif;?>
</head>
<body>
<header>
    <div class="header">
        <div class="logo-box">
            <div class="logo-box-top">
                <div class="logo-box-img">
                    <a href="/">
                        <img class="logo-img" src="/template/img/logo.png">
                    </a>
                </div>
                <div class="account-menu">
                    <?php if ( isset($_SESSION['user'])&&$_SESSION['role']=='manager'):?>
                        <p><a href="/manager/">Мой кабинет</a></p>
                        <p><a href="/cabinet/<?php echo $_SESSION['user']?>">Аккаунт</a></p>
                        <p><a href="/user/logout/">Выйти</a></p>
                    <?php elseif (isset($_SESSION['user']) && $_SESSION['role']=='user') :?>
                        <p><a href="/cabinet/<?php echo $_SESSION['user']?>">Аккаунт</a></p>
                        <p><a href="/user/logout/">Выйти</a></p>
                    <?php else:?>
                        <p><a href="/user/register">Регистрация</a></p>
                        <p><a href="/user/login/">Войти</a></p>
                    <?php endif;?>
                </div>
            </div>
            <div class="logo-box-bottom">
                <nav class="nav-menu">
                    <ul>
                        <?php foreach ($categoryList as $category) :?>
                        <?php if ($category['mother_id']==0) :?>
                            <li><a href="<?php  echo '/category/'.$category['id']?>"><?php  echo $category['name']?></a></li>
                        <?php endif; ?>
                        <?php endforeach;?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>