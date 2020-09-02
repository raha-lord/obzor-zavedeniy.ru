<?php include ROOT.'/views/layouts/header.php'  ?>
<body>
    <div class="login-page">
        <div class="login-box">
            <div class="login-box-label"><p>Welcome</p></div>
            <img class="login-box-logo" src="/template/img/logo.png">
            <form class="login-form" method="post" enctype="multipart/form-data">
                <input class="login-form-input" name="email" id="email" placeholder="Введите email" type="email" value="">
                <input class="login-form-input" name="password" id="password" placeholder="Введите пароль" type="password" value="">
                <input class="login-box-button" type="submit" name="submit" value="Отправить">
                <div class="login-box-label"><a href="/user/register/"><p>Зраегистрироваться</p></a></div>
            </form>
        </div>
    </div>
</body>
<?php include ROOT.'/views/layouts/footer.php'?>