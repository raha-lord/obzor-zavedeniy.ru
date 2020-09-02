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
            <textarea class="form-control" style="height: 500px;" name="content" id="content" placeholder="Текст" value=""><?php echo $content ?></textarea>
        </div>
        <div class="form-group">
            <h2>Выберите категорию</h2>
            <select class="form-control" name="category_id">
                <?php foreach ($categoryList as $category):?>
                    <?php if($category['id'] == $category_id) :?>
                        <option  selected="selected" value="<?php echo $category['id']?>"><?php echo $category['name']?></option>
                    <?php else: ?>
                        <option value="<?php echo $category['id']?>"><?php echo $category['name']?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
            <h2>Укажите статус</h2>
            <select class="form-control" name="published">
                <?php if($published == 0):?>
                <option  selected="selected" value="0">Не опубликовано</option>
                <option class="" value="1">Опубликовано</option>
                <?php else:?>
                <option  selected="selected" value="1">Опубликовано</option>
                <option value="0">Не опубликовано</option>
                <?php endif; ?>
            </select>
            <h2>Укажите тип публикации</h2>
            <select class="form-control" name="type">
                <?php if($type == 'post'):?>
                <option  selected="selected" value="post">Пост</option>
                <option  value="news">Новость</option>
                <?php else:?>
                    <option  selected="selected" value="news">Новость</option>
                    <option  value="post">Пост</option>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group">
            <img src="<?php echo Content::getContentImageById($content_id)?>">
            <h2>Выберете изоображение</h2>
            <input name="img" id="img" type="file">
        </div>
        <div class="form-group">
            <h2>Доп информация один</h2>
            <textarea class="form-control" style="height: 100px;" name="one_info" id="one_info" placeholder="Текст" value="<?php echo $one_info ?>"><?php echo $one_info ?></textarea>
        </div>
        <div class="form-group">
            <h2>Доп информация два</h2>
            <textarea class="form-control" style="height: 100px;" name="two_info" id="two_info" placeholder="Текст" value="<?php echo $two_info ?>"><?php echo $two_info ?></textarea>
        </div>
        <div class="form-group">
            <h2>Доп информация три</h2>
            <textarea class="form-control" style="height: 100px;" name="three_info" id="three_info" placeholder="Текст" value="<?php echo $three_info ?>"><?php echo $three_info ?></textarea>
        </div>
        <input class="btn btn-success" type="submit" name="submit" value="Сохранить">
        <a href="/manager/" class="btn btn-primary">Отменить</a>
    </form>
</div>

<?php include ROOT.'/views/layouts/footer.php'?>
