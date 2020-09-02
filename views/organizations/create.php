<?php include ROOT.'/views/layouts/header.php'  ?>
    <body>
    <div class="login-page">
        <div class="login-box-longer">
            <div class="login-box-label"><p>Welcome</p></div>
            <img class="login-box-logo" src="/template/img/logo.png">
            <form class="login-form"  method="post" enctype="multipart/form-data">
                <select style="display: none" name="role">
                    <option selected="selected" value="manager"></option>
                </select>
                <input class="login-form-input" name="email" id="email" placeholder="Введите email" type="email" value="">
                <input class="login-form-input" name="password" id="password" placeholder="Введите пароль" type="password" value="">
                <input class="login-form-input" name="name" type="text" id="name" placeholder="Введите название организации" value="">
                <input class="login-form-input" name="description" type="text" id="description" placeholder="Введите описание" value="">
                <div class="login-box-block">
                    <h2>Выберите категорию</h2>
                    <select class="" name="category_id">
                        <option  selected="selected" value="0">Выберите категорию</option>
                        <?php foreach ($categoryList as $category):?>
                            <option class="" value="<?php echo $category['id']?>"><?php echo $category['name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="login-box-block">
                    <h2>Выберете изоображение</h2>
                    <input name="img" id="img" type="file">
                </div>
                <input class="login-box-button" type="submit" name="submit" value="Создать">
                <div class="login-box-block">
                    <a href="/user/login/">Войти</a>
                    <a href="/organization/create">Зарегистрироваться как пользователь</a>
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