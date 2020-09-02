<?php include ROOT.'/views/layouts/header.php'  ?>
                    <form class="create-form"  method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <h2>Введите название организации</h2>
                            <input class="form-control" name="name" type="text" id="name" placeholder="Введите пароль" value="<?php echo $name; ?>">
                        </div>
                        <div class="form-group">
                            <h2>Выберите категорию</h2>
                            <select class="form-control" name="category_id">
                                <option  selected="selected" value="<?php echo $category_id ?>">Выберите категорию</option>
                                <?php foreach ($categoryList as $category):?>
                                    <option class="" value="<?php echo $category['id']?>"><?php echo $category['name']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <h2>Введите описание</h2>
                            <input class="form-control" name="description" type="text" id="description" placeholder="Введите описание" value="<?php echo $description; ?>">
                        </div>
                        <div class="form-group">
                            <h2>Выберете изоображение</h2>
                            <input name="img" id="img" type="file">
                        </div>
                        <div class="form-group">
                            <img  style="width: 300px;" src="<?php echo Organization::getOrgImgById($org_id)?>" >
                        </div>
                        <div class="form-group">
                            <input class="btn btn-success" type="submit" name="submit">
                            <a href="/manager/" class="btn btn-danger"><input type="button" value="Отмена"></a>
                        </div>
                    </form>
                    <div>
                        <?php if (isset($errors)&&is_array($errors)): ?>
                            <?php foreach ($errors as $error):?>
                                <h1><?php echo $error; ?></h1>
                            <?php endforeach; ?>
                        <?php endif ?>
                    </div>
<?php include ROOT.'/views/layouts/footer.php'?>