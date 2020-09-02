<?php include ROOT.'/views/layouts/header-admin.php'  ?>

<div class="create-item">
    <form class="create-form" method="post" enctype="multipart/form-data">
        <?php if ($errors):?>
            <p> Проверьте данные !</p>
        <?php endif; ?>
        <div class="form-group">
            <h2> Введите заголовок</h2>
            <input class="form-control" name="title" id="title" placeholder="Заголовок" type="text" value="<?php echo $title ?>">
            <select style="display: none" name="role">
                <option selected="selected" value="user"></option>
            </select>
        </div>
        <div class="form-group">
            <h2 > Введите текст</h2>
            <textarea class="form-control" style="height: 500px;" name="content" id="content" placeholder="Текст" value="<?php echo $content ?>"><?php echo $content ?></textarea>
        </div>
        <div class="form-group">
            <h2>Выберите категорию</h2>
            <select class="form-control" name="category_id">
                <option  selected="selected" value="0">Выберите категорию</option>
                <?php foreach ($categoryList as $category):?>
                    <option class="" value="<?php echo $category['id']?>"><?php echo $category['name']?></option>
                <?php endforeach; ?>
            </select>
            <h2>Укажите статус</h2>
            <select class="form-control" name="published">
                <option  selected="selected" value="0">Не опубликовано</option>
                <option class="" value="1">Опубликовано</option>
            </select>
            <h2>Укажите тип публикации</h2>
            <select class="form-control" name="type">
                <option  selected="selected" value="post">Пост</option>
                <option  value="news">Новость</option>
            </select>
        </div>
        <div class="form-group">
            <h2>Выберете изоображение</h2>
            <input name="img" id="img" type="file">
        </div>
        <div class="form-group">
            <h2>Доп информация один</h2>
            <textarea class="form-control" style="height: 100px;" name="one_info" id="one_info" placeholder="Текст" value="<?php echo $info_one ?>"><?php echo $info_one ?></textarea>
        </div>
        <div class="form-group">
            <h2>Доп информация два</h2>
            <textarea class="form-control" style="height: 100px;" name="two_info" id="two_info" placeholder="Текст" value="<?php echo $info_two ?>"><?php echo $info_two ?></textarea>
        </div>
        <div class="form-group">
            <h2>Доп информация три</h2>
            <textarea class="form-control" style="height: 100px;" name="three_info" id="three_info" placeholder="Текст" value="<?php echo $info_three ?>"><?php echo $info_three ?></textarea>
        </div>
        <input class="btn btn-success" type="submit" name="submit" value="Сохранить">
        <a href="/manager/" class="btn btn-primary">Отменить</a>
    </form>
</div>

<?php include ROOT.'/views/layouts/footer.php'?>
