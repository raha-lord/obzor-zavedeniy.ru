<?php include ROOT.'/views/layouts/header.php'  ?>
    <body>
    <div class="login-page">
        <div class="login-box-long">
            <div class="login-box-label"><p>Welcome</p></div>
            <img class="login-box-logo" src="/template/img/logo.png">
            <form class="login-form"  method="post" enctype="multipart/form-data">
                <select style="display: none" name="role">
                    <option selected="selected" value="user"></option>
                </select>
                <input class="login-form-input" name="email" id="email" placeholder="Введите email" type="email" value="">
                <input class="login-form-input" name="password" id="password" placeholder="Введите пароль" type="password" value="">
                <div class="login-box-block">
                    <h2>Выберете изоображение</h2>
                    <input name="img" id="img" type="file">
                </div>
                <input class="login-box-button" type="submit" name="submit" value="Зарегестрироваться">
                <div class="login-box-block">
                    <a href="/user/login/">Войти</a>
                    <a href="/organization/create">Создать страничку организации</a>
                </div>
            </form>
            <div>
                <?php if (isset($errors)&&is_array($errors)): ?>
                    <?php foreach ($errors as $error):?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                <?php endif ?>
            </div>
        </div>
    </div>
    </body>


<?php include ROOT.'/views/layouts/footer.php'?>