<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>HTML5</title>
    <link rel="stylesheet" href="/template/style.css">
    <link rel="stylesheet" href="/template/style-user.css">
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
                        <p><a href="/cabinet/<?php echo $_SESSION['user']?>">Акааунт</a></p>
                        <p><a href="/user/logout/">Выйти</a></p>
                    <?php elseif (isset($_SESSION['user']) && $_SESSION['role']=='user') :?>
                        <p><a href="/cabinet/<?php echo $_SESSION['user']?>">Акааунт</a></p>
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